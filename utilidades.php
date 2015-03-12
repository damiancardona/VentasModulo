<?php

function ComboProductos($width,$height,$id_producto_seleccionar,$es_filtro)
{	
	include_once './config/conexion.php';
	$parametros = array(); 
	$parametros['token']=$_COOKIE['token'];
	$parametros['id_Vendedor']=1;
	try{
		$result = $WS->ProductoPorVendedor($parametros);
		var_dump($result->TraeProductoResult->schema);//->TraeProductoResponse);
		/*'<xs:schema xmlns="" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:msdata="urn:schemas-microsoft-com:xml-msdata" id="NewDataSet"><xs:element name="NewDataSet" msdata:IsDataSet="true" msdata:UseCurrentLocale="true"><xs:complexType><xs:choice minOccurs="0" maxOccurs="unbounded"><xs:element name="productos"><xs:complexType><xs:sequence><xs:element name="codigo" type="xs:string" minOccurs="0"/><xs:element name="nombre" type="xs:string" minOccurs="0"/><xs:element name="ganancia" type="xs:decimal" minOccurs="0'... (length=2495)
     */
	}
	catch(Exception $ex)
	{
		var_dump($parametros);
		var_dump($ex);
	}
	$control = "<select id=\"prod_id\" name=\"prod_id\" class=\"tahoma_12_negra\" style=\"width:$width; height:$height;\">";
	$control.= "<option value='0'>SELECCIONE UN PRODUCTO</option>";

	
	while($proyecto = mysql_fetch_row($consulta))
	{
		if($proyecto[0] == $id_producto_seleccionar)
			$control.= "<option value='$proyecto[0]' SELECTED>$proyecto[1]</option>";
		else
			$control.= "<option value='$proyecto[0]'>$proyecto[1]</option>";
	}
	$control .= "</select>";
	return $control;
}

function ComboProyectos($width,$height,$id_proyecto_seleccionar,$es_filtro)
{
	$control = "<select id=\"proy_id\" name=\"proy_id\" class=\"tahoma_12_negra\" style=\"width:$width; height:$height;\" onclick=\"calculaYmuestraTiempos(\">";
	if($es_filtro)
		$control.= "<option value='0' SELECTED>TODOS</option>";
	else 
		$control.= "<option value='0' SELECTED>SELECCIONE UN PROYECTO</option>";
		
	$consulta = mysql_query("SELECT proyectos.id, proyectos.nombre as proyecto, proyectos.finalizado as finalizado FROM proyectos ORDER BY proyectos.nombre");
	while($proyecto = mysql_fetch_row($consulta))
	{
		if($proyecto[2]==0)
		{
			if($proyecto[0] == $id_proyecto_seleccionar)
				$control.= "<option value='$proyecto[0]' SELECTED>$proyecto[1]</option>";
			else
				$control.= "<option value='$proyecto[0]'>$proyecto[1]</option>";
		}
	}
	$control .= "</select>";
	return $control;
}

function ComboClientes($width,$height,$id_cliente_seleccionar,$es_filtro)
{
	$control = "<select id=\"cli_id\" name=\"cli_id\" class=\"tahoma_12_negra\" style=\"width:$width; height:$height;\">";
	if($es_filtro)
		$control.= "<option value='0' SELECTED>TODOS</option>";
	else 
		$control.= "<option value='0' SELECTED>SELECCIONE UN CLIENTE</option>";
		
	$consulta = mysql_query("SELECT id, nombre FROM clientes ORDER BY nombre");
	while($cliente = mysql_fetch_row($consulta))
	{
		if($cliente[0] == $id_cliente_seleccionar)
			$control.= "<option value='$cliente[0]' SELECTED>$cliente[1]</option>";
		else
			$control.= "<option value='$cliente[0]'>$cliente[1]</option>";
	}
	$control .= "</select>";
	return $control;
}

function ComboUsuarios($width,$height,$id_usuario_seleccionar,$es_filtro)
{
	$control = "<select id=\"usr_id\" name=\"usr_id\" class=\"tahoma_12_negra\" style=\"width:$width; height:$height;\">";
	if($es_filtro)
		$control.= "<option value='0'>TODOS</option>";
	else 
		$control.= "<option value='0'>SELECCIONE UN USUARIO</option>";
		
	$consulta = mysql_query("SELECT id, nombre FROM usuarios ORDER BY nombre");
	while($usuario = mysql_fetch_row($consulta))
	{
		if($usuario[0] == $id_usuario_seleccionar)
			$control.= "<option value='$usuario[0]' SELECTED>$usuario[1]</option>";
		else
			$control.= "<option value='$usuario[0]'>$usuario[1]</option>";
	}
	$control .= "</select>";
	return $control;
}

function ComboEstados($width,$height,$estado_seleccionar)
{
	$control = "<select id=\"estado\" name=\"estado\" class=\"tahoma_12_negra\" style=\"width:$width; height:$height;\">
					<option value=\"0\">TODOS</option>";
	
	if($estado_seleccionar == "PENDIENTE")
		$control .= "<option value=\"PENDIENTE\" SELECTED>PENDIENTE</option>";
	else 
		$control .= "<option value=\"PENDIENTE\">PENDIENTE</option>";

	if($estado_seleccionar == "EN PROCESO")
		$control .= "<option value=\"EN PROCESO\" SELECTED>EN PROCESO</option>";
	else 
		$control .= "<option value=\"EN PROCESO\">EN PROCESO</option>";
		
	if($estado_seleccionar == "TERMINADA")
		$control .= "<option value=\"TERMINADA\" SELECTED>TERMINADA</option>";
	else 
		$control .= "<option value=\"TERMINADA\" >TERMINADA</option>";
		
	if($estado_seleccionar == "VERIFICADA")
		$control .= "<option value=\"VERIFICADA\" SELECTED>VERIFICADA</option>";
	else 
		$control .= "<option value=\"VERIFICADA\" >VERIFICADA</option>";

	$control .= "</select>";
	
	return $control;
}

function ComboTipoTicket($width,$height,$tipo_seleccionar)
{
	$control = "<select id=\"tipo\" name=\"tipo\" class=\"tahoma_12_negra\" style=\"width:$width; height:$height;\">
					<option value=\"0\">TODOS</option>";
	
	if($tipo_seleccionar == "PROBLEMA")
		$control .= "<option value=\"PROBLEMA\" SELECTED>PROBLEMA</option>";
	else 
		$control .= "<option value=\"PROBLEMA\">PROBLEMA</option>";

	if($tipo_seleccionar == "MODIFICACION")
		$control .= "<option value=\"MODIFICACION\" SELECTED>MODIFICACION</option>";
	else 
		$control .= "<option value=\"MODIFICACION\">MODIFICACION</option>";


	$control .= "</select>";
	
	return $control;
}

function ComboTipoTarea($width,$height,$tipo_seleccionar)
{
	$control = "<select id=\"tipo\" name=\"tipo\" class=\"tahoma_12_negra\" style=\"width:$width; height:$height;\">
					<option value=\"0\" SELECTED>SELECCIONE TIPO</option>";
	
	if($tipo_seleccionar == "DESARROLLO")
		$control .= "<option value=\"DESARROLLO\" SELECTED>DESARROLLO</option>";
	else 
		$control .= "<option value=\"DESARROLLO\">DESARROLLO</option>";

	if($tipo_seleccionar == "SOPORTE")
		$control .= "<option value=\"SOPORTE\" SELECTED>SOPORTE</option>";
	else 
		$control .= "<option value=\"SOPORTE\">SOPORTE</option>";


	$control .= "</select>";
	
	return $control;
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
?>