<?php require('Cabecera.php'); ?>
<script>
 var Ajax = new AjaxObj();

var app = angular.module('BusquedaTiposSolicitudes', ["ngStorage"])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });

function CargaTiposSolicitudes($scope, $http,$location,$localStorage) {
    
    $scope.tipossolicitudes = [];
    
        
    $scope.obtenerTiposSolicitudes = function() {
        
                $scope.filtrosSolicitudes = [{filtronombresolicitud:document.getElementById("filtronombresolicitud").value,
                                    filtrodescripcionsolicitud:document.getElementById("filtrodescripcionsolicitud").value}
                    ];
                localStorage.setItem('filtrosSolicitudes', JSON.stringify($scope.filtrosSolicitudes));
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=obtenerTiposSolicitudesFiltro');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=obtenerTiposSolicitudesFiltro";
                
                var Params = 'NombreSolicitud=' + document.getElementById("filtronombresolicitud").value + '&DescripcionSolicitud=' + document.getElementById("filtrodescripcionsolicitud").value;    
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
	
                
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    $scope.tipossolicitudes = JSON.parse(Ajax.responseText).tipossolicitudes;
                    localStorage.setItem('tipossolicitudes', JSON.stringify($scope.tipossolicitudes));
                    document.getElementById('divSinResultados').style.display = 'none';
                }
                else
                {
                    $scope.tipossolicitudes = [];
                    document.getElementById('divSinResultados').style.display = 'block';
                }
        
            };
            
            if (typeof($location.search().detalle) !== "undefined")
            {
            $scope.resultado = localStorage.getItem('tipossolicitudes');
            $scope.filtrosSolicitudes = localStorage.getItem('filtrosSolicitudes');
            $scope.tipossolicitudes = (localStorage.getItem('tipossolicitudes')!==null) ? JSON.parse($scope.resultado) : JSON.parse(Ajax.responseText).tipossolicitudes;
            
            document.getElementById("filtronombresolicitud").value = JSON.parse($scope.filtrosSolicitudes)[0].filtronombresolicitud;
            document.getElementById("filtrodescripcionsolicitud").value = JSON.parse($scope.filtrosSolicitudes)[0].filtrodescripcionsolicitud;
            
            $scope.obtenerTiposSolicitudes();
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
            <a href="#">Tipo de Solicitud</a>
        </li>
    </ul>
</div>
<div class=" row"ng-app="BusquedaTiposSolicitudes">
    <div ng_controller="CargaTiposSolicitudes">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-edit"></i> Buscador Tipos de Solicitud</h2>
                </div>
                 <div class="alert alert-info" id="divSinResultados" style='display:none;'>
                    <strong></strong>No se han encontrado resultados para los filtros introducidos.
                </div>
                <div class="box-content">
                     <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                       <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Nombre Solicitud</label>
                                        <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12"  id="filtronombresolicitud">	
                                        <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Descripción Solicitud</label>
                                        <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12"  id="filtrodescripcionsolicitud">
                                </div>
                               
                                        <input class="box btn-primary" type="button" value="Buscar" ng_click="obtenerTiposSolicitudes()"/>
                                       
                                <div class="box-content" id="tipossolicitudes">
                                     
                                       <table class="footable table-striped table-bordered responsive" data-page-size="5" data-page-navigation=".pagination" id="tabla">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</h6></th>
                                                    <th>Descripcion</th>
                                                    <th>Fecha Alta</th>
                                                    <th>Fecha Baja</th>
                                                    <th data-sort-ignore="true"></th>
                                                    
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr ng_repeat="tiposolicitud in tipossolicitudes">
                                                    <td>{{tiposolicitud.NombreSolicitud}}</td>
                                                    <td>{{tiposolicitud.DescripcionSolicitud}}</td>
                                                    <td>{{tiposolicitud.FechaAlta |date:'dd-MM-yyyy'}}</td>
                                                    <td>{{tiposolicitud.FechaBaja |date:'dd-MM-yyyy'}}</td>
                                                    <td class="center"><a target="_self" href="FormularioDetalleTipoSolicitud.php?idTipoSolicitud={{tiposolicitud.idTipoSolicitud}}" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a>
                                                    <a target="_self" ng_show="tiposolicitud.FechaBaja!==null"  class="btn btn-danger">Anulada</a></td>
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
                                
                                <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetalleTipoSolicitud.php' "/>
                             
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
                      
</div>


<?php require('Pie.php'); ?>
