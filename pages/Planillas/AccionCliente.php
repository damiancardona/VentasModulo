<?php

session_start();
include_once '../../config/permisos.php';

if (!$_SESSION['autorizado']){
    header("Location: ../inicio/index.php");
    exit;
}
if(!$permisos['Planillas']['C02'] ){
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
    <link href="../../plugins/iCheck/flat/_all.css" rel="stylesheet">
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
                CO2 - Acci&oacute;n Cliente
                <small> nueva </small>
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- /.box -->
                    <div class="box">
                        <div class="box-body">
                            <form role="form" id="formAccionCliente">
                                <input id="idPlanilla" name="idPlanilla" hidden value="<?php echo $idPlanilla ?>">
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
                                    </div>
                                </div>
                                <div class="box box-solid box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Primer Visita</h3>
                                        <div class="box-tools pull-right">
                                            <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                <i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <label for="FechaVisita1">FECHA</label>
                                                <input name="FechaVisita1" id="FechaVisita1" class="form-control datetimepicker fecha" type='text' data-date-format="DD/MM/YYYY" value="<?php echo date("d/m/Y");?>"/>
                                            </div>
                                            <div class="form-group col-md-3"></div>

                                            <div class="form-group col-md-6">
                                                <label for="">TIPO DE CLIENTE</label>
                                                <input id="" name="" class="form-control" placeholder="" type="text">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="">FIDELIZACI&Oacute;N</label>
                                                <input id="" name="" class="form-control" placeholder="" type="text">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="">PENETRACI&Oacute;N MERCADO</label>
                                                <input id="" name="" class="form-control" placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label>OBJETIVO DE LA VISITA</label>
                                                <textarea class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="">TIPO DE ACCI&Oacute;N</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <div class="form-group col-md-4">
                                                    <div class="box box-solid box-primary">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">GESTI&Oacute;N DEL VENDEDOR</h3>
                                                            <div class="box-tools pull-right">
                                                                <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                                    <i class="fa fa-minus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="box-body">
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" class="chk-blue" id="AccionVendReforzarVentaja" name="AccionVendReforzarVentaja">
                                                                            REFORZAR VENTAJAS DEL PRODUCTO
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" class="chk-blue" id="AccionVendPrecioCompetitivo" name="AccionVendPrecioCompetitivo">
                                                                            PRECIO COMPETITIVO
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" class="chk-blue" id="AccionVendStkyTiemposEntrega" name="AccionVendStkyTiemposEntrega">
                                                                            STOCK Y TIEMPOS DE ENTREGA
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" class="chk-blue" id="AccionVendReferenciaDeColegas" name="AccionVendReferenciaDeColegas">
                                                                            REFERENCIAS DE COLEGAS
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <div class="box box-solid box-danger">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">GESTI&Oacute;N COMBINADA</h3>
                                                            <div class="box-tools pull-right">
                                                                <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                                    <i class="fa fa-minus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="box-body">
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" class="chk-red" id="AccionCombDemoProd" name="AccionCombDemoProd">
                                                                            DEMOSTRACI&Oacute;N PRODUCTO
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" class="chk-red" id="AccionCombDemoGrupal" name="AccionCombDemoGrupal">
                                                                            DEMOSTRACI&Oacute;N GRUPALES
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" class="chk-red" id="AccionCombDescuentoPuntual" name="AccionCombDescuentoPuntual">
                                                                            DESCUENTO PUNTUAL
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <div class="box box-solid box-warning">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">GESTI&Oacute;N DEL VENDEDOR</h3><br><small>(CON HERRAMIENTAS COMERCIALES)</small>
                                                            <div class="box-tools pull-right">
                                                                <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                                    <i class="fa fa-minus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="box-body">
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" class="chk-orange" id="AccionVendHDescuentoSostenido" name="AccionVendHDescuentoSostenido">
                                                                            DESCUENTO SOSTENIDO
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" class="chk-orange" id="AccionVendHBonificacionSinGargo" name="AccionVendHBonificacionSinGargo">
                                                                            BONIFICACI&Oacute;N SIN CARGO
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" class="chk-orange" id="AccionVendHBonificacionCompraMensual" name="AccionVendHBonificacionCompraMensual">
                                                                            BONIFICACI&Oacute;N POR COMPRA MENSUAL
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" class="chk-orange" id="AccionVendHPlazoPago" name="AccionVendHPlazoPago">
                                                                            PLAZO DE PAGO
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>ACCION/ES POR L&Iacute;NEA DE PRODUCTO</label>
                                                <textarea class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>RESULTADO DE LAS ACCI&Oacute;NES REALIZADAS</label>
                                                <textarea class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <div class="box box-solid box-default">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">STATUS NEGOCIO</h3>
                                                        <div class="box-tools pull-right">
                                                            <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                                <i class="fa fa-minus"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="form-group col-md-4">
                                                                <label for="">A COTIZAR</label>
                                                                <input id="" name="" class="form-control" placeholder="" type="text">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="">COTIZADO</label>
                                                                <input id="" name="" class="form-control" placeholder="" type="text">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="">CERRADO</label>
                                                                <input id="" name="" class="form-control" placeholder="" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label> PR&Oacute;XIMAS VISITAS</label>
                                                <textarea class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <div class="box box-solid box-default">
                                    <div class="box-header with-border">
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <label for="">INGRESAR FECHA</label>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="">OBJETIVO DE LA VISITA</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">SEGUIMIENTO DE LA/S ACCION/ES / OTRAS ALTERNATIVAS</label>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="">RESULTADO DE LA VISITA</label>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label for="">STATUS NEGOCIO</label>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label for="">PR&Oacute;XIMAS VISITA</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <label for="FechaVisita2">Visita 2:</label>
                                                <input name="FechaVisita2" id="FechaVisita2" class="form-control datetimepicker fecha" type='text' data-date-format="DD/MM/YYYY" value=""/>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <textarea id="ObjetivoVisita2" name="ObjetivoVisita2" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <textarea id="SeguimientoVisita2" name="SeguimientoVisita2" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <textarea id="ResultadoVisita2" name="ResultadoVisita2" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <textarea id="StatusNegocioVisita2" name="StatusNegocioVisita2" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <textarea id="ProximasVisitasVisita2" name="ProximasVisitasVisita2" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <label for="FechaVisita3">Visita 3:</label>
                                                <input name="FechaVisita3" id="FechaVisita3" class="form-control datetimepicker fecha" type='text' data-date-format="DD/MM/YYYY" value=""/>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <textarea id="ObjetivoVisita3" name="ObjetivoVisita3" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <textarea id="SeguimientoVisita3" name="SeguimientoVisita3" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <textarea id="ResultadoVisita3" name="ResultadoVisita3" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <textarea id="StatusNegocioVisita3" name="StatusNegocioVisita3" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <textarea id="ProximasVisitasVisita3" name="ProximasVisitasVisita3" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <label for="FechaVisita4">Visita 4:</label>
                                                <input name="FechaVisita4" id="FechaVisita4" class="form-control datetimepicker fecha" type='text' data-date-format="DD/MM/YYYY" value=""/>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <textarea id="ObjetivoVisita4" name="ObjetivoVisita4" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <textarea id="SeguimientoVisita4" name="SeguimientoVisita4" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <textarea id="ResultadoVisita4" name="ResultadoVisita4" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <textarea id="StatusNegocioVisita4" name="StatusNegocioVisita4" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <textarea id="ProximasVisitasVisita4" name="ProximasVisitasVisita4" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <label for="FechaVisita5">Visita 5:</label>
                                                <input name="FechaVisita5" id="FechaVisita5" class="form-control datetimepicker fecha" type='text' data-date-format="DD/MM/YYYY" value=""/>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <textarea id="ObjetivoVisita5" name="ObjetivoVisita5" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <textarea id="SeguimientoVisita5" name="SeguimientoVisita5" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <textarea id="ResultadoVisita5" name="ResultadoVisita5" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <textarea id="StatusNegocioVisita5" name="StatusNegocioVisita5" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <textarea id="ProximasVisitasVisita5" name="ProximasVisitasVisita5" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <label for="FechaVisita6">Visita 6:</label>
                                                <input name="FechaVisita6" id="FechaVisita6" class="form-control datetimepicker fecha" type='text' data-date-format="DD/MM/YYYY" value=""/>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <textarea id="ObjetivoVisita6" name="ObjetivoVisita6" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <textarea id="SeguimientoVisita6" name="SeguimientoVisita6" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <textarea id="ResultadoVisita6" name="ResultadoVisita6" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <textarea id="StatusNegocioVisita6" name="StatusNegocioVisita6" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <textarea id="ProximasVisitasVisita6" name="ProximasVisitasVisita6" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <label for="FechaVisita7">Visita 7:</label>
                                                <input name="FechaVisita7" id="FechaVisita7" class="form-control datetimepicker fecha" type='text' data-date-format="DD/MM/YYYY" value=""/>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <textarea id="ObjetivoVisita7" name="ObjetivoVisita7" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <textarea id="SeguimientoVisita7" name="SeguimientoVisita7" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <textarea id="ResultadoVisita7" name="ResultadoVisita7" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <textarea id="StatusNegocioVisita7" name="StatusNegocioVisita7" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <textarea id="ProximasVisitasVisita7" name="ProximasVisitasVisita7" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="Observaciones">Observaciones:</label>
                                                <textarea id="Observaciones" name="Observaciones" class="form-control" placeholder="" style="resize: vertical;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-11"></div>
                                    <div class="col-md-1">
                                        <input type="submit" class="btn btn-lg btn-primary" <?php echo $soloVer?'disabled':''; ?> >
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="overlay" id="spinner" style="display: none">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                    <!-- /.box -->
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
<script src="../../plugins/iCheck/icheck.js"></script>
<!-- Slimscroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../../plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../../js/plugins/app.min.js" type="text/javascript"></script>
<!-- DateTime Picker -->
<script type="text/javascript" src="../../js/plugins/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript" src="../../js/pages/planillas_accionCliente.js"></script>


</body>
</html>
