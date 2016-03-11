<?php

session_start();
include_once '../../config/permisos.php';

if (!$_SESSION['autorizado']){
    header("Location: ../inicio/index.php");
    exit;
}

if(!$permisos['Planillas']['listado'] ){
    header("Location: ../inicio/main.php");
}

$hayPlanillas=false;
try
{
    //SET WS connection
    include_once '../../config/conexion.php';
    $WS = new SoapClient($WebService);


    $parameters = array();
    $parameters['token'] = $_SESSION['token'];
    $parameters['traerTodas']=true;

    $parameters['idPlanilla'] = 0;
    $parameters['idTipoPlanilla'] = 0;
    if($_SESSION['usrrolid'] == "VEND"){
        $parameters['idVendedor'] = $_SESSION['usrid'];
    }else{
        $parameters['idVendedor'] = 0;
    }
    $result=array();
    $ajaxResp = $WS->Web_Planillas_Trae($parameters);
    $respuesta=		$ajaxResp->Web_Planillas_TraeResult->Item;
    $planillas=array();

    if($respuesta){
        $hayPlanillas=true;
        $cantidad = 0;
        if(count ($respuesta) ==1)
        {
            if($respuesta->Id == -1){
                $hayPlanillas=false;
            }
            else{
                $cantidad=1;
                $planillas[] = array(
                    'id'=>$respuesta->Id,
                    'idTipo'=>$respuesta->Value1,
                    'idUsuario'=>$respuesta->Value2,
                    'usuario'=>$respuesta->Value3,
                    'descripcion'=>$respuesta->Value4,
                    'datoAdic'=>$respuesta->Value5
                );
            }
        }else{
            foreach ($respuesta as $plnilla) {
                $cantidad++;
                $planillas[]= [
                    'id'=>$plnilla->Id,
                    'idTipo'=>$plnilla->Value1,
                    'idUsuario'=>$plnilla->Value2,
                    'usuario'=>$plnilla->Value3,
                    'descripcion'=>$plnilla->Value4,
                    'datoAdic'=>$plnilla->Value5
                ];
            }
        }
    }

}
catch(Exception $ex)
{
    $hayPlanillas=false;
}


$parameters = array();
$parameters['token'] = $_SESSION['token'];
$vendedores = array();
if($_SESSION['usrrolid'] != "VEND"){
    //Cargo los Vendedores
    $result=array();
    $ajaxResp = $WS->Web_TraeVendedores($parameters);
    $respuesta=		$ajaxResp->Web_TraeVendedoresResult->Item;
    if($respuesta){
        if(count ($respuesta) ==1)
        {
            $vendedores[] = array(
                'id'=>$respuesta->Id,
                'usuario'=>$respuesta->Value1
            );
        }else{
            foreach ($respuesta as $vendedor) {
                $vendedores[]= [
                    'id'=>$vendedor->Id,
                    'usuario'=>$vendedor->Value1
                ];
            }
        }
    }
}
$tiposPlanilla = array();
$result=array();
$ajaxResp = $WS->Web_Planillas_TraeTipos($parameters);
$respuesta=		$ajaxResp->Web_Planillas_TraeTiposResult->Item;
if($respuesta){
    if(count ($respuesta) ==1)
    {
        $tiposPlanilla[] = array(
            'id'=>$respuesta->Id,
            'idTipo'=>$respuesta->Value1
        );
    }else{
        foreach ($respuesta as $tipoP) {
            $tiposPlanilla[]= [
                'id'=>$tipoP->Id,
                'descripcion'=>$tipoP->Value1
            ];
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <link href="../../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <?php include '../layouts/comun_heads.php' ?>
</head>
<body class="skin-blue">
<div class="wrapper">
    <?php include '../layouts/sidebar_menu.php' ?>
    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Ventas
                <small>listado</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <div id="FiltrosContainer" class="box">
                <div class="box-header"></div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6"> <label for="idVendedor" >Vendedor: </label>
                            <select id="idVendedor" name="idVendedor" class="form-control" <?php echo $_SESSION['usrrolid'] == "VEND"?'disabled':''; ?>>
                                <?php
                                $hayVend = false;
                                foreach($vendedores as $vend){
                                    $hayVend = true;
                                    echo '<option value = "'.$vend['id'].'"">'.$vend['usuario'].'</option>';
                                }
                                if($hayVend){
                                    echo '<option value = "0" SELECTED>TODOS</option>';
                                }else{
                                    echo '<option value = "'.$_SESSION['usrid'].'"" SELECTED>'.$_SESSION['userName'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="idTipoPlanilla" >Planilla: </label>
                            <select id="idTipoPlanilla" name="idTipoPlanilla" class="form-control">
                                <?php
                                foreach($tiposPlanilla as $planilla){
                                    echo '<option value = "'.$planilla['id'].'"">'.$planilla['descripcion'].'</option>';
                                }
                                echo '<option value = "0" SELECTED>TODAS</option>';
                                ?>
                            </select>
                        </div>
                    </div>
                    &nbsp;
                    <div class="row">
                        <div class="col-md-12">
                            <button onclick='loadDatos()' class='btn btn-block btn-primary' >FILTRAR</button>
                        </div>
                    </div>
                </div>
                <div class="overlay" id = "spinnerFiltro" style="display: none">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                        <div id="tableContainer" class="box"  <?php echo $hayPlanillas?'':'style = "display: none;"' ?>>
                            <div class="box-header"></div>
                            <div class="box-body">
                                <table id="listado" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Vendedor</th>
                                            <th>Tipo Planilla</th>
                                            <th>Detalle</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    foreach($planillas as $plnilla){
                                        echo ' <tr>';
                                        echo ' <td>'.$plnilla['usuario'].'</td>';
                                        echo ' <td>'.$plnilla['descripcion'].'</td>';
                                        echo ' <td>'.$plnilla['datoAdic'].'</td>';
                                        echo "<td><button onclick='editaPlanilla(".$plnilla['id'].", ".$plnilla['idTipo'].")' class='btn btn-block btn-primary btn-sm button-accion-chico' >Abrir</button></td>";
                                        echo "<td><button onclick='eliminaPlanilla(".$plnilla['id'].", ".$plnilla['idTipo'].")' class='btn btn-block btn-danger btn-sm button-accion-chico'>Eliminar</button></td>";
                                        echo ' </tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                            <div class="overlay" id = "spinnerTabla" style="display: none">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>
                        </div>
                        <div id="sin_Planillas" <?php echo $hayPlanillas?'style = "display: none;"':''; ?>>
                            <h2> No hay planillas </h2>
                        </div>
                </div>
            </div>
        </section>
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include '../layouts/footer.php' ?>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.3 -->
<script src="../../js/plugins/jquery.min.js"></script>
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

<script type="text/javascript" src="../../js/pages/planillas_list.js" ></script>

</body>
</html>
