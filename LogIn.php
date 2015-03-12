<?php
// Start the session
session_start();
//SET WS connection
include_once './config/conexion.php';
	$WS = new SoapClient($WebService);

if(isset($_POST['user']) && isset($_POST['pass'])) {

	$parametros = array(); 
	$parametros['username'] = $_POST['user']; 
	$parametros['password'] = $_POST['pass'];

	try{
		$result = $WS->Login($parametros);

		$_SESSION['autorizado'] = true;
		//pongo en la cookie el tipo de usuario
		$_SESSION['usrid']=$result->LoginResult->Id;

		setcookie('token',$result->LoginResult->Token, time () + 604800);
		
		if ($_POST["chk_rec"]=="si")	{
			$login = addslashes(trim($_POST['user']));
			$pass = md5(trim($_POST['pass']));
			setcookie ("us", $login, time () + 604800);
			setcookie ("pass", $pass, time () + 604800);
		}

		$parameters = array();
		$parameters['token']=$_COOKIE['token'];
		$parameters['id_Vendedor']=31;


		header("location:menu.php");
		
	}catch(Exception $e) {
		header("location:index.php?estado=error");	
	}
	
}
else {
	
	if($_COOKIE['pass']!="") {
		$parametros = array(); 
		$parametros['username'] = $_POST['user']; 
		$parametros['password'] = $_POST['pass'];		

		$result = $WS->Login($parametros);

		$_SESSION['autorizado'] = true;
		//pongo en la cookie el tipo de usuario
		setcookie('usrid',$result->Id);
		setcookie('token',$result->Token);
		
		//header("location:index_usuario.php");
		
		if ($_POST["chk_rec"]=="si")	{
			$login = addslashes(trim($_POST['user']));
			$pass = md5(trim($_POST['pass']));
			setcookie ("us", $login, time () + 604800);
			setcookie ("pass", $pass, time () + 604800);
		}
			else
				header("./index.php");
		
	}
	else
	{
		echo var_dump($_POST);
	}	
}
	?>