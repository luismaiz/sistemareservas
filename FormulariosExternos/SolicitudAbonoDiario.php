<?php require_once 'CabeceraExterna.php'; ?>
<script>
    var Ajax = new AjaxObj();
    var app = angular.module('solicitudAbonoDiario', []);
    app.controller('RegistrarSolicitudAbonoDiarioController', function RegistrarSolicitudAbonoDiarioController($scope) {
        $scope.codigoQR = function (Params) {
            var URL = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=codigoQR');

            Ajax.open("POST", URL, false);
            Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            Ajax.send(Params); // Enviamos los datos
            var response = Ajax.responseText;
            console.log(response);
        };

        $scope.enviar = function (s) {
            var URL = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearSolicitud');

            var Params = '&idTipoSolicitud=3&';
            Params += jQuery.param(s);
            Ajax.open("POST", URL, false);
            Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            Ajax.send(Params); // Enviamos los datos
            var response = Ajax.responseText;
            console.log(response);
            $scope.estado = JSON.parse(response).estado;
            console.log($scope.estado);
            if ($scope.estado === 'correcto')
            {
                document.getElementById('divCorrecto').style.display = 'block';
            }
            else
            {
                document.getElementById('divError').style.display = 'block';
            }
            $scope.solicitud = JSON.parse(response).solicitud;
            console.log($scope.solicitud);
            Params += '&Localizador=' + $scope.solicitud.Localizador;
            console.log(Params);
            $scope.codigoQR(Params);
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
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2012",
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
                optionsObj.dateFormat = 'yy-mm-dd';
                var updateModel = function (dateTxt) {
                    scope.$apply(function () {
                        // Call the internal AngularJS helper to
                        // update the two-way binding
                        ngModel.$setViewValue(dateTxt);
                    });
                };
                var comprobarCaducidad = function (fecha) {
                    var values = fecha.split("-");
                    var dia = parseInt(values[2]);
                    var mes = parseInt(values[1]);
                    var ano = parseInt(values[0]);
                    // cogemos los valores actuales
                    var fecha_hoy = new Date();
                    var ahora_ano = (fecha_hoy.getYear()) + 1900;
                    var ahora_mes = parseInt((((fecha_hoy.getMonth()) + 1) < 10) ? '0' + ((fecha_hoy.getMonth()) + 1) : (fecha_hoy.getMonth()) + 1);
                    var ahora_dia = parseInt((((fecha_hoy.getDay()) + 10) < 10) ? '0' + ((fecha_hoy.getDay()) + 10) : ((fecha_hoy.getDay()) + 10));
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
                <form class="submission box style" name="formulario" novalidate>
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
                                <label class="control-label" > Nombre</label><input type="text" name="Nombre" ng-model="s.Nombre" class="form-control" required ng-pattern="/[a-zA-Z]$/" placeholder="Blanca" ng-maxlength="40"/>
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
                            <!--
                            <div class="col-md-3 col-sm-3 input-group-lg">
                                <label class="control-label">Escribe el número que ves:</label>
                                <input type="text" name="captcha" ng-model="captcha" class="form-control" id="txtCaptcha" style=" text-align:center; border:none; font-weight: bold; font-family:Modern"  />
                            </div>
                            <div class="col-md-2 col-sm-2 input-group-lg">
                                <label class="control-label">&nbsp;</label>
                                <input type="button" class="form-control" id="btnrefresh" value="Refresh" onclick="DrawCaptcha();" />
                            </div>
                            <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label">&nbsp;</label>
                                <input type="text" name="recaptcha" ng-model="recaptcha" class="form-control" id="resCaptcha" required ng-change="validarCaptcha(captcha, recaptcha);"><br />
                                <span style="color:red" ng-show="formulario.recaptcha.$dirty && formulario.recaptcha.$invalid">
                                    <span ng-show="formulario.recaptcha.$error.required">Captcha No es correcto.</span>
                                </span>
                            </div>-->
                            <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label" >Día de acceso</label>
                                <input type="text" ng-model="s.FechaAbonoDiario" type="text" datepicker class="form-control" name="FechaAbonoDiario" id="FechaAbonoDiario" readonly ng-pattern="/^(199\d|[2-9]\d{3})\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/" required placeholder="yyyy-mm-dd">
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
                        <li><a class="btn" ng-click="enviar(s);" ng-disabled="formulario.$invalid">&nbsp;Enviar&nbsp;&nbsp;</a></li>
                    </ul>
                </form>
            </div>
        </section>
    </div>
</div>
<?php require_once 'PieExterno.php'; ?>
