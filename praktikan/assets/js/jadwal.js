function showUser(str){			
    if (str == "") {
        document.getElementById("jadwal").innerHTML = "No data to be shown";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("jadwal").innerHTML = xmlhttp.responseText;
        }
    };

    xmlhttp.open("GET","getschedule.php?q="+str,true);
    console.log(str);
    xmlhttp.send();

    }
}