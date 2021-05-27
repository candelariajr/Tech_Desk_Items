/**
 * Created by candelariajr on 8/1/2017.
 */
(function(){
    //call on startup
    getData();
    //This is supposed to be 2000
    var timeout = 2000;
    //set timeout on callback
    setInterval(function(){
        getData();
    }, timeout);

    var configState = {
        "PC Laptop" : "dell.png",
        "DSLR Camera" : "DSLR.png",
        "Chromebook" : "chromebook.png",
        "Digital Camcorder" : "vixia.png",
        "Graphing Calculator" : "calculator.png",
        "Macbook" : "macbook.png",
        "Skullcandy Headphones" : "headphones.png",
        "Zoom Audio Recorder" : "zoom.png",
        "Projector" : "ricoh.png"
    };

    //actual function used to get data
    function getData(){
        $.get("getItems.php", function(data, status){
            if(status === 'success'){
                postData(data);
            }
            else{
                //TODO: Add failover
                console.log("Request Failed!");
            }
        })
    }

    //called once data is received
    function postData(data){
        var resultObj = JSON.parse(data);
        if(resultObj[0].hasOwnProperty("call_number_case")
            && resultObj[0].hasOwnProperty("count")){
            var tableHost = $("#resultTableBody");
            tableHost.empty();
            for(var i = 0; i <= resultObj.length; i++){
                var tr = $("<tr></tr>");
                var itemLabel = $("<td></td>");
                itemLabel.attr('class', 'labelText');
                //attach label from JSON object
                //itemLabel.text(resultObj[i].call_number_case);
                var resultObjName = resultObj[i].call_number_case;
                var itemImage = $("<img>");
                itemImage.attr('class', 'imageIcon');
                if(configState.hasOwnProperty(resultObjName)){
                    itemImage.attr('src', "./assets/" + configState[resultObjName]);
                }else{
                    itemImage.attr('visibility', 'hidden');
                }
                var itemText = $("<span></span>");
                //FUCK YOU BOOTSTRAP
                itemText.css('padding-left','30px');
                itemText.text(resultObjName);
                itemLabel.append(itemImage);
                itemLabel.append(itemText);
                //attach Date.now() to the string to show names changing in real time (dumb demo #41)
                tr.append(itemLabel);

                var quantityLabel = $("<td></td>");
                //FUCK YOU BOOTSTRAP
                quantityLabel.css('padding-left','40px');
                quantityLabel.css('vertical-align','middle');
                quantityLabel.text(resultObj[i].count);
                tr.append(quantityLabel);

                tableHost.append(tr);
            }
            tableHost.append("<tr><td></td><td></td></tr>");
            console.log("Results Posted: " + Date.now())
        }else{
            //TODO: Add more description here
            console.log("criteria Failed");
        }
    }
})();
