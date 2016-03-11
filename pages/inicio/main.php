<?php

session_start();
if (!$_SESSION['autorizado']){
    header("Location: ../inicio/index.php");
    exit;
}

$RolesConPermiso = array(
 "SADM" => true,
 "VEND" => true,
 "ADM" => true,
 "ADMP" => true,
 "ADMC" => true,
 "PROD" => true,
 "PdL" => true,
 "Pa" => true,
 "Log" => true
);
if(!$RolesConPermiso[$_SESSION['usrrolid']]){
    header("Location: ../inicio/index.php?estado=error");
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
                Bienvenido!!!
                <small> al m&oacute;dulo de ventas de Morelli</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <h2>
                       Seleccione una opci&oacute;n del menu.
                    </h2>
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

<script type="text/javascript" src="../../js/pages/ventasList.js" ></script>

</body>
</html>
