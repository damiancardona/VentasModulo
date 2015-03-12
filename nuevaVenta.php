<?php
session_start();
if (!$_SESSION['autorizado']){
	header("Location:./index.php");
	exit;
	include_once './config/conexion.php';
}

/*

	
		
	

</body>
</html>
    <script type="text/javascript" src="js/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="jtable/jquery.jtable.min.js" ></script>
    <script type="text/javascript" src="js/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="js/jquery.validationEngine-es.js"></script>
    <script type="text/javascript" src="js/ventas.js" ></script>
	<script type="text/javascript" src="js/productos.js" ></script>
*/
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Modals</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style>
      .example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
      }
      .example-modal .modal {
        background: transparent!important;
      }
    </style>
  </head>
  <body class="skin-blue">
    <div class="wrapper">     
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">        
            <li><a href="menu.php"><i class="fa fa-book"></i>Listado de Ventas</a></li>
            <li class="active"><a><i class="fa fa-circle-o text-danger"></i> Nueva Venta</a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Ventas
            <small>nueva</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">     

	<div id="clientes_div" ></div>  
<button type="button" class="btn btn-primary btn-lg" onClick="open_container();" > Launch demo modal</button>
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
	<table class="table table-hover">
			<thead>
				<tr>			
					<th></th>
					<th>Nombre</th>
					<th>Codigo</th>
					<th>$ x U.</th>
					<th>Cantidad</th>
					<th>Total</th>
					<th></th>
				</tr>
			</thead>
				<tbody id="lineasVenta"></tbody>
	</table>
                    
	<table class="table table-hover" width="40%">
	<tr>
		<td>Subtotal: </td>
		<td>
			<div class="input-group">
	            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
	            <input id="subt" type="number" value=0 disabled></input>
           	</div>
        </td>
    </tr>
	<tr><td>Descuento:</td>
		<td>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
				<input type="number" id="desc" value=0></input>
			</div>
		</td>
	</tr>
	<tr><td>Bonificación General:</td>
		<td>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
				<input type="number" id="bonGral" value=0></input>
			</div>
		</td>
	</tr>
	<tr><td>Bonificación Adicional 1:</td>
		<td>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
				<input type="number" id="bonAd1" value=0></input>
			</div>
		</td>
	</tr>
	<tr><td>Bonificación Adicional 2:</td>
		<td>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
				<input type="number" id="bonAd2" value=0></input>
			</div>
		</td>
	</tr>
	<tr><td>IVA:</td>
		<td>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
				<input id="iva" type="number" value=0 disabled></input>
			</div>
		</td>
	</tr>
	<tr><td>TOTAL:</td>
		<td>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
				<input id="total" type="number" value=0 disabled></input>
			</div>
		</td>
	</tr>
	</table>

	<button onclick="guardaVenta()"> GUARDAR </button>          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://mapplics.com/">Mapplics Mobile Solutions</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="js/demo.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/ventas.js" ></script>
	<script type="text/javascript" src="js/productos.js" ></script>
  </body>
</html>
