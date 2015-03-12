<?php
session_start();
if (!$_SESSION['autorizado']){
    var_dump($_SESSION);exit();
    header("Location:./index.php");
    exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>:: MGM - Modulo de Ventas WEB ::</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link rel="SHORTCUT ICON" href="./images/mapplics.ico" />
    <link rel="stylesheet" type="text/css" href="css/easyui.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" href="css/body.css" type="text/css">
    <link rel="stylesheet" href="css/fonts.css" type="text/css">
    <link rel="stylesheet" href="css/controles.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <!-- Include one of jTable styles. -->
    <link href="css/validationEngine.jquery.css" rel="stylesheet" type="text/css" /> 
    <link href="jtable/themes/metro/blue/jtable.min.css" rel="stylesheet" type="text/css" /> 
</head>
<body> 
<div id="ClientesTabla"></div>
<table  align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <form action="login.php" method="POST">
                <table width="900" align="center" cellpadding="0" cellspacing="0">
                    <tr><td colspan="3"><img src="images/espacio.gif" width="1" height="30"></td></tr>
                    <tr>
                        <td width="900" align="center"><a href="nuevaVenta.php" class="rec_tareas"><b>NUEVA VENTA</b></a></td>

                    </tr>           
                </table>
            </form>
        </td>
    </tr>   

</body>
    <script type="text/javascript" src="js/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="jtable/jquery.jtable.min.js" ></script>
    <script type="text/javascript" src="js/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="js/jquery.validationEngine-es.js"></script>
    <script type="text/javascript" src="js/ventas.js" ></script>