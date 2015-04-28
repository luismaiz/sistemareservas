<?php


require_once("../../ComunicacionesREST/Rest.php");
require_once("../../Negocio/AccesoDatos/ConexionBD.php");
require_once("../../Negocio/Entidades/SalaModel.class.php");
require_once("../../Negocio/Entidades/helpers/DFC.class.php");
require_once("../../Negocio/Entidades/helpers/DSC.class.php");
class SalasBO  extends Rest {
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
    
      //Metodos CRUD Sala
    private function crearSala() {
        
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
           return $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
   
                if (isset($this->datosPeticion['idSala'])) {

            $this->con = ConexionBD::getInstance();
            $sala = new SalaModel();

            $idSala = $this->datosPeticion['idSala'];
            $NombreSala = $this->datosPeticion['NombreSala'];
            $CapacidadSala = $this->datosPeticion['CapacidadSala'];
            $DescripcionSala = $this->datosPeticion['DescripcionSala'];
            $FechaAlta = $this->datosPeticion['FechaAlta'];
            $FechaBaja = $this->datosPeticion['FechaBaja'];

            if (!empty($idSala)) {
                echo "jadjfkajdjf";
                $sala->setIdSala($idSala);
                $sala->setNombreSala($NombreSala);
                $sala->setCapacidadSala($CapacidadSala);
                $sala->setDescripcionSala($DescripcionSala);
                $sala->setFechaAlta($FechaAlta);
                $sala->setFechaBaja($FechaBaja);
                
                $filasActualizadas = $sala->updateToDatabase($this->con);
                
                if (count($filasActualizadas) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "sala actualizada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
        
        
    }

    private function actualizarSala() {
        if ($_SERVER['REQUEST_METHOD'] != "PUT") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        if (isset($this->datosPeticion['idSala'])) {

            $this->con = ConexionBD::getInstance();
            $sala = new SalaModel();

            $idSala = $this->datosPeticion['idSala'];
            $NombreSala = $this->datosPeticion['NombreSala'];
            $CapacidadSala = $this->datosPeticion['CapacidadSala'];
            $DescripcionSala = $this->datosPeticion['DescripcionSala'];
            $FechaAlta = $this->datosPeticion['FechaAlta'];
            $FechaBaja = $this->datosPeticion['FechaBaja'];

            if (!empty($idSala)) {
                
                $sala->setIdSala($idSala);
                $sala->setNombreSala($NombreSala);
                $sala->setCapacidadSala($CapacidadSala);
                $sala->setDescripcionSala($DescripcionSala);
                $sala->setFechaAlta($FechaAlta);
                $sala->setFechaBaja($FechaBaja);
                
                $filasActualizadas = $sala->updateToDatabase($this->con);
                
                if (count($filasActualizadas) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "sala actualizada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }

    private function borrarSala() {
        if ($_SERVER['REQUEST_METHOD'] != "DELETE") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        $idSala = $this->datosPeticion['idSala'];

        if ($idSala >= 0) {
            $this->con = ConexionBD::getInstance();
            $sala = new SalaModel();

            $sala->setIdSala($idSala);
            $result = $sala->deleteFromDatabase($this->con);
            //$query = $this->_conn->prepare("delete from sala WHERE idSala =:idSala");  
            //$query->bindValue(":idSala", $idSala);  
            //$query->execute();  
            //rowcount para insert, delete. update  
            //$filasBorradas = $query->rowCount();  
            if (count($result) == 1) {
                $resp = array('estado' => "correcto", "msg" => "usuario borrado correctamente.");
                $this->mostrarRespuesta($this->convertirJson($resp), 200);
            } else {
                $this->mostrarRespuesta($this->convertirJson($this->devolverError(4)), 400);
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(4)), 400);
    }

    private function obtenerSalas() {
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        $this->con = ConexionBD::getInstance();
        $sala = new SalaModel();

        $filas = $sala->findBySql($this->con, SalaModel::SQL_SELECT);

        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['salas'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function obtenerSala() {
       // var_dump($SERVER);
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //el constructor del padre ya se encarga de sanear los datos de entrada  

        if (isset($this->datosPeticion['idSala'])) {
            $idSala = isset($this->datosPeticion['idSala']);
            $this->con = ConexionBD::getInstance();
            
            $sala = new SalaModel();
            $fila = $sala->findById($this->con,$this->datosPeticion['idSala']);

          
            $respuesta = "";
            if ($fila) {
                $respuesta['estado'] = 'correcto';
                $respuesta['sala']['idSala'] = $fila->getIdSala();
                $respuesta['sala']['NombreSala'] = $fila->getNombreSala();
                $respuesta['sala']['CapacidadSala'] = $fila->getCapacidadSala();
                $respuesta['sala']['DescripcionSala'] = $fila->getDescripcionSala();
                $respuesta['sala']['FechaAlta'] = $fila->getFechaAlta();
                $respuesta['sala']['FechaBaja'] = $fila->getFechaAlta();

                $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
            }
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
        }
    }
    
    private function obtenerSalasFiltro() {
        
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
                
        $nomsala = $this->datosPeticion['NombreSala'];
        $capsala = $this->datosPeticion['CapacidadSala'];
        
        $this->con = ConexionBD::getInstance();
        $sort = array(
            new DSC(SalaModel::FIELD_NOMBRESALA, DSC::ASC),
            new DSC(SalaModel::FIELD_CAPACIDADSALA, DSC::ASC)
        );
        
        $sala = new SalaModel();
        
        if($nomsala != '')
            $sala->setNombreSala($nomsala);
        if($capsala != '')
            $sala->setCapacidadSala($capsala);
        
        $filas = SalaModel::findByExample($this->con,$sala,$sort);
                                
        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['salas'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
            
}
$salasBO = new SalasBO();
>>>>>>> 4f7a419ccaab99d17143b3a3490a8a51850fac6a
$salasBO->procesarLLamada();