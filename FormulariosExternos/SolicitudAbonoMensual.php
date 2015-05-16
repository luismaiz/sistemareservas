<?php require_once 'CabeceraExterna.php'; ?>
<script>
    var Ajax = new AjaxObj();
    var app = angular.module('solicitudAbonoMensual', []);
    app.controller('RegistrarSolicitudAbonoMensualController', function RegistrarSolicitudAbonoMensualController($scope, $http) {
        $scope.s = {};
        $scope.obtenerProvincia = function (codigoPostal) {
            if (codigoPostal < 52999 && codigoPostal > 01000) {
                var provincia = '';
                var cp = parseInt(codigoPostal / 1000);

                switch (cp) {
                    case 1:
                        provincia = 'Álava';
                        break;

                    case 2:
                        provincia = 'Albacete';
                        break;

                    case 3:
                        provincia = 'Alicante';
                        break;

                    case 4:
                        provincia = 'Almería';
                        break;

                    case 5:
                        provincia = 'Ávila';
                        break;

                    case 6:
                        provincia = 'Badajoz';
                        break;

                    case 7:
                        provincia = 'Islas Baleares';
                        break;

                    case 8:
                        provincia = 'Barcelona';
                        break;

                    case 9:
                        provincia = 'Burgos';
                        break;

                    case 10:
                        provincia = 'Cáceres';
                        break;

                    case 11:
                        provincia = 'Cádiz';
                        break;

                    case 12:
                        provincia = 'Castellón';
                        break;

                    case 13:
                        provincia = 'Ciudad Real';
                        break;

                    case 14:
                        provincia = 'Córdoba';
                        break;

                    case 15:
                        provincia = 'La Coruña';
                        break;

                    case 16:
                        provincia = 'Cuenca';
                        break;

                    case 17:
                        provincia = 'Gerona';
                        break;

                    case 18:
                        provincia = 'Granada';
                        break;

                    case 19:
                        provincia = 'Guadalajara';
                        break;

                    case 20:
                        provincia = 'Guipúzcua';
                        break;

                    case 21:
                        provincia = 'Huelva';
                        break;

                    case 22:
                        provincia = 'Huesca';
                        break;

                    case 23:
                        provincia = 'Jaén';
                        break;

                    case 24:
                        provincia = 'León';
                        break;

                    case 25:
                        provincia = 'Lérida';
                        break;

                    case 26:
                        provincia = 'La Rioja';
                        break;

                    case 27:
                        provincia = 'Lugo';
                        break;

                    case 28:
                        provincia = 'Madrid';
                        break;

                    case 29:
                        provincia = 'Málaga';
                        break;

                    case 30:
                        provincia = 'Murcia';
                        break;

                    case 31:
                        provincia = 'Navarra';
                        break;

                    case 32:
                        provincia = 'Orense';
                        break;

                    case 33:
                        provincia = 'Asturias';
                        break;

                    case 34:
                        provincia = 'Palencia';
                        break;

                    case 35:
                        provincia = 'Las Palmas';
                        break;

                    case 36:
                        provincia = 'Pontevedra';
                        break;

                    case 37:
                        provincia = 'Salamanca';
                        break;

                    case 38:
                        provincia = 'S.C. Tenerife';
                        break;

                    case 39:
                        provincia = 'Cantabria';
                        break;

                    case 40:
                        provincia = 'Segovia';
                        break;

                    case 41:
                        provincia = 'Navarra';
                        break;

                    case 42:
                        provincia = 'Soria';
                        break;

                    case 43:
                        provincia = 'Tarragona';
                        break;

                    case 44:
                        provincia = 'Teruel';
                        break;

                    case 45:
                        provincia = 'Toledo';
                        break;

                    case 46:
                        provincia = 'Valencia';
                        break;

                    case 47:
                        provincia = 'Valladolid';
                        break;

                    case 48:
                        provincia = 'Vizcaya';
                        break;

                    case 49:
                        provincia = 'Zamora';
                        break;

                    case 50:
                        provincia = 'Zaragoza';
                        break;

                    case 51:
                        provincia = 'Ceuta';
                        break;

                    case 52:
                        provincia = 'Melilla';
                        break;
                }
            }

            $scope.s.Provincia = provincia;
        };
        $scope.calcularDiasMes = function (mes, ano) {
            var dias = 0;
            switch (mes) {
                case 1:
                    dias = 31;
                    break;
                case 2:
                    if (ano % 4 === 0) {
                        dias = 29;
                    } else {
                        dias = 28;
                    }
                    break;
                case 3:
                    dias = 31;
                    break;
                case 4:
                    dias = 30;
                    break;
                case 5:
                    dias = 31;
                    break;
                case 6:
                    dias = 30;
                    break;
                case 7:
                    dias = 31;
                    break;
                case 8:
                    dias = 31;
                    break;
                case 9:
                    dias = 30;
                    break;
                case 10:
                    dias = 31;
                    break;
                case 11:
                    dias = 30;
                    break;
                case 12:
                    dias = 31;
                    break;
            }
            return dias;
        };
        $scope.calcularFechaFin = function (fechaInicio) {
            var values = fechaInicio.split("-");
            var dia = parseInt(values[2]);
            var mes = parseInt(values[1]);
            var ano = parseInt(values[0]);

            var diasMes = $scope.calcularDiasMes(mes, ano);
            var fecha = ano + '-' + mes + '-' + diasMes;
            $scope.s.FechaFin = fecha;
            $scope.calcularPrecio($scope.s.FechaInicio, $scope.s.idTipoAbono, $scope.s.idTipoTarifa);
        };
        $scope.calcularPrecio = function (fechaInicio, abono, tarifa) {
            var URL2 = BASE_URL.concat('Sistemareservas/Negocio/NegocioAdministrador/PreciosBO.php?url=obtenerPreciosFiltro');
            var Params = 'TipoSolicitud=2' +
                    '&TipoAbono=' + abono +
                    '&TipoTarifa=' + tarifa;

            Ajax.open("POST", URL2, false);
            Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            Ajax.send(Params); // Enviamos los datos

            if ($scope.estado === 'correcto')
            {
                $scope.precios = JSON.parse(Ajax.responseText).precios;
                localStorage.setItem('precios', JSON.stringify($scope.precios));
                document.getElementById('divSinResultados').style.display = 'none';
            }
            else
            {
                $scope.precios = [];
                document.getElementById('divSinResultados').style.display = 'block';
            }
            var total = $scope.precios[0].Precio;
            var values = fechaInicio.split("-");
            var dia = parseInt(values[2]);
            var mes = parseInt(values[1]);
            var ano = parseInt(values[0]);

            var fin = $scope.calcularDiasMes(mes, ano);
            var precioPago = (total / fin * (fin - dia)).toFixed(2);
            $scope.s.PrecioPagado = precioPago;
        };
        //Obtener Tipo Abonos
        var URL = BASE_URL.concat('Sistemareservas/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTiposAbono');
        $http.get(URL)
                .success(function (response) {

                    $scope.estado = response.estado;

                    if ($scope.estado === 'correcto')
                    {
                        $scope.tiposAbonos = response.tiposAbonos;
                        document.getElementById('divSinResultados').style.display = 'none';
                    }
                    else
                    {
                        $scope.tiposAbonos = [];
                        document.getElementById('divSinResultados').style.display = 'block';
                    }
                });
        //Obtener Tipo Tarifa
        var Url1 = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTiposTarifa');
        //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTiposTarifa";		

        $http.get(Url1)
                .success(function (response) {
                    $scope.estado = response.estado;
                    if ($scope.estado === 'correcto')
                    {
                        $scope.tiposTarifas = response.tiposTarifas;
                        document.getElementById('divSinResultados').style.display = 'none';
                    }
                    else
                    {
                        $scope.tiposTarifas = [];
                        document.getElementById('divSinResultados').style.display = 'block';
                    }
                });
        $scope.avanzar = function (idTab) {
            if (idTab === 0) {
                $scope.tab1 = true;
                $scope.tab2 = false;
                $scope.tab3 = false;
            } else if (idTab === 1) {
                $scope.tab1 = false;
                $scope.tab2 = true;
                $scope.tab3 = false;
            } else if (idTab === 2) {
                $scope.tab1 = false;
                $scope.tab2 = false;
                $scope.tab3 = true;
            }
        };
        $scope.calcularFecha = function (fecha) {
            var values = fecha.split("-");
            var dia = parseInt(values[2]);
            var mes = parseInt(values[1]);
            var ano = parseInt(values[0]);

            // cogemos los valores actuales
            var fecha_hoy = new Date();
            var ahora_ano = fecha_hoy.getYear();
            var ahora_mes = fecha_hoy.getMonth() + 1;
            var ahora_dia = fecha_hoy.getDate();

            // realizamos el calculo
            var edad = (ahora_ano + 1900) - ano;
            if (ahora_mes < mes)
            {
                edad--;
            }
            if ((mes === ahora_mes) && (ahora_dia < dia))
            {
                edad--;
            }
            if (edad > 1900)
            {
                edad -= 1900;
            }
            return edad;
        };
        $scope.esMenor = function () {
            var edad = $scope.calcularFecha($scope.s.FechaNacimiento);
            if (edad < 18) {
                $scope.menor = true;
            } else {
                $scope.menor = false;
            }
        };
        $scope.codigoQR = function (Params) {
            var URL = BASE_URL.concat('Sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=codigoQR');

            Ajax.open("POST", URL, false);
            Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            Ajax.send(Params); // Enviamos los datos
            var response = Ajax.responseText;
            console.log(response);
        };

        $scope.enviar = function (s) {
            var URL = BASE_URL.concat('Sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearSolicitudAbonoMensual');

            var Params = '&idTipoSolicitud=2&';
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
                element = $("#FechaNacimiento");
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
                optionsObj.onSelect = function (dateTxt) {
                    updateModel(dateTxt);
                    if (scope.select) {
                        scope.$apply(function () {
                            scope.select({date: dateTxt});
                        });
                    }
                };
                ngModel.$render = function () {
                    // Use the AngularJS internal 'binding-specific' variable
                    element.datepicker('setDate', ngModel.$viewValue || '');
                };
                element.datepicker(optionsObj);
            }
        };
    });
    app.directive('datepickerabono', function () {
        return  {
            restrict: 'A',
            require: '?ngModel',
            link: function (scope, element, attrs, ngModel) {
                element = $("#FechaInicio");
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
                        } else if (mes > ahora_mes) {
                            valido = true;
                        }
                    } else if (ano > ahora_ano) {
                        valido = true;
                    }
                    var hoy = ahora_ano + '-' + ahora_mes + '-' + ahora_dia;
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
                ngModel.$render = function () {
                    // Use the AngularJS internal 'binding-specific' variable
                    element.datepicker('setDate', ngModel.$viewValue || '');
                };
                element.datepicker(optionsObj);
            }
        };
    });


