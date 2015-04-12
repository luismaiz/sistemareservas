<?php

require_once("../../ComunicacionesREST/rest.php");
require_once("../AccesoDatos/ConexionBD.php");
require_once("../Entidades/SalaModel.class.php");

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
                      
        for ($i = 1; $i < $num; $i++) 
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
                

        if (isset($this->datosPeticion['idSala'])) {
            $idSala = isset($this->datosPeticion['idSala']);
            
            $this->con = ConexionBD::getInstance();
            $sala = new SalaModel();

            //sala->setIdSala($idSala);
            $fila = $sala->findById($this->con, $idSala);
            
            $fila = $sala->findByFilter($this->con, $filter);
            $respuesta = "";
            if ($fila) {
                $respuesta['estado'] = 'correcto';
                $respuesta['sala'] = [$fila->toHash()];

                $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
            }
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);
        }
    }
    
    
    //Metodos CRUD Actividad    
   private function crearActividad() {      
     
     //if ($_SERVER['REQUEST_METHOD'] != "POST") {  
       //$this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);  
     //}  
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
         /*$query = $this->_conn->prepare("INSERT into actividad(idActividad, Nombre, Intensidad, Edad_min, Edad_max, Grupo, Descripcion, FechaAlta, FechaBaja) 
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
         $query->execute();  */
       
       
       
        $this->con = ConexionBD::getInstance();
        var_dump($this->con);
        $actividad = new ActividadModel();
        
        $actividad->setNombreActividad($NombreActividad);
        $actividad->setIntensidadActividad($IntensidadActividad);
        $actividad->setEdadMinima($Edad_Minima);
        $actividad->setEdadMaxima($Edad_Maxima);
        $actividad->setGrupo($Grupo);
        $actividad->setDescripcion($Descripcion);
        $actividad->setFechaAlta($FechaAlta);
        $actividad->setFechaBaja($FechaBaja);

        var_dump($actividad);
        //echo gettype($con);
        $result = $actividad->insertIntoDatabase($this->con);       
        
        var_dump($result);
         
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
     $query = $this->_conn->query("SELECT idActividad,Nombre,Intensidad,Edad_min,Edad_max,Grupo,Descripcion,FechaAlta,FechaBaja FROM actividad");  
     $filas = $query->fetchAll(PDO::FETCH_ASSOC);  
     $num = count($filas);  
     if ($num > 0) {  
       $respuesta['estado'] = 'correcto';  
       $respuesta['actividades'] = $filas;  
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
       $Nombre = $this->datosPeticion['Nombre'];  
       $Intensidad = $this->datosPeticion['Intensidad'];  
       $Edad_min = $this->datosPeticion['Edad_min'];  
       $Edad_max = $this->datosPeticion['Edad_max'];  
       $Grupo = $this->datosPeticion['Grupo'];         
       $Descripcion = $this->datosPeticion['Descripcion'];  
       $FechaAlta = $this->datosPeticion['FechaAlta'];  
       $FechaBaja = $this->datosPeticion['FechaBaja'];  
       
       if (!empty($idActividad)) {  
         $query = $this->_conn->prepare("update actividad set Nombre=:Nombre, Intensidad=:Intensidad, Edad_min=:Edad_min, Edad_max=:Edad_max, Grupo=:Grupo, Descripcion=:Descripcion, FechaAlta=:FechaAlta, FechaBaja=:FechaBaja  WHERE idActividad =:idActividad");  
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
         $filasActualizadas = $query->rowCount();  
         if ($filasActualizadas == 1) {  
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
     
     if ($idSala >= 0) {  
       $query = $this->_conn->prepare("delete from actividad WHERE idActividad =:idActividad");  
       $query->bindValue(":idActividad", $idActividad);  
       $query->execute();  
       //rowcount para insert, delete. update  
       $filasBorradas = $query->rowCount();  
       if ($filasBorradas == 1) {  
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
           $query = $this->_conn->prepare("SELECT idActividad,Nombre,Intensidad,Edad_min,Edad_max,Grupo,Descripcion,FechaAlta,FechaBaja FROM actividad WHERE idActividad=:idActividad");  
           $query->bindValue(":idActividad", $idActividad);           
           $fila = $query->execute();  
           
           $query->execute();  
           if ($fila = $query->fetch(PDO::FETCH_ASSOC)) {  
             $respuesta['estado'] = 'correcto';               
             $respuesta['actividad']['idActividad'] = $fila['idActividad'];  
             $respuesta['actividad']['Nombre'] = $fila['Nombre'];  
             $respuesta['actividad']['Intensidad'] = $fila['Intensidad'];  
             $respuesta['actividad']['Edad_min'] = $fila['Edad_min'];  
             $respuesta['actividad']['Edad_max'] = $fila['Edad_max'];  
             $respuesta['actividad']['Grupo'] = $fila['Grupo'];  
             $respuesta['actividad']['Descripcion'] = $fila['Descripcion'];  
             $respuesta['actividad']['FechaAlta'] = $fila['FechaAlta'];  
             $respuesta['actividad']['FechaBaja'] = $fila['FechaBaja'];  
             $this->mostrarRespuesta($this->convertirJson($respuesta), 200);  
           }          
     $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);  
   }

}

$administradorBO = new AdministradorBO();
$administradorBO->procesarLLamada();
