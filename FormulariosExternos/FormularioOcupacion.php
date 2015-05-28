<?php require('CabeceraExterna.php'); ?>
<!-- inline scripts related to this page -->
<script type="text/javascript">
    var Ajax = new AjaxObj();
    
    var app = angular.module('formularioOcupacion',  [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
                      
    function FormularioOcupacionController($scope, $http,$location) {
                $scope.obtenerActividades = function() {
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividadesFiltro');
                var Params = 'NombreActividad=' + '' + '&IntensidadActividad=' + '' + '&Grupo=' + '';    
                
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    $scope.actividades = JSON.parse(Ajax.responseText).actividades;
                }
                else
                {
                    $scope.actividades = [];
                }
            };
                $scope.obtenerActividades();
			
		$scope.obtenerSalas = function() {
		var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSalasFiltro');
                var Params = 'NombreSala=' + '' + '&CapacidadSala=' + '';    
                
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); 
				
				if ($scope.estado === 'correcto')
    				{
                                
				$scope.salas = JSON.parse(Ajax.responseText).salas;
				}
            };
                $scope.obtenerSalas();
                
                $scope.obtenerClase = function(idClase) {
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ClasesBO.php?url=obtenerClase');

                //var Url = "localhost/sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividadesFiltro";
                var Params = '&idClase=' + idClase;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                $scope.clase  = JSON.parse(Ajax.responseText).clase;

                if ($scope.estado === 'correcto')
                {
                    document.getElementById('Ocupacion').style.color = '#'+$scope.clase;
                    $('#Ocupacion').css('color', '#'+$scope.clase);
                    $scope.clase = JSON.parse(Ajax.responseText).clase;    
                }
            };
                $scope.obtenerClase($location.search().idClase);
     }
    
 </script>

        <div class="row" ng-app="formularioOcupacion" ng-controller="FormularioOcupacionController">
            <div id="maininner" class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-sm-offset-1">
                <section id="content"><div id="system-message-container">
                    </div>
                    <div id="system">
                        <h2>Información Clase</h2>
                        <form class="submission box style" name="ocupacion" novalidate>
                            <fieldset>
                                <div class="form-group has-success has-feedback">
                                    <div class="width-100 col-md-12 col-sm-12 input-group-lg">
                                        <label class="control-label" >Ocupacion</label>                                        
                                        <input class="form-control color" id="Ocupacion" name="Ocupacion" ng-model="clase.Ocupacion" readonly ng-disabled="true"/>
                                        
                                    </div>
                                    <div class="col-md-12 col-sm-12 input-group-lg">
                                    <div class="col-md-6 col-sm-6 input-group-lg">
                                        <label class="control-label" >Actividad</label>
                                         <select ng-disabled="true" name="idActividad" id="idActividad" class="col-md-6 col-sm-6 input-group-lg form-control" >	
                                            <option ng_repeat="actividad in actividades" ng_selected="{{clase.idActividad}} === null ? {{actividad.idActividad}} === {{clase.idActividad}} : {{actividad.idActividad}} === {{clase.idActividad}}" value="{{actividad.idActividad}}">{{actividad.NombreActividad}}</option>-
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 input-group-lg">
                                        <label class="control-label" >Sala</label>
                                        <select ng-disabled="true" name="idSala" id="idSala" class="col-md-6 col-sm-6 input-group-lg form-control" >	
                                            <option ng_repeat="sala in salas" ng_selected="{{clase.idSala}} === null ? {{sala.idSala}} === {{clase.idSala}} : {{sala.idSala}} === {{clase.idSala}}" value="{{sala.idSala}}">{{sala.NombreSala}}</option>-
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 input-group-lg">
                                        <label class="control-label" > Fecha Inicio </label>                                        
                                        <input  ng-disabled="true" ng-model="clase.FechaInicio"  type="text" class="col-lg-4 col-md-4 col-sm-4 form-control" id="FechaInicio" ng-model="clase.FechaInicio" readonly/>
                                        <br>
                                    </div>
                                    <div class="col-md-6 col-sm-6 input-group-lg">
                                        <label class="control-label" >Fecha Fin</label>
                                        <input ng-disabled="true" ng-model="clase.FechaFin" type="text" class="col-lg-4 col-md-4 col-sm-4 form-control" ng-model="clase.FechaFin" readonly/>
                                    </div>
                                    </div>
                                  
                                </div>
                            </fieldset>      
                        </form>
                    </div>
                </section>
            </div>  
        </div>
        <?php
require_once('PieExterno.php');
?>