<?php

session_start();
$WS = null;
include_once '../../config/conexion.php';
try{
	$WS = new SoapClient($WebService);
}catch(Exception $ex){
	$result['error'] = true;
	$result['msj'] = $ex->getMessage();
	print json_encode($result); return;
}


function ComboHora($id,$width,$height, $hora_seleccionar)
{
	$control = "<select id=\"$id\" name=\"$id\" class=\"tahoma_12_negra\" style=\"width:$width; height:$height;\">";
	
	//HORA
	for($i=0;$i<=23;$i++)
	{
		if($i == $hora_seleccionar)
			$control .= "<option value=\"$i\" SELECTED>$i</option>";
		else 
			$control .= "<option value=\"$i\">$i</option>";
	}

	$control .= "</select>";
	
	return $control;
}

function ComboMinutos($id,$width,$height, $minutos_seleccionar)
{
	$control = "<select id=\"$id\" name=\"$id\" class=\"tahoma_12_negra\" style=\"width:$width; height:$height;\">";
	
	//HORA
	for($i=0;$i<=59;$i++)
	{
		if($i == $minutos_seleccionar)
			$control .= "<option value=\"$i\" SELECTED>$i</option>";
		else 
			$control .= "<option value=\"$i\">$i</option>";
	}

	$control .= "</select>";
	
	return $control;
}

function TraeProximoId($tabla, $campo)
{
	$proximoId=1;
		
	$query = mysql_fetch_row(mysql_query("SELECT MAX($campo) FROM $tabla"));
	
	$proximoId= ++$query[0];		
		
	return	 $proximoId;
}

function restaHoras($horaIni, $horaFin){
	
	$horas= (date("H", strtotime("00:00:00") + strtotime($horaFin) - strtotime($horaIni) ));
	$minutos= (date("i", strtotime("00:00:00") + strtotime($horaFin) - strtotime($horaIni) ));
	//multiplico las horas por 60 y le sumo los minutos
	$totalminutos = $horas * 60 + $minutos; 
	
    return $totalminutos;
}

function ConvertMinutes2Hours($Minutes)
{
    if ($Minutes < 0)
    {
        $Min = Abs($Minutes);
    }
    else
    {
        $Min = $Minutes;
    }
    $iHours = Floor($Min / 60);
    $Minutes = ($Min - ($iHours * 60)) / 100;
    $tHours = $iHours + $Minutes;
    if ($Minutes < 0)
    {
        $tHours = $tHours * (-1);
    }
    //reemplazo, por si venia el numero con punto en vez de con coma.
    $tHours = str_replace('.', ',', $tHours);    
    $aHours = explode(",", $tHours);
    $iHours = $aHours[0];
    if (empty($aHours[1]))
    {
        $aHours[1] = "00";
    }
    $Minutes = $aHours[1];
    if (strlen($Minutes) < 2)
    {
        $Minutes = $Minutes ."0";
    }
	if (strlen($iHours) < 2)
    {
        $iHours = "0".$iHours;
    }
    $tHours = "$iHours hs. - $Minutes min.";
    return $tHours;
}

function ConvertirMinutosAHorasFormatoHoras($Minutes)
{
    if ($Minutes < 0)
    {
        $Min = Abs($Minutes);
    }
    else
    {
        $Min = $Minutes;
    }
    $iHours = Floor($Min / 60);
    $Minutes = ($Min - ($iHours * 60)) / 100;
    $tHours = $iHours + $Minutes;
    if ($Minutes < 0)
    {
        $tHours = $tHours * (-1);
    }
    //reemplazo, por si venia el numero con punto en vez de con coma.
    $tHours = str_replace('.', ',', $tHours);
    $aHours = explode(",", $tHours);
    $iHours = $aHours[0];
    if (empty($aHours[1]))
    {
        $aHours[1] = "00";
    }
    $Minutes = $aHours[1];
    if (strlen($Minutes) < 2)
    {
        $Minutes = $Minutes ."0";
    }
	if (strlen($iHours) < 2)
    {
        $iHours = "0".$iHours;
    }
    $tHours = "$iHours:$Minutes";
    return $tHours;
}



