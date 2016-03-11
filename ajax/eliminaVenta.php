<?php
session_start();
try
{
	//SET WS connection
	include_once '../config/conexion.php';		
	
	$result = array();
	try{
		$WS = new SoapClient($WebService);	
	}catch(Exception $ex){
		$result['error'] = true;
		$result['msj'] = $ex->getMessage();
		$result['aux']="a";
		print json_encode($result); return;		
	}
	$idVta =json_decode($_POST['id_vta']);

	$parameters = array();
	$parameters['token'] = 			$_SESSION['token'];
	$parameters['idVta']=			$idVta;
	
	try{
		$result = $WS->Web_EliminarVenta($parameters);
	}catch(Exception $ex){		
			$result['error'] = true;
			$result['msj'] = $ex->getMessage();
			$result['aux']=$_POST;
			print json_encode($result); return;	
	}

	if (is_soap_fault($result)) {
	    $errorMessage = "SOAP Fault: (faultcode: {$result->faultcode}, faultstring: {$result->faultstring})";
	    $result['error'] = true;
	    $result['msj'] = $errorMessage;	  
	    $result['aux']="c";
	    print json_encode($result); return;			
	}

	try{	
		if($result->Web_EliminarVentaResult=="true"){
			$respuesta=array();
			$respuesta['error'] = false;
			$respuesta['aux']="d";
			print json_encode($respuesta);
		}else{	
			$respuesta=array();
			$respuesta['error'] = true;				
			$respuesta['msj'] = "Error en el servidor";
			$respuesta['aux']="e";
			print json_encode($respuesta); return;
		}	
	}catch(Exception $ex){		
			$result['error'] = true;
			$result['msj'] = $ex->getMessage();
			$result['aux']="f";
			print json_encode($result); return;	
		}
}
catch(Exception $ex)
{	
   $respuesta=array();
   $respuesta['estado']='ERROR';
   $respuesta['mensaje']=$ex->getMessage();
   $respuesta['aux']="g";
   print json_encode($respuesta);
}

	
?>