<?php

require_once("../../ComunicacionesREST/Rest.php");
require_once("../../Negocio/AccesoDatos/ConexionBD.php");
require_once("../../Negocio/Entidades/ActividadModel.class.php");
require_once("../../Negocio/Entidades/helpers/DSC.class.php");
class ActividadesBO extends Rest {
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
    }//put your code here
    
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
    
    private function obtenerActividadesFiltro() {
        
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
                
        $nombre = $this->datosPeticion['NombreActividad'];
        $intensidad = $this->datosPeticion['IntensidadActividad'];
        $grupo = $this->datosPeticion['Grupo'];
        
        $this->con = ConexionBD::getInstance();
        $sort = array(
            new DSC(ActividadModel::FIELD_NOMBREACTIVIDAD, DSC::ASC),
            new DSC(ActividadModel:: FIELD_INTENSIDADACTIVIDAD, DSC::ASC),
            new DSC(ActividadModel:: FIELD_GRUPO, DSC::ASC)
        );
        
        $actividad = new ActividadModel();
        
        if($nombre != '')
            $actividad->setNombreActividad($nombre);
        if($intensidad != '')
            $actividad->setIntensidadActividad($intensidad);
        if($grupo != '')
            $actividad->setGrupo($grupo);
        
        $filas = ActividadModel::findByExample($this->con,$actividad,$sort);
                                
        $num = count($filas);
        if ($num > 0) {
            $respuesta['estado'] = 'correcto';

            for ($i = 0; $i < $num; $i++) {
                $array[] = $filas[$i]->toHash();
            }

            $respuesta['actividades'] = $array;
            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
    }
}
$actividadesBO = new ActividadesBO();
$actividadesBO->procesarLLamada();
