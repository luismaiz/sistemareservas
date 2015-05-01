<?php

require_once("ComunicacionesREST/Rest.php");
require_once("Negocio/AccesoDatos/ConexionBD.php");
require_once("Negocio/Entidades/SalaModel.class.php");
require_once("Negocio/Entidades/ActividadModel.class.php");
require_once("Negocio/Entidades/ClaseModel.class.php");
require_once("Negocio/Entidades/TipotarifaModel.class.php");
require_once("Negocio/Entidades/PrecioModel.class.php");
require_once("Negocio/Entidades/TiposolicitudModel.class.php");
require_once("Negocio/Entidades/SolicitudModel.class.php");
require_once("Negocio/Entidades/TipoabonoModel.class.php");
require_once("Negocio/Entidades/helpers/DFC.class.php");
require_once("Negocio/Entidades/DatosolicitudclasedirigidaModel.class.php");
require_once("Negocio/Entidades/UsuarioModel.class.php");

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
        //var_dump($this->con);
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

        //var_dump($sala);
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
                    //var_dump($resp);
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

            for ($i = 0; $i < $num; $i++) {
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


        if (isset($this->datosPeticion['idSala'])) {
            $idSala = isset($this->datosPeticion['idSala']);

            $this->con = ConexionBD::getInstance();
            $sala = new SalaModel();

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
            //var_dump($fila);
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

    //Metodos CRUD Actividad    
    private function crearActividad() {

        //if ($_SERVER['REQUEST_METHOD'] != "POST") {
        //  $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        //}
        //if (isset($this->datosPeticion['nombre'], $this->datosPeticion['email'], $this->datosPeticion['pwd'])) {  
        //$idActividad = $this->datosPeticion['idActividad'];  
        $NombreActividad = $this->datosPeticion['NombreActividad'];
        $IntensidadActividad = $this->datosPeticion['IntensidadActividad'];
        $EdadMinima = $this->datosPeticion['EdadMinima'];
        $EdadMaxima = $this->datosPeticion['EdadMaxima'];
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
        $actividad->setEdadMinima($EdadMinima);
        $actividad->setEdadMaxima($EdadMaxima);
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

            for ($i = 0; $i < $num; $i++) {
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
            $EdadMinima = $this->datosPeticion['EdadMinima'];
            $EdadMaxima = $this->datosPeticion['EdadMaxima'];
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
                $actividad->setEdadMinima($EdadMinima);
                $actividad->setEdadMaxima($EdadMaxima);
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

            for ($i = 0; $i < $num; $i++) {
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
            $respuesta['tipoTarifa']['idTipoTarifa'] = $fila->getIdTipoTarifa();
            $respuesta['tipoTarifa']['NombreTarifa'] = $fila->getNombreTarifa();
            $respuesta['tipoTarifa']['DescripcionTarifa'] = $fila->getDescripcionTarifa();
            $respuesta['tipoTarifa']['FechaAlta'] = $fila->getFechaAlta();
            $respuesta['tipoTarifa']['FechaBaja'] = $fila->getFechaBaja();
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
        //$query = $this->_conn->query("SELECT idSala,Nombre,Capacidad,Descripcion FROM sala");  
        //$filas = $query->fetchAll(PDO::FETCH_ASSOC);  

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
        if ($_SERVER['REQUEST_METHOD'] != "PUT") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //echo $idUsuario . "<br/>";  
        if (isset($this->datosPeticion['idPrecio'])) {
            $idPrecio = $this->datosPeticion['idPrecio'];
            $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];
            $idTipoAbono = $this->datosPeticion['idTipoAbono'];
            $idActividad = $this->datosPeticion['idActividad'];
            $NombrePrecio = $this->datosPeticion['NombrePrecio'];
            $DescripcionPrecio = $this->datosPeticion['DescripcionPrecio'];
            $Precio = $this->datosPeticion['Precio'];
            $FechaAlta = $this->datosPeticion['FechaAlta'];
            $FechaBaja = $this->datosPeticion['FechaBaja'];

            if (!empty($idSala)) {
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
                $precio->setIdActividad($idActividad);
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

        //consulta preparada ya hace mysqli_real_escape()  
        /* $query = $this->_conn->prepare("SELECT idSala, Nombre, Capacidad, Descripcion FROM sala WHERE idSala=:idSala");
          $query->bindValue(":idSala", $idSala);
          $fila = $query->execute();

          $query->execute(); */

        $this->con = ConexionBD::getInstance();
        $precio = new PrecioModel();

        $fila = $precio->findById($this->con, $idPrecio);


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

        $this->con = ConexionBD::getInstance();
        $solicitud = new SolicitudModel();

        //echo $solicitud->getIdSolicitud();
        $idTipoSolicitud = $this->datosPeticion['idTipoSolicitud'];
        $idTipoTarifa = $this->datosPeticion['idTipoTarifa'];
        date_default_timezone_set("Europe/Madrid");
        $FechaSolicitud = date("y/m/d H:i:s");
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
        $Localizador = $this->generarLocalizador($Nombre, $Apellidos, $FechaSolicitud, $DNI);


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



        //var_dump($solicitud);
        //$solicitud->setIdTipoSolicitud($idSolicitud);
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
            $respuesta['solicitud']['IdSolicitud'] = $solicitud->getIdSolicitud();
            $respuesta['solicitud']['Localizador'] = $solicitud->getLocalizador();
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
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //$query = $this->_conn->query("SELECT idSala,Nombre,Capacidad,Descripcion FROM sala");  
        //$filas = $query->fetchAll(PDO::FETCH_ASSOC);             		

        $this->con = ConexionBD::getInstance();
        $solicitud = new SolicitudModel();

        $filter = array();
        $i = 0;
        if (isset($this->datosPeticion['Localizador']))
            $filter[$i+=1] = new DFC(SolicitudModel::FIELD_LOCALIZADOR, $this->datosPeticion['Localizador'], DFC::EXACT);
        if (isset($this->datosPeticion['Nombre']))
            $filter[$i+=1] = new DFC(SolicitudModel::FIELD_NOMBRE, $this->datosPeticion['Nombre'], DFC::CONTAINS);
        if (isset($this->datosPeticion['Apellidos']))
            $filter[$i+=1] = new DFC(SolicitudModel::FIELD_APELLIDOS, $this->datosPeticion['Apellidos'], DFC::CONTAINS);
        if (isset($this->datosPeticion['DNI']))
            $filter[$i+=1] = new DFC(SolicitudModel::FIELD_DNI, $this->datosPeticion['DNI'], DFC::EXACT);
        if (isset($this->datosPeticion['EMail']))
            $filter[$i+=1] = new DFC(SolicitudModel::FIELD_EMAIL, $this->datosPeticion['EMail'], DFC::EXACT);
        if (isset($this->datosPeticion['FechaSolicitud']))
            $filter[$i+=1] = new DFC(SolicitudModel::FIELD_FECHASOLICITUD, $this->datosPeticion['FechaSolicitud'], DFC::CONTAINS);

        //var_dump($filter);

        $filas = SolicitudModel::findByFilter($this->con, $filter, true, $sort);

        //var_dump($filas);

        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            //var_dump($array);

            $respuesta['solicitudes'] = $array;
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
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //$query = $this->_conn->query("SELECT idSala,Nombre,Capacidad,Descripcion FROM sala");  
        //$filas = $query->fetchAll(PDO::FETCH_ASSOC);  

        $this->con = ConexionBD::getInstance();
        $tipoAbono = new TipoAbonoModel();

        $filas = $tipoAbono->findBySql($this->con, TipoAbonoModel::SQL_SELECT);

        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['tiposAbono'] = $array;
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
        //$idSolicitud = $this->datosPeticion['idSolicitud'];
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

        //$datosSolicitudClaseDirigida->setIdSolicitud($idSolicitud);
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

    //Metodos CRUD Usuario
    private function obtenerUsuarios() {
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //$query = $this->_conn->query("SELECT idSala,Nombre,Capacidad,Descripcion FROM sala");  
        //$filas = $query->fetchAll(PDO::FETCH_ASSOC);  

        $this->con = ConexionBD::getInstance();
        $usuario = new UsuarioModel();

        $filas = $usuario->findBySql($this->con, UsuarioModel::SQL_SELECT);

        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['usuarios'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->devolverError(2), 204);
    }

    private function crearUsuario() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //if (isset($this->datosPeticion['nombre'], $this->datosPeticion['email'], $this->datosPeticion['pwd'])) {

        $NombreUsuario = $this->datosPeticion['NombreUsuario'];
        $Password = md5($this->datosPeticion['Password']);
        $TipoUsuario = $this->datosPeticion['TipoUsuario'];
        date_default_timezone_set("Europe/Madrid");
        $FechaAlta = date("y/m/d H:i:s");

        $this->con = ConexionBD::getInstance();
        $usuario = new UsuarioModel();

        $usuario->setNombreUsuario($NombreUsuario);
        $usuario->setPassword($Password);
        $usuario->setTipoUsuario($TipoUsuario);
        $usuario->setFechaAlta($FechaAlta);

        $result = $usuario->insertIntoDatabase($this->con);

        if ($result) {
            //$id = $this->_conn->lastInsertId();  
            $respuesta['estado'] = 'correcto';
            $respuesta['msg'] = 'usuario creado correctamente';
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        else
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(7)), 400);
    }

    private function actualizarUsuario() {
        if ($_SERVER['REQUEST_METHOD'] != "PUT") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
        //echo $idUsuario . "<br/>";  
        if (isset($this->datosPeticion['idUsuario'])) {
            $idUsuario = $this->datosPeticion['idUsuario'];
            $NombreUsuario = $this->datosPeticion['NombreUsuario'];
            $Password = $this->datosPeticion['Password'];
            $TipoUsuario = $this->datosPeticion['TipoUsuario'];

            date_default_timezone_set("Europe/Madrid");
            $Fecha = date("y/m/d H:i:s");

            if (!empty($idUsuario)) {
                $this->con = ConexionBD::getInstance();
                $usuario = new UsuarioModel();

                $usuario->setIdUsuario($idUsuario);
                $usuario->setFechaBaja($Fecha);

                $resultUpdate = $usuario->updateToDatabase($this->con);

                $usuario->setIdUsuario($idUsuario);
                $usuario->setNombreUsuario($NombreUsuario);
                $usuario->setPassword($Password);
                $usuario->setTipoUsuario($TipoUsuario);
                $usuario->setFechaAlta($Fecha);

                $resultInsert = $usuario->insertIntoDatabase($this->con);

                if (count($resultUpdate) == 1 && count($resultInsert) == 1) {
                    $resp = array('estado' => "correcto", "msg" => "precio actualizado");
                    $this->mostrarRespuesta($this->convertirJson($resp), 200);
                } else {
                    $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
                }
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(5)), 400);
    }
    
    private function obtenerUsuario() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        //el constructor del padre ya se encarga de sanear los datos de entrada  
        $idUsuario = $this->datosPeticion['idUsuario'];

        //consulta preparada ya hace mysqli_real_escape()  
        /* $query = $this->_conn->prepare("SELECT idSala, Nombre, Capacidad, Descripcion FROM sala WHERE idSala=:idSala");
          $query->bindValue(":idSala", $idSala);
          $fila = $query->execute();

          $query->execute(); */

        $this->con = ConexionBD::getInstance();
        $usuario = new UsuarioModel();

        $fila = $usuario->findById($this->con, $idUsuario);


        if ($fila) {
            $respuesta['estado'] = 'correcto';
            $respuesta['usuario']['idUsuario'] = $fila->getIdUsuario();
            $respuesta['usuario']['NombreUsuario'] = $fila->getNombreUsuario();
            $respuesta['usuario']['Password'] = $fila->getPassword();
            $respuesta['usuario']['TipoUsuario'] = $fila->getTipoUsuario();
            $respuesta['usuario']['FechaAlta'] = $fila->getFechaAlta();
            $respuesta['usuario']['FechaBaja'] = $fila->getFechaBaja();
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }

    private function codigoQR() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }

        $Localizador = $this->datosPeticion['Localizador'];
        $Nombre = $this->datosPeticion['Nombre'];
        $Apellidos = $this->datosPeticion['Apellidos'];
        $EMail = $this->datosPeticion['EMail'];


        //set it to writable location, a place for temp generated PNG files
        $PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;

        //html PNG location prefix
        $PNG_WEB_DIR = 'temp/';

        include "phpqrcode/qrlib.php";

        //ofcourse we need rights to create temp dir
        if (!file_exists($PNG_TEMP_DIR))
            mkdir($PNG_TEMP_DIR);


        $filename = $PNG_TEMP_DIR . '' . $Localizador . '.png';
        $nom = $Localizador . '.png';


        //echo $filename;

        $data = 'http://pfgreservas.rightwatch.es/frontaladministrador/Inicio.php';

        //processing form input
        //remember to sanitize user input in real-life solution !!!
        $errorCorrectionLevel = 'L';
        if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L', 'M', 'Q', 'H')))
            $errorCorrectionLevel = $_REQUEST['level'];

        $matrixPointSize = 10;
        if (isset($_REQUEST['size']))
            $matrixPointSize = min(max((int) $_REQUEST['size'], 1), 10);

        // user data
        //$filename = $PNG_TEMP_DIR.'test'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        //echo $PNG_WEB_DIR.$nombre;
        if ($this->enviarMail($PNG_WEB_DIR . '' . $nom, $Nombre, $Apellidos, $EMail, $Localizador))
            delete($filename);
    }

    private function enviarMail($file, $nom, $ape, $Email, $loc) {
        require("class.phpmailer.php");

        $mail = new PHPMailer();
        $mail->Host = "localhost";

        $mail->From = $Email; //"mariosgsg@gmail.com";
        $mail->FromName = $nom; //"Nombre del Remitente";
        $mail->Subject = "Reserva " . $loc;
        $mail->AddAddress($Email, $nom); //"mariosgsg@gmail.com", "Nombre 01");
        //$mail->AddAddress("mariosgsg@gmail.com", "Nombre 02");
        //$mail->AddCC("mariosgsg@gmail.com");
        //$mail->AddBCC("mariosgsg@gmail.com");

        $body = "Hola <strong>amigo</strong><br>";
        //$body .= "probando <i>PHPMailer<i>.<br><br>";
        //$body .= "<font color='red'>Saludos</font>";
        $mail->Body = $body;
        $mail->AltBody = "Hola amigo\nprobando PHPMailer\n\nSaludos";
        //$mail->AddAttachment("temp/localizador.jpg", "codigoQR.jpg");
        $mail->AddAttachment($file, $loc . '.png'); //"temp/Mario.png", "Mario.png");//"localizador.png");
        //$mail->AddAttachment($filename, "localizador.png");
        $result = $mail->Send();
        return $result;
    }

    private function generarLocalizador($nom, $ape, $fecha, $dni) {
        return substr($nom, 0, 2) . substr($ape, 0, 2) . str_replace('/', '', substr($fecha, 0, 8)) . str_replace(':', '', substr($fecha, 9, 5)) . $dni;
    }

}

$administradorBO = new AdministradorBO();
$administradorBO->procesarLLamada();
