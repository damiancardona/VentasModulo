$(document).ready(function () {     
    loadDatos();
});

var ventas=[];
function loadDatos(){
    var httpRequest = new XMLHttpRequest();
    var url = "ajax/getVentas.php";

    httpRequest.open("GET", url, true);

    httpRequest.onreadystatechange = function() {
        if(httpRequest.readyState == 4 && httpRequest.status == 200) {
            
            var return_data = JSON.parse(httpRequest.responseText);

            
            if(return_data['Result']=='OK'){

                var arregloVentas = return_data['Ventas'];

                arregloVentas.forEach(function(entry) {
                    ventas.push(entry);
                });

            }
            else{
                console.log("Error de carga:");
                console.log(return_data['Message']);
            }

        }
    }
    httpRequest.send(); // Actually execute the request

    actualizaGrilla();
}

function actualizaGrilla(){
    var cadena="";
    var elemento = document.getElementById("listadoVentas");
    ventas.forEach(function(vta){
        cadena+="<tr>";
        cadena+="<td>"+vta.id+"</td>";
        cadena+="<td>"+vta.idCliente+"</td>";
        cadena+="<td>"+vta.cliente+"</td>";
        cadena+="<td>"+vta.fecha+"</td>";
        cadena+="<td>"+vta.total+"</td>";
        cadena+="<td>"+vta.estado+"</td>";
        cadena+="</tr>";
    });
        elemento.innerHTML=cadena;
}
