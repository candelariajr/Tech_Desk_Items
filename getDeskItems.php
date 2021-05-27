<?php
/**
 * Created by PhpStorm.
 * User: candelariajr
 * Date: 8/1/2017
 * Time: 10:33 AM
 */

require_once("dbauth.php");
$db = new PDO("pgsql:dbname=$dbname;host=$host;port=$port", $dbuser, $dbpass);
$sql =
    "
SELECT
	--'b' || rm.record_num as bibnumber,
	--br.bcode3,
	--brp.best_title,
	--brp.bib_record_id,
	--bib.record_id,
	--ir.id,
	--bil.bib_record_id,
	--irp.barcode,
	--irp.call_number,
	CASE
		WHEN (SUBSTRING(irp.call_number, 1, 7) = '|a ASU ') THEN
			CASE
				WHEN SUBSTRING(irp.call_number, 8) = 'Laptops Macbook Pro' THEN 'Macbook'
				-- WHEN SUBSTRING(irp.call_number, 8) = 'Laptops Latitude E3440' THEN 'Dell Laptop'
				-- WHEN SUBSTRING(irp.call_number, 8) = 'Laptops Latitude E5430' THEN 'Dell Laptop'
				-- WHEN SUBSTRING(irp.call_number, 8) = 'Laptops Latitude E5450' THEN 'Dell Laptop'
				-- WHEN SUBSTRING(irp.call_number, 8) = 'Laptops Latitude E5470' THEN 'Dell Laptop'
				WHEN SUBSTRING(irp.call_number, 8) = 'Laptops Macbook Pro' THEN 'Macbook Pro'
				WHEN SUBSTRING(irp.call_number, 8) = 'Digital Skull Candy Headphones' THEN 'Skullcandy Headphones'
				WHEN SUBSTRING(irp.call_number, 8) = 'Digital Calculator' THEN 'Graphing Calculator'
				WHEN SUBSTRING(irp.call_number, 8) = 'Digital Chromebook' THEN 'Chromebook'
				WHEN SUBSTRING(irp.call_number, 8) = 'Digital Camcorder Canon Vixia HFR400' THEN 'Digital Camcorder'
				WHEN SUBSTRING(irp.call_number, 8) = 'Digital Camcorder Canon Vixia HFR700' THEN 'Digital Camcorder'
				WHEN SUBSTRING(irp.call_number, 8) = 'Digital Camcorder Canon Vixia HFR800' THEN 'Digital Camcorder'
				WHEN SUBSTRING(irp.call_number, 8) = 'Digital Nikon D3200 DSLR' THEN 'DSLR Camera'
				WHEN SUBSTRING(irp.call_number, 8) = 'Digital Nikon D3300 DSLR' THEN 'DSLR Camera'
				WHEN SUBSTRING(irp.call_number, 8) = 'Digital Nikon D3400 DSLR' THEN 'DSLR Camera'
				WHEN SUBSTRING(irp.call_number, 8) = 'Digital Recorder Zoom H2' THEN 'Zoom Audio Recorder'
				WHEN SUBSTRING(irp.call_number, 8) = 'Digital Audio Recorder Zoom H2n' THEN 'Zoom Audio Recorder'
				WHEN SUBSTRING(irp.call_number, 8) = 'Digital Audio Recorder Zoom H4N Pro' THEN 'Zoom Audio Recorder'
				ELSE SUBSTRING(irp.call_number, 8)
			END
		WHEN (SUBSTRING(irp.call_number, 1, 6) = '|aASU ') THEN
			CASE
			    -- Update 8/17
			    WHEN SUBSTRING(irp.call_number, 7) = 'Laptops PC' THEN 'PC Laptop'
				WHEN SUBSTRING(irp.call_number, 7) = 'Digital Chromebook' THEN 'Chromebook'
				WHEN SUBSTRING(irp.call_number, 7) = 'Laptops Macbook Pro' THEN 'Macbook'
				WHEN SUBSTRING(irp.call_number, 7) = 'Digital Skull Candy Headphones' THEN 'Skullcandy Headphones'
				WHEN SUBSTRING(irp.call_number, 7) = 'Digital Calculator' THEN 'Graphing Calculator'
				WHEN SUBSTRING(irp.call_number, 7) = 'Digital Camcorder Canon Vixia' THEN 'Digital Camcorder'
				WHEN SUBSTRING(irp.call_number, 7) = 'Digital Nikon DSLR' THEN 'DSLR Camera'
				WHEN SUBSTRING(irp.call_number, 7) = 'Digital Audio Recorder Zoom' THEN 'Zoom Audio Recorder'
				WHEN SUBSTRING(irp.call_number, 7) = 'Digital Student Projector' THEN 'Projector'
				ELSE SUBSTRING(irp.call_number, 7)
			END
		WHEN (SUBSTRING(irp.call_number, 1, 2) = '|a') THEN
			SUBSTRING(irp.call_number, 3)
		ELSE
			irp.call_number
	END AS call_number_case,
	--ispn.name AS status,
	--ir.location_code,
	--ir.item_status_code,
	--ir.last_checkin_gmt,
	--ir.is_available_at_library
	count(case when ir.is_available_at_library = 't' then 1 end)
FROM
	sierra_view.item_record AS ir RIGHT OUTER JOIN sierra_view.item_status_property AS isp ON
	ir.item_status_code = isp.code

	RIGHT OUTER JOIN sierra_view.item_status_property_name AS ispn ON
	isp.id = ispn.item_status_property_id

	RIGHT OUTER JOIN sierra_view.item_record_property AS irp ON
	ir.id = irp.item_record_id

	RIGHT OUTER JOIN sierra_view.item_status_property ON
	ir.item_status_code = sierra_view.item_status_property.code

	RIGHT OUTER JOIN sierra_view.bib_record_item_record_link AS bil ON
	ir.id = bil.item_record_id

	RIGHT OUTER JOIN sierra_view.bib_record AS bib ON
	bil.bib_record_id = bib.id

	RIGHT OUTER JOIN sierra_view.bib_record_property AS brp ON
	brp.bib_record_id = bil.bib_record_id

	RIGHT OUTER JOIN iiirecord.bib_record AS br ON
	br.id = brp.bib_record_id

	RIGHT OUTER JOIN iiirecord.record_metadata AS rm ON
	rm.id = brp.bib_record_id
WHERE
	--This is what will be modified
	irp.call_number != '' AND
	irp.call_number IN (
		'|aASU Digital Student Projector',
		'|aASU Laptops Macbook Pro',
		'|aASU Digital Skull Candy Headphones',
		'|aASU Digital Calculator',
		'|aASU Digital Camcorder Canon Vixia',
		'|aASU Digital Nikon DSLR',
		'|aASU Digital Recorder Zoom H2',
		'|aASU Digital Audio Recorder Zoom',
		'|aASU Digital Chromebook',
		'|aASU Laptops PC'
	) AND
	--ir.is_available_at_library = 't' AND
	ir.item_status_code NOT IN('d', '$', 'n', 'o', 'm', 'e') AND
	br.bcode3 NOT IN ('e') AND
	--This marks the end of modification scope
	(
		location_code = 'breds' OR
		location_code = 'breeq' OR
		location_code = 'breip' OR
		location_code = 'brel1' OR
		location_code = 'brelp'
	)
GROUP BY call_number_case
ORDER BY call_number_case ASC	
    ";
$res = $db->query($sql);
$resArray = $res -> fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($resArray);
echo $json;
