<?php require('Cabecera.php'); ?> 
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
                
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSala";
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSala";
                var Params = 'idSala='+ idSala;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                    
                    
                $scope.sala = JSON.parse(Ajax.responseText).sala;
                $scope.sala.CapacidadSala = parseInt($scope.sala.CapacidadSala);
        
            };
            if (typeof($location.search().idSala) !== "undefined")
                $scope.obtenerSalas($location.search().idSala);
            
            $scope.guardarSala = function() {
                if (typeof($location.search().idSala) !== "undefined")
                    $scope.actualizarSala();    
                else
                    $scope.crearSala();            
        
            };
            
            $scope.crearSala = function() {
                                
                //var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/SalasBO.php?url=crearSala";		
                var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=crearSala";		
                var Params ='NombreSala='+ document.getElementById('NombreSala').value +
                    '&CapacidadSala='+ document.getElementById('CapacidadSala').value +
                    '&DescripcionSala='+ document.getElementById('DescripcionSala').value +
                    '&FechaAlta='+ document.getElementById('FechaAlta').value +
                    '&FechaBaja='+ document.getElementById('FechaBaja').value;

                
                Ajax.open("POST", Url, true);
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
//            
            $scope.actualizarSala = function(){
                                   
             
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/SalasBO.php?url=actualizarSala";
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=actualizarSala";
                var Params = 'idSala='+ $location.search().idSala +
                    '&NombreSala='+ document.getElementById('NombreSala').value +
                    '&CapacidadSala='+ document.getElementById('CapacidadSala').value +
                    '&DescripcionSala='+ document.getElementById('DescripcionSala').value +
                    '&FechaAlta='+ document.getElementById('FechaAlta').value +
                    '&FechaBaja='+ document.getElementById('FechaBaja').value;

               
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
                       
        </script>
       
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
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
                            </div>
                        <div class="box-content">
                            <form role="form"  name="formulario">
                                <div class="form-group col-md-12">
                                 <input ng-model="sala.idSala" type="hidden" class="input-sm" name="idSala" id="idSala">
                                <label class="control-label col-md-2" >Nombre Sala</label>
                                <input ng-model="sala.NombreSala"  type="text" class="input-sm col-md-4" name="nombresala" id="NombreSala" required >
                                <span style="color:red" ng-show="formulario.nombresala.$dirty && formulario.nombresala.$invalid">
                                <span ng-show="formulario.nombresala.$error.required">Nombre de sala obligatorio.</span>
                                 </span>
                                </div>
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Descripción</label>
                                <input ng-model="sala.DescripcionSala" type="text" class="input-sm col-md-6"  name="descripcionsala" id="DescripcionSala" required>
                                <span style="color:red" ng-show="formulario.descripcionsala.$dirty && formulario.descripcionsala.$invalid">
                                <span ng-show="formulario.descripcionsala.$error.required">Descripción de sala obligatorio.</span>
                                </span>
                                </div>
                                <div class="form-group col-md-12">                                
    
                                <label class="control-label col-md-2" >Capacidad</label>
                                <input ng-model="sala.CapacidadSala" type="number" class="input-sm" name="capacidadsala" id="CapacidadSala" required>
                                <span style="color:red" ng-show="formulario.capacidadsala.$dirty && formulario.capacidadsala.$invalid">
                                <span ng-show="formulario.capacidadsala.$error.required">Capacidad de sala obligatoria y numérica.</span>
                                </span>
                                </div>
                                <div class="form-group col-md-12">
                                
                                <label class="control-label col-md-2" >Fecha Alta</label>
                                <input ng-model="sala.FechaAlta" type="date" class="input-sm" name="FechaAlta" id="FechaAlta">
                                </div>
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Fecha Baja</label>
                                <input ng-model="sala.FechaBaja" type="date" class="input-sm" name="FechaBaja" id="FechaBaja">                                     
                                </div>
                                
                                <input class="box btn-primary" type="button" value="Cancelar" onClick=" window.location.href='Salas.php' " />
                                <input class="box btn-primary" type="submit" value="Aceptar" ng-click="guardarSala();" ng-disabled="formulario.$invalid" />
                                
                             </form>
                           </div>                                         
                        </div>
                        </div>
                </div>
    </div>
                       


        
<?php require('Pie.php'); ?>
