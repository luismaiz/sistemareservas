<?php

require_once("../../ComunicacionesREST/Rest.php");
require_once("../../Negocio/AccesoDatos/ConexionBD.php");
require_once("../../Negocio/Entidades/SolicitudModel.class.php");
require_once("../../Negocio/Entidades/ActividadsolicitudclasedirigidaModel.class.php");
require_once("../../Negocio/Entidades/DatosolicitudclasedirigidaModel.class.php");
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
        $fsolicitud = $this->datosPeticion['FechaSolicitud'];
        $tsolicitud = $this->datosPeticion['TipoSolicitud'];
        
        
        
        
        $this->con = ConexionBD::getInstance();
        $sort = array(
            new DSC(SolicitudModel::FIELD_FECHASOLICITUD, DSC::ASC),
            new DSC(SolicitudModel::FIELD_APELLIDOS, DSC::ASC)
        );
        
        $solicitud = new SolicitudModel();
        
        if($loc != '')
            $solicitud->setLocalizador($loc);
        if($nom != '')
            $solicitud->setNombre($nom);
        if($ape != '')
            $solicitud->setApellidos($ape);
        if($dni != '')
            $solicitud->setDni($dni);
        if($mail != '')
            $solicitud->setEMail($mail);
        if($fsolicitud != '')
            $solicitud->setFechaSolicitud($fsolicitud);
        if($tsolicitud != '')
            $solicitud->setIdTipoSolicitud($tsolicitud);
        
        
        $filas = SolicitudModel::findByExample($this->con,$solicitud,$sort);
                                
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
                $respuesta['abonodiario']['FechaSolicitud'] = date("d-m-Y",strtotime($fila->getFechaSolicitud()));
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
                $Gestionado = $fila->getGestionado()
                        ;
                                
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
            $fila = $solicitud->findById($this->con,$this->datosPeticion['idSolicitud']);
          
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
                $respuesta['abonomensual']['TipoTarifa'] = $fila->getIdTipoTarifa();
                $respuesta['abonomensual']['CodigoPostal'] = $fila->getCp();
                $respuesta['abonomensual']['Localidad'] = $fila->getLocalidad();
                $respuesta['abonomensual']['Telefono1'] = $fila->getTelefono1();
                $respuesta['abonomensual']['Telefono2'] = $fila->getTelefono2();
                
                
                

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
            $filaactividades = ActividadsolicitudclasedirigidaModel::findByExample($this->con,$actividades,$sort);
            $filadatosbancarios =  DatosolicitudclasedirigidaModel::findByExample($this->con,$datosbancarios,$sortdatos);
            
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
                $respuesta['clasesdirigidas']['FechaNacimiento'] = $fila->getFechaNacimiento();
                $respuesta['clasesdirigidas']['Sexo'] = $fila->getSexo();
                $respuesta['clasesdirigidas']['TutorLegal'] = $fila->getTutorLegal();
                $respuesta['clasesdirigidas']['TipoTarifa'] = $fila->getIdTipoTarifa();
                $respuesta['clasesdirigidas']['CodigoPostal'] = $fila->getCp();
                $respuesta['clasesdirigidas']['Localidad'] = $fila->getLocalidad();
                $respuesta['clasesdirigidas']['Telefono1'] = $fila->getTelefono1();
                $respuesta['clasesdirigidas']['Telefono2'] = $fila->getTelefono2();
                $respuesta['datosbancarios'] = $arraybanco;
                
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
}

$reservasBO = new ReservasBO();
$reservasBO->procesarLLamada();