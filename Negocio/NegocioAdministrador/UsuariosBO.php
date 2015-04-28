<?php
require_once("../../ComunicacionesREST/Rest.php");
require_once("../../Negocio/AccesoDatos/ConexionBD.php");
require_once("../../Negocio/Entidades/UsuarioModel.class.php");
require_once("../../Negocio/Entidades/helpers/DSC.class.php");
class UsuariosBO extends Rest{
     //Metodos CRUD Usuario
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
}
$usuarioBO = new UsuariosBO();
$usuariosBO->procesarLLamada();