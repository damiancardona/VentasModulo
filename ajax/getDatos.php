<?php
session_start();
try
{
	//SET WS connection
	include_once '../config/conexion.php';	
	try{
		$WS = new SoapClient($WebService);	
	}catch(Exception $ex){
		$result['error'] = true;
		$result['msj'] = $ex->getMessage();
		print json_encode($result); return;		
	}


	$parameters = array();
	$parameters['token'] = $_COOKIE['token'];

	try{
		$result = $WS->Web_TraeProductos($parameters);
	}catch(Exception $ex){
	    //Return error message
		$retorno = array();
		$retorno['error'] = true;
		$retorno['msj'] = $ex->getMessage();
		print json_encode($retorno);return;
	}
	
	//Return result to jTable
	if (is_soap_fault($result)) {
	    $errorMessage = "SOAP Fault: (faultcode: {$result->faultcode}, faultstring: {$result->faultstring})";
	    $result['error'] = true;
	    $result['msj'] = $errorMessage;	  
	    print json_encode($result); return;			
	}

	$retorno = array();
	$retorno['Productos'] = $result->Web_TraeProductosResult->Productos;

	$parameters = array();
	$parameters['token']=$_COOKIE['token'];
	$parameters['id_Vendedor']=$_SESSION['usrid'];

	try{
		$result = $WS->Web_TraeClientesParaVendedorWeb($parameters);
	}catch(Exception $ex){
	    //Return error message
		$retorno = array();
		$retorno['error'] = true;
		$retorno['msj'] = $ex->getMessage();
		print json_encode($retorno);return;
	}

	if (is_soap_fault($result)) {
	    $errorMessage = "SOAP Fault: (faultcode: {$result->faultcode}, faultstring: {$result->faultstring})";
	    $retorno['error'] = true;
	    $retorno['msj'] = $errorMessage;	  
	    print json_encode($retorno); return;			
	}

	$respuesta=		$result->Web_TraeClientesParaVendedorWebResult->Item;

	$clientes=array();
	foreach ($respuesta as $clkey=> $cl) {
		$clientes[]=[
		'id' => $cl->Id,
		'nombre' =>$cl->Value1,
		'email'=>$cl->Value2
		];
	}
	
	$retorno['Clientes'] = $clientes;

	

	$retorno['error'] = false;
	print json_encode($retorno);

}catch(Exception $ex){	
    //Return error message
	$retorno = array();
	$retorno['error'] = true;
	$retorno['msj'] = $ex->getMessage();
	print json_encode($retorno);
}

	
?>