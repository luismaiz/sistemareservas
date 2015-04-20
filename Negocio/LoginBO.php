<?php

require_once("../ComunicacionesREST/rest.php");
require_once("AccesoDatos/ConexionBD.php");
require_once("Entidades/UsuarioModel.class.php");
require_once("Entidades/helpers/DFC.class.php");
require_once("Entidades/helpers/DSC.class.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginBO
 *
 * @author Alicia Barco Oviedo
 */
class LoginBO extends Rest {

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
            } else {
                $this->mostrarRespuesta($this->convertirJson($this->devolverError(0)), 404);
            }
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(0)), 404);
    }

    private function convertirJson($data) {
        return json_encode($data);
    }

    private function iniciarSesion() {
        //var_dump($SERVER);
         if ($_SERVER['REQUEST_METHOD'] != "POST") {
          $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
          }
          session_start();

        $nom = $this->datosPeticion['NombreUsuario'];
        $pas = $this->datosPeticion['Password'];

        $this->con = ConexionBD::getInstance();
        $sort = array(
            new DSC(UsuarioModel::FIELD_NOMBREUSUARIO, DSC::ASC),
            new DSC(UsuarioModel::FIELD_PASSWORD,  DSC::ASC)
        );

        $usuario = new UsuarioModel();
        $usuario->setNombreUsuario($nom);
        $usuario->setPassword($pas);
        $fila = UsuarioModel::findByExample($this->con, $usuario, true, $sort);
        var_dump($fila);
        $fila = $fila[0];
        $respuesta = "";
        if ($fila) {
            $respuesta['estado'] = 'correcto';
            $respuesta['usuario']['idUsuario'] = $fila->getIdUsuario();
            $respuesta['usuario']['NombreUsuario'] = $fila->getNombreUsuario();
            $respuesta['usuario']['Password'] = $fila->getPassword();
            $respuesta['usuario']['TipoUsuario'] = $fila->getTipoUsuario();

            $_SESSION['User'] =  $fila->getNombreUsuario();
            

            $this->mostrarRespuesta($this->convertirJson($respuesta), 200);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(3)), 400);

        //}
    }
}

$loginBO = new LoginBO();
$loginBO->procesarLLamada();

