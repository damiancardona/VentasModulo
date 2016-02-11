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
	$parameters['traerTodas']=true;

	$result=array();

	$ajaxResp = $WS->Web_TraeVentasDelVendedor($parameters);
	$respuesta=		$ajaxResp->Web_TraeVentasDelVendedorResult->Item;
	$ventas=array();
	if($respuesta){
		if(count ($respuesta) ==1)
		{
			$ventas[]= [
				'id'=>$respuesta->Id,
				'idCliente'=>$respuesta->Value1,
				'cliente'=>$respuesta->Value2,
				'fecha'=>$respuesta->Value3,
				'total'=>$respuesta->Value4,
				'estado'=>$respuesta->Value5
			];
		}else{
	foreach ($respuesta as $vta) {
		$ventas[]= [
			'id'=>$vta->Id,
			'idCliente'=>$vta->Value1,
			'cliente'=>$vta->Value2,
			'fecha'=>$vta->Value3,
			'total'=>$vta->Value4,
			'estado'=>$vta->Value5
		];
	}
}
	$result['error']=false;
	$result['Ventas'] = $ventas;

}else{
	$result['error']=true;
	$result['msj'] = "No hay ventas";
}
	print json_encode($result);
}
catch(Exception $ex)
{	
    //Return error message
	$result = array();
	$result['error']=true;
	$result['msj'] = $ex->getMessage();
	print json_encode($result);
}

	

	
?>