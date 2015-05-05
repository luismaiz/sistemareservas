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
                               
                $scope.abonodiario = JSON.parse(Ajax.responseText).abonodiario;
                
                if ($scope.abonodiario.Gestionado=== '0')
                {
                    document.getElementById('divPendiente').style.display = 'block';
                    document.getElementById('validacion').style.display = 'inline';
                }
        
            };
            if (typeof($location.search().idSolicitud) !== "undefined")
                $scope.obtenerSolicitudAbonoDiario($location.search().idSolicitud);
            
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
                            </div>
                        <div class="box-content">
                            <form role="form"  name="formulario">
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Localizador</label>
                                <input ng-model="abonodiario.Localizador"  type="text" class="input-sm col-md-4" name="localizador" id="Localizador" required >
                                <span style="color:red" ng-show="formulario.localizador.$dirty && formulario.localizador.$invalid">
                                <span ng-show="formulario.localizador.$error.required">Localizador obligatorio.</span>
                                 </span>
                                </div>
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Fecha Solicitud</label>
                                <input ng-model="abonodiario.FechaSolicitud" type="text" class="input-sm col-md-2 col-sm-4 col-xs-4" name="FechaSolicitud" id="FechaSolicitud" ng-pattern="/^(0?[1-9]|[12][0-9]|3[01])\-(0?[1-9]|1[012])\-(199\d|[2-9]\d{3})$/" required>
                                <span class="col-md-6 col-sm-5 col-XS-12" style="color:red" ng-show="formulario.FechaSolicitud.$dirty && formulario.FechaSolicitud.$invalid">
                                     <span ng-show="formulario.FechaSolicitud.$error.pattern">* Formato de fecha no valido.</span>
                                    <span ng-show="formulario.FechaSolicitud.$error.required">* Fecha obligatoria.</span>
                                </span>
                                </div>
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Nombre</label>
                                <input ng-model="abonodiario.Nombre"  type="text" class="input-sm col-md-4" name="nombre" id="Nombre" required >
                                <span style="color:red" ng-show="formulario.nombre.$dirty && formulario.nombre.$invalid">
                                <span ng-show="formulario.nombre.$error.required">Nombre obligatorio.</span>
                                 </span>
                                </div>
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Apellidos</label>
                                <input ng-model="abonodiario.Apellidos" type="text" class="input-sm col-md-6"  name="apellidos" id="Apellidos" required>
                                <span style="color:red" ng-show="formulario.apellidos.$dirty && formulario.apellidos.$invalid">
                                <span ng-show="formulario.apellidos.$error.required">Apellidos obligatorio.</span>
                                </span>
                                </div>
                                <div class="form-group col-md-12">                                
                                <label class="control-label col-md-2" >Email</label>
                                <input ng-model="abonodiario.Email" type="email" class="input-sm" name="mail" id="Mail" required >
                                <span style="color:red" ng-show="formulario.mail.$dirty && formulario.mail.$invalid">
                                <span ng-show="formulario.mail.$error.required">Email obligatorio.</span>
                                <span ng-show="formulario.mail.$error.email">Formato de email no válido.</span>
                                </span>
                                </div>
                                <div class="form-group col-md-12">                                
                                <label class="control-label col-md-2" >Dni</label>
                                <input ng-model="abonodiario.DNI" type="text" class="input-sm" name="dni" id="Dni" required ng-pattern='/^\d{7,8}(-?[a-z])?$/i'>
                                <span style="color:red" ng-show="formulario.dni.$dirty && formulario.dni.$invalid">
                                    <span ng-show="formulario.dni.$error.required">DNI obligatorio.</span>
                                <span ng-show="formulario.dni.$error.pattern">Formato de DNI no válido 12345678-A</span>
                                </span>
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
