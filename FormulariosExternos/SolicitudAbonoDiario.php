<?php require "CabeceraExterna.php"; ?>

<script>
    var Ajax = new AjaxObj();
    var app = angular.module('solicitudAbonoDiario',  ['ngStorage'])            
    .config(function($locationProvider) {
        $locationProvider.html5Mode(true);
    });
					
    function RegistrarSolicitudAbonoDiarioController($scope, $http,$location,$localStorage) {
        $scope.disabled = false;
        
        $scope.precio = [];
			
        $scope.crearSolicitud = function(s) {
            var URL = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=crearSolicitud');
            
            //alert(URL);
            var Params = 'idTipoSolicitud=3';
            Params += '&Nombre=' + s.Nombre +    
                '&Apellidos='+ s.Apellidos +
                '&DNI=' + s.DNI +
                '&EMail=' + s.EMail+
                '&FechaAbonoDiario=' + s.FechaAbonoDiario ;
            
            Ajax.open("POST", URL, false);
            Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            Ajax.send(Params); // Enviamos los datos
            //alert(JSON.parse(Ajax.responseText).solicitud.Localizador);
            
            $scope.estado = JSON.parse(Ajax.responseText).estado;
            //alert($scope.estado);			
            
            if ($scope.estado === 'correcto')
            {
                $scope.s.Localizador = JSON.parse(Ajax.responseText).solicitud.Localizador;
                $scope.s.IdSolicitud = JSON.parse(Ajax.responseText).solicitud.IdSolicitud;
                Params += '&Localizador=' + JSON.parse(Ajax.responseText).solicitud.Localizador;
                var URL = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=codigoQR');

                Ajax.open("POST", URL, true);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                localStorage.setItem('solicitud', JSON.stringify($scope.s));
            }
           
        };
        $scope.confirmarPago = function(s) {
                var host = "<?php echo $BASE_URL; ?>";
                var URL = host.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=confirmarPago');

                        var Params = 'idSolicitud=' + s;
			
                        var Ajax = new AjaxObj();
                        Ajax.open("POST", URL, false);
                        Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        Ajax.send(Params); // Enviamos los datos                        
			}; 
        if($location.search().url==='pagoRealizado')
        {
            $scope.s = JSON.parse(localStorage.getItem('solicitud'));
            //alert($scope.s);
            $scope.precio = JSON.parse(localStorage.getItem('precio')).precios[0].Precio;
            //$scope.crearSolicitud($scope.s);
            $scope.confirmarPago($scope.s.IdSolicitud);
            $scope.disabled = true;
                                        
        }
			
        $scope.avanzar = function (idTab) {
            if (idTab === 0) {
                $scope.tab1 = true;
                $scope.tab2 = false;
                $scope.tab4 = false;
                $scope.tab5 = false;
            } else if (idTab === 1) {
                $scope.tab1 = false;
                $scope.tab2 = true;                            
                $scope.tab4 = false;
                $scope.tab5 = false;
                $scope.crearSolicitud($scope.s);
                
              
            } else if (idTab === 2) {
                $scope.tab1 = false;
                $scope.tab2 = false;
                $scope.tab4 = false;
                $scope.tab5 = false;
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
        
        
        $scope.obtenerPrecio = function() {
                
            
            var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/PreciosBO.php?url=obtenerPreciosFiltro');
                        
            var Params = 'TipoAbono=0' +                
                '&TipoSolicitud=3'  +
                '&Actividad=0' +
                '&TipoTarifa=0';
                
                
            Ajax.open("POST", Url, false);
            Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            Ajax.send(Params); // Enviamos los datos
            //alert(Ajax.responseText);
                  
            $scope.precio = JSON.parse(Ajax.responseText).precios[0].Precio;            
            document.getElementById('amount_1').value = JSON.parse(Ajax.responseText).precios[0].Precio;
            localStorage.setItem('precio', JSON.stringify(JSON.parse(Ajax.responseText)));
        };
        $scope.obtenerPrecio();
    }
			
        app.directive('datepicker', function () {
        return  {
            restrict: 'A',
            require: '?ngModel',
            link: function (scope, element, attrs, ngModel) {
                element = $("#FechaAbonoDiario");
                if (!ngModel)
                {
                    return;
                }
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
                        //console.log('Permitir Compra');
                        return valido;
                    }
                    else {
                        //console.log('No se permite comprar abonos de días pasados');
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
<div class=" row" ng-app="solicitudAbonoDiario">
    <div ng_controller="RegistrarSolicitudAbonoDiarioController">      
        <div id="maininner" class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-sm-offset-1">
            <section id="content"><div id="system-message-container"> </div>
                <div id="system">
                    <div class="tab-content" ng-init="tab1 = true">
                        <h2>Solicitud Abono Diario</h2>
                        <form class="submission box style" name="formulario" action="<?php echo $HOST_PAYPAL_URL ?>" class="standard">
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
                                            <label class="control-label" > Nombre</label><input ng-disabled="disabled" type="text" name="Nombre" ng-model="s.Nombre" class="form-control" required ng-pattern="/[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]/" placeholder="Blanca" ng-maxlength="40"/>
                                            <span style="color:red" ng-show="formulario.Nombre.$dirty && formulario.Nombre.$invalid">
                                                <span ng-show="formulario.Nombre.$error.required">Nombre obligatorio.</span>
                                                <span ng-show="formulario.Nombre.$error.pattern">* Formato de Nombre no valido.</span>
                                                <span ng-show="formulario.Nombre.$error.maxlength">* Nombre demasiado largo</span>
                                            </span>
                                        </div>
                                        <div class="col-md-5 col-sm-5 input-group-lg">
                                            <label class="control-label" > Apellidos </label><input ng-disabled="disabled" type="text" name="Apellidos" ng-model="s.Apellidos" class="form-control" required ng-pattern="/[a-zA-Z]$/" placeholder="Garcia" ng-maxlength="40"/>
                                            <span style="color:red" ng-show="formulario.Apellidos.$dirty && formulario.Apellidos.$invalid">
                                                <span ng-show="formulario.Apellidos.$error.required">Apellidos obligatorio.</span>
                                                <span ng-show="formulario.Apellidos.$error.pattern">* Formato de Apellidos no valido.</span>
                                                <span ng-show="formulario.Apellidos.$error.maxlength">* Apellidos demasiado largo</span>
                                            </span>
                                            <br>
                                        </div>
                                        <br />
                                        <div class="col-md-5 col-sm-5 input-group-lg">
                                            <label class="control-label" >Dni</label><input ng-disabled="disabled" type="text" name="DNI" ng-model="s.DNI" class="form-control" ng-pattern="/^\d{8}[a-zA-Z]$/" placeholder="05330762y" ng-maxlength="9" ng-minlength="9"/>
                                            <span style="color:red" ng-show="formulario.DNI.$dirty && formulario.DNI.$invalid">
                                                <span ng-show="formulario.DNI.$error.pattern">* Formato de DNI no valido.</span>
                                                <span ng-show="formulario.DNI.$error.maxlength">* DNI demasiado largo</span>
                                                <span ng-show="formulario.DNI.$error.minlength">* DNI demasiado corto</span>
                                            </span>
                                        </div>
                                        <div class="col-md-5 col-sm-5 input-group-lg">
                                            <label class="control-label" >E-mail</label><input ng-disabled="disabled" type="email" name="EMail" ng-model="s.EMail" class="form-control" required placeholder="info@developerji.com"/>
                                            <span style="color:red" ng-show="formulario.EMail.$dirty && formulario.EMail.$invalid">
                                                <span ng-show="formulario.EMail.$error.required">Email obligatorio.</span>
                                                <span ng-show="formulario.EMail.$error.email">Formato de email no válido.</span>
                                            </span>
                                            <br>
                                        </div>
                                        <br />                            
                                        <div class="col-md-5 col-sm-5 input-group-lg">
                                            <label class="control-label" >Día de acceso</label>
                                            <input ng-disabled="disabled" type="text" ng-model="s.FechaAbonoDiario" type="text" datepicker class="form-control" name="FechaAbonoDiario" id="FechaAbonoDiario" ng-pattern="/^(0?[1-9]|[12][0-9]|3[01])\-(0?[1-9]|1[012])\-(199\d|[2-9]\d{3})$/" required placeholder="dd-mm-yyyy"/>
                                            <span style="color:red" ng-show="formulario.FechaAbonoDiario.$dirty && formulario.FechaAbonoDiario.$invalid">
                                                <span ng-show="formulario.FechaAbonoDiario.$error.pattern">* Formato de fecha no valido.</span>
                                                <span ng-show="formulario.FechaAbonimoDiario.$error.required">* Fecha obligatoria.</span>
                                                <span ng-show="formulario.FechaAbonoDiario.$error.caducado">* No se pueden comprar abonos caducados</span>
                                            </span>
                                        </div>
                                        <div class="col-md-5 col-sm-5 input-group-lg">
                                            <label  class="control-label" > Importe</label>
                                            <input type="text" ng-model="precio" name="Importe" class="form-control" ng-maxlength="40" readonly/>
                                        </div>
                                        						

                                        <div class="col-md-5 col-sm-5 input-group-lg">
                                            <label ng-show="disabled" class="control-label" > Codigo Localizador</label>
                                            <input ng-model="s.Localizador" ng-show="disabled" ng-disabled="true" type="text" name="Localizador" class="form-control" ng-maxlength="40" value="" readonly/>
                                        </div>

                                        <div class="col-md-6 col-sm-5 input-group-lg">
                                            <label ng-show="disabled" class="control-label" > Código QR</label>
                                            <img ng-show="disabled" style="width:10em; height:10em" name="codigoQR" class="form-control" src="../Negocio/NegocioAdministrador/temp/{{s.Localizador}}.png" />
                                        </div>
                                        <div class="col-md-12 col-sm-12 input-group-lg">
                                            <label ng-show="!disabled" class="control-label">
                                                <input ng-show="!disabled" type="checkbox" name="aceptado" ng-model="aceptado" value="aceptado" required />&nbsp;Acepto los términos y condiciones</label>
                                        </div>
                                    </div>                                                          
                                </fieldset>
                                <ul class="pager">
                                    <li><a class="btn" ng-click="avanzar(1);"ng-disabled="formulario.$invalid" >&nbsp;Siguiente&nbsp;&nbsp;</a></li>
                                </ul>
                            </div>
                            <div class="tab-pane active" ng-show="tab2" id="tab2">
                                <fieldset>
                                    <div class="form-group has-success has-feedback">						
                                        <input name="cmd" type="hidden" value="_cart" /> <!-- comprar varios productos -->
                                        <input name="upload" type="hidden" value="1" /> <!--  -->
                                        <input name="business" type="hidden" value="<?php echo $BUSINESS_PAYPAL ?>" /> <!-- cuenta vendedor -->
                                        <input name="shopping_url" type="hidden" value="<?php echo $SHOP_URL ?>" /> <!-- dirección tienda -->
                                        <input name="currency_code" type="hidden" value="EUR" /> <!-- tipo moneda -->
                                        <input name="return" type="hidden" value="<?php echo $RETURN_PAYPAL_URL ?>"> <!-- pago realizado -->
                                        <input name="cancel_return" type="hidden" value="<?php echo $CANCEL_PAYPAL_URL ?>"> <!-- pago no realizado -->
                                        <input name="notify_url" type="hidden" value="">  <!-- control de pago -->
                                        <input type="hidden" name="no_shipping" value="1"> <!-- no pedir direccion de entrega -->
                                        <input name="rm" type="hidden" value="2"> <!-- numero de productos  -->
                                        <!--AbonoDiario ; Nombre: AbonoDiario ; Valor : 10.05 , Cantidad : 1<br>-->
                                        <input name="item_number_1" type="hidden"> <!-- identificador del producto -->
                                        <input name="item_name_1" type="hidden" value="AbonoDiario">  <!-- nombre del producto -->
                                        <input name="amount_1" id="amount_1" type="hidden">  <!-- precio del producto -->
                                        <input name="quantity_1" type="hidden" value="1">  <!-- cantidad del producto -->
                                    </div>
                                    <input type="image" id="submitBtn" value="Pay with PayPal" src="<?php echo $IMG_PAYPAL ?>">
                                </fieldset>              
                                <ul class="pager">
                                    <li><a class="btn" ng-click="avanzar(0);">&nbsp;Anterior&nbsp;&nbsp;</a></li>
                                </ul>
                            </div>
                        </form>


                        <div>
                            <div class="tab-pane active" id="tab4" ng-show="tab4">
                                    <fieldset>
                                        <div class="form-group has-success has-feedback">
                                            <div class="alert alert-danger" id="divError">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <strong>Error</strong> Se ha producido un error al realizar la operación.
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="tab-pane active" id="tab5" ng-show="tab5">
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
                        </div>
                    </div>
            </section>
        </div>
    </div>
</div>

<?php require_once('PieExterno.php'); ?>