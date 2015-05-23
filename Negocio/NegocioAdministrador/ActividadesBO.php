<?php

require_once("../../ComunicacionesREST/Rest.php");
require_once("../../Negocio/AccesoDatos/ConexionBD.php");
require_once("../../Negocio/Entidades/ActividadModel.class.php");
require_once("../../Negocio/Entidades/helpers/DSC.class.php");
class ActividadesBO extends Rest {
    
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
            $url = explode('/', trim($_REQUEST['url']));
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
    
     //Metodos CRUD Actividad    
    private function crearActividad() {

        $NombreActividad = $this->datosPeticion['NombreActividad'];
        $IntensidadActividad = $this->datosPeticion['IntensidadActividad'];
        $EdadMinima = $this->datosPeticion['EdadMinima'];
        $EdadMaxima = $this->datosPeticion['EdadMaxima'];
        $Grupo = $this->datosPeticion['Grupo'];
        $Descripcion = $this->datosPeticion['Descripcion'];
        $FechaAlta =date("Y-m-d");
        $FechaBaja =null;

        $this->con = ConexionBD::getInstance();

        $actividad = new ActividadModel();

        $actividad->setNombreActividad($NombreActividad);
        $actividad->setIntensidadActividad($IntensidadActividad);
        $actividad->setEdadMinima($EdadMinima);
        $actividad->setEdadMaxima($EdadMaxima);
        $actividad->setGrupo($Grupo);
        $actividad->setDescripcion($Descripcion);
        $actividad->setFechaAlta($FechaAlta);
        $actividad->setFechaBaja($FechaBaja);

        $result = $actividad->insertIntoDatabase($this->con);
        if ($result) {
            $respuesta['estado'] = 'correcto';
            $respuesta['msg'] = 'actividad creada correctamente';
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        else
        {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(7)), 400);
        }
    }

    private function obtenerActividades() {
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        
        $this->con = ConexionBD::getInstance();
        $actividad = new ActividadModel();

        $filas = $actividad->findBySql($this->con, ActividadModel::SQL_SELECT);

        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['actividades'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function actualizarActividad() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        
        $this->con = ConexionBD::getInstance();
        $actividad = new ActividadModel();
                
        if (isset($this->datosPeticion['idActividad'])) {
            $idActividad = $this->datosPeticion['idActividad'];
            $NombreActividad = $this->datosPeticion['NombreActividad'];
            $IntensidadActividad = $this->datosPeticion['IntensidadActividad'];
            $EdadMinima = $this->datosPeticion['EdadMinima'];
            $EdadMaxima = $this->datosPeticion['EdadMaxima'];
            $Grupo = $this->datosPeticion['Grupo'];
            $Descripcion = $this->datosPeticion['Descripcion'];
            
            $fila = $actividad->findById($this->con,$this->datosPeticion['idActividad']);

            if (!empty($idActividad)) {
                

                $actividad->setIdActividad($idActividad);
                $actividad->setNombreActividad($NombreActividad);
                $actividad->setIntensidadActividad($IntensidadActividad);
                $actividad->setEdadMinima($EdadMinima);
                $actividad->setEdadMaxima($EdadMaxima);
                $actividad->setGrupo($Grupo);
                $actividad->setDescripcion($Descripcion);
                $actividad->setFechaAlta($fila->getFechaAlta());
                $actividad->setFechaBaja($fila->getFechaBaja());

                $result = $actividad->updateToDatabase($this->con);

                if ($result) {
                    $resp = array('estado' => "correcto", "msg" => "actividad actualizada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }

    private function borrarActividad() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        $idActividad = $this->datosPeticion['idActividad'];

        if ($idActividad >= 0) {
            $this->con = ConexionBD::getInstance();
            $actividad = new ActividadModel();
            $actividad->setIdActividad($idActividad);

            $result = $actividad->deleteFromDatabase($this->con);


            if ($result) {
                $resp = array('estado' => "correcto", "msg" => "actividad borrada correctamente.");
                $this->mostrarRespuesta($this->convertirJson($resp), 200);
            } else {
                $this->mostrarRespuesta($this->convertirJson($this->devolverError(4)), 400);
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(4)), 400);
    }

    private function obtenerActividad() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        //el constructor del padre ya se encarga de sanear los datos de entrada  
        $idActividad = $this->datosPeticion['idActividad'];
        $this->con = ConexionBD::getInstance();
        $actividad = new ActividadModel();

        $actividad->setIdActividad($idActividad);
        $fila = $actividad->findById($this->con, $idActividad);


        if ($fila) {
            $respuesta['estado'] = 'correcto';
            $respuesta['actividad']['idActividad'] = $fila->getIdActividad();
            $respuesta['actividad']['NombreActividad'] = $fila->getNombreActividad();
            $respuesta['actividad']['IntensidadActividad'] = $fila->getIntensidadActividad();
            $respuesta['actividad']['DescripcionActividad'] = $fila->getDescripcion();
            $respuesta['actividad']['EdadMinima'] = $fila->getEdadMinima();
            $respuesta['actividad']['EdadMaxima'] = $fila->getEdadMaxima();
            $respuesta['actividad']['Grupo'] = $fila->getGrupo();
            $respuesta['actividad']['Descripcion'] = $fila->getDescripcion();
            $respuesta['actividad']['FechaAlta'] = date("d-m-Y",strtotime($fila->getFechaAlta()));
            $respuesta['actividad']['FechaBaja'] = date("d-m-Y",strtotime($fila->getFechaBaja()));
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
	
	private function obtenerActividadOcupacion() {
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        //el constructor del padre ya se encarga de sanear los datos de entrada  
        $idActividad = $this->datosPeticion['idActividad'];
        $this->con = ConexionBD::getInstance();
        $actividad = new ActividadModel();

        $actividad->setIdActividad($idActividad);
        $fila = $actividad->findById($this->con, $idActividad);


        if ($fila) {
            $respuesta['estado'] = 'correcto';
            $respuesta['actividad']['idActividad'] = $fila->getIdActividad();
            $respuesta['actividad']['NombreActividad'] = $fila->getNombreActividad();
            $respuesta['actividad']['IntensidadActividad'] = $fila->getIntensidadActividad();
            $respuesta['actividad']['DescripcionActividad'] = $fila->getDescripcion();
            $respuesta['actividad']['EdadMinima'] = $fila->getEdadMinima();
            $respuesta['actividad']['EdadMaxima'] = $fila->getEdadMaxima();
            $respuesta['actividad']['Grupo'] = $fila->getGrupo();
            $respuesta['actividad']['Descripcion'] = $fila->getDescripcion();
            $respuesta['actividad']['FechaAlta'] = date("d-m-Y",strtotime($fila->getFechaAlta()));
            $respuesta['actividad']['FechaBaja'] = date("d-m-Y",strtotime($fila->getFechaBaja()));
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
	
    
    private function obtenerActividadesFiltro() {
        
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
                
        $nombre = $this->datosPeticion['NombreActividad'];
        $intensidad = $this->datosPeticion['IntensidadActividad'];
        $grupo = $this->datosPeticion['Grupo'];
        
        $this->con = ConexionBD::getInstance();
        $sort = array(
            new DSC(ActividadModel::FIELD_NOMBREACTIVIDAD, DSC::ASC),
            new DSC(ActividadModel:: FIELD_INTENSIDADACTIVIDAD, DSC::ASC),
            new DSC(ActividadModel:: FIELD_GRUPO, DSC::ASC)
        );
        
        $actividad = new ActividadModel();
        
        if($nombre != '')
            $actividad->setNombreActividad($nombre);
        if($intensidad != '')
            $actividad->setIntensidadActividad($intensidad);
        if($grupo != '')
            $actividad->setGrupo($grupo);
        
         $filter=array(
        new DFC(ActividadModel::FIELD_NOMBREACTIVIDAD, $nombre, DFC::CONTAINS),
        new DFC(ActividadModel::FIELD_INTENSIDADACTIVIDAD, $intensidad, DFC::CONTAINS),
        new DFC(ActividadModel::FIELD_GRUPO, $grupo, DFC::CONTAINS),
        );
        $filas=ActividadModel::findByFilter($this->con, $filter, true, $sort);
        
        //$filas = ActividadModel::findByExample($this->con,$actividad,$sort);
                                
        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['actividades'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        else
        {
            $respuesta['estado'] = 'No se encontraron datos';
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
        
    private function anularActividad() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        if (isset($this->datosPeticion['idActividad'])) {

            $this->con = ConexionBD::getInstance();
            $actividad = new ActividadModel();

            $idActividad = $this->datosPeticion['idActividad'];
                        
            $fila = $actividad->findById($this->con,$this->datosPeticion['idActividad']);
            
            $FechaBaja =date("Y-m-d");
                        
            if (!empty($idActividad)) {
                
                $actividad->setIdActividad($idActividad);
                $actividad->setNombreActividad($fila->getNombreActividad());
                $actividad->setDescripcion($fila->getDescripcion());
                $actividad->setIntensidadActividad($fila->getIntensidadActividad());
                $actividad->setEdadMaxima($fila->getEdadMaxima());
                $actividad->setEdadMinima($fila->getEdadMinima());
                $actividad->setGrupo($fila->getGrupo());
                $actividad->setFechaAlta($fila->getFechaAlta());
                $actividad->setFechaBaja($FechaBaja);
                
                $filasActualizadas = $actividad->updateToDatabase($this->con);
                
                if (count($filasActualizadas) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "Actividad actualizada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }
    
    private function activarActividad() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        if (isset($this->datosPeticion['idActividad'])) {

            $this->con = ConexionBD::getInstance();
            $actividad = new ActividadModel();

            $idActividad = $this->datosPeticion['idActividad'];
                        
            $fila = $actividad->findById($this->con,$this->datosPeticion['idActividad']);
            
            $FechaAlta =date("Y-m-d");
            $FechaBaja =NULL;
                        
            if (!empty($idActividad)) {
                
                $actividad->setIdActividad($idActividad);
                $actividad->setNombreActividad($fila->getNombreActividad());
                $actividad->setDescripcion($fila->getDescripcion());
                $actividad->setIntensidadActividad($fila->getIntensidadActividad());
                $actividad->setEdadMaxima($fila->getEdadMaxima());
                $actividad->setEdadMinima($fila->getEdadMinima());
                $actividad->setGrupo($fila->getGrupo());
                $actividad->setFechaAlta($FechaAlta);
                $actividad->setFechaBaja($FechaBaja);
                
                $filasActualizadas = $actividad->updateToDatabase($this->con);
                
                if (count($filasActualizadas) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "Actividad actualizada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }
}

$actividadesBO = new ActividadesBO();
$actividadesBO->procesarLLamada();
