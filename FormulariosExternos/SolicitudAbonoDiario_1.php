<?php require "CabeceraExterna.php";
require "../ComunicacionesREST/Rest.php";

class SolicitudAbonoDiario extends Rest {

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

    private function pasarVariable($solicitud) {
        $_SESSION['solicitud'] = $solicitud;
        var_dump($solicitud);
        var_dump($_SESSION['solicitud']);
    }

    private function pagoRealizado() {
        // Primera comprobación. Cerraremos este if más adelante
        if ($_POST) {
            // Obtenemos los datos en formato variable1=valor1&variable2=valor2&...
            $raw_post_data = file_get_contents('php://input');

            // Los separamos en un array
            $raw_post_array = explode('&', $raw_post_data);

            // Separamos cada uno en un array de variable y valor
            $myPost = array();
            foreach ($raw_post_array as $keyval) {
                $keyval = explode("=", $keyval);
                //var_dump($keyval);
                if (count($keyval) == 2)
                    $myPost[$keyval[0]] = urldecode($keyval[1]);
            }

            if ($myPost["payer_status"] == 'verified') {
                //obtenemos los datos de sesion  
                //var_dump($_SESSION['solicitud']);                
                if (isset($_SESSION['solicitud'])) {
                    //var_dump(json_decode($_SESSION['solicitud'])->{'Nombre'});
                    ?>
                    <script>
                        alert('venga');
                        var s =<?php echo $_SESSION['solicitud']; ?>
                        alert('venga');    
                        var URL = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearSolicitud');

                        var Params = '&idTipoSolicitud=3&';
                        Params += jQuery.param(s);

                        var Ajax = new AjaxObj();
                        Ajax.open("POST", URL, false);
                        Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        Ajax.send(Params); // Enviamos los datos
                        alert('llega');
                        var response = Ajax.responseText;
                        if (JSON.parse(response).estado === 'correcto')
                        {
                            Params += '&Localizador=' + JSON.parse(response).solicitud.Localizador;
                            var URL = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=codigoQR');

                            //var Ajax = new AjaxObj();
                            Ajax.open("POST", URL, false);
                            Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            Ajax.send(Params); // Enviamos los datos
                            alert('llega2');    
                            //volvemos a actulizar la variable de sesión para que tenga el localizador y el codigo qr
                            var URL2 = BASE_URL.concat('sistemareservas/FormulariosExternos/SolicitudAbonoDiario.php?url=pasarVariable/' + JSON.stringify(JSON.parse('{"' + decodeURI(Params.substring(1)).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}')));

                            Ajax.open("POST", URL2, false);
                            Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            Ajax.send(Params); // Enviamos los datos
                            alert('llega3');
                        }
                    </script>
                    <div class="row" ng-app="solicitudAbonoDiario" ng-controller="RegistrarSolicitudAbonoDiarioController">
                        <div id="maininner" class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-sm-offset-1">
                            <section id="content"><div id="system-message-container">
                                </div>
                                <div id="system">
                                    <h2>Solicitud Abono Diario</h2>
                                    <div class="tab-content" ng-init="tab1 = true">
                                        <div class="tab-pane active" id="tab1" ng-show="tab1">
                                            <fieldset>
                                                <div class="form-group has-success has-feedback">
                                                    <div class="alert alert-success" id="divCorrecto">
                                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                        <strong>Correcto.</strong>  Operación realizada con éxito.
                                                    </div>

                                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                                        <label class="control-label" > Nombre</label><input type="text" name="Nombre" class="form-control" ng-maxlength="40" value="<?php echo json_decode($_SESSION['solicitud'])->{'Nombre'} ?>" readonly/>
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                                        <label class="control-label" > Apellidos </label><input type="text" name="Apellidos" class="form-control" ng-maxlength="40" value="<?php echo json_decode($_SESSION['solicitud'])->{'Apellidos'} ?>" readonly/>
                                                        <br>
                                                    </div>
                                                    <br />
                                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                                        <label class="control-label" >Dni</label><input type="text" name="DNI" class="form-control" ng-maxlength="9" ng-minlength="9" value="<?php echo json_decode($_SESSION['solicitud'])->{'DNI'} ?>" readonly/>
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                                        <label class="control-label" >E-mail</label><input type="email" name="EMail" class="form-control" value="<?php echo json_decode($_SESSION['solicitud'])->{'EMail'} ?>" readonly/>
                                                        <br>
                                                    </div>
                                                    <br />
                                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                                        <label class="control-label" >Día de acceso</label>
                                                        <input type="text" type="text" datepicker class="form-control" name="FechaAbonoDiario" id="FechaAbonoDiario" value="<?php echo json_decode($_SESSION['solicitud'])->{'FechaAbonoDiario'} ?>" readonly/>

                                                    </div>

                                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                                        <label class="control-label" > Pago Realizado</label><input type="text" name="Nombre" class="form-control" ng-maxlength="40" value="<?php echo $myPost["mc_gross"] ?>" readonly/>

                                                    </div>

                                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                                        <label class="control-label" > Cuenta Asociada</label><input type="text" name="Nombre" class="form-control" ng-maxlength="40" value="<?php echo $myPost["payer_email"] ?>" readonly/>
                                                    </div>
                                                    
                                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                                        <label class="control-label" > Codigo Localizador</label><input type="text" name="Localizador" class="form-control" ng-maxlength="40" value="<?php echo json_decode($_SESSION['solicitud'])->{'Localizador'} ?>" readonly/>
                                                    </div>
                                                    
                                                    <div class="col-md-6 col-sm-5 input-group-lg">
                                                        <label class="control-label" > Código QR</label><img style="width:10em; height:10em" name="codigoQR" class="form-control" src="<?php echo '../Negocio/NegocioAdministrador/temp/'.json_decode($_SESSION['solicitud'])->{'Localizador'}.'.png' ?>" />
                                                    </div>

                                                </div>
                                            </fieldset>                                            
                                            <ul class="pager">
                                                <li><a class="btn" ng-click="avanzar(1);">&nbsp;Inicio&nbsp;&nbsp;</a></li>
                                            </ul>
                                        </div>
                                    </div>
                            </section>
                        </div>
                    </div>      
                    <?php
                }
            } else {
                echo "pago no realizado";
                //borramos la solicitud en la bbdd
                ?>
                <div class="row" ng-app="solicitudAbonoDiario" ng-controller="RegistrarSolicitudAbonoDiarioController">
                    <div id="maininner" class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-sm-offset-1">
                        <section id="content"><div id="system-message-container">
                            </div>
                            <div id="system">
                                <h2>Solicitud Abono Diario</h2>
                                <form class="submission box style" name="formulario" novalidate action="https://www.sandbox.paypal.com/cgibin/webscr" class="standard">
                                    <div class="tab-content" ng-init="tab1 = true">
                                        <div class="tab-pane active" id="tab1" ng-show="tab1">
                                            <fieldset>
                                                <div class="form-group has-success has-feedback">
                                                    <div class="alert alert-danger" id="divError">
                                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                        <strong>Error</strong> Se ha producido un error al realizar la operación.
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    </section>
                            </div>
                    </div>      
                    <?php
                }
            } else {    // Si no hay datos $_POST
                // Podemos guardar la incidencia en un log, redirigir a una URL...
                ?>
                <script>
                    var app = angular.module('solicitudAbonoDiario', []);
                    app.controller('RegistrarSolicitudAbonoDiarioController', function RegistrarSolicitudAbonoDiarioController($scope) {
                        $scope.avanzar = function (idTab) {
                            if (idTab === 0) {
                                $scope.tab1 = true;
                                $scope.tab2 = false;                
                                $scope.tab3 = false;                                
                            }
                        };
                    });
                </script>
                <div class="row" ng-app="solicitudAbonoDiario" ng-controller="RegistrarSolicitudAbonoDiarioController">
                    <div id="maininner" class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-sm-offset-1">
                        <section id="content"><div id="system-message-container">
                            </div>
                            <div id="system">
                                <h2>Solicitud Abono Diario</h2>                        
                                <div class="tab-content" ng-init="tab1 = true">
                                    <div class="tab-pane active" id="tab1" ng-show="tab1">
                                        <fieldset>
                                            <div class="form-group has-success has-feedback">
                                                <div class="alert alert-warning" id="divWarning">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    <strong>Correcto.</strong>  Operación cancelada.
                                                </div>
                                            </div>
                                        </fieldset>
                                        <ul class="pager">
                                            <li><a class="btn" ng-click="avanzar(1);">&nbsp;Inicio&nbsp;&nbsp;</a></li>
                                        </ul>
                                    </div>
                                </div>
                        </section>
                    </div>
                </div>      
<?php
            }
        }

        private function inicio() {
            ?>
            <script>
                var Ajax = new AjaxObj();
                var app = angular.module('solicitudAbonoDiario', []);
                app.controller('RegistrarSolicitudAbonoDiarioController', function RegistrarSolicitudAbonoDiarioController($scope) {
                    alert('entramos');
                    $scope.avanzar = function (idTab) {
                        if (idTab === 0) {
                            $scope.tab1 = true;
                            $scope.tab2 = false;                                            
                        } else if (idTab === 1) {
                            $scope.tab1 = false;
                            $scope.tab2 = true;                            
                                        
                            var URL2 = BASE_URL.concat('sistemareservas/FormulariosExternos/SolicitudAbonoDiario.php?url=pasarVariable/' + JSON.stringify($scope.s));
                            var Params = '';//&solicitud=' + jQuery.param($scope.s);

                            Ajax.open("POST", URL2, false);
                            Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            Ajax.send(Params); // Enviamos los datos  
                            alert(Ajax.responseText);
                        } else if (idTab === 2) {
                            $scope.tab1 = false;
                            $scope.tab2 = false;
                        }
                    };
                    $.datepicker.regional['es'] = {
                        closeText: 'Cerrar',
                        prevText: '<Ant',
                        nextText: 'Sig>',
                        currentText: 'Hoy',
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                        dayNamesMin: ['Do', 'Lun', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                        weekHeader: 'Sm',
                        dateFormat: 'dd-mm-yy',
                        changeMonth: true,
                        changeYear: true,
                        yearRange: "2015:2020",
                        firstDay: 1,
                        isRTL: false,
                        showMonthAfterYear: false,
                        yearSuffix: ''
                    };
                    $.datepicker.setDefaults($.datepicker.regional['es']);
                });

                app.directive('datepicker', function () {
                    return  {
                        restrict: 'A',
                        require: '?ngModel',
                        link: function (scope, element, attrs, ngModel) {
                            element = $("#FechaAbonoDiario");
                            if (!ngModel)
                                return;
                            var optionsObj = {};
                            optionsObj.dateFormat = 'dd-mm-yy';
                            var updateModel = function (dateTxt) {
                                scope.$apply(function () {
                                    // Call the internal AngularJS helper to
                                    // update the two-way binding
                                    ngModel.$setViewValue(dateTxt);
                                });
                            };
                            var comprobarCaducidad = function (fecha) {
                                var values = fecha.split("-");
                                var dia = parseInt(values[0]);
                                var mes = parseInt(values[1]);
                                var ano = parseInt(values[2]);
                                // cogemos los valores actuales
                                var fecha_hoy = new Date();
                                var ahora_ano = (fecha_hoy.getYear()) + 1900;
                                var ahora_mes = parseInt((((fecha_hoy.getMonth()) + 1) < 10) ? '0' + ((fecha_hoy.getMonth()) + 1) : (fecha_hoy.getMonth()) + 1);
                                var ahora_dia = parseInt(fecha_hoy.getDate());
                                var valido = false;
                                if (ano === ahora_ano) {
                                    if (mes === ahora_mes) {
                                        if (dia >= ahora_dia) {
                                            valido = true;
                                        }
                                    }else if (mes > ahora_mes){
                                        valido= true;
                                    }
                                }else if(ano > ahora_ano){
                                    valido = true;
                                }
                                var hoy = ahora_ano+'-'+ahora_mes+'-'+ahora_dia;
                                if (valido) {
                                    console.log('Permitir Compra');
                                    return valido;
                                }
                                else {
                                    console.log('No se permite comprar abonos de días pasados');
                                    return valido;
                                }
                            };
                            optionsObj.onSelect = function (dateTxt) {
                                ngModel.$setValidity('caducado', comprobarCaducidad(dateTxt));
                                updateModel(dateTxt);
                                if (scope.select) {
                                    scope.$apply(function () {
                                        scope.select({date: dateTxt});
                                    });
                                }
                            };
                            ngModel.$render = function(dateText) {
                                element.datepicker('setDate', ngModel.$viewValue || '');
                            };
                            element.datepicker(optionsObj);
                        }
                    };

                });
            </script>
            <div class="row" ng-app="solicitudAbonoDiario" ng-controller="RegistrarSolicitudAbonoDiarioController">
                <div id="maininner" class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-sm-offset-1">
                    <section id="content"><div id="system-message-container">
                        </div>
                        <div id="system">
                            <h2>Solicitud Abono Diario</h2>
                            <form class="submission box style" name="formulario" novalidate action="https://www.sandbox.paypal.com/cgibin/webscr" class="standard">
                                <div class="tab-content" ng-init="tab1 = true">
                                    <div class="tab-pane active" id="tab1" ng-show="tab1">
                                        <fieldset>
                                            <div class="form-group has-success has-feedback">
                                                <div class="alert alert-danger" id="divError" style='display:none;'>
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    <strong>Error</strong> Se ha producido un error al realizar la operación.
                                                </div>
                                                <div class="alert alert-success" id="divCorrecto" style='display:none;'>
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    <strong>Correcto.</strong>  Operación realizada con éxito.
                                                </div>

                                                <div class="col-md-5 col-sm-5 input-group-lg">
                                                    <label class="control-label" > Nombre</label><input type="text" name="Nombre" ng-model="s.Nombre" class="form-control" required ng-pattern="/[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]/" placeholder="Blanca" ng-maxlength="40"/>
                                                    <span style="color:red" ng-show="formulario.Nombre.$dirty && formulario.Nombre.$invalid">
                                                        <span ng-show="formulario.Nombre.$error.required">Nombre obligatorio.</span>
                                                        <span ng-show="formulario.Nombre.$error.pattern">* Formato de Nombre no valido.</span>
                                                        <span ng-show="formulario.Nombre.$error.maxlength">* Nombre demasiado largo</span>
                                                    </span>
                                                </div>
                                                <div class="col-md-5 col-sm-5 input-group-lg">
                                                    <label class="control-label" > Apellidos </label><input type="text" name="Apellidos" ng-model="s.Apellidos" class="form-control" required ng-pattern="/[a-zA-Z]$/" placeholder="Garcia" ng-maxlength="40"/>
                                                    <span style="color:red" ng-show="formulario.Apellidos.$dirty && formulario.Apellidos.$invalid">
                                                        <span ng-show="formulario.Apellidos.$error.required">Apellidos obligatorio.</span>
                                                        <span ng-show="formulario.Apellidos.$error.pattern">* Formato de Apellidos no valido.</span>
                                                        <span ng-show="formulario.Apellidos.$error.maxlength">* Apellidos demasiado largo</span>
                                                    </span>
                                                    <br>
                                                </div>
                                                <br />
                                                <div class="col-md-5 col-sm-5 input-group-lg">
                                                    <label class="control-label" >Dni</label><input type="text" name="DNI" ng-model="s.DNI" class="form-control" ng-pattern="/^\d{8}[a-zA-Z]$/" placeholder="05330762y" ng-maxlength="9" ng-minlength="9"/>
                                                    <span style="color:red" ng-show="formulario.DNI.$dirty && formulario.DNI.$invalid">
                                                        <span ng-show="formulario.DNI.$error.pattern">* Formato de DNI no valido.</span>
                                                        <span ng-show="formulario.DNI.$error.maxlength">* DNI demasiado largo</span>
                                                        <span ng-show="formulario.DNI.$error.minlength">* DNI demasiado corto</span>
                                                    </span>
                                                </div>
                                                <div class="col-md-5 col-sm-5 input-group-lg">
                                                    <label class="control-label" >E-mail</label><input type="email" name="EMail" ng-model="s.EMail" class="form-control" required placeholder="info@developerji.com"/>
                                                    <span style="color:red" ng-show="formulario.EMail.$dirty && formulario.EMail.$invalid">
                                                        <span ng-show="formulario.EMail.$error.required">Email obligatorio.</span>
                                                        <span ng-show="formulario.EMail.$error.email">Formato de email no válido.</span>
                                                    </span>
                                                    <br>
                                                </div>
                                                <br />                            
                                                <div class="col-md-5 col-sm-5 input-group-lg">
                                                    <label class="control-label" >Día de acceso</label>
                                                    <input type="text" ng-model="s.FechaAbonoDiario" type="text" datepicker class="form-control" name="FechaAbonoDiario" id="FechaAbonoDiario" readonly ng-pattern="/^(0?[1-9]|[12][0-9]|3[01])\-(0?[1-9]|1[012])\-(199\d|[2-9]\d{3})$/" required placeholder="dd-mm-yyyy">
                                                    <span style="color:red" ng-show="formulario.FechaAbonoDiario.$dirty && formulario.FechaAbonoDiario.$invalid">
                                                        <span ng-show="formulario.FechaAbonoDiario.$error.pattern">* Formato de fecha no valido.</span>
                                                        <span ng-show="formulario.FechaAbonoDiario.$error.required">* Fecha obligatoria.</span>
                                                        <span ng-show="formulario.FechaAbonoDiario.$error.caducado">* No se pueden comprar abonos caducados</span>
                                                    </span>
                                                </div>
                                                <div class="col-md-12 col-sm-12 input-group-lg">
                                                    <label class="control-label">
                                                        <input type="checkbox" name="aceptado" ng-model="aceptado" value="aceptado" required />&nbsp;Acepto los términos y condiciones</label>
                                                </div>
                                            </div>                                                          
                                        </fieldset>
                                        <ul class="pager">
                                            <li><a class="btn" ng-click="avanzar(1);" ng-disabled="formulario.$invalid">&nbsp;Siguiente&nbsp;&nbsp;</a></li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane active" ng-show="tab2" id="2">
                                        <fieldset>
                                            <div class="form-group has-success has-feedback">						
                                                <input name="cmd" type="hidden" value="_cart" /> <!-- comprar varios productos -->
                                                <input name="upload" type="hidden" value="1" /> <!--  -->
                                                <input name="business" type="hidden" value="businesstest@pfgreservas.com" /> <!-- cuenta vendedor -->
                                                <input name="shopping_url" type="hidden" value="http://vw15115.dinaserver.com/hosting/reservascentro.es-web/sistemareservas/Frontal/Inicio.php" /> <!-- dirección tienda -->
                                                <input name="currency_code" type="hidden" value="EUR" /> <!-- tipo moneda -->
                                                <input name="return" type="hidden" value="http://vw15115.dinaserver.com/hosting/reservascentro.es-web/sistemareservas/FormulariosExternos/SolicitudAbonoDiario.php?url=pagoRealizado"> <!-- pago realizado -->
                                                <input name="cancel_return" type="hidden" value="http://vw15115.dinaserver.com/hosting/reservascentro.es-web/sistemareservas/FormulariosExternos/SolicitudAbonoDiario.php?url=pagoRealizado"> <!-- pago no realizado -->
                                                <input name="notify_url" type="hidden" value="">  <!-- control de pago -->
                                                <input type="hidden" name="no_shipping" value="1"> <!-- no pedir direccion de entrega -->
                                                <input name="rm" type="hidden" value="2"> <!-- numero de productos  -->
                                                <!--AbonoDiario ; Nombre: AbonoDiario ; Valor : 10.05 , Cantidad : 1<br>-->
                                                <input name="item_number_1" type="hidden"> <!-- identificador del producto -->
                                                <input name="item_name_1" type="hidden" value="AbonoDiario">  <!-- nombre del producto -->
                                                <input name="amount_1" id="amount_1" type="hidden" value="0.01">  <!-- precio del producto -->
                                                <input name="quantity_1" type="hidden" value="1">  <!-- cantidad del producto -->
                                            </div>
                                            <input type="image" id="submitBtn" value="Pay with PayPal" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif">
                                        </fieldset>              
                                        <ul class="pager">
                                            <li><a class="btn" ng-click="avanzar(0);">&nbsp;Anterior&nbsp;&nbsp;</a></li>
                                        </ul>
                                    </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
<?php
        }

    }

    $solicitudAbonoDiario = new SolicitudAbonoDiario();
    $solicitudAbonoDiario->procesarLLamada();

    require_once('PieExterno.php');
    ?>