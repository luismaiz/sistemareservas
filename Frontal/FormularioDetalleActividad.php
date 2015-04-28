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
                
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividad";
                var Params = 'idActividad='+ idActividad;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                $scope.actividad = JSON.parse(Ajax.responseText).actividad;
                //$scope.sala.CapacidadSala = parseInt($scope.sala.CapacidadSala);
        
            };
            if (typeof($location.search().idTipoAbono) !== "undefined")
                $scope.obtenerActividad($location.search().idTipoAbono);
            
            $scope.guardarActividad = function() {
                if (typeof($location.search().idTipoAbono) !== "undefined")
                    $scope.actualizarActividad();    
                else
                    $scope.crearActividad();            
        
            };
            
            $scope.actualizarActividad = function(){
                                   
             
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=actualizarActividad";
                var Params = 'idActividad='+ $location.search().idActividad +
                    '&NombreActividad='+ document.getElementById('NombreActividad').value +
                    '&IntensidadActividad='+ document.getElementById('IntensidadActividad').value +
                    '&Descripcion='+ document.getElementById('Descripcion').value +
                    '&Grupo='+ document.getElementById('Grupo').value +
                    '&EdadMinima='+ document.getElementById('EdadMinima').value +
                    '&EdadMaxima='+ document.getElementById('EdadMaxima').value +
                    '&FechaAlta='+ document.getElementById('FechaAlta').value +
                    '&FechaBaja='+ document.getElementById('FechaBaja').value;
               
                Ajax.open("PUT", Url, false);
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
       
    
    
                
    function crearActividad() {	        
        //alert("crear");
        //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=crearActividad";		
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=crearActividad";		        
	
        var Params = '&NombreActividad='+ document.getElementById('NombreActividad').value +
            '&IntensidadActividad='+ document.getElementById('IntensidadActividad').value +
            '&EdadMinima='+ document.getElementById('EdadMinima').value +
            '&EdadMaxima='+ document.getElementById('EdadMaxima').value +
            '&Grupo='+ document.getElementById('Grupo').value +
            '&Descripcion='+ document.getElementById('Descripcion').value +
            '&FechaAlta='+ document.getElementById('FechaAlta').value +
            '&FechaBaja='+ document.getElementById('FechaBaja').value;
		     
        //alert(Params);
		     
        Ajax.open("POST", Url, true);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        Ajax.send(Params); // Enviamos los datos
        
        mostrarRespuesta(Ajax.responseText);
    }
   
    function borrarActividad() {	
        //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=borrarActividad";	
        var Url = "http://localhost/sistemareservas/AdministradorBO.php?url=borrarActividad";		        
        var Params = 'idActividad='+ document.getElementById('idActividad').value;

	
        Ajax.open("DELETE", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
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
<div class=" row" ng-app="DetalleTipoAbono">
    <div ng_controller="CargaDetalleTipoAbono">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Detalle Actividad</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
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

                <form class="form-group" name="formulario">
                    <label class="control-label" >Nombre Actividad</label>
                    <input ng-model="actividad.idActividad" value = "" type="hidden" class="input-sm" name="idActividad" id="idActividad">                    
                    <input ng-model="actividad.NombreActividad" type="text" class="input-sm"  id="NombreActividad" name="NombreActividad"/><br><br>
                    <span style="color:red" ng-show="formulario.NombreActividad.$dirty && formulario.NombreActividad.$invalid">
                                <span ng-show="formulario.NombreActividad.$error.required">Nombre de actividad obligatorio.</span>
                    </span>
                    
                    <label class="control-label" >Descripcion</label>
                    <input ng-model="actividad.DescripcionActividad" type="color" class="input-sm" id="Descripcion" name="Descripcion"/><br><br>
                    <span style="color:red" ng-show="formulario.Descripcion.$dirty && formulario.Descripcion.$invalid">
                                <span ng-show="formulario.Descripcion.$error.required">Descripción de actividad obligatorio.</span>
                    </span>
                    
                    <label class="control-label" >Intensidad Actividad</label>
                    <input type="color" class="input-sm"  id="IntensidadActividad" name="IntensidadActividad"/><br><br>
                    <span style="color:red" ng-show="formulario.IntensidadActividad.$dirty && formulario.IntensidadActividad.$invalid">
                                <span ng-show="formulario.IntensidadActividad.$error.required">Intensidad de actividad obligatorio.</span>
                    </span>

                    <label class="control-label" >Edad Mínima</label>
                    <input type="number" class="input-sm" name="EdadMinima" id="EdadMinima"/>
                    <span style="color:red" ng-show="formulario.EdadMinima.$dirty && formulario.EdadMinima.$invalid">
                                <span ng-show="formulario.EdadMinima.$error.required">Edad mínima debe ser un valor numérico</span>
                    </span>

                    <label class="control-label" >Edad Máxima</label>
                    <input type="number" class="input-sm" name="EdadMaxima" id="EdadMaxima"/>
                    <span style="color:red" ng-show="formulario.EdadMaxima.$dirty && formulario.EdadMaxima.$invalid">
                                <span ng-show="formulario.EdadMaxima.$error.required">Edad máxima debe ser un valor numérico</span>
                    </span>

                    <label class="control-label" >Grupo</label>
                    <input type="text" class="input-sm" id="Grupo" name="Grupo"/><br><br>
                    
                    <label class="control-label" >Fecha Alta</label>
                    <input type="date" class="input-sm" name="FechaAlta" id="FechaAlta"/>

                    <label class="control-label" >Fecha Baja</label>
                    <input type="date" class="input-sm" name="FechaBaja" id="FechaBaja"/>

                    <input class="box btn-primary" type="button" value="Cancelar" onClick=" window.location.href='Actividades.php' " />
                    <input class="box btn-primary" type="button" value="Aceptar" ng-click="guardarActividad()"/>
                </form>
            </div>
        </div>


    </div>
    </div>
</div>

<?php require('Pie.php'); ?>
