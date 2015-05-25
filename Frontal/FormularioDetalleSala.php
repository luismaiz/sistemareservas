<?php 
header('Content-Type: application/json; charset=UTF-8');
require('Cabecera.php'); ?> 
<script>
           
            var Ajax = new AjaxObj();
            var app = angular.module('DetalleSala', [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
                
            function CargaDetalleSala($scope, $http, $location) {
       
            $scope.sala = [];
            $scope.estado = [];
            $scope.msg = [];
            $scope.obtenerSalas = function(idSala) {
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSala');
                var Params = 'idSala='+ idSala;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                    alert(Ajax.responseText);
                $scope.sala = JSON.parse(Ajax.responseText).sala;
                $scope.sala.CapacidadSala = parseInt($scope.sala.CapacidadSala);
                
                //alert(Ajax.responseText);
                
                if ($scope.sala.FechaBaja !== "01-01-1970")
                {
                    document.getElementById('divBaja').style.display = 'block';
                    document.getElementById('activar').style.display = 'inline';
                }
                else
                {
                    $scope.sala.FechaBaja = null;
                    document.getElementById('anular').style.display = 'inline';
                    document.getElementById('aceptar').style.display = 'inline';
                     document.getElementById('activar').style.display = 'none';
                }
            };
            
            if (typeof($location.search().idSala) !== "undefined")
            {
                $scope.obtenerSalas($location.search().idSala);
            }
            else
            {
                document.getElementById('aceptar').style.display = 'inline';
            }
            
                
            
            $scope.guardarSala = function() {
                if (typeof($location.search().idSala) !== "undefined")
                    $scope.actualizarSala();    
                else
                    $scope.crearSala();            
        
            };
            
            $scope.crearSala = function() {
                                
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/SalasBO.php?url=crearSala');		
                	
//                   //alert(accentEncode(document.getElementById('NombreSala').value));     
                var Params ='NombreSala='+ document.getElementById('NombreSala').value +
                    '&CapacidadSala='+ document.getElementById('CapacidadSala').value +
                    '&DescripcionSala='+ document.getElementById('DescripcionSala').value;

                
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
               
                Ajax.send(Params); // Enviamos los datos
                alert(Ajax.responseText);
                
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    
                    //$scope.obtenerSalas($location.search().idSala);
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
        
        
        
     
        
            };

            $scope.actualizarSala = function(){
               
               
                  
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/SalasBO.php?url=actualizarSala');
                var Params = 'idSala='+ $location.search().idSala +
                    '&NombreSala='+ document.getElementById('NombreSala').value +
                    '&CapacidadSala='+ document.getElementById('CapacidadSala').value +
                    '&DescripcionSala='+ document.getElementById('DescripcionSala').value;
               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    $scope.obtenerSalas($location.search().idSala);
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            
            };
            
            
            $scope.anularSala = function(){
                
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/SalasBO.php?url=anularSala');
                var Params = 'idSala='+ $location.search().idSala;
                
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                //alert(Ajax.responseText);    
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divBaja').style.display = 'inline';
                    document.getElementById('divCorrecto').style.display = 'block';
                    $scope.obtenerSalas($location.search().idSala);
                    document.getElementById('anular').style.display = 'none';
                    document.getElementById('aceptar').style.display = 'none';
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            
            $scope.activarSala = function(){
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/SalasBO.php?url=activarSala');
                var Params = 'idSala='+ $location.search().idSala;
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                //alert(Ajax.responseText);
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    document.getElementById('divBaja').style.display = 'none';
                    $scope.obtenerSalas($location.search().idSala);
                    document.getElementById('anular').style.display = 'inline';
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
                $( "#FechaAlta" ).datepicker({
                    dateFormat:'dd-mm-yy'
                });
            });
            
            $(function() {
                $( "#FechaBaja" ).datepicker({
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
            <a href="Salas.php">Salas</a>
        </li>
        <li>
            <a href="#">Detalle Sala</a>
        </li>
    </ul>
</div>
<div class=" row" ng-app="DetalleSala">
<div ng_controller="CargaDetalleSala">
<div class="box col-md-12">
                        <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Detalle Sala</h2>
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
                                    <strong>Esta sala se encuentra dada de baja.</strong>
                            </div>
                            </div>
                        <div class="box-content">
                            <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                            <form role="form"  name="formulario">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                 <input ng-model="sala.idSala" type="hidden" class="input-sm" name="idSala" id="idSala">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Nombre Sala</label>
                                <input ng-disabled="sala.FechaBaja!==null"  type="text" ng-model="sala.NombreSala"   class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="nombresala" id="NombreSala" required >
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.nombresala.$dirty && formulario.nombresala.$invalid">
                                <span ng-show="formulario.nombresala.$error.required">* Nombre de sala obligatorio.</span>
                                 </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Descripción</label>
                                <input ng-disabled="sala.FechaBaja!==null" type="text" ng-model="sala.DescripcionSala"  class="input-sm col-lg-8 col-md-8 col-sm-10 col-xs-12"  name="descripcionsala" id="DescripcionSala" required>
                                <span class="col-lg-2 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.descripcionsala.$dirty && formulario.descripcionsala.$invalid">
                                <span ng-show="formulario.descripcionsala.$error.required">* Descripción de sala obligatorio.</span>
                                </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">                                
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Capacidad</label>
                                <input ng-disabled="sala.FechaBaja!==null" type="text" ng-model="sala.CapacidadSala"  class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" name="capacidadsala" id="CapacidadSala" required ng-pattern="/^\d+$/"  >
                                <span  class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.capacidadsala.$dirty && formulario.capacidadsala.$invalid">
                                    <span ng-show="formulario.capacidadsala.$error.required">* Capacidad de sala obligatoria.</span>
                                    <span ng-show="formulario.capacidadsala.$error.pattern">* Capacidad de sala numérica.</span>
                                </span>
                                </div>
                                <div  class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Fecha Alta</label>
                                <input id="FechaAlta" ng_disabled="true" ng-model="sala.FechaAlta" type="text" class="input-sm col-md-2 col-sm-4 col-xs-7" name="FechaAlta">
                                </div>
                                <div  class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Fecha Baja</label>
                                <input id="FechaBaja" ng_disabled="true" ng-model="sala.FechaBaja" type="text" class="input-sm col-md-2 col-sm-4 col-xs-7" name="FechaBaja">
                                </div>
                                <input style='display:none;' id="anular" class="btn btn-sm btn-danger" type="submit" value="Anular" ng-click="anularSala();"/>
                                <input style='display:none;' id="aceptar" class="btn btn-sm btn-success" type="submit" value="Aceptar" ng-click="guardarSala();" ng-disabled="formulario.$invalid" />
                                <input style='display:none;' id="activar" class="btn btn-sm btn-action" type="submit" value="Activar" ng-click="activarSala();"/>
                                <input class="btn btn-sm btn-action" type="button" value="Cancelar" onClick=" window.location.href='Salas.php' " />
                             
                             </form>
                           </div>  
                        </div>
                            </div>
                        </div>
                        </div>
                        </div>
                </div>
    </div>
                       


        
<?php require('Pie.php'); ?>
