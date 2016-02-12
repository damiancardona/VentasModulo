$(document).ready(function () {
    $("#listado").DataTable({
        "pagingType": "full_numbers"
    });
    //loadDatos();
});

var ventas=[];

var loadDatos = function (){   
     $.ajax({
       url: "ajax/getVentas.php",
       data: "",
       dataType: "JSON",
       timeout: 300000,
       type: "POST",
       before: function(){
           $('#spinner').show();
       },
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
           $('#spinner').hide();
       }
    });
};

var actualizaGrilla = function (){
    var cadena="";
    var elemento = document.getElementById("listadoVentas");
    cadena+='<div class="col-sm-12">';
    cadena+="<table class='table table-bordered table-striped dataTable'>";
    cadena+='<tr role="row">';

    cadena+='<th>Cliente</th>';
    cadena+='<th>Fecha</th>';
    cadena+='<th>Monto</th>';
    cadena+='<th>Estado</th>';
    cadena+='<th></th>';
    cadena+='<th></th>';
    cadena+="</tr>";
    var impar = true;
    ventas.forEach(function(vta) {
        cadena += "<tr role='row' class='"+(impar?"odd":"even")+"'>";
        impar = !impar;
        cadena += "<td hidden='true'>" + vta.id + "</td>";
        cadena += "<td hidden='true'>" + vta.idCliente + "</td>";
        cadena += "<td>" + vta.cliente + "</td>";
        cadena += "<td>" + vta.fecha.substring(0, 10) + "</td>";
        cadena += "<td>$" +agregarSeparadoresDeMil( vta.total)+ "</td>";
        cadena += "<td>" + vta.estado + "</td>";
        if (vta.estado == 'PENDIENTE WEB' || vta.estado == 'SIN APROBAR WEB') {
            cadena += "<td><button onclick='editaVenta(" + vta.id + ")' class='btn btn-block btn-primary btn-sm button-accion-chico'>Editar</button>"
            cadena += "<td><button onclick='eliminaVenta(" + vta.id + ")' class='btn btn-block btn-danger btn-sm button-accion-chico'>Eliminar</button>"
        }else{
            cadena += "<td><button onclick='editaVenta(" + vta.id + ")' class='btn btn-block btn-primary btn-sm button-accion-chico'>Ver</button>"
            cadena += "<td><button onclick='' class='btn btn-block btn-danger btn-sm button-accion-chico' disabled>Eliminar</button>"
        }
        cadena+="</tr>";
    });
    cadena+="</table>";
    cadena+='</div>';
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

var agregarSeparadoresDeMil = function(numero){
    var num = parseFloat(numero);
    //multiplico por 100 para sacar los decimales y poner la coma:
    num = num * 100;
    var numeroRespuesta = "";
    var numString = num.toString();
    if(numString.length == 5){
        numeroRespuesta = numString[0]+numString[1]+numString[2]+','+numString[3]+numString[4];
    }
    else{
        var lugares = 1;
        numeroRespuesta = ','+numString[numString.length-2]+numString[numString.length-1];
        for(var i=numString.length-3; i>=0; i--){
            numeroRespuesta = numString[i]+numeroRespuesta;
            if(lugares==3 && i>0){
                lugares = 1;
                numeroRespuesta = '.'+numeroRespuesta;
            }else{
                lugares++;
            }
        }
    }

    return numeroRespuesta;
}