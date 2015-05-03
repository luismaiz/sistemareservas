<?php require('Cabecera.php'); ?>
<script>
    var Ajax = new AjaxObj();
    
    var Ajax = new AjaxObj();
    var app = angular.module('BusquedaActividades', []);
    
    function CargaActividades($scope, $http) {
            
            $scope.actividades = [];

            $scope.obtenerActividades = function() {
                
                
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividadesFiltro";
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividadesFiltro";
                var Params = 'NombreActividad=' + document.getElementById("filtroactividad").value + 
                        '&IntensidadActividad=' + document.getElementById("filtrointensidad").value +    
                        '&Grupo=' + document.getElementById("filtrogrupo").value;        
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                                       
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    $scope.actividades = JSON.parse(Ajax.responseText).actividades;    
                    document.getElementById('divSinResultados').style.display = 'none';
                }
                else
                {
                    $scope.actividades = [];
                    document.getElementById('divSinResultados').style.display = 'block';
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
            <a href="#">Actividades</a>
        </li>
    </ul>
</div>
<div class=" row" ng-app="BusquedaActividades">
    <div ng_controller="CargaActividades">
        <div class="box col-md-12">
                        <div class="box-inner">
                            <div class="box-header well" data-original-title="">
                                <h2><i class="glyphicon glyphicon-edit"></i> Buscador Actividades</h2>
                            </div>
                                <div class="alert alert-info" id="divSinResultados" style='display:none;'>
                                    <strong></strong>No se han encontrado resultados para los filtros introducidos.
                                </div>
                            
                            <div class="box-content">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label" >Actividad</label>
                                                <input type="text" class="input-sm"  id="filtroactividad">
                                                <label class="control-label" >Intensidad</label>
                                                <input type="text" class="input-sm"  id="filtrointensidad">
                                                <label class="control-label" >Grupo</label>
                                                <input type="text" class="input-sm"  id="filtrogrupo">
                                                <input class="box btn-primary" type="button" value="Buscar" ng_click="obtenerActividades();"/>
                                                 <div class="box-content" id="actividades">
                                        <table class="table table-striped table-bordered responsive">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Descripción</th>
                                                    <th>Intensidad</th>
                                                    <th>Edad Mínima</th>
                                                    <th>Edad Máxima</th>
                                                    <th></th>
                                                    
                                                </tr>
                                                <tr ng_repeat="actividad in actividades">
                                                    <td>{{actividad.NombreActividad}}</td>
                                                    <td>{{actividad.Descripcion}}</td>
                                                    <td>{{actividad.IntensidadActividad}}</td>
                                                    <td>{{actividad.EdadMinima}}</td>
                                                    <td>{{actividad.EdadMaxima}}</td>
                                                    <td class="center"><a href="FormularioDetalleActividad.php?idActividad={{actividad.idActividad}}" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a></td>
                                                </tr>
                                            </thead>
                                        </table>
                                                     <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetalleActividad.php' "/>
                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                               </div>
                            </div>
                        </div>
            </div>
                       
        </div>
</div>

<?php require('Pie.php'); ?>
