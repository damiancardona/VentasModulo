<?php

session_start();

include_once '../../config/permisos.php';

if (!$_SESSION['autorizado']){
    header("Location: ../inicio/index.php");
    exit;
}

if(!$permisos['Planillas']['C01'] ){
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
                CO1 - Relevamiento
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
                            <div class="alert alert-danger alert-dismissible" id="alert_general" style="display: none">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                <p id="text_alert_general">
                                </p>
                            </div>
                            <form role="form" id="formRelevamiento">
                                <input id="idPlanilla" name="idPlanilla" hidden value="<?php echo $idPlanilla ?>">
                                <div class="box box-solid box-default">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label for="Fecha">FECHA DE ARMADO / ACTUALIZACI&Oacute;N DEL REPORTE</label>
                                                <input name="Fecha" id="Fecha" class="form-control datetimepicker fecha" type='text' data-date-format="DD/MM/YYYY" value="<?php echo date("d/m/Y");?>"/>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="NombreVendedor">NOMBRE DEL VENDEDOR</label>
                                                <input id="NombreVendedor" name="NombreVendedor" class="form-control" placeholder="NOMBRE DEL VENDEDOR" type="text">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="TieneCuenta" >TIENE CUENTA EN MORELLI</label>
                                                <select id="TieneCuenta"  name="TieneCuenta" class="form-control">
                                                    <option selected value="true">SI</option>
                                                    <option value="false">NO</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box box-solid box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Datos Personales</h3>
                                        <div class="box-tools pull-right">
                                            <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                <i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label for="NombreEmpresa">NOMBRE DE LA EMPRESA</label>
                                                <input id="NombreEmpresa"  name="NombreEmpresa" class="form-control" placeholder="" type="text">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="TipoCliente">TIPO DE CLIENTE</label>
                                                <input id="TipoCliente"  name="TipoCliente" class="form-control" placeholder="" type="text">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="Fidelizacion">FIDELIZACI&Oacute;N</label>
                                                <input id="Fidelizacion"  name="Fidelizacion" class="form-control" placeholder="" type="text">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="PenetracionMercado">PENETRACI&Oacute;N MERCADO</label>
                                                <input id="PenetracionMercado"  name="PenetracionMercado" class="form-control" placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label for="NombreContacto">NOMBRE DEL CONTACTO</label>
                                                <input id="NombreContacto"  name="NombreContacto" class="form-control" placeholder="" type="text">
                                            </div>
                                            <div class="form-group col-md-7">
                                                <label for="NombreContactoAux">&nbsp;</label>
                                                <input id="NombreContactoAux"  name="NombreContactoAux" class="form-control" placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="FechaNacimiento">FECHA DE NACIMIENTO</label>
                                                <input name="FechaNacimiento" id="FechaNacimiento" class="form-control datetimepicker fecha" type='text' data-date-format="DD/MM/YYYY" value="01/01/1900"/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="FechaNacimientoAux">&nbsp;</label>
                                                <input id="FechaNacimientoAux"  name="FechaNacimientoAux" class="form-control" placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="Direccion">DIRECCI&Oacute;N</label>
                                                <input id="Direccion"  name="Direccion" class="form-control" placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="Localidad">LOCALIDAD</label>
                                                <input id="Localidad"  name="Localidad" class="form-control" placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <label for="TipoContacto" >TIPO DE CONTACTO</label>
                                                <select id="TipoContacto" name="TipoContacto" class="form-control">
                                                    <option value="PERSONAL" selected>PERSONAL</option>
                                                    <option value="TRABAJO" >TRABAJO</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="TelefonoContacto">TEL&Eacute;FONO DE CONTACTO</label>
                                                <input id="TelefonoContacto"  name="TelefonoContacto" class="form-control" placeholder="" type="text">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="TelefonoContactoFijo">FIJO</label>
                                                <input id="TelefonoContactoFijo"  name="TelefonoContactoFijo" class="form-control" placeholder="" type="text">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="TelefonoContactoCelular">CELULAR</label>
                                                <input id="TelefonoContactoCelular"  name="TelefonoContactoCelular" class="form-control" placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-8">
                                                <label for="Mail">CORREO ELECTR&Oacute;NICO</label>
                                                <input id="Mail"  name="Mail" class="form-control" placeholder="" type="text">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="RecibeMails">LE INTERESA RECIBIR INFORMACI&Oacute;N POR MAIL</label>
                                                <select id="RecibeMails"  name="RecibeMails" class="form-control">
                                                    <option selected value="true">SI</option>
                                                    <option value="false">NO</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <div class="box box-solid box-warning">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Datos Generales</h3>
                                        <div class="box-tools pull-right">
                                            <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                <i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <div class="box box-solid box-default">
                                                    <div class="box-header">
                                                        <h6 class="box-title">MERCADO OBJETIVO</h6>
                                                    </div>
                                                    <div class="box-body with-border">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <div class="col-md-6">
                                                                    <label for="MercadoGastronomicoOpt">GASTRON&Oacute;MICO</label>
                                                                    <select id="MercadoGastronomicoOpt"  name="MercadoGastronomicoOpt" class="form-control">
                                                                        <option value="A" SELECTED>ESPECIALIZADO</option>
                                                                        <option value="B">VENTA POR D&Iacute;A</option>
                                                                        <option value="C">LOCALES DE LA MARCA</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="MercadoGastronomico">&nbsp;</label>
                                                                    <input id="MercadoGastronomico"  name="MercadoGastronomico" class="form-control" placeholder="" type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <div class="col-md-6">
                                                                    <label for="MercadoResidencialOpt">RESIDENCIAL</label>
                                                                    <select id="MercadoResidencialOpt"  name="MercadoResidencialOpt" class="form-control">
                                                                        <option value="A" SELECTED>HOGAR</option>
                                                                        <option value="B">SUPERMERCADO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="MercadoResidencial">&nbsp;</label>
                                                                    <input id="MercadoResidencial"  name="MercadoResidencial" class="form-control" placeholder="" type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <div class="col-md-12">
                                                                    <label for="MercadoInternet">INTERNET</label>
                                                                    <input id="MercadoInternet"  name="MercadoInternet" class="form-control" placeholder="" type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="ImagenDelLocal">IMAGEN DEL LOCAL</label>
                                                <select id="ImagenDelLocal"  name="ImagenDelLocal" class="form-control">
                                                    <option value="MUY BUENO">MUY BUENO</option>
                                                    <option value="BUENO" selected>BUENO</option>
                                                    <option value="REGULAR">REGULAR</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="ComercializaMorelli">COMERCIALIZA PRODUCTOS MORELLI</label>
                                                    <select id="ComercializaMorelli"  name="ComercializaMorelli" class="form-control">
                                                        <option value="SI" selected>SI</option>
                                                        <option value="NO">NO</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="MotivoNoComercializaMorelli">&nbsp;</label>
                                                    <input id="MotivoNoComercializaMorelli"  name="MotivoNoComercializaMorelli" class="form-control" placeholder="&iquest;Por qu&eacute; no?" type="text">
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="ProductoExibidoCorrectamente">NUESTRO PRODUCTO ESTA EXHIBIDO CORRECTAMENTE</label>
                                                    <select id="ProductoExibidoCorrectamente"  name="ProductoExibidoCorrectamente" class="form-control">
                                                        <option value="SI" selected>SI</option>
                                                        <option value="NO">NO</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="MotivoProductoNoExibidoCorrectamente">&nbsp;</label>
                                                    <input id="MotivoProductoNoExibidoCorrectamente"  name="MotivoProductoNoExibidoCorrectamente" class="form-control" placeholder="&iquest;Por qu&eacute; no?" type="text">
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="PotencialConsumoCompras">POTENCIAL DE CONSUMO (COMPRAS)</label>
                                                <select id="PotencialConsumoCompras"  name="PotencialConsumoCompras" class="form-control">
                                                    <option value="ALTO">ALTO</option>
                                                    <option value="MEDIO" selected>MEDIO</option>
                                                    <option value="BAJO">BAJO</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label for="PotencialConsumoComprasObsv">&nbsp;</label>
                                                <input id="PotencialConsumoComprasObsv"  name="PotencialConsumoComprasObsv" class="form-control" placeholder="Observaciones" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="CantidadTrabajadores">CANTIDAD DE TRABAJADORES</label>
                                                <select id="CantidadTrabajadores"  name="CantidadTrabajadores" class="form-control">
                                                    <option value="0 A 10">0 A10</option>
                                                    <option value="11 A 20" selected>11 A 20</option>
                                                    <option value="20 A 50">20 A 50</option>
                                                    <option value="MAS DE 50">M&Aacute;S DE 50</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="Antiguedad">ANTIG&Uuml;EDAD DE MORELLI COMO CLIENTE</label>
                                                <select id="Antiguedad"  name="Antiguedad" class="form-control">
                                                    <option value="NO TIENE CUENTA">NO TIENE CUENTA</option>
                                                    <option value="1 ANO" selected>1 A&Ntilde;O</option>
                                                    <option value="1 A 5">1 A 5</option>
                                                    <option value="5 A 10">5 A 10</option>
                                                    <option value="MAS 10">M&Aacute;S 10</option>
                                                    <option value="OTRAS">OTRAS</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="AntiguedadOtra"></label>
                                                <input id="AntiguedadOtra"  name="AntiguedadOtra" class="form-control" placeholder="Otras..." type="text">
                                            </div>
                                        </div>
                                        <div class="row">

                                        </div>
                                        <div class="row">

                                        </div>
                                        <div class="row">

                                        </div>
                                        <div class="row">

                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <div class="box box-solid box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Datos Comerciales</h3>
                                        <div class="box-tools pull-right">
                                            <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                <i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <div class="box box-solid box-info">
                                                    <div class="box-header">
                                                        <h6 class="box-title">MARCAS POR MERCADO</h6>
                                                        <div class="box-tools pull-right">
                                                            <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                                <i class="fa fa-minus"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="box-body with-border">
                                                        <div class="row">
                                                            <label class="form-group col-md-12">PREFERENCIAS DE MARCA:</label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <div class="form-group col-md-6">
                                                                    <label for="">RESIDENCIAL</label>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <input id="PreferenciaResMarca1"  name="PreferenciaResMarca1" class="form-control" placeholder="MARCA:" type="text">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <input id="PreferenciaResOtro1"  name="PreferenciaResOtro1" class="form-control" placeholder="OTRAS:" type="text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <input id="PreferenciaResMarca2"  name="PreferenciaResMarca2" class="form-control" placeholder="MARCA:" type="text">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <input id="PreferenciaResOtro2"  name="PreferenciaResOtro2" class="form-control" placeholder="OTRAS:" type="text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <input id="PreferenciaResMarca3"  name="PreferenciaResMarca3" class="form-control" placeholder="MARCA:" type="text">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <input id="PreferenciaResOtro3"  name="PreferenciaResOtro3" class="form-control" placeholder="OTRAS:" type="text">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">GASTRON&Oacute;MICO</label>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <input id="PreferenciaGastMarca1"  name="PreferenciaGastMarca1" class="form-control" placeholder="MARCA:" type="text">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <input id="PreferenciaGastOtro1"  name="PreferenciaGastOtro1" class="form-control" placeholder="OTRAS:" type="text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <input id="PreferenciaGastMarca2"  name="PreferenciaGastMarca2" class="form-control" placeholder="MARCA:" type="text">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <input id="PreferenciaGastOtro2"  name="PreferenciaGastOtro2" class="form-control" placeholder="OTRAS:" type="text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <input id="PreferenciaGastMarca3"  name="PreferenciaGastMarca3" class="form-control" placeholder="MARCA:" type="text">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <input id="PreferenciaGastOtro3"  name="PreferenciaGastOtro3" class="form-control" placeholder="OTRAS:" type="text">
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
                                                <div class="box box-solid box-info">
                                                    <div class="box-header">
                                                        <h6 class="box-title">L&Iacute;NEA DE PRODUCTOS</h6>
                                                        <div class="box-tools pull-right">
                                                            <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                                <i class="fa fa-minus"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="box-body with-border">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <div class="box box-solid box-default">
                                                                    <div class="box-header">
                                                                        <h7 class="box-title">PROVEEDOR A</h7>
                                                                        <div class="box-tools pull-right">
                                                                            <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                                                <i class="fa fa-minus"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="box-body with-border">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="NombreEmpresaProvA">NOMBRE DE LA EMPRESA PROVEEDORA A</label>
                                                                                <input id="NombreEmpresaProvA"  name="NombreEmpresaProvA" class="form-control" placeholder="" type="text">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="NombreProdPorMercadoProvA">NOMBRE DEL PRODUCTO/S POR MERCADO</label>
                                                                                <input id="NombreProdPorMercadoProvA"  name="NombreProdPorMercadoProvA" class="form-control" placeholder="" type="text">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="PorcCompraDelTotalProvA">INGRESAR QUE PORCENTAJE COMPRA DEL TOTAL</label>
                                                                                <input id="PorcCompraDelTotalProvA"  name="PorcCompraDelTotalProvA" class="form-control" placeholder="" type="text">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="PrePorLineaProvA">PRECIOS - ACLARAR POR L&Iacute;NEA DE PRODUCTO</label>
                                                                                <input id="PrePorLineaProvA"  name="PrePorLineaProvA" class="form-control" placeholder="" type="text">
                                                                            </div>
                                                                            <div class="form-group col-md-12">
                                                                                <label for="PlazoPagoProvA">PLAZO DE PAGO</label>
                                                                                <input id="PlazoPagoProvA"  name="PlazoPagoProvA" class="form-control" placeholder="" type="text">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <div class="box box-solid box-default">
                                                                    <div class="box-header">
                                                                        <h6 class="box-title">PROVEEDOR B</h6>
                                                                        <div class="box-tools pull-right">
                                                                            <button data-original-title="Collapse" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                                                                                <i class="fa fa-minus"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="box-body with-border">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="NombreEmpresaProvB">NOMBRE DE LA EMPRESA PROVEEDORA B</label>
                                                                                <input id="NombreEmpresaProvB"  name="NombreEmpresaProvB" class="form-control" placeholder="" type="text">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="NombreProdPorMercadoProvB">NOMBRE DEL PRODUCTO/S POR MERCADO</label>
                                                                                <input id="NombreProdPorMercadoProvB"  name="NombreProdPorMercadoProvB" class="form-control" placeholder="" type="text">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="PorcCompraDelTotalProvB">INGRESAR QUE PORCENTAJE COMPRA DEL TOTAL</label>
                                                                                <input id="PorcCompraDelTotalProvB"  name="PorcCompraDelTotalProvB" class="form-control" placeholder="" type="text">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="PrePorLineaProvB">PRECIOS - ACLARAR POR L&Iacute;NEA DE PRODUCTO</label>
                                                                                <input id="PrePorLineaProvB"  name="PrePorLineaProvB" class="form-control" placeholder="" type="text">
                                                                            </div>
                                                                            <div class="form-group col-md-12">
                                                                                <label for="PlazoPagoProvB">PLAZO DE PAGO</label>
                                                                                <input id="PlazoPagoProvB"  name="PlazoPagoProvB" class="form-control" placeholder="" type="text">
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
<!-- Slimscroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../../plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../../js/plugins/app.min.js" type="text/javascript"></script>
<!-- DateTime Picker -->
<script type="text/javascript" src="../../js/plugins/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript" src="../../js/pages/planillas_relevamiento.js"></script>

</body>
</html>
