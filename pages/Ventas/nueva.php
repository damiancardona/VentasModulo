<?php
session_start();

include_once '../../config/permisos.php';

if (!$_SESSION['autorizado']){
	header("Location:../inicio/index.php");
	exit;
}

if(!$permisos['Ventas']['nueva'] ){
	header("Location: ../inicio/main.php");
}

?>


<!DOCTYPE html>
<html>
  <head>
    <?php include '../layouts/comun_heads.php' ?>
	  <!-- DateTime Picker -->
	  <link href="../../css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
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
<small id="tipoOperacion">nueva</small>
</h1>
</section>
<!-- Main content -->
<section class="content" id="seccionVenta">
	<div class="box">

		<div class="row">
			<div class="col-md-12">
					<div id="clientes_div" class="form-group"></div>
				<hr/>
				<hr/>
				<div class="form-group">
					<label class="col-md-1 control-label">Fecha de Entrega:</label>
					<div class="col-md-3">
						<input type='text' class="form-control datetimepicker" id='fechaEntrega' data-date-format="DD/MM/YYYY"/>
					</div>
				</div>
				<hr/>
				<br/>
				<hr/>
				<h4>Productos pedidos:</h4>
				<table class="table table-hover">
					<thead>
					<tr>
						<th width="10%">Codigo</th>
						<th width="50%">Nombre</th>
						<th width="10%">Precio U.</th>
						<th width="10%">Cantidad</th>
						<th width="20%">Total</th>
						<th></th>
					</tr>
					</thead>
					<tbody id="lineasVenta"></tbody>
				</table>
				<button  id="btnAgregaProductos" type="button" class="btn btn-primary btn-lg " style="float: right" onClick="open_container();" >Agregar Producto</button>
				<hr/>
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog ">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel"></h4>
							</div>
							<div class="modal-body" id="modal-bodyku">
							</div>
							<div class="modal-footer" id="modal-footerq">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<table class="table table-hover">
					<tr>
						<td>Subtotal: </td>
						<td>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
								<input class="form-control" id="subt" type="number" value=0 disabled />
							</div>
						</td>
					</tr>
					<tr><td>Descuento:</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
								<input class="form-control"  type="number" id="desc" value=0 />
							</div>
						</td>
					</tr>
					<tr><td>IVA:</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
								<input class="form-control"  id="iva" type="number" value=0 />
							</div>
						</td>
					</tr>
					<tr><td><b>TOTAL:</b></td>
						<td>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
								<b><input class="form-control"  id="total" type="number" value=0 disabled /></b>
							</div>
						</td>
					</tr>
				</table></div>
			<div class="col-md-6" style="display: none">
				<table class="table table-hover">
					<tr><td>Bonificación General:</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon"><i>%</i></span>
								<input class="form-control"  type="number" id="bonGral" value=0 />
							</div>
						</td>
					</tr>
					<tr><td>Bonificación Adicional 1:</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon"><i>%</i></span>
								<input class="form-control"  type="number" id="bonAd1" value=0 />
							</div>
						</td>
					</tr>
					<tr><td>Bonificación Adicional 2:</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon"><i>%</i></span>
								<input class="form-control"  type="number" id="bonAd2" value=0 />
							</div>
						</td>
					</tr>
				</table></div>
		</div>
		<div class="row" id="botones">
			<div class="col-md-12">
				<div style="float: right">
					<a class="btn btn-app button-app" onclick="guardaVenta()" >
						<i class="fa fa-save"></i>
					</a>
					<a class="btn btn-app button-app" onclick="actualizaVenta(false, false)">
						<i class="fa fa-repeat"></i>
					</a>
				</div>
			</div></div>
		<div class="overlay" id = "spinner">
			<i class="fa fa-refresh fa-spin"></i>
		</div>
	</div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include '../layouts/footer.php' ?>
</div><!-- ./wrapper -->
    <!-- jQuery 2.1.3 -->
	<script type="text/javascript" src="../../js/plugins/jquery.min.js"></script>
	<!-- Moment -->
	<script type="text/javascript" src="../../js/plugins/moment.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../../js/plugins/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../../js/plugins/app.min.js" type="text/javascript"></script>
    <!-- DateTime Picker -->
	<script type="text/javascript" src="../../js/plugins/bootstrap-datetimepicker.min.js"></script>
    
    <script type="text/javascript" src="../../js/pages/ventas.js" ></script>

    <script type="text/javascript" src="../../js/pages/productos.js" ></script>
  </body>
</html>
