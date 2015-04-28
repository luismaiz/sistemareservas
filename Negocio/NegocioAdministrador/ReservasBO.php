<?php

require_once("../../ComunicacionesREST/Rest.php");
require_once("../../Negocio/AccesoDatos/ConexionBD.php");
require_once("../../Negocio/Entidades/SolicitudModel.class.php");
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
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
    
}

$reservasBO = new ReservasBO();
>>>>>>> 4f7a419ccaab99d17143b3a3490a8a51850fac6a
$reservasBO->procesarLLamada();