<?php

require_once("../../ComunicacionesREST/Rest.php");
require_once("../../Negocio/AccesoDatos/ConexionBD.php");
require_once("../../Negocio/Entidades/SolicitudModel.class.php");
require_once("../../Negocio/Entidades/ActividadsolicitudclasedirigidaModel.class.php");
require_once("../../Negocio/Entidades/DatosolicitudclasedirigidaModel.class.php");
require_once("../../Negocio/Entidades/DatosolicitudabonomensualModel.class.php");
require_once("../../Negocio/Entidades/helpers/DFC.class.php");
require_once("../../Negocio/Entidades/helpers/DSC.class.php");

class ReservasBO extends Rest{
    
    
    //put your code hereç
    private $con = NULL;
    private $_metodo;
    private $_argumentos;

    public function __construct() {
        parent::__construct();
    }

    private function devolverError($id) {
        $errores = array(
            array('estado' => "error", "msg" => "petición no encontrada"),
            array('estado' => "error", "msg" => "petición no aceptada"),
            array('estado' => "error", "msg" => "petición sin contenido"),
            array('estado' => "error", "msg" => "email o password incorrectos"),
            array('estado' => "error", "msg" => "error borrando usuario"),
            array('estado' => "error", "msg" => "error actualizando nombre de usuario"),
            array('estado' => "error", "msg" => "error buscando usuario por email"),
            array('estado' => "error", "msg" => "error creando usuario"),
            array('estado' => "error", "msg" => "usuario ya existe")
        );
        return $errores[$id];
    }

