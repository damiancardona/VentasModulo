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
		print json_encode($result); return;		
	}
	

	

	$venta = $_POST['venta'];
	$parameters = array();
	$parameters['token'] = $_COOKIE['token'];
	$parameters['id_vendedor']=$_SESSION['usrid'];
	$parameters['id_cliente'] = 
	$parameters['codigo_producto'] = 
	$parameters['ids_productos']=
	$parameters['_descuento']=
	$parameters['_bonif']=
	$parameters['_bonifAdic1']=
	$parameters['_bonifAdic2']=
	$parameters['_iva']=
	$parameters['_total']=
	$parameters['cantidad'] = 
	$parameters['id_vta']=
	
	try{
		$result = $WS->Web_AgregarLineaVenta($parameters);
	}catch(Exception $ex){		
			$result['error'] = true;
			$result['msj'] = $ex->getMessage();
			print json_encode($result); return;	
	}
	if($result->Web_AgregarLineaVentaResult){
		$respuesta=array();
		$respuesta['estado']='OK';
		print json_encode($respuesta);
	}
	else{		
		//Return error message
		$respuesta=array();
		$respuesta['estado']='ERROR';
		$respuesta['mensaje']="Error en el servidor";
		print json_encode($respuesta);
		exit();
	}	
}
catch(Exception $ex)
{	
   $respuesta=array();
   $respuesta['estado']='ERROR';
   $respuesta['mensaje']=$ex->getMessage();
   print json_encode($respuesta);
}

	
?>