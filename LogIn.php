<?php
// Start the session
session_start();
//SET WS connection
include_once './config/conexion.php';
	$WS = new SoapClient($WebService);
$token="";
$idUsuario="";
$logueoOk = false;
if(isset($_POST['user']) && isset($_POST['pass'])) {

	$parametros = array(); 
	$parametros['username'] = $_POST['user']; 
	$parametros['password'] = $_POST['pass'];

	try{
		$result = $WS->Login($parametros);

		$_SESSION['autorizado'] = true;
		//pongo en la cookie el tipo de usuario
		$token=$result->LoginResult->Token;
		$idUsuario=$result->LoginResult->Id;

		$_SESSION['usrid']=$idUsuario;

		setcookie('token',$token, time () + 604800);

		if ($_POST["chk_rec"]=="si")	{
			$login = addslashes(trim($_POST['user']));
			$pass = md5(trim($_POST['pass']));
			setcookie ("us", $login, time () + 604800);
			setcookie ("pass", $pass, time () + 604800);
		}


		$logueoOk = true;

	}catch(Exception $e) {
		header("location:index.php?estado=error");	
	}

}
else {

	if($_COOKIE['pass']!="") {
		$parametros = array(); 
		$parametros['username'] = $_COOKIE['us'];
		$parametros['password'] = $_COOKIE['pass'];

		$result = $WS->Login($parametros);

		$token=$result->LoginResult->Token;
		$idUsuario=$result->LoginResult->Id;

		$_SESSION['autorizado'] = true;
		//pongo en la cookie el tipo de usuario
		setcookie('usrid',$idUsuario);
		setcookie('token',$token);
		
		if ($_POST["chk_rec"]=="si")	{
			$login = addslashes(trim($_POST['user']));
			$pass = md5(trim($_POST['pass']));
			setcookie ("us", $login, time () + 604800);
			setcookie ("pass", $pass, time () + 604800);
		}


		$logueoOk = true;
	}
	else
	{
		echo var_dump($_POST);
		die;
	}	
}

/** *****************Busco la info del usuario****************** **/
if($logueoOk){

	$parametros = array();
	$parametros['token'] = $token;
	$parametros['id'] = $idUsuario;


	$result = $WS->TraeUsuario($parametros);
	$probando = new SimpleXMLElement($result->TraeUsuarioResult->any);
	$datos = $probando->NewDataSet->usuarios;
	$_SESSION['userName']=$datos->nombre.' '.$datos->apellido;

	header("location:menu.php");
}else{
	header("location:index.php?estado=error");
}
	?>