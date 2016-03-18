$(document).ready(function () {
    $('.fecha').datetimepicker();
    $("#ComercializaMorelli").on('change', function(){
        if($(this).val()== "SI"){
            $("#ProductoExibidoCorrectamente").attr("disabled", false).on("change");
            $("#MotivoNoComercializaMorelli").attr("disabled", true).val('');
        }
        if($(this).val() == "NO"){
            $("#ProductoExibidoCorrectamente").attr("disabled", true).val('SI');
            $("#MotivoProductoNoExibidoCorrectamente").attr("disabled", true).val('');
            $("#MotivoNoComercializaMorelli").attr("disabled", false);
        }
    }).trigger("change");
    $("#ProductoExibidoCorrectamente").on('change', function(){
        if($(this).val()== "SI"){
            $("#MotivoProductoNoExibidoCorrectamente").attr("disabled", true).val('');
        }
        if($(this).val() == "NO"){
            $("#MotivoProductoNoExibidoCorrectamente").attr("disabled", false);
        }
    }).trigger("change");
    $("#Antiguedad").on('change', function(){
        if($(this).val() == "OTRAS"){
            $("#AntiguedadOtra").attr("disabled", false);
        }else{
            $("#AntiguedadOtra").attr("disabled", true).val('');
        }
    }).trigger("change");

    $("#formRelevamiento").submit(function(e){
        e.preventDefault();
        enviarRelevamiento($("#idPlanilla").val());
    });

    if($("#idPlanilla").val() != 0){
        traeDatos($("#idPlanilla").val());
    }
});


var enviarRelevamiento = function(id){
    //Pongo los valores

    $.ajax({
        url: "../../ajax/InformesManager.php?tipo_informe=RELEVAMIENTO&accion=GUARDAR",
        data: $('#formRelevamiento').serialize(),
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

var preinicializar = function(){

    $('#NombreVendedor').val('Damian Cardona');
    $('#NombreEmpresa').val('Mapplics Mobile Solutions');
    $('#TipoCliente').val('Sin tipo');
    $('#Fidelizacion').val('No fidelizado');
    $('#PenetracionMercado').val('Sin penetrar');
    $('#NombreContacto').val('Fernando');
    $('#NombreContactoAux').val('Casiopo');
    $('#FechaNacimientoAux').val('-');
    $('#Direccion').val('Laprida 1664');
    $('#Localidad').val('Rosario, Santa Fe');
    $('#TelefonoContacto').val('1568423699');
    $('#TelefonoContactoFijo').val('4865232');
    $('#TelefonoContactoCelular').val('3416587789');
    $('#Mail').val('qwe@qwe.com');
    $('#MercadoGastronomico').val('AuxGastronomico');
    $('#MercadoResidencial').val('Merc. Res 1');
    $('#MercadoInternet').val('Intrenet is ohline');
    $('#PotencialConsumoComprasObsv').val('sin observar');
    $('#PreferenciaResMarca1').val('MP1');
    $('#NombreEmpresaProvA').val('A_Asfcfg');
    $('#NombreProdPorMercadoProvA').val('A_KKhnu');
    $('#PorcCompraDelTotalProvA').val('A_jijfa');
    $('#PrePorLineaProvA').val('A_asd');
    $('#PlazoPagoProvA').val('A_fasdf');
    $('#NombreEmpresaProvB').val('B_Asfcfg');
    $('#NombreProdPorMercadoProvB').val('B_KKhnu');
    $('#PorcCompraDelTotalProvB').val('B_jijfa');
    $('#PrePorLineaProvB').val('B_asd');
    $('#PlazoPagoProvB').val('B_fasdf');

    $('#dtpFechaNacimiento').val('14/02/1990');
};

var alertaGeneral = function(texto, titulo){
    $('#alert_general').show();
    var txt = '';
    txt += '<h4><i class="icon fa fa-ban"></i>'+titulo+'</h4>';
    txt+=texto;
    $('#text_alert_general').html(txt);
    window.location='#';
};

var traeDatos = function(id){

    $datos = {id_planilla: id};
    $.ajax({
        url: "../../ajax/InformesManager.php?tipo_informe=RELEVAMIENTO&accion=GET",
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

    $('#ComercializaMorelli').trigger('change');
    $('#ProductoExibidoCorrectamente').trigger('change');
    $('#Antiguedad').trigger('change');
    $(".fecha").trigger("change");

};