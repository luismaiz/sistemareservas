<?php

require_once("../../ComunicacionesREST/rest.php");
require_once("../AccesoDatos/ConexionBD.php");
require_once("../Entidades/SalasModel.class.php");

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author Luis
 */
class AdministradorBO extends Rest {

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
        //var_dump($_SERVER);
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        $this->con = ConexionBD::getInstance();
        var_dump($this->con);
        $sala = new SalasModel();

        //if (isset($this->datosPeticion['nombre'], $this->datosPeticion['email'], $this->datosPeticion['pwd'])) {  
        $idSala = $this->datosPeticion['idSala'];
        $NombreSala = $this->datosPeticion['NombreSala'];
        $CapacidadSala = $this->datosPeticion['CapacidadSala'];
        $DescripcionSala = $this->datosPeticion['DescripcionSala'];
        $FechaAlta = $this->datosPeticion['FechaAlta'];
        $FechaBaja = $this->datosPeticion['FechaBaja'];

        $sala->setNombreSala($NombreSala);
        $sala->setCapacidadSala($CapacidadSala);
        $sala->setDescripcionSala($DescripcionSala);
        $sala->setFechaAlta($FechaAlta);
        $sala->setFechaBaja($FechaBaja);

        var_dump($sala);
        //echo gettype($con);
        $result = $sala->insertIntoDatabase($this->con);

        if ($result) {
            //$id = $this->_conn->lastInsertId();  
            $respuesta['estado'] = 'correcto';
            $respuesta['msg'] = 'sala creada correctamente';
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

    private function actualizarSala() {
        if ($_SERVER['REQUEST_METHOD'] != "PUT") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        //var_dump($SERVER);
        //echo $idUsuario . "<br/>";  
        if (isset($this->datosPeticion['idSala'])) {

            $this->con = ConexionBD::getInstance();
            $sala = new SalasModel();

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
                //var_dump($sala);
                $filasActualizadas = $sala->updateToDatabase($this->con);

                /* $query = $this->_conn->prepare("update sala set Nombre=:Nombre, Capacidad=:Capacidad, Descripcion=:Descripcion WHERE idSala =:idSala");  
                  $query->bindValue(":Nombre", $Nombre);
                  $query->bindValue(":Capacidad", $Capacidad);
                  $query->bindValue(":Descripcion", $Descripcion);
                  $query->bindValue(":idSala", $idSala);
                  $query->execute(); */
                //$filasActualizadas = $result->rowCount();  
                //var_dump($sala);
                //var_dump(count($sala));
                if (count($filasActualizadas) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "sala actualizada");
                    var_dump($resp);
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
            $sala = new SalasModel();

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
        //$query = $this->_conn->query("SELECT idSala,Nombre,Capacidad,Descripcion FROM sala");  
        //$filas = $query->fetchAll(PDO::FETCH_ASSOC);  

        $this->con = ConexionBD::getInstance();
        $sala = new SalasModel();

        $filas = $sala->findBySql($this->con, "Select * from sala");

        var_dump($filas);

        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';
            $respuesta['salas'] = $filas;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function obtenerSala() {
        //var_dump($SERVER);
        //if ($_SERVER['REQUEST_METHOD'] != "POST") {
        //  $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        //}
        //el constructor del padre ya se encarga de sanear los datos de entrada  
                

        if (isset($this->datosPeticion['idSala'])) {
            $idSala = isset($this->datosPeticion['idSala']);
            
            $this->con = ConexionBD::getInstance();
            $sala = new SalasModel();

            $sala->setIdSala($idSala);
            $fila = $sala->findById($this->con, $idSala);

            /* echo "datos de la consulta";
              echo $fila->getIdSala();
              echo $fila->getNombre();
              echo $fila->getCapacidad();
              echo $fila->getDescripcion(); */

            //var_dump($fila);
            //echo "Despues de fila";
            //consulta preparada ya hace mysqli_real_escape()  
            //$query = $this->_conn->prepare("SELECT idSala, Nombre, Capacidad, Descripcion FROM sala WHERE idSala=:idSala");
            //$query->bindValue(":idSala", $idSala);
            //$fila = $query->execute();
            var_dump($fila);
            //$query->execute();
            $respuesta = "";
            if ($fila) {
                $respuesta['estado'] = 'correcto';
                $respuesta['sala']['idSala'] = $fila->getIdSala();
                $respuesta['sala']['NombreSala'] = $fila->getNombreSala();
                $respuesta['sala']['CapacidadSala'] = $fila->getCapacidadSala();
                $respuesta['sala']['DescripcionSala'] = $fila->getDescripcionSala();
                $respuesta['sala']['FechaAlta'] = $fila->getFechaAlta();
                $respuesta['sala']['FechaBaja'] = $fila->getFechaAlta();
                //var_dump($respuesta);
                $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
            }
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
        }
    }

}

$administradorBO = new AdministradorBO();
$administradorBO->procesarLLamada();
