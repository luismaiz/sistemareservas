<?php

require_once("../../ComunicacionesREST/rest.php");
require_once("../AccesoDatos/ConexionBD.php");
require_once("../Entidades/SalaModel.class.php");
require_once("../Entidades/ActividadModel.class.php");
require_once("../Entidades/ClaseModel.class.php");
require_once("../Entidades/TipoTarifaModel.class.php");
require_once("../Entidades/PrecioModel.class.php");
require_once("../Entidades/TipoSolicitudModel.class.php");
require_once("../Entidades/SolicitudModel.class.php");
require_once("../Entidades/PrecioModel.class.php");
require_once("../Entidades/TipoabonoModel.class.php");
require_once("../Entidades/DatosolicitudclasedirigidaModel.class.php");
require_once("../Entidades/ActividadsolicitudclasedirigidaModel.class.php");

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

    private function administradorBO() {
        $clase = "Sala"; //$this->datosPeticion['metodo'];
        $metodo = "crearSala";

        //$reflexión = new SDO_Model_ReflectionDataObject($clase);
        $myClassReflection = new ReflectionClass($clase);
        $myClassReflection->getMethod($metodo)->invoke();
    }

    //Metodos CRUD Sala
    private function crearSala() {
        //var_dump($_SERVER);
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        $this->con = ConexionBD::getInstance();
        var_dump($this->con);
        $sala = new SalaModel();

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
        //$query = $this->_conn->query("SELECT idSala,Nombre,Capacidad,Descripcion FROM sala");  
        //$filas = $query->fetchAll(PDO::FETCH_ASSOC);  

        $this->con = ConexionBD::getInstance();
        $sala = new SalaModel();

        $filas = $sala->findBySql($this->con, SalaModel::SQL_SELECT);

        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';
                      
        for ($i = 0; $i < $num; $i++) 
        {
            $array[] = $filas[$i]->toHash();
        }
            
            $respuesta['salas'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function obtenerSala() {
        //var_dump($SERVER);
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //el constructor del padre ya se encarga de sanear los datos de entrada  
//            echo($this->datosPeticion['idSala']);
//        if (isset($this->datosPeticion['idSala'])) {
//            $idSala = isset($this->datosPeticion['idSala']);

        $this->con = ConexionBD::getInstance();

        //$sala->setIdSala($idSala);
        $fila = SalaModel::findById($this->con, $this->datosPeticion['idSala']);

        $respuesta = "";
        if ($fila) {
            $respuesta['estado'] = 'correcto';
            $respuesta['sala'] = $fila->toHash();

            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
        //}
    }

    //Metodos CRUD Actividad    
    private function crearActividad() {

        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //if (isset($this->datosPeticion['nombre'], $this->datosPeticion['email'], $this->datosPeticion['pwd'])) {  
        //$idActividad = $this->datosPeticion['idActividad'];  
        $NombreActividad = $this->datosPeticion['NombreActividad'];
        $IntensidadActividad = $this->datosPeticion['IntensidadActividad'];
        $Edad_Minima = $this->datosPeticion['Edad_Minima'];
        $Edad_Maxima = $this->datosPeticion['Edad_Maxima'];
        $Grupo = $this->datosPeticion['Grupo'];
        $Descripcion = $this->datosPeticion['Descripcion'];
        $FechaAlta = $this->datosPeticion['FechaAlta'];
        $FechaBaja = $this->datosPeticion['FechaBaja'];


        //if (!$this->existeUsuario($email)) {  
        /* $query = $this->_conn->prepare("INSERT into actividad(idActividad, Nombre, Intensidad, Edad_min, Edad_max, Grupo, Descripcion, FechaAlta, FechaBaja) 
          VALUES (:idActividad, :Nombre, :Intensidad, :Edad_min, :Edad_max, :Grupo, :Descripcion, :FechaAlta, :FechaBaja)");
          $query->bindValue(":idActividad", $idActividad);
          $query->bindValue(":Nombre", $Nombre);
          $query->bindValue(":Intensidad", $Intensidad);
          $query->bindValue(":Edad_min", $Edad_min);
          $query->bindValue(":Edad_max", $Edad_max);
          $query->bindValue(":Grupo", $Grupo);
          $query->bindValue(":Descripcion", $Descripcion);
          $query->bindValue(":FechaAlta", $FechaAlta);
          $query->bindValue(":FechaBaja", $FechaBaja);
          $query->execute(); */



        $this->con = ConexionBD::getInstance();
        //var_dump($this->con);
        $actividad = new ActividadModel();

        $actividad->setNombreActividad($NombreActividad);
        $actividad->setIntensidadActividad($IntensidadActividad);
        $actividad->setEdadMinima($Edad_Minima);
        $actividad->setEdadMaxima($Edad_Maxima);
        $actividad->setGrupo($Grupo);
        $actividad->setDescripcion($Descripcion);
        $actividad->setFechaAlta($FechaAlta);
        $actividad->setFechaBaja($FechaBaja);

        //var_dump($actividad);
        //echo gettype($con);
        $result = $actividad->insertIntoDatabase($this->con);

        //var_dump($result);

        if ($result) {

            //$id = $this->_conn->lastInsertId();  
            $respuesta['estado'] = 'correcto';
            $respuesta['msg'] = 'actividad creada correctamente';
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

    private function obtenerActividades() {
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //$query = $this->_conn->query("SELECT idSala,Nombre,Capacidad,Descripcion FROM sala");  
        //$filas = $query->fetchAll(PDO::FETCH_ASSOC);  

        $this->con = ConexionBD::getInstance();
        $actividad = new ActividadModel();

        $filas = $actividad->findBySql($this->con, ActividadModel::SQL_SELECT);

        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';
                      
        for ($i = 0; $i < $num; $i++) 
        {
            $array[] = $filas[$i]->toHash();
        }
            
            $respuesta['actividades'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function actualizarActividad() {
        if ($_SERVER['REQUEST_METHOD'] != "PUT") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //echo $idUsuario . "<br/>";  
        if (isset($this->datosPeticion['idActividad'])) {
            $idActividad = $this->datosPeticion['idActividad'];
            $NombreActividad = $this->datosPeticion['NombreActividad'];
            $IntensidadActividad = $this->datosPeticion['IntensidadActividad'];
            $Edad_Minima = $this->datosPeticion['Edad_Minima'];
            $Edad_Maxima = $this->datosPeticion['Edad_Maxima'];
            $Grupo = $this->datosPeticion['Grupo'];
            $Descripcion = $this->datosPeticion['Descripcion'];
            $FechaAlta = $this->datosPeticion['FechaAlta'];
            $FechaBaja = $this->datosPeticion['FechaBaja'];

            if (!empty($idActividad)) {
                $this->con = ConexionBD::getInstance();
                $actividad = new ActividadModel();

                $actividad->setIdActividad($idActividad);
                $actividad->setNombreActividad($NombreActividad);
                $actividad->setIntensidadActividad($IntensidadActividad);
                $actividad->setEdadMinima($Edad_Minima);
                $actividad->setEdadMaxima($Edad_Maxima);
                $actividad->setGrupo($Grupo);
                $actividad->setDescripcion($Descripcion);
                $actividad->setFechaAlta($FechaAlta);
                $actividad->setFechaBaja($FechaBaja);

                $result = $actividad->updateToDatabase($this->con);

                /* $query = $this->_conn->prepare("update actividad set Nombre=:Nombre, Intensidad=:Intensidad, Edad_min=:Edad_min, Edad_max=:Edad_max, Grupo=:Grupo, Descripcion=:Descripcion, FechaAlta=:FechaAlta, FechaBaja=:FechaBaja  WHERE idActividad =:idActividad");
                  $query->bindValue(":idActividad", $idActividad);
                  $query->bindValue(":Nombre", $Nombre);
                  $query->bindValue(":Intensidad", $Intensidad);
                  $query->bindValue(":Edad_min", $Edad_min);
                  $query->bindValue(":Edad_max", $Edad_max);
                  $query->bindValue(":Grupo", $Grupo);
                  $query->bindValue(":Descripcion", $Descripcion);
                  $query->bindValue(":FechaAlta", $FechaAlta);
                  $query->bindValue(":FechaBaja", $FechaBaja);
                  $query->execute();
                  $filasActualizadas = $query->rowCount(); */


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
        if ($_SERVER['REQUEST_METHOD'] != "DELETE") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        $idActividad = $this->datosPeticion['idActividad'];

        if ($idActividad >= 0) {
            //$query = $this->_conn->prepare("delete from actividad WHERE idActividad =:idActividad");
            //$query->bindValue(":idActividad", $idActividad);
            //$query->execute();
            //rowcount para insert, delete. update  
            //$filasBorradas = $query->rowCount();

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

        //consulta preparada ya hace mysqli_real_escape()  
        //$query = $this->_conn->prepare("SELECT idActividad,Nombre,Intensidad,Edad_min,Edad_max,Grupo,Descripcion,FechaAlta,FechaBaja FROM actividad WHERE idActividad=:idActividad");
        //$query->bindValue(":idActividad", $idActividad);
        //$fila = $query->execute();
        //$query->execute();

        $this->con = ConexionBD::getInstance();
        $actividad = new ActividadModel();

        $actividad->setIdActividad($idActividad);
        $fila = $actividad->findById($this->con, $idActividad);


        if ($fila) {
            $respuesta['estado'] = 'correcto';
            $respuesta['actividad']['idActividad'] = $fila->getIdActividad();
            $respuesta['actividad']['NombreActividad'] = $fila->getNombreActividad();
            $respuesta['actividad']['Intensidad'] = $fila->getIntensidadActividad();
            $respuesta['actividad']['Edad_Minima'] = $fila->getEdadMinima();
            $respuesta['actividad']['Edad_Maxima'] = $fila->getEdadMaxima();
            $respuesta['actividad']['Grupo'] = $fila->getGrupo();
            $respuesta['actividad']['Descripcion'] = $fila->getDescripcion();
            $respuesta['actividad']['FechaAlta'] = $fila->getFechaAlta();
            $respuesta['actividad']['FechaBaja'] = $fila->getFechaBaja();
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
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
                      
        for ($i = 0; $i < $num; $i++) 
        {
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

    //Metodos CRUD Tipo Tarifa    
    private function crearTipoTarifa() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //if (isset($this->datosPeticion['nombre'], $this->datosPeticion['email'], $this->datosPeticion['pwd'])) {        
        $NombreTarifa = $this->datosPeticion['NombreTarifa'];
        $DescripcionTarifa = $this->datosPeticion['DescripcionTarifa'];
        $FechaAlta = $this->datosPeticion['FechaAlta'];
        $FechaBaja = $this->datosPeticion['FechaBaja'];

        //if (!$this->existeUsuario($email)) {  
        /* $query = $this->_conn->prepare("INSERT into maestraprecios(idPrecio, NombrePrecio, DescripcionPrecio, Precio, TipoSolicitud, TipoAbono, FechaAlta, FechaBaja)
          VALUES (:idPrecio, :NombrePrecio, :DescripcionPrecio, :Precio, :TipoSolicitud, :TipoAbono, :FechaAlta, :FechaBaja)");
          $query->bindValue(":idPrecio", $idPrecio);
          $query->bindValue(":NombrePrecio", $NombrePrecio);
          $query->bindValue(":DescripcionPrecio", $DescripcionPrecio);
          $query->bindValue(":Precio", $Precio);
          $query->bindValue(":TipoSolicitud", $TipoSolicitud);
          $query->bindValue(":TipoAbono", $TipoAbono);
          $query->bindValue(":FechaAlta", $FechaAlta);
          $query->bindValue(":FechaBaja", $FechaBaja);
          $query->execute(); */


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
        //$query = $this->_conn->query("SELECT idSala,Nombre,Capacidad,Descripcion FROM sala");  
        //$filas = $query->fetchAll(PDO::FETCH_ASSOC);  

        $this->con = ConexionBD::getInstance();
        $tipoTarifa = new TipoTarifaModel();

        $filas = $tipoTarifa->findBySql($this->con, TipoTarifaModel::SQL_SELECT);

        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';
                      
        for ($i = 0; $i < $num; $i++) 
        {
            $array[] = $filas[$i]->toHash();
        }
            
            $respuesta['tiposTarifa'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function actualizarTipoTarifa() {
        if ($_SERVER['REQUEST_METHOD'] != "PUT") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //echo $idUsuario . "<br/>";  
        if (isset($this->datosPeticion['idTipoTarifa'])) {
            $idTipoTarifa = $this->datosPeticion['idTipoTarifa'];
            $NombreTarifa = $this->datosPeticion['NombreTarifa'];
            $DescripcionTarifa = $this->datosPeticion['DescripcionTarifa'];
            $FechaAlta = $this->datosPeticion['FechaAlta'];
            $FechaBaja = $this->datosPeticion['FechaBaja'];

            if (!empty($idTipoTarifa)) {
                /* $query = $this->_conn->prepare("update sala set Nombre=:Nombre, Capacidad=:Capacidad, Descripcion=:Descripcion WHERE idSala =:idSala");
                  $query->bindValue(":Nombre", $Nombre);
                  $query->bindValue(":Capacidad", $Capacidad);
                  $query->bindValue(":Descripcion", $Descripcion);
                  $query->bindValue(":idSala", $idSala);
                  $query->execute();
                  $filasActualizadas = $query->rowCount(); */


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
        //el constructor del padre ya se encarga de sanear los datos de entrada  
        $idTipoTarifa = $this->datosPeticion['idTipoTarifa'];

        //consulta preparada ya hace mysqli_real_escape()  
        /* $query = $this->_conn->prepare("SELECT idSala, Nombre, Capacidad, Descripcion FROM sala WHERE idSala=:idSala");
          $query->bindValue(":idSala", $idSala);
          $fila = $query->execute();

          $query->execute(); */


        $this->con = ConexionBD::getInstance();
        $tipotarifa = new TipotarifaModel();

        $fila = $tipotarifa->findById($this->con, $idTipoTarifa);


        if ($fila) {
            $respuesta['estado'] = 'correcto';
            $respuesta['sala']['idTipoTarifa'] = $fila->getIdTipoTarifa();
            $respuesta['sala']['NombreTarifa'] = $fila->getNombreTarifa();
            $respuesta['sala']['DescripcionTarifa'] = $fila->getDescripcionTarifa();
            $respuesta['sala']['FechaAlta'] = $fila->getFechaAlta();
            $respuesta['sala']['FechaBaja'] = $fila->getFechaBaja();
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }

    //Metodos CRUD Precios
    private function crearPrecio() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //if (isset($this->datosPeticion['nombre'], $this->datosPeticion['email'], $this->datosPeticion['pwd'])) {        

        $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];
        $idTipoAbono = $this->datosPeticion['idTipoAbono'];
        $idActividad = $this->datosPeticion['idActividad'];
        $NombrePrecio = $this->datosPeticion['NombrePrecio'];
        $DescripcionPrecio = $this->datosPeticion['DescripcionPrecio'];
        $Precio = $this->datosPeticion['Precio'];
        $FechaAlta = $this->datosPeticion['FechaAlta'];
        $FechaBaja = $this->datosPeticion['FechaBaja'];


        //if (!$this->existeUsuario($email)) {  
        /* $query = $this->_conn->prepare("INSERT into maestraprecios(idPrecio, NombrePrecio, DescripcionPrecio, Precio, TipoSolicitud, TipoAbono, FechaAlta, FechaBaja)
          VALUES (:idPrecio, :NombrePrecio, :DescripcionPrecio, :Precio, :TipoSolicitud, :TipoAbono, :FechaAlta, :FechaBaja)");
          $query->bindValue(":idPrecio", $idPrecio);
          $query->bindValue(":NombrePrecio", $NombrePrecio);
          $query->bindValue(":DescripcionPrecio", $DescripcionPrecio);
          $query->bindValue(":Precio", $Precio);
          $query->bindValue(":TipoSolicitud", $TipoSolicitud);
          $query->bindValue(":TipoAbono", $TipoAbono);
          $query->bindValue(":FechaAlta", $FechaAlta);
          $query->bindValue(":FechaBaja", $FechaBaja);
          $query->execute(); */


        $this->con = ConexionBD::getInstance();
        $precio = new PrecioModel();
        $precio->setIdTipoSolicitud($idTipoSolicitud);
        $precio->setIdTipoAbono($idTipoAbono);
        $precio->setIdActividad($idActividad);
        $precio->setNombrePrecio($NombrePrecio);
        $precio->setDescripcionPrecio($DescripcionPrecio);
        $precio->setPrecio($Precio);
        $precio->setFechaAlta($FechaAlta);
        $precio->setFechaBaja($FechaBaja);

        var_dump($precio);

        $result = $precio->insertIntoDatabase($this->con);

        var_dump($result);

        if ($result) {
            //$id = $this->_conn->lastInsertId();  
            $respuesta['estado'] = 'correcto';
            $respuesta['msg'] = 'precio creado correctamente';
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

    private function obtenerPrecios() {
        //if ($_SERVER['REQUEST_METHOD'] != "GET") {
        //  $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        //}
        /* $query = $this->_conn->query("SELECT idSala,Nombre,Capacidad,Descripcion FROM sala");
          $filas = $query->fetchAll(PDO::FETCH_ASSOC);
          $num = count($filas); */

        $this->con = ConexionBD::getInstance();
        $precio = new PrecioModel();

        $result = $precio->findBySql($this->con, "Select * from precio");

        if (count($result) > 0) {
            $respuesta['estado'] = 'correcto';
            $respuesta['salas'] = $filas;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function actualizarPrecio() {
        //if ($_SERVER['REQUEST_METHOD'] != "PUT") {
        //  $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        //}
        //echo $idUsuario . "<br/>";  
        if (isset($this->datosPeticion['Precio'])) {
            $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];
            $idTipoAbono = $this->datosPeticion['idTipoAbono'];
            $idActividad = $this->datosPeticion['idActividad'];
            $NombrePrecio = $this->datosPeticion['NombrePrecio'];
            $DescripcionPrecio = $this->datosPeticion['DescripcionPrecio'];
            $Precio = $this->datosPeticion['Precio'];
            $FechaAlta = $this->datosPeticion['FechaAlta'];
            $FechaBaja = $this->datosPeticion['FechaBaja'];

            if (!empty($Precio)) {
                /* $query = $this->_conn->prepare("update sala set Nombre=:Nombre, Capacidad=:Capacidad, Descripcion=:Descripcion WHERE idSala =:idSala");
                  $query->bindValue(":Nombre", $Nombre);
                  $query->bindValue(":Capacidad", $Capacidad);
                  $query->bindValue(":Descripcion", $Descripcion);
                  $query->bindValue(":idSala", $idSala);
                  $query->execute();
                  $filasActualizadas = $query->rowCount(); */


                $this->con = ConexionBD::getInstance();
                $precio = new PrecioModel();
                $precio->setIdTipoSolicitud($idTipoSolicitud);
                $precio->setIdTipoAbono($idTipoAbono);
                $precio->setNombrePrecio($NombrePrecio);
                $precio->setDescripcionPrecio($DescripcionPrecio);
                $precio->setPrecio($Precio);
                $precio->setFechaAlta($FechaAlta);
                $precio->setFechaBaja($FechaBaja);

                $result = $precio->insertIntoDatabase($this->con);

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

        var_dump($idPrecio);

        //consulta preparada ya hace mysqli_real_escape()  
        /* $query = $this->_conn->prepare("SELECT idSala, Nombre, Capacidad, Descripcion FROM sala WHERE idSala=:idSala");
          $query->bindValue(":idSala", $idSala);
          $fila = $query->execute();

          $query->execute(); */

        $this->con = ConexionBD::getInstance();
        $precio = new PrecioModel();

        $fila = $precio->findById($this->con, $idPrecio);

        //var_dump($fila);


        if ($fila) {
            $respuesta['estado'] = 'correcto';
            $respuesta['sala']['idPrecio'] = $fila->getIdPrecio();
            $respuesta['sala']['idTipoSolicitud'] = $fila->getIdTipoSolicitud();
            $respuesta['sala']['idTipoAbono'] = $fila->getIdTipoAbono();
            $respuesta['sala']['idActividad'] = $fila->getIdActividad();
            $respuesta['sala']['NombrePrecio'] = $fila->getNombrePrecio();
            $respuesta['sala']['DescripcionPrecio'] = $fila->getDescripcionPrecio();
            $respuesta['sala']['Precio'] = $fila->getPrecio();
            $respuesta['sala']['FechaAlta'] = $fila->getFechaAlta();
            $respuesta['sala']['FechaBaja'] = $fila->getFechaBaja();
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }

    //Metodos CRUD Solicitud
    private function crearTipoSolicitud() {

        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //if (isset($this->datosPeticion['nombre'], $this->datosPeticion['email'], $this->datosPeticion['pwd'])) {       	 	
        $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];
        $NombreSolicitud = $this->datosPeticion['NombreSolicitud'];
        $DescripcionSolicitud = $this->datosPeticion['DescripcionSolicitud'];
        $FechaAlta = $this->datosPeticion['FechaAlta'];
        $FechaBaja = $this->datosPeticion['FechaBaja'];
        //if (!$this->existeUsuario($email)) {  
        /* $query = $this->_conn->prepare("INSERT into tiposolicitud(idTipoSolicitud, NombreSolicitud, DescripcionSolicitud, FechaAlta, FechaBaja) 
          VALUES (:idTipoSolicitud, :NombreSolicitud, :DescripcionSolicitud, :FechaAlta, :FechaBaja)");
          $query->bindValue(":idTipoSolicitud", $idTipoSolicitud);
          $query->bindValue(":NombreSolicitud", $NombreSolicitud);
          $query->bindValue(":DescripcionSolicitud", $DescripcionSolicitud);
          $query->bindValue(":FechaAlta", $FechaAlta);
          $query->bindValue(":FechaBaja", $FechaBaja);
          $query->execute(); */

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
        //}  
        //else  
        //$this->mostrarRespuesta($this->convertirJson($this->devolverError(8)), 400);  
        //} else {  
        //$this->mostrarRespuesta($this->convertirJson($this->devolverError(7)), 400);  
        //}  
    }

    private function obtenerTiposSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        /* $query = $this->_conn->query("SELECT idTipoSolicitud, NombreSolicitud, DescripcionSolicitud, FechaAlta, FechaBaja FROM tiposolicitud");
          $filas = $query->fetchAll(PDO::FETCH_ASSOC);
          $num = count($filas); */

        $this->con = ConexionBD::getInstance();
        $tiposolicitud = new TiposolicitudModel();

        $filas = $tiposolicitud->findBySql($this->con, "Select * from tiposolicitud");


        if (count($filas) > 0) {
            $respuesta['estado'] = 'correcto';
            $respuesta['tiposSolicitudes'] = $filas;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function actualizarTipoSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] != "PUT") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        //echo $idUsuario . "<br/>";  
        if (isset($this->datosPeticion['idTipoSolicitud'])) {
            $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];
            $NombreSolicitud = $this->datosPeticion['NombreSolicitud'];
            $DescripcionSolicitud = $this->datosPeticion['DescripcionSolicitud'];
            $FechaAlta = $this->datosPeticion['FechaAlta'];
            $FechaBaja = $this->datosPeticion['FechaBaja'];

            if (!empty($idTipoSolicitud)) {
                /* $query = $this->_conn->prepare("update tiposolicitud set NombreSolicitud=:NombreSolicitud, DescripcionSolicitud=:DescripcionSolicitud, FechaAlta=:FechaAlta, FechaBaja=:FechaBaja  
                  WHERE idTipoSolicitud=:idTipoSolicitud");
                  $query->bindValue(":idTipoSolicitud", $idTipoSolicitud);
                  $query->bindValue(":NombreSolicitud", $NombreSolicitud);
                  $query->bindValue(":DescripcionSolicitud", $DescripcionSolicitud);
                  $query->bindValue(":FechaAlta", $FechaAlta);
                  $query->bindValue(":FechaBaja", $FechaBaja);
                  $query->execute();
                  $filasActualizadas = $query->rowCount(); */


                $this->con = ConexionBD::getInstance();
                $tiposolicitud = new TiposolicitudModel();

                //var_dump($tiposolicitud);

                $tiposolicitud->setIdTipoSolicitud($idTipoSolicitud);
                $tiposolicitud->setNombreSolicitud($NombreSolicitud);
                $tiposolicitud->setDescripcionSolicitud($DescripcionSolicitud);
                $tiposolicitud->setFechaAlta($FechaAlta);
                $tiposolicitud->setFechaBaja($FechaBaja);

                //var_dump($tiposolicitud);

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
        $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];

        //consulta preparada ya hace mysqli_real_escape()  
        /* $query = $this->_conn->prepare("SELECT idTipoSolicitud,NombreSolicitud,DescripcionSolicitud,FechaAlta,FechaBaja FROM tiposolicitud WHERE idTipoSolicitud=:idTipoSolicitud");
          $query->bindValue(":idTipoSolicitud", $idTipoSolicitud);
          $fila = $query->execute();

          $query->execute(); */

        $this->con = ConexionBD::getInstance();
        $tiposolicitud = new TiposolicitudModel();

        $fila = $tiposolicitud->findById($this->con, $idTipoSolicitud);

        if ($fila) {
            $respuesta['estado'] = 'correcto';
            $respuesta['tipoSolicitud']['idTipoSolicitud'] = $fila->getIdTipoSolicitud();
            $respuesta['tipoSolicitud']['NombreSolicitud'] = $fila->getNombreSolicitud();
            $respuesta['tipoSolicitud']['DescripcionSolicitud'] = $fila->getDescripcionSolicitud();
            $respuesta['tipoSolicitud']['FechaAlta'] = $fila->getFechaAlta();
            $respuesta['tipoSolicitud']['FechaBaja'] = $fila->getFechaBaja();
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }

    private function crearSolicitud() {

        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //if (isset($this->datosPeticion['nombre'], $this->datosPeticion['email'], $this->datosPeticion['pwd'])) {          

        $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];
        $idTipoTarifa = $this->datosPeticion['idTipoTarifa'];
        $FechaSolicitud = $this->datosPeticion['FechaSolicitud'];
        $Nombre = $this->datosPeticion['Nombre'];
        $Apellidos = $this->datosPeticion['Apellidos'];
        $DNI = $this->datosPeticion['DNI'];
        $EMail = $this->datosPeticion['EMail'];
        $Direccion = $this->datosPeticion['Direccion'];
        $CP = $this->datosPeticion['CP'];
        $Sexo = $this->datosPeticion['Sexo'];
        $FechaNacimiento = $this->datosPeticion['FechaNacimiento'];
        $TutorLegal = $this->datosPeticion['TutorLegal'];
        $Localidad = $this->datosPeticion['Localidad'];
        $Telefono1 = $this->datosPeticion['Telefono1'];
        $Telefono2 = $this->datosPeticion['Telefono2'];
        $Provincia = $this->datosPeticion['Provincia'];
        $DescripcionSolicitud = $this->datosPeticion['DescripcionSolicitud'];
        $Otros = $this->datosPeticion['Otros'];
        $Localizador = $this->datosPeticion['Localizador'];


        //if (!$this->existeUsuario($email)) {  
        /* $query = $this->_conn->prepare("INSERT into solicitud(idSolicitud,Fecha,Nombre,Apellido1,Apellido2,DNI,EMail,Calle,Piso,CP,Sexo,FechaNacimiento,TutorLegal,Localidad,Telefono1,Telefono2,Provincia,TipoSolicitud,TipoPrecio,Descripcion,Otros,Localizador) 
          VALUES (:idSolicitud,:Fecha,:Nombre,:Apellido1,:Apellido2,:DNI,:EMail,:Calle,:Piso,:CP,:Sexo,:FechaNacimiento,:TutorLegal,:Localidad,:Telefono1,:Telefono2,:Provincia,:TipoSolicitud,:TipoPrecio,:Descripcion,:Otros,:Localizador)");
          $query->bindValue(":idSolicitud", $idSolicitud);
          $query->bindValue(":Fecha", $Fecha);
          $query->bindValue(":Nombre", $Nombre);
          $query->bindValue(":Apellido1", $Apellido1);
          $query->bindValue(":Apellido2", $Apellido2);
          $query->bindValue(":DNI", $DNI);
          $query->bindValue(":Email", $Email);
          $query->bindValue(":Calle", $Calle);
          $query->bindValue(":Piso", $Piso);
          $query->bindValue(":CP", $CP);
          $query->bindValue(":Sexo", $Sexo);
          $query->bindValue(":FechaNacimiento", $FechaNacimiento);
          $query->bindValue(":TutorLegal", $TutorLegal);
          $query->bindValue(":Localidad", $Localidad);
          $query->bindValue(":Telefono1", $Telefono1);
          $query->bindValue(":Telefono2", $Telefono2);
          $query->bindValue(":Provincia", $Provincia);
          $query->bindValue(":TipoSolicitud", $TipoSolicitud);
          $query->bindValue(":TipoPrecio", $TipoPrecio);
          $query->bindValue(":Descripcion", $Descripcion);
          $query->bindValue(":Otros", $Otros);
          $query->bindValue(":Localizador", $Localizador);
          $query->execute(); */

        $this->con = ConexionBD::getInstance();
        $solicitud = new SolicitudModel();

        //var_dump($solicitud);


        $solicitud->setIdTipoSolicitud($idTipoSolicitud);
        $solicitud->setIdTipoTarifa($idTipoTarifa);
        $solicitud->setFechaSolicitud($FechaSolicitud);
        $solicitud->setNombre($Nombre);
        $solicitud->setApellidos($Apellidos);
        $solicitud->setDni($DNI);
        $solicitud->setEMail($EMail);
        $solicitud->setDireccion($Direccion);
        $solicitud->setCp($CP);
        $solicitud->setSexo($Sexo);
        $solicitud->setFechaNacimiento($FechaNacimiento);
        $solicitud->setTutorLegal($TutorLegal);
        $solicitud->setLocalidad($Localidad);
        $solicitud->setTelefono1($Telefono1);
        $solicitud->setTelefono2($Telefono2);
        $solicitud->setProvincia($Provincia);
        $solicitud->setDescripcionSolicitud($DescripcionSolicitud);
        $solicitud->setOtros($Otros);
        $solicitud->setLocalizador($Localizador);

        //var_dump($solicitud);

        $result = $solicitud->insertIntoDatabase($this->con);

        if (count($result) == 1) {

            //$id = $this->_conn->lastInsertId();  
            $respuesta['estado'] = 'correcto';
            $respuesta['msg'] = 'solicitud creada correctamente';
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

    private function obtenerSolicitudes() {
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        /* $query = $this->_conn->query("SELECT idSolicitud,Fecha,Nombre,Apellido1,Apellido2,DNI,EMail,Calle,Piso,CP,Sexo,FechaNacimiento,
          TutorLegal,Localidad,Telefono1,Telefono2,Provincia,TipoSolicitud,TipoPrecio,Descripcion,Otros,Localizador
          FROM solicitud");
          $filas = $query->fetchAll(PDO::FETCH_ASSOC);
          $num = count($filas); */

        $this->con = ConexionBD::getInstance();
        $solicitud = new SolicitudModel();

        $filas = $solicitud->findBySql($this->con, "Select * from solicitud");

        if (count($filas) > 0) {
            $respuesta['estado'] = 'correcto';
            $respuesta['solicitudes'] = $filas;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function actualizarSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] != "PUT") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        //echo $idUsuario . "<br/>";  
        if (isset($this->datosPeticion['idSolicitud'])) {
            $idSolicitud = $this->datosPeticion['idSolicitud'];
            $idTipoSolicitud = $this->datosPeticion['idTipoSolictud'];
            $idTipoTarifa = $this->datosPeticion['idTipoTarifa'];
            $FechaSolicitud = $this->datosPeticion['FechaSolicitud'];
            $Nombre = $this->datosPeticion['Nombre'];
            $Apellidos = $this->datosPeticion['Apellidos'];
            $DNI = $this->datosPeticion['DNI'];
            $EMail = $this->datosPeticion['EMail'];
            $Direccion = $this->datosPeticion['Direccion'];
            $CP = $this->datosPeticion['CP'];
            $Sexo = $this->datosPeticion['Sexo'];
            $FechaNacimiento = $this->datosPeticion['FechaNacimiento'];
            $TutorLegal = $this->datosPeticion['TutorLegal'];
            $Localidad = $this->datosPeticion['Localidad'];
            $Telefono1 = $this->datosPeticion['Telefono1'];
            $Telefono2 = $this->datosPeticion['Telefono2'];
            $Provincia = $this->datosPeticion['Provincia'];
            $DescripcionSolicitud = $this->datosPeticion['DescripcionSolicitud'];
            $Otros = $this->datosPeticion['Otros'];
            $Localizador = $this->datosPeticion['Localizador'];

            if (!empty($idSolicitud)) {
                /* $query = $this->_conn->prepare("update maestraprecios set Fecha=:Fecha,Nombre=:Nombre,Apellido1=:Apellido1,Apellido2=:Apellido2,DNI=:DNI,EMail=:EMail,
                  Calle=:Calle,Piso=:Piso,CP=:CP,Sexo=:Sexo,FechaNacimiento=:FechaNacimiento,TutorLegal=:TutorLegal,
                  Localidad=:Localidad,Telefono1=:Telefono1,Telefono2=:Telefono2,Provincia=:Provincia,
                  TipoSolicitud=:TipoSolicitud,TipoPrecio=:TipoPrecio,Descripcion=:Descripcion,Otros=:Otros
                  ,Localizador=:Localizador;
                  WHERE idSolicitud=:idSolicitud");
                  $query->bindValue(":idSolicitud", $idSolicitud);
                  $query->bindValue(":Fecha", $Fecha);
                  $query->bindValue(":Nombre", $Nombre);
                  $query->bindValue("Apellido1", $Apellido1);
                  $query->bindValue(":Apellido2", $Apellido2);
                  $query->bindValue(":DNI", $DNI);
                  $query->bindValue(":EMail", $EMail);
                  $query->bindValue(":Calle", $Calle);
                  $query->bindValue(":Piso", $Piso);
                  $query->bindValue(":CP", $CP);
                  $query->bindValue(":Sexo", $Sexo);
                  $query->bindValue(":FechaNacimiento", $FechaNacimiento);
                  $query->bindValue(":TutorLegal", $TutorLegal);
                  $query->bindValue(":Localidad", $Localidad);
                  $query->bindValue(":Telefono1", $Telefono1);
                  $query->bindValue(":Telefono2", $Telefono2);
                  $query->bindValue(":Provincia", $Provincia);
                  $query->bindValue(":TipoSolicitud", $TipoSolicitud);
                  $query->bindValue(":TipoPrecio", $TipoPrecio);
                  $query->bindValue(":Descripcion", $Descripcion);
                  $query->bindValue(":Otros", $Otros);
                  $query->bindValue(":Localizador", $Localizador);
                  $query->execute();
                  $filasActualizadas = $query->rowCount(); */


                $this->con = ConexionBD::getInstance();
                $solicitud = new SolicitudModel();

                //var_dump($solicitud);

                $solicitud->setIdSolicitud($idSolicitud);
                $solicitud->setIdTipoSolicitud($idTipoSolicitud);
                $solicitud->setIdTipoTarifa($idTipoTarifa);
                $solicitud->setFechaSolicitud($FechaSolicitud);
                $solicitud->setNombre($Nombre);
                $solicitud->setApellidos($Apellidos);
                $solicitud->setDni($DNI);
                $solicitud->setEMail($EMail);
                $solicitud->setDireccion($Direccion);
                $solicitud->setCp($CP);
                $solicitud->setSexo($Sexo);
                $solicitud->setFechaNacimiento($FechaNacimiento);
                $solicitud->setTutorLegal($TutorLegal);
                $solicitud->setLocalidad($Localidad);
                $solicitud->setTelefono1($Telefono1);
                $solicitud->setTelefono2($Telefono2);
                $solicitud->setProvincia($Provincia);
                $solicitud->setDescripcionSolicitud($DescripcionSolicitud);
                $solicitud->setOtros($Otros);
                $solicitud->setLocalizador($Localizador);

                //var_dump($solicitud);

                $result = $solicitud->updateToDatabase($this->con);

                if (count($result) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "solicitud actualizada");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }

    private function obtenerSolicitud() {
        //if ($_SERVER['REQUEST_METHOD'] != "POST") {
        //  $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        //}
        //el constructor del padre ya se encarga de sanear los datos de entrada  
        $idSolicitud = $this->datosPeticion['idSolicitud'];

        //consulta preparada ya hace mysqli_real_escape()  
        /* $query = $this->_conn->prepare("SELECT * FROM solicitud WHERE idSolicitud=:idSolicitud");
          $query->bindValue(":idSolicitud", $idSolicitud);
          $fila = $query->execute();

          $query->execute(); */

        $this->con = ConexionBD::getInstance();
        $solicitud = new SolicitudModel();

        $fila = $solicitud->findById($this->con, $idSolicitud);


        if ($fila) {
            $respuesta['solicitud'] = 'correcto';
            $respuesta['solicitud']['idSolicitud'] = $fila->getIdSolicitud();
            $respuesta['solicitud']['idTipoSolicitud'] = $fila->getIdTipoSolicitud();
            $respuesta['solicitud']['idTipoTarifa'] = $fila->getIdTipoTarifa();
            $respuesta['solicitud']['FechaSolicitud'] = $fila->getFechaSolicitud();
            $respuesta['solicitud']['Nombre'] = $fila->getNombre();
            $respuesta['solicitud']['Apellidos'] = $fila->getNombre();
            $respuesta['solicitud']['DNI'] = $fila->getDni();
            $respuesta['solicitud']['EMail'] = $fila->getEMail();
            $respuesta['solicitud']['Direccion'] = $fila->getDireccion();
            $respuesta['solicitud']['CP'] = $fila->getCp();
            $respuesta['solicitud']['Sexo'] = $fila->getSexo();
            $respuesta['solicitud']['FechaNacimiento'] = $fila->getFechaNacimiento();
            $respuesta['solicitud']['TutorLegal'] = $fila->getTutorLegal();
            $respuesta['solicitud']['Localidad'] = $fila->getLocalidad();
            $respuesta['solicitud']['Telefono1'] = $fila->getTelefono1();
            $respuesta['solicitud']['Telefono2'] = $fila->getTelefono2();
            $respuesta['solicitud']['Provincia'] = $fila->getProvincia();
            $respuesta['solicitud']['DescripcionSolicitud'] = $fila->getDescripcionSolicitud();
            $respuesta['solicitud']['Otros'] = $fila->getOtros();
            $respuesta['solicitud']['Localizador'] = $fila->getLocalidad();
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }

    //Metodos CRUD Abono    
    private function crearTipoAbono() {

        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //if (isset($this->datosPeticion['nombre'], $this->datosPeticion['email'], $this->datosPeticion['pwd'])) {       	 	

        $NombreAbono = $this->datosPeticion['NombreAbono'];
        $DescripcionAbono = $this->datosPeticion['DescripcionAbono'];
        $FechaAlta = $this->datosPeticion['FechaAlta'];
        $FechaBaja = $this->datosPeticion['FechaBaja'];
        //if (!$this->existeUsuario($email)) {  
        /* $query = $this->_conn->prepare("INSERT into tiposolicitud(idTipoSolicitud, NombreSolicitud, DescripcionSolicitud, FechaAlta, FechaBaja) 
          VALUES (:idTipoSolicitud, :NombreSolicitud, :DescripcionSolicitud, :FechaAlta, :FechaBaja)");
          $query->bindValue(":idTipoSolicitud", $idTipoSolicitud);
          $query->bindValue(":NombreSolicitud", $NombreSolicitud);
          $query->bindValue(":DescripcionSolicitud", $DescripcionSolicitud);
          $query->bindValue(":FechaAlta", $FechaAlta);
          $query->bindValue(":FechaBaja", $FechaBaja);
          $query->execute(); */

        $this->con = ConexionBD::getInstance();
        $tipoabono = new TipoabonoModel();

        $tipoabono->setNombreAbono($NombreAbono);
        $tipoabono->setDescripcionAbono($DescripcionAbono);
        $tipoabono->setFechaAlta($FechaAlta);
        $tipoabono->setFechaBaja($FechaBaja);

        $result = $tipoabono->insertIntoDatabase($this->con);

        if (count($result) == 1) {

            //$id = $this->_conn->lastInsertId();  
            $respuesta['estado'] = 'correcto';
            $respuesta['msg'] = 'tipo abono creado correctamente';
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

    private function obtenerTiposAbono() {
        //if ($_SERVER['REQUEST_METHOD'] != "GET") {
        //  $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        //}

        /* $query = $this->_conn->query("SELECT idTipoSolicitud, NombreSolicitud, DescripcionSolicitud, FechaAlta, FechaBaja FROM tiposolicitud");
          $filas = $query->fetchAll(PDO::FETCH_ASSOC);
          $num = count($filas); */

        $this->con = ConexionBD::getInstance();
        $tipoabono = new TipoabonoModel();

        $filas = $tipoabono->findBySql($this->con, "Select * from tipoabono");

        if (count($filas) > 0) {
            $respuesta['estado'] = 'correcto';
            $respuesta['tiposAbono'] = $filas;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function actualizarTipoAbono() {
        if ($_SERVER['REQUEST_METHOD'] != "PUT") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        //echo $idUsuario . "<br/>";  
        if (isset($this->datosPeticion['idTipoAbono'])) {
            $idTipoAbono = $this->datosPeticion['idTipoAbono'];
            $NombreAbono = $this->datosPeticion['NombreAbono'];
            $DescripcionAbono = $this->datosPeticion['DescripcionAbono'];
            $FechaAlta = $this->datosPeticion['FechaAlta'];
            $FechaBaja = $this->datosPeticion['FechaBaja'];

            if (!empty($idTipoAbono)) {
                /* $query = $this->_conn->prepare("update tiposolicitud set NombreSolicitud=:NombreSolicitud, DescripcionSolicitud=:DescripcionSolicitud, FechaAlta=:FechaAlta, FechaBaja=:FechaBaja  
                  WHERE idTipoSolicitud=:idTipoSolicitud");
                  $query->bindValue(":idTipoSolicitud", $idTipoSolicitud);
                  $query->bindValue(":NombreSolicitud", $NombreSolicitud);
                  $query->bindValue(":DescripcionSolicitud", $DescripcionSolicitud);
                  $query->bindValue(":FechaAlta", $FechaAlta);
                  $query->bindValue(":FechaBaja", $FechaBaja);
                  $query->execute();
                  $filasActualizadas = $query->rowCount(); */

                $this->con = ConexionBD::getInstance();
                $tipoabono = new TipoabonoModel();

                $tipoabono->setIdTipoAbono($idTipoAbono);
                $tipoabono->setNombreAbono($NombreAbono);
                $tipoabono->setDescripcionAbono($DescripcionAbono);
                $tipoabono->setFechaAlta($FechaAlta);
                $tipoabono->setFechaBaja($FechaBaja);

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

        //consulta preparada ya hace mysqli_real_escape()  
        /* $query = $this->_conn->prepare("SELECT idTipoSolicitud,NombreSolicitud,DescripcionSolicitud,FechaAlta,FechaBaja FROM tiposolicitud WHERE idTipoSolicitud=:idTipoSolicitud");
          $query->bindValue(":idTipoSolicitud", $idTipoSolicitud);
          $fila = $query->execute();

          $query->execute(); */

        $this->con = ConexionBD::getInstance();
        $tipoabono = new TipoabonoModel();

        $fila = $tipoabono->findById($this->con, $idTipoAbono);

        if ($fila) {
            $respuesta['estado'] = 'correcto';
            $respuesta['tipoSolicitud']['idTipoAbono'] = $fila->getIdTipoAbono();
            $respuesta['tipoSolicitud']['NombreAbono'] = $fila->getNombreAbono();
            $respuesta['tipoSolicitud']['DescripcionAbono'] = $fila->getDescripcionAbono();
            $respuesta['tipoSolicitud']['FechaAlta'] = $fila->getFechaAlta();
            $respuesta['tipoSolicitud']['FechaBaja'] = $fila->getFechaBaja();
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }

    //Metodos CRUD Clase Dirigida 
    private function crearDatosSolicitudClaseDirigida() {

        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //if (isset($this->datosPeticion['nombre'], $this->datosPeticion['email'], $this->datosPeticion['pwd'])) {       	 	

        $idSolicitud = $this->datosPeticion['idSolicitud'];
        $Titular = $this->datosPeticion['Titular'];
        $IBAN = $this->datosPeticion['IBAN'];
        $Entidad = $this->datosPeticion['Entidad'];
        $Oficina = $this->datosPeticion['Oficina'];
        $DigitoControl = $this->datosPeticion['DigitoControl'];
        $Cuenta = $this->datosPeticion['Cuenta'];

        //if (!$this->existeUsuario($email)) {  
        /* $query = $this->_conn->prepare("INSERT into clasedirigida(idClaseDirigida,SolicitudClaseDirigida,Titular,IBAN,Entidad,Oficina,DigitoControl,Cuenta) 
          VALUES (:idClaseDirigida,:SolicitudClaseDirigida,:Titular,:IBAN,:Entidad,:Oficina,:DigitoControl,:Cuenta)");
          $query->bindValue(":idClaseDirigida", $idClaseDirigida);
          $query->bindValue(":SolicitudClaseDirigida", $SolicitudClaseDirigida);
          $query->bindValue(":Titular", $Titular);
          $query->bindValue(":IBAN", $IBAN);
          $query->bindValue(":Entidad", $Entidad);
          $query->bindValue(":Oficina", $Oficina);
          $query->bindValue(":DigitoControl", $DigitoControl);
          $query->bindValue(":Cuenta", $Cuenta);
          $query->execute(); */

        $this->con = ConexionBD::getInstance();
        $datosSolicitudClaseDirigida = new DatosolicitudclasedirigidaModel();

        $datosSolicitudClaseDirigida->setIdSolicitud($idSolicitud);
        $datosSolicitudClaseDirigida->setTitular(base64_encode($Titular));
        $datosSolicitudClaseDirigida->setIban(base64_encode($IBAN));
        $datosSolicitudClaseDirigida->setEntidad(base64_encode($Entidad));
        $datosSolicitudClaseDirigida->setOficina(base64_encode($Oficina));
        $datosSolicitudClaseDirigida->setDigitoControl(base64_encode($DigitoControl));
        $datosSolicitudClaseDirigida->setCuenta(base64_encode($Cuenta));

        $result = $datosSolicitudClaseDirigida->insertIntoDatabase($this->con);

        if (count($result) == 1) {

            //$id = $this->_conn->lastInsertId();  
            $respuesta['estado'] = 'correcto';
            $respuesta['msg'] = 'clase dirigida creada correctamente';
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

    private function actualizarDatosSolicitudClaseDirigida() {

        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //if (isset($this->datosPeticion['nombre'], $this->datosPeticion['email'], $this->datosPeticion['pwd'])) {       	 	    	

        $idDatosSolicitudClaseDirigida = $this->datosPeticion['idDatosSolicitudClaseDirigida'];
        $idSolicitud = $this->datosPeticion['idSolicitud'];
        $Titular = $this->datosPeticion['Titular'];
        $IBAN = $this->datosPeticion['IBAN'];
        $Entidad = $this->datosPeticion['Entidad'];
        $Oficina = $this->datosPeticion['Oficina'];
        $DigitoControl = $this->datosPeticion['DigitoControl'];
        $Cuenta = $this->datosPeticion['Cuenta'];

        //if (!$this->existeUsuario($email)) {  
        /* $query = $this->_conn->prepare("UPDATE clasedirigida set SolicitudClaseDirigida=:SolicitudClaseDirigida,Titular=:Titular,IBAN=:IBAN,Entidad=:Entidad,
          Oficina=:Oficina,DigitoControl=:DigitoControl,Cuenta=:Cuenta
          WHERE idClaseDirigida=:idClaseDirigida");
          $query->bindValue(":idClaseDirigida", $idClaseDirigida);
          $query->bindValue(":SolicitudClaseDirigida", $SolicitudClaseDirigida);
          $query->bindValue(":Titular", $Titular);
          $query->bindValue(":IBAN", $IBAN);
          $query->bindValue(":Entidad", $Entidad);
          $query->bindValue(":Oficina", $Oficina);
          $query->bindValue(":DigitoControl", $DigitoControl);
          $query->bindValue(":Cuenta", $Cuenta);
          $query->execute();
          $filasActualizadas = $query->rowCount(); */

        $this->con = ConexionBD::getInstance();
        $datosSolicitudClaseDirigida = new DatosolicitudclasedirigidaModel();

        $datosSolicitudClaseDirigida->setIdDatosSolicitudClaseDirigida($idDatosSolicitudClaseDirigida);
        $datosSolicitudClaseDirigida->setIdSolicitud($idSolicitud);
        $datosSolicitudClaseDirigida->setTitular(base64_encode($Titular));
        $datosSolicitudClaseDirigida->setIban(base64_encode($IBAN));
        $datosSolicitudClaseDirigida->setEntidad(base64_encode($Entidad));
        $datosSolicitudClaseDirigida->setOficina(base64_encode($Oficina));
        $datosSolicitudClaseDirigida->setDigitoControl(base64_encode($DigitoControl));
        $datosSolicitudClaseDirigida->setCuenta(base64_encode($Cuenta));

        $result = $datosSolicitudClaseDirigida->updateToDatabase($this->con);

        if (count($result) == 1) {
            $resp = array('estado' => "correcto", "msg" => "clase dirigida actualizada");
            $this->mostrarRespuesta($this->convertirJson($resp), 200);
        } else {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }

    private function obtenerDatosSolicitudClaseDirigida() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        //el constructor del padre ya se encarga de sanear los datos de entrada  
        $idDatosSolicitudClaseDirigida = $this->datosPeticion['idDatosSolicitudClaseDirigida'];

        //consulta preparada ya hace mysqli_real_escape()  
        /* $query = $this->_conn->prepare("SELECT idClaseDirigida,SolicitudClaseDirigida,Titular,IBAN,Entidad,Oficina,DigitoControl,Cuenta 
          FROM clasedirigida WHERE idClaseDirigida=:idClaseDirigida");
          $query->bindValue(":idClaseDirigida", $idClaseDirigida);
          $fila = $query->execute();
          $query->execute();
         */


        $this->con = ConexionBD::getInstance();
        $datosSolicitudClaseDirigida = new DatosolicitudclasedirigidaModel();

        $fila = $datosSolicitudClaseDirigida->findById($this->con, $idDatosSolicitudClaseDirigida);

        if ($fila) {
            $respuesta['estado'] = 'correcto';
            $respuesta['clase']['idDatosSolicitudClaseDirigida'] = $fila->getIdDatosSolicitudClaseDirigida();
            $respuesta['clase']['idSolicitud'] = $fila->getIdSolicitud();
            $respuesta['clase']['Titular'] = base64_decode($fila->getTitular());
            $respuesta['clase']['IBAN'] = base64_decode($fila->getIban());
            $respuesta['clase']['Entidad'] = base64_decode($fila->getEntidad());
            $respuesta['clase']['Oficina'] = base64_decode($fila->getOficina());
            $respuesta['clase']['DigitoControl'] = base64_decode($fila->getDigitoControl());
            $respuesta['clase']['Cuenta'] = base64_decode($fila->getCuenta());
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }

    //Metodos CRUD Solicitud Clase Dirigida
    private function crearActividadSolicitudClaseDirigida() {

        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //if (isset($this->datosPeticion['nombre'], $this->datosPeticion['email'], $this->datosPeticion['pwd'])) {       	 	

        $IdActividadesSolicitudClaseDirigida = $this->datosPeticion['IdActividadesSolicitudClaseDirigida'];
        $idSolicitud = $this->datosPeticion['idSolicitud'];
        $idActividad = $this->datosPeticion['idActividad'];

        //if (!$this->existeUsuario($email)) {  
        /* $query = $this->_conn->prepare("INSERT into solicitudclasedirigida(IdSolicitudClaseDirigida, Solicitud, Clase) 
          VALUES (:IdSolicitudClaseDirigida, :Solicitud, :Clase)");
          $query->bindValue(":IdSolicitudClaseDirigida", $IdSolicitudClaseDirigida);
          $query->bindValue(":Solicitud", $Solicitud);
          $query->bindValue(":Clase", $Clase);

          $query->execute(); */


        $this->con = ConexionBD::getInstance();
        $actividadSolicitudClaseDirigida = new ActividadsolicitudclasedirigidaModel();
        $actividadSolicitudClaseDirigida->setIdSolicitud($idSolicitud);
        $actividadSolicitudClaseDirigida->setIdActividad($idActividad);

        $result = $actividadSolicitudClaseDirigida->insertIntoDatabase($this->con);

        if ($query->rowCount() == 1) {

            //$id = $this->_conn->lastInsertId();  
            $respuesta['estado'] = 'correcto';
            $respuesta['msg'] = 'solicitud clase dirigida creada correctamente';
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

    private function obtenerSolicitudesClasesDirigidas() {
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        /* $query = $this->_conn->query("SELECT IdSolicitudClaseDirigida, Solicitud, Clase FROM solicitudclasedirigida");
          $filas = $query->fetchAll(PDO::FETCH_ASSOC);
          $num = count($filas); */

        $this->con = ConexionBD::getInstance();
        $actividadSolicitudClaseDirigida = new ActividadsolicitudclasedirigidaModel();

        $filas = $actividadSolicitudClaseDirigida->findBySql($this->con, "Select * from actividadsolicitudclasedirigida");

        if (count($filas) > 0) {
            $respuesta['estado'] = 'correcto';
            $respuesta['solicitudes'] = $filas;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function actualizarActividadSolicitudClaseDirigida() {
        if ($_SERVER['REQUEST_METHOD'] != "PUT") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        //echo $idUsuario . "<br/>";  
        if (isset($this->datosPeticion['IdActividadesSolicitudClaseDirigida'])) {
            $IdActividadesSolicitudClaseDirigida = $this->datosPeticion['IdActividadesSolicitudClaseDirigida'];
            $IdSolicitud = $this->datosPeticion['IdSolicitud'];
            $IdActividad = $this->datosPeticion['IdActividad'];

            if (!empty($IdActividadesSolicitudClaseDirigida)) {
                /* $query = $this->_conn->prepare("update tiposolicitud set NombreSolicitud=:NombreSolicitud, DescripcionSolicitud=:DescripcionSolicitud, FechaAlta=:FechaAlta, FechaBaja=:FechaBaja  
                  WHERE idTipoSolicitud=:idTipoSolicitud");
                  $query->bindValue(":idTipoSolicitud", $idTipoSolicitud);
                  $query->bindValue(":NombreSolicitud", $NombreSolicitud);
                  $query->bindValue(":DescripcionSolicitud", $DescripcionSolicitud);
                  $query->bindValue(":FechaAlta", $FechaAlta);
                  $query->bindValue(":FechaBaja", $FechaBaja);
                  $query->execute();
                  $filasActualizadas = $query->rowCount(); */


                $this->con = ConexionBD::getInstance();
                $actividadSolicitudClaseDirigida = new ActividadsolicitudclasedirigidaModel();
                $actividadSolicitudClaseDirigida->setIdActividadesSolicitudClaseDirigida($IdActividadesSolicitudClaseDirigida);
                $actividadSolicitudClaseDirigida->setIdSolicitud($IdSolicitud);
                $actividadSolicitudClaseDirigida->setIdActividad($IdActividad);

                $result = $actividadSolicitudClaseDirigida->updateToDatabase($this->con);

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

    private function obtenerActividadSolicitudClaseDirigida() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        //el constructor del padre ya se encarga de sanear los datos de entrada  
        $idActividadesSolicitudClaseDirigida = $this->datosPeticion['idActividadesSolicitudClaseDirigida'];

        //consulta preparada ya hace mysqli_real_escape()  
        /* $query = $this->_conn->prepare("SELECT IdSolicitudClaseDirigida, Solicitud, Clase FROM solicitudclasedirigida WHERE IdSolicitudClaseDirigida=:IdSolicitudClaseDirigida");
          $query->bindValue(":IdSolicitudClaseDirigida", $IdSolicitudClaseDirigida);
          $fila = $query->execute();
          $query->execute();
         */

        $this->con = ConexionBD::getInstance();
        $actividadSolicitudClaseDirigida = new ActividadsolicitudclasedirigidaModel();

        $fila = $actividadSolicitudClaseDirigida->findById($this->con, $idActividadesSolicitudClaseDirigida);

        if ($fila) {
            $respuesta['estado'] = 'correcto';
            $respuesta['solicitud']['idActividadesSolicitudClaseDirigida'] = $fila->getIdActividadesSolicitudClaseDirigida();
            $respuesta['solicitud']['idSolicitud'] = $fila->getIdSolicitud();
            $respuesta['solicitud']['idActividad'] = $fila->getIdActividad();
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }

    //Metodos CRUD TipoAbono
    private function crearTipoAbono() {

        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //if (isset($this->datosPeticion['nombre'], $this->datosPeticion['email'], $this->datosPeticion['pwd'])) {       	 	

        $idTipoAbono = $this->datosPeticion['idTipoAbono'];
        $NombreAbono = $this->datosPeticion['NombreAbono'];
        $DescripcionAbono = $this->datosPeticion['DescripcionAbono'];
        $FechaAlta = $this->datosPeticion['FechaAlta'];
        $FechaBaja = $this->datosPeticion['FechaBaja'];
        //if (!$this->existeUsuario($email)) {  
        /* $query = $this->_conn->prepare("INSERT into tiposolicitud(idTipoSolicitud, NombreSolicitud, DescripcionSolicitud, FechaAlta, FechaBaja) 
          VALUES (:idTipoSolicitud, :NombreSolicitud, :DescripcionSolicitud, :FechaAlta, :FechaBaja)");
          $query->bindValue(":idTipoSolicitud", $idTipoSolicitud);
          $query->bindValue(":NombreSolicitud", $NombreSolicitud);
          $query->bindValue(":DescripcionSolicitud", $DescripcionSolicitud);
          $query->bindValue(":FechaAlta", $FechaAlta);
          $query->bindValue(":FechaBaja", $FechaBaja);
          $query->execute(); */

        $this->con = ConexionBD::getInstance();
        $tipoAbono = new SalaModel();



        if ($query->rowCount() == 1) {

            //$id = $this->_conn->lastInsertId();  
            $respuesta['estado'] = 'correcto';
            $respuesta['msg'] = 'tipo solicitud creado correctamente';
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

    private function obtenerTiposSolicitudes() {
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        $query = $this->_conn->query("SELECT idTipoSolicitud, NombreSolicitud, DescripcionSolicitud, FechaAlta, FechaBaja FROM tiposolicitud");
        $filas = $query->fetchAll(PDO::FETCH_ASSOC);
        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';
            $respuesta['tiposSolicitudes'] = $filas;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function actualizarTipoSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] != "PUT") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        //echo $idUsuario . "<br/>";  
        if (isset($this->datosPeticion['idTipoSolicitud'])) {
            $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];
            $NombreSolicitud = $this->datosPeticion['NombreSolicitud'];
            $DescripcionSolicitud = $this->datosPeticion['DescripcionSolicitud'];
            $FechaAlta = $this->datosPeticion['FechaAlta'];
            $FechaBaja = $this->datosPeticion['FechaBaja'];

            if (!empty($idTipoSolicitud)) {
                $query = $this->_conn->prepare("update tiposolicitud set NombreSolicitud=:NombreSolicitud, DescripcionSolicitud=:DescripcionSolicitud, FechaAlta=:FechaAlta, FechaBaja=:FechaBaja  
         				 WHERE idTipoSolicitud=:idTipoSolicitud");
                $query->bindValue(":idTipoSolicitud", $idTipoSolicitud);
                $query->bindValue(":NombreSolicitud", $NombreSolicitud);
                $query->bindValue(":DescripcionSolicitud", $DescripcionSolicitud);
                $query->bindValue(":FechaAlta", $FechaAlta);
                $query->bindValue(":FechaBaja", $FechaBaja);
                $query->execute();
                $filasActualizadas = $query->rowCount();
                if ($filasActualizadas == 1) {
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
        $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];

        //consulta preparada ya hace mysqli_real_escape()  
        $query = $this->_conn->prepare("SELECT idTipoSolicitud,NombreSolicitud,DescripcionSolicitud,FechaAlta,FechaBaja FROM tiposolicitud WHERE idTipoSolicitud=:idTipoSolicitud");
        $query->bindValue(":idTipoSolicitud", $idTipoSolicitud);
        $fila = $query->execute();

        $query->execute();
        if ($fila = $query->fetch(PDO::FETCH_ASSOC)) {
            $respuesta['estado'] = 'correcto';
            $respuesta['tipoSolicitud']['idTipoSolicitud'] = $fila['idTipoSolicitud'];
            $respuesta['tipoSolicitud']['NombreSolicitud'] = $fila['NombreSolicitud'];
            $respuesta['tipoSolicitud']['DescripcionSolicitud'] = $fila['DescripcionSolicitud'];
            $respuesta['tipoSolicitud']['FechaAlta'] = $fila['FechaAlta'];
            $respuesta['tipoSolicitud']['FechaBaja'] = $fila['FechaBaja'];
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }

}

$administradorBO = new AdministradorBO();
$administradorBO->procesarLLamada();
