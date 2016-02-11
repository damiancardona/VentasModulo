<?php
session_start();
try
{
	//SET WS connection
	include_once '../config/conexion.php';	
	$WS = new SoapClient($WebService);


	$parameters = array();
	$parameters['token'] = $_COOKIE['token'];
	$parameters['idVenta'] = $_POST['idVta'];

	$result=array();
	
	$ajaxResp = $WS->Web_TraeVentaDelVendedor($parameters);
	$respuesta=		$ajaxResp->Web_TraeVentaDelVendedorResult;
	$venta=array();
	if($respuesta) {
		if ($respuesta->Id != -1) {
			$lineas = array();
			foreach ($respuesta->Items as $vta) {
				$lineas[] = [
					'idProd' => $vta->Id,
					'nombre' => $vta->Value1,
					'codigo' => $vta->Value2,
					'precioventafijo' => $vta->Value3,
					'cantidad' => $vta->Value4
				];
			}
			$datosAdic = explode("&", $respuesta->Value6);
			$venta = [
				'id' => $respuesta->Id,
				'idCliente' => $respuesta->Value1,
				'cliente' => $respuesta->Value2,
				'fecha' => $respuesta->Value3,
				'total' => $respuesta->Value4,
				'estado' => $respuesta->Value5,
				'lineas' => $lineas,
				'subtotal' => explode("=", $datosAdic[0])[1],
				'desc' => explode("=", $datosAdic[1])[1],
				'iva' => explode("=", $datosAdic[2])[1],
				'bonGral' => explode("=", $datosAdic[3])[1],
				'bonAd1' => explode("=", $datosAdic[4])[1],
				'bonAd2' => explode("=", $datosAdic[5])[1]
			];
			$result['error'] = false;
			$result['Venta'] = $venta;

		} else{
			$result['error'] = true;
			$result['msj'] = $ajaxResp->Web_TraeVentaDelVendedorResult->Value1;
			$result['aux'] = $ajaxResp->Web_TraeVentaDelVendedorResult;
		}
	}
	else {
		$result['error'] = true;
		$result['msj'] = "No hay ventas";
		$result['aux'] = $ajaxResp->Web_TraeVentaDelVendedorResult;
	}
	print json_encode($result);
}
catch(Exception $ex)
{	
    //Return error message
	$result = array();
	$result['error']=true;
	$result['aux']=$_POST;
	$result['msj'] = $ex->getMessage();
	print json_encode($result);
}
        
	

	
?>