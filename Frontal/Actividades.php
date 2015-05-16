<?php require('Cabecera.php'); ?>
<script>
    var Ajax = new AjaxObj();
    
    var Ajax = new AjaxObj();
    var app = angular.module('BusquedaActividades',  ["ngStorage"])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
    
    function CargaActividades($scope, $http,$location,$localStorage) {
            
            $scope.actividades = [];
                
            $scope.obtenerActividades = function() {
                
                $scope.filtrosActividades = [{filtroactividad:document.getElementById("filtroactividad").value,
                                    filtrointensidad:document.getElementById("filtrointensidad").value,
                                    filtrogrupo:document.getElementById("filtrogrupo").value}
                    ];
                localStorage.setItem('filtrosActividades', JSON.stringify($scope.filtrosActividades));
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividadesFiltro');
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
                    localStorage.setItem('actividades', JSON.stringify($scope.actividades));
                    document.getElementById('divSinResultados').style.display = 'none';
                }
                else
                {
                    $scope.actividades = [];
                    document.getElementById('divSinResultados').style.display = 'block';
                }
        
            };
            
            if (typeof($location.search().detalle) !== "undefined")
            {
            $scope.resultado = localStorage.getItem('actividades');
            $scope.filtrosActividades = localStorage.getItem('filtrosActividades');
            $scope.actividades = (localStorage.getItem('actividades')!==null) ? JSON.parse($scope.resultado) : JSON.parse(Ajax.responseText).actividades;
            
            document.getElementById("filtroactividad").value = JSON.parse($scope.filtrosActividades)[0].filtroactividad;
            document.getElementById("filtrointensidad").value = JSON.parse($scope.filtrosActividades)[0].filtrointensidad;
            document.getElementById("filtrogrupo").value = JSON.parse($scope.filtrosActividades)[0].filtrogrupo;
            
            $scope.obtenerActividades();
            }    
$(function () {
                $('.footable').footable();
                });
}
    
</script>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="Inicio.php">Inicio</a>
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
                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Actividad</label>
                                                <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12"  id="filtroactividad">
                                                <label ng_show="false" class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Intensidad</label>
                                                <input ng_show="false" type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12"  id="filtrointensidad">
                                                <label ng_show="false" class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Grupo</label>
                                                <input ng_show="false" type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12"  id="filtrogrupo">
                                            </div>
                                                <input class="box btn-primary" type="button" value="Buscar" ng_click="obtenerActividades();"/>
                                                 <div class="box-content" id="actividades">
                                        <table class="footable table-striped table-bordered responsive" data-page-size="5" data-page-navigation=".pagination" id="tabla">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Descripción</th>
                                                    <th>Intensidad</th>
                                                    <th data-type="numeric">Edad Mínima</th>
                                                    <th data-type="numeric">Edad Máxima</th>
                                                    <th data-sort-ignore="true"></th>
                                                    
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr ng_repeat="actividad in actividades">
                                                    <td>{{actividad.NombreActividad}}</td>
                                                    <td>{{actividad.Descripcion}}</td>
                                                    <td >
                                                        <div ng-model="actividad.IntensidadActividad" ng-style="{'color' : actividad.IntensidadActividad}"></div>
                                                    </td>
                                                    <td>{{actividad.EdadMinima}}</td>
                                                    <td>{{actividad.EdadMaxima}}</td>
                                                    <td class="center"><a target="_self" href="FormularioDetalleActividad.php?idActividad={{actividad.idActividad}}" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a>
                                                    <a target="_self" ng_show="actividad.FechaBaja!==null"  class="btn btn-danger">Anulada</a></td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="hide-if-no-paging">
                                                    <tr>
                                                        <td colspan="7" class="text-center">
                                                            <ul class="pagination pagination-centered">

                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            
                                        </table>
                                                 </div>
                                        <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetalleActividad.php' "/>
                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                               </div>
                            </div>
                        </div>

      

<?php require('Pie.php'); ?>
