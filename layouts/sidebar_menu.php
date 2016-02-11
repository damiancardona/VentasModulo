<?php include_once '../utilidades.php'; ?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar" style="    padding-top: 0;">
        <span class="logo-lg">
                    <img style="width: 230px;" src="img/logo.jpg" class="img-rounded" alt="Logo">
                </span>
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="img/user.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><h4><?php echo $_SESSION['userName'];?></h4></p>
                <a><i class="fa fa-circle text-success"></i> Online</a>
                <a href="acciones.php?action=logout"><i class="fa fa-remove text-danger"></i><small>salir</small></a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li ><a href="menu.php"><i class="fa fa-book"></i>Listado de Ventas</a></li>
            <li ><a  href="nuevaVenta.php"><i class="fa fa-circle-o text-danger"></i> Nueva Venta</a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>