//************************************
//**************MAIL******************
//************************************
function EnviaEmailClienteMapplics($idCliente,$subjectCliente,$bodyCliente, $subjectMapplics, $bodyMapplics)
{	
	require ('./phpmailer/class.phpmailer.php');    	
    include_once('./config/mail_config.php');

    //traigo el mail del cliente 
  
    	$query = mysql_query("SELECT mail FROM clientes WHERE id = ".$idCliente);
    	$cliente = mysql_fetch_row($query);    
		$emailCliente = $cliente[0];
    
 		//MAIL CLIENTE        
	    $mailCliente = new PHPMailer();
	    $mailCliente->IsSMTP();
	    $mailCliente->SMTPAuth = true;  	   
	    $mailCliente->Host = "mail.mapplics.com";
	    $mailCliente->Port = 25;
	    $mailCliente->Username = "info@mapplics.com";
	    $mailCliente->Password = "mapplics854";
	    $mailCliente->SetFrom("info@mapplics.com","MAPPLICS MOBILE SOLUTIONS");
	    $mailCliente->AddAddress($emailCliente);
	    $mailCliente->Subject = $subjectCliente;
	    $mailCliente->MsgHTML($bodyCliente);
	    	    
	    //MAIL MAPPLICS
	   	$mailMapplics = new PHPMailer();
	    $mailMapplics->IsSMTP();
	    $mailMapplics->SMTPAuth = true;  	   
	    $mailMapplics->Host = "mail.mapplics.com";
	    $mailMapplics->Port = 25;
	    $mailMapplics->Username = "info@mapplics.com";
	    $mailMapplics->Password = "mapplics854";
	    $mailMapplics->SetFrom("info@mapplics.com","MAPPLICS MOBILE SOLUTIONS");
	    $mailMapplics->AddAddress("info@mapplics.com");
	    $mailMapplics->Subject = $subjectMapplics;
	    $mailMapplics->MsgHTML($bodyMapplics);	   
	    	    
	    $mailCliente->Send();
	    $mailMapplics->Send();	    
}

function EnviaEmailCliente($idCliente,$subjectCliente,$bodyCliente)
{	
	require ('./phpmailer/class.phpmailer.php');    	
    include_once('./config/mail_config.php');

    //traigo el mail del cliente 
  
    	$query = mysql_query("SELECT mail FROM clientes WHERE id = ".$idCliente);
    	$cliente = mysql_fetch_row($query);    
		$emailCliente = $cliente[0];
     
 		//MAIL CLIENTE        
	    $mailCliente = new PHPMailer();
	    $mailCliente->IsSMTP();
	    $mailCliente->SMTPAuth = true;  	   
	    $mailCliente->Host = "mail.mapplics.com";
	    $mailCliente->Port = 25;
	    $mailCliente->Username = "info@mapplics.com";
	    $mailCliente->Password = "mapplics854";
	    $mailCliente->SetFrom("info@mapplics.com","MAPPLICS MOBILE SOLUTIONS");
	    $mailCliente->AddAddress($emailCliente);
	    $mailCliente->Subject = $subjectCliente;
	    $mailCliente->MsgHTML($bodyCliente); 
	    	    
	    $mailCliente->Send();
	   
}

function MailNuevoTicketCliente($numeroTicket)
{
	include_once('./config/mail_config.php');
	$url = "http://".$_SERVER['HTTP_HOST']."/MapplicsWorkController";
	
	$control = "<html>
				  <head>
				  <title></title>
				  <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
				  <link rel='stylesheet' href='".$url."/css/fonts.css' type='text/css'>
				  <link rel='stylesheet' href='".$url."/css/body.css' type='text/css'>
				  <link rel='stylesheet' href='".$url."/css/controles.css' type='text/css'>
				  </head>
				  <body>								  	
					<table width=\"980\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
						<tr>
							<td align=\"center\" valign=\"top\" width=\"250\"><img src=\"$url/images/cabecera.png\" width=\"171\" height=\"59\"/></td>
							<td align=\"left\" valign=\"middle\"><span class=\"tahoma_20_blanca\"><b>:: MAPPLICS WORK CONTROLLER ::</b></span></td>		
						</tr>
						<tr><td colspan=\"2\"><img src=\"$url/images/espacio.gif\" width=\"1\" height=\"10\"></td></tr>
						<tr>
							<td colspan=\"2\" width=\"900\" align=\"center\" class=\"rec_tareas\"><b>USTED A GENERADO EL TICKET $numeroTicket.<br/>A LA BREVEDAD NOS PONDREMOS EN CONTACTO.<BR/>GRACIAS.</b></td>
						</tr>
					</table>
				 </body>
				</html>";
	return $control;
}

