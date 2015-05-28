<?php
require_once("CabeceraExterna.php");
require_once("../ComunicacionesREST/Rest.php");
require_once("../Negocio/AccesoDatos/ConexionBD.php");
require_once("../Negocio/Entidades/ClaseModel.class.php");

class OcupacionClase extends Rest {

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
    private function ocupacion($idClase) {
        ?>

        <script>
            var Ajax = new AjaxObj();
            var idClase = <?php echo $idClase; ?>;

            var app = angular.module('formularioOcupacion', []);
            app.controller('FormularioOcupacionController', function FormularioOcupacionController($scope, $http) {                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ClasesBO.php?url=obtenerClase');

                //var Url = "localhost/sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividadesFiltro";
                var Params = '&idClase=' + idClase;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos

                $scope.estado = JSON.parse(Ajax.responseText).estado;




                if ($scope.estado === 'correcto')
                {
                    $scope.clase = JSON.parse(Ajax.responseText).clase;    
                }
                





            });
        </script>

        <div class="row" ng-app="formularioOcupacion" ng-controller="FormularioOcupacionController">
            <div id="maininner" class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-sm-offset-1">
                <section id="content"><div id="system-message-container">
                    </div>
                    <div id="system">
                        <h2>Información Clase</h2>
                        <form class="submission box style" name="ocupacion" novalidate>
                            <fieldset>
                                <div class="form-group has-success has-feedback">
                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                        <label class="control-label" > Id de la Actividad</label>
                                        <input type="text" class="form-control" id="idActividad" ng-model="clase.idActividad" readonly/>
                                    </div>
                                    <div class="col-md-4 col-sm-4 input-group-lg">
                                        <label class="control-label" >Id Sala</label>
                                        <input type="text" class="form-control" id="Descripcion" ng-model="clase.idSala" readonly/>
                                        <br>
                                    </div>
                                    <div class="col-md-4 col-sm-5 input-group-lg">
                                        <label class="control-label" > Fecha Inicio </label>                                        

                                        <input type="text" class="form-control" id="FechaInicio" ng-model="clase.FechaInicio" readonly/>
                                        <br>
                                    </div>
                                    <div class="col-md-3 col-sm-2 input-group-lg">
                                        <label class="control-label" >Fecha Fin</label>
                                        <input type="text" class="form-control" id="EdadMinima" ng-model="clase.FechaFin" readonly/>
                                    </div>
                                    <div class="col-md-2 col-sm-3 input-group-lg">
                                        <label class="control-label" >Ocupacion</label>                                        

                                        <input type="color" class="form-control color" id="Ocupacion" ng-model="clase.Ocupacion" readonly disabled/>
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

$ocupacionClase = new OcupacionClase();

$ocupacionClase->procesarLLamada();

require_once('PieExterno.php');
?>