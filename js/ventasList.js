$(document).ready(function () {     
    loadDatos();
});

var ventas=[];

var loadDatos = function (){   
     $.ajax({
       url: "ajax/getVentas.php",
       data: "",
       dataType: "JSON",
       timeout: 300000,
       type: "POST",
       success: function(response){
           if(!response.error){
                    var arregloVentas = response.Ventas;

                arregloVentas.forEach(function(entry) {
                    ventas.push(entry);
                });
                console.log(response);
                actualizaGrilla();
           } else {
               alert(response.msj);
           }

       },
       error: function(xhr){
           alert("No se puede realizar la accion deseada en este momento");
       },
       complete: function(){
       }
    });
};

var actualizaGrilla = function (){
    var cadena="";
    var elemento = document.getElementById("listadoVentas");
    cadena+="<table class='table table-hover'>";
    cadena+="<tr>";
    cadena+="<th>Cliente</th>";
    cadena+="<th>Fecha</th>";
    cadena+="<th>Monto</th>";
    cadena+="<th>Estado</th>";
    cadena+="<th></th>";
    cadena+="<th></th>";
    cadena+="</tr>";
    ventas.forEach(function(vta){
        cadena+="<tr>";
        cadena+="<td hidden='true'>"+vta.id+"</td>";
        cadena+="<td hidden='true'>"+vta.idCliente+"</td>";
        cadena+="<td>"+vta.cliente+"</td>";
        cadena+="<td style='width: 180px'>"+vta.fecha+"</td>";
        cadena+="<td style='width: 100px'>$"+vta.total+"</td>";
        cadena+="<td>"+vta.estado+"</td>";
        cadena+="<td style='width: 70px'><button onclick='editaVenta("+vta.id+")' class='btn btn-block btn-primary btn-sm button-accion-chico'>Editar</button>"
        cadena+="<td style='width: 70px'><button onclick='eliminaVenta("+vta.id+")' class='btn btn-block btn-danger btn-sm button-accion-chico'>Eliminar</button>"
        cadena+="</tr>";
    });
    cadena+="</table>";
        elemento.innerHTML=cadena;
};

var eliminaVenta = function(id_vta){
    var dataObj = { id_vta: JSON.stringify(id_vta) };
    $.ajax({
       url: "ajax/eliminaVenta.php",
       data: dataObj,
       dataType: "JSON",
       timeout: 300000,
       type: "POST",
       success: function(response){

           if(!response.error){
            alert("la venta fue eliminada");                
           } else {
               alert(response.msj);
           }

       },
       error: function(xhr){
           alert("No se puede realizar la accion deseada en este momento");
       },
       complete: function(){
       }
    });

    ventas = [];
    loadDatos();
};

var editaVenta = function(id_vta){
    window.location.assign("nuevaVenta.php?idVta="+id_vta);
};
