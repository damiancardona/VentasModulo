<?php
// Start the session
session_start();
//SET WS connection
include_once '../../config/conexion.php';

$WS = new SoapClient($WebService);

$token="";
$idUsuario="";
$rol = "";
$logueoOk = false;

if(isset($_POST['user']) && isset($_POST['pass'])) {

	$parametros = array(); 
	$parametros['username'] = $_POST['user']; 
	$parametros['password'] = $_POST['pass'];

	try{
		$result = $WS->Login($parametros);

		//pongo en la cookie el tipo de usuario
		$token=$result->LoginResult->Token;
		$idUsuario=$result->LoginResult->Id;

		$logueoOk = true;

	}catch(Exception $e) {
		header("location:index.php?estado=error");
		//echo '<script language="javascript">window.location="index.php?estado=error"</script>;';
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

    if ($_POST["chk_rec"]=="si")	{
        $login = addslashes(trim($_POST['user']));
        $pass = md5(trim($_POST['pass']));
        setcookie ("us", $login, time () + 604800);
        setcookie ("pass", $pass, time () + 604800);
    }

	$parametros = array();
	$parametros['token'] = $token;
	$parametros['id'] = $idUsuario;


	$result = $WS->TraeUsuario($parametros);
	$probando = new SimpleXMLElement($result->TraeUsuarioResult->any);
	$datos = $probando->NewDataSet->usuarios;

	$_SESSION['userName']=$datos->nombre.' '.$datos->apellido;
	$_SESSION['token']=$token;
	$_SESSION['usrid']=$idUsuario;
	switch($datos->rolid.''){
		case '0':$_SESSION['usrrolid'] = "SADM"; break;
		case '7':$_SESSION['usrrolid'] = "VEND"; break;
		case '4':$_SESSION['usrrolid'] = "ADM"; break;
		case '8':$_SESSION['usrrolid'] = "ADMP"; break;
		case '9':$_SESSION['usrrolid'] = "ADMC"; break;
		case '6':$_SESSION['usrrolid'] = "PROD"; break;
		case '5':$_SESSION['usrrolid'] = "PdL"; break;
		case '2':$_SESSION['usrrolid'] = "Pa"; break;
		case '3':$_SESSION['usrrolid'] = "Log"; break;
	};
    $_SESSION['autorizado'] = true;

	header("location: ../inicio/main.php");
	//echo '<script language="javascript">window.location="listado.php"</script>;';
}else{
	header("location:../inicio/index.php?estado=error");
	//echo '<script language="javascript">window.location="index.php?estado=error"</script>;';
}
	?>