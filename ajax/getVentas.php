<?php
session_start();
try
{
	//SET WS connection
	include_once '../config/conexion.php';	
	$WS = new SoapClient($WebService);


	$parameters = array();
	$parameters['token'] = $_COOKIE['token'];
	$parameters['id_Vendedor']=$_SESSION['usrid'];

	$Result=array();

	$ajaxResp = $WS->Web_TraeVentasDelVendedor($parameters);
	$respuesta=		$ajaxResp->Web_TraeVentasDelVendedorWebResult->Item;
	$ventas=array();
	if($respuesta){
	foreach ($respuesta as $vtakey=> $vta) {
		$ventas[]=[
		'id'=>$vta->Id,
		'idCliente'=>$vta->Value1,
		'cliente'=>$vta->Value2,
		'fecha'=>$vta->Value3,
		'total'=>$vta->Value4,
		'estado'=>$vta->Value5
		];
	}

	$Result['Result']="OK";
	$Result['Ventas'] = $ventas;
}else{

	$Result['Result']="ERROR";
	$Result['Message'] = "No hay ventas";
}
	print json_encode($Result);
}
catch(Exception $ex)
{	
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}

	

	
?>