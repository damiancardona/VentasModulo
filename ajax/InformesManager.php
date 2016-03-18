<?php
session_start();
try
{
    //SET WS connection
    include_once '../config/conexion.php';
    $WS = new SoapClient($WebService);


    $tipoInforme   = $_GET['tipo_informe'];
    $accion        = $_GET['accion'];

    $tipoPlanilla = '-';
    switch($tipoInforme){
        case "RELEVAMIENTO":
            $tipoPlanilla = 1;
            break;
        case "ACCIONCLIENTE":
            $tipoPlanilla = 2;
            break;
        case "VISITA":
            $tipoPlanilla = 3;
            break;
    }

    $parameters = array();

    $parameters['token'] = $_SESSION['token'];

    $result=array();

    if($accion == "ELIMINAR"){
        $parameters['idPlanilla'] = $_POST['id_planilla'];
        $parameters['idTipo'] = $_POST['id_tipo'];
        $respuesta = $WS->Web_Planillas_Elimina($parameters);

        if ($respuesta->Web_Planillas_EliminaResult == "OK") {
            $result['error'] = false;
        } else {
            $result['error'] = true;
            $result['msj'] = "Error: " . $respuesta->Web_Planillas_EliminaResult;
        }
    }
    else if($accion == "LISTAR"){
        $parameters['idPlanilla'] = 0;
        $parameters['idTipoPlanilla'] = isset($_POST['id_tipo'])?$_POST['id_tipo']:'0';
        $parameters['idVendedor'] = isset($_POST['id_vendedor'])?$_POST['id_vendedor']:'0';
        $result=array();
        $ajaxResp = $WS->Web_Planillas_Trae($parameters);
        $respuesta=	$ajaxResp->Web_Planillas_TraeResult->Item;
        $planillas=array();
        if($respuesta){
            if(count ($respuesta) ==1)
            {
                if($respuesta->Id == -1){

                }else{
                    $planillas[] = array(
                        'id'=>$respuesta->Id,
                        'idTipo'=>$respuesta->Value1,
                        'idUsuario'=>$respuesta->Value2,
                        'usuario'=>$respuesta->Value3,
                        'descripcion'=>$respuesta->Value4,
                        'datoAdic'=>$respuesta->Value5
                    );
                }
            }else{
                foreach ($respuesta as $vta) {
                    $planillas[]= [
                        'id'=>$vta->Id,
                        'idTipo'=>$vta->Value1,
                        'idUsuario'=>$vta->Value2,
                        'usuario'=>$vta->Value3,
                        'descripcion'=>$vta->Value4,
                        'datoAdic'=>$vta->Value5
                    ];
                }
            }
            $result['error']=false;
            $result['Planillas'] = $planillas;

        }else{
            $result['error']=true;
            $result['msj'] = "No hay planillas";
        }

    }
    else if($accion == "GET"){
        $parameters['idPlanilla'] = $_POST['id_planilla'];
        $parameters['idTipoPlanilla'] = $tipoPlanilla;
        $parameters['idVendedor'] = '0';
        $result=array();
        $ajaxResp = $WS->Web_Planillas_Trae($parameters);
        $respuesta=		$ajaxResp->Web_Planillas_TraeResult->Item;
        if($respuesta){
            $result['error']=false;
            $result['Datos'] = $respuesta->Value1;
        }else{
            $result['error']=true;
            $result['msj'] = "No fue posible recuperar datos";
        }

    }
    else {
        switch ($tipoInforme) {
            case "RELEVAMIENTO":

                $parameters['Fecha'] = $_POST['Fecha'];
                $parameters['NombreVendedor'] = isset($_POST['NombreVendedor']) ? $_POST['NombreVendedor'] : "";
                $parameters['TieneCuenta'] = $_POST['TieneCuenta'];
                $parameters['NombreEmpresa'] = isset($_POST['NombreEmpresa']) ? $_POST['NombreEmpresa'] : "";
                $parameters['TipoCliente'] = isset($_POST['TipoCliente']) ? $_POST['TipoCliente'] : "";
                $parameters['Fidelizacion'] = isset($_POST['Fidelizacion']) ? $_POST['Fidelizacion'] : "";
                $parameters['PenetracionMercado'] = isset($_POST['PenetracionMercado']) ? $_POST['PenetracionMercado'] : "";
                $parameters['NombreContacto'] = isset($_POST['NombreContacto']) ? $_POST['NombreContacto'] : "";
                $parameters['NombreContactoAux'] = isset($_POST['NombreContactoAux']) ? $_POST['NombreContactoAux'] : "";
                $parameters['FechaNacimiento'] = $_POST['FechaNacimiento'];
                $parameters['FechaNacimientoAux'] = isset($_POST['FechaNacimientoAux']) ? $_POST['FechaNacimientoAux'] : "";
                $parameters['Direccion'] = isset($_POST['Direccion']) ? $_POST['Direccion'] : "";
                $parameters['Localidad'] = isset($_POST['Localidad']) ? $_POST['Localidad'] : "";
                $parameters['TipoContacto'] = $_POST['TipoContacto'];
                $parameters['TelefonoContacto'] = isset($_POST['TelefonoContacto']) ? $_POST['TelefonoContacto'] : "";
                $parameters['TelefonoContactoFijo'] = isset($_POST['TelefonoContactoFijo']) ? $_POST['TelefonoContactoFijo'] : "";
                $parameters['TelefonoContactoCelular'] = isset($_POST['TelefonoContactoCelular']) ? $_POST['TelefonoContactoCelular'] : "";
                $parameters['Mail'] = isset($_POST['Mail']) ? $_POST['Mail'] : "";
                $parameters['RecibeMails'] = $_POST['RecibeMails'];
                $parameters['MercadoGastronomicoOpt'] = $_POST['MercadoGastronomicoOpt'];
                $parameters['MercadoGastronomico'] = isset($_POST['MercadoGastronomico']) ? $_POST['MercadoGastronomico'] : "";
                $parameters['MercadoResidencialOpt'] = $_POST['MercadoResidencialOpt'];
                $parameters['MercadoResidencial'] = isset($_POST['MercadoResidencial']) ? $_POST['MercadoResidencial'] : "";
                $parameters['MercadoInternet'] = isset($_POST['MercadoInternet']) ? $_POST['MercadoInternet'] : "";
                $parameters['ImagenDelLocal'] = $_POST['ImagenDelLocal'];
                $parameters['ComercializaMorelli'] = $_POST['ComercializaMorelli'];
                $parameters['MotivoNoComercializaMorelli'] = $_POST['MotivoNoComercializaMorelli'];
                $parameters['ProductoExibidoCorrectamente'] = $_POST['ProductoExibidoCorrectamente'];
                $parameters['MotivoProductoNoExibidoCorrectamente'] = $_POST['MotivoProductoNoExibidoCorrectamente'];
                $parameters['PotencialConsumoCompras'] = $_POST['PotencialConsumoCompras'];
                $parameters['PotencialConsumoComprasObsv'] = isset($_POST['PotencialConsumoComprasObsv']) ? $_POST['PotencialConsumoComprasObsv'] : "";
                $parameters['CantidadTrabajadores'] = $_POST['CantidadTrabajadores'];
                $parameters['Antiguedad'] = $_POST['Antiguedad'];
                $parameters['AntiguedadOtra'] = isset($_POST['AntiguedadOtra'])? $_POST['AntiguedadOtra'] : "";
                $parameters['PreferenciaResMarca1'] = isset($_POST['PreferenciaResMarca1']) ? $_POST['PreferenciaResMarca1'] : "";
                $parameters['PreferenciaResOtro1'] = isset($_POST['PreferenciaResOtro1']) ? $_POST['PreferenciaResOtro1'] : "";
                $parameters['PreferenciaResMarca2'] = isset($_POST['PreferenciaResMarca2']) ? $_POST['PreferenciaResMarca2'] : "";
                $parameters['PreferenciaResOtro2'] = isset($_POST['PreferenciaResOtro2']) ? $_POST['PreferenciaResOtro2'] : "";
                $parameters['PreferenciaResMarca3'] = isset($_POST['PreferenciaResMarca3']) ? $_POST['PreferenciaResMarca3'] : "";
                $parameters['PreferenciaResOtro3'] = isset($_POST['PreferenciaResOtro3']) ? $_POST['PreferenciaResOtro3'] : "";
                $parameters['PreferenciaGastMarca1'] = isset($_POST['PreferenciaGastMarca1']) ? $_POST['PreferenciaGastMarca1'] : "";
                $parameters['PreferenciaGastOtro1'] = isset($_POST['PreferenciaGastOtro1']) ? $_POST['PreferenciaGastOtro1'] : "";
                $parameters['PreferenciaGastMarca2'] = isset($_POST['PreferenciaGastMarca2']) ? $_POST['PreferenciaGastMarca2'] : "";
                $parameters['PreferenciaGastOtro2'] = isset($_POST['PreferenciaGastOtro2']) ? $_POST['PreferenciaGastOtro2'] : "";
                $parameters['PreferenciaGastMarca3'] = isset($_POST['PreferenciaGastMarca3']) ? $_POST['PreferenciaGastMarca3'] : "";
                $parameters['PreferenciaGastOtro3'] = isset($_POST['PreferenciaGastOtro3']) ? $_POST['PreferenciaGastOtro3'] : "";
                $parameters['NombreEmpresaProvA'] = isset($_POST['NombreEmpresaProvA']) ? $_POST['NombreEmpresaProvA'] : "";
                $parameters['NombreProdPorMercadoProvA'] = isset($_POST['NombreProdPorMercadoProvA']) ? $_POST['NombreProdPorMercadoProvA'] : "";
                $parameters['PorcCompraDelTotalProvA'] = isset($_POST['PorcCompraDelTotalProvA']) ? $_POST['PorcCompraDelTotalProvA'] : "";
                $parameters['PrePorLineaProvA'] = isset($_POST['PrePorLineaProvA']) ? $_POST['PrePorLineaProvA'] : "";
                $parameters['PlazoPagoProvA'] = isset($_POST['PlazoPagoProvA']) ? $_POST['PlazoPagoProvA'] : "";
                $parameters['NombreEmpresaProvB'] = isset($_POST['NombreEmpresaProvB']) ? $_POST['NombreEmpresaProvB'] : "";
                $parameters['NombreProdPorMercadoProvB'] = isset($_POST['NombreProdPorMercadoProvB']) ? $_POST['NombreProdPorMercadoProvB'] : "";
                $parameters['PorcCompraDelTotalProvB'] = isset($_POST['PorcCompraDelTotalProvB']) ? $_POST['PorcCompraDelTotalProvB'] : "";
                $parameters['PrePorLineaProvB'] = isset($_POST['PrePorLineaProvB']) ? $_POST['PrePorLineaProvB'] : "";
                $parameters['PlazoPagoProvB'] = isset($_POST['PlazoPagoProvB']) ? $_POST['PlazoPagoProvB'] : "";

                switch ($accion) {
                    case 'GUARDAR':
                        $parameters['idPlanilla'] = $_POST['idPlanilla'];
                        $respuesta = $WS->Web_Planillas_GuardaC01($parameters);

                        if ($respuesta->Web_Planillas_GuardaC01Result == "OK") {
                            $result['error'] = false;
                        } else {
                            $result['error'] = true;
                            $result['msj'] = "Error: " . $respuesta->Web_Planillas_GuardaC01Result;
                        }
                        break;
                }
                break;
            case "ACCIONCLIENTE":
                $parameters['FechaVisita1'] = $_POST['FechaVisita1'];
                $parameters['Comercial'] = isset($_POST['Comercial']) ? $_POST['Comercial'] : '';
                $parameters['Cliente'] = isset($_POST['Cliente']) ? $_POST['Cliente'] : '';
                $parameters['NumeroCuenta'] = isset($_POST['NumeroCuenta']) ? $_POST['NumeroCuenta'] : '';
                $parameters['TipoCliente'] = isset($_POST['TipoCliente']) ? $_POST['TipoCliente'] : '';
                $parameters['Fidelizacion'] = isset($_POST['Fidelizacion']) ? $_POST['Fidelizacion'] : '';
                $parameters['PenetracionMercado'] = isset($_POST['PenetracionMercado']) ? $_POST['PenetracionMercado'] : '';
                $parameters['ObjetivoVisita1'] = isset($_POST['ObjetivoVisita1']) ? $_POST['ObjetivoVisita1'] : '';
                $parameters['StatusNegocioCotizar'] = isset($_POST['StatusNegocioCotizar']) ? $_POST['StatusNegocioCotizar'] : '';
                $parameters['StatusNegocioCotizado'] = isset($_POST['StatusNegocioCotizado']) ? $_POST['StatusNegocioCotizado'] : '';
                $parameters['StatusNegocioCerrado'] = isset($_POST['StatusNegocioCerrado']) ? $_POST['StatusNegocioCerrado'] : '';
                $parameters['ProximasVisitas'] = isset($_POST['ProximasVisitas']) ? $_POST['ProximasVisitas'] : '';
                $parameters['AccionesPorLinea'] = isset($_POST['AccionesPorLinea']) ? $_POST['AccionesPorLinea'] : '';
                $parameters['ResultadoDeAcciones'] = isset($_POST['ResultadoDeAcciones']) ? $_POST['ResultadoDeAcciones'] : '';
                $parameters['FechaVisita2'] = $_POST['FechaVisita2'];
                $parameters['ObjetivoVisita2'] = isset($_POST['ObjetivoVisita2']) ? $_POST['ObjetivoVisita2'] : '';
                $parameters['SeguimientoVisita2'] = isset($_POST['SeguimientoVisita2']) ? $_POST['SeguimientoVisita2'] : '';
                $parameters['ResultadoVisita2'] = isset($_POST['ResultadoVisita2']) ? $_POST['ResultadoVisita2'] : '';
                $parameters['StatusNegocioVisita2'] = isset($_POST['StatusNegocioVisita2']) ? $_POST['StatusNegocioVisita2'] : '';
                $parameters['ProximasVisitasVisita2'] = isset($_POST['ProximasVisitasVisita2']) ? $_POST['ProximasVisitasVisita2'] : '';
                $parameters['FechaVisita3'] = $_POST['FechaVisita3'];
                $parameters['ObjetivoVisita3'] = isset($_POST['ObjetivoVisita3']) ? $_POST['ObjetivoVisita3'] : '';
                $parameters['SeguimientoVisita3'] = isset($_POST['SeguimientoVisita3']) ? $_POST['SeguimientoVisita3'] : '';
                $parameters['ResultadoVisita3'] = isset($_POST['ResultadoVisita3']) ? $_POST['ResultadoVisita3'] : '';
                $parameters['StatusNegocioVisita3'] = isset($_POST['StatusNegocioVisita3']) ? $_POST['StatusNegocioVisita3'] : '';
                $parameters['ProximasVisitasVisita3'] = isset($_POST['ProximasVisitasVisita3']) ? $_POST['ProximasVisitasVisita3'] : '';
                $parameters['FechaVisita4'] = $_POST['FechaVisita4'];
                $parameters['ObjetivoVisita4'] = isset($_POST['ObjetivoVisita4']) ? $_POST['ObjetivoVisita4'] : '';
                $parameters['SeguimientoVisita4'] = isset($_POST['SeguimientoVisita4']) ? $_POST['SeguimientoVisita4'] : '';
                $parameters['ResultadoVisita4'] = isset($_POST['ResultadoVisita4']) ? $_POST['ResultadoVisita4'] : '';
                $parameters['StatusNegocioVisita4'] = isset($_POST['StatusNegocioVisita4']) ? $_POST['StatusNegocioVisita4'] : '';
                $parameters['ProximasVisitasVisita4'] = isset($_POST['ProximasVisitasVisita4']) ? $_POST['ProximasVisitasVisita4'] : '';
                $parameters['FechaVisita5'] = $_POST['FechaVisita5'];
                $parameters['ObjetivoVisita5'] = isset($_POST['ObjetivoVisita5']) ? $_POST['ObjetivoVisita5'] : '';
                $parameters['SeguimientoVisita5'] = isset($_POST['SeguimientoVisita5']) ? $_POST['SeguimientoVisita5'] : '';
                $parameters['ResultadoVisita5'] = isset($_POST['ResultadoVisita5']) ? $_POST['ResultadoVisita5'] : '';
                $parameters['StatusNegocioVisita5'] = isset($_POST['StatusNegocioVisita5']) ? $_POST['StatusNegocioVisita5'] : '';
                $parameters['ProximasVisitasVisita5'] = isset($_POST['ProximasVisitasVisita5']) ? $_POST['ProximasVisitasVisita5'] : '';
                $parameters['FechaVisita6'] = $_POST['FechaVisita6'];
                $parameters['ObjetivoVisita6'] = isset($_POST['ObjetivoVisita6']) ? $_POST['ObjetivoVisita6'] : '';
                $parameters['SeguimientoVisita6'] = isset($_POST['SeguimientoVisita6']) ? $_POST['SeguimientoVisita6'] : '';
                $parameters['ResultadoVisita6'] = isset($_POST['ResultadoVisita6']) ? $_POST['ResultadoVisita6'] : '';
                $parameters['StatusNegocioVisita6'] = isset($_POST['StatusNegocioVisita6']) ? $_POST['StatusNegocioVisita6'] : '';
                $parameters['ProximasVisitasVisita6'] = isset($_POST['ProximasVisitasVisita6']) ? $_POST['ProximasVisitasVisita6'] : '';
                $parameters['FechaVisita7'] = $_POST['FechaVisita7'];
                $parameters['ObjetivoVisita7'] = isset($_POST['ObjetivoVisita7']) ? $_POST['ObjetivoVisita7'] : '';
                $parameters['SeguimientoVisita7'] = isset($_POST['SeguimientoVisita7']) ? $_POST['SeguimientoVisita7'] : '';
                $parameters['ResultadoVisita7'] = isset($_POST['ResultadoVisita7']) ? $_POST['ResultadoVisita7'] : '';
                $parameters['StatusNegocioVisita7'] = isset($_POST['StatusNegocioVisita7']) ? $_POST['StatusNegocioVisita7'] : '';
                $parameters['ProximasVisitasVisita7'] = isset($_POST['ProximasVisitasVisita7']) ? $_POST['ProximasVisitasVisita7'] : '';
                $parameters['Observaciones'] = isset($_POST['Observaciones']) ? $_POST['Observaciones'] : '';
                //Checks
                $parameters['AccionVendReforzarVentaja'] = isset($_POST['AccionVendReforzarVentaja']) ? 'true' : 'false';
                $parameters['AccionVendPrecioCompetitivo'] = isset($_POST['AccionVendPrecioCompetitivo']) ? 'true' : 'false';
                $parameters['AccionVendStkyTiemposEntrega'] = isset($_POST['AccionVendStkyTiemposEntrega']) ? 'true' : 'false';
                $parameters['AccionVendReferenciaDeColegas'] = isset($_POST['AccionVendReferenciaDeColegas']) ? 'true' : 'false';
                $parameters['AccionCombDemoProd'] = isset($_POST['AccionCombDemoProd']) ? 'true' : 'false';
                $parameters['AccionCombDemoGrupal'] = isset($_POST['AccionCombDemoGrupal']) ? 'true' : 'false';
                $parameters['AccionCombDescuentoPuntual'] = isset($_POST['AccionCombDescuentoPuntual']) ? 'true' : 'false';
                $parameters['AccionVendHDescuentoSostenido'] = isset($_POST['AccionVendHDescuentoSostenido']) ? 'true' : 'false';
                $parameters['AccionVendHBonificacionSinGargo'] = isset($_POST['AccionVendHBonificacionSinGargo']) ? 'true' : 'false';
                $parameters['AccionVendHBonificacionCompraMensual'] = isset($_POST['AccionVendHBonificacionCompraMensual']) ? 'true' : 'false';
                $parameters['AccionVendHPlazoPago'] = isset($_POST['AccionVendHPlazoPago']) ? 'true' : 'false';
                switch ($accion) {
                    case 'GUARDAR':
                        $parameters['idPlanilla'] = $_POST['idPlanilla'];
                        $respuesta = $WS->Web_Planillas_GuardaC02($parameters);

                        if ($respuesta->Web_Planillas_GuardaC02Result == "OK") {
                            $result['error'] = false;
                        } else {
                            $result['error'] = true;
                            $result['msj'] = "Error: " . $respuesta->Web_Planillas_GuardaC02Result;
                        }
                        break;
                }
                break;
            case "VISITA":
                $parameters['Periodo_desde'] = $_POST['periodo_desde'] ;
                $parameters['Periodo_hasta'] = $_POST['periodo_hasta'] ;
                $parameters['RepresentanteComercial'] = isset($_POST['RepresentanteComercial'])?$_POST['RepresentanteComercial'] : '';
                $parameters['Comercial'] = isset($_POST['Comercial'])?$_POST['Comercial'] : '';
                $parameters['Cliente'] = isset($_POST['Cliente'])?$_POST['Cliente'] : '';
                $parameters['NumeroCuenta'] = isset($_POST['NumeroCuenta'])?$_POST['NumeroCuenta'] : '';
                $parameters['LunesMC1'] = isset($_POST['LunesMC1'])?$_POST['LunesMC1'] : '';
                $parameters['LunesMC1opt'] = isset($_POST['LunesMC1opt'])?$_POST['LunesMC1opt'] : '-';
                $parameters['LunesMC2'] = isset($_POST['LunesMC2'])?$_POST['LunesMC2'] : '';
                $parameters['LunesMC2opt'] = isset($_POST['LunesMC2opt'])?$_POST['LunesMC2opt'] : '-';
                $parameters['LunesMC3'] = isset($_POST['LunesMC3'])?$_POST['LunesMC3'] : '';
                $parameters['LunesMC3opt'] = isset($_POST['LunesMC3opt'])?$_POST['LunesMC3opt'] : '-';
                $parameters['LunesMC4'] = isset($_POST['LunesMC4'])?$_POST['LunesMC4'] : '';
                $parameters['LunesMC4opt'] = isset($_POST['LunesMC4opt'])?$_POST['LunesMC4opt'] : '-';
                $parameters['LunesMC5'] = isset($_POST['LunesMC5'])?$_POST['LunesMC5'] : '';
                $parameters['LunesMC5opt'] = isset($_POST['LunesMC5opt'])?$_POST['LunesMC5opt'] : '-';
                $parameters['LunesMC6'] = isset($_POST['LunesMC6'])?$_POST['LunesMC6'] : '';
                $parameters['LunesMC6opt'] = isset($_POST['LunesMC6opt'])?$_POST['LunesMC6opt'] : '-';
                $parameters['LunesTC1'] = isset($_POST['LunesTC1'])?$_POST['LunesTC1'] : '';
                $parameters['LunesTC1opt'] = isset($_POST['LunesTC1opt'])?$_POST['LunesTC1opt'] : '-';
                $parameters['LunesTC2'] = isset($_POST['LunesTC2'])?$_POST['LunesTC2'] : '';
                $parameters['LunesTC2opt'] = isset($_POST['LunesTC2opt'])?$_POST['LunesTC2opt'] : '-';
                $parameters['LunesTC3'] = isset($_POST['LunesTC3'])?$_POST['LunesTC3'] : '';
                $parameters['LunesTC3opt'] = isset($_POST['LunesTC3opt'])?$_POST['LunesTC3opt'] : '-';
                $parameters['LunesTC4'] = isset($_POST['LunesTC4'])?$_POST['LunesTC4'] : '';
                $parameters['LunesTC4opt'] = isset($_POST['LunesTC4opt'])?$_POST['LunesTC4opt'] : '-';
                $parameters['LunesTC5'] = isset($_POST['LunesTC5'])?$_POST['LunesTC5'] : '';
                $parameters['LunesTC5opt'] = isset($_POST['LunesTC5opt'])?$_POST['LunesTC5opt'] : '-';
                $parameters['LunesTC6'] = isset($_POST['LunesTC6'])?$_POST['LunesTC6'] : '';
                $parameters['LunesTC6opt'] = isset($_POST['LunesTC6opt'])?$_POST['LunesTC6opt'] : '-';
                $parameters['MartesMC1'] = isset($_POST['MartesMC1'])?$_POST['MartesMC1'] : '';
                $parameters['MartesMC1opt'] = isset($_POST['MartesMC1opt'])?$_POST['MartesMC1opt'] : '-';
                $parameters['MartesMC2'] = isset($_POST['MartesMC2'])?$_POST['MartesMC2'] : '';
                $parameters['MartesMC2opt'] = isset($_POST['MartesMC2opt'])?$_POST['MartesMC2opt'] : '-';
                $parameters['MartesMC3'] = isset($_POST['MartesMC3'])?$_POST['MartesMC3'] : '';
                $parameters['MartesMC3opt'] = isset($_POST['MartesMC3opt'])?$_POST['MartesMC3opt'] : '-';
                $parameters['MartesMC4'] = isset($_POST['MartesMC4'])?$_POST['MartesMC4'] : '';
                $parameters['MartesMC4opt'] = isset($_POST['MartesMC4opt'])?$_POST['MartesMC4opt'] : '-';
                $parameters['MartesMC5'] = isset($_POST['MartesMC5'])?$_POST['MartesMC5'] : '';
                $parameters['MartesMC5opt'] = isset($_POST['MartesMC5opt'])?$_POST['MartesMC5opt'] : '-';
                $parameters['MartesMC6'] = isset($_POST['MartesMC6'])?$_POST['MartesMC6'] : '';
                $parameters['MartesMC6opt'] = isset($_POST['MartesMC6opt'])?$_POST['MartesMC6opt'] : '-';
                $parameters['MartesTC1'] = isset($_POST['MartesTC1'])?$_POST['MartesTC1'] : '';
                $parameters['MartesTC1opt'] = isset($_POST['MartesTC1opt'])?$_POST['MartesTC1opt'] : '-';
                $parameters['MartesTC2'] = isset($_POST['MartesTC2'])?$_POST['MartesTC2'] : '';
                $parameters['MartesTC2opt'] = isset($_POST['MartesTC2opt'])?$_POST['MartesTC2opt'] : '-';
                $parameters['MartesTC3'] = isset($_POST['MartesTC3'])?$_POST['MartesTC3'] : '';
                $parameters['MartesTC3opt'] = isset($_POST['MartesTC3opt'])?$_POST['MartesTC3opt'] : '-';
                $parameters['MartesTC4'] = isset($_POST['MartesTC4'])?$_POST['MartesTC4'] : '';
                $parameters['MartesTC4opt'] = isset($_POST['MartesTC4opt'])?$_POST['MartesTC4opt'] : '-';
                $parameters['MartesTC5'] = isset($_POST['MartesTC5'])?$_POST['MartesTC5'] : '';
                $parameters['MartesTC5opt'] = isset($_POST['MartesTC5opt'])?$_POST['MartesTC5opt'] : '-';
                $parameters['MartesTC6'] = isset($_POST['MartesTC6'])?$_POST['MartesTC6'] : '';
                $parameters['MartesTC6opt'] = isset($_POST['MartesTC6opt'])?$_POST['MartesTC6opt'] : '-';
                $parameters['MiercolesMC1'] = isset($_POST['MiercolesMC1'])?$_POST['MiercolesMC1'] : '';
                $parameters['MiercolesMC1opt'] = isset($_POST['MiercolesMC1opt'])?$_POST['MiercolesMC1opt'] : '-';
                $parameters['MiercolesMC2'] = isset($_POST['MiercolesMC2'])?$_POST['MiercolesMC2'] : '';
                $parameters['MiercolesMC2opt'] = isset($_POST['MiercolesMC2opt'])?$_POST['MiercolesMC2opt'] : '-';
                $parameters['MiercolesMC3'] = isset($_POST['MiercolesMC3'])?$_POST['MiercolesMC3'] : '';
                $parameters['MiercolesMC3opt'] = isset($_POST['MiercolesMC3opt'])?$_POST['MiercolesMC3opt'] : '-';
                $parameters['MiercolesMC4'] = isset($_POST['MiercolesMC4'])?$_POST['MiercolesMC4'] : '';
                $parameters['MiercolesMC4opt'] = isset($_POST['MiercolesMC4opt'])?$_POST['MiercolesMC4opt'] : '-';
                $parameters['MiercolesMC5'] = isset($_POST['MiercolesMC5'])?$_POST['MiercolesMC5'] : '';
                $parameters['MiercolesMC5opt'] = isset($_POST['MiercolesMC5opt'])?$_POST['MiercolesMC5opt'] : '-';
                $parameters['MiercolesMC6'] = isset($_POST['MiercolesMC6'])?$_POST['MiercolesMC6'] : '';
                $parameters['MiercolesMC6opt'] = isset($_POST['MiercolesMC6opt'])?$_POST['MiercolesMC6opt'] : '-';
                $parameters['MiercolesTC1'] = isset($_POST['MiercolesTC1'])?$_POST['MiercolesTC1'] : '';
                $parameters['MiercolesTC1opt'] = isset($_POST['MiercolesTC1opt'])?$_POST['MiercolesTC1opt'] : '-';
                $parameters['MiercolesTC2'] = isset($_POST['MiercolesTC2'])?$_POST['MiercolesTC2'] : '';
                $parameters['MiercolesTC2opt'] = isset($_POST['MiercolesTC2opt'])?$_POST['MiercolesTC2opt'] : '-';
                $parameters['MiercolesTC3'] = isset($_POST['MiercolesTC3'])?$_POST['MiercolesTC3'] : '';
                $parameters['MiercolesTC3opt'] = isset($_POST['MiercolesTC3opt'])?$_POST['MiercolesTC3opt'] : '-';
                $parameters['MiercolesTC4'] = isset($_POST['MiercolesTC4'])?$_POST['MiercolesTC4'] : '';
                $parameters['MiercolesTC4opt'] = isset($_POST['MiercolesTC4opt'])?$_POST['MiercolesTC4opt'] : '-';
                $parameters['MiercolesTC5'] = isset($_POST['MiercolesTC5'])?$_POST['MiercolesTC5'] : '';
                $parameters['MiercolesTC5opt'] = isset($_POST['MiercolesTC5opt'])?$_POST['MiercolesTC5opt'] : '-';
                $parameters['MiercolesTC6'] = isset($_POST['MiercolesTC6'])?$_POST['MiercolesTC6'] : '';
                $parameters['MiercolesTC6opt'] = isset($_POST['MiercolesTC6opt'])?$_POST['MiercolesTC6opt'] : '-';
                $parameters['JuevesMC1'] = isset($_POST['JuevesMC1'])?$_POST['JuevesMC1'] : '';
                $parameters['JuevesMC1opt'] = isset($_POST['JuevesMC1opt'])?$_POST['JuevesMC1opt'] : '-';
                $parameters['JuevesMC2'] = isset($_POST['JuevesMC2'])?$_POST['JuevesMC2'] : '';
                $parameters['JuevesMC2opt'] = isset($_POST['JuevesMC2opt'])?$_POST['JuevesMC2opt'] : '-';
                $parameters['JuevesMC3'] = isset($_POST['JuevesMC3'])?$_POST['JuevesMC3'] : '';
                $parameters['JuevesMC3opt'] = isset($_POST['JuevesMC3opt'])?$_POST['JuevesMC3opt'] : '-';
                $parameters['JuevesMC4'] = isset($_POST['JuevesMC4'])?$_POST['JuevesMC4'] : '';
                $parameters['JuevesMC4opt'] = isset($_POST['JuevesMC4opt'])?$_POST['JuevesMC4opt'] : '-';
                $parameters['JuevesMC5'] = isset($_POST['JuevesMC5'])?$_POST['JuevesMC5'] : '';
                $parameters['JuevesMC5opt'] = isset($_POST['JuevesMC5opt'])?$_POST['JuevesMC5opt'] : '-';
                $parameters['JuevesMC6'] = isset($_POST['JuevesMC6'])?$_POST['JuevesMC6'] : '';
                $parameters['JuevesMC6opt'] = isset($_POST['JuevesMC6opt'])?$_POST['JuevesMC6opt'] : '-';
                $parameters['JuevesTC1'] = isset($_POST['JuevesTC1'])?$_POST['JuevesTC1'] : '';
                $parameters['JuevesTC1opt'] = isset($_POST['JuevesTC1opt'])?$_POST['JuevesTC1opt'] : '-';
                $parameters['JuevesTC2'] = isset($_POST['JuevesTC2'])?$_POST['JuevesTC2'] : '';
                $parameters['JuevesTC2opt'] = isset($_POST['JuevesTC2opt'])?$_POST['JuevesTC2opt'] : '-';
                $parameters['JuevesTC3'] = isset($_POST['JuevesTC3'])?$_POST['JuevesTC3'] : '';
                $parameters['JuevesTC3opt'] = isset($_POST['JuevesTC3opt'])?$_POST['JuevesTC3opt'] : '-';
                $parameters['JuevesTC4'] = isset($_POST['JuevesTC4'])?$_POST['JuevesTC4'] : '';
                $parameters['JuevesTC4opt'] = isset($_POST['JuevesTC4opt'])?$_POST['JuevesTC4opt'] : '-';
                $parameters['JuevesTC5'] = isset($_POST['JuevesTC5'])?$_POST['JuevesTC5'] : '';
                $parameters['JuevesTC5opt'] = isset($_POST['JuevesTC5opt'])?$_POST['JuevesTC5opt'] : '-';
                $parameters['JuevesTC6'] = isset($_POST['JuevesTC6'])?$_POST['JuevesTC6'] : '';
                $parameters['JuevesTC6opt'] = isset($_POST['JuevesTC6opt'])?$_POST['JuevesTC6opt'] : '-';
                $parameters['ViernesMC1'] = isset($_POST['ViernesMC1'])?$_POST['ViernesMC1'] : '';
                $parameters['ViernesMC1opt'] = isset($_POST['ViernesMC1opt'])?$_POST['ViernesMC1opt'] : '-';
                $parameters['ViernesMC2'] = isset($_POST['ViernesMC2'])?$_POST['ViernesMC2'] : '';
                $parameters['ViernesMC2opt'] = isset($_POST['ViernesMC2opt'])?$_POST['ViernesMC2opt'] : '-';
                $parameters['ViernesMC3'] = isset($_POST['ViernesMC3'])?$_POST['ViernesMC3'] : '';
                $parameters['ViernesMC3opt'] = isset($_POST['ViernesMC3opt'])?$_POST['ViernesMC3opt'] : '-';
                $parameters['ViernesMC4'] = isset($_POST['ViernesMC4'])?$_POST['ViernesMC4'] : '';
                $parameters['ViernesMC4opt'] = isset($_POST['ViernesMC4opt'])?$_POST['ViernesMC4opt'] : '-';
                $parameters['ViernesMC5'] = isset($_POST['ViernesMC5'])?$_POST['ViernesMC5'] : '';
                $parameters['ViernesMC5opt'] = isset($_POST['ViernesMC5opt'])?$_POST['ViernesMC5opt'] : '-';
                $parameters['ViernesMC6'] = isset($_POST['ViernesMC6'])?$_POST['ViernesMC6'] : '';
                $parameters['ViernesMC6opt'] = isset($_POST['ViernesMC6opt'])?$_POST['ViernesMC6opt'] : '-';
                $parameters['ViernesTC1'] = isset($_POST['ViernesTC1'])?$_POST['ViernesTC1'] : '';
                $parameters['ViernesTC1opt'] = isset($_POST['ViernesTC1opt'])?$_POST['ViernesTC1opt'] : '-';
                $parameters['ViernesTC2'] = isset($_POST['ViernesTC2'])?$_POST['ViernesTC2'] : '';
                $parameters['ViernesTC2opt'] = isset($_POST['ViernesTC2opt'])?$_POST['ViernesTC2opt'] : '-';
                $parameters['ViernesTC3'] = isset($_POST['ViernesTC3|'])?$_POST['ViernesTC3|'] : '';
                $parameters['ViernesTC3'] = isset($_POST['ViernesTC3|opt'])?$_POST['ViernesTC3|opt'] : '-';
                $parameters['ViernesTC4'] = isset($_POST['ViernesTC4'])?$_POST['ViernesTC4'] : '';
                $parameters['ViernesTC4opt'] = isset($_POST['ViernesTC4opt'])?$_POST['ViernesTC4opt'] : '-';
                $parameters['ViernesTC5'] = isset($_POST['ViernesTC5'])?$_POST['ViernesTC5'] : '';
                $parameters['ViernesTC5opt'] = isset($_POST['ViernesTC5opt'])?$_POST['ViernesTC5opt'] : '-';
                $parameters['ViernesTC6'] = isset($_POST['ViernesTC6'])?$_POST['ViernesTC6'] : '';
                $parameters['ViernesTC6opt'] = isset($_POST['ViernesTC6opt'])?$_POST['ViernesTC6opt'] : '-';
                $parameters['SabadoMC1'] = isset($_POST['SabadoMC1'])?$_POST['SabadoMC1'] : '';
                $parameters['SabadoMC1opt'] = isset($_POST['SabadoMC1opt'])?$_POST['SabadoMC1opt'] : '-';
                $parameters['SabadoMC2'] = isset($_POST['SabadoMC2'])?$_POST['SabadoMC2'] : '';
                $parameters['SabadoMC2opt'] = isset($_POST['SabadoMC2opt'])?$_POST['SabadoMC2opt'] : '-';
                $parameters['SabadoMC3'] = isset($_POST['SabadoMC3'])?$_POST['SabadoMC3'] : '';
                $parameters['SabadoMC3opt'] = isset($_POST['SabadoMC3opt'])?$_POST['SabadoMC3opt'] : '-';
                $parameters['SabadoMC4'] = isset($_POST['SabadoMC4'])?$_POST['SabadoMC4'] : '';
                $parameters['SabadoMC4opt'] = isset($_POST['SabadoMC4opt'])?$_POST['SabadoMC4opt'] : '-';
                $parameters['SabadoMC5'] = isset($_POST['SabadoMC5'])?$_POST['SabadoMC5'] : '';
                $parameters['SabadoMC5opt'] = isset($_POST['SabadoMC5opt'])?$_POST['SabadoMC5opt'] : '-';
                $parameters['SabadoMC6'] = isset($_POST['SabadoMC6'])?$_POST['SabadoMC6'] : '';
                $parameters['SabadoMC6opt'] = isset($_POST['SabadoMC6opt'])?$_POST['SabadoMC6opt'] : '-';
                $parameters['SabadoTC1'] = isset($_POST['SabadoTC1'])?$_POST['SabadoTC1'] : '';
                $parameters['SabadoTC1opt'] = isset($_POST['SabadoTC1opt'])?$_POST['SabadoTC1opt'] : '-';
                $parameters['SabadoTC2'] = isset($_POST['SabadoTC2'])?$_POST['SabadoTC2'] : '';
                $parameters['SabadoTC2opt'] = isset($_POST['SabadoTC2opt'])?$_POST['SabadoTC2opt'] : '-';
                $parameters['SabadoTC3'] = isset($_POST['SabadoTC3'])?$_POST['SabadoTC3'] : '';
                $parameters['SabadoTC3opt'] = isset($_POST['SabadoTC3opt'])?$_POST['SabadoTC3opt'] : '-';
                $parameters['SabadoTC4'] = isset($_POST['SabadoTC4'])?$_POST['SabadoTC4'] : '';
                $parameters['SabadoTC4opt'] = isset($_POST['SabadoTC4opt'])?$_POST['SabadoTC4opt'] : '-';
                $parameters['SabadoTC5'] = isset($_POST['SabadoTC5'])?$_POST['SabadoTC5'] : '';
                $parameters['SabadoTC5opt'] = isset($_POST['SabadoTC5opt'])?$_POST['SabadoTC5opt'] : '-';
                $parameters['SabadoTC6'] = isset($_POST['SabadoTC6'])?$_POST['SabadoTC6'] : '';
                $parameters['SabadoTC6opt'] = isset($_POST['SabadoTC6opt'])?$_POST['SabadoTC6opt'] : '-';
                $parameters['Observaciones'] = isset($_POST['Observaciones'])?$_POST['Observaciones'] : '';
                switch ($accion) {
                    case 'GUARDAR':

                        $parameters['idPlanilla'] = $_POST['idPlanilla'];
                        $respuesta = $WS->Web_Planillas_GuardaC03($parameters);

                        if ($respuesta->Web_Planillas_GuardaC03Result == "OK") {
                            $result['error'] = false;
                        } else {
                            $result['error'] = true;
                            $result['msj'] = "Error: " . $respuesta->Web_Planillas_GuardaC03Result;
                        }
                        break;
                }
                break;
        }
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