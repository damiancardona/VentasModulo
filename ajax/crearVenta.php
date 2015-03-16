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
	$venta =json_decode($_POST['venta']);

	$parameters = array();
	$parameters['token'] = 			$_COOKIE['token'];
	$parameters['id_vendedor']=		$_SESSION['usrid'];
	$parameters['id_cliente'] = 	$venta->idCliente;
	$parameters['_descuento']=		$venta->desc;
	$parameters['_bonif']=			$venta->bonGral;
	$parameters['_bonifAdic1']=		$venta->bonAd1;
	$parameters['_bonifAdic2']=		$venta->bonAd2;
	$parameters['_iva']=			$venta->iva;
	$parameters['_subtotal']=		$venta->subtotal;
	$parameters['_total']=			$venta->total;
	$parameters['idVta']=			$venta->id;

	$parameters['cantidades_prods']= array();
	$parameters['ids_productos']= array();

	$index = 0;
	$lines=$venta->lineas;


	try{
		foreach ($lines as $ln) {
			$parameters['cantidades_prods'][]=$ln->cantidad;
			$parameters['ids_productos'][]=$ln->producto->Id;
			$index=$index+1;
		}
	}catch(Exception $ex){		
			$result['error'] = true;
			$result['msj'] = $ex->getMessage();
			$result['aux']=$venta->lineas;
			print json_encode($result); return;	
	}

	
	try{
		$result = $WS->Web_CrearVenta($parameters);
	}catch(Exception $ex){		
			$result['error'] = true;
			$result['msj'] = $ex->getMessage();
			$result['aux']=$venta;
			print json_encode($result); return;	
	}

	if (is_soap_fault($result)) {
	    $errorMessage = "SOAP Fault: (faultcode: {$result->faultcode}, faultstring: {$result->faultstring})";
	    $result['error'] = true;
	    $result['msj'] = $errorMessage;	  
	    $result['aux']=$venta;
	    print json_encode($result); return;			
	}

	try{	
		if($result->Web_CrearVentaResult=="true"){
			$respuesta=array();
			$respuesta['error'] = false;
			$respuesta['aux']=$venta;
			print json_encode($respuesta);
		}else{	
			$respuesta=array();
			$respuesta['error'] = true;				
			$respuesta['msj'] = "Error en el servidor";
			$respuesta['aux']=$result->Web_CrearVentaResult;
			print json_encode($respuesta); return;
		}	
	}catch(Exception $ex){		
			$result['error'] = true;
			$result['msj'] = $ex->getMessage();
			$result['aux']=$venta;
			print json_encode($result); return;	
		}
}
catch(Exception $ex)
{	
   $respuesta=array();
   $respuesta['estado']='ERROR';
   $respuesta['mensaje']=$ex->getMessage();
   $respuesta['aux']=$_POST;
   print json_encode($respuesta);
}

	
?>