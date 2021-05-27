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
    "SELECT			
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
		WHEN irp.call_number = 	'|aASU Laptops Macbook Pro'	THEN	'Mac Laptop'
		WHEN irp.call_number = 	'|aASU Laptops PC'	THEN	'Windows Laptop'
		WHEN irp.call_number = 	'|aASU Digital Audio Recorder Zoom'	THEN	'Zoom Audio Recorder'
		WHEN irp.call_number = 	'|aASU Digital Apogee Jam'	THEN	'Apogee Jam'
		WHEN irp.call_number = 	'|aASU Digital Apogee Duet'	THEN	'Apogee Duet'
		WHEN irp.call_number = 	'|aDigital Camcorder Sony HDR-MV1'	THEN	'Sony HDR-MV1'
		WHEN irp.call_number = 	'|aASU Digital Camcorder Zoom Q3HD'	THEN	'Zoom Q3HD'
		WHEN irp.call_number = 	'|aASU Digital Yeti USB Mic'	THEN	'Yeti Microphone'
		WHEN irp.call_number = 	'|aASU Digital Snowball USB Mic'	THEN	'Snowball Microphone'
		WHEN irp.call_number = 	'|aASU DIgital Lapel Microphone'	THEN	'Lapel Microphone'
		WHEN irp.call_number = 	'|aASU Digital Calculator'	THEN	'Calculator'
		WHEN irp.call_number = 	'|aASU Digital Camcorder Canon Vixia'	THEN	'Canon Vixia'
		WHEN irp.call_number = 	'|aASU Digital Nikon DSLR'	THEN	'Nikon DSLR'
		WHEN irp.call_number = 	'|aASU Digital Ricoh Theta V 360 camera'	THEN	'Ricoh Theta V 360 Camera'
		WHEN irp.call_number = 	'|aASU Digital Camera Nikon CoolPix L810'	THEN	'Nikon Point and Shoot Camera'
		WHEN irp.call_number = 	'|aASU Digital Camera Tripod Sony'	THEN	'Sony Tripod'
		WHEN irp.call_number = 	'|aASU Digital Chromebook'	THEN	'Chromebook'
		WHEN irp.call_number = 	'|aASU Digital Wacom Drawing Tablet'	THEN	'Wacom Drawing Tablet'
		WHEN irp.call_number = 	'|aASU Digital Surface'	THEN	'Surface Tablet'
		WHEN irp.call_number = 	'|aASU Digital Faculty Laptop'	THEN	'Faculty Windows Laptop'
		WHEN irp.call_number = 	'|aASU Digital Faculty DSLR'	THEN	'Faculty Nikon DSLR'
		WHEN irp.call_number = 	'|aASU Digital Faculty Projector'	THEN	'Faculty Projector'
		WHEN irp.call_number = 	'|aASU Digital Faculty Projector Screen'	THEN	'Faculty Projector Screen'
		WHEN irp.call_number = 	'|aASU Digital Faculty Recorder Zoom H2'	THEN	'Faculty Zoom Audio Recorder'
		WHEN irp.call_number = 	'|aASU Digital HDMI Cable'	THEN	'HDMI Cable'
		WHEN irp.call_number = 	'|aASU Digital Wired Mouse'	THEN	'Wired Mouse'
		WHEN irp.call_number = 	'|aASU Digital Macbook USB-C Hub'	THEN	'USB-C Hub'
		WHEN irp.call_number = 	'|aASU Digital DVI to Thunderbolt Adapter'	THEN	'DVI to Thunderbolt Adapter'
		WHEN irp.call_number = 	'|aASU Digital HDMI to Thunderbolt Adapter'	THEN	'HDMI to Thunderbolt Adapter'
		WHEN irp.call_number = 	'|aASU Digital VGA to Thunderbolt Adapter'	THEN	'VGA to Thunderbolt Adapter'
		WHEN irp.call_number = 	'|aASU Digital Portable DVD Drive'	THEN	'DVD Drive'
		WHEN irp.call_number = 	'|aASU Digital PC Charger'	THEN	'PC Charger'
		WHEN irp.call_number = 	'|aASU Laptops Macbook Individual L Connector Charger'	THEN	'Macbook L Connector Charger'
		WHEN irp.call_number = 	'|aASU Laptops Macbook Pro Individual Charger'	THEN	'Macbook Pro Charger'
		WHEN irp.call_number = 	'|aASU Laptops Macbook Individual USB C Charger'	THEN	'Macbook USB-C Charger'
		WHEN irp.call_number = 	'|aASU Digital Skull Candy Headphones'	THEN	'Skull Candy Headphones'
		WHEN irp.call_number = 	'|aASU Lacie Hard Drive 500GB'	THEN	'Lacie Hard Drive'
		WHEN irp.call_number = 	'|aASU Digital Student Projector'	THEN	'Ricoh Projector'
		WHEN irp.call_number = 	'|aASU Digital Student Projector Screen'	THEN	'Projector Screen'
		WHEN irp.call_number = 	'|aASU Digital Oculus Go'	THEN	'Oculus Go'
		WHEN irp.call_number = 	'|aASU Digital Arduino Kit'	THEN	'Arduino Kit'
		WHEN irp.call_number =  '|aASU Digital Camcorder Sony HDR-MV1' THEN 'Sony HDR-MV1'
		WHEN irp.call_number =  '|aASU Digital Surface 2' THEN 'Surface 2'
		WHEN irp.call_number =  '|aASU Digital Surface Pro 4' THEN 'Surface Pro 4'
	END AS call_number_case,		
	--ispn.name AS status,		
	--ir.location_code,		
	--ir.item_status_code,		
	--ir.last_checkin_gmt,		
	--ir.is_available_at_library	
	--ir.item_status_code NOT IN('d', '$', 'n', 'o', 'm', 'e') AND	
	SUM(CASE 
		WHEN ir.is_available_at_library = 't' AND 
			ir.item_status_code NOT IN('d', '$', 'n', 'o', 'm', 'e', 'z') 
		THEN 1 
		ELSE 0 
	END) AS count,
	SUM(CASE 
		WHEN ir.item_status_code NOT IN('$', 'n', 'o', 'm', 'e', 'z') 
		THEN 1 
		ELSE 0 
	END) AS total
	--count(case when 		
	-- SUBSTRING(irp.call_number, 7, 7),		
	-- SUBSTRING(irp.call_number, 15)		
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
	irp.call_number IN(		
	'|aASU Laptops Macbook Pro',		
	'|aASU Laptops PC',		
	'|aASU Digital Audio Recorder Zoom',		
	'|aASU Digital Apogee Jam',		
	'|aASU Digital Apogee Duet',		
	'|aDigital Camcorder Sony HDR-MV1',		
	'|aASU Digital Camcorder Zoom Q3HD',		
	'|aASU Digital Yeti USB Mic',		
	'|aASU Digital Snowball USB Mic',		
	'|aASU DIgital Lapel Microphone',		
	'|aASU Digital Calculator',		
	'|aASU Digital Camcorder Canon Vixia',		
	'|aASU Digital Nikon DSLR',		
	'|aASU Digital Ricoh Theta V 360 camera',		
	'|aASU Digital Camera Nikon CoolPix L810',		
	'|aASU Digital Camera Tripod Sony',		
	'|aASU Digital Chromebook',		
	'|aASU Digital Wacom Drawing Tablet',		
	'|aASU Digital Surface',		
	'|aASU Digital Faculty Laptop',		
	'|aASU Digital Faculty DSLR',		
	'|aASU Digital Faculty Projector',		
	'|aASU Digital Faculty Projector Screen',		
	'|aASU Digital Faculty Recorder Zoom H2',		
	'|aASU Digital HDMI Cable',		
	'|aASU Digital Wired Mouse',		
	'|aASU Digital Macbook USB-C Hub',		
	'|aASU Digital DVI to Thunderbolt Adapter',		
	'|aASU Digital HDMI to Thunderbolt Adapter',		
	'|aASU Digital VGA to Thunderbolt Adapter',		
	'|aASU Digital Portable DVD Drive',		
	'|aASU Digital PC Charger',		
	'|aASU Laptops Macbook Individual L Connector Charger',		
	'|aASU Laptops Macbook Pro Individual Charger',		
	'|aASU Laptops Macbook Individual USB C Charger',		
	'|aASU Digital Skull Candy Headphones',		
	'|aASU Lacie Hard Drive 500GB',		
	'|aASU Digital Student Projector',		
	'|aASU Digital Student Projector Screen',		
	'|aASU Digital Oculus Go',		
	'|aASU Digital Arduino Kit',
	'|aASU Digital Camcorder Sony HDR-MV1',
	'|aASU Digital Surface 2',
	'|aASU Digital Surface Pro 4'		
	) AND				
	br.bcode3 NOT IN ('e') AND(		
		location_code = 'breds' OR	
		location_code = 'breeq' OR	
		location_code = 'breip' OR	
		location_code = 'brel1' OR	
		location_code = 'brelp'	
	)		
GROUP BY call_number_case			
ORDER BY call_number_case
    ";
$res = $db->query($sql);
$resArray = $res -> fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($resArray);
echo $json;