function MailCambiaEstadoTicketCliente($numeroTicket,$estado)
{
	include_once('./config/mail_config.php');
	$url = "http://".$_SERVER['HTTP_HOST']."/MapplicsWorkController";
	
	$control = "<html>
				  <head>
				  <title></title>
				  <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
				  <link rel='stylesheet' href='".$url."/css/fonts.css' type='text/css'>
				  <link rel='stylesheet' href='".$url."/css/body.css' type='text/css'>
				  <link rel='stylesheet' href='".$url."/css/controles.css' type='text/css'>
				  </head>
				  <body>								  	
					<table width=\"980\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
						<tr>
							<td align=\"center\" valign=\"top\" width=\"250\"><img src=\"$url/images/cabecera.png\" width=\"171\" height=\"59\"/></td>
							<td align=\"left\" valign=\"middle\"><span class=\"tahoma_20_blanca\"><b>:: MAPPLICS WORK CONTROLLER ::</b></span></td>		
						</tr>
						<tr><td colspan=\"2\"><img src=\"$url/images/espacio.gif\" width=\"1\" height=\"10\"></td></tr>
						<tr>
							<td colspan=\"2\" width=\"900\" align=\"center\" class=\"rec_tickets\"><b>EL TICKET $numeroTicket A CAMBIADO EL ESTADO A <span class='tahoma_16_azul'>'$estado'</span>.<br/>VERIFIQUELO EN <a href='http://$_SERVER[HTTP_HOST]/MapplicsWorkController' class='tahoma_16_blanca'>MAPPLICS WORK CONTROLLER</a>.<br/>GRACIAS.</b></td>
						</tr>
					</table>
				 </body>
				</html>";
	return $control;
}
	
function MailNuevoTicketMapplics($idCliente, $numeroTicket)
{
	include_once('./config/mail_config.php');
	$url = "http://".$_SERVER['HTTP_HOST']."/MapplicsWorkController";

	//traigo el nombre del cliente
	$query = mysql_query("SELECT nombre FROM clientes WHERE id = ".$idCliente);
    $cliente = mysql_fetch_row($query);    
	$nombreCliente = strtoupper($cliente[0]);
	
	$control = "<html>
				  <head>
				  <title></title>
				  <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
				  <link rel='stylesheet' href='".$url."/css/fonts.css' type='text/css'>
				  <link rel='stylesheet' href='".$url."/css/body.css' type='text/css'>
				  <link rel='stylesheet' href='".$url."/css/controles.css' type='text/css'>
				  </head>
				  <body>								  	
					<table width=\"980\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
						<tr>
							<td align=\"center\" valign=\"top\" width=\"250\"><img src=\"$url/images/cabecera.png\" width=\"171\" height=\"59\"/></td>
							<td align=\"left\" valign=\"middle\"><span class=\"tahoma_20_blanca\"><b>:: MAPPLICS WORK CONTROLLER ::</b></span></td>		
						</tr>
						<tr><td colspan=\"2\"><img src=\"$url/images/espacio.gif\" width=\"1\" height=\"10\"></td></tr>
						<tr>
							<td colspan=\"2\" width=\"900\" align=\"center\" class=\"rec_tareas\"><b>EL CLIENTE '$nombreCliente' A GENERADO EL TICKET $numeroTicket.<br/>REVISAR.</b></td>
						</tr>
					</table>
				 </body>
				</html>";
	return $control;
}



//******************************************
//**************USUARIOS******************
//******************************************
function LogOut(){
	$_SESSION['usrid'] = null;
	$_SESSION['token'] = null;
	$_SESSION['autorizado'] = false;
	$_SESSION['userName'] = null;
}

?>