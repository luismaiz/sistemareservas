<?php

require_once("../../ComunicacionesREST/Rest.php");
require_once("../../Negocio/AccesoDatos/ConexionBD.php");
require_once("../../Negocio/Entidades/TipoAbonoModel.class.php");
require_once("../../Negocio/Entidades/helpers/DSC.class.php");
class TiposAbonosBO extends Rest{
  //Metodos CRUD Abono 
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
    private function crearTipoAbono() {

        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
            	 	

        $NombreAbono = $this->datosPeticion['NombreAbono'];
        $DescripcionAbono = $this->datosPeticion['DescripcionAbono'];
        $FechaAlta =date("Y-m-d");
        $FechaBaja =null;
        
        $this->con = ConexionBD::getInstance();
        $tipoabono = new TipoabonoModel();

        $tipoabono->setNombreAbono($NombreAbono);
        $tipoabono->setDescripcionAbono($DescripcionAbono);
        $tipoabono->setFechaAlta($FechaAlta);
        $tipoabono->setFechaBaja($FechaBaja);

        $result = $tipoabono->insertIntoDatabase($this->con);

        if (count($result) == 1) {

            $respuesta['estado'] = 'correcto';
            $respuesta['msg'] = 'tipo abono creado correctamente';
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        else
        {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(7)), 400);
        }
        
    }

    private function obtenerTiposAbono() {
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        $this->con = ConexionBD::getInstance();
        $tipoAbono = new TipoAbonoModel();

        $filas = $tipoAbono->findBySql($this->con, TipoAbonoModel::SQL_SELECT);

        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['tiposAbonos'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function actualizarTipoAbono() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        $this->con = ConexionBD::getInstance();
        $tipoabono = new TipoabonoModel();
        if (isset($this->datosPeticion['idTipoAbono'])) {
            $idTipoAbono = $this->datosPeticion['idTipoAbono'];
            $NombreAbono = $this->datosPeticion['NombreAbono'];
            $DescripcionAbono = $this->datosPeticion['DescripcionAbono'];
            
            $fila = $tipoabono->findById($this->con,$this->datosPeticion['idTipoAbono']);
            if (!empty($idTipoAbono)) {
                
                $tipoabono->setIdTipoAbono($idTipoAbono);
                $tipoabono->setNombreAbono($NombreAbono);
                $tipoabono->setDescripcionAbono($DescripcionAbono);
                $tipoabono->setFechaAlta($fila->getFechaAlta());
                $tipoabono->setFechaBaja($fila->getFechaBaja());

                $result = $tipoabono->updateToDatabase($this->con);

                if (count($result) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "tipo de abono actualizada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }

    private function obtenerTipoAbono() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        //el constructor del padre ya se encarga de sanear los datos de entrada  
        $idTipoAbono = $this->datosPeticion['idTipoAbono'];

        $this->con = ConexionBD::getInstance();
        $tipoabono = new TipoabonoModel();

        $fila = $tipoabono->findById($this->con, $idTipoAbono);

        if ($fila) {
            $respuesta['estado'] = 'correcto';
            $respuesta['tipoabono']['idTipoAbono'] = $fila->getIdTipoAbono();
            $respuesta['tipoabono']['NombreAbono'] = $fila->getNombreAbono();
            $respuesta['tipoabono']['DescripcionAbono'] = $fila->getDescripcionAbono();
            $respuesta['tipoabono']['FechaAlta'] = date("d-m-Y",strtotime($fila->getFechaAlta()));
            $respuesta['tipoabono']['FechaBaja'] = date("d-m-Y",strtotime($fila->getFechaBaja()));
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
        
    private function obtenerTiposAbonosFiltro() {
        
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
                
        $nomtipoabono = $this->datosPeticion['NombreAbono'];
        $destipoabomo = $this->datosPeticion['DescripcionAbono'];
        
        $this->con = ConexionBD::getInstance();
        $sort = array(
            new DSC(TipoabonoModel::FIELD_NOMBREABONO, DSC::ASC),
            new DSC(TipoabonoModel::FIELD_DESCRIPCIONABONO, DSC::ASC)
        );
        
        $tipoabono = new TipoabonoModel();
        
        if($nomtipoabono != '')
            $tipoabono->setNombreAbono($nomtipoabono);
        if($destipoabomo != '')
            $tipoabono->setDescripcionAbono($destipoabomo);
        
        $filter=array(
        new DFC(TipoabonoModel::FIELD_NOMBREABONO, $nomtipoabono, DFC::CONTAINS),
        new DFC(TipoabonoModel::FIELD_DESCRIPCIONABONO, $destipoabomo, DFC::CONTAINS)
        );
        $filas=TipoabonoModel::findByFilter($this->con, $filter, true, $sort);
        
        //$filas = TipoabonoModel::findByExample($this->con,$tipoabono,$sort);
                                
        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['tiposabonos'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        else
        {
            $respuesta['estado'] = 'No se encontraron datos';
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
    
    private function anularTipoAbono() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        if (isset($this->datosPeticion['idTipoAbono'])) {

            $this->con = ConexionBD::getInstance();
            $tipoabono = new TipoabonoModel();

            $idtipoabono = $this->datosPeticion['idTipoAbono'];
                        
            $fila = $tipoabono->findById($this->con,$this->datosPeticion['idTipoAbono']);
            
            $FechaBaja =date("Y-m-d");
                        
            if (!empty($idtipoabono)) {
                
                $tipoabono->setIdTipoAbono($idtipoabono);
                $tipoabono->setNombreAbono($fila->getNombreAbono());
                $tipoabono->setDescripcionAbono($fila->getDescripcionAbono());
                $tipoabono->setFechaAlta($fila->getFechaAlta());
                $tipoabono->setFechaBaja($FechaBaja);
                
                $filasActualizadas = $tipoabono->updateToDatabase($this->con);
                
                if (count($filasActualizadas) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "Tipo Abono anulado");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }
    
    private function activarTipoAbono() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        if (isset($this->datosPeticion['idTipoAbono'])) {

            $this->con = ConexionBD::getInstance();
            $tipoabono = new TipoabonoModel();

            $idtipoabono = $this->datosPeticion['idTipoAbono'];
                        
            $fila = $tipoabono->findById($this->con,$this->datosPeticion['idTipoAbono']);
            
            $FechaAlta =date("Y-m-d");
            $FechaBaja =NULL;
                        
            if (!empty($idtipoabono)) {
                
                $tipoabono->setIdTipoAbono($idtipoabono);
                $tipoabono->setNombreAbono($fila->getNombreAbono());
                $tipoabono->setDescripcionAbono($fila->getDescripcionAbono());
                $tipoabono->setFechaAlta($FechaAlta);
                $tipoabono->setFechaBaja($FechaBaja);
                
                $filasActualizadas = $tipoabono->updateToDatabase($this->con);
                
                if (count($filasActualizadas) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "Tipo Abono activado");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }
    
}
$tiposabonoBO = new TiposAbonosBO();
$tiposabonoBO->procesarLLamada();