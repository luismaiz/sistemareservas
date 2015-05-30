<?php require_once 'CabeceraExterna.php'; ?>
<script>
    var Ajax = new AjaxObj();
    var app = angular.module('SolicitudClasesDirigidas', [])            
    .config(function($locationProvider) {
        $locationProvider.html5Mode(true);
    });
    
    function CargaActividades($scope, $http, $location) {
        $scope.actividades = [];
        $scope.s = {};   
        $scope.abonomensual = [];
        $scope.estado = [];
        $scope.msg = [];
        $scope.selection=[];
        
        $scope.obtenerActividades = function() {
            var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividades');
            //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividadesFiltro";
            var Params = '';
                
            Ajax.open("GET", Url, false);
            Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            Ajax.send(Params); // Enviamos los datos
                                       
            $scope.estado = JSON.parse(Ajax.responseText).estado;
            
            
            if ($scope.estado === 'correcto')
            {
                $scope.actividades = JSON.parse(Ajax.responseText).actividades;    
                document.getElementById('divSinResultados').style.display = 'none';
            }
            else
            {
                $scope.actividades = [];
                document.getElementById('divSinResultados').style.display = 'block';
            }
                
        };
            
        $scope.obtenerActividades();
        
        $scope.avanzar = function (idTab) {            
            if (idTab === 0) {
                $scope.tab1 = true;
                $scope.tab2 = false;
                $scope.tab3 = false;
                $scope.tab4 = false;
            }
            else if (idTab === 1) {
                $scope.tab1 = false;
                $scope.tab2 = true;
                $scope.tab3 = false;
                $scope.tab4 = false;
            } else if (idTab === 2) {
                $scope.tab1 = false;
                $scope.tab2 = false;
                $scope.tab3 = true;
                $scope.tab4 = false;

            } else if (idTab === 3) {
                $scope.tab1 = false;
                $scope.tab2 = false;
                $scope.tab3 = false;
                $scope.tab4 = true;
            }
        };
        $scope.toggleSelection = function (idActividad) {

            var idx = $scope.selection.indexOf(idActividad);

            // is currently selected
            if (idx > -1) {
                $scope.selection.splice(idx, 1);
            }
            // is newly selected
            else {
                $scope.selection.push(idActividad);
            }
        };
        
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
        $scope.calcularFecha = function (fecha) {
            var values = fecha.split("-");
            var dia = parseInt(values[0]);
            var mes = parseInt(values[1]);
            var ano = parseInt(values[2]);

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
            var URL = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministradorAdministradorBO.php?url=codigoQR');

            Ajax.open("POST", URL, false);
            Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            Ajax.send(Params); // Enviamos los datos
            var response = Ajax.responseText;
            console.log(response);
        };
        $scope.enviar = function (s) {
            
            var URL = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearSolicitudClaseDirigida');

            var Params = '&idTipoSolicitud=1&';            
            Params += jQuery.param(s);
            Params += '&Actividad=' + $scope.selection;
            Ajax.open("POST", URL, false);
            Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            Ajax.send(Params); // Enviamos los datos
			var response = Ajax.responseText;
            console.log(response);
            $scope.estado = JSON.parse(response).estado;
            console.log($scope.estado);
            if ($scope.estado === 'correcto')
            {
			alert('correcto');
                document.getElementById('divCorrecto').style.display = 'block';
            }
            else
            {
			alert('error');
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
            dateFormat: 'dd-mm-yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2020",
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
    }
    
    app.directive('datepicker', function () {
        return  {
            restrict: 'A',
            require: '?ngModel',
            link: function (scope, element, attrs, ngModel) {
                element = $("#FechaNacimiento");
                if (!ngModel)
                    return;
                var optionsObj = {};
                optionsObj.dateFormat = 'dd-mm-yy';
				optionsObj.maxDate = 0;
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
</script> 
<div class=" row" ng-app="SolicitudClasesDirigidas">
    <div ng_controller="CargaActividades">
        <div id="maininner" class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-sm-offset-1">
            <section id="content"><div id="system-message-container">
                </div>
                <div id="system">
                    <h2>Solicitud Clase Dirigida</h2>
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
                                    <li class="active">Clases Dirigidas</li>
                                </ol>
                                <fieldset>
                                    <div class="form-group has-success has-feedback">
                                        <div class="col-md-12 col-sm-12 input-group-lg">
                                            <h3>Actividades</h3>
                                            <div id="divSinResultados">
                                            </div>                            
                                            <div id="checkbox">
                                                <label ng_repeat="actividad in actividades" class="control-label col-md-4 col-sm-4 col-xs-4">
                                                    <div id="ck-button">
                                                <input type="checkbox" ng-checked="selection.indexOf(actividad.idActividad)>-1" ng-click="toggleSelection(actividad.idActividad)" checklist-model="actividades" checklist-value="actividad" style="display:none"><span>{{actividad.NombreActividad}}</span>
                                                    </div>
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <ul class="pager">
                                    <li class="btn next"><a ng-click="avanzar(1);" >Siguiente &rarr;</a></li>
                                </ul>
                            </div>
                            <div class="tab-pane active" id="tab2" ng-show="tab2">
                                <ol class="breadcrumb">
                                    <li class="active">Clases Dirigidas</li>
                                    <li class="active">Datos Personales</li>
                                </ol>
                                <fieldset>
                                    <div class="form-group has-success has-feedback">
                                        <div class="form-group has-success has-feedback">
                                            <div class="col-md-5 col-sm-5 input-group-lg">
                                                <label class="control-label" > Nombre</label><input type="text" name="Nombre" ng-model="s.Nombre" class="form-control" required ng-pattern="/[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]$/" placeholder="Blanca" ng-maxlength="40"/>
                                                <span style="color:red" ng-show="formulario.Nombre.$dirty && formulario.Nombre.$invalid">
                                                    <span ng-show="formulario.Nombre.$error.required">Nombre obligatorio.</span>
                                                    <span ng-show="formulario.Nombre.$error.pattern">* Formato de Nombre no valido.</span>
                                                    <span ng-show="formulario.Nombre.$error.maxlength">* Nombre demasiado largo</span>
                                                </span>
                                            </div>
                                            <div class="col-md-5 col-sm-5 input-group-lg">
                                                <label class="control-label" > Apellidos </label><input type="text" name="Apellidos" ng-model="s.Apellidos" class="form-control" required ng-pattern="/[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]$/" placeholder="Garcia" ng-maxlength="40"/>
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
                                            <div class="col-md-5 col-sm-5 input-group-lg" ng-init="s.Sexo = 'M'">
                                                <label class="control-label" >Sexo</label><br>
                                                <label class="control-label" ><input type="radio" ng-model="s.Sexo" name="Sexo" value="M" id="Sexo" />&nbsp;Mujer&nbsp;</label>
                                                <label class="control-label" ><input type="radio" ng-model="s.Sexo" name="Sexo" value="H" id="Sexo"/>&nbsp;Hombre&nbsp;</label>
                                            </div>
                                            <div class="col-md-5 col-sm-5 input-group-lg">
                                                <label class="control-label" >Fecha nacimiento</label><input type="text" name="FechaNacimiento" ng-model="s.FechaNacimiento" datepicker class="form-control" id="FechaNacimiento" ng-change="esMenor(s.FechaNacimiento);" ng-pattern="/^\d{2}-\d{2}-\d{4}$/" required placeholder="dd-mm-yyyy">
                                                <span style="color:red" ng-show="formulario.FechaNacimiento.$dirty && formulario.FechaNacimiento.$invalid">
                                                    <span ng-show="formulario.FechaNacimiento.$error.pattern">* Formato de fecha no valido.</span>
                                                    <span ng-show="formulario.FechaNacimiento.$error.required">* Fecha obligatoria.</span>
                                                </span>
                                            </div>
                                            <div class="col-md-5 col-sm-5 input-group-lg" ng-init="tutor = false">
                                                <label class="control-label" ng-show="menor">Tutor legal</label><input type="text" ng-model="s.TutorLegal" class="form-control" name="TutorLegal" placeholder="Alberto Fernandez" id="TutorLegal" ng-show="menor" ng-pattern="/[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]$/"/>
                                            </div> 
                                        </div>
                                        <div class="col-md-12 col-sm-12 input-group-lg">
                                            <label class="control-label">
                                                <input type="checkbox" name="aceptado" ng-model="aceptado" required />&nbsp;Acepto los términos y condiciones</label>
                                        </div>
                                    </div>
                                </fieldset>
                            <ul class="pager">
                                <li class="previous"><a href="" ng-click="avanzar(0);">&larr; Anterior</a></li>
                                <li class="next"><a class="btn" ng-disabled="formulario.Nombre.$error.required || formulario.Apellidos.$error.required || formulario.DNI.$error.required
                                    || formulario.EMail.$error.required || formulario.FechaNacimiento.$error.required || formulario.aceptado.$error.required" ng-click="avanzar(2);">Siguiente &rarr;</a></li>
                            </ul>
                            </div>
                            <div class="tab-pane active" id="tab3" ng-show="tab3">
                                <ol class="breadcrumb">
                                    <li class="active">Clases Dirigidas</li>
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
                                        <label class="control-label" >Localidad &nbsp;</label><input type="text" class="form-control" name="Localidad" ng-model="s.Localidad" required ng-pattern="/[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]$/" placeholder="Madrid" id="Localidad"/>
                                    </div>
                                    <div class="col-md-2 col-sm-2 input-group-lg">
                                        <label class="control-label" >Codigo Postal&nbsp;</label><input type="number" class="form-control" name="CP" ng-model="s.CP" min="01000" max="54999" id="CP" placeholder="28040" ng-pattern="/^[0-9]{4,5}/" ng-change="obtenerProvincia(s.CP);" />
                                        <span style="color:red" ng-show="formulario.CP.$dirty && formulario.CP.$invalid">
                                            <span ng-show="formulario.CP.$error.pattern">* CP no valido.</span>
                                            <span ng-show="formulario.CP.$error.required">* CP obligatorio.</span>
                                            <span ng-show="formulario.CP.$error.number">* CP no valido </span>
                                        </span>
                                    </div>
                                    <div class="col-md-3 col-sm-3 input-group-lg">
                                        <label class="control-label" >Provincia&nbsp;</label><input type="text" class="form-control" name="Provincia" ng-model="s.Provincia" required  placeholder="Madrid" id="Provincia" readonly/>
                                        <br>
                                    </div>
                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                        <label class="control-label" >&nbsp;Telefono 1 &nbsp;</label> <input type="tel" class="form-control" name="Telefono1" ng-model="s.Telefono1" required ng-pattern="/[0-9]{9}/" placeholder="912344567" maxlength="9"/>
                                        <span style="color:red" ng-show="formulario.Telefono1.$dirty && formulario.Telefono1.$invalid">
                                            <span ng-show="formulario.Telefono1.$error.pattern">* Formato de Telefono1 no valido.</span>
                                            <span ng-show="formulario.Telefono1.$error.required">* Telefono1 obligatorio.</span>
                                        </span>
                                    </div>
                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                        <label class="control-label" >&nbsp; Telefono 2 &nbsp;</label> <input type="tel" class="form-control" name="Telefono2" ng-model="s.Telefono2" ng-pattern="/[0-9]{9}/" Placeholder="600072897" maxlength="9" /> 
                                        <span style="color:red" ng-show="formulario.Telefono2.$dirty && formulario.Telefono2.$invalid">
                                            <span ng-show="formulario.Telefono2.$error.pattern">* Formato de Telefono2 no valido.</span>
                                        </span>
                                    </div>
                                </fieldset>
                            <ul class="pager">
                                <li class="previous"><a href="" ng-click="avanzar(1);">&larr; Anterior</a></li>
                                <li class="next"><a class="btn" ng-disabled="formulario.Direccion.$error.required || formulario.Localidad.$error.required || formulario.CP.$error.required
                                    || formulario.Telefono1.$error.required" ng-click="avanzar(3);">Siguiente &rarr;</a></li>
                            </ul>
                            </div>
                            <div class="tab-pane active" id="tab4" ng-show="tab4">
                                <ol class="breadcrumb">
                                    <li class="active">Clases Dirigidas</li>
                                    <li class="active">Datos Personales</li>
                                    <li class="active">Datos Dirección</li>
                                    <li class="active">Datos Bancarios</li>
                                </ol>
                                <fieldset>
                                    <div class="col-md-12 col-sm-12 input-group-lg">
                                        <label class="control-label" >Titular</label>
                                        <input type="text" class="form-control" required ng-pattern="/[a-zA-Z]$/" name="Titular" ng-model="s.Titular" placeholder="Juan Gomez"/>
                                        <span style="color:red" ng-show="formulario.Titular.$dirty && formulario.Titular.$invalid">
                                            <span ng-show="formulario.Titular.$error.required">Titular obligatorio.</span>
                                            <span ng-show="formulario.Titular.$error.pattern">* Formato de Nombre Titular no valido.</span>
                                            <span ng-show="formulario.Titular.$error.maxlength">* Titular demasiado largo</span>
                                        </span>
                                    </div>
                                    <div class="col-md-2 col-sm-2 input-group-lg">
                                        <label class="control-label" >&nbsp;IBAN</label>
                                        <input type="text" class="form-control" required ng-pattern="/^[a-zA-Z0-9]{4}$/" name="IBAN" ng-model="s.IBAN" maxlength="4" placeholder="ES00"/>
                                        <span style="color:red" ng-show="formulario.IBAN.$dirty && formulario.IBAN.$invalid">
                                            <span ng-show="formulario.IBAN.$error.pattern">* Formato de IBAN no valido.</span>
                                            <span ng-show="formulario.IBAN.$error.required">* IBAN obligatorio.</span>
                                        </span>
                                    </div>
                                    <div class="col-md-2 col-sm-2 input-group-lg">
                                        <label class="control-label" >Entidad</label>
                                        <input type="text" class="form-control" required ng-pattern="/^[0-9]{4}$/" name="Entidad" ng-model="s.Entidad" maxlength="4" placeholder="4578"/>
                                        <span style="color:red" ng-show="formulario.Entidad.$dirty && formulario.Entidad.$invalid">
                                            <span ng-show="formulario.Entidad.$error.pattern">* Formato de Entidad no valido.</span>
                                            <span ng-show="formulario.Entidad.$error.required">* Entidad obligatorio.</span>
                                        </span>
                                    </div>
                                    <div class="col-md-2 col-sm-2 input-group-lg">
                                        <label class="control-label" >Oficina</label>
                                        <input type="text" class="form-control" required ng-pattern="/^[0-9]{4}$/" name="Oficina" ng-model="s.Oficina" maxlength="4" placeholder="4348"/>
                                        <span style="color:red" ng-show="formulario.Oficina.$dirty && formulario.Oficina.$invalid">
                                            <span ng-show="formulario.Oficina.$error.pattern">* Formato de Oficina no valido.</span>
                                            <span ng-show="formulario.Oficina.$error.required">* Oficina obligatorio.</span>
                                        </span>
                                    </div>

                                    <div class="col-md-2 col-sm-2 input-group-lg">
                                        <label class="control-label" >&nbsp;DC</label>
                                        <input type="text" class="form-control" required ng-pattern="/^[0-9]{2}$/" name="DigitoControl" ng-model="s.DigitoControl" maxlength="2" placeholder="23"/>
                                        <span style="color:red" ng-show="formulario.DigitoControl.$dirty && formulario.DigitoControl.$invalid">
                                            <span ng-show="formulario.DigitoControl.$error.pattern">* Formato de DigitoControl no valido.</span>
                                            <span ng-show="formulario.DigitoControl.$error.required">* DigitoControl obligatorio.</span>
                                        </span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 input-group-lg">
                                        <label class="control-label" >CTA/Libreta</label>
                                        <input type="text" class="form-control" required ng-pattern="/^[0-9]{10}$/" name="Cuenta" ng-model="s.Cuenta" maxlength="10" placeholder="4578784596"/>
                                        <span style="color:red" ng-show="formulario.Cuenta.$dirty && formulario.Cuenta.$invalid">
                                            <span ng-show="formulario.Cuenta.$error.pattern">* Formato de Cuenta no valido.</span>
                                            <span ng-show="formulario.Cuenta.$error.required">* Cuenta obligatorio.</span>
                                        </span>
                                    </div>
                                </fieldset>
                                <ul class="pager">
                                    <li class="previous"><a href="" ng-click="avanzar(2);">&larr; Anterior</a></li>
                                    <li class="next"><a class="btn" ng-disabled="formulario.$invalid" ng-click="enviar(s);">&nbsp;Enviar&nbsp;&nbsp;</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
<?php require_once 'PieExterno.php'; ?>

