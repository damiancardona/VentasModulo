<?php
include_once '../Process/utilidades.php';
include_once '../../config/permisos.php';

?>
<header class="main-header">
    <!-- Header Navbar: style can be found in header.less -->
    <a href="../inicio/main.php" class="logo"  style="background: #222d32;">
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
                    <img style="height: 48px;" src="../../img/logo.png" class="img-rounded" alt="Logo">
                </span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation" style="background: #222d32;">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="background-color: #222d32;">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->

        <?php if($permisos['Ventas']['modulo']){?> <?php }?>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../../img/user.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><h4><?php echo $_SESSION['userName'];?></h4></p>
                <a><i class="fa fa-circle text-success"></i> Online</a>
                <a href="../Process/acciones.php?action=logout"><i class="fa fa-remove text-danger"></i><small>salir</small></a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" id="menu">

            <?php if($permisos['Ventas']['modulo']){?>
            <li class="treeview <?php echo explode('/', $_SERVER['PHP_SELF'])[3] == "Ventas"?"active":"";?>">
                <a href="#">
                    <i class="fa fa-dollar"></i> <span>Ventas</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul  <?php echo explode('/', $_SERVER['PHP_SELF'])[3] == "Ventas"?'':' style="display: none;" ';?> class="treeview-menu">
                    <?php if($permisos['Ventas']['listado']){?><li class = " <?php echo explode('.', explode('/', $_SERVER['PHP_SELF'])[4])[0] == "listado"?"active":"";?>"><a href="../Ventas/listado.php"><i class="fa fa-list text-warning"></i>Listado</a></li><?php }?>
                    <?php if($permisos['Ventas']['nueva']){?><li class = " <?php echo explode('.', explode('/', $_SERVER['PHP_SELF'])[4])[0] == "nueva"?"active":"";?>"><a  href="../Ventas/nueva.php"><i class="fa fa-cart-plus text-success"></i> Nueva</a></li><?php }?>
                </ul>
            </li>
            <?php }?>
            <?php if($permisos['Planillas']['modulo']){?>
            <li class="treeview <?php echo explode('/', $_SERVER['PHP_SELF'])[3] == "Planillas"?"active":"";?>">
                <a href="#">
                    <i class="fa fa-file-text-o"></i> <span>Planillas</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul  <?php echo explode('/', $_SERVER['PHP_SELF'])[3] == "Planillas"?'':' style="display: none;" ';?> class="treeview-menu">
                    <?php if($permisos['Planillas']['listado']){?><li class = " <?php echo explode('.', explode('/', $_SERVER['PHP_SELF'])[4])[0] == "listado"?"active":"";?>"><a  href="../Planillas/listado.php"><i class="fa fa-list text-warning"></i> Listado</a></li><?php }?>
                    <?php if($permisos['Planillas']['C01']){?><li class = " <?php echo explode('.', explode('/', $_SERVER['PHP_SELF'])[4])[0] == "Relevamiento"?"active":"";?>"><a href="../Planillas/Relevamiento.php"><i class="fa fa-book text-success"></i> C01 - Relevamiento</a></li><?php }?>
                    <?php if($permisos['Planillas']['C02']){?><li class = " <?php echo explode('.', explode('/', $_SERVER['PHP_SELF'])[4])[0] == "AccionCliente"?"active":"";?>"><a  href="../Planillas/AccionCliente.php"><i class="fa fa-book text-default"></i> C02 - Accion Cliente</a></li><?php }?>
                    <?php if($permisos['Planillas']['C03']){?> <li class = " <?php echo explode('.', explode('/', $_SERVER['PHP_SELF'])[4])[0] == "Visita"?"active":"";?>"><a  href="../Planillas/Visita.php"><i class="fa fa-book text-danger"></i> C03 - Visita</a></li><?php }?>
                </ul>
            </li>
            <?php }?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<!-- The Right Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Content of the sidebar goes here -->
</aside>
<!-- The sidebar's background -->
<!-- This div must placed right after the sidebar for it to work-->
<div class="control-sidebar-bg"></div>