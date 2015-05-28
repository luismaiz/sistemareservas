<?php require('Cabecera.php'); ?> 
<script>
           
            var Ajax = new AjaxObj();
            var app = angular.module('DetalleAbonoMensual', [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
                
            function CargaDetalleAbonoMensual($scope, $http, $location) {
       
            $scope.abonomensual = [];
            $scope.estado = [];
            $scope.msg = [];
            $scope.obtenerSolicitudAbonoMensual = function(idSolicitud) {
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerSolicitudAbonoMensual');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSala";
                var Params = 'idSolicitud='+ idSolicitud;
                
                

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                $scope.abonomensual = JSON.parse(Ajax.responseText).abonomensual;
                $scope.datossolicitud = JSON.parse(Ajax.responseText).datossolicitud;
                
                if ($scope.abonomensual.Anulado=== '1')
                {
					document.getElementById('divBaja').style.display = 'block';
                    document.getElementById('activar').style.display = 'inline';
					document.getElementById('aceptar').style.display = 'none';
					document.getElementById('anular').style.display = 'none';
                }
              
                if ($scope.abonomensual.Anulado=== '0')
                {
                    document.getElementById('divBaja').style.display = 'none';
					document.getElementById('activar').style.display = 'none';
                    document.getElementById('aceptar').style.display = 'inline';
					document.getElementById('anular').style.display = 'inline';
                }
                                
                //alert(Ajax.responseText);
        
            };
            if (typeof($location.search().idSolicitud) !== "undefined")
                $scope.obtenerSolicitudAbonoMensual($location.search().idSolicitud);
            
            $scope.guardarSolicitud = function() {
                if (typeof($location.search().idSolicitud) !== "undefined")
                    $scope.actualizarSolicitud();    
                        
            };
            
            $scope.actualizarSolicitud = function(){
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=actualizarSolicitudAbonoMensual');
                
                var Params = 'idSolicitud='+$location.search().idSolicitud+
                             '&Nombre=' + document.getElementById("Nombre").value +    
                             '&Apellidos='+ document.getElementById("Apellidos").value +
                             '&DNI=' + document.getElementById("Dni").value +
                             '&Mail=' + document.getElementById("Mail").value +
                             '&Direccion=' + document.getElementById("Direccion").value +
                             '&Localidad=' + document.getElementById("Localidad").value +
                             '&Provincia=' + document.getElementById("Provincia").value +
                             '&Cpostal=' + document.getElementById("CodigoPostal").value +
                             '&Telefono1=' + document.getElementById("Telefono1").value +
                             '&Telefono2=' + document.getElementById("Telefono2").value +
                             '&TipoAbono=' + document.getElementById("filtroTipoAbono").value +
                             '&TipoTarifa=' + document.getElementById("filtroTipoTarifa").value+
							  '&FechaInicio=' + document.getElementById("FechaInicio").value +
                             '&FechaFin=' + document.getElementById("FechaFin").value +
                            '&idDatos=' + $scope.datossolicitud.idDatosSolicitudAbonoMensual +
                             '&Cantidad=' + document.getElementById("cantidad").value;

               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
             
            
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    $scope.obtenerSolicitudAbonoMensual($location.search().idSolicitud);
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            
            $scope.validarSolicitud = function(){
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=validarSolicitud');
                
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
        
        
        
        $scope.activarSolicitud = function(){
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=activarSolicitud');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=actualizarSala";
                var Params = 'idSolicitud='+ $location.search().idSolicitud;
               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
            
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                     document.getElementById('divCorrecto').style.display = 'block';
                    document.getElementById('divBaja').style.display = 'none';
                    $scope.obtenerSolicitudAbonoMensual($location.search().idSolicitud);
                    document.getElementById('anular').style.display = 'inline';
                    document.getElementById('aceptar').style.display = 'inline';
                    document.getElementById('activar').style.display = 'none';
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
                     document.getElementById('divBaja').style.display = 'inline';
                    document.getElementById('divCorrecto').style.display = 'none';
                    $scope.obtenerSolicitudAbonoMensual($location.search().idSolicitud);
                    document.getElementById('anular').style.display = 'none';
                    document.getElementById('aceptar').style.display = 'none';
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
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
				$( "#FechaInicio" ).datepicker({
                    dateFormat:'dd-mm-yy'
                });
				$( "#FechaFin" ).datepicker({
                    dateFormat:'dd-mm-yy'
                });
            });
			
            
            
                       
        </script>
       
<div>
    <ul class="breadcrumb">
        <li>
            <a href="Inicio.php">Inicio</a>
        </li>
        <li>
            <a href="Reservas.php">Solicitud</a>
        </li>
        <li>
            <a href="#">Abono Mensual</a>
        </li>
    </ul>
</div>
<div class=" row" ng-app="DetalleAbonoMensual">
<div ng_controller="CargaDetalleAbonoMensual">
<div class="box col-md-12">
                        <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Solicitud Abono Mensual {{abonomensual.Localizador}}</h2>
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
                                <div class="alert alert-danger" id="divBaja" style='display:none;'>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Esta solicitud se encuentra dada de baja.</strong>
                            </div>
                            </div>
                        <div class="box-content">
                            <form role="form"  name="formulario">
                                <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a href="#datosabono">Datos Abono</a></li>
                                <li><a href="#datospersonales">Datos Personales</a></li>
                                <li><a href="#direccion">Direccion</a></li>
                                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active" id="datosabono">
                        <h3></h3>
						
				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-md-2" >Localizador</label>
                                <input ng-disabled="true" ng-model="abonomensual.Localizador"  type="text" class="input-sm col-md-4" name="localizador" id="Localizador" required >
                                <span style="color:red" ng-show="formulario.localizador.$dirty && formulario.localizador.$invalid">
                                <span ng-show="formulario.localizador.$error.required">* Localizador obligatorio.</span>
                                 </span>
                                </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-md-2" >Fecha Solicitud</label>
                                <input ng_disabled="true" ng-model="abonomensual.FechaSolicitud" type="text" class="input-sm col-md-2 col-sm-4 col-xs-4" name="FechaSolicitud" id="FechaSolicitud" ng-pattern="/^(0?[1-9]|[12][0-9]|3[01])\-(0?[1-9]|1[012])\-(199\d|[2-9]\d{3})$/" required>
                                <span class="col-md-6 col-sm-5 col-XS-12" style="color:red" ng-show="formulario.FechaSolicitud.$dirty && formulario.FechaSolicitud.$invalid">
                                     <span ng-show="formulario.FechaSolicitud.$error.pattern">* Formato de fecha no valido.</span>
                                    <span ng-show="formulario.FechaSolicitud.$error.required">* Fecha obligatoria.</span>
                                </span>
                                
                                </div>
                        
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="control-label col-md-2" >Tipo Abono</label>
                                <select ng_disabled="true"   id="filtroTipoAbono" class="input-sm col-md-2" >	
                                    <option ng_repeat="tipoabono in tiposAbonos" ng_selected="{{datossolicitud.idTipoAbono}} === null ? {{tipoabono.idTipoAbono}} === {{datossolicitud.idTipoAbono}} : {{tipoabono.idTipoAbono}} === {{datossolicitud.idTipoAbono}}" value="{{tipoabono.idTipoAbono}}">{{tipoabono.NombreAbono}}</option>
                                </select>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="control-label col-md-2" >Tipo Tarifa</label>
                                <select ng-disabled="abonomensual.Anulado==='1'"  id="filtroTipoTarifa" class="input-sm col-md-2" >	
                                    <option ng_repeat="tipotarifa in tiposTarifas" ng_selected="{{abonomensual.idTipoTarifa}} === null ? {{tipotarifa.idTipoTarifa}} === {{abonomensual.idTipoTarifa}} : {{tipotarifa.idTipoTarifa}}==={{abonomensual.idTipoTarifa}}" value="{{tipotarifa.idTipoTarifa}}">{{tipotarifa.NombreTarifa}}</option>
                                </select>
                        </div>
                        
                        <input ng-show="false" ng-model="datossolicitud.idDatosSolicitudAbonoMensual" type="hidden" class="input-sm" name="idDatos" id="idDatos">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                <label class="control-label col-md-2" >Fecha Inicio</label>
                                <input ng-disabled="abonomensual.Anulado==='1'" ng-model="datossolicitud.FechaInicio" type="text" class="input-sm col-md-2 col-sm-4 col-xs-4" name="FechaInicio" id="FechaInicio" >
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" class="col-md-6 col-sm-5 col-XS-12" style="color:red" ng-show="formulario.FechaInicio.$dirty && formulario.FechaInicio.$invalid">
                                     <span ng-show="formulario.FechaInicio.$error.pattern">* Formato de fecha no valido.</span>
                                    <span ng-show="formulario.FechaInicio.$error.required">* Fecha obligatoria.</span>
                                </span>
                                
                                </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                <label class="control-label col-md-2" >Fecha Fin</label>
                                <input  ng-disabled="abonomensual.Anulado==='1'" ng-model="datossolicitud.FechaFin" type="text" class="input-sm col-md-2 col-sm-4 col-xs-4" name="FechaFin" id="FechaFin" >
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" class="col-md-6 col-sm-5 col-XS-12" style="color:red" ng-show="formulario.FechaFin.$dirty && formulario.FechaFin.$invalid">
                                     <span ng-show="formulario.FechaFin.$error.pattern">* Formato de fecha no valido.</span>
                                    <span ng-show="formulario.FechaFin.$error.required">* Fecha obligatoria.</span>
                                </span>
                                
                                </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                <label class="control-label col-md-2" >Cantidad pagada</label>
                                <input ng-disabled="abonomensual.Anulado==='1'" ng-model="datossolicitud.PrecioPagado"  type="text" class="input-sm col-md-4" name="cantidad" id="cantidad" required ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/">
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.cantidad.$dirty && formulario.cantidad.$invalid">
                                <span ng-show="formulario.cantidad.$error.required">* Cantidad obligatoria.</span>
								<span ng-show="formulario.cantidad.$error.pattern">* Cantidad debe ser un número</span>
                                 </span>
                                </div>
                    
                       </div>
                    <div class="tab-pane" id="datospersonales">
                        <h3></h3>
                        
                                
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Nombre</label>
                                <input ng-disabled="abonomensual.Anulado==='1'" ng-model="abonomensual.Nombre"  type="text" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="nombre" id="Nombre" required >
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.nombre.$dirty && formulario.nombre.$invalid">
                                <span ng-show="formulario.nombre.$error.required">* Nombre obligatorio.</span>
                                 </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Apellidos</label>
                                <input ng-disabled="abonomensual.Anulado==='1'" ng-model="abonomensual.Apellidos" type="text" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12"  name="apellidos" id="Apellidos" required>
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.apellidos.$dirty && formulario.apellidos.$invalid">
                                <span ng-show="formulario.apellidos.$error.required">* Apellidos obligatorio.</span>
                                </span>
                                </div>
                                
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">                                
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Dni</label>
                                <input ng-disabled="abonomensual.Anulado==='1'" ng-model="abonomensual.DNI" type="text" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="dni" id="Dni" required ng-pattern='/^\d{7,8}(-?[a-z])?$/i'>
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.dni.$dirty && formulario.dni.$invalid">
                                <span ng-show="formulario.dni.$error.pattern">* Formato de DNI no válido 12345678-A</span>
                                </span>
                                </div>
                    </div>
                    <div class="tab-pane" id="direccion">
                        <h3></h3>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-md-2" >Direccion</label>
                                <input ng-disabled="abonomensual.Anulado==='1'" ng-model="abonomensual.Direccion"  type="text" class="input-sm col-md-8" name="direccion" id="Direccion" required >
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.direccion.$dirty && formulario.direccion.$invalid">
                                <span ng-show="formulario.direccion.$error.required">* Direccion obligatoria.</span>
                                 </span>
                                </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-md-2" >Localidad</label>
                                <input ng-disabled="abonomensual.Anulado==='1'" ng-model="abonomensual.Localidad"  type="text" class="input-sm col-md-4" name="localidad" id="Localidad" required >
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.localidad.$dirty && formulario.localidad.$invalid">
                                <span ng-show="formulario.localidad.$error.required">* Localidad obligatoria.</span>
                                 </span>
                                </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-md-2" >Provincia</label>
                                <input ng-disabled="abonomensual.Anulado==='1'" ng-model="abonomensual.Provincia"  type="text" class="input-sm col-md-4" name="provincia" id="Provincia" required >
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.provincia.$dirty && formulario.provincia.$invalid">
                                <span ng-show="formulario.provincia.$error.required">* Provincia obligatoria.</span>
                                 </span>
                                </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-md-2" >Código Postal</label>
                                <input ng-disabled="abonomensual.Anulado==='1'" ng-model="abonomensual.CodigoPostal"  type="text" class="input-sm col-md-4" name="codigopostal" id="CodigoPostal" required >
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.codigopostal.$dirty && formulario.codigopostal.$invalid">
                                <span ng-show="formulario.codigopostal.$error.required">* Codigo Postal obligatorio.</span>
                                 </span>
                                </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">                                
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Email</label>
                                <input ng-disabled="abonomensual.Anulado==='1'" ng-model="abonomensual.Email" type="email" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12"name="mail" id="Mail" required >
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.mail.$dirty && formulario.mail.$invalid">
                                <span ng-show="formulario.mail.$error.required">* Email obligatorio.</span>
                                <span ng-show="formulario.mail.$error.email">* Formato de email no válido.</span>
                                </span>
                                </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-md-2" >Telefono 1</label>
                                <input ng-disabled="abonomensual.Anulado==='1'" ng-model="abonomensual.Telefono1"  type="text" class="input-sm col-md-4" name="telefono1" id="Telefono1" required >
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.telefono1.$dirty && formulario.telefono1.$invalid">
                                <span ng-show="formulario.telefono1.$error.required">* Teléfono 1 obligatorio.</span>
                                 </span>
                                </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-md-2" >Telefono 2</label>
                                <input ng-disabled="abonomensual.Anulado==='1'" ng-model="abonomensual.Telefono2"  type="text" class="input-sm col-md-4" name="telefono2" id="Telefono2" >
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.telefono2.$dirty && formulario.telefono2.$invalid">
                                <span ng-show="formulario.telefono2.$error.required">* Telefono 2 obligatorio.</span>
                                 </span>
                                </div>
                    </div>
                    </div>
                                <input style='display:none;' id="anular" class="btn btn-sm btn-danger" type="submit" value="Anular Solicitud" ng-click="anularSolicitud();"  />
                                <input style='display:none;' id="aceptar" class="btn btn-sm btn-success" type="submit" value="Modificar Solicitud" ng-click="actualizarSolicitud();" ng-disabled="formulario.$invalid"  />
                                <input style='display:none;' id="activar" class="btn btn-sm btn-success" type="submit" value="Activar Solicitud" ng-click="activarSolicitud();"  />
                                <input class="btn btn-sm btn-action" type="button" value="Cancelar" onClick=" window.location.href='Reservas.php' " />
                                
                             </form>
                           </div>                                         
                        </div>
                        </div>
                </div>
    </div>
                       


        
<?php require('Pie.php'); ?>
