<?php require "CabeceraExterna.php";?>
<script>
var Ajax = new AjaxObj();
            var app = angular.module('solicitudAbonoMensual',  ['ngStorage'])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
                      
            function RegistrarSolicitudAbonoMensualController($scope, $http,$location,$localStorage) {
		$scope.disabled = false;
                
                $scope.crearSolicitudAbonoMensual = function(s) {
                var URL = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=crearSolicitudAbonoMensual');

                        var Params = 'idTipoSolicitud=2';
			Params += '&Nombre=' + s.Nombre + 
                                '&Sexo=' + s.Sexo + 
                             '&Apellidos='+ s.Apellidos +
                             '&DNI=' + s.DNI +
                             '&EMail=' + s.EMail+
			     '&Direccion=' + s.Direccion +
                             '&Localidad=' + s.Localidad +
                             '&Provincia=' + s.Provincia +
                             '&CP=' + s.CodigoPostal +
                             '&Telefono1=' + s.Telefono1 +
                             '&Telefono2=' + s.Telefono2 +
                             '&TutorLegal=' + s.TutorLegal +
                             '&idTipoAbono=' + s.idTipoAbono +
                             '&idTipoTarifa=' + s.idTipoTarifa+
                             '&FechaInicio=' + s.FechaInicio +
                             '&FechaFin=' + s.FechaFin +
                             '&FechaNacimiento=' + s.FechaNacimiento +
                             '&DescripcionSolicitud=' + s.DescripcionSolicitud+
                             '&Otros=' + s.Otros+
                             '&Renovacion=' + s.Renovacion+
                             '&PrecioPagado=' + s.PrecioPagado;
					
                        
                        Ajax.open("POST", URL, false);
                        Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        Ajax.send(Params); // Enviamos los datos
                        //alert(Ajax.responseText);
                        var response = Ajax.responseText;
                        
						
                        if (JSON.parse(response).estado === 'correcto')
                        {
                            $scope.s.Localizador = JSON.parse(response).solicitud.Localizador;
                            $scope.s.IdSolicitud = JSON.parse(response).solicitud.IdSolicitud;
                            Params += '&Localizador=' + JSON.parse(response).solicitud.Localizador;
                            var URL = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=codigoQR');
                            Ajax.open("POST", URL, false);
                            Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            Ajax.send(Params); // Enviamos los datos
                        }
			};
                        
                $scope.confirmarPago = function(s) {
                var URL = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=confirmarPago');

                        var Params = 'idSolicitud=' + s;
			
                        var Ajax = new AjaxObj();
                        Ajax.open("POST", URL, false);
                        Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        Ajax.send(Params); // Enviamos los datos
                        //alert(Ajax.responseText);
			};        
                        
		if($location.search().url==='pagoRealizado')
		{
                    $scope.s = JSON.parse(localStorage.getItem('solicitudMensual'));
                    //alert($scope.s.IdSolicitud);
                    $scope.confirmarPago($scope.s.IdSolicitud);
                    $scope.disabled = true;
                    $scope.tab1 = false;
                    $scope.tab2 = false;
                    $scope.tab3 = false;
                    $scope.tab4 = false;
                    $scope.tab5 = true;
                };
                
                
                
                $scope.obtenerTipoTarifa = function(){
        
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTiposTarifa');		
                    var Params = '';
                    $scope.selectedtarifa = 1;    
                    Ajax.open("GET", Url, false);
                    Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
                    Ajax.send(Params); // Enviamos los datos
        
                    $scope.tiposTarifas = JSON.parse(Ajax.responseText).tiposTarifas;
                };   
                
                $scope.obtenerTipoAbono = function(idTipoAbono) {
                //alert('1');
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTipoAbono');
                
                var Params = 'idTipoAbono='+ idTipoAbono;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                $scope.tipoabono = JSON.parse(Ajax.responseText).tipoabono;
                };
                
                
                $scope.obtenerTarifasAbono = function(idTipoAbono) {
                //alert('2');
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/PreciosBO.php?url=obtenerPreciosFiltro');
                
                var Params = 'TipoAbono='+ idTipoAbono +                
                '&TipoSolicitud=0'  +
                '&Actividad=0' +
                '&TipoTarifa=0';

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                //alert(Ajax.responseText);
                $scope.tarifas = JSON.parse(Ajax.responseText).precios;
                };
                
                
                
                $scope.obtenerTipoActividad = function(idActividad) {
                //alert('3');
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividad');
                
                var Params = 'idActividad='+ idActividad;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                //alert(Ajax.responseText);
                
                $scope.tipoactividad = JSON.parse(Ajax.responseText).actividad;
                };
                
                
                $scope.obtenerTarifasActividad = function(idActividad) {
                //('4');
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/PreciosBO.php?url=obtenerPreciosFiltro');
                
                var Params = 'Actividad='+ idActividad+
               '&TipoSolicitud=0'  +
                '&TipoAbono=0' +
                '&TipoTarifa=0';

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                //alert(Ajax.responseText);
                $scope.tarifas = JSON.parse(Ajax.responseText).precios;
                };
                
                
                if (typeof($location.search().idTipoAbono) !== "undefined")
                {
                    $scope.tipobusqueda= $location.search().idTipoAbono;
                    $scope.obtenerTipoAbono($location.search().idTipoAbono);
                    $scope.obtenerTarifasAbono($location.search().idTipoAbono);
                }
                
                if (typeof($location.search().idTipoActividad) !== "undefined")
                {
                    $scope.tipobusqueda= $location.search().idTipoActividad;
                    $scope.obtenerTipoActividad($location.search().idTipoActividad);
                    $scope.obtenerTarifasActividad($location.search().idTipoActividad);
                }
                        
                        
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
                        provincia = 'Guipúzcoa';
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
            var dia = parseInt(values[0]);
            var mes = parseInt(values[1]);
            var ano = parseInt(values[2]);

            var diasMes = $scope.calcularDiasMes(mes, ano);
            var fecha = diasMes + '-' + mes + '-' + ano ;
            $scope.s.FechaFin = fecha;
            
            
            $scope.calcularPrecio($scope.s.FechaInicio, $scope.tipobusqueda, document.getElementById("filtroTipoTarifa").value);
        };
            $scope.calcularPrecio = function (fechaInicio, tarifa) 
            {
                if (typeof($location.search().idTipoAbono) !== "undefined")
                {
                     var Params = 'TipoSolicitud=2' +
                    '&TipoAbono=' + $location.search().idTipoAbono +
                    '&TipoTarifa=0' + 
                    '&Actividad=0';
                }
                else
                {
                     var Params = 'TipoSolicitud=2' +
                    '&TipoAbono=0' + 
                    '&TipoTarifa=0' +
                    '&Actividad=' + $location.search().idTipoActividad;                   
                }
                
                
                var URL2 = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/PreciosBO.php?url=obtenerPreciosFiltro');
               
                    

                Ajax.open("POST", URL2, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos

                $scope.precios = JSON.parse(Ajax.responseText).precios;

                var total = $scope.precios[0].Precio;
                var values = fechaInicio.split("-");
                var dia = parseInt(values[0]);
                var mes = parseInt(values[1]);
                var ano = parseInt(values[2]);

                var fin = $scope.calcularDiasMes(mes, ano);
                var precioPago = (total / fin * (fin - dia)).toFixed(2);
                $scope.s.PrecioPagado = precioPago;
                document.getElementById("amount_1").value = precioPago;
        };
           
            $scope.avanzar = function (idTab) {
            if (idTab === 0) {
                $scope.tab1 = true;
                $scope.tab2 = false;
                $scope.tab3 = false;
                $scope.tab4 = false;
            } else if (idTab === 1) {
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
                $scope.s.idTipoAbono=$scope.tipobusqueda;
                $scope.s.idTipoTarifa =document.getElementById("filtroTipoTarifa").value; 
                $scope.crearSolicitudAbonoMensual($scope.s);
                
                localStorage.setItem('solicitudMensual', JSON.stringify($scope.s));
               }
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
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2016",
            yearSuffix: ''
        };
            $.datepicker.setDefaults($.datepicker.regional['es']);
                    }
            app.directive('datepickerabono', function () {
                    return  {
            restrict: 'A',
            require: '?ngModel',
            link: function (scope, element, attrs, ngModel) {
                element = $("#FechaInicio");
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
                    var ahora_dia =parseInt(fecha_hoy.getDate());
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
<div class=" row" ng-app="solicitudAbonoMensual">
    <div ng_controller="RegistrarSolicitudAbonoMensualController">      
        <div id="maininner" class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-sm-offset-1">
            <section id="content"><div id="system-message-container"></div>
                <div id="system">
                    <div class="tab-content" ng-init="tab1 = true">
                    <h2>Solicitud Abono Mensual</h2>
                        <form class="submission box style" name="formulario" action="https://www.sandbox.paypal.com/cgibin/webscr" class="standard">
                            <div class="tab-pane active" ng-show="tab1" id="1">
                                <ol class="breadcrumb">
                            <li class="active">Abono Mensual</li>
                        </ol>
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
                                            <div class="col-md-12 col-sm-12 input-group-lg">
                                    <h3>Elegir un abono y una tarifa a aplicar</h3>
                                    <!--<div ng-init="s.tipoabono = 1"
                                         <p ng-repeat="tipoabono in tiposabonos"><label class="control-label">
                                                <input type="radio" id="tipoabono" name="tipoabono" ng-model="s.tipoabono" ng-value="{{ tipoabono.idTipoAbono}}" required  ng-checked="selection.indexOf(tipoabono.idTipoAbono) > 0" ng-required="value==''">&nbsp; {{ tipoabono.NombreAbono}}</label><br/></p>
                                    </div>-->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 input-group-lg">
                                        <label class="control-label">Tipo Abono</label>
                                        <input type="text" name="TipoAbono" id="filtroTipoAbono" ng-model="tipoabono.NombreAbono" class="form-control" readonly />
<!--                                        <select ng_disabled="false"  id="filtroTipoAbono" class="form-control" name="idTipoAbono" required> 	
                                            <option ng_repeat="tipoabono in tiposAbonos" ng_selected="{{datossolicitud.idTipoAbono}} === null ? {{tipoabono.idTipoAbono}} === {{datossolicitud.idTipoAbono}} : {{tipoabono.idTipoAbono}} === {{datossolicitud.idTipoAbono}}" value="{{tipoabono.idTipoAbono}}">{{tipoabono.NombreAbono}}</option>
                                            <option ng_repeat="tipoabono in tiposAbonos" value="{{tipoabono.idTipoAbono}}">{{tipoabono.NombreAbono}}</option>
                                        </select>-->
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 input-group-lg">
                                        <label class="control-label">Tipo Actividad</label>
                                        <input type="text" name="TipoActividad" id="filtroTipoActividad" ng-model="tipoactividad.NombreActividad" class="form-control" readonly />
<!--                                        <select ng_disabled="false"  id="filtroTipoAbono" class="form-control" name="idTipoAbono" required> 	
                                            <option ng_repeat="tipoabono in tiposAbonos" ng_selected="{{datossolicitud.idTipoAbono}} === null ? {{tipoabono.idTipoAbono}} === {{datossolicitud.idTipoAbono}} : {{tipoabono.idTipoAbono}} === {{datossolicitud.idTipoAbono}}" value="{{tipoabono.idTipoAbono}}">{{tipoabono.NombreAbono}}</option>
                                            <option ng_repeat="tipoabono in tiposAbonos" value="{{tipoabono.idTipoAbono}}">{{tipoabono.NombreAbono}}</option>
                                        </select>-->
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 input-group-lg">
                                        <label class="control-label">Tipo Tarifa</label>
                                        <select  id="filtroTipoTarifa" class="form-control" name="idTipoTarifa" required>	
                                            <option ng_repeat="tarifa in tarifas" value="{{tarifa.idTipoTarifa}}">{{tarifa.NombrePrecio}}</option>
                                            <!--<option ng_repeat="tarifaactividad in tarifasactividad" value="tarifaactividad.idTipoTarifa">{{tarifaactividad.NombreTarifa}}</option>-->
                                        </select>
                                        <br>
                                    </div>
                                    <div ng-hide="formulario.idTipoAbono.$error.required || formulario.idTipoTarifa.$error.required">
                                        <div class="col-md-6 col-sm-6 input-group-lg">
                                            <label class="control-label" >Fecha de Inicio</label><input type="text" datepickerAbono name="FechaInicio" id="FechaInicio" ng-model="s.FechaInicio" class="form-control" id="FechaInicio" ng-pattern="/^(0?[1-9]|[12][0-9]|3[01])\-(0?[1-9]|1[012])\-(199\d|[2-9]\d{3})$/" required placeholder="dd-mm-yyyy" readonly ng-change="calcularFechaFin(s.FechaInicio);"/>
                                            <span style="color:red" ng-show="formulario.FechaInicio.$dirty && formulario.FechaInicio.$invalid">
                                                <span ng-show="formulario.FechaInicio.$error.pattern">* Formato de fecha no valido.</span>
                                                <span ng-show="formulario.FechaInicio.$error.required">* Fecha obligatoria.</span>
                                                <span ng-show="formulario.FechaInicio.$error.caducado">* No se pueden comprar abonos caducados</span>
                                            </span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 input-group-lg">
                                            <label class="control-label" >Fecha Fin</label><input type="text" name="FechaFin" ng-model="s.FechaFin" class="form-control" id="FechaFin" placeholder="dd-mm-yyyy" readonly />                                      
                                        </div>
                                        <div class="col-md-6 col-sm-6 input-group-lg">
                                            <label class="control-label" >Precio a Pagar</label><input type="text" name="PrecioPagado" ng-model="s.PrecioPagado" class="form-control" id="PrecioPagado" ng-value="{{s.PrecioPagado}}" readonly />                                        
                                        <br>
                                        </div>
                                        <div class="col-md-12 col-sm-12 input-group-lg">
                                            <label class="control-label">
                                                <input type="checkbox" name="Renovacion" ng-model="s.Renovacion" ng-value="1"/>&nbsp;Es una renovación<br></label>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                    </div>
                        </fieldset>
                        <ul class="pager">
                            <li><a class="btn" ng-click="avanzar(1);" ng-disabled="formulario.FechaInicio.$invalid">Siguiente &rarr;</a></li>
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
                                    <label class="control-label" ><input type="radio" ng-model="s.Sexo" name="Sexo" value="M" checked id="Sexo" required />&nbsp;Mujer&nbsp;</label>
                                    <label class="control-label" ><input type="radio" ng-model="s.Sexo" name="Sexo" value="H" d id="Sexo"/>&nbsp;Hombre&nbsp;</label>
                                </div>
                                <div class="col-md-5 col-sm-5 input-group-lg">
                                    <label class="control-label" >Fecha nacimiento</label><input type="text" datepicker name="FechaNacimiento" ng-model="s.FechaNacimiento" class="form-control" id="FechaNacimiento" ng-change="esMenor();" ng-pattern="/^\d{2}-\d{2}-\d{4}$/" required placeholder="dd-mm-yyyy">
                                    <span style="color:red" ng-show="formulario.FechaNacimiento.$dirty && formulario.FechaNacimiento.$invalid">
                                        <span ng-show="formulario.FechaNacimiento.$error.pattern">* Formato de fecha no valido.</span>
                                        <span ng-show="formulario.FechaNacimiento.$error.required">* Fecha obligatoria.</span>
                                    </span>
                                </div>
                                <div class="col-md-5 col-sm-5 input-group-lg" ng-init="tutor = false">
                                    <label class="control-label" ng-show="menor">Tutor legal</label><input type="text" ng-model="s.TutorLegal" class="form-control" name="TutorLegal" placeholder="Alberto Fernandez" id="TutorLegal" ng-show="menor" ng-pattern="/[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]$/"/>
                                </div> 
                                <div class="col-md-12 col-sm-12 input-group-lg">
                                <label class="control-label">
                                    <input type="checkbox" name="aceptado" ng-model="aceptado" required />&nbsp;Acepto los términos y condiciones</label>
                                </div>
                            </div>
                        </fieldset>
                        <ul class="pager">
                            <li class="previous"><a ng-click="avanzar(0);">&larr; Anterior</a></li>
                            <li class="next"><a class="btn" ng-click="avanzar(2);" ng-disabled="formulario.Nombre.$error.required || formulario.Apellidos.$error.required || formulario.DNI.$error.required
                                    || formulario.EMail.$error.required || formulario.FechaNacimiento.$error.required || formulario.aceptado.$error.required">Siguiente &rarr;</a></li>
                        </ul>
                    </div>
                    <div class="tab-pane active" ng-show="tab3" id="tab3">
                        <ol class="breadcrumb">
                            <li class="active">Abono Mensual</li>
                            <li class="active">Datos Personales</li>
                            <li class="active">Datos Dirección</li>
                        </ol>
                        <fieldset>
                            <div class="form-group has-success has-feedback">
                            <div class="col-md-10 col-sm-10 input-group-lg">
                                <label class="control-label" >Direcci&oacute;n&nbsp;</label><input type="text" class="form-control" name="Direccion" ng-model="s.Direccion" required  placeholder="Calle los Emigrantes  16" id="Direccion"  />  
                                <span style="color:red" ng-show="formulario.Direccion.$dirty && formulario.Direccion.$invalid">
                                    <span ng-show="formulario.Direccion.$error.required">* Dirección obligatoria.</span>
                                </span>
                            </div>
                            <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label" >Localidad&nbsp;</label><input type="text" class="form-control" name="Localidad" ng-model="s.Localidad" required  placeholder="Madrid" id="Localidad" ng-pattern="/[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]$/"/>
                                <span style="color:red" ng-show="formulario.Localidad.$dirty && formulario.Localidad.$invalid">
                                    <span ng-show="formulario.Localidad.$error.pattern">* Formato de Localidad no valido.</span>
                                    <span ng-show="formulario.Localidad.$error.required">* Localidad obligatoria.</span>
                                </span>
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
                                <label class="control-label" >Provincia&nbsp;</label><input type="text" class="form-control" name="Provincia" ng-model="s.Provincia" placeholder="Madrid" ng-value="{{s.Provincia}}" readonly/>
                                <br>
                            </div>
                            <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label" >&nbsp;Telefono 1 &nbsp;</label> <input type="tel" class="form-control" name="Telefono1" ng-model="s.Telefono1" required ng-pattern="/[0-9]{9}/" placeholder="912344567" maxlength="9" />
                                <span style="color:red" ng-show="formulario.Telefono1.$dirty && formulario.Telefono1.$invalid">
                                    <span ng-show="formulario.Telefono1.$error.pattern">* Formato de Telefono1 no valido.</span>
                                    <span ng-show="formulario.Telefono1.$error.required">* Telefono1 obligatorio.</span>
                                </span>
                            </div>
                            <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label" >&nbsp; Telefono 2 &nbsp;</label> <input type="tel" class="form-control" name="Telefono2" ng-model="s.Telefono2" ng-pattern="/[0-9]{9}/" Placeholder="600072897" maxlength="9" />   
                                <span style="color:red" ng-show="formulario.Telefono2.$dirty && formulario.Telefono2.$invalid">
                                    <span ng-show="formulario.Telefono2.$error.pattern">* Formato de Telefono2 no valido.</span>
                                    <span ng-show="formulario.Telefono2.$error.required">* Telefono2 obligatorio.</span>
                                </span>
                            </div>
                            </div>
                        </fieldset>
                        <ul class="pager">
                            <li class="previous"><a ng-click="avanzar(2);">&larr; Anterior</a></li>
                            <li class="next"><a class="btn" ng-click="avanzar(3);" ng-disabled="formulario.Direccion.$error.required || formulario.Localidad.$error.required || formulario.Provincia.$error.required || formulario.CP.$error.required
                                    || formulario.Telefono1.$error.required || formulario.Telefono2.$error.required">Siguiente&nbsp;&nbsp;</a></li>
                        </ul>
                    </div>
                    <div class="tab-pane active" ng-show="tab4" id="4">
                        <fieldset>
                                    <div class="form-group has-success has-feedback">						
                                        <input name="cmd" type="hidden" value="_cart" /> <!-- comprar varios productos -->
                                        <input name="upload" type="hidden" value="1" /> <!--  -->
                                        <input name="business" type="hidden" value="<?php echo $BUSINESS_PAYPAL ?>" /> <!-- cuenta vendedor -->
                                        <input name="shopping_url" type="hidden" value="<?php echo $SHOP_URL ?>" /> <!-- dirección tienda -->
                                        <input name="currency_code" type="hidden" value="EUR" /> <!-- tipo moneda -->
                                        <input name="return" type="hidden" value="<?php echo $RETURN_PAYPAL_MENSUAL_URL ?>"> <!-- pago realizado -->
                                        <input name="cancel_return" type="hidden" value="<?php echo $CANCEL_PAYPAL_MENSUAL_URL ?>"> <!-- pago no realizado -->
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
                            <li><a class="btn" ng-click="avanzar(2);">&nbsp;Anterior&nbsp;&nbsp;</a></li>
                        </ul>
                    </div>   
               </form>   
               <div class="tab-pane active" id="tab5" ng-show="tab5">
                    <fieldset>
                        <div class="form-group has-success has-feedback">
                           <div class="alert alert-success" id="divCorrecto">
                                   <button type="button" class="close" data-dismiss="alert">&times;</button>
                                   <strong>Correcto.</strong>  Operación realizada con éxito.
                           </div>
                           <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label" > Nombre</label>
                                <input type="text" name="Nombre" class="form-control" ng-maxlength="40" ng-model="s.Nombre" readonly/>
                           </div>
                           <div class="col-md-5 col-sm-5 input-group-lg">
                               <label class="control-label" > Apellidos </label>
                               <input type="text" name="Apellidos" class="form-control" ng-maxlength="40" ng-model="s.Apellidos" readonly/>
                            </div>
                            <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label" >Dni</label>
                                <input type="text" name="DNI" class="form-control" ng-maxlength="9" ng-minlength="9" ng-model="s.DNI" readonly/>
                            </div>
                            <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label" >E-mail</label>
                                <input type="email" name="EMail" class="form-control" ng-model="s.EMail" readonly/>
                            </div>
                            <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label" >Día de acceso</label>
                                <input type="text" type="text" datepicker class="form-control" name="FechaAbonoMensual" id="FechaAbonoMensual" ng-model="s.FechaAbonoMensual" readonly/>
                            </div>
                            <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label" > Codigo Localizador</label>
                                <input type="text" name="Localizador" class="form-control" ng-maxlength="40" ng-model="s.Localizador" readonly/>
                            </div>
                            <div class="col-md-6 col-sm-5 input-group-lg">
                                <label class="control-label" > Código QR</label><img style="width:10em; height:10em" name="codigoQR" class="form-control" src="../Negocio/NegocioAdministrador/temp/{{s.Localizador}}.png" />
                            </div>
                         </div>
                     </fieldset>                                           
                </div>
                                        <div class="tab-pane active" id="tab6" ng-show="tab6">
                                            <fieldset>
                                                <div class="form-group has-success has-feedback">
                                                    <div class="alert alert-danger" id="divError">
                                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                        <strong>Error</strong> Se ha producido un error al realizar la operación.
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                       <div class="tab-pane active" id="tab7" ng-show="tab7">
                                        <fieldset>
                                            <div class="form-group has-success has-feedback">
                                                <div class="alert alert-warning" id="divWarning">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    <strong>Correcto.</strong>  Operación cancelada.
                                                </div>
                                            </div>
                                        </fieldset>                          
                                        </div>
                                                
                </div>
                </div>
                 </section>
    
</div>
                    </div>
                    </div>
                                
<?php require_once('PieExterno.php');?>