</script>    
<div class="row" ng-app="solicitudAbonoMensual" ng-controller="RegistrarSolicitudAbonoMensualController">
    <div id="maininner" class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-sm-offset-1" >
        <section id="content">
            <h2>Solicitud Abono Mensual</h2>
            <form class="submission box style" name="formulario" novalidate>
                <div class="alert alert-danger" id="divError" style='display:none;'>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error</strong> Se ha producido un error al realizar la operación.
                </div>
                <div class="alert alert-success" id="divCorrecto" style='display:none;'>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Correcto.</strong>  Operación realizada con éxito.
                </div>
                <div class="tab-content" ng-init="tab1 = true">
                    <div class="tab-pane active" id="tab1" ng-show="tab1">
                        <ol class="breadcrumb">
                            <li class="active">Abono Mensual</li>
                        </ol>
                        <fieldset>
                            <div id="divSinResultados"></div>
                            <div class="form-group has-success has-feedback">
                                <div class="col-md-12 col-sm-12 input-group-lg">
                                    <h3>Elegir un abono y una tarifa a aplicar</h3>
                                    <!--<div ng-init="s.tipoabono = 1"
                                         <p ng-repeat="tipoabono in tiposabonos"><label class="control-label">
                                                <input type="radio" id="tipoabono" name="tipoabono" ng-model="s.tipoabono" ng-value="{{ tipoabono.idTipoAbono}}" required  ng-checked="selection.indexOf(tipoabono.idTipoAbono) > 0" ng-required="value==''">&nbsp; {{ tipoabono.NombreAbono}}</label><br/></p>
                                    </div>-->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group-lg">
                                        <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Tipo Abono</label>
                                        <select  id="filtroTipoAbono" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" ng-model="s.idTipoAbono" >	
                                            <option ng_repeat="tipoabono in tiposAbonos" value="{{tipoabono.idTipoAbono}}">{{tipoabono.NombreAbono}}</option>
                                        </select>
                                        <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Tipo Tarifa</label>
                                        <select  id="filtroTipoTarifa" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" ng-model="s.idTipoTarifa">	
                                            <option ng_repeat="tipotarifa in tiposTarifas" value="{{tipotarifa.idTipoTarifa}}">{{tipotarifa.NombreTarifa}}</option>
                                        </select>
                                        <br>
                                    </div>
                                    <div class="col-md-6 col-sm-6 input-group-lg">
                                        <label class="control-label" >Fecha de Inicio</label><input type="text" datepickerAbono name="FechaInicio" id="FechaInicio" ng-model="s.FechaInicio" class="form-control" id="FechaInicio" ng-pattern="/^(199\d|[2-9]\d{3})\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/" required placeholder="yyyy-mm-dd" ng-change="calcularFechaFin(s.FechaInicio);"/>
                                        <span style="color:red" ng-show="formulario.FechaInicio.$dirty && formulario.FechaInicio.$invalid">
                                            <span ng-show="formulario.FechaInicio.$error.pattern">* Formato de fecha no valido.</span>
                                            <span ng-show="formulario.FechaInicio.$error.required">* Fecha obligatoria.</span>
                                            <span ng-show="formulario.FechaInicio.$error.caducado">* No se pueden comprar abonos caducados</span>
                                        </span>
                                    </div>
                                    <div class="col-md-6 col-sm-6 input-group-lg">
                                        <label class="control-label" >Fecha Fin</label><input type="text" name="FechaFin" ng-model="s.FechaFin" class="form-control" id="FechaFin" placeholder="yyyy-mm-dd" readonly />                                      
                                    </div>
                                    <div class="col-md-6 col-sm-6 input-group-lg">
                                        <label class="control-label" >Precio a Pagar</label><input type="text" name="PrecioPagado" ng-model="s.PrecioPagado" class="form-control" id="FPrecioPagado" ng-value="{{s.PrecioPagado}}" readonly />                                        
                                    </div>
                                    <div class="col-md-12 col-sm-12 input-group-lg">
                                        <label class="control-label">
                                            <input type="checkbox" name="Renovacion" ng-model="s.Renovacion" required />&nbsp;Es una renovación<br></label>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <ul class="pager">
                            <li><a class="btn" ng-click="avanzar(1);">Siguiente &rarr;</a></li>
                        </ul>
                    </div>
                    <div class="tab-pane active" ng-show="tab2" id="2">
                        <ol class="breadcrumb">
                            <li class="active">Abono Mensual</li>
                            <li class="active">Datos Personales</li>
                        </ol>
                        <fieldset>
                            <div class="form-group has-success has-feedback">
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
                                    <br/>
                                </div>     
                                <div class="col-md-5 col-sm-5 input-group-lg">
                                    <label class="control-label" >Dni</label><input type="text" name="DNI" ng-model="s.DNI" class="form-control" required ng-pattern="/^\d{8}[a-zA-Z]$/" placeholder="05330762y" ng-maxlength="9" ng-minlength="9"/>
                                    <span style="color:red" ng-show="formulario.DNI.$dirty && formulario.DNI.$invalid">
                                        <span ng-show="formulario.DNI.$error.required">DNI es obligatorio.</span>
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
                                    <br />
                                </div>                                
                                <div class="col-md-5 col-sm-5 input-group-lg">
                                    <label class="control-label" >Sexo</label><br>
                                    <label class="control-label" ><input type="radio" ng-model="s.Sexo" name="Sexo" value="M" checked id="Sexo" required />&nbsp;Mujer&nbsp;</label>
                                    <label class="control-label" ><input type="radio" ng-model="s.Sexo" name="Sexo" value="H" d id="Sexo"/>&nbsp;Hombre&nbsp;</label>
                                </div>
                                <div class="col-md-5 col-sm-5 input-group-lg">
                                    <label class="control-label" >Fecha nacimiento</label><input type="text" datepicker name="FechaNacimiento" ng-model="s.FechaNacimiento" class="form-control" id="FechaNacimiento" ng-change="esMenor();" ng-pattern="/^(199\d|[2-9]\d{3})\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/" required placeholder="yyyy-mm-dd">
                                    <span style="color:red" ng-show="formulario.FechaNacimiento.$dirty && formulario.FechaNacimiento.$invalid">
                                        <span ng-show="formulario.FechaNacimiento.$error.pattern">* Formato de fecha no valido.</span>
                                        <span ng-show="formulario.FechaNacimiento.$error.required">* Fecha obligatoria.</span>
                                    </span>
                                </div>
                                <div class="col-md-5 col-sm-5 input-group-lg" ng-init="tutor = false">
                                    <label class="control-label" ng-show="menor">Tutor legal</label><input type="text" name="Tutor" ng-model="s.tutor" class="form-control" required name="TutorLegal" placeholder="Alberto Fernandez" id="TutorLegal" ng-show="menor" ng-pattern="/^[a-zA-Z]*$/"/>
                                </div> 
                            </div>
                            <div class="col-md-12 col-sm-12 input-group-lg">
                                <label class="control-label">
                                    <input type="checkbox" name="aceptado" ng-model="aceptado" required />&nbsp;Acepto los términos y condiciones</label>
                            </div>
                        </fieldset>
                        <ul class="pager">
                            <li class="previous"><a ng-click="avanzar(0);">&larr; Anterior</a></li>
                            <li class="btn next"><a ng-click="avanzar(2);" ng-disabled="formulario.$invalid">Siguiente &rarr;</a></li>
                        </ul>
                    </div>
                    <div class="tab-pane active" ng-show="tab3" id="tab3">
                        <ol class="breadcrumb">
                            <li class="active">Abono Mensual</li>
                            <li class="active">Datos Personales</li>
                            <li class="active">Datos Dirección</li>
                        </ol>
                        <fieldset>
                            <div class="col-md-10 col-sm-10 input-group-lg">
                                <label class="control-label" >Direcci&oacute;n&nbsp;</label><input type="text" class="form-control" name="Direccion" ng-model="s.Direccion" required  placeholder="Calle los Emigrantes  16" id="Direccion"  />  
                                <span style="color:red" ng-show="formulario.Direccion.$dirty && formulario.Direccion.$invalid">
                                    <span ng-show="formulario.Direccion.$error.required">* Dirección obligatoria.</span>
                                </span>
                            </div>
                            <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label" >Localidad&nbsp;</label><input type="text" class="form-control" name="Localidad" ng-model="s.Localidad" required  placeholder="Madrid" id="Localidad" ng-pattern="/^[a-zA-Z]*$/"/>
                                <span style="color:red" ng-show="formulario.Localidad.$dirty && formulario.Localidad.$invalid">
                                    <span ng-show="formulario.Localidad.$error.pattern">* Formato de Localidad no valido.</span>
                                    <span ng-show="formulario.Localidad.$error.required">* Localidad obligatoria.</span>
                                </span>
                            </div>
                            <div class="col-md-2 col-sm-2 input-group-lg">
                                <label class="control-label" >Codigo Postal&nbsp;</label><input type="number" class="form-control" name="CP" ng-model="s.CP" min="01000" max="54999" id="CP" placeholder="28040" ng-pattern="/^[0-9]{4,5}/" ng-change="obtenerProvincia(s.CP);" />
                                <span style="color:red" ng-show="formulario.CP.$dirty && formulario.CP.$invalid">
                                    <span ng-show="formulario.CP.$error.pattern">* Formato de CP no valido.</span>
                                    <span ng-show="formulario.CP.$error.required">* CP obligatorio.</span>
                                    <span ng-show="formulario.CP.$error.number">* CP no valido </span>
                                </span>
                            </div>
                            <div class="col-md-3 col-sm-3 input-group-lg">
                                <label class="control-label" >Provincia&nbsp;</label><input type="text" class="form-control" name="Provincia" ng-model="s.Provincia" placeholder="Madrid" ng-value="{{s.Provincia}}" readonly/>
                                <br>
                            </div>
                            <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label" >&nbsp;Telefono 1 &nbsp;</label> <input type="tel" class="form-control" name="Telefono1" ng-model="s.Telefono1" required ng-pattern="/[0-9]{9}/" placeholder="912344567" />
                                <span style="color:red" ng-show="formulario.Telefono1.$dirty && formulario.Telefono1.$invalid">
                                    <span ng-show="formulario.Telefono1.$error.pattern">* Formato de Telefono1 no valido.</span>
                                    <span ng-show="formulario.Telefono1.$error.required">* Telefono1 obligatorio.</span>
                                </span>
                            </div>
                            <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label" >&nbsp; Telefono 2 &nbsp;</label> <input type="tel" class="form-control" name="Telefono2" ng-model="s.Telefono2" ng-pattern="/[0-9]{9}/" Placeholder="600072897" />   
                                <span style="color:red" ng-show="formulario.Telefono2.$dirty && formulario.Telefono2.$invalid">
                                    <span ng-show="formulario.Telefono2.$error.pattern">* Formato de Telefono2 no valido.</span>
                                </span>
                            </div>
                        </fieldset>
                        <ul class="pager">
                            <li class="previous"><a ng-click="avanzar(1);">&larr; Anterior</a></li>
                            <li class="btn next"><a ng-click="enviar(s);" ng-disabled="formulario.$invalid">&nbsp;Enviar&nbsp;&nbsp;</a></li>
                        </ul>
                    </div>
                </div>
            </form>
        </section>
    </div>     
</div>
<?php require_once 'PieExterno.php'; ?>