<?php require('Cabecera.php'); ?> 
<script>
           
            var Ajax = new AjaxObj();
            var app = angular.module('DetalleSolicitudClasesDirigidas', [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
                
            function CargaSolicitudClasesDirigidas($scope, $http, $location) {
       
            $scope.abonomensual = [];
            $scope.estado = [];
            $scope.msg = [];
            $scope.selection=[];
            $scope.obtenerSolicitudClasesDirigidas = function(idSolicitud) {
                
               var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerSolicitudClasesDirigidas');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSala";
                var Params = 'idSolicitud='+ idSolicitud;

                
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                //alert(Ajax.responseText);
                
                $scope.clasesdirigidas = JSON.parse(Ajax.responseText).clasesdirigidas;
                $scope.datosbancarios = JSON.parse(Ajax.responseText).datosbancarios;
                $scope.actividadesseleccionadas = JSON.parse(Ajax.responseText).actividades;
                
                for (var i=0; i< $scope.actividadesseleccionadas.length; i++) {
                    var actividad = $scope.actividadesseleccionadas[i].idActividad;
                    $scope.selection.push($scope.actividadesseleccionadas[i].idActividad);
                    //alert($scope.selection.indexOf($scope.actividadesseleccionadas[i].idActividad));
                }
                
                if ($scope.clasesdirigidas.Gestionado=== '0')
                {
                    document.getElementById('divPendiente').style.display = 'block';
                    document.getElementById('validacion').style.display = 'inline';
                }
                else
                    document.getElementById('anulacion').style.display = 'inline';
                    
        
            };
            if (typeof($location.search().idSolicitud) !== "undefined")
                $scope.obtenerSolicitudClasesDirigidas($location.search().idSolicitud);
            
            $scope.toggleSelection = function toggleSelection(idActividad) {
                
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
            
            
            $scope.guardarSolicitud = function() {
                if (typeof($location.search().idSolicitud) !== "undefined")
                    $scope.actualizarSolicitud();    
                        
            };
            
            $scope.actualizarSolicitud = function(){
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=actualizarSolicitud');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=actualizarSala";
                var Params = '';

               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
             
            
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            
            $scope.validarSolicitud = function(){
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=validarSolicitud');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=actualizarSala";
                var Params = 'idSolicitud='+ $location.search().idSolicitud;
               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
            
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            
            $scope.anularSolicitud = function(){
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=anularSolicitud');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=actualizarSala";
                var Params = 'idSolicitud='+ $location.search().idSolicitud;
               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
            
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            
            
            $scope.obtenerTipoAbono = function(){
        
        var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTiposAbono');		
        //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTiposAbono";		
        
        var Params = '';

        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
        
                       
        $scope.tiposAbonos = JSON.parse(Ajax.responseText).tiposAbonos;
        
        };   
            $scope.obtenerTipoAbono();
        
             $scope.obtenerTipoTarifa = function(){
        
        var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTiposTarifa');		
        //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTiposTarifa";		
        
        var Params = '';

        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
               
        $scope.tiposTarifas = JSON.parse(Ajax.responseText).tiposTarifas;
        
        };   
             $scope.obtenerTipoTarifa();
             
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
                }
                
        
            };
            
            $scope.obtenerActividades();
            
        }
            $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            dayNamesMin: ['Do','Lun','Ma','Mi','Ju','Vi','Sá'],
            weekHeader: 'Sm',
            dateFormat:'dd-mm-yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
            };
 $.datepicker.setDefaults($.datepicker.regional['es']);
            
            $(function() {
                $( "#FechaSolicitud" ).datepicker({
                    dateFormat:'dd-mm-yy'
                });
            });
            
            
                       
        </script>
       
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="Salas.php">Solicitud</a>
        </li>
        <li>
            <a href="#">Clases Dirigidas</a>
        </li>
    </ul>
</div>
<div class=" row" ng-app="DetalleSolicitudClasesDirigidas">
<div ng_controller="CargaSolicitudClasesDirigidas">
<div class="box col-md-12">
                        <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Solicitud Clases Dirigidas {{clasesdirigidas.Localizador}}</h2>
                        </div>
                            <div class="box-content alerts">
                                <div class="alert alert-danger" id="divError" style='display:none;'>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Error</strong> Se ha producido un error al realizar la operación.
                                </div>
                            <div class="alert alert-success" id="divCorrecto" style='display:none;'>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Correcto.</strong>  Operación realizada con éxito.
                            </div>
                            <div class="alert alert-warning" id="divPendiente" style='display:none;'>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Solicitud pendiente de validar.</strong>
                            </div>
                            </div>
                        <div class="box-content">
                            <form role="form"  name="formulario">
                                <ul class="nav nav-tabs" id="myTab">
                                <li><a href="#datossolicitud">Datos Solicitud</a></li>
                                <li class="active"><a href="#datospersonales">Datos Personales</a></li>
                                <li><a href="#direccion">Direccion</a></li>
                                <li><a href="#datosbancarios">Datos bancarios</a></li>
                                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active" id="datossolicitud">
                        <h3></h3>
                        
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-md-2" >Fecha Solicitud</label>
                                <input ng_disabled="true" ng-model="clasesdirigidas.FechaSolicitud" type="text" class="input-sm col-md-2 col-sm-4 col-xs-4" name="FechaSolicitud" id="FechaSolicitud" ng-pattern="/^(0?[1-9]|[12][0-9]|3[01])\-(0?[1-9]|1[012])\-(199\d|[2-9]\d{3})$/" required>
                                <span class="col-md-6 col-sm-5 col-XS-12" style="color:red" ng-show="formulario.FechaSolicitud.$dirty && formulario.FechaSolicitud.$invalid">
                                     <span ng-show="formulario.FechaSolicitud.$error.pattern">* Formato de fecha no valido.</span>
                                    <span ng-show="formulario.FechaSolicitud.$error.required">* Fecha obligatoria.</span>
                                </span>
                                </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="checkbox">
                                <label ng_repeat="actividad in actividades"   class="control-label col-md-4 col-sm-4 col-xs-4">
                                    <input ng_disabled="true"  class="" type="checkbox" ng-checked="selection.indexOf(actividad.idActividad)>-1" ng-click="toggleSelection(actividad.idActividad)" checklist-model="actividades" checklist-value="actividad" >{{actividad.NombreActividad}}
                                </label>
                            </div>
                            </div>
                        
                    </div>    
                    <div class="tab-pane active" id="datospersonales">
                        <h3></h3>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Localizador</label>
                                <input ng_disabled="true" ng-model="clasesdirigidas.Localizador"  type="text" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="localizador" id="Localizador" required >
                                <span style="color:red" ng-show="formulario.localizador.$dirty && formulario.localizador.$invalid">
                                <span ng-show="formulario.localizador.$error.required">Localizador obligatorio.</span>
                                 </span>
                                </div>
                                
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Nombre</label>
                                <input ng_disabled="true" ng-model="clasesdirigidas.Nombre"  type="text" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="nombre" id="Nombre" required >
                                <span style="color:red" ng-show="formulario.nombre.$dirty && formulario.nombre.$invalid">
                                <span ng-show="formulario.nombre.$error.required">Nombre obligatorio.</span>
                                 </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Apellidos</label>
                                <input ng_disabled="true" ng-model="clasesdirigidas.Apellidos" type="text" class="input-sm col-lg-8 col-md-8 col-sm-10 col-xs-12"  name="apellidos" id="Apellidos" required>
                                <span style="color:red" ng-show="formulario.apellidos.$dirty && formulario.apellidos.$invalid">
                                <span ng-show="formulario.apellidos.$error.required">Apellidos obligatorio.</span>
                                </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Fecha Nacimiento</label>
                                <input ng_disabled="true" ng-model="clasesdirigidas.FechaNacimiento" type="text" class="input-sm col-md-2 col-sm-4 col-xs-8" name="FechaNacimiento" id="FechaNacimiento" >
                                <span class="col-md-6 col-sm-5 col-xs-12" style="color:red" ng-show="formulario.FechaNacimiento.$dirty && formulario.FechaNacimiento.$invalid">
                                     <span ng-show="formulario.FechaNacimiento.$error.pattern">* Formato de fecha no valido.</span>
                                    <span ng-show="formulario.FechaNacimiento.$error.required">* Fecha obligatoria.</span>
                                </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">                                
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Dni</label>
                                <input ng_disabled="true" ng-model="clasesdirigidas.DNI" type="text" class="input-sm col-lg-2 col-md-4 col-sm-6 col-xs-12" name="dni" id="Dni" required ng-pattern='/^\d{7,8}(-?[a-z])?$/i'>
                                <span style="color:red" ng-show="formulario.dni.$dirty && formulario.dni.$invalid">
                                <span ng-show="formulario.dni.$error.pattern">Formato de DNI no válido 12345678-A</span>
                                </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                     <label class="control-label" >Mujer</label>  <input ng_disabled="true" type="radio"  name="Sexo" value="M"  id="Sexo"/>
                                     <label class="control-label" >Hombre</label>  <input ng_disabled="true" type="radio" name="Sexo" value="H" checked="checked" id="Sexo"/>
                                </div>
                    </div>
                    <div class="tab-pane" id="direccion">
                        <h3></h3>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Direccion</label>
                                <input ng_disabled="true" ng-model="clasesdirigidas.Direccion"  type="text" class="input-sm col-lg-8 col-md-8 col-sm-10 col-xs-12" name="direccion" id="Direccion" required >
                                <span style="color:red" ng-show="formulario.direccion.$dirty && formulario.direccion.$invalid">
                                <span ng-show="formulario.direccion.$error.required">Direccion obligatorio.</span>
                                 </span>
                                </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Localidad</label>
                                <input ng_disabled="true" ng-model="clasesdirigidas.Localidad"  type="text" class="input-sm col-lg-6 col-md-3 col-sm-4 col-xs-12" name="localidad" id="Localidad" required >
                                <span style="color:red" ng-show="formulario.localidad.$dirty && formulario.localidad.$invalid">
                                <span ng-show="formulario.localidad.$error.required">Localidad obligatorio.</span>
                                 </span>
                                </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Provincia</label>
                                <input ng_disabled="true" ng-model="clasesdirigidas.Provincia"  type="text" class="input-sm col-lg-6 col-md-3 col-sm-4 col-xs-12" name="provincia" id="Provincia" required >
                                <span style="color:red" ng-show="formulario.provincia.$dirty && formulario.provincia.$invalid">
                                <span ng-show="formulario.provincia.$error.required">Provincia obligatorio.</span>
                                 </span>
                                </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Código Postal</label>
                                <input ng_disabled="true" ng-model="clasesdirigidas.CodigoPostal"  type="text" class="input-sm col-lg-1 col-md-1 col-sm-2 col-xs-3" name="codigopostal" id="CodigoPostal" required >
                                <span style="color:red" ng-show="formulario.codigopostal.$dirty && formulario.codigopostal.$invalid">
                                <span ng-show="formulario.codigopostal.$error.required">Codigo Postal obligatorio.</span>
                                 </span>
                                </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">                                
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Email</label>
                                <input ng_disabled="true" ng-model="clasesdirigidas.Email" type="email" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="mail" id="Mail" required >
                                <span style="color:red" ng-show="formulario.mail.$dirty && formulario.mail.$invalid">
                                <span ng-show="formulario.mail.$error.required">Email obligatorio.</span>
                                <span ng-show="formulario.mail.$error.email">Formato de email no válido.</span>
                                </span>
                                </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Telefono 1</label>
                                <input ng_disabled="true" ng-model="clasesdirigidas.Telefono1"  type="text" class="input-sm col-lg-1 col-md-2 col-sm-3 col-xs-3" maxlength="9" name="telefono1" id="Telefono1" required >
                                <span style="color:red" ng-show="formulario.telefono1.$dirty && formulario.telefono1.$invalid">
                                <span ng-show="formulario.telefono1.$error.required">Codigo Postal obligatorio.</span>
                                 </span>
                                </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Telefono 2</label>
                                <input ng_disabled="true" ng-model="clasesdirigidas.Telefono1"  type="text" class="input-sm col-lg-1 col-md-2 col-sm-3 col-xs-3" name="telefono2" id="Telefono2" required >
                                <span style="color:red" ng-show="formulario.telefono2.$dirty && formulario.telefono2.$invalid">
                                <span ng-show="formulario.telefono2.$error.required">Codigo Postal obligatorio.</span>
                                 </span>
                                </div>
                    </div>
                    <div class="tab-pane" id="datosbancarios" ng-repeat="dato in datosbancarios">
                        <h3></h3>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Titular</label>
                                <input ng_disabled="true" ng-model="dato.Titular"  type="text" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="titular" id="Titular" required >
                                <span style="color:red" ng-show="formulario.titular.$dirty && formulario.titular.$invalid">
                                <span ng-show="formulario.titular.$error.required">Titular obligatorio.</span>
                                 </span>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Control IBAN</label>
                                <input ng_disabled="true" ng-model="dato.IBAN"  disabled="true" type="text" maxlength="4" class="input-sm col-lg-1 col-md-1 col-sm-2 col-xs-3" name="iban" id="Iban" required >
                        </div>       
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Entidad</label>
                                <input ng_disabled="true" ng-model="dato.Entidad"  type="text" maxlength="4" class="input-sm col-lg-1 col-md-1 col-sm-2 col-xs-3" name="entidad" id="Entidad" required ng-pattern="/^\d+$/" >
                                </div>       
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Oficina</label>
                                <input ng_disabled="true" ng-model="dato.Oficina"  type="text" maxlength="4" class="input-sm col-lg-1 col-md-1 col-sm-2 col-xs-3" name="oficina" id="Oficina" required ng-pattern="/^\d+$/">
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Digito Control</label>
                                <input ng_disabled="true" ng-model="dato.DigitoControl"  type="text" maxlength="2" class="input-sm col-lg-1 col-md-1 col-sm-1 col-xs-2" name="digito" id="Digito" required ng-pattern="/^\d+$/">
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Número de cuenta</label>
                                <input ng_disabled="true" ng-model="dato.Cuenta"  type="text" maxlength="10" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" name="cuenta" id="Cuenta" required ng-pattern="/^\d+$/">
                                </div>
                                <span style="color:red" ng-show="formulario.titular.$dirty && formulario.titular.$invalid">
                                <span ng-show="formulario.titular.$error.required">Codigo Postal obligatorio.</span>
                                 </span>
                                </fieldset>
                        </div>
                    </div>
                    </div>
                                <input class="box btn-primary" type="button" value="Cancelar" onClick=" window.location.href='Reservas.php?detalle=1' " />
                                <input style='display:none;' id="validacion" class="box btn-primary" type="submit" value="Validar Solicitud" ng-click="validarSolicitud();" ng-disabled="formulario.$invalid" />
                                <input style='display:none;' id="anulacion" class="box btn-primary" type="submit" value="Anular Solicitud" ng-click="anularSolicitud();" />
                                
                                
                             </form>
                           </div>                                         
                        </div>
                        </div>
                </div>
    </div>
                       


        
<?php require('Pie.php'); ?>
