<?php

require_once("../../ComunicacionesREST/Rest.php");
require_once("../../Negocio/AccesoDatos/ConexionBD.php");
require_once("../../Negocio/Entidades/TipoSolicitudModel.class.php");
require_once("../../Negocio/Entidades/helpers/DSC.class.php");
class TiposSolicitudesBO extends Rest{
     //Metodos CRUD Solicitud
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
    private function crearTipoSolicitud() {

        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        
        $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];
        $NombreSolicitud = $this->datosPeticion['NombreSolicitud'];
        $DescripcionSolicitud = $this->datosPeticion['DescripcionSolicitud'];
        $FechaAlta =date("Y-m-d", strtotime($this->datosPeticion['FechaAlta']));
            $FechaBaja =date("Y-m-d", strtotime($this->datosPeticion['FechaBaja']));

        $this->con = ConexionBD::getInstance();
        $tiposolicitud = new TiposolicitudModel();

        $tiposolicitud->setNombreSolicitud($NombreSolicitud);
        $tiposolicitud->setDescripcionSolicitud($DescripcionSolicitud);
        $tiposolicitud->setFechaAlta($FechaAlta);
        $tiposolicitud->setFechaBaja($FechaBaja);

        $result = $tiposolicitud->insertIntoDatabase($this->con);

        if ($result) {

            //$id = $this->_conn->lastInsertId();  
            $respuesta['estado'] = 'correcto';
            $respuesta['msg'] = 'tipo solicitud creado correctamente';
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        else
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(7)), 400);
         
    }

    private function obtenerTiposSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        $this->con = ConexionBD::getInstance();
        $tiposolicitud = new TiposolicitudModel();

        $filas = $tiposolicitud->findBySql($this->con, TiposolicitudModel::SQL_SELECT);

        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['tiposSolicitudes'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function actualizarTipoSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        //echo $idUsuario . "<br/>";  
        if (isset($this->datosPeticion['idTipoSolicitud'])) {
            $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];
            $NombreSolicitud = $this->datosPeticion['NombreSolicitud'];
            $DescripcionSolicitud = $this->datosPeticion['DescripcionSolicitud'];
            $FechaAlta =date("Y-m-d", strtotime($this->datosPeticion['FechaAlta']));
            $FechaBaja =date("Y-m-d", strtotime($this->datosPeticion['FechaBaja']));

            if (!empty($idTipoSolicitud)) {
                
                $this->con = ConexionBD::getInstance();
                $tiposolicitud = new TiposolicitudModel();

                $tiposolicitud->setIdTipoSolicitud($idTipoSolicitud);
                $tiposolicitud->setNombreSolicitud($NombreSolicitud);
                $tiposolicitud->setDescripcionSolicitud($DescripcionSolicitud);
                $tiposolicitud->setFechaAlta($FechaAlta);
                $tiposolicitud->setFechaBaja($FechaBaja);

                $result = $tiposolicitud->updateToDatabase($this->con);

                if (count($result) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "tipo de solicitud actualizada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }

    private function obtenerTipoSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        //el constructor del padre ya se encarga de sanear los datos de entrada  
        
        if (isset($this->datosPeticion['idTipoSolicitud'])) {
        $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];

        $this->con = ConexionBD::getInstance();
        $tiposolicitud = new TiposolicitudModel();

        $fila = $tiposolicitud->findById($this->con, $idTipoSolicitud);

        if ($fila) {
            $respuesta['estado'] = 'correcto';
            $respuesta['tipoSolicitud']['idTipoSolicitud'] = $fila->getIdTipoSolicitud();
            $respuesta['tipoSolicitud']['NombreSolicitud'] = $fila->getNombreSolicitud();
            $respuesta['tipoSolicitud']['DescripcionSolicitud'] = $fila->getDescripcionSolicitud();
            $respuesta['tipoSolicitud']['FechaAlta'] = date("d-m-Y",strtotime($fila->getFechaAlta()));
            $respuesta['tipoSolicitud']['FechaBaja'] = date("d-m-Y",strtotime($fila->getFechaBaja()));
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
    
        }
        
    private function obtenerTiposSolicitudesFiltro() {
        
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
                
        $nomtiposolicitud = $this->datosPeticion['NombreSolicitud'];
        $destiposolicitud = $this->datosPeticion['DescripcionSolicitud'];
        
        $this->con = ConexionBD::getInstance();
        $sort = array(
            new DSC(TiposolicitudModel::FIELD_NOMBRESOLICITUD, DSC::ASC),
            new DSC(TiposolicitudModel::FIELD_DESCRIPCIONSOLICITUD, DSC::ASC)
        );
        
        $tiposolicitud = new TiposolicitudModel();
        
        if($this->datosPeticion['NombreSolicitud'])
            $tiposolicitud->setNombreSolicitud($this->datosPeticion['NombreSolicitud']);
        if($this->datosPeticion['DescripcionSolicitud'] != '')
            $tiposolicitud->setDescripcionSolicitud($this->datosPeticion['DescripcionSolicitud']);
        
        $filas = TiposolicitudModel::findByExample($this->con,$tiposolicitud,$sort);
                                
        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['tipossolicitudes'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        else
        {
            $respuesta['estado'] = 'No se encontraron datos';
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
    
}

$tipossolicitudesBO = new TiposSolicitudesBO();
$tipossolicitudesBO->procesarLLamada();