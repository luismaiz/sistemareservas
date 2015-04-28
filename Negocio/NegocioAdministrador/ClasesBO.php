<?php

require_once("../../ComunicacionesREST/Rest.php");
require_once("../../Negocio/AccesoDatos/ConexionBD.php");
require_once("../../Negocio/Entidades/ClaseModel.class.php");
require_once("../../Negocio/Entidades/helpers/DFC.class.php");
require_once("../../Negocio/Entidades/helpers/DSC.class.php");
class ClasesBO extends Rest{
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
    
     //Metodos CRUD Clase
    private function crearClase() {

        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //if (isset($this->datosPeticion['nombre'], $this->datosPeticion['email'], $this->datosPeticion['pwd'])) {       	

        $idActividad = $this->datosPeticion['idActividad'];
        $idSala = $this->datosPeticion['idSala'];
        $HoraInicio = $this->datosPeticion['HoraInicio'];
        $HoraFin = $this->datosPeticion['HoraFin'];
        $Ocupacion = $this->datosPeticion['Ocupacion'];
        $Dia = $this->datosPeticion['Dia'];
        $Publicada = $this->datosPeticion['Publicada'];


        //if (!$this->existeUsuario($email)) {  
        /* $query = $this->_conn->prepare("INSERT into clase(idClase, Actividad, Sala, Hora_Inicio, Hora_Fin, Ocupacion, Dia, Publicada) 
          VALUES (:idClase, :Actividad, :Sala, :Hora_Inicio, :Hora_Fin, :Ocupacion, :Dia, :Publicada)");
          $query->bindValue(":idClase", $idClase);
          $query->bindValue(":Actividad", $Actividad);
          $query->bindValue(":Sala", $Sala);
          $query->bindValue(":Hora_Inicio", $Hora_Inicio);
          $query->bindValue(":Hora_Fin", $Hora_Fin);
          $query->bindValue(":Ocupacion", $Ocupacion);
          $query->bindValue(":Dia", $Dia);
          $query->bindValue(":Publicada", $Publicada);
          $query->execute(); */

        $this->con = ConexionBD::getInstance();
        $clase = new ClaseModel();

        $clase->setIdActividad($idActividad);
        $clase->setIdSala($idSala);
        $clase->setHoraInicio($HoraInicio);
        $clase->setHoraFin($HoraFin);
        $clase->setOcupacion($Ocupacion);
        $clase->setDia($Dia);
        $clase->setPublicada($Publicada);

        $result = $clase->insertIntoDatabase($this->con);


        if ($result) {

            //$id = $this->_conn->lastInsertId();  
            $respuesta['estado'] = 'correcto';
            $respuesta['msg'] = 'clase creada correctamente';
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

    private function obtenerClases() {
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //$query = $this->_conn->query("SELECT idSala,Nombre,Capacidad,Descripcion FROM sala");  
        //$filas = $query->fetchAll(PDO::FETCH_ASSOC);  

        $this->con = ConexionBD::getInstance();
        $clase = new ClaseModel();

        $filas = $clase->findBySql($this->con, ClaseModel::SQL_SELECT);

        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['clases'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function actualizarClase() {
        // if ($_SERVER['REQUEST_METHOD'] != "PUT") {
        //   $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        // }
        //echo $idUsuario . "<br/>";  
        if (isset($this->datosPeticion['idClase'])) {
            $idClase = $this->datosPeticion['idClase'];
            $idActividad = $this->datosPeticion['idActividad'];
            $idSala = $this->datosPeticion['idSala'];
            $HoraInicio = $this->datosPeticion['HoraInicio'];
            $HoraFin = $this->datosPeticion['HoraFin'];
            $Ocupacion = $this->datosPeticion['Ocupacion'];
            $Dia = $this->datosPeticion['Dia'];
            $Publicada = $this->datosPeticion['Publicada'];

            if (!empty($idClase)) {
                /* $query = $this->_conn->prepare("update clase set Hora_Inicio=:Hora_Inicio, Hora_Fin=:Hora_Fin, Ocupacion=:Ocupacion, Dia=:Dia, Publicada=:Publicada 
                  WHERE idClase=:idClase and Actividad=:Actividad and Sala=:Sala");
                  $query->bindValue(":idClase", $idClase);
                  $query->bindValue(":Actividad", $Actividad);
                  $query->bindValue(":Sala", $Sala);
                  $query->bindValue(":Hora_Inicio", $Hora_Inicio);
                  $query->bindValue(":Hora_Fin", $Hora_Fin);
                  $query->bindValue(":Ocupacion", $Ocupacion);
                  $query->bindValue(":Dia", $Dia);
                  $query->bindValue(":Publicada", $Publicada);
                  $query->execute();
                  $filasActualizadas = $query->rowCount(); */

                $this->con = ConexionBD::getInstance();
                $clase = new ClaseModel();

                $clase->setIdClase($idClase);
                $clase->setIdActividad($idActividad);
                $clase->setIdSala($idSala);
                $clase->setHoraInicio($HoraInicio);
                $clase->setHoraFin($HoraFin);
                $clase->setOcupacion($Ocupacion);
                $clase->setDia($Dia);
                $clase->setPublicada($Publicada);

                $fila = $clase->updateToDatabase($this->con);
                if (count($fila) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "clase actualizada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }

    private function borrarClase() {
        if ($_SERVER['REQUEST_METHOD'] != "DELETE") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        $idClase = $this->datosPeticion['idClase'];

        if ($idClase >= 0) {
            /* $query = $this->_conn->prepare("delete from clase WHERE idClase=:idClase");
              $query->bindValue(":idClase", $idClase);
              $query->execute(); */
            //rowcount para insert, delete. update  
            //$filasBorradas = $query->rowCount();
            $this->con = ConexionBD::getInstance();
            $clase = new ClaseModel();
            $clase->setIdClase($idClase);

            $result = $clase->deleteFromDatabase($this->con);

            if (count($result) == 1) {
                $resp = array('estado' => "correcto", "msg" => "clase borrada correctamente.");
                $this->mostrarRespuesta($this->convertirJson($resp), 200);
            } else {
                $this->mostrarRespuesta($this->convertirJson($this->devolverError(4)), 400);
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(4)), 400);
    }

    private function obtenerClase() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        //el constructor del padre ya se encarga de sanear los datos de entrada  
        $idClase = $this->datosPeticion['idClase'];

        //consulta preparada ya hace mysqli_real_escape()  
        /* $query = $this->_conn->prepare("SELECT idClase, Actividad, Sala, Hora_Inicio, Hora_Fin, Ocupacion, Dia, Publicada 
          FROM clase WHERE idClase=:idClase");
          $query->bindValue(":idClase", $idClase);
          $fila = $query->execute();

          $query->execute();^ */


        $this->con = ConexionBD::getInstance();
        $clase = new ClaseModel();

        $fila = $clase->findById($this->con, $idClase);

        if ($fila > 0) {
            $respuesta['estado'] = 'correcto';
            $respuesta['clase']['idClase'] = $fila->getIdClase();
            $respuesta['clase']['Actividad'] = $fila->getIdActividad();
            $respuesta['clase']['idSala'] = $fila->getIdSala();
            $respuesta['clase']['HoraInicio'] = $fila->getHoraInicio();
            $respuesta['clase']['HoraFin'] = $fila->getHoraFin();
            $respuesta['clase']['Ocupacion'] = $fila->getOcupacion();
            $respuesta['clase']['Dia'] = $fila->getDia();
            $respuesta['clase']['Publicada'] = $fila->getPublicada();
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
}

$clasesBO = new ClasesBO();
$clasesBO->procesarLLamada();