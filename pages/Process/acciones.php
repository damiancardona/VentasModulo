<?php
session_start();
include_once 'utilidades.php';

switch($_GET['action']) {
case 'logout':
LogOut();
header("Location: ../../index.php");
break;
}