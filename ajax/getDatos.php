<?php
session_start();
try
{
	//SET WS connection
	include_once '../config/conexion.php';	


	$parameters = array();
	$parameters['token'] = $_COOKIE['token'];

	$result = $WS->Web_TraeProductos($parameters);
	
	//Return result to jTable
	$jTableResult = array();
	$jTableResult['Result'] = "OK";
	$jTableResult['Productos'] = $result->Web_TraeProductosResult->Productos;

	if($jTableResult['Result']=="OK"){
		$parameters = array();
		$parameters['token']=$_COOKIE['token'];
		$parameters['id_Vendedor']=$_SESSION['usrid'];
		$result = $WS->Web_TraeClientesParaVendedorWeb($parameters);
		$respuesta=		$result->Web_TraeClientesParaVendedorWebResult->Item;
		$clientes=array();
		foreach ($respuesta as $clkey=> $cl) {
			$clientes[]=[
			'id' => $cl->Id,
			'nombre' =>$cl->Value1,
			'email'=>$cl->Value2
			];
		}
	
	$jTableResult['Clientes'] = $clientes;

	}
	print json_encode($jTableResult);
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