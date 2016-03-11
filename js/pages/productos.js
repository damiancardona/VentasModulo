var productos=[];
function clk(){

        console.log("Loading from custom function...");
}

        //EXAMPLE
function ajax_post(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "../../ajax/getProductos.php";
    var token = document.getElementById("first_name").value;
    var vars = "firstname="+token+"&lastname="+ln;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("status").innerHTML = return_data;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("status").innerHTML = "processing...";
}

function getProducts(){
    // Creo el objeto XMLHttpRequest
    var httpRequest = new XMLHttpRequest();
    // Guardo la direccion en una variable
    var url = "../../ajax/getProductos.php";

    httpRequest.open("GET", url, true);
    // Access the onreadystatechange event for the XMLHttpRequest object
    httpRequest.onreadystatechange = function() {
        if(httpRequest.readyState == 4 && httpRequest.status == 200) {
            console.log('Inicia carga');

            var return_data = JSON.parse(httpRequest.responseText);

            var arregloProd = return_data['Records'];

            arregloProd.forEach(function(entry) {
                console.log('Cargado:');
                console.log(entry);
                document.getElementById("dt").innerHTML=entry;
                productos.push(entry);
            });
            console.log('Fin carga');

            document.getElementById("dt").innerHTML ="Hay: " + arregloProd.length + " nuevos productos cargados";  
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    httpRequest.send(); // Actually execute the request
    document.getElementById("dt").innerHTML = "processing...";
}