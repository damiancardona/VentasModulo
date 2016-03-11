$(document).ready(function () {
    $('.fecha').datetimepicker();

    $('.chk-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
    $('.chk-red').iCheck({
        checkboxClass: 'icheckbox_flat-red',
        radioClass: 'iradio_flat-red'
    });
    $('.chk-orange').iCheck({
        checkboxClass: 'icheckbox_flat-orange',
        radioClass: 'iradio_flat-orange'
    });

    $("#formAccionCliente").submit(function(e){
        e.preventDefault();
        enviarPlanilla();
    });

    if($("#idPlanilla").val() != 0){
        traeDatos($("#idPlanilla").val());
    }
});

var enviarPlanilla = function(){
    //Pongo los valores

    $.ajax({
        url: "../../ajax/InformesManager.php?tipo_informe=ACCIONCLIENTE&accion=GUARDAR",
        data: $('#formAccionCliente').serialize(),
        dataType: "JSON",
        timeout: 300000,
        type: "POST",
        beforeSend: function(){
            $("#spinner").show();
        },
        success: function(response){

            if(!response.error){
                window.location = "../../pages/Planillas/listado.php";
            } else {
                alert(response.msj);
            }

        },
        error: function(xhr){
            alert("No se puede realizar la accion deseada en este momento");
            console.log(xhr)
        },
        complete: function(){
            $("#spinner").hide();
        }
    });
};

var traeDatos = function(id){

    $datos = {id_planilla: id};
    $.ajax({
        url: "../../ajax/InformesManager.php?tipo_informe=ACCIONCLIENTE&accion=GET",
        data: $datos,
        dataType: "JSON",
        timeout: 300000,
        type: "POST",
        beforeSend: function(){
            $("#spinner").show();
        },
        success: function(response){

            if(!response.error){
                actualizaCampos(response.Datos);
            } else {
                alertaGeneral("ERROR", response.msj);
            }

        },
        error: function(xhr){
            alert("No se puede realizar la accion deseada en este momento");
            console.log(xhr)
        },
        complete: function(){
            $("#spinner").hide();
        }
    });
};

var actualizaCampos = function(datos){
    var camposAray = datos.split('&')
    var campos = [];
    camposAray.forEach(function(campo){
        var campoDetalle = campo.split('=');
        if(campoDetalle!="") {
            var element = $(':input').filter(function () {
                return this.id.toLowerCase() == campoDetalle[0];
            });
            $(element).val(campoDetalle[1]);
        }
    });
    $(":checkbox").filter(function () {
        return this.value == 'True';
    }).each(function(index,element){
        $(element).iCheck('check');
    });
    $(".fecha").trigger("change");
};