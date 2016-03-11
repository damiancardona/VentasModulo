<?php
    $permisos = array(
    'Ventas'=>array(
        'modulo'=> false,
        'listado'=>false,
        'nueva'=>false
    ),
    'Planillas'=>array(
        'modulo'=> false,
        'listado'=>false,
        'C01'=>false,
        'C02'=>false,
        'C03'=>false
    )
);
switch($_SESSION['usrrolid']){
    case "SADM":
        $permisos['Ventas']['modulo'] = true;
        $permisos['Ventas']['listado'] = true;
        $permisos['Ventas']['nueva'] = true;
        $permisos['Planillas']['modulo'] = true;
        $permisos['Planillas']['listado'] = true;
        $permisos['Planillas']['C01'] = true;
        $permisos['Planillas']['C02'] = true;
        $permisos['Planillas']['C03'] = true;
        break;
    case "VEND":
        $permisos['Ventas']['modulo'] = true;
        $permisos['Ventas']['listado'] = true;
        $permisos['Ventas']['nueva'] = true;
        //$permisos['Planillas']['modulo'] = true;
        //$permisos['Planillas']['listado'] = true;
        //$permisos['Planillas']['C01'] = true;
        //$permisos['Planillas']['C02'] = true;
        //$permisos['Planillas']['C03'] = true;
        break;
    case "ADM":
        $permisos['Ventas']['modulo'] = true;
        $permisos['Ventas']['listado'] = true;
        $permisos['Planillas']['modulo'] = true;
        $permisos['Planillas']['listado'] = true;
        break;
    case "ADMP":
        break;
    case "ADMC":
        break;
    case "PROD":
        break;
    case "PdL":
        break;
    case "Pa":
        break;
    case "Log":
        break;
    default:
        break;
}