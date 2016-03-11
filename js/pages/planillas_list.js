$(document).ready(function () {
    $("#listado").DataTable({
        "pagingType": "full_numbers"
    });
    //loadDatos();
});

var planillas=[];

var loadDatos = function (){
    var datos = {
        id_tipo: $("#idTipoPlanilla").val(),
        id_vendedor: $("#idVendedor").val()
    };
    $.ajax({
        url: "../../ajax/InformesManager.php?accion=LISTAR",
        data: datos,
        dataType: "JSON",
        timeout: 300000,
        type: "POST",
        before: function(){
            $('#spinnerTabla').show();
            $('#spinnerFiltro').show();
        },
        success: function(response){
            if(!response.error){
                planillas = [];
                var arregloPlanillas = response.Planillas;

                arregloPlanillas.forEach(function(entry) {
                    planillas.push(entry);
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
            $('#spinnerTabla').hide();
            $('#spinnerFiltro').hide();
        }
    });
};

var actualizaGrilla = function (){
    var hayPlanillas = false;
    var cadena="";

    var elemento = document.getElementById("listado");
    cadena+="<thead>";
    cadena+="<tr>";
    cadena+="<th>Vendedor</th>";
    cadena+="<th>Tipo Planilla</th>";
    cadena+="<th>Detalle</th>";
    cadena+="<th></th>";
    cadena+="<th></th>";
    cadena+="</tr>";
    cadena+="</thead>";
    cadena+="<tbody>";
    planillas.forEach(function(pnlla) {
        hayPlanillas = true;
        cadena += ' <tr>';
        cadena += ' <td>'+pnlla.usuario+'</td>';
        cadena += ' <td>'+pnlla.descripcion+'</td>';
        cadena += ' <td>'+pnlla.datoAdic+'</td>';
        cadena += "<td><button onclick='editaPlanilla("+pnlla.id+", "+pnlla.idTipo+")' class='btn btn-block btn-primary btn-sm button-accion-chico' >Abrir</button>";
        cadena += "<td><button onclick='eliminaPlanilla("+pnlla.id+", "+pnlla.idTipo+")' class='btn btn-block btn-danger btn-sm button-accion-chico'>Eliminar</button>";
        cadena += ' </tr>';
    });
    cadena+="</tbody>";
    elemento.innerHTML=cadena;
    if(hayPlanillas){
        $('#tableContainer').show();
        $('#sin_Planillas').hide();
    }else{
        $('#tableContainer').hide();
        $('#sin_Planillas').show();
    }
};

var eliminaPlanilla = function(id_pnlla, id_tipo){
    var dataObj = { id_planilla: JSON.stringify(id_pnlla),id_tipo: JSON.stringify(id_tipo) };
    $.ajax({
        url: "../../ajax/InformesManager.php?accion=ELIMINAR",
        data: dataObj,
        dataType: "JSON",
        timeout: 300000,
        type: "POST",
        before: function(){
            $('#spinnerTabla').show();
        },
        success: function(response){

            if(!response.error){
                alert("La planilla se elimino correctamente");
                loadDatos();
            } else {
                alert(response.msj);
            }

        },
        error: function(xhr){
            alert("No se puede realizar la accion deseada en este momento");
        },
        complete: function(){
            $('#spinnerTabla').hide();
        }
    });
};

var editaPlanilla = function(id_planilla, tipo){
    switch(tipo){
        case 1:
            window.location.assign("Relevamiento.php?idPlanilla="+id_planilla);
            break;
        case 2:
            window.location.assign("AccionCliente.php?idPlanilla="+id_planilla);
            break;
        case 3:
            window.location.assign("Visita.php?idPlanilla="+id_planilla);
            break;
        default:
            break;
    }
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
};

//spinnerFiltro
//spinnerTabla
