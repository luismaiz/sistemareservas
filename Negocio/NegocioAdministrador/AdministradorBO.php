<?php

require_once("../../ComunicacionesREST/Rest.php");
require_once("../../Negocio/AccesoDatos/ConexionBD.php");
require_once("../../Negocio/Entidades/SalaModel.class.php");
require_once("../../Negocio/Entidades/ActividadModel.class.php");
require_once("../../Negocio/Entidades/ClaseModel.class.php");
require_once("../../Negocio/Entidades/TipotarifaModel.class.php");
require_once("../../Negocio/Entidades/PrecioModel.class.php");
require_once("../../Negocio/Entidades/TiposolicitudModel.class.php");
require_once("../../Negocio/Entidades/SolicitudModel.class.php");
require_once("../../Negocio/Entidades/TipoabonoModel.class.php");
require_once("../../Negocio/Entidades/helpers/DFC.class.php");
require_once("../../Negocio/Entidades/DatosolicitudclasedirigidaModel.class.php");
require_once("../../Negocio/Entidades/UsuarioModel.class.php");

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
        $Localizador = md5($this->generarLocalizador($Nombre, $Apellidos, $FechaSolicitud, $DNI));
        $Localizador = substr($Localizador, 0, -10);


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

       require_once "../UtilidadesNegocio/phpqrcode/qrlib.php";

        //ofcourse we need rights to create temp dir
        if (!file_exists($PNG_TEMP_DIR))
            mkdir($PNG_TEMP_DIR);


        $filename = $PNG_TEMP_DIR . '' . $Localizador . '.png';
        $nom = $Localizador . '.png';


        //echo $filename;

        $data = 'http://pfgreservas.rightwatch.es/Frontal/Inicio.php';

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
