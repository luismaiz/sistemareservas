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
                
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerSolicitudAbonoMensual";
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSala";
                var Params = 'idSolicitud='+ idSolicitud;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                alert(Ajax.responseText);
                               
                $scope.abonomensual = JSON.parse(Ajax.responseText).abonomensual;
        
            };
            if (typeof($location.search().idSolicitud) !== "undefined")
                $scope.obtenerSolicitudAbonoMensual($location.search().idSolicitud);
            
            $scope.guardarSolicitud = function() {
                if (typeof($location.search().idSolicitud) !== "undefined")
                    $scope.actualizarSolicitud();    
                        
            };
            
            $scope.actualizarSolicitud = function(){
                                   
             
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=actualizarSolicitud";
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
                                   
             alert('vamos');
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=validarSolicitud";
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=actualizarSala";
                var Params = 'idSolicitud='+ $location.search().idSolicitud;
               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
             alert(Ajax.responseText);
            
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
        
        var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTiposAbono";		
        //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTiposAbono";		
        
        var Params = '';

        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
        
                       
        $scope.tiposAbonos = JSON.parse(Ajax.responseText).tiposAbonos;
        
        };   
        $scope.obtenerTipoAbono();
        
        $scope.obtenerTipoTarifa = function(){
        
        var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTiposTarifa";		
        //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTiposTarifa";		
        
        var Params = '';

        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
               
        $scope.tiposTarifas = JSON.parse(Ajax.responseText).tiposTarifas;
        
        };   
        $scope.obtenerTipoTarifa();
            
            
        }
                       
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
                            </div>
                        <div class="box-content">
                            <form role="form"  name="formulario">
                                <ul class="nav nav-tabs" id="myTab">
                                <li><a href="#datosabono">Datos Abono</a></li>
                                <li class="active"><a href="#datospersonales">Datos Personales</a></li>
                                <li><a href="#direccion">Direccion</a></li>
                                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active" id="datosabono">
                        <h3></h3>
                        <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Fecha Solicitud</label>
                                <input ng-model="abonomensual.FechaSolicitud" type="date" class="input-sm" name="FechaSolicitud" id="FechaSolicitud">
                                </div>
                        <div class="form-group col-md-12">
                        <label class="control-label col-md-2" >Tipo Abono</label>
                                <select  id="filtroTipoAbono" class="input-sm col-md-2" >	
                                    <option ng_repeat="tipoabono in tiposAbonos" value="{{tipoabono.idTipoAbono}}">{{tipoabono.NombreAbono}}</option>
                                </select>
                        </div>
                        <div class="form-group col-md-12">
                        <label class="control-label col-md-2" >Tipo Tarifa</label>
                                <select  id="filtroTipoTarifa" class="input-sm col-md-2" >	
                                    <option ng_repeat="tipotarifa in tiposTarifas" value="{{tipotarifa.idTipoTarifa}}">{{tipotarifa.NombreTarifa}}</option>
                                </select>
                        </div>
                        
                        <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Cantidad pagada</label>
                                <input ng-model="abonomensual.Cantidad"  type="text" class="input-sm col-md-4" name="cantidad" id="cantidad" required >
                                <span style="color:red" ng-show="formulario.cantidad.$dirty && formulario.cantidad.$invalid">
                                <span ng-show="formulario.cantidad.$error.required">Nombre obligatorio.</span>
                                 </span>
                                </div>
                    </div>    
                    <div class="tab-pane active" id="datospersonales">
                        <h3></h3>
                        <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Localizador</label>
                                <input ng-model="abonomensual.Localizador"  type="text" class="input-sm col-md-4" name="localizador" id="Localizador" required >
                                <span style="color:red" ng-show="formulario.localizador.$dirty && formulario.localizador.$invalid">
                                <span ng-show="formulario.localizador.$error.required">Localizador obligatorio.</span>
                                 </span>
                                </div>
                                
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Nombre</label>
                                <input ng-model="abonomensual.Nombre"  type="text" class="input-sm col-md-4" name="nombre" id="Nombre" required >
                                <span style="color:red" ng-show="formulario.nombre.$dirty && formulario.nombre.$invalid">
                                <span ng-show="formulario.nombre.$error.required">Nombre obligatorio.</span>
                                 </span>
                                </div>
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Apellidos</label>
                                <input ng-model="abonomensual.Apellidos" type="text" class="input-sm col-md-6"  name="apellidos" id="Apellidos" required>
                                <span style="color:red" ng-show="formulario.apellidos.$dirty && formulario.apellidos.$invalid">
                                <span ng-show="formulario.apellidos.$error.required">Apellidos obligatorio.</span>
                                </span>
                                </div>
                                
                                <div class="form-group col-md-12">                                
                                <label class="control-label col-md-2" >Dni</label>
                                <input ng-model="abonomensual.DNI" type="text" class="input-sm" name="dni" id="Dni" required ng-pattern='/^\d{7,8}(-?[a-z])?$/i'>
                                <span style="color:red" ng-show="formulario.dni.$dirty && formulario.dni.$invalid">
                                <span ng-show="formulario.dni.$error.pattern">Formato de DNI no válido 12345678-A</span>
                                </span>
                                </div>
                    </div>
                    <div class="tab-pane" id="direccion">
                        <h3></h3>
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Direccion</label>
                                <input ng-model="abonomensual.Direccion"  type="text" class="input-sm col-md-8" name="direccion" id="Direccion" required >
                                <span style="color:red" ng-show="formulario.direccion.$dirty && formulario.direccion.$invalid">
                                <span ng-show="formulario.direccion.$error.required">Direccion obligatorio.</span>
                                 </span>
                                </div>
                        <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Localidad</label>
                                <input ng-model="abonomensual.Localidad"  type="text" class="input-sm col-md-4" name="localidad" id="Localidad" required >
                                <span style="color:red" ng-show="formulario.localidad.$dirty && formulario.localidad.$invalid">
                                <span ng-show="formulario.localidad.$error.required">Localidad obligatorio.</span>
                                 </span>
                                </div>
                        <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Provincia</label>
                                <input ng-model="abonomensual.Provincia"  type="text" class="input-sm col-md-4" name="provincia" id="Provincia" required >
                                <span style="color:red" ng-show="formulario.provincia.$dirty && formulario.provincia.$invalid">
                                <span ng-show="formulario.provincia.$error.required">Provincia obligatorio.</span>
                                 </span>
                                </div>
                        <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Código Postal</label>
                                <input ng-model="abonomensual.CodigoPostal"  type="text" class="input-sm col-md-4" name="codigopostal" id="CodigoPostal" required >
                                <span style="color:red" ng-show="formulario.codigopostal.$dirty && formulario.codigopostal.$invalid">
                                <span ng-show="formulario.codigopostal.$error.required">Codigo Postal obligatorio.</span>
                                 </span>
                                </div>
                        <div class="form-group col-md-12">                                
                                <label class="control-label col-md-2" >Email</label>
                                <input ng-model="abonomensual.Email" type="email" class="input-sm" name="mail" id="Mail" required >
                                <span style="color:red" ng-show="formulario.mail.$dirty && formulario.mail.$invalid">
                                <span ng-show="formulario.mail.$error.required">Email obligatorio.</span>
                                <span ng-show="formulario.mail.$error.email">Formato de email no válido.</span>
                                </span>
                                </div>
                        <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Telefono 1</label>
                                <input ng-model="abonomensual.Telefono1"  type="text" class="input-sm col-md-4" name="telefono1" id="Telefono1" required >
                                <span style="color:red" ng-show="formulario.telefono1.$dirty && formulario.telefono1.$invalid">
                                <span ng-show="formulario.telefono1.$error.required">Codigo Postal obligatorio.</span>
                                 </span>
                                </div>
                        <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Telefono 2</label>
                                <input ng-model="abonomensual.Telefono1"  type="text" class="input-sm col-md-4" name="telefono2" id="Telefono2" required >
                                <span style="color:red" ng-show="formulario.telefono2.$dirty && formulario.telefono2.$invalid">
                                <span ng-show="formulario.telefono2.$error.required">Codigo Postal obligatorio.</span>
                                 </span>
                                </div>
                    </div>
                    </div>
                                <input class="box btn-primary" type="button" value="Cancelar" onClick=" window.location.href='Reservas.php' " />
                                <input style='display:none;' id="validacion" class="box btn-primary" type="submit" value="Validar Solicitud" ng-click="validarSolicitud();" ng-disabled="formulario.$invalid" />
                             </form>
                           </div>                                         
                        </div>
                        </div>
                </div>
    </div>
                       


        
<?php require('Pie.php'); ?>
