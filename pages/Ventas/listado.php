<?php

session_start();

include_once '../../config/permisos.php';

if (!$_SESSION['autorizado']){
	header("Location: ../inicio/index.php");
	exit;	
	}

if(!$permisos['Ventas']['listado'] ){
  header("Location: ../inicio/main.php");
}


$hayVentas=false;
try
{
  //SET WS connection
  include_once '../../config/conexion.php';
  $WS = new SoapClient($WebService);


  $parameters = array();
  $parameters['token'] = $_SESSION['token'];
  $parameters['traerTodas']=true;

  $result=array();

    if($_SESSION['usrrolid']== "VEND"){
        $parameters['id_Vendedor']=$_SESSION['usrid'];
    }
    else{
        $parameters['id_Vendedor']=0;
    }

    $ajaxResp = $WS->Web_TraeVentasDelVendedor($parameters);
  $respuesta=$ajaxResp->Web_TraeVentasDelVendedorResult->Item;
  $ventas=array();
  if($respuesta){

    $hayVentas=true;
    $cantidad = 0;
    if(count ($respuesta) ==1)
    {
      $cantidad=1;
      $ventas[]= [
          'id'=>$respuesta->Id,
          'idCliente'=>$respuesta->Value1,
          'cliente'=>$respuesta->Value2,
          'fecha'=>$respuesta->Value3,
          'total'=>$respuesta->Value4,
          'estado'=>$respuesta->Value5,
          'vendedor'=>$respuesta->Value6
      ];
    }else{
      foreach ($respuesta as $vta) {
        $cantidad++;
        $ventas[]= [
            'id'=>$vta->Id,
            'idCliente'=>$vta->Value1,
            'cliente'=>$vta->Value2,
            'fecha'=>$vta->Value3,
            'total'=>$vta->Value4,
            'estado'=>$vta->Value5,
            'vendedor'=>$vta->Value6
        ];
      }
    }

  }
}
catch(Exception $ex)
{
  $hayVentas=false;
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
                    <h1>Ventas <small>listado</small></h1>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header"></div>
                                <div class="box-body">
                                    <div id="listado_content" <?php echo $hayVentas?'':' style=" display: none;"'; ?>>
                                        <table id="listado" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                <th>Cliente</th>
                                                <th>Fecha</th>
                                                <th>Monto</th>
                                                <th>Estado</th>
                                                <th>Vendedor</th>
                                                <th></th>
                                                <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach($ventas as $vta){
                                                echo ' <tr>';
                                                echo ' <td>'.$vta['cliente'].'</td>';
                                                echo ' <td>'.$vta['fecha'].'</td>';
                                                echo ' <td>'.$vta['total'].'</td>';
                                                echo ' <td>'.$vta['estado'].'</td>';
                                                echo ' <td>'.$vta['vendedor'].'</td>';
                                                echo "<td><button onclick='editaVenta(\"" . $vta['id'] . "\")' class='btn btn-block btn-primary btn-sm button-accion-chico' >".($vta['estado'] == 'PENDIENTE WEB'?'Editar':'Ver') ."</button>";
                                                echo "<td><button onclick='".($vta['estado'] == 'PENDIENTE WEB'?"eliminaVenta(\"" . $vta['id'] . "\")":"")."' class='btn btn-block btn-danger btn-sm button-accion-chico' ".($vta['estado'] == 'PENDIENTE WEB'?'':'disabled') .">Eliminar</button>";
                                                echo ' </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="sinVentas" <?php echo $hayVentas?' style=" display: none;"':''; ?>>
                                        <h2> No hay ventas realizadas </h2>
                                    </div>
                                </div><!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                </section>
            </div><!-- /.content -->
        </div><!-- /.content-wrapper -->
        <?php include '../layouts/footer.php' ?>
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

        <script type="text/javascript" src="../../js/pages/ventasList.js" ></script>

    </body>
</html>
