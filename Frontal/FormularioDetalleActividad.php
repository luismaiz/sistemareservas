<?php require('Cabecera.php'); ?>
<script>
           
    var Ajax = new AjaxObj();
    
    var app = angular.module('DetalleActividad', [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
    
    function CargaDetalleActividad($scope, $http, $location) {
        
        $scope.actividad = [];
        $scope.estado = [];
        
        $scope.obtenerActividad = function(idActividad) {
                
                //var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividad";
                var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividad";
                var Params = 'idActividad='+ idActividad;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                $scope.actividad = JSON.parse(Ajax.responseText).actividad;
                //$scope.sala.CapacidadSala = parseInt($scope.sala.CapacidadSala);
        
            };
            if (typeof($location.search().idActividad) !== "undefined")
                $scope.obtenerActividad($location.search().idActividad);
            
            $scope.guardarActividad = function() {
                if (typeof($location.search().idActividad) !== "undefined")
                    $scope.actualizarActividad();    
                else
                    $scope.crearActividad();            
        
            };
            
            $scope.actualizarActividad = function(){
                                   
             
                //var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=actualizarActividad";
                var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/ActividadesBO.php?url=actualizarActividad";
                var Params = 'idActividad='+ $location.search().idActividad +
                    '&NombreActividad='+ document.getElementById('NombreActividad').value +
                    '&IntensidadActividad='+ document.getElementById('IntensidadActividad').value +
                    '&Descripcion='+ document.getElementById('Descripcion').value +
                    '&Grupo='+ document.getElementById('Grupo').value +
                    '&EdadMinima='+ document.getElementById('EdadMinima').value +
                    '&EdadMaxima='+ document.getElementById('EdadMaxima').value +
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
            
            $scope.crearActividad = function(){
                                   
             
                //var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=crearActividad";
                var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/ActividadesBO.php?url=crearActividad";
                var Params = 'NombreActividad='+ document.getElementById('NombreActividad').value +
                    '&IntensidadActividad='+ document.getElementById('IntensidadActividad').value +
                    '&Descripcion='+ document.getElementById('Descripcion').value +
                    '&Grupo='+ document.getElementById('Grupo').value +
                    '&EdadMinima='+ document.getElementById('EdadMinima').value +
                    '&EdadMaxima='+ document.getElementById('EdadMaxima').value +
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
            <a href="Actividades.php">Actividades</a>
        </li>
        <li>
            <a href="#">Detalle Actividad</a>
        </li>
    </ul>
</div>
<div class=" row" ng-app="DetalleActividad">
    <div ng_controller="CargaDetalleActividad">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Detalle Actividad</h2>
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
                    <label class="control-label col-md-2" >Nombre Actividad</label>
                    <input ng-model="actividad.idActividad" type="hidden" class="input-sm col-md-4" name="idActividad" id="idActividad">                    
                    <input ng-model="actividad.NombreActividad" type="text" class="input-sm"  id="NombreActividad" name="NombreActividad" required/>
                    <span style="color:red" ng-show="formulario.NombreActividad.$dirty && formulario.NombreActividad.$invalid">
                                <span ng-show="formulario.NombreActividad.$error.required">Nombre de actividad obligatorio.</span>
                    </span>
                    </div>
                    <div class="form-group col-md-12">
                    <label class="control-label col-md-2" >Descripcion</label>
                    <input ng-model="actividad.DescripcionActividad" type="text" class="input-sm col-md-6" id="Descripcion" name="Descripcion" required/>
                    <span style="color:red" ng-show="formulario.Descripcion.$dirty && formulario.Descripcion.$invalid">
                                <span ng-show="formulario.Descripcion.$error.required">Descripción de actividad obligatorio.</span>
                    </span>
                    </div>
                    <div class="form-group col-md-12">
                    <label class="control-label col-md-2" >Intensidad Actividad</label>
                    <input ng-model="actividad.IntensidadActividad" type="color" class="input-sm"  id="IntensidadActividad" name="IntensidadActividad" required/>
                    <span style="color:red" ng-show="formulario.IntensidadActividad.$dirty && formulario.IntensidadActividad.$invalid">
                                <span ng-show="formulario.IntensidadActividad.$error.required">Intensidad de actividad obligatorio.</span>
                    </span>
                    </div>    
                    <div class="form-group col-md-12">
                    <label class="control-label col-md-2" >Edad Mínima</label>
                    <input ng-model="actividad.EdadMinima" type="number" class="input-sm" name="EdadMinima" id="EdadMinima"/>
                    <span style="color:red" ng-show="formulario.EdadMinima.$dirty && formulario.EdadMinima.$invalid">
                                <span ng-show="formulario.EdadMinima.$error.required">Edad mínima debe ser un valor numérico</span>
                    </span>
                    </div>    
                    <div class="form-group col-md-12">
                    <label class="control-label col-md-2" >Edad Máxima</label>
                    <input ng-model="actividad.EdadMaxima" type="number" class="input-sm" name="EdadMaxima" id="EdadMaxima"/>
                    <span style="color:red" ng-show="formulario.EdadMaxima.$dirty && formulario.EdadMaxima.$invalid">
                                <span ng-show="formulario.EdadMaxima.$error.required">Edad máxima debe ser un valor numérico</span>
                    </span>
                    </div>
                    <div class="form-group col-md-12">
                    <label class="control-label col-md-2" >Grupo</label>
                    <input ng-model="actividad.Grupo" type="text" class="input-sm" id="Grupo" name="Grupo"/>
                    </div>
                    <div class="form-group col-md-12">
                    <label class="control-label col-md-2" >Fecha Alta</label>
                    <input ng-model="actividad.FechaAlta" type="date" class="input-sm" name="FechaAlta" id="FechaAlta"/>
                    </div>    
                    <div class="form-group col-md-12">
                    <label class="control-label col-md-2" >Fecha Baja</label>
                    <input ng-model="actividad.FechaBaja" type="date" class="input-sm" name="FechaBaja" id="FechaBaja"/>
                    </div>
                    
                    <input class="box btn-primary" type="button" value="Cancelar" onClick=" window.location.href='Actividades.php' " />
                    <input class="box btn-primary" type="button" value="Aceptar" ng-click="guardarActividad()"/>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>

<?php require('Pie.php'); ?>
