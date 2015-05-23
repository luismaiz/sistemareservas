<?php require('Cabecera.php'); ?>
<script>
 var Ajax = new AjaxObj();

var app = angular.module('BusquedaTiposSolicitudes', ["ngStorage"])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      })
                      .directive('myRepeatDirective', function() {
                        return function(scope, element, attrs) {
                        
                        if (scope.$last){
                        $('.footable').trigger('footable_initialized');
                        $('.footable').trigger('footable_resize');
                        $('.footable').data('footable').redraw();
                        
                        }
                        };
                        })   
                        ;

function CargaTiposSolicitudes($scope, $http,$location,$localStorage) {
    
    $scope.tipossolicitudes = [];
    
        
    $scope.obtenerTiposSolicitudes = function() {
        
                if (localStorage.getItem('filtrosSolicitudes')!== null)
		{
		$scope.filtrosSolicitudes = localStorage.getItem('filtrosSolicitudes');
		document.getElementById("filtronombresolicitud").value = JSON.parse($scope.filtrosSolicitudes)[0].filtronombresolicitud;
		document.getElementById("filtrodescripcionsolicitud").value = JSON.parse($scope.filtrosSolicitudes)[0].filtrodescripcionsolicitud;
		}
                              
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=obtenerTiposSolicitudesFiltro');
                var Params = 'NombreSolicitud=' + document.getElementById("filtronombresolicitud").value + '&DescripcionSolicitud=' + document.getElementById("filtrodescripcionsolicitud").value;    
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
	               
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    $scope.tipossolicitudes = JSON.parse(Ajax.responseText).tipossolicitudes;
                    localStorage.removeItem('filtrosSolicitudes');
                    document.getElementById('divSinResultados').style.display = 'none';
                }
                else
                {
                    $scope.tipossolicitudes = [];
                    document.getElementById('divSinResultados').style.display = 'block';
                }
        
            };
            
            if (localStorage.getItem('filtrosSolicitudes')!== null)
            {
            $scope.obtenerTiposSolicitudes();
            }
            
            $scope.redirigirtiposolicitudes = function(idTipoSolicitud)
	    {
		    $scope.filtrosSolicitudes = [{filtronombresolicitud:document.getElementById("filtronombresolicitud").value,
                    filtrodescripcionsolicitud:document.getElementById("filtrodescripcionsolicitud").value}
                    ];
                localStorage.setItem('filtrosSolicitudes', JSON.stringify($scope.filtrosSolicitudes));
		    location.href = "FormularioDetalleTipoSolicitud.php?idTipoSolicitud="+idTipoSolicitud;
		};
            
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
                                     
                                       <table class="table footable table-striped table-bordered" data-page-size="5" data-page-navigation=".pagination" id="tabla">
                                            <thead>
                                                <tr>
                                                    <th data-hide="phone">Nombre</h6></th>
                                                    <th data-hide="phone,tablet">Descripcion</th>
                                                    <th data-hide="phone,tablet">Fecha Alta</th>
                                                    <th data-hide="phone,tablet">Fecha Baja</th>
                                                    <th data-sort-ignore="true"></th>
                                                    
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr ng_repeat="tiposolicitud in tipossolicitudes" my-repeat-directive>
                                                    <td data-hide="phone">{{tiposolicitud.NombreSolicitud}}</td>
                                                    <td data-hide="phone,tablet">{{tiposolicitud.DescripcionSolicitud}}</td>
                                                    <td data-hide="phone,tablet">{{tiposolicitud.FechaAlta |date:'dd-MM-yyyy'}}</td>
                                                    <td data-hide="phone,tablet">{{tiposolicitud.FechaBaja |date:'dd-MM-yyyy'}}</td>
                                                    <td class="center"><a target="_self" href="" ng_click="redirigirtiposolicitudes(tiposolicitud.idTipoSolicitud);" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a>
                                                    <a target="_self" ng_show="tiposolicitud.FechaBaja!==null"  class="btn btn-danger">Anulada</a></td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="hide-if-no-paging">
                                                    <tr>
                                                        <td colspan="7" class="text-center hide-if-no-paging">
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
