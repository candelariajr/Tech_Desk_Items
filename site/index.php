<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tech Desk Items</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../JS/jquery-3.1.1.min.js"></script>
    <script src="../JS/jquery-ui.js"></script>

    <script src="../JS/bootstrap-select.js"></script>
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <style>
        *{
            user-select: none;
        }

        body{
            background-color: #00004b;
            /*background-image: linear-gradient(to top, #00466f ,#051937, #00466f, #007782, #00a562, #78a710);*/
            /*background-image: linear-gradient(to top, #00466f ,#051937, #00466f, #007782, #00a562);
            min-height: 2048px;*/

            /*background-color: #00004b;*/

            /*Black background*/
            /*background-color: black;*/
            overflow-y: visible;

        }

        th{
            font-size: 15px;
        }

        th, h1{
            color: white;
        }

        #masterContainer{
            height: 100%;
            width: 100%;
        }

        tr{
            height: 50px;
            padding: 23px;
        }

        .imageIcon{
            width: 50px;
            height: 48px;
            border: 0;
        }

        td{
            vertical-align: middle;
            font-size: 35px;
            padding: 5px !important;
            color: white;
        }

        h1{
            font-size: 25px;
            margin-top: 50px;
            margin-bottom: 15px;
        }

        td{
            font-size: 15px;
        }

        .imageIcon{
            width: 50px;
            height: 48px;
            border: 0;
        }

        #resultTable{
            display:none;
        }

        /* SASS
        #resultTable{
            width: 100%;
            background-color: transparent;
            tbody{
                height:200px;
                overflow-y:auto;
                width: 100%;
            }
            thead,tbody,tr,td,th{
                display:block;
            }
            tbody{
                td{
                    float:left;
                }
            }
            thead {
                tr{
                    th{
                        float:left;
                        background-color: #f39c12;
                        border-color:#e67e22;
                    }
                }
            }
        }
        #resultTable {
            width: 100%;
            background-color: transparent;
        }
        #resultTable tbody {
            height: 80vh;
            overflow-y: auto;
            width: 100%;
        }
        #resultTable thead, #resultTable tbody, #resultTable tr, #resultTable td, #resultTable th {
            display: block;
        }
        #resultTable tbody td {
            float: left;
        }
        #resultTable thead tr th {
            float: left;
            background-color: #f39c12;
            border-color: #e67e22;
        }

        /*
        ============================================
        TABS
        ============================================
        */
        .panel-default>.panel-heading{
            color: #fff;
            /*background-color: #46ca65;*/
            background-color: #333379;
            /*color: #ffc900;*/
            /*background-color: #333;*/
        }

        .panel-group .panel{
            border-radius: 3px;
        }

        .panel-title{
            font-size: 24px;
        }

        .panel-title:hover{
            cursor: hand;
        }

        .panel-title>a{
        }

        .panel-title>a:hover{
            user-select: none;
            text-decoration: none;
        }

        .panel{
            color: #fff;
            background-color: transparent;
            border: none;
        }

        .panel-group .panel-heading+.panel-collapse>.list-group,.panel-group .panel-heading+.panel-collapse>.panel-body{
            border-width: 0 1px 1px 1px;
            border-style: solid;
            /*border-color: #46ca65 !important;*/
            /*border-color: #333379 !important;*/
            border-color: #333;
        }

        .panel-body {
            padding-left: 15px;
            border-width: 1px;

        }


        #toggleButtonContainer{
            padding-right: 10px;
            float:right;
            display: block;
        }

        #toggleButton{
            display: inline-block;
            margin-top: 45px;
            margin-bottom: 15px;
            border:none;
            border-radius: 3px;

            background-color: #333379;
            color: white;
            padding: 5px;
            font-size: 20px;


            /*APP THEME*/
            /*color: #ffc900;
            background-color: #333;
            */
            cursor: pointer;
            text-decoration:none;
        }

        #techDeskTextHeading{
            display: inline-block;
            margin-top: 50px;
            margin-bottom: 15px;
        }

        .groups-head-row{
            font-weight: bold;
        }

        .groups-item-row{
            border-top : 1px solid white;
        }

        .panel-heading{
            cursor: pointer;
        }

        @media only screen and (max-width: 500px) {
            #toggleButton {
                display: block;
                margin-bottom: 20px;
                margin-top: 0;
            }

            #toggleButtonContainer{
                display: block;
                float: left;
            }

            #techDeskTextHeading{
                display: block;
            }

            .panel-group{
                margin-top: 90px;
            }
        }

        .quantity-available{
            font-size: 30px;
            font-weight: bold;
        }

        .quantity-total{

        }









        /*
        ============================================
        TABS
        ============================================
        */

    </style>
    <script>
        var configState = {
            //"Apogee Duet" : {"duration" : "3 days", "img" : "apogeeduet.png", "category" : "Audio Equipment"},
            "Apogee Jam" : {"duration" : "3 days", "img" : "apogeejam.png", "category" : "Audio Equipment"},
            //"Arduino Kit" : {"duration" : "3 days", "img" : "arduinokit.png", "category" : "Miscellaneous"},
            "Calculator" : {"duration" : "3 days", "img" : "calculator.png", "category" : "Calculators"},
            "Canon Vixia" : {"duration" : "3 days", "img" : "vixia.png", "category" : "Camcorders"},
            "Chromebook" : {"duration" : "3 days", "img" : "chromebook.png", "category" : "Laptops"},
            "DVD Drive" : {"duration" : "3 days", "img" : "DVDDrive.png", "category" : "Miscellaneous"},
            //"DVI to Thunderbolt Adapter" : {"duration" : "8 hours", "img" : "DVItoThunder.png", "category" : "Accessories"},
            "Faculty Nikon DSLR" : {"duration" : "3 weeks", "img" : "NikonDSLR.png", "category" : "Faculty/Staff Equipment"},
            "Faculty Projector" : {"duration" : "3 weeks", "img" : "ricoh.png", "category" : "Faculty/Staff Equipment"},
            "Faculty Projector Screen" : {"duration" : "3 weeks", "img" : "ProjectorScreen.png", "category" : "Faculty/Staff Equipment"},
            "Faculty Windows Laptop" : {"duration" : "3 weeks", "img" : "WindowsLaptop.png", "category" : "Faculty/Staff Equipment"},
            "Faculty Zoom Audio Recorder" : {"duration" : "3 weeks", "img" : "zoom.png", "category" : "Faculty/Staff Equipment"},
            "HDMI Cable" : {"duration" : "8 hours", "img" : "HDMIcable.png", "category" : "Accessories"},
            "HDMI to Thunderbolt Adapter" : {"duration" : "8 hours", "img" : "HDMItoThunderbolt.png", "category" : "Accessories"},
            //"Lacie Hard Drive" : {"duration" : "3 days", "img" : "lacieharddrive.png", "category" : "Miscellaneous"},
            //"Lapel Microphone" : {"duration" : "3 days", "img" : "lapelmicrophone.png", "category" : "Audio Equipment"},
            "Mac Laptop" : {"duration" : "8 hours", "img" : "macbook.png", "category" : "Laptops"},
            "Macbook L Connector Charger" : {"duration" : "8 hours", "img" : "macchargerL.png", "category" : "Accessories"},
            "Macbook Pro Charger" : {"duration" : "8 hours", "img" : "maccharger.png", "category" : "Accessories"},
            "Macbook USB-C Charger" : {"duration" : "8 hours", "img" : "macchargerL.png", "category" : "Accessories"},
            "Nikon DSLR" : {"duration" : "3 days", "img" : "NikonDSLR.png", "category" : "Cameras"},
            //"Nikon Point and Shoot Camera" : {"duration" : "3 days", "img" : "NikonCoolpixL810.png", "category" : "Cameras"},
            "Oculus Go" : {"duration" : "3 days", "img" : "oculusgo.png", "category" : "Miscellaneous"},
            "PC Charger" : {"duration" : "8 hours", "img" : "PCCharger.png", "category" : "Accessories"},
            "Projector Screen" : {"duration" : "3 days", "img" : "ProjectorScreen.png", "category" : "Miscellaneous"},
            "Ricoh Projector" : {"duration" : "3 days", "img" : "ricoh.png", "category" : "Miscellaneous"},
            "Ricoh Theta V 360 Camera" : {"duration" : "3 days", "img" : "ricohtheta.png", "category" : "Cameras"},
            "Skull Candy Headphones" : {"duration" : "8 hours", "img" : "headphones.png", "category" : "Accessories"},
            "Snowball Microphone" : {"duration" : "3 days", "img" : "snowball.png", "category" : "Audio Equipment"},
            "Sony HDR-MV1" : {"duration" : "3 days", "img" : "SonyHDRMV1.png", "category" : "Audio Equipment"},
            "Sony Tripod" : {"duration" : "3 days", "img" : "SonyTripod.png", "category" : "Tripods"},
            //"Surface 2" : {"duration" : "3 days", "img" : "surface pro 3.png", "category" : "Tablets"},
            "Surface Pro 4" : {"duration" : "3 days", "img" : "surface pro 3.png", "category" : "Tablets"},
            "USB-C Hub" : {"duration" : "8 hours", "img" : "USBChub.png", "category" : "Accessories"},
            "VGA to Thunderbolt Adapter" : {"duration" : "8 hours", "img" : "vgatothunderbolt.png", "category" : "Accessories"},
            //"Wacom Drawing Tablet" : {"duration" : "3 days", "img" : "wacomdrawingtablet.png", "category" : "Tablets"},
            "Windows Laptop" : {"duration" : "8 hours", "img" : "dell.png", "category" : "Laptops"},
            "Wired Mouse" : {"duration" : "3 days", "img" : "wiredmouse.png", "category" : "Accessories"},
            "Yeti Microphone" : {"duration" : "3 days", "img" : "yetiusbmic.png", "category" : "Audio Equipment"},
            "Zoom Audio Recorder" : {"duration" : "3 days", "img" : "zoom.png", "category" : "Audio Equipment"}
            //"Zoom Q3HD" : {"duration" : "3 days", "img" : "zoom.png", "category" : "Camcorders"}
        };
        getData();

        /*
        * ======================================================================================
        * THIS IS THE TEST CODE FOR THE MANIPULATION OF THE CONFIGSTATE OBJECT
        * ======================================================================================
        * */





        /*
        * ======================================================================================
        * THIS IS THE TEST CODE FOR THE MANIPULATION OF THE CONFIGSTATE OBJECT
        * ======================================================================================
        * */

        //actual function used to get data
        function getData(){
            $.get("../getSiteItems.php", function(data, status){
                if(status === 'success'){
                    postData(data);
                }
                else{
                    alert("Unable to load external data");
                }
            })
        }

        //called once data is received
        function postData(data){
            var resultObj = JSON.parse(data);
            //if there is an object in the callback and it has a viable item in it
            if(resultObj[0].hasOwnProperty("call_number_case")
                && resultObj[0].hasOwnProperty("count")){
                //New request: Add "Show All" page
                renderShowAll(resultObj);
                var itemNames = Object.keys(configState);
                //itemNames contains an array of all item names from config state
                //console.log(configState[itemNames[1]]["duration"]);
                var itemGroups = {};
                for(var i = 0; i < itemNames.length; i++){
                    if(Object.keys(itemGroups).indexOf(configState[itemNames[i]]["category"]) === -1){
                        itemGroups[configState[itemNames[i]]["category"]] = [];
                    }
                    var currentItem = configState[itemNames[i]];
                    currentItem["item_name"] = itemNames[i];
                    itemGroups[configState[itemNames[i]]["category"]].push(currentItem)
                }

                printTabs(itemGroups);

                console.log("Results Posted: " + Date.now())
            }else{
                //TODO: Add more description here
                console.log("criteria Failed");
            }
        }

        function renderShowAll(resultObj){
            var tableHost = $("#resultTableBody");
            //empty the previous table if it exists
            tableHost.empty();
            for(var i = 0; i < resultObj.length; i++){
                //configState[[resultObj[i]]["call_number_case"]]["count"]= resultObj[i].count;

                configState[[resultObj[i]["call_number_case"]]]["count"] = resultObj[i]["count"];
                configState[[resultObj[i]["call_number_case"]]]["total"] = resultObj[i]["total"];
                //for every {"call_number_case : "foo", "count" : X} object
                var tr = $("<tr></tr>");
                var itemLabel = $("<td></td>");
                itemLabel.attr('class', 'labelText');
                //attach label from JSON object
                //itemLabel.text(resultObj[i].call_number_case);
                var resultObjName = resultObj[i].call_number_case;
                var itemImage = $("<img>");
                itemImage.attr('class', 'imageIcon');
                //config KV pairs are paired up by result object call_number_cases
                if(configState.hasOwnProperty(resultObjName) && configState[resultObjName]['img'] !== ""){
                    itemImage.attr('src', "../assets/" + configState[resultObjName].img);
                }else{
                    itemImage.css('visibility', 'hidden');
                }
                var itemText = $("<span></span>");
                //FUCK YOU BOOTSTRAP
                itemText.css('padding-left','30px');
                itemText.text(resultObjName);
                itemLabel.append(itemImage);
                itemLabel.append(itemText);
                //attach Date.now() to the string to show names changing in real time (dumb demo #41)
                tr.append(itemLabel);

                var durationText = $("<td></td>");
                //FUCK YOU BOOTSTRAP
                durationText.css('padding-left', '30px');  
                durationText.css('vertical-align', 'middle');
                durationText.text(configState[resultObjName].duration);
                tr.append(durationText);

                var quantityLabel = $("<td></td>");
                //FUCK YOU BOOTSTRAP
                quantityLabel.css('padding-left','40px');
                quantityLabel.css('vertical-align','middle');
                quantityLabel.html("<span class='quantity-available'>" + configState[resultObjName].count + "</span>" +
                    "<span> / " + configState[resultObjName].total + "</span>");
                tr.append(quantityLabel);

                tableHost.append(tr);
            }
            tableHost.append("<tr><td></td><td></td><td></td></tr>");
        }

        function printTabs(itemsByGroup){
            //add a group tab for each group
            /*
            <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                    <h4 class="panel-title">
                        <a>Group 2</a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        GROUP 2 SHIT
                    </div>
                </div>
            </div>
            */
            var groupList = Object.keys(itemsByGroup);
            var panelContainer = $("#accordion");
            for(var i = 0; i < groupList.length; i++){
                //create panel
                var panel = $("<div>", {
                    'class': "panel panel-default"}
                );

                //create panel heading
                var panelHeading = $("<div>", {
                    'class': "panel-heading",
                    'data-toggle': "collapse",
                    'data-parent': "#accordion",
                    'data-target': "#collapse" + i,
                    'href': "#collapse" + i}
                );
                var panelTitle = $("<h4>", {
                    'class' : 'panel-title'
                });
                var panelLabel = $("<a>", {
                    'html' : groupList[i]
                });
                //build panel heading and append to panel
                panelTitle.append(panelLabel);
                panelHeading.append(panelTitle);
                panel.append(panelHeading);


                //create panel collapse and panel body
                /*
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        GROUP 2 SHIT
                    </div>
                </div>
                * */
                var panelCollapse = $("<div>", {
                    'id' : "collapse" + i,
                    'class' : "panel-collapse collapse"
                });
                var panelBody = $("<div>", {
                    'class' : "panel-body"
                });
                panelBody.html(generatePanelBody(itemsByGroup[groupList[i]]));
                panelCollapse.append(panelBody);
                panel.append(panelCollapse);
                panelContainer.append(panel);


                //JS/bootstrap.min.js
                // $.getScript( "JS/bootstrap.min.js");
                // FUCK YOU BOOTSTRAP: WHY CAN'T YOU HANDLE DYNAMIC CONTENT, YOU IMBECILE?!?!!? ITS 2018, NOT 2004!!!
                /*$(".panel-heading").each(function(){
                    $(this).click(function(){
                        console.log(this);
                    })
                });
                */

            }
        }

        /*
        * Called by printTabs -
        * Returns the body to each group, gets passed an array of objects that are printed
        * within a table under each group label
        * */
        function generatePanelBody(array){
            console.log(array);
            var table = $("<table>", {
                'css' : {
                    'width' : "100%"
                }
            });
            var thead = $("<thead>");
            var headRow = $("<tr>", {
                'class' : "groups-head-row"
            });
            var headItemName = $("<td>", {
               'html' : "Item",
                'css' : {"width" : "7%"}
            });
            var headItemSpacer = $("<td>", {
                'css' : {"width" : "60%"}
            });
            var headDurationName = $("<td>", {
                'html' : "Checkout Duration"
            });
            var headQuantityName = $("<td>", {
                'html' : "Quantity"
            });
            headRow.append(headItemName);
            headRow.append(headItemSpacer);
            headRow.append(headDurationName);
            headRow.append(headQuantityName);
            table.append(headRow);
            //table.append(thead);

            var tableBody = $("<tbody>");
            for(var i = 0; i < array.length; i++){
                //Table Row
                var tableRow = $("<tr>", {
                    'class' : "groups-item-row"
                });
                //Item Image Cell
                var itemImageCell = $("<td>");
                var itemImage = $("<img>", {
                    'src' : "../assets/" + array[i].img,
                    'css' : {
                        'width' : '85px',
                        'height' : '85px'
                    }
                });
                itemImageCell.append(itemImage);
                tableRow.append(itemImageCell);

                //Item Name Cell
                var itemNameCell = $("<td>", {
                    'html' : array[i].item_name
                });
                tableRow.append(itemNameCell);

                //Checkout Duration Cell
                var checkoutDurationCell = $("<td>", {
                    'html' : array[i].duration
                });
                tableRow.append(checkoutDurationCell);

                //Quantity Cell
                var quantityCell = $("<td>");
                var available = $("<div></div>", {
                    'class' : "quantity-available",
                    'html' : array[i].count
                });
                var total = $("<div></div>", {
                    'html' : "/ " + array[i].total
                });
                quantityCell.append(available);
                quantityCell.append(total);
                tableRow.append(quantityCell);

                table.append(tableRow);
            }
            table.append(tableBody);
            return table;
        }

        function toggleShow(){
            var toggleButton = $("#toggleButton");
            if(toggleButton.text() === "Show All"){
                toggleButton.html("Show Groups");
            }else{
                toggleButton.html("Show All");
            }
            $("#itemGroups").toggle(200);
            $("#resultTable").toggle(200);
        }
    </script>
</head>
<body>
<div class="container-fluid">
    <h1 id="techDeskTextHeading">Tech Desk Items Available</h1>
    <div id="toggleButtonContainer">
        <button id="toggleButton" onclick="toggleShow()">Show All</button>
    </div>
    <div id="itemGroups">
        <div class="panel-group" id="accordion">
        </div>
    </div>
    <table class="table" id="resultTable">
        <thead>
        <tr>
            <th class="col-md-8">Item</th>
            <th class="col-md-2">Checkout Duration</th>
            <th class="col-md-2">Quantity</th>
        </tr>
        </thead>
        <tbody id="resultTableBody">

        </tbody>
    </table>
</div>
</body>
<script src="../JS/bootstrap.min.js"></script>
</html>
