$(document).ready(function () {
    $('.fecha').datetimepicker();

    $("#formVisita").submit(function(e){
            e.preventDefault();
            enviarRelevamiento();
    });


    var fInicio = new Date();
    var inicio_dd = fInicio.getDate();
    var inicio_mm = fInicio.getMonth()+1;
    var inicio_yyyy = fInicio.getFullYear();
    if(inicio_dd<10){
        inicio_dd='0'+inicio_dd
    }
    if(inicio_mm<10){
        inicio_mm='0'+inicio_mm
    }
    var fIniciostr = inicio_dd+'/'+inicio_mm+'/'+inicio_yyyy;

    var fFin = new Date();
    fFin.setDate(fFin.getDate() + 60);
    var fin_dd = fFin.getDate();
    var fin_mm = fFin.getMonth()+1;
    var fin_yyyy = fFin.getFullYear();
    if(fin_dd<10){
        fin_dd='0'+fin_dd
    }
    if(fin_mm<10){
        fin_mm='0'+fin_mm
    }
    var fFinstr = fin_dd+'/'+fin_mm+'/'+fin_yyyy;

    $('#Periodo').daterangepicker(
        {
            startDate: fIniciostr,
            endDate: fFinstr,
            format: 'DD/MM/YYYY'
        },
        function(start, end, label) {
            $("#periodo_desde").val(start.format('DD/MM/YYYY'));
            $("#periodo_hasta").val(end.format('DD/MM/YYYY'));
        }).val(fIniciostr+" - "+fFinstr);

    if($("#idPlanilla").val() != 0){
        traeDatos($("#idPlanilla").val());
    }
});

var enviarRelevamiento = function(){
    //Pongo los valores
    $.ajax({
        url: "../../ajax/InformesManager.php?tipo_informe=VISITA&accion=GUARDAR",
        data: $('#formVisita').serialize(),
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
        url: "../../ajax/InformesManager.php?tipo_informe=VISITA&accion=GET",
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

    var fIniciostr = $("#periodo_desde").val().substring(0, 10);
    var fFinstr = $("#periodo_hasta").val().substring(0, 10);
    $('#Periodo').daterangepicker(
        {
            startDate: fIniciostr,
            endDate: fFinstr,
            format: 'DD/MM/YYYY'
        }).val(fIniciostr+" - "+fFinstr);

};