    public function procesarLLamada() {
        if (isset($_REQUEST['url'])) {
            //si por ejemplo pasamos explode('/','////controller///method////args///') el resultado es un array con elem vacios;
            //Array ( [0] => [1] => [2] => [3] => [4] => controller [5] => [6] => [7] => method [8] => [9] => [10] => [11] => args [12] => [13] => [14] => )
            $url = explode('/', trim($_REQUEST['url']));
            //con array_filter() filtramos elementos de un array pasando función callback, que es opcional.
            //si no le pasamos función callback, los elementos false o vacios del array serán borrados 
            //por lo tanto la entre la anterior función (explode) y esta eliminamos los '/' sobrantes de la URL
            $url = array_filter($url);
            $this->_metodo = strtolower(array_shift($url));
            $this->_argumentos = $url;
            $func = $this->_metodo;
            if ((int) method_exists($this, $func) > 0) {
                if (count($this->_argumentos) > 0) {
                    call_user_func_array(array($this, $this->_metodo), $this->_argumentos);
                } else {//si no lo llamamos sin argumentos, al metodo del controlador  
                    call_user_func(array($this, $this->_metodo));
                }
            }
            else
                $this->mostrarRespuesta($this->convertirJson($this->devolverError(0)), 404);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(0)), 404);
    }

    private function convertirJson($data) {
        return json_encode($data);
    }
    
    private function obtenerSolicitudesPendientes() {
        
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
                
        $tiposolicitud = $this->datosPeticion['TipoSolicitud'];
                
        $this->con = ConexionBD::getInstance();
        $sort = array(
            new DSC(SolicitudModel::FIELD_FECHASOLICITUD, DSC::ASC),
            new DSC(SolicitudModel:: FIELD_APELLIDOS, DSC::ASC)
        );
        
        $solicitud = new SolicitudModel();
        
        $solicitud->setIdTipoSolicitud($tiposolicitud);
        $solicitud->setGestionado(0);
        
        
        $filas = SolicitudModel::findByExample($this->con,$solicitud,$sort);
                                
        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['solicitudes'] = $array;
            $respuesta['numerosolicitudes'] = $num;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        else
        {
            $respuesta['numerosolicitudes'] = 0;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
    
    private function obtenerAbonosPendientes() {
        
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
                
        $tiposolicitud = $this->datosPeticion['TipoSolicitud'];
                
        $this->con = ConexionBD::getInstance();
        $sort = array(
            new DSC(SolicitudModel::FIELD_FECHASOLICITUD, DSC::ASC),
            new DSC(SolicitudModel:: FIELD_APELLIDOS, DSC::ASC)
        );
        
        $solicitud = new SolicitudModel();
        
        $solicitud->setIdTipoSolicitud($tiposolicitud);
        $solicitud->setGestionado(0);
        
        
        $filas = SolicitudModel::findByExample($this->con,$solicitud,$sort);
                                
        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['abonos'] = $array;
            $respuesta['numeroabonos'] = $num;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        else
        {
            $respuesta['numeroabonos'] = 0;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
    
    private function obtenerReservasFiltro() {
        
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
                
        $loc = $this->datosPeticion['Localizador'];
        $nom = $this->datosPeticion['Nombre'];
        $ape = $this->datosPeticion['Apellidos'];
        $dni = $this->datosPeticion['DNI'];
        $mail = $this->datosPeticion['Email'];
        
        $tsolicitud = $this->datosPeticion['TipoSolicitud'];
        $gestionado = $this->datosPeticion['Gestionado'];
        
        if($this->datosPeticion['FechaSolicitudDesde'] != '')
        $fsolicituddesde = date("Y-m-d",strtotime($this->datosPeticion['FechaSolicitudDesde']));
             
        if($this->datosPeticion['FechaSolicitudHasta'] != '')
        $fsolicitudhasta = date("Y-m-d",strtotime($this->datosPeticion['FechaSolicitudHasta']));
             
        
        $this->con = ConexionBD::getInstance();
        $sort = array(
            new DSC(SolicitudModel::FIELD_FECHASOLICITUD, DSC::ASC),
            new DSC(SolicitudModel::FIELD_APELLIDOS, DSC::ASC)
        );
               
        
        
        $solicitud = new SolicitudModel();
        
        
        $filter=array(
        new DFC(SolicitudModel::FIELD_LOCALIZADOR, $loc, DFC::CONTAINS),
        new DFC(SolicitudModel::FIELD_NOMBRE, $nom, DFC::CONTAINS),
        new DFC(SolicitudModel::FIELD_APELLIDOS, $ape, DFC::CONTAINS),
        new DFC(SolicitudModel::FIELD_DNI, $dni, DFC::CONTAINS),
        new DFC(SolicitudModel::FIELD_EMAIL, $mail, DFC::CONTAINS)
        );
        if($this->datosPeticion['FechaSolicitudDesde'] != '')
        array_push($filter, new DFC(SolicitudModel::FIELD_FECHASOLICITUD, $fsolicituddesde, DFC::GREATER));
        if($this->datosPeticion['FechaSolicitudHasta'] != '')
        array_push($filter, new DFC(SolicitudModel::FIELD_FECHASOLICITUD, $fsolicitudhasta, DFC::SMALLER));
        if($this->datosPeticion['TipoSolicitud']!=0)
        array_push($filter, new DFC(SolicitudModel::FIELD_IDTIPOSOLICITUD, $tsolicitud, DFC::EXACT));
        if($this->datosPeticion['Gestionado']!='')
        array_push($filter, new DFC(SolicitudModel::FIELD_GESTIONADO, $gestionado, DFC::EXACT));
        
        $filas=SolicitudModel::findByFilter($this->con, $filter, true, $sort);
        
        
        
        //$filas = SolicitudModel::findByExample($this->con,$solicitud,$sort);
                                
        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['solicitudes'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        else
        {
            $respuesta['estado'] = 'No se encontraron datos';
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
    
    private function obtenerSolicitudAbonoDiario() {
       // var_dump($SERVER);
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //el constructor del padre ya se encarga de sanear los datos de entrada  

        if (isset($this->datosPeticion['idSolicitud'])) {
            $idSolicitud = isset($this->datosPeticion['idSolicitud']);
            $this->con = ConexionBD::getInstance();
            
            $solicitud = new SolicitudModel();
            $fila = $solicitud->findById($this->con,$this->datosPeticion['idSolicitud']);

          
            $respuesta = "";
            if ($fila) {
                $respuesta['estado'] = 'correcto';
                $respuesta['abonodiario']['Nombre'] = $fila->getNombre();
                $respuesta['abonodiario']['Apellidos'] = $fila->getApellidos();
                $respuesta['abonodiario']['Email'] = $fila->getEMail();
                $respuesta['abonodiario']['DNI'] = $fila->getDni();
                $respuesta['abonodiario']['Gestionado'] = $fila->getGestionado();
                $respuesta['abonodiario']['Anulado'] = $fila->getAnulado();
                $respuesta['abonodiario']['FechaSolicitud'] = date("d-m-Y",strtotime($fila->getFechaSolicitud()));
                $respuesta['abonodiario']['FechaAbonoDiario'] = date("d-m-Y",strtotime($fila->getFechaAbonoDiario()));
                $respuesta['abonodiario']['Localizador'] = $fila->getLocalizador();
                $respuesta['abonodiario']['Confirmado'] = $fila->getConfirmado();

                $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
            }
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
        }
    }
    
    private function validarSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        if (isset($this->datosPeticion['idSolicitud'])) {

            $this->con = ConexionBD::getInstance();
            $solicitud = new SolicitudModel();

            $idSolicitud = $this->datosPeticion['idSolicitud'];
                        
            if (!empty($idSolicitud)) {
                                 
                $fila = $solicitud->findById($this->con,$this->datosPeticion['idSolicitud']);
                
                $idTipoSolicitud= $fila ->getIdTipoSolicitud();
                $idTipoTarifa = $fila->getIdTipoTarifa();
                $FechaSolicitud = $fila->getFechaSolicitud();
                $FechaAbonoDiario = $fila->getFechaAbonoDiario();
                $Nombre = $fila->getNombre();
                $Apellidos =$fila->getApellidos();
                $DNI= $fila->getDni();
                $EMail  = $fila->getEMail();
                $Direccion  = $fila->getDireccion();
                $CP = $fila->getCp();
                $Sexo = $fila->getSexo();
                $FechaNacimiento = $fila->getFechaNacimiento();
                $TutorLegal = $fila->getTutorLegal();
                $Localidad= $fila->getLocalidad();
                $Telefono1 = $fila->getTelefono1();
                $Telefono2= $fila->getTelefono2();
                $Provincia= $fila->getProvincia();
                $DescripcionSolicitud= $fila->getDescripcionSolicitud();
                $Otros= $fila->getOtros();
                $Localizador= $fila->getLocalizador();
                $Gestionado = $fila->getGestionado();
                $Anulado = $fila->getAnulado();
                $FechaDiario = $fila->getFechaAbonoDiario();
                $Confirmado = $fila->getConfirmado();
                                
                $solicitud->setIdSolicitud($idSolicitud);
                $solicitud->setIdTipoSolicitud($idTipoSolicitud);
                $solicitud->setIdTipoTarifa($idTipoTarifa);
                $solicitud->setFechaSolicitud($FechaSolicitud);
                $solicitud->setFechaAbonoDiario($FechaAbonoDiario);
                $solicitud->setNombre($Nombre);
                $solicitud->setApellidos($Apellidos);
                $solicitud->setDni($DNI);
                $solicitud->setEMail($EMail);
                $solicitud->setDireccion($Direccion);
                $solicitud->setCp($CP);
                $solicitud->setSexo($Sexo);
                $solicitud->setFechaNacimiento($FechaNacimiento);
                $solicitud->setTutorLegal($TutorLegal);
                $solicitud->setLocalidad($Localidad);
                $solicitud->setTelefono1($Telefono1);
                $solicitud->setTelefono2($Telefono2);
                $solicitud->setProvincia($Provincia);
                $solicitud->setDescripcionSolicitud($DescripcionSolicitud);
                $solicitud->setOtros($Otros);
                $solicitud->setLocalizador($Localizador);
                $solicitud->setGestionado(1);
                $solicitud->setAnulado($Anulado);
                $solicitud->setFechaAbonoDiario($FechaDiario);
                $solicitud->setConfirmado($Confirmado);
                
                $filasActualizadas = $solicitud->updateToDatabase($this->con);
                
                if (count($filasActualizadas) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "Solictud validada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }
	
	private function cancelarAnulacion() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        if (isset($this->datosPeticion['idSolicitud'])) {

            $this->con = ConexionBD::getInstance();
            $solicitud = new SolicitudModel();

            $idSolicitud = $this->datosPeticion['idSolicitud'];
                        
            if (!empty($idSolicitud)) {
                                 
                $fila = $solicitud->findById($this->con,$this->datosPeticion['idSolicitud']);
                
                $idTipoSolicitud= $fila ->getIdTipoSolicitud();
                $idTipoTarifa = $fila->getIdTipoTarifa();
                $FechaSolicitud = $fila->getFechaSolicitud();
                $FechaAbonoDiario = $fila->getFechaAbonoDiario();
                $Nombre = $fila->getNombre();
                $Apellidos =$fila->getApellidos();
                $DNI= $fila->getDni();
                $EMail  = $fila->getEMail();
                $Direccion  = $fila->getDireccion();
                $CP = $fila->getCp();
                $Sexo = $fila->getSexo();
                $FechaNacimiento = $fila->getFechaNacimiento();
                $TutorLegal = $fila->getTutorLegal();
                $Localidad= $fila->getLocalidad();
                $Telefono1 = $fila->getTelefono1();
                $Telefono2= $fila->getTelefono2();
                $Provincia= $fila->getProvincia();
                $DescripcionSolicitud= $fila->getDescripcionSolicitud();
                $Otros= $fila->getOtros();
                $Localizador= $fila->getLocalizador();
                $Gestionado = $fila->getGestionado();
                $Anulado = $fila->getAnulado();
                $FechaDiario = $fila->getFechaAbonoDiario();
                $Confirmado = $fila->getConfirmado();
                                
                $solicitud->setIdSolicitud($idSolicitud);
                $solicitud->setIdTipoSolicitud($idTipoSolicitud);
                $solicitud->setIdTipoTarifa($idTipoTarifa);
                $solicitud->setFechaSolicitud($FechaSolicitud);
                $solicitud->setFechaAbonoDiario($FechaAbonoDiario);
                $solicitud->setNombre($Nombre);
                $solicitud->setApellidos($Apellidos);
                $solicitud->setDni($DNI);
                $solicitud->setEMail($EMail);
                $solicitud->setDireccion($Direccion);
                $solicitud->setCp($CP);
                $solicitud->setSexo($Sexo);
                $solicitud->setFechaNacimiento($FechaNacimiento);
                $solicitud->setTutorLegal($TutorLegal);
                $solicitud->setLocalidad($Localidad);
                $solicitud->setTelefono1($Telefono1);
                $solicitud->setTelefono2($Telefono2);
                $solicitud->setProvincia($Provincia);
                $solicitud->setDescripcionSolicitud($DescripcionSolicitud);
                $solicitud->setOtros($Otros);
                $solicitud->setLocalizador($Localizador);
                $solicitud->setGestionado(0);
                $solicitud->setAnulado($Anulado);
                $solicitud->setFechaAbonoDiario($FechaDiario);
                $solicitud->setConfirmado($Confirmado);
                
                $filasActualizadas = $solicitud->updateToDatabase($this->con);
                
                if (count($filasActualizadas) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "Anulacion cancelada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }
    
    private function obtenerSolicitudAbonoMensual() {
       // var_dump($SERVER);
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //el constructor del padre ya se encarga de sanear los datos de entrada  

        if (isset($this->datosPeticion['idSolicitud'])) {
            $idSolicitud = isset($this->datosPeticion['idSolicitud']);
            
            $this->con = ConexionBD::getInstance();
            
            $solicitud = new SolicitudModel();
            $datosolicitud = new DatosolicitudabonomensualModel();
            
            $datosolicitud->setIdSolicitud($this->datosPeticion['idSolicitud']);
            
            $sortdatos = array(
            new DSC(DatosolicitudabonomensualModel::FIELD_IDSOLICITUD, DSC::ASC)
            );
//            
            $fila = $solicitud->findById($this->con,$this->datosPeticion['idSolicitud']);
            
//            $filterdatos=array(
//                new DFC(DatosolicitudabonomensualModel::FIELD_IDSOLICITUD, $this->datosPeticion['idSolicitud'], DFC::EXACT)
//            );
//            $filadatos = $datosolicitud->findByFilter($this->con,$filterdatos);
            
            
            $filadatos =  DatosolicitudabonomensualModel::findByExample($this->con,$datosolicitud,$sortdatos);
                        
//            $num = count($filadatos);
//            if ($num > 0) {
//
//                for ($i = 0; $i < $num; $i++) 
//                {
//                    $arraydatos[] = $filadatos[$i]->toHash();
//                }
//            }
          
            $respuesta = "";
            if ($fila) {
                $respuesta['estado'] = 'correcto';
                $respuesta['abonomensual']['Nombre'] = $fila->getNombre();
                $respuesta['abonomensual']['Apellidos'] = $fila->getApellidos();
                $respuesta['abonomensual']['Email'] = $fila->getEMail();
                $respuesta['abonomensual']['DNI'] = $fila->getDni();
                $respuesta['abonomensual']['Gestionado'] = $fila->getGestionado();
                $respuesta['abonomensual']['FechaSolicitud'] = date("d-m-Y",strtotime($fila->getFechaSolicitud()));
                $respuesta['abonomensual']['Localizador'] = $fila->getLocalizador();
                $respuesta['abonomensual']['Direccion'] = $fila->getDireccion();
                $respuesta['abonomensual']['FechaNacimiento'] = $fila->getFechaNacimiento();
                $respuesta['abonomensual']['Sexo'] = $fila->getSexo();
                $respuesta['abonomensual']['TutorLegal'] = $fila->getTutorLegal();
                $respuesta['abonomensual']['idTipoTarifa'] = $fila->getIdTipoTarifa();
                $respuesta['abonomensual']['CodigoPostal'] = $fila->getCp();
                $respuesta['abonomensual']['Localidad'] = $fila->getLocalidad();
                $respuesta['abonomensual']['Provincia'] = $fila->getProvincia();
                $respuesta['abonomensual']['Telefono1'] = $fila->getTelefono1();
                $respuesta['abonomensual']['Telefono2'] = $fila->getTelefono2();
                $respuesta['abonomensual']['Anulado'] = $fila->getAnulado();
                $respuesta['abonomensual']['Confirmado'] = $fila->getConfirmado();
                
                $respuesta['datossolicitud']['FechaInicio'] = date("d-m-Y",strtotime($filadatos[0]->getFechaInicio()));
                $respuesta['datossolicitud']['FechaFin']  = date("d-m-Y",strtotime($filadatos[0]->getFechaFin()));
                $respuesta['datossolicitud']['PrecioPagado']  = $filadatos[0]->getPrecioPagado();
                $respuesta['datossolicitud']['idDatosSolicitudAbonoMensual']  = $filadatos[0]->getIdDatosSolicitudAbonoMensual();
				$respuesta['datossolicitud']['idTipoAbono'] = $filadatos[0]->getIdTipoAbono();
                
                
                
                

                $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
            }
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
        }
    }
    
    private function obtenerSolicitudClasesDirigidas() {
       // var_dump($SERVER);
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //el constructor del padre ya se encarga de sanear los datos de entrada  

        if (isset($this->datosPeticion['idSolicitud'])) {
            $idSolicitud = isset($this->datosPeticion['idSolicitud']);
            $this->con = ConexionBD::getInstance();
            
            $solicitud = new SolicitudModel();
            $actividades = new ActividadsolicitudclasedirigidaModel();
            $datosbancarios = new DatosolicitudclasedirigidaModel();
            
            $sort = array(
            new DSC(ActividadsolicitudclasedirigidaModel::FIELD_IDACTIVIDAD, DSC::ASC)
            );
            
            $sortdatos = array(
            new DSC(DatosolicitudclasedirigidaModel::FIELD_IDSOLICITUD, DSC::ASC)
            );
            
                        
            $fila = $solicitud->findById($this->con,$this->datosPeticion['idSolicitud']);
            
            $filteractividades=array(
                new DFC(ActividadsolicitudclasedirigidaModel::FIELD_IDSOLICITUD, $this->datosPeticion['idSolicitud'], DFC::EXACT)
            );
            $filaactividades = $actividades->findByFilter($this->con,$filteractividades);
            
            $filterdatosbancarios=array(
                new DFC(DatosolicitudclasedirigidaModel::FIELD_IDSOLICITUD, $this->datosPeticion['idSolicitud'], DFC::EXACT)
            );
            $filadatosbancarios = $datosbancarios->findByFilter($this->con,$filterdatosbancarios);
            
            $num = count($filaactividades);
            if ($num > 0) {

                for ($i = 0; $i < $num; $i++) 
                {
                    $array[] = $filaactividades[$i]->toHash();
                }
            }
            
            $num = count($filadatosbancarios);
            if ($num > 0) {

                for ($i = 0; $i < $num; $i++) 
                {
                    $arraybanco[] = $filadatosbancarios[$i]->toHash();
                }
            }
            
            
            
            $respuesta = "";
            if ($fila) {
                $respuesta['estado'] = 'correcto';
                $respuesta['clasesdirigidas']['Nombre'] = $fila->getNombre();
                $respuesta['clasesdirigidas']['Apellidos'] = $fila->getApellidos();
                $respuesta['clasesdirigidas']['Email'] = $fila->getEMail();
                $respuesta['clasesdirigidas']['DNI'] = $fila->getDni();
                $respuesta['clasesdirigidas']['Gestionado'] = $fila->getGestionado();
                $respuesta['clasesdirigidas']['FechaSolicitud'] = date("d-m-Y",strtotime($fila->getFechaSolicitud()));
                $respuesta['clasesdirigidas']['Localizador'] = $fila->getLocalizador();
                $respuesta['clasesdirigidas']['Direccion'] = $fila->getDireccion();
                $respuesta['clasesdirigidas']['FechaNacimiento'] = date("d-m-Y",strtotime($fila->getFechaNacimiento()));
                $respuesta['clasesdirigidas']['Sexo'] = $fila->getSexo();
                $respuesta['clasesdirigidas']['TutorLegal'] = $fila->getTutorLegal();
                $respuesta['clasesdirigidas']['TipoTarifa'] = $fila->getIdTipoTarifa();
                $respuesta['clasesdirigidas']['CodigoPostal'] = $fila->getCp();
                $respuesta['clasesdirigidas']['Localidad'] = $fila->getLocalidad();
                $respuesta['clasesdirigidas']['Telefono1'] = $fila->getTelefono1();
                $respuesta['clasesdirigidas']['Telefono2'] = $fila->getTelefono2();
                $respuesta['clasesdirigidas']['Provincia'] = $fila->getProvincia();
                $respuesta['clasesdirigidas']['Sexo'] = $fila->getSexo();
                $respuesta['clasesdirigidas']['Anulado'] = $fila->getAnulado();
                $respuesta['clasesdirigidas']['Confirmado'] = $fila->getConfirmado();
                $respuesta['datosbancarios']['idDatos'] = $filadatosbancarios[0]->getIdDatosSolicitudClaseDirigida();
                $respuesta['datosbancarios']['Titular'] = $filadatosbancarios[0]->getTitular();
                $respuesta['datosbancarios']['IBAN'] = $filadatosbancarios[0]->getIban();
                $respuesta['datosbancarios']['Entidad'] = $filadatosbancarios[0]->getEntidad();
                $respuesta['datosbancarios']['Oficina'] = $filadatosbancarios[0]->getOficina();
                $respuesta['datosbancarios']['DigitoControl'] = $filadatosbancarios[0]->getDigitoControl();
                $respuesta['datosbancarios']['Cuenta'] = $filadatosbancarios[0]->getCuenta();
                
                
                //$respuesta['datosbancarios'][] = $arraybanco;
                
                $respuesta['actividades'] = $array;
                //$respuesta['datosbancarios'] = $arraybanco;
                    
                
                $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
            }
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
        }
    }
    
    private function obtenerSolicitudesSemana() {
        
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        
        $this->con = ConexionBD::getInstance();
        $sort = array(
            new DSC(SolicitudModel::FIELD_FECHASOLICITUD, DSC::ASC),
            new DSC(SolicitudModel:: FIELD_APELLIDOS, DSC::ASC)
        );
        
        $solicitud = new SolicitudModel();
        $solicitud->setIdTipoSolicitud(1);
        
        
        $filas = SolicitudModel::findByExample($this->con,$solicitud,$sort);
        $solicitud->setIdTipoSolicitud(2);
        
        
        $filasmensual = SolicitudModel::findByExample($this->con,$solicitud,$sort);
        $solicitud->setIdTipoSolicitud(3);
        
        
        $filasdiario = SolicitudModel::findByExample($this->con,$solicitud,$sort);
                                
        $num = count($filas);
        if ($num > 0) {
            
            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            //$respuesta['abonos'] = $array;
            $respuesta['clases'] = $num;
        }
        else
            $respuesta['clases']=0;
        
        $num = count($filasmensual);
        if ($num > 0) {
            
            for ($i = 0; $i < $num; $i++) {
                $array[] = $filasmensual[$i]->toHash();
            }
            //$respuesta['abonos'] = $array;
            $respuesta['mensual'] = $num;
        }
        else
            $respuesta['mensual']=0;
        
        $num = count($filasdiario);
        if ($num > 0) {
            
            for ($i = 0; $i < $num; $i++) {
                $array[] = $filasdiario[$i]->toHash();
            }
            //$respuesta['abonos'] = $array;
            $respuesta['diario'] = $num;
        }
        else
            $respuesta['diario'] = 0;
        $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
    
    private function anularSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        if (isset($this->datosPeticion['idSolicitud'])) {

            $this->con = ConexionBD::getInstance();
            $solicitud = new SolicitudModel();

            $idSolicitud = $this->datosPeticion['idSolicitud'];
                        
            if (!empty($idSolicitud)) {
                                 
                $fila = $solicitud->findById($this->con,$this->datosPeticion['idSolicitud']);
                
                $idTipoSolicitud= $fila ->getIdTipoSolicitud();
                $idTipoTarifa = $fila->getIdTipoTarifa();
                $FechaSolicitud = $fila->getFechaSolicitud();
                $Nombre = $fila->getNombre();
                $Apellidos =$fila->getApellidos();
                $DNI= $fila->getDni();
                $EMail  = $fila->getEMail();
                $Direccion  = $fila->getDireccion();
                $CP = $fila->getCp();
                $Sexo = $fila->getSexo();
                $FechaNacimiento = $fila->getFechaNacimiento();
                $TutorLegal = $fila->getTutorLegal();
                $Localidad= $fila->getLocalidad();
                $Telefono1 = $fila->getTelefono1();
                $Telefono2= $fila->getTelefono2();
                $Provincia= $fila->getProvincia();
                $DescripcionSolicitud= $fila->getDescripcionSolicitud();
                $Otros= $fila->getOtros();
                $Localizador= $fila->getLocalizador();
                $Gestionado = $fila->getGestionado();
                $Anulado = $fila->getAnulado();
                $Confirmado = $fila->getConfirmado();
                $FechaDiario = $fila->getFechaAbonoDiario();
                                
                $solicitud->setIdSolicitud($idSolicitud);
                $solicitud->setIdTipoSolicitud($idTipoSolicitud);
                $solicitud->setIdTipoTarifa($idTipoTarifa);
                $solicitud->setFechaSolicitud($FechaSolicitud);
                $solicitud->setNombre($Nombre);
                $solicitud->setApellidos($Apellidos);
                $solicitud->setDni($DNI);
                $solicitud->setEMail($EMail);
                $solicitud->setDireccion($Direccion);
                $solicitud->setCp($CP);
                $solicitud->setSexo($Sexo);
                $solicitud->setFechaNacimiento($FechaNacimiento);
                $solicitud->setTutorLegal($TutorLegal);
                $solicitud->setLocalidad($Localidad);
                $solicitud->setTelefono1($Telefono1);
                $solicitud->setTelefono2($Telefono2);
                $solicitud->setProvincia($Provincia);
                $solicitud->setDescripcionSolicitud($DescripcionSolicitud);
                $solicitud->setOtros($Otros);
                $solicitud->setLocalizador($Localizador);
                $solicitud->setGestionado($Gestionado);
                $solicitud->setAnulado(1);
                $solicitud->setConfirmado($Confirmado);
                $solicitud->setFechaAbonoDiario($FechaDiario);
                
                $filasActualizadas = $solicitud->updateToDatabase($this->con);
                
                if (count($filasActualizadas) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "Solictud validada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }
    
    private function activarSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        if (isset($this->datosPeticion['idSolicitud'])) {

            $this->con = ConexionBD::getInstance();
            $solicitud = new SolicitudModel();

            $idSolicitud = $this->datosPeticion['idSolicitud'];
                        
            if (!empty($idSolicitud)) {
                                 
                $fila = $solicitud->findById($this->con,$this->datosPeticion['idSolicitud']);
                
                $idTipoSolicitud= $fila ->getIdTipoSolicitud();
                $idTipoTarifa = $fila->getIdTipoTarifa();
                $FechaSolicitud = $fila->getFechaSolicitud();
                $Nombre = $fila->getNombre();
                $Apellidos =$fila->getApellidos();
                $DNI= $fila->getDni();
                $EMail  = $fila->getEMail();
                $Direccion  = $fila->getDireccion();
                $CP = $fila->getCp();
                $Sexo = $fila->getSexo();
                $FechaNacimiento = $fila->getFechaNacimiento();
                $TutorLegal = $fila->getTutorLegal();
                $Localidad= $fila->getLocalidad();
                $Telefono1 = $fila->getTelefono1();
                $Telefono2= $fila->getTelefono2();
                $Provincia= $fila->getProvincia();
                $DescripcionSolicitud= $fila->getDescripcionSolicitud();
                $Otros= $fila->getOtros();
                $Localizador= $fila->getLocalizador();
                $Gestionado = $fila->getGestionado();
                $Anulado = $fila->getAnulado();
                $FechaDiario = $fila->getFechaAbonoDiario();
                $Confirmado = $fila->getConfirmado();
                                
                $solicitud->setIdSolicitud($idSolicitud);
                $solicitud->setIdTipoSolicitud($idTipoSolicitud);
                $solicitud->setIdTipoTarifa($idTipoTarifa);
                $solicitud->setFechaSolicitud($FechaSolicitud);
                $solicitud->setNombre($Nombre);
                $solicitud->setApellidos($Apellidos);
                $solicitud->setDni($DNI);
                $solicitud->setEMail($EMail);
                $solicitud->setDireccion($Direccion);
                $solicitud->setCp($CP);
                $solicitud->setSexo($Sexo);
                $solicitud->setFechaNacimiento($FechaNacimiento);
                $solicitud->setTutorLegal($TutorLegal);
                $solicitud->setLocalidad($Localidad);
                $solicitud->setTelefono1($Telefono1);
                $solicitud->setTelefono2($Telefono2);
                $solicitud->setProvincia($Provincia);
                $solicitud->setDescripcionSolicitud($DescripcionSolicitud);
                $solicitud->setOtros($Otros);
                $solicitud->setLocalizador($Localizador);
                $solicitud->setGestionado($Gestionado);
                $solicitud->setAnulado(0);
                $solicitud->setFechaAbonoDiario($FechaDiario);
                $solicitud->setConfirmado($Confirmado);
                
                $filasActualizadas = $solicitud->updateToDatabase($this->con);
                
                if (count($filasActualizadas) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "Solictud validada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }
    
    private function actualizarSolicitudAbonoDiario() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        
        if (isset($this->datosPeticion['idSolicitud'])) {
            
            $nom = $this->datosPeticion['Nombre'];
            $ape = $this->datosPeticion['Apellidos'];
            $dni = $this->datosPeticion['DNI'];
            $mail = $this->datosPeticion['Mail'];
			$fechaabonodiario =date("Y-m-d",strtotime($this->datosPeticion['FechaAbonoDiario']));
			
			

            $this->con = ConexionBD::getInstance();
            $solicitud = new SolicitudModel();

            $idSolicitud = $this->datosPeticion['idSolicitud'];
                        
            if (!empty($idSolicitud)) {
                                 
                $fila = $solicitud->findById($this->con,$this->datosPeticion['idSolicitud']);
                
                $idTipoSolicitud= $fila ->getIdTipoSolicitud();
                $idTipoTarifa = $fila->getIdTipoTarifa();
                $FechaSolicitud = $fila->getFechaSolicitud();
                $FechaAbonoDiario = $fechaabonodiario;
                $Nombre = html_entity_decode($nom);
                $Apellidos =html_entity_decode($ape);
                $DNI= $dni;
                $EMail  = html_entity_decode($mail);
                $Direccion  = $fila->getDireccion();
                $CP = $fila->getCp();
                $Sexo = $fila->getSexo();
                $FechaNacimiento = $fila->getFechaNacimiento();
                $TutorLegal = $fila->getTutorLegal();
                $Localidad= $fila->getLocalidad();
                $Telefono1 = $fila->getTelefono1();
                $Telefono2= $fila->getTelefono2();
                $Provincia= $fila->getProvincia();
                $DescripcionSolicitud= $fila->getDescripcionSolicitud();
                $Otros= $fila->getOtros();
                $Localizador= $fila->getLocalizador();
                $Gestionado = $fila->getGestionado();
                $Anulado = $fila->getAnulado();
                $Confirmado = $fila->getConfirmado();
                
                                
                $solicitud->setIdSolicitud($idSolicitud);
                $solicitud->setIdTipoSolicitud($idTipoSolicitud);
                $solicitud->setIdTipoTarifa($idTipoTarifa);
                $solicitud->setFechaSolicitud($FechaSolicitud);
                $solicitud->setFechaAbonoDiario($FechaAbonoDiario);
                $solicitud->setNombre($Nombre);
                $solicitud->setApellidos($Apellidos);
                $solicitud->setDni($DNI);
                $solicitud->setEMail($EMail);
                $solicitud->setDireccion($Direccion);
                $solicitud->setCp($CP);
                $solicitud->setSexo($Sexo);
                $solicitud->setFechaNacimiento($FechaNacimiento);
                $solicitud->setTutorLegal($TutorLegal);
                $solicitud->setLocalidad($Localidad);
                $solicitud->setTelefono1($Telefono1);
                $solicitud->setTelefono2($Telefono2);
                $solicitud->setProvincia($Provincia);
                $solicitud->setDescripcionSolicitud($DescripcionSolicitud);
                $solicitud->setOtros($Otros);
                $solicitud->setLocalizador($Localizador);
                $solicitud->setGestionado(1);
                $solicitud->setAnulado($Anulado);
                $solicitud->setFechaAbonoDiario($FechaAbonoDiario);
                $solicitud->setConfirmado($Confirmado);
                
                $filasActualizadas = $solicitud->updateToDatabase($this->con);
                
                if (count($filasActualizadas) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "Solictud validada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }
    
    private function actualizarSolicitudAbonoMensual() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        
        if (isset($this->datosPeticion['idSolicitud'])) {
            
            $nom = $this->datosPeticion['Nombre'];
            $ape = $this->datosPeticion['Apellidos'];
            $dni = $this->datosPeticion['DNI'];
            $mail = $this->datosPeticion['Mail'];
            $direccion=$this->datosPeticion['Direccion'];
            $localidad=$this->datosPeticion['Localidad'];
            $provincia=$this->datosPeticion['Provincia'];
            $cpostal=$this->datosPeticion['Cpostal'];
            $telefono1=$this->datosPeticion['Telefono1'];
            $telefono2 =$this->datosPeticion['Telefono2'];
            $idTipoAbono=$this->datosPeticion['TipoAbono'];
            $idTipoTarifa =$this->datosPeticion['TipoTarifa'];

	    $fechainicio =date("Y-m-d",strtotime($this->datosPeticion['FechaInicio']));
            $fechafin=date("Y-m-d",strtotime($this->datosPeticion['FechaFin']));
            $cantidad =$this->datosPeticion['Cantidad'];
	    $idDatos =$this->datosPeticion['idDatos'];
			
			

            $this->con = ConexionBD::getInstance();
            $solicitud = new SolicitudModel();
			$datossolicitud = new DatosolicitudabonomensualModel();

            $idSolicitud = $this->datosPeticion['idSolicitud'];
                        
            if (!empty($idSolicitud)) {
                                 
                $fila = $solicitud->findById($this->con,$this->datosPeticion['idSolicitud']);
                
                $idTipoSolicitud= $fila ->getIdTipoSolicitud();
                $idTipoTarifa = $idTipoTarifa;
                $FechaSolicitud = $fila->getFechaSolicitud();
                $FechaAbonoDiario = $fila->getFechaAbonoDiario();
                $Nombre = html_entity_decode($nom);
                $Apellidos =html_entity_decode($ape);
                $DNI= $dni;
                $EMail  = html_entity_decode($mail);
                $Direccion  = html_entity_decode($direccion);
                $CP = $cpostal;
                $Sexo = $fila->getSexo();
                $FechaNacimiento = $fila->getFechaNacimiento();
                $TutorLegal = $fila->getTutorLegal();
                $Localidad= html_entity_decode($localidad);
                $Telefono1 = $telefono1;
                $Telefono2= $telefono2;
                $Provincia= html_entity_decode($provincia);
                $DescripcionSolicitud= $fila->getDescripcionSolicitud();
                $Otros= $fila->getOtros();
                $Localizador= $fila->getLocalizador();
                $Gestionado = $fila->getGestionado();
                $Anulado = $fila->getAnulado();
                $FechaDiario = $fila->getFechaAbonoDiario();
                $Confirmado = $fila->getConfirmado();
                                
                $solicitud->setIdSolicitud($idSolicitud);
                $solicitud->setIdTipoSolicitud($idTipoSolicitud);
                $solicitud->setIdTipoTarifa($idTipoTarifa);
                $solicitud->setFechaSolicitud($FechaSolicitud);
                $solicitud->setFechaAbonoDiario($FechaAbonoDiario);
                $solicitud->setNombre($Nombre);
                $solicitud->setApellidos($Apellidos);
                $solicitud->setDni($DNI);
                $solicitud->setEMail($EMail);
                $solicitud->setDireccion($Direccion);
                $solicitud->setCp($CP);
                $solicitud->setSexo($Sexo);
                $solicitud->setFechaNacimiento($FechaNacimiento);
                $solicitud->setTutorLegal($TutorLegal);
                $solicitud->setLocalidad($Localidad);
                $solicitud->setTelefono1($Telefono1);
                $solicitud->setTelefono2($Telefono2);
                $solicitud->setProvincia($Provincia);
                $solicitud->setDescripcionSolicitud($DescripcionSolicitud);
                $solicitud->setOtros($Otros);
                $solicitud->setLocalizador($Localizador);
                $solicitud->setGestionado(1);
                $solicitud->setAnulado($Anulado);
                $solicitud->setFechaAbonoDiario($FechaDiario);
                $solicitud->setConfirmado($Confirmado);
				
				
				
		$datossolicitud->setIdDatosSolicitudAbonoMensual($idDatos);
		$datossolicitud->setIdTipoAbono($idTipoAbono);
		$datossolicitud->setIdSolicitud($idSolicitud);
                $datossolicitud->setFechaInicio($fechainicio);
                $datossolicitud->setFechaFin($fechafin);
                $datossolicitud->setPrecioPagado($cantidad);
                $datossolicitud->setRenovacion(0);
				
                $filasActualizadas = $solicitud->updateToDatabase($this->con);
				$filasActualizadas2 = $datossolicitud->updateToDatabase($this->con);
                
                if (count($filasActualizadas) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "Solictud validada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }
    
    private function actualizarSolicitudClaseDirigida() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        
        if (isset($this->datosPeticion['idSolicitud'])) {
            
            $nom = $this->datosPeticion['Nombre'];
            $ape = $this->datosPeticion['Apellidos'];
            $dni = $this->datosPeticion['DNI'];
            $mail = $this->datosPeticion['Mail'];
            $direccion=$this->datosPeticion['Direccion'];
            $localidad=$this->datosPeticion['Localidad'];
            $provincia=$this->datosPeticion['Provincia'];
            $cpostal=$this->datosPeticion['Cpostal'];
			$sexo=$this->datosPeticion['Sexo'];
            $telefono1=$this->datosPeticion['Telefono1'];
            $telefono2 =$this->datosPeticion['Telefono2'];
            
            $Titular =$this->datosPeticion['Titular'];
            $IBAN =$this->datosPeticion['IBAN'];
            $Entidad =$this->datosPeticion['Entidad'];
            $Oficina =$this->datosPeticion['Oficina'];
            $Digito =$this->datosPeticion['Digito'];
            $Cuenta =$this->datosPeticion['Cuenta'];
            $idDatos =$this->datosPeticion['idDatos'];
			$fechanacimiento =date("Y-m-d",strtotime($this->datosPeticion['FechaNacimiento']));
            $actividad = $this->datosPeticion['Actividades'];
                        
            $this->con = ConexionBD::getInstance();
            $solicitud = new SolicitudModel();
            $datossolicitud = new DatosolicitudclasedirigidaModel();

            $idSolicitud = $this->datosPeticion['idSolicitud'];
                        
            if (!empty($idSolicitud)) {
                                 
                $fila = $solicitud->findById($this->con,$this->datosPeticion['idSolicitud']);
                
                $idTipoSolicitud= $fila ->getIdTipoSolicitud();
				$idTipoTarifa = $fila->getIdTipoTarifa();
                $FechaSolicitud = $fila->getFechaSolicitud();
                $FechaAbonoDiario = $fila->getFechaAbonoDiario();
                $Nombre = html_entity_decode($nom);
                $Apellidos =html_entity_decode($ape);
                $DNI= $dni;
                $EMail  = html_entity_decode($mail);
                $Direccion  = html_entity_decode($direccion);
                $CP = $cpostal;
                $Sexo = $sexo;
                $FechaNacimiento = $fechanacimiento;
                $TutorLegal = $fila->getTutorLegal();
                $Localidad= html_entity_decode($localidad);
                $Telefono1 = $telefono1;
                $Telefono2= $telefono2;
                $Provincia= html_entity_decode($provincia);
                $DescripcionSolicitud= $fila->getDescripcionSolicitud();
                $Otros= $fila->getOtros();
                $Localizador= $fila->getLocalizador();
                $Gestionado = $fila->getGestionado();
                $Anulado = $fila->getAnulado();
                $Confirmado = $fila->getConfirmado();
               
                                
                $solicitud->setIdSolicitud($idSolicitud);
                $solicitud->setIdTipoSolicitud($idTipoSolicitud);
				$solicitud->setIdTipoTarifa($idTipoTarifa);
                $solicitud->setFechaSolicitud($FechaSolicitud);
                $solicitud->setFechaAbonoDiario($FechaAbonoDiario);
                $solicitud->setNombre($Nombre);
                $solicitud->setApellidos($Apellidos);
                $solicitud->setDni($DNI);
                $solicitud->setEMail($EMail);
                $solicitud->setDireccion($Direccion);
                $solicitud->setCp($CP);
                $solicitud->setSexo($Sexo);
                $solicitud->setFechaNacimiento($FechaNacimiento);
                $solicitud->setTutorLegal($TutorLegal);
                $solicitud->setLocalidad($Localidad);
                $solicitud->setTelefono1($Telefono1);
                $solicitud->setTelefono2($Telefono2);
                $solicitud->setProvincia($Provincia);
                $solicitud->setDescripcionSolicitud($DescripcionSolicitud);
                $solicitud->setOtros($Otros);
                $solicitud->setLocalizador($Localizador);
                $solicitud->setGestionado(1);
                $solicitud->setAnulado($Anulado);
                $solicitud->setConfirmado($Confirmado);
                
                $datossolicitud->setIdDatosSolicitudClaseDirigida($idDatos);
                $datossolicitud->setIdSolicitud($idSolicitud);
                $datossolicitud->setTitular($Titular);
                $datossolicitud->setIban($IBAN);
                $datossolicitud->setEntidad($Entidad);
                $datossolicitud->setOficina($Oficina);
                $datossolicitud->setDigitoControl($Digito);
                $datossolicitud->setCuenta($Cuenta);
                
                
                $filasActualizadas = $solicitud->updateToDatabase($this->con);
                $filasActualizadas2 = $datossolicitud->updateToDatabase($this->con);
                
                if (count($filasActualizadas) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "Solictud validada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }
        
    private function obtenerSolicitudesMesEstadistica() {
        
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
                        
        $this->con = ConexionBD::getInstance();
        $solicitud = new SolicitudModel();
        $solicitud->setIdTipoSolicitud(1);
        
        $filter=array(
        new DFC(SolicitudModel::FIELD_IDTIPOSOLICITUD, '1', DFC::EXACT),
        new DFC(SolicitudModel::FIELD_FECHASOLICITUD, date('Y-m-1'), DFC::GREATER)
        );
        
        $filas = $solicitud->findByFilter($this->con,$filter);
        
        $solicitud->setIdTipoSolicitud(2);
        $filtermensual=array(
        new DFC(SolicitudModel::FIELD_IDTIPOSOLICITUD, '2', DFC::EXACT),
        new DFC(SolicitudModel::FIELD_FECHASOLICITUD, date('Y-m-1'), DFC::GREATER)
        );
        
        $filasmensual = $solicitud->findByFilter($this->con,$filtermensual);
        
        $solicitud->setIdTipoSolicitud(3);
        $filterdiario=array(
        new DFC(SolicitudModel::FIELD_IDTIPOSOLICITUD, '3', DFC::EXACT),
        new DFC(SolicitudModel::FIELD_FECHASOLICITUD, date('Y-m-1'), DFC::GREATER)
        );
        
        $filasdiario = $solicitud->findByFilter($this->con,$filterdiario);
                                
        $num = count($filas);
        if ($num > 0) {
            
            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            //$respuesta['abonos'] = $array;
            $respuesta['clases'] = $num;
        }
        else
            $respuesta['clases']=0;
        
        $num = count($filasmensual);
        if ($num > 0) {
            
            for ($i = 0; $i < $num; $i++) {
                $array[] = $filasmensual[$i]->toHash();
            }
            //$respuesta['abonos'] = $array;
            $respuesta['mensual'] = $num;
        }
        else
            $respuesta['mensual']=0;
        
        $num = count($filasdiario);
        if ($num > 0) {
            
            for ($i = 0; $i < $num; $i++) {
                $array[] = $filasdiario[$i]->toHash();
            }
            //$respuesta['abonos'] = $array;
            $respuesta['diario'] = $num;
        }
        else
            $respuesta['diario'] = 0;
        $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        //$this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
    
    private function obtenerSolicitudesSemanaEstadistica() {
        
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
                        
        $this->con = ConexionBD::getInstance();
        
        $year=date('Y');
        $month=date('m');
        $day=date('d');
 
        # Obtenemos el numero de la semana
        $semana=date("W",mktime(0,0,0,$month,$day,$year));
 
        # Obtenemos el día de la semana de la fecha dada
        $diaSemana=date("w",mktime(0,0,0,$month,$day,$year));
 
        # el 0 equivale al domingo...
        if($diaSemana==0)
            $diaSemana=7;
 
        # A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes
        $primerDia=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana,$year));
        
                
        $solicitud = new SolicitudModel();
        $solicitud->setIdTipoSolicitud(1);
        
        $filter=array(
        new DFC(SolicitudModel::FIELD_IDTIPOSOLICITUD, '1', DFC::EXACT),
        new DFC(SolicitudModel::FIELD_FECHASOLICITUD, $primerDia, DFC::GREATER)
        );
        
        $filas = $solicitud->findByFilter($this->con,$filter);
        
        $solicitud->setIdTipoSolicitud(2);
        $filtermensual=array(
        new DFC(SolicitudModel::FIELD_IDTIPOSOLICITUD, '2', DFC::EXACT),
        new DFC(SolicitudModel::FIELD_FECHASOLICITUD, $primerDia, DFC::GREATER)
        );
        
        $filasmensual = $solicitud->findByFilter($this->con,$filtermensual);
        
        $solicitud->setIdTipoSolicitud(3);
        $filterdiario=array(
        new DFC(SolicitudModel::FIELD_IDTIPOSOLICITUD, '3', DFC::EXACT),
        new DFC(SolicitudModel::FIELD_FECHASOLICITUD, $primerDia, DFC::GREATER)
        );
        
        $filasdiario = $solicitud->findByFilter($this->con,$filterdiario);
                                
        $num = count($filas);
        if ($num > 0) {
            
            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            //$respuesta['abonos'] = $array;
            $respuesta['clasessemana'] = $num;
        }
        else
            $respuesta['clasessemana']=0;
        
        $num = count($filasmensual);
        if ($num > 0) {
            
            for ($i = 0; $i < $num; $i++) {
                $array[] = $filasmensual[$i]->toHash();
            }
            //$respuesta['abonos'] = $array;
            $respuesta['mensualsemana'] = $num;
        }
        else
            $respuesta['mensualsemana']=0;
        
        $num = count($filasdiario);
        if ($num > 0) {
            
            for ($i = 0; $i < $num; $i++) {
                $array[] = $filasdiario[$i]->toHash();
            }
            //$respuesta['abonos'] = $array;
            $respuesta['diariosemana'] = $num;
        }
        else
            $respuesta['diariosemana'] = 0;
        $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        //$this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
private function confirmarPago() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        if (isset($this->datosPeticion['idSolicitud'])) {

            $this->con = ConexionBD::getInstance();
            $solicitud = new SolicitudModel();

            $idSolicitud = $this->datosPeticion['idSolicitud'];
                        
            if (!empty($idSolicitud)) {
                                 
                $fila = $solicitud->findById($this->con,$this->datosPeticion['idSolicitud']);
                
                $idTipoSolicitud= $fila ->getIdTipoSolicitud();
                $idTipoTarifa = $fila->getIdTipoTarifa();
                $FechaSolicitud = $fila->getFechaSolicitud();
                $Nombre = $fila->getNombre();
                $Apellidos =$fila->getApellidos();
                $DNI= $fila->getDni();
                $EMail  = $fila->getEMail();
                $Direccion  = $fila->getDireccion();
                $CP = $fila->getCp();
                $Sexo = $fila->getSexo();
                $FechaNacimiento = $fila->getFechaNacimiento();
                $TutorLegal = $fila->getTutorLegal();
                $Localidad= $fila->getLocalidad();
                $Telefono1 = $fila->getTelefono1();
                $Telefono2= $fila->getTelefono2();
                $Provincia= $fila->getProvincia();
                $DescripcionSolicitud= $fila->getDescripcionSolicitud();
                $Otros= $fila->getOtros();
                $Localizador= $fila->getLocalizador();
                $Gestionado = $fila->getGestionado();
                $Anulado = $fila->getAnulado();
                $FechaDiario = $fila->getFechaAbonoDiario();
                $Confirmado = 1;
                                
                $solicitud->setIdSolicitud($idSolicitud);
                $solicitud->setIdTipoSolicitud($idTipoSolicitud);
                $solicitud->setIdTipoTarifa($idTipoTarifa);
                $solicitud->setFechaSolicitud($FechaSolicitud);
                $solicitud->setNombre($Nombre);
                $solicitud->setApellidos($Apellidos);
                $solicitud->setDni($DNI);
                $solicitud->setEMail($EMail);
                $solicitud->setDireccion($Direccion);
                $solicitud->setCp($CP);
                $solicitud->setSexo($Sexo);
                $solicitud->setFechaNacimiento($FechaNacimiento);
                $solicitud->setTutorLegal($TutorLegal);
                $solicitud->setLocalidad($Localidad);
                $solicitud->setTelefono1($Telefono1);
                $solicitud->setTelefono2($Telefono2);
                $solicitud->setProvincia($Provincia);
                $solicitud->setDescripcionSolicitud($DescripcionSolicitud);
                $solicitud->setOtros($Otros);
                $solicitud->setLocalizador($Localizador);
                $solicitud->setGestionado($Gestionado);
                $solicitud->setAnulado(0);
                $solicitud->setFechaAbonoDiario($FechaDiario);
                $solicitud->setConfirmado($Confirmado);
                
                $filasActualizadas = $solicitud->updateToDatabase($this->con);
                
                if (count($filasActualizadas) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "Solictud validada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }
    
    private function crearSolicitud() {

        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        
        $this->con = ConexionBD::getInstance();
        $solicitud = new SolicitudModel();
        
        $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];
        $FechaSolicitud = date("Y-m-d");
        $Nombre =  html_entity_decode($this->datosPeticion['Nombre']);
        $Apellidos =  html_entity_decode($this->datosPeticion['Apellidos']);
        $DNI = $this->datosPeticion['DNI'];
        $EMail = $this->datosPeticion['EMail'];
        $Localizador1 = md5($this->generarLocalizador($Nombre, $Apellidos, date("y/m/d H:i:s"), $DNI));
        $Localizador = substr($Localizador1, 0, 6);
        $FechaAbonoDiario = date("Y-m-d",strtotime($this->datosPeticion['FechaAbonoDiario']));
        $anulado = 0;
        $gestionado = 0;
        $confirmado = 0;
        
        $solicitud->setIdTipoSolicitud($idTipoSolicitud);
        $solicitud->setFechaSolicitud($FechaSolicitud);
        $solicitud->setNombre($Nombre);
        $solicitud->setApellidos($Apellidos);
        $solicitud->setDni($DNI);
        $solicitud->setEMail($EMail);
        $solicitud->setLocalizador($Localizador);
        $solicitud->setFechaAbonoDiario($FechaAbonoDiario);
        $solicitud->setAnulado($anulado);
        $solicitud->setGestionado($gestionado);
        $solicitud->setConfirmado($confirmado);

        $result = $solicitud->insertIntoDatabase($this->con);
      if (count($result) == 1) {
            //$id = $this->_conn->lastInsertId();  */
            $respuesta['estado'] = 'correcto';
            //$respuesta = array('estado' => "correcto", "msg" => "Solictud prueba validada");
            $respuesta['solicitud']['IdSolicitud'] = $solicitud->getIdSolicitud() ;
            $respuesta['solicitud']['Localizador'] = $solicitud->getLocalizador();
            $respuesta['msg'] = "solicitud creada correctamente";
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
            
         } else
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(7)), 400);
          
        //else  
        //$this->mostrarRespuesta($this->convertirJson($this->devolverError(8)), 400);  
        //} else {  
        //$this->mostrarRespuesta($this->convertirJson($this->devolverError(7)), 400);  
        
    }
    
     private function crearSolicitudAbonoMensual() {

        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
		
        $this->con = ConexionBD::getInstance();
        $solicitud = new SolicitudModel();
        $solAbonoMensual = new DatosolicitudabonomensualModel();

        $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];
		$Sexo = $this->datosPeticion['Sexo'];
		$tipoabono = $this->datosPeticion['idTipoAbono'];
		$idTipoTarifa = $this->datosPeticion['idTipoTarifa'];
		$FechaInicio = date("Y-m-d",strtotime($this->datosPeticion['FechaInicio']));
        $FechaFin = date("Y-m-d",strtotime($this->datosPeticion['FechaFin']));
		$PrecioPagado = $this->datosPeticion['PrecioPagado'];
		$FechaSolicitud = date("Y-m-d");
        $Nombre =  html_entity_decode($this->datosPeticion['Nombre']);
        $Apellidos =  html_entity_decode($this->datosPeticion['Apellidos']);
        $DNI = $this->datosPeticion['DNI'];
        $EMail = $this->datosPeticion['EMail'];
        $Direccion =  html_entity_decode($this->datosPeticion['Direccion']);
        $CP = $this->datosPeticion['CP'];
       
	   
        $FechaNacimiento = date("Y-m-d",strtotime($this->datosPeticion['FechaNacimiento']));
        $TutorLegal = $this->datosPeticion['TutorLegal'];
        $Localidad =  html_entity_decode($this->datosPeticion['Localidad']);
        $Telefono1 = $this->datosPeticion['Telefono1'];
        $Telefono2 = $this->datosPeticion['Telefono2'];
        $Provincia =  html_entity_decode($this->datosPeticion['Provincia']);
        $DescripcionSolicitud = $this->datosPeticion['DescripcionSolicitud'];
        $Otros = $this->datosPeticion['Otros'];
        
		
		$Localizador1 = md5($this->generarLocalizador($Nombre, $Apellidos, date("y/m/d H:i:s"), $DNI));
        $Localizador = substr($Localizador1, 0, 6);
        $anulado = 0;
        $gestionado = 0;
        $confirmado = 0;
        
		
		/* Especificos */
        
       
        
        $Renovacion = $this->datosPeticion['Renovacion'];
		if($Renovacion){
			$temp = 1;
		}else{
			$temp = 0;
		}
		$Renovacion = $temp;

        //Modelo Solicitud
        $solicitud->setIdTipoSolicitud($idTipoSolicitud);
        $solicitud->setIdTipoTarifa($idTipoTarifa);
        $solicitud->setFechaSolicitud($FechaSolicitud);
        $solicitud->setNombre($Nombre);
        $solicitud->setApellidos($Apellidos);
        $solicitud->setDni($DNI);
        $solicitud->setEMail($EMail);
        $solicitud->setDireccion($Direccion);
        $solicitud->setCp($CP);
        $solicitud->setSexo($Sexo);
        $solicitud->setFechaNacimiento($FechaNacimiento);
        $solicitud->setTutorLegal($TutorLegal);
        $solicitud->setLocalidad($Localidad);
        $solicitud->setTelefono1($Telefono1);
        $solicitud->setTelefono2($Telefono2);
        $solicitud->setProvincia($Provincia);
        $solicitud->setDescripcionSolicitud($DescripcionSolicitud);
        $solicitud->setOtros($Otros);
        $solicitud->setLocalizador($Localizador);
        $solicitud->setAnulado($anulado);
        $solicitud->setGestionado($gestionado);
        $solicitud->setConfirmado($confirmado);

        //var_dump($solicitud);
        //Modelo Datos Solicitud Abono Mensual
        $solAbonoMensual->setIdTipoAbono($tipoabono);
        $solAbonoMensual->setPrecioPagado($PrecioPagado);
        $solAbonoMensual->setFechaInicio($FechaInicio);
        $solAbonoMensual->setFechaFin($FechaFin);
        $solAbonoMensual->setRenovacion($Renovacion);
		
		
        //var_dump($solAbonoMensual);
        //Inicio Transaccion
        //try {
         //   $this->con->beginTransaction();*/
            $result1 = $solicitud->insertIntoDatabase($this->con);
            $solAbonoMensual->setIdSolicitud($solicitud->getIdSolicitud());
            $result2 = $solAbonoMensual->insertIntoDatabase($this->con);
         //   $this->con->commit();
        //} catch (Exception $e) {
         //   $this->con->rollBack();
         //   echo "Fallo: " . $e->getMessage();
       // }

        if (count($result1) === 1 && count($result2) === 1) {
		//if (count($result1) == 1) {

            $respuesta["estado"] = "correcto";
            $respuesta["solicitud"]['IdSolicitud'] = $solicitud->getIdSolicitud();
            $respuesta["solicitud"]["Localizador"] = $solicitud->getLocalizador();
            $respuesta["msg"] = "solicitud creada correctamente";
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        } else
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(7)), 400);
	}

    private function crearSolicitudClaseDirigida() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        $this->con = ConexionBD::getInstance();
        $solicitud = new SolicitudModel();
        $solClase = new DatosolicitudclasedirigidaModel();

        $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];
        //$idTipoTarifa = $this->datosPeticion['idTipoTarifa'];
        $FechaSolicitud = date("Y-m-d");
        $Nombre =  html_entity_decode($this->datosPeticion['Nombre']);
        $Apellidos =  html_entity_decode($this->datosPeticion['Apellidos']);
        $DNI = $this->datosPeticion['DNI'];
        $EMail = $this->datosPeticion['EMail'];
        $Direccion =  html_entity_decode($this->datosPeticion['Direccion']);
        $CP = $this->datosPeticion['CP'];
        $Sexo = $this->datosPeticion['Sexo'];
        $FechaNacimiento = date("Y-m-d",strtotime($this->datosPeticion['FechaNacimiento']));
        $TutorLegal =  html_entity_decode($this->datosPeticion['TutorLegal']);
        $Localidad =  html_entity_decode($this->datosPeticion['Localidad']);
        $Telefono1 = $this->datosPeticion['Telefono1'];
        //$Telefono2 = $this->datosPeticion['Telefono2'];
        $Provincia =  html_entity_decode($this->datosPeticion['Provincia']);
        //$DescripcionSolicitud = $this->datosPeticion['DescripcionSolicitud'];
        //$Otros = $this->datosPeticion['Otros'];
        $Localizador1 = md5($this->generarLocalizador($Nombre, $Apellidos, date("y/m/d H:i:s"), $DNI));
        $Localizador = substr($Localizador1, 0, 6);
        $anulado = 0;
        $gestionado = 0;
        /* Especificos */
        $Titular =  html_entity_decode($this->datosPeticion['Titular']);
        $IBAN = $this->datosPeticion['IBAN'];
        $Entidad = $this->datosPeticion['Entidad'];
        $Oficina = $this->datosPeticion['Oficina'];
        $DigitoControl = $this->datosPeticion['DigitoControl'];
        $Cuenta = $this->datosPeticion['Cuenta'];
        $actividad = $this->datosPeticion['Actividad'];

		
		
        //Modelo Solicitud
        $solicitud->setIdTipoSolicitud($idTipoSolicitud);
        //$solicitud->setIdTipoTarifa($idTipoTarifa);
        $solicitud->setFechaSolicitud($FechaSolicitud);
        $solicitud->setNombre($Nombre);
        $solicitud->setApellidos($Apellidos);
        $solicitud->setDni($DNI);
        $solicitud->setEMail($EMail);
        $solicitud->setDireccion($Direccion);
        $solicitud->setCp($CP);
        $solicitud->setSexo($Sexo);
        $solicitud->setFechaNacimiento($FechaNacimiento);
        $solicitud->setTutorLegal($TutorLegal);
        $solicitud->setLocalidad($Localidad);
        $solicitud->setTelefono1($Telefono1);
        //$solicitud->setTelefono2($Telefono2);
        $solicitud->setProvincia($Provincia);
        //$solicitud->setDescripcionSolicitud($DescripcionSolicitud);
        //$solicitud->setOtros($Otros);
        $solicitud->setLocalizador($Localizador);
        $solicitud->setAnulado($anulado);
        $solicitud->setGestionado($gestionado);

        //var_dump($solicitud);
        //Modelo Datos Solicitud Clase Dirigida
        $solClase->setTitular($Titular);
        $solClase->setIban($IBAN);
        $solClase->setEntidad($Entidad);
        $solClase->setOficina($Oficina);
        $solClase->setDigitoControl($DigitoControl);
        $solClase->setCuenta($Cuenta);
        //var_dump($solClase);
        //Modelo Datos Actividadsolicitudclasedirigida
        $a = explode(',',$actividad);
		

        //Inicio Transaccion
        //try {
            //$this->con->beginTransaction();
            $result1 = $solicitud->insertIntoDatabase($this->con);
            $solClase->setIdSolicitud($solicitud->getIdSolicitud());
            $result2 = $solClase->insertIntoDatabase($this->con);
			

            //for($i=0;$a[$i];$i++){
            for($i=0;$i<count($a);$i++){
                $act = new ActividadsolicitudclasedirigidaModel();
                $act->setIdActividad($a[$i]);
                $act->setIdSolicitud($solClase->getIdSolicitud());
                $result3 = $act->insertIntoDatabase($this->con);
            }
            //$this->con->commit();
        //} catch (Exception $e) {
            //$this->con->rollBack();
        //    echo "Fallo: " . $e->getMessage();
        //}

        if (count($result1) == 1 && count($result2) == 1 && count($result3) == 1) {

            $respuesta['estado'] = 'correcto';
            $respuesta['solicitud']['IdSolicitud'] = $solicitud->getIdSolicitud();
            $respuesta['solicitud']['Localizador'] = $solicitud->getLocalizador();
            $respuesta['msg'] = 'solicitud creada correctamente';
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        } else
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(7)), 400);
    }
    
    private function codigoQR() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        $Localizador = $this->datosPeticion['Localizador'];
        $Nombre = html_entity_decode($this->datosPeticion['Nombre']);
        $Apellidos = html_entity_decode($this->datosPeticion['Apellidos']);
        $EMail = $this->datosPeticion['EMail'];

		var_dump('aqui llego');
        //set it to writable location, a place for temp generated PNG files
        $PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;

        //html PNG location prefix
        $PNG_WEB_DIR = '../../Negocio/NegocioAdministrador/temp/';

		var_dump($PNG_WEB_DIR );
        require_once "../UtilidadesNegocio/phpqrcode/qrlib.php";

        //ofcourse we need rights to create temp dir
        if (!file_exists($PNG_TEMP_DIR))
            mkdir($PNG_TEMP_DIR);


        $filename = $PNG_TEMP_DIR . '' . $Localizador . '.png';
        $nom = $Localizador . '.png';

        //echo $filename;

        $data = 'http://vw15115.dinaserver.com/hosting/reservascentro.es-web/sistemareservas/Frontal/Reservas.php';

        //processing form input
        //remember to sanitize user input in real-life solution !!!
        $errorCorrectionLevel = 'L';
        if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L', 'M', 'Q', 'H')))
            $errorCorrectionLevel = $_REQUEST['level'];

        $matrixPointSize = 10;
        if (isset($_REQUEST['size']))
            $matrixPointSize = min(max((int) $_REQUEST['size'], 1), 10);

        // user data
        //$filename = $PNG_TEMP_DIR.'test'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        //$filename = $PNG_TEMP_DIR.'test'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        $resultqr = QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        
        $respuesta['codigoQR'] = $resultqr;
        $respuesta['msg'] = 'codigo qr creado';
            
        //echo $PNG_WEB_DIR.$nombre;        
        $resultEmail = $this->enviarMail($PNG_WEB_DIR . '' . $nom, $Nombre, $Apellidos, $EMail, $Localizador);
        
        $respuesta['EMail'] = $resultEmail;
		
			
		if($resultqr != null){
            $respuesta['estado'] = 'incorrecto';
            $respuesta['msg'] = 'error creando qr';
            $code = 500;
        }else if($resultEmail== null){
            $respuesta['estado'] = 'incorrecto';
            $respuesta['msg'] = 'error enviando correo';
            $code = 500;
        }else if(resultqr== null && $resultEmail== null){
            $respuesta['estado'] = 'correcto';
            $respuesta['msg'] = 'codigo qr generado y enviado por correo';
            $code = 200;
        }
        
        $this->mostrarRespuesta($this->convertirJson($respuesta),$code);    
    }

    private function enviarMail($file, $nom, $ape, $Email, $loc) {
        require("../UtilidadesNegocio/class.phpmailer.php");
        
        include 'config.php';

        $mail = new PHPMailer();
        $mail->Host = $MAIL_HOST;
		$mail->Username = $MAIL_USERNAME; // SMTP account username
		$mail->Password = $MAIL_PASS; 
		
        $mail->From = $MAIL_FROM; //"mariosgsg@gmail.com";
        $mail->FromName = $MAIL_NAME; //"Nombre del Remitente";
        $mail->Subject = "Reserva " . $loc;
		$remitente = $nom.' '.$ape;
        $mail->AddAddress($Email, $remitente); //"mariosgsg@gmail.com", "Nombre 01");
        //$mail->AddAddress("mariosgsg@gmail.com", "Nombre 02");
        //$mail->AddCC("mariosgsg@gmail.com");
        //$mail->AddBCC("mariosgsg@gmail.com");

        $body = "Hola <strong>".$nom."</strong><br> La compra se ha realizado con &eacute;xito.<br> Muestra este localizador a la entrada: " . $loc;
        //$body .= "probando <i>PHPMailer<i>.<br><br>";
        //$body .= "<font color='red'>Saludos</font>";
        $mail->Body = $body;
        $mail->AltBody = "Hola amigo\nprobando PHPMailer\n\nSaludos";
        //$mail->AddAttachment("temp/localizador.jpg", "codigoQR.jpg");
        $mail->AddAttachment($file, $loc . '.png'); //"temp/Mario.png", "Mario.png");//"localizador.png");
        //$mail->AddAttachment($filename, "localizador.png");
        if(!$mail->Send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			echo "Message sent!";
		}
    }

    private function generarLocalizador($nom, $ape, $fecha, $dni) {
        return substr($nom, 0, 2) . substr($ape, 0, 2) . str_replace('/', '', substr($fecha, 0, 8)) . str_replace(':', '', substr($fecha, 9, 5)) . $dni;
    }
}

$reservasBO = new ReservasBO();
$reservasBO->procesarLLamada();