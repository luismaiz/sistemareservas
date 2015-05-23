<?php
require_once("CabeceraExterna.php");
require_once("../ComunicacionesREST/Rest.php");
require_once("../Negocio/AccesoDatos/ConexionBD.php");
require_once("../Negocio/Entidades/ActividadModel.class.php");

class OcupacionActividad extends Rest {

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
            $url = explode('/', trim($_REQUEST['url']));
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
            } else
                $this->mostrarRespuesta($this->convertirJson($this->devolverError(0)), 404);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(0)), 404);
    }

    private function convertirJson($data) {
        return json_encode($data);
    }

//Metodos CRUD Actividad
    private function ocupacion($idActividad) {
        ?>

        <script>
            var idActividad = <?php echo $idActividad; ?>;
            var app = angular.module('formularioOcupacion', []);
            app.controller('FormularioOcupacionController', function FormularioOcupacionController($scope, $http) {
                var URL = BASE_URL.concat("Sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividad" + "&idActividad=" + idActividad);
                $http.get(URL)
                        .success(function (response) {
                            $scope.estado = response.estado;
                            if ($scope.estado === 'correcto')
                                $scope.actividad = response.actividad;
                        });
            });
        </script>

        <div class="row" ng-app="formularioOcupacion" ng-controller="FormularioOcupacionController">
            <div id="maininner" class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-sm-offset-1">
                <section id="content"><div id="system-message-container">
                    </div>
                    <div id="system">
                        <h2>Información Actividad: {{actividad.NombreActividad}}</h2>
                        <form class="submission box style" name="ocupacion" novalidate>
                            <fieldset>
                                <div class="form-group has-success has-feedback">
                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                        <label class="control-label" > Nombre de la Actividad</label>
                                        <input type="text" class="form-control" id="NombreActividad" ng-model="actividad.NombreActividad" readonly/>
                                    </div>
                                    <div class="col-md-4 col-sm-4 input-group-lg">
                                        <label class="control-label" >Descripcion</label>
                                        <input type="text" class="form-control" id="Descripcion" ng-model="actividad.Descripcion" readonly/>
                                        <br>
                                    </div>
                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                        <label class="control-label" > Intensidad </label>
                                        <input type="color" class="form-control color" id="IntensidadActividad" ng-model="actividad.IntensidadActividad" ng-init="actividad.IntensidadActividad" readonly/>
                                        <br>
                                    </div>
                                    <div class="col-md-2 col-sm-2 input-group-lg">
                                        <label class="control-label" >Edad Minima</label>
                                        <input type="text" class="form-control" id="EdadMinima" ng-model="actividad.EdadMinima" readonly/>
                                    </div>
                                    <div class="col-md-2 col-sm-2 input-group-lg">
                                        <label class="control-label" >Edad Maxima</label>
                                        <input type="text" class="form-control" id="EdadMaxima" ng-model="actividad.EdadMaxima" readonly/>
                                    </div>
                                </div>
                            </fieldset>      
                        </form>
                    </div>
                </section>
            </div>  
        </div>
        <?php
    }

}

$ocupacionActividad = new OcupacionActividad();
$ocupacionActividad->procesarLLamada();

require_once('PieExterno.php');
?>