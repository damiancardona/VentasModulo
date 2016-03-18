<?php

session_start();

include_once '../../config/permisos.php';

if (!$_SESSION['autorizado']){
    header("Location: ../inicio/index.php");
    exit;
}


if(!$permisos['Planillas']['C03'] ){
    header("Location: ../inicio/main.php");
}

$soloVer = $_SESSION['usrrolid'] != "VEND" && $_SESSION['usrrolid'] != "SADM";

$idPlanilla = 0;
if(isset($_GET['idPlanilla'])){
    $idPlanilla = $_GET['idPlanilla'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include '../layouts/comun_heads.php' ?>
    <link href="../../css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
</head>
<body class="skin-blue">
<div class="wrapper">
    <!-- MENU -->
    <?php include '../layouts/sidebar_menu.php' ?>
    <!-- /MENU -->
    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                CO3 - Visita
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- /.box -->
                    <div class="box">
                        <div class="box-body">
                            <form role="form" id="formVisita">
                                <input id="idPlanilla" name="idPlanilla" hidden value="<?php echo $idPlanilla ?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-solid box-default">
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="form-group col-md-5">
                                                        <label for="Comercial">COMERCIAL</label>
                                                        <input id="Comercial" name="Comercial" class="form-control" placeholder="" type="text">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="Cliente">CLIENTE</label>
                                                        <input id="Cliente" name="Cliente" class="form-control" placeholder="" type="text">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="NumeroCuenta">N&Uacute;MERO DE CUENTA</label>
                                                        <input id="NumeroCuenta" name="NumeroCuenta" class="form-control" placeholder="" type="text">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <label for="Periodo">PER&Iacute;ODO</label>
                                                        <input name="Periodo" id="Periodo" class="form-control datetimepicker fecha-periodo" type='text' data-date-format="DD/MM/YYYY" value=""/>
                                                        <input name="periodo_desde" id="periodo_desde" hidden>
                                                        <input name="periodo_hasta" id="periodo_hasta" hidden>
                                                    </div>
                                                    <div class="form-group col-md-9">
                                                        <label for="RepresentanteComercial">REPRESENTANTE COMERCIAL</label>
                                                        <input id="RepresentanteComercial" name="RepresentanteComercial" class="form-control" placeholder="" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="box box-solid box-default">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Lunes</h3>
                                                <div class="box-tools pull-right">
                                                    <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                        <i class="fa fa-minus"></i></button>
                                                </div>
                                            </div>
                                            <div class="box-body panel-semana">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">MA&Ntilde;ANA</h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <label>Ciudad</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Visita por</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="LunesMC1" name="LunesMC1" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="LunesMC1opt" name="LunesMC1opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="LunesMC2" name="LunesMC2" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="LunesMC2opt" name="LunesMC2opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="LunesMC3" name="LunesMC3" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="LunesMC3opt" name="LunesMC3opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="LunesMC4" name="LunesMC4" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="LunesMC4opt" name="LunesMC4opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="LunesMC5" name="LunesMC5" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="LunesMC5opt" name="LunesMC5opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="LunesMC6" name="LunesMC6" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="LunesMC6opt" name="LunesMC6opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">TARDE</h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <label>Ciudad</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Visita por</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="LunesTC1" name="LunesTC1" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="LunesTC1opt" name="LunesTC1opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="LunesTC2" name="LunesTC2" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="LunesTC2opt" name="LunesTC2opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="LunesTC3" name="LunesTC3" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="LunesTC3opt" name="LunesTC3opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="LunesTC4" name="LunesTC4" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="LunesTC4opt" name="LunesTC4opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="LunesTC5" name="LunesTC5" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="LunesTC5opt" name="LunesTC5opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="LunesTC6" name="LunesTC6" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="LunesTC6opt" name="LunesTC6opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box box-solid box-default">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Martes</h3>
                                                <div class="box-tools pull-right">
                                                    <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                        <i class="fa fa-minus"></i></button>
                                                </div>
                                            </div>
                                            <div class="box-body panel-semana">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">MA&Ntilde;ANA</h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <label>Ciudad</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Visita por</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MartesMC1" name="MartesMC1" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MartesMC1opt" name="MartesMC1opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MartesMC2" name="MartesMC2" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MartesMC2opt" name="MartesMC2opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MartesMC3" name="MartesMC3" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MartesMC3opt" name="MartesMC3opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MartesMC4" name="MartesMC4" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MartesMC4opt" name="MartesMC4opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MartesMC5" name="MartesMC5" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MartesMC5opt" name="MartesMC5opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MartesMC6" name="MartesMC6" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MartesMC6opt" name="MartesMC6opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">TARDE</h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <label>Ciudad</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Visita por</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MartesTC1" name="MartesTC1" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MartesTC1opt" name="MartesTC1opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MartesTC2" name="MartesTC2" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MartesTC2opt" name="MartesTC2opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MartesTC3" name="MartesTC3" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MartesTC3opt" name="MartesTC3opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MartesTC4" name="MartesTC4" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MartesTC4opt" name="MartesTC4opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MartesTC5" name="MartesTC5" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MartesTC5opt" name="MartesTC5opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MartesTC6" name="MartesTC6" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MartesTC6opt" name="MartesTC6opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box box-solid box-default">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Mi&eacute;rcoles</h3>
                                                <div class="box-tools pull-right">
                                                    <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                        <i class="fa fa-minus"></i></button>
                                                </div>
                                            </div>
                                            <div class="box-body panel-semana">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">MA&Ntilde;ANA</h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <label>Ciudad</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Visita por</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MiercolesMC1" name="MiercolesMC1" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MiercolesMC1opt" name="MiercolesMC1opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MiercolesMC2" name="MiercolesMC2" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MiercolesMC2opt" name="MiercolesMC2opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MiercolesMC3" name="MiercolesMC3" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MiercolesMC3opt" name="MiercolesMC3opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MiercolesMC4" name="MiercolesMC4" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MiercolesMC4opt" name="MiercolesMC4opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MiercolesMC5" name="MiercolesMC5" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MiercolesMC5opt" name="MiercolesMC5opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MiercolesMC6" name="MiercolesMC6" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MiercolesMC6opt" name="MiercolesMC6opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">TARDE</h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <label>Ciudad</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Visita por</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id=txtMiercolesTC1"" name="MiercolesTC1" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MiercolesTC1opt" name="MiercolesTC1opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MiercolesTC2" name="MiercolesTC2" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MiercolesTC2opt" name="MiercolesTC2opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MiercolesTC3" name="MiercolesTC3" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MiercolesTC3opt" name="MiercolesTC3opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MiercolesTC4" name="MiercolesTC4" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MiercolesTC4opt" name="MiercolesTC4opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MiercolesTC5" name="MiercolesTC5" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MiercolesTC5opt" name="MiercolesTC5opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="MiercolesTC6" name="MiercolesTC6" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="MiercolesTC6opt" name="MiercolesTC6opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box box-solid box-default">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Jueves</h3>
                                                <div class="box-tools pull-right">
                                                    <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                        <i class="fa fa-minus"></i></button>
                                                </div>
                                            </div>
                                            <div class="box-body panel-semana">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">MA&Ntilde;ANA</h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <label>Ciudad</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Visita por</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="JuevesMC1" name="JuevesMC1" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="JuevesMC1opt" name="JuevesMC1opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="JuevesMC2" name="JuevesMC2" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="JuevesMC2opt" name="JuevesMC2opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="JuevesMC3" name="JuevesMC3" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="JuevesMC3opt" name="JuevesMC3opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="JuevesMC4" name="JuevesMC4" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="JuevesMC4opt" name="JuevesMC4opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="JuevesMC5" name="JuevesMC5" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="JuevesMC5opt" name="JuevesMC5opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="JuevesMC6" name="JuevesMC6" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="JuevesMC6opt" name="JuevesMC6opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">TARDE</h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <label>Ciudad</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Visita por</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="JuevesTC1" name="JuevesTC1" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="JuevesTC1opt" name="JuevesTC1opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="JuevesTC2" name="JuevesTC2" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="JuevesTC2opt" name="JuevesTC2opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="JuevesTC3" name="JuevesTC3" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="JuevesTC3opt" name="JuevesTC3opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="JuevesTC4" name="JuevesTC4" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="JuevesTC4opt" name="JuevesTC4opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="JuevesTC5" name="JuevesTC5" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="JuevesTC5opt" name="JuevesTC5opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="JuevesTC6" name="JuevesTC6" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="JuevesTC6opt" name="JuevesTC6opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box box-solid box-default">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Viernes</h3>
                                                <div class="box-tools pull-right">
                                                    <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                        <i class="fa fa-minus"></i></button>
                                                </div>
                                            </div>
                                            <div class="box-body panel-semana">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">MA&Ntilde;ANA</h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <label>Ciudad</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Visita por</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="ViernesMC1" name="ViernesMC1" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="ViernesMC1opt" name="ViernesMC1opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="ViernesMC2" name="ViernesMC2" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="ViernesMC2opt" name="ViernesMC2opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="ViernesMC3" name="ViernesMC3" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="ViernesMC3opt" name="ViernesMC3opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="ViernesMC4" name="ViernesMC4" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="ViernesMC4opt" name="ViernesMC4opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="ViernesMC5" name="ViernesMC5" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="ViernesMC5opt" name="ViernesMC5opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="ViernesMC6" name="ViernesMC6" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="ViernesMC6opt" name="ViernesMC6opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">TARDE</h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <label>Ciudad</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Visita por</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="ViernesTC1" name="ViernesTC1" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="ViernesTC1opt" name="ViernesTC1opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="ViernesTC2" name="ViernesTC2" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="ViernesTC2opt" name="ViernesTC2opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="ViernesTC3|" name="ViernesTC3|" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="ViernesTC3|opt" name="ViernesTC3|opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="ViernesTC4" name="ViernesTC4" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="ViernesTC4opt" name="ViernesTC4opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="ViernesTC5" name="ViernesTC5" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="ViernesTC5opt" name="ViernesTC5opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="ViernesTC6" name="ViernesTC6" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="ViernesTC6opt" name="ViernesTC6opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box box-solid box-default">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">S&aacute;bado</h3>
                                                <div class="box-tools pull-right">
                                                    <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                        <i class="fa fa-minus"></i></button>
                                                </div>
                                            </div>
                                            <div class="box-body panel-semana">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">MA&Ntilde;ANA</h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <label>Ciudad</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Visita por</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="SabadoMC1" name="SabadoMC1" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="SabadoMC1opt" name="SabadoMC1opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="SabadoMC2" name="SabadoMC2" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="SabadoMC2opt" name="SabadoMC2opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="SabadoMC3" name="SabadoMC3" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="SabadoMC3opt" name="SabadoMC3opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="SabadoMC4" name="SabadoMC4" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="SabadoMC4opt" name="SabadoMC4opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="SabadoMC5" name="SabadoMC5" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="SabadoMC5opt" name="SabadoMC5opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="SabadoMC6" name="SabadoMC6" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="SabadoMC6opt" name="SabadoMC6opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">TARDE</h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <label>Ciudad</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Visita por</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="SabadoTC1" name="SabadoTC1" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="SabadoTC1opt" name="SabadoTC1opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="SabadoTC2" name="SabadoTC2" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="SabadoTC2opt" name="SabadoTC2opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="SabadoTC3" name="SabadoTC3" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="SabadoTC3opt" name="SabadoTC3opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="SabadoTC4" name="SabadoTC4" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="SabadoTC4opt" name="SabadoTC4opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="SabadoTC5" name="SabadoTC5" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="SabadoTC5opt" name="SabadoTC5opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input id="SabadoTC6" name="SabadoTC6" class="form-control" placeholder="" type="text">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="SabadoTC6opt" name="SabadoTC6opt" class="form-control">
                                                                            <option  value="-" selected>-</option>
                                                                            <option value="F" >F</option>
                                                                            <option value="C" >C</option>
                                                                            <option value="P" >P</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="Observaciones">Observaciones:</label>
                                        <textarea id="Observaciones" name="Observaciones" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-11"></div>
                                    <div class="col-md-1">
                                        <input type="submit" class="btn btn-lg btn-primary" <?php echo $soloVer?'disabled':''; ?>>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="overlay" id="spinner" style="display: none">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- FOOTER -->
    <?php include '../layouts/footer.php' ?>
    <!-- /FOOTER -->
</div><!-- ./wrapper -->
<!-- jQuery 2.1.3 -->
<script src="../../js/plugins/jquery.min.js"></script>
<!-- Moment -->
<script type="text/javascript" src="../../js/plugins/moment.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="../../js/plugins/bootstrap.min.js" type="text/javascript"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<!-- Slimscroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../../plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../../js/plugins/app.min.js" type="text/javascript"></script>
<!-- DateTime Picker -->
<script type="text/javascript" src="../../js/plugins/bootstrap-datetimepicker.min.js"></script>
<!-- DateTime Picker -->
<script type="text/javascript" src="../../plugins/daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="../../js/pages/planillas_visita.js"></script>


</body>
</html>
