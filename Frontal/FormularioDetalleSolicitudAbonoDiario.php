<?php require('Cabecera.php'); ?> 
<script>
           
            var Ajax = new AjaxObj();
            var app = angular.module('DetalleAbonoDiario', [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
                
            function CargaDetalleAbonoDiario($scope, $http, $location) {
       
            $scope.abonodiario = [];
            $scope.estado = [];
            $scope.msg = [];
            $scope.obtenerSolicitudAbonoDiario = function(idSolicitud) {
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerSolicitudAbonoDiario');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSala";
                var Params = 'idSolicitud='+ idSolicitud;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
               //alert(Ajax.responseText);               
                $scope.abonodiario = JSON.parse(Ajax.responseText).abonodiario;
				if ($scope.abonodiario.Gestionado=== '0' && $scope.abonodiario.Anulado=== '1')
                {
                    document.getElementById('divBaja').style.display = 'block';
					document.getElementById('divPendiente').style.display = 'none';
                    document.getElementById('activar').style.display = 'inline';
					document.getElementById('validacion').style.display = 'none';
					document.getElementById('aceptar').style.display = 'none';
					document.getElementById('anular').style.display = 'none';
                }
              
                if ($scope.abonodiario.Gestionado=== '0' && $scope.abonodiario.Anulado=== '0')
                {
                    document.getElementById('divPendiente').style.display = 'block';
					document.getElementById('divBaja').style.display = 'none';
                    document.getElementById('validacion').style.display = 'inline';
					document.getElementById('anular').style.display = 'inline';
					document.getElementById('aceptar').style.display = 'none';
					document.getElementById('activar').style.display = 'none';
					
                }
                if ($scope.abonodiario.Gestionado=== '1' && $scope.abonodiario.Anulado=== '0')
                {
                    document.getElementById('divPendiente').style.display = 'none';
					document.getElementById('divBaja').style.display = 'none';
                    document.getElementById('validacion').style.display = 'none';
					document.getElementById('anular').style.display = 'inline';
					document.getElementById('aceptar').style.display = 'inline';
					document.getElementById('activar').style.display = 'none';
					
                }
				
				if ($scope.abonodiario.Gestionado=== '1' && $scope.abonodiario.Anulado=== '1')
                {
                    document.getElementById('divPendiente').style.display = 'none';
					document.getElementById('divBaja').style.display = 'block';
                    document.getElementById('validacion').style.display = 'none';
					document.getElementById('anular').style.display = 'none';
					document.getElementById('aceptar').style.display = 'none';
					document.getElementById('activar').style.display = 'inline';
					
                }
				
				
        
            };
            if (typeof($location.search().idSolicitud) !== "undefined")
                $scope.obtenerSolicitudAbonoDiario($location.search().idSolicitud);
            
            $scope.guardarSolicitud = function() {
                if (typeof($location.search().idSolicitud) !== "undefined")
                    $scope.actualizarSolicitud();    
                        
            };
            
            $scope.actualizarSolicitud = function(){
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=actualizarSolicitudAbonoDiario');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=actualizarSala";
                /*var Params = 'idSolicitud='+$location.search().idSolicitud+
                             '&Nombre=' + document.getElementById("Nombre").value +    
                             '&Apellidos='+ document.getElementById("Apellidos").value +
                             '&DNI=' + document.getElementById("Dni").value +
                             '&Mail=' + document.getElementById("Mail").value;*/
							 
							 var Params = 'idSolicitud='+$location.search().idSolicitud+
                             '&Nombre=' + $scope.abonodiario.Nombre +    
                             '&Apellidos='+ $scope.abonodiario.Apellidos +
                             '&DNI=' + $scope.abonodiario.DNI +
                             '&Mail=' + $scope.abonodiario.Email+
							 '&FechaAbonoDiario=' + $scope.abonodiario.FechaAbonoDiario ;

               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
             //alert(Ajax.responseText);
            
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
					$scope.obtenerSolicitudAbonoDiario($location.search().idSolicitud);
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
                //alert(Ajax.responseText);
            
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    document.getElementById('validacion').style.display = 'none';
					$scope.obtenerSolicitudAbonoDiario($location.search().idSolicitud);
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
					document.getElementById('divBaja').style.display = 'block';
                    document.getElementById('divCorrecto').style.display = 'none';
                    $scope.obtenerSolicitudAbonoDiario($location.search().idSolicitud);
                    document.getElementById('anular').style.display = 'none';
					
                    document.getElementById('aceptar').style.display = 'none';
					document.getElementById('validacion').style.display = 'none';
                   
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            
            
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
                   $scope.obtenerSolicitudAbonoDiario($location.search().idSolicitud);
                    document.getElementById('anular').style.display = 'inline';
					if($scope.abonodiario.Gestionado=== '0')
                    document.getElementById('aceptar').style.display = 'none';
					else
					document.getElementById('aceptar').style.display = 'inline';
                    document.getElementById('activar').style.display = 'none';
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
				$( "#FechaAbonoDiario" ).datepicker({
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
            <a href="#">Abono Diario</a>
        </li>
    </ul>
</div>
<div class=" row" ng-app="DetalleAbonoDiario">
<div ng_controller="CargaDetalleAbonoDiario">
<div class="box col-md-12">
                        <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Solicitud Abono Diario</h2>
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
							<div class="alert alert-danger" id="divBaja" style='display:none;'>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Esta solicitud se encuentra anulada.</strong>
                            </div>
                            </div>
                        <div class="box-content">
                            <form role="form"  name="formulario">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Localizador</label>
                                <input ng_disabled="true" ng-model="abonodiario.Localizador"  type="text" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="localizador" id="Localizador" required >
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.localizador.$dirty && formulario.localizador.$invalid">
                                <span ng-show="formulario.localizador.$error.required">* Localizador obligatorio.</span>
                                 </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Fecha Solicitud</label>
                                <input ng_disabled="true" ng-model="abonodiario.FechaSolicitud" type="text" class="input-sm col-md-2 col-sm-4 col-xs-4" name="FechaSolicitud" id="FechaSolicitud">
                                <span class="col-md-6 col-sm-5 col-XS-12" style="color:red" ng-show="formulario.FechaSolicitud.$dirty && formulario.FechaSolicitud.$invalid">
                                     <span ng-show="formulario.FechaSolicitud.$error.pattern">* Formato de fecha no valido.</span>
                                    <span ng-show="formulario.FechaSolicitud.$error.required">* Fecha obligatoria.</span>
                                </span>
                                </div>
								<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Día de acceso</label>
                                <input ng_disabled="abonodiario.Gestionado=== '0' || abonodiario.Anulado=== '1'" ng-model="abonodiario.FechaAbonoDiario" type="text" class="input-sm col-md-2 col-sm-4 col-xs-4" name="FechaAbonoDiario" id="FechaAbonoDiario">
                                <span class="col-md-6 col-sm-5 col-XS-12" style="color:red" ng-show="formulario.FechaAbonoDiario.$dirty && formulario.FechaSolicitud.$invalid">
                                     <span ng-show="formulario.FechaAbonoDiario.$error.pattern">* Formato de fecha no valido.</span>
                                    <span ng-show="formulario.FechaAbonoDiario.$error.required">* Fecha obligatoria.</span>
                                </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Nombre</label>
                                <input ng_disabled="abonodiario.Gestionado=== '0' || abonodiario.Anulado=== '1'" ng-model="abonodiario.Nombre"  type="text" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="nombre" id="Nombre" required >
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.nombre.$dirty && formulario.nombre.$invalid">
                                <span ng-show="formulario.nombre.$error.required">* Nombre obligatorio.</span>
                                 </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Apellidos</label>
                                <input ng_disabled="abonodiario.Gestionado=== '0' || abonodiario.Anulado=== '1'" ng-model="abonodiario.Apellidos" type="text" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12"  name="apellidos" id="Apellidos" required>
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.apellidos.$dirty && formulario.apellidos.$invalid">
                                <span ng-show="formulario.apellidos.$error.required">* Apellidos obligatorio.</span>
                                </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">                                
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Email</label>
                                <input ng_disabled="abonodiario.Gestionado=== '0' || abonodiario.Anulado=== '1'" ng-model="abonodiario.Email" type="email" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="mail" id="Mail" required >
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.mail.$dirty && formulario.mail.$invalid">
                                <span ng-show="formulario.mail.$error.required">* Email obligatorio.</span>
                                <span ng-show="formulario.mail.$error.email">* Formato de email no válido.</span>
                                </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">                                
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Dni</label>
                                <input ng_disabled="abonodiario.Gestionado=== '0' || abonodiario.Anulado=== '1'" ng-model="abonodiario.DNI" type="text" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="dni" id="Dni"  ng-pattern='/^\d{7,8}(-?[a-z])?$/i'>
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.dni.$dirty && formulario.dni.$invalid">
                                <span ng-show="formulario.dni.$error.pattern">* Formato de DNI no válido 12345678-A</span>
                                </span>
                                </div>
                                <input style='display:none;'  id="anular" class="btn btn-sm btn-danger" type="submit" value="Anular Solicitud" ng-click="anularSolicitud();"  />
                                <input style='display:none;' id="aceptar" class="btn btn-sm btn-success" type="submit" value="Modificar Solicitud" ng-click="actualizarSolicitud();" ng-disabled="formulario.$invalid"  />
                                <input style='display:none;'  id="validacion" class="btn btn-sm btn-success" type="submit" value="Validar Solicitud" ng-click="validarSolicitud();" ng-disabled="formulario.$invalid" />
                                <input style='display:none;'  id="activar" class="btn btn-sm btn-success" type="submit" value="Activar Solicitud" ng-click="activarSolicitud();"  />
                                <input class="btn btn-sm btn-action" type="button" value="Cancelar" onClick=" window.location.href='Reservas.php' " />
                             </form>
                           </div>                                         
                        </div>
                        </div>
                </div>
    </div>
        
<?php require('Pie.php'); ?>
