<?php

require_once("../../ComunicacionesREST/Rest.php");
require_once("../../Negocio/AccesoDatos/ConexionBD.php");
require_once("../../Negocio/Entidades/TipotarifaModel.class.php");
require_once("../../Negocio/Entidades/helpers/DSC.class.php");
class TarifasBO extends Rest{
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
    
    //Metodos CRUD Tipo Tarifa    
    private function crearTipoTarifa() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //if (isset($this->datosPeticion['nombre'], $this->datosPeticion['email'], $this->datosPeticion['pwd'])) {        
        $NombreTarifa = $this->datosPeticion['NombreTarifa'];
        $DescripcionTarifa = $this->datosPeticion['DescripcionTarifa'];
        $FechaAlta =date("Y-m-d", strtotime($this->datosPeticion['FechaAlta']));
            $FechaBaja =date("Y-m-d", strtotime($this->datosPeticion['FechaBaja']));

        $this->con = ConexionBD::getInstance();
        $tipotarifa = new TipotarifaModel();

        $tipotarifa->setNombreTarifa($NombreTarifa);
        $tipotarifa->setDescripcionTarifa($DescripcionTarifa);
        $tipotarifa->setFechaAlta($FechaAlta);
        $tipotarifa->setFechaBaja($FechaBaja);

        $result = $tipotarifa->insertIntoDatabase($this->con);

        if ($result) {
            //$id = $this->_conn->lastInsertId();  
            $respuesta['estado'] = 'correcto';
            $respuesta['msg'] = 'tipo tarifa creada correctamente';
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        else
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(7)), 400);
        //}  
        //else  
        //$this->mostrarRespuesta($this->convertirJson($this->devolverError(8)), 400);  
        //} else {  
        //$this->mostrarRespuesta($this->convertirJson($this->devolverError(7)), 400);  
        //}  
    }

    private function obtenerTiposTarifa() {
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
      

        $this->con = ConexionBD::getInstance();
        $tipoTarifa = new TipoTarifaModel();

        $filas = $tipoTarifa->findBySql($this->con, TipoTarifaModel::SQL_SELECT);

        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['tiposTarifas'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function actualizarTipoTarifa() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //echo $idUsuario . "<br/>";  
        if (isset($this->datosPeticion['idTipoTarifa'])) {
            $idTipoTarifa = $this->datosPeticion['idTipoTarifa'];
            $NombreTarifa = $this->datosPeticion['NombreTarifa'];
            $DescripcionTarifa = $this->datosPeticion['DescripcionTarifa'];
            $FechaAlta =date("Y-m-d", strtotime($this->datosPeticion['FechaAlta']));
            $FechaBaja =date("Y-m-d", strtotime($this->datosPeticion['FechaBaja']));

            if (!empty($idTipoTarifa)) {

                $this->con = ConexionBD::getInstance();
                $tipotarifa = new TipotarifaModel();

                $tipotarifa->setIdTipoTarifa($idTipoTarifa);
                $tipotarifa->setNombreTarifa($NombreTarifa);
                $tipotarifa->setDescripcionTarifa($DescripcionTarifa);
                $tipotarifa->setFechaAlta($FechaAlta);
                $tipotarifa->setFechaBaja($FechaBaja);

                $fila = $tipotarifa->updateToDatabase($this->con);

                if (count($fila) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "tipo tarifa actualizada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }

    private function obtenerTipoTarifa() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        

        if (isset($this->datosPeticion['idTipoTarifa'])) {
        $idTipoTarifa = $this->datosPeticion['idTipoTarifa'];

        $this->con = ConexionBD::getInstance();
        $tipotarifa = new TipotarifaModel();

        $fila = $tipotarifa->findById($this->con, $this->datosPeticion['idTipoTarifa']);


        if ($fila) {
            $respuesta['estado'] = 'correcto';
            $respuesta['tipotarifa']['idTipoTarifa'] = $fila->getIdTipoTarifa();
            $respuesta['tipotarifa']['NombreTarifa'] = $fila->getNombreTarifa();
            $respuesta['tipotarifa']['DescripcionTarifa'] = $fila->getDescripcionTarifa();
            $respuesta['tipotarifa']['FechaAlta'] = date("d-m-Y",strtotime($fila->getFechaAlta()));
            $respuesta['tipotarifa']['FechaBaja'] = date("d-m-Y",strtotime($fila->getFechaBaja()));
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
    }
    
    private function obtenerTiposTarifasFiltro() {
        
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
                
        $nomtipotarifa = $this->datosPeticion['NombreTarifa'];
        $destipotarifa = $this->datosPeticion['DescripcionTarifa'];
        
        $this->con = ConexionBD::getInstance();
        $sort = array(
            new DSC(TipotarifaModel::FIELD_NOMBRETARIFA, DSC::ASC),
            new DSC(TipotarifaModel::FIELD_DESCRIPCIONTARIFA, DSC::ASC)
        );
        
        $tipotarifa = new TipotarifaModel();
        
        if($nomtipotarifa != '')
            $tipotarifa->setNombreTarifa($nomtipotarifa);
        if($destipotarifa != '')
            $tipotarifa->setDescripcionTarifa($destipotarifa);
        
        $filas = TipotarifaModel::findByExample($this->con,$tipotarifa,$sort);
                                
        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['tipostarifas'] = $array;
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
$tarifasBO = new TarifasBO();
$tarifasBO->procesarLLamada();
