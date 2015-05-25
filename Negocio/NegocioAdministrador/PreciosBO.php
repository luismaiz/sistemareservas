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
        
        $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];
        $idTipoAbono = $this->datosPeticion['idTipoAbono'];
        $idTipoTarifa = $this->datosPeticion['idTipoTarifa'];
        $NombrePrecio = $this->datosPeticion['NombrePrecio'];
        $DescripcionPrecio = $this->datosPeticion['DescripcionPrecio'];
        $Precio = $this->datosPeticion['Precio'];
        $FechaAlta =date("Y-m-d");
        
        
        $this->con = ConexionBD::getInstance();
        $precio = new PrecioModel();
       
        
        $filter=array(
        new DFC(PrecioModel::FIELD_FECHABAJA, 's', DFC::IS_NULL),
        new DFC(PrecioModel::FIELD_IDTIPOSOLICITUD, $idTipoSolicitud, DFC::EXACT),
        new DFC(PrecioModel::FIELD_IDTIPOABONO, $idTipoAbono, DFC::EXACT),
        new DFC(PrecioModel::FIELD_IDTIPOTARIFA, $idTipoTarifa, DFC::EXACT)
        );
        
        $filas = $precio->findByFilter($this->con,$filter);
                
        if (count($filas) >0) {
                $FechaBaja =date("Y-m-d");
                $precio->setIdPrecio($filas[0]->getIdPrecio());
                 $precio->setIdTipoSolicitud($filas[0]->getIdTipoSolicitud());
                    $precio->setIdTipoAbono($filas[0]->getIdTipoAbono());
                    $precio->setIdTipoTarifa($filas[0]->getIdTipoTarifa());
                    $precio->setNombrePrecio($filas[0]->getNombrePrecio());
                    $precio->setDescripcionPrecio($filas[0]->getDescripcionPrecio());
                    $precio->setPrecio($filas[0]->getPrecio());
                    $precio->setFechaAlta($filas[0]->getFechaAlta());
                    $precio->setFechaBaja($FechaBaja);

                $filasActualizadas = $precio->updateToDatabase($this->con);
                    
                    $precio->setIdPrecio(null);
                    $precio->setIdTipoSolicitud($idTipoSolicitud);
                    $precio->setIdTipoAbono($idTipoAbono);
                    $precio->setIdTipoTarifa($idTipoTarifa);
                    $precio->setNombrePrecio(html_entity_decode($NombrePrecio));
                    $precio->setDescripcionPrecio(html_entity_decode($DescripcionPrecio));
                    $precio->setPrecio($Precio);
                    $precio->setFechaAlta($FechaAlta);
                    $precio->setFechaBaja(NULL);

                $filasActualizadasinsert = $precio->insertIntoDatabase($this->con);
                
                if ($filasActualizadasinsert) 
                {
                    $respuesta['estado'] = 'correcto';
                    $respuesta['msg'] = 'sala creada correctamente';
                    $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
                } 
                else 
                {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
        }
        else
        {
                    $precio->setIdPrecio(null);
                    $precio->setIdTipoSolicitud($idTipoSolicitud);
                    $precio->setIdTipoAbono($idTipoAbono);
                    $precio->setIdTipoTarifa($idTipoTarifa);
                    $precio->setNombrePrecio(html_entity_decode($NombrePrecio));
                    $precio->setDescripcionPrecio(html_entity_decode($DescripcionPrecio));
                    $precio->setPrecio($Precio);
                    $precio->setFechaAlta($FechaAlta);
                    $precio->setFechaBaja(null);

                $filasActualizadas = $precio->insertIntoDatabase($this->con);
                
                if ($filasActualizadas) 
                {
                    $respuesta['estado'] = 'correcto';
                    $respuesta['msg'] = 'sala creada correctamente';
                    $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
                } 
                else 
                {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
        }
        
        
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
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
        $this->con = ConexionBD::getInstance();
        $precio = new PrecioModel();
                
        if (isset($this->datosPeticion['idPrecio'])) {
            $idPrecio = $this->datosPeticion['idPrecio'];
            $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];
            $idTipoAbono = $this->datosPeticion['idTipoAbono'];
            $idTipoTarifa = $this->datosPeticion['idTipoTarifa'];
            $NombrePrecio = $this->datosPeticion['NombrePrecio'];
            $DescripcionPrecio = $this->datosPeticion['DescripcionPrecio'];
            $Precio = $this->datosPeticion['Precio'];

            $fila = $precio->findById($this->con,$this->datosPeticion['idPrecio']);
            
            if (!empty($idPrecio)) {
                 
                $precio->setIdTipoSolicitud($idTipoSolicitud);
                $precio->setIdTipoAbono($idTipoAbono);
                $precio->setIdTipoTarifa($idTipoTarifa);
                $precio->setNombrePrecio(html_entity_decode($NombrePrecio));
                $precio->setDescripcionPrecio(html_entity_decode($DescripcionPrecio));
                $precio->setPrecio($Precio);
                $precio->setFechaAlta($fila->getFechaAlta());
                $precio->setFechaBaja($fila->getFechaBaja());

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
            $respuesta['precio']['FechaAlta'] = date("d-m-Y",strtotime($fila->getFechaAlta()));
            $respuesta['precio']['FechaBaja'] = date("d-m-Y",strtotime($fila->getFechaBaja()));
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
        
        if($tsolicitud != 0)
            $precio->setIdTipoSolicitud($tsolicitud);
        if($tabono != 0)
            $precio->setIdTipoAbono($tabono);
        if($ttarifa != 0)
            $precio->setIdTipoTarifa($ttarifa);
        //$precio->setFechaBaja($fechabaja);
        
        //$filas = PrecioModel::findByExample($this->con,$precio,$sort);
        
        $filter=array(
        new DFC(PrecioModel::FIELD_FECHABAJA, 's', DFC::IS_NULL));
                
        if($tsolicitud != 0)
            array_push($filter, new DFC(PrecioModel::FIELD_IDTIPOSOLICITUD, $tsolicitud, DFC::EXACT));
        if($tabono != 0)
            array_push($filter, new DFC(PrecioModel::FIELD_IDTIPOABONO, $tabono, DFC::EXACT));
        if($ttarifa != 0)
            array_push($filter, new DFC(PrecioModel::FIELD_IDTIPOTARIFA, $ttarifa, DFC::EXACT));
        
        $filas = PrecioModel::findByFilter($this->con,$filter);
                                
        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['precios'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        else
        {
            $respuesta['estado'] = 'No se encontraron datos';
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
    
    private function obtenerHistoricoPrecios() {
        
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
                
        //el constructor del padre ya se encarga de sanear los datos de entrada  
        $idPrecio = $this->datosPeticion['idPrecio'];

        $this->con = ConexionBD::getInstance();
        $precio = new PrecioModel();

        $fila = $precio->findById($this->con, $idPrecio);
        
        $tsolicitud = $fila->getIdTipoSolicitud();
        $tabono = $fila->getIdTipoAbono();
        $ttarifa = $fila->getIdTipoTarifa();
        
        $sort = array(
            new DSC(PrecioModel::FIELD_FECHABAJA, DSC::DESC)
        );
                        
        $filter=array(
        new DFC(PrecioModel::FIELD_FECHABAJA, DFC::IS_NULL, DFC::NOT),
        new DFC(PrecioModel::FIELD_IDTIPOSOLICITUD, $tsolicitud, DFC::EXACT),
        new DFC(PrecioModel::FIELD_IDTIPOABONO, $tabono, DFC::EXACT),
        new DFC(PrecioModel::FIELD_IDTIPOTARIFA, $ttarifa, DFC::EXACT)
        );
        
        $filas = PrecioModel::findByFilter($this->con,$filter);
        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['historicoprecios'] = $array;
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
$preciosBO = new PreciosBO();
$preciosBO->procesarLLamada();