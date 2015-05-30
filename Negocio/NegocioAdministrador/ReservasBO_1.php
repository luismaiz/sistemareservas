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
}

$reservasBO = new ReservasBO();
$reservasBO->procesarLLamada();