<?php

require_once("../../ComunicacionesREST/Rest.php");
require_once("../../Negocio/AccesoDatos/ConexionBD.php");
require_once("../../Negocio/Entidades/PrecioModel.class.php");
require_once("../../Negocio/Entidades/helpers/DSC.class.php");
class PreciosBO extends Rest{
    //Metodos CRUD Precios
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
    private function crearPrecio() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //if (isset($this->datosPeticion['nombre'], $this->datosPeticion['email'], $this->datosPeticion['pwd'])) {

        $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];
        $idTipoAbono = $this->datosPeticion['idTipoAbono'];
        $idTipoTarifa = $this->datosPeticion['idTipoTarifa'];
        $NombrePrecio = $this->datosPeticion['NombrePrecio'];
        $DescripcionPrecio = $this->datosPeticion['DescripcionPrecio'];
        $Precio = $this->datosPeticion['Precio'];
        $FechaAlta = $this->datosPeticion['FechaAlta'];
        $FechaBaja = $this->datosPeticion['FechaBaja'];
     
        $this->con = ConexionBD::getInstance();
        $precio = new PrecioModel();
        $precio->setIdTipoSolicitud($idTipoSolicitud);
        $precio->setIdTipoAbono($idTipoAbono);
        $precio->setIdTipoTarifa($idTipoTarifa);
        $precio->setNombrePrecio($NombrePrecio);
        $precio->setDescripcionPrecio($DescripcionPrecio);
        $precio->setPrecio($Precio);
        $precio->setFechaAlta($FechaAlta);
        $precio->setFechaBaja($FechaBaja);

        $result = $precio->insertIntoDatabase($this->con);

        if ($result) {
            //$id = $this->_conn->lastInsertId();  
            $respuesta['estado'] = 'correcto';
            $respuesta['msg'] = 'precio creado correctamente';
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        else
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(7)), 400);        
    }

    private function obtenerPrecios() {
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        $this->con = ConexionBD::getInstance();
        $precio = new PrecioModel();

        $filas = $precio->findBySql($this->con, PrecioModel::SQL_SELECT);

        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['precios'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function actualizarPrecio() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //echo $idUsuario . "<br/>";  
        if (isset($this->datosPeticion['idPrecio'])) {
            $idPrecio = $this->datosPeticion['idPrecio'];
            $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];
            $idTipoAbono = $this->datosPeticion['idTipoAbono'];
            $idTipoTarifa = $this->datosPeticion['idTipoTarifa'];
            $NombrePrecio = $this->datosPeticion['NombrePrecio'];
            $DescripcionPrecio = $this->datosPeticion['DescripcionPrecio'];
            $Precio = $this->datosPeticion['Precio'];
            $FechaAlta = $this->datosPeticion['FechaAlta'];
            $FechaBaja = $this->datosPeticion['FechaBaja'];

            if (!empty($idSala)) {
                 $this->con = ConexionBD::getInstance();
                $precio = new PrecioModel();
                $precio->setIdTipoSolicitud($idTipoSolicitud);
                $precio->setIdTipoAbono($idTipoAbono);
                $precio->setIdTipoTarifa($idTipoTarifa);
                $precio->setNombrePrecio($NombrePrecio);
                $precio->setDescripcionPrecio($DescripcionPrecio);
                $precio->setPrecio($Precio);
                $precio->setFechaAlta($FechaAlta);
                $precio->setFechaBaja($FechaBaja);

                $result = $precio->updateToDatabase($this->con);

                if (count($result) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "precio actualizado");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }

    private function obtenerPrecio() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        //el constructor del padre ya se encarga de sanear los datos de entrada  
        $idPrecio = $this->datosPeticion['idPrecio'];

        $this->con = ConexionBD::getInstance();
        $precio = new PrecioModel();

        $fila = $precio->findById($this->con, $idPrecio);


        if ($fila) {
            $respuesta['estado'] = 'correcto';
            $respuesta['precio']['idPrecio'] = $fila->getIdPrecio();
            $respuesta['precio']['idTipoSolicitud'] = $fila->getIdTipoSolicitud();
            $respuesta['precio']['idTipoAbono'] = $fila->getIdTipoAbono();
            $respuesta['precio']['idTipoTarifa'] = $fila->getIdTipoTarifa();
            $respuesta['precio']['NombrePrecio'] = $fila->getNombrePrecio();
            $respuesta['precio']['DescripcionPrecio'] = $fila->getDescripcionPrecio();
            $respuesta['precio']['Precio'] = $fila->getPrecio();
            $respuesta['precio']['FechaAlta'] = $fila->getFechaAlta();
            $respuesta['precio']['FechaBaja'] = $fila->getFechaBaja();
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
    
    private function obtenerPreciosFiltro() {
        
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
                
        $tsolicitud = $this->datosPeticion['TipoSolicitud'];
        $tabono = $this->datosPeticion['TipoAbono'];
        $ttarifa = $this->datosPeticion['TipoTarifa'];
        
        
        $this->con = ConexionBD::getInstance();
        $sort = array(
            new DSC(PrecioModel:: FIELD_PRECIO, DSC::ASC)
            
        );
        
        $precio = new PrecioModel();
        
        if($tsolicitud != '')
            $precio->setIdTipoSolicitud($tsolicitud);
        if($tabono != '')
            $precio->setIdTipoAbono($tabono);
        if($ttarifa != '')
            $precio->setIdTipoTarifa($ttarifa);
        
        
        $filas = PrecioModel::findByExample($this->con,$precio,$sort);
                                
        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['precios'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
}
$preciosBO = new PreciosBO();
$preciosBO->procesarLLamada();