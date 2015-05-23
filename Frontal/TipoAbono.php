<?php require('Cabecera.php'); ?>
<script>
 var Ajax = new AjaxObj();

var app = angular.module('BusquedaTiposAbono', ["ngStorage"])            
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

function CargaTiposAbono($scope, $http,$location,$localStorage) {
    
    $scope.tiposabonos = [];
    
       
    $scope.obtenerTiposAbonos = function() {
        
                if (localStorage.getItem('filtrosTiposAbono')!== null)
		{
		$scope.filtrosTiposAbono = localStorage.getItem('filtrosTiposAbono');
		document.getElementById("filtronombreabono").value = JSON.parse($scope.filtrosTiposAbono)[0].filtronombreabono;
		document.getElementById("filtrodescripcionabono").value = JSON.parse($scope.filtrosTiposAbono)[0].filtrodescripcionabono;
		}
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTiposAbonosFiltro');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTiposAbonosFiltro";
                
                var Params = 'NombreAbono=' + document.getElementById("filtronombreabono").value + '&DescripcionAbono=' + document.getElementById("filtrodescripcionabono").value;    
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
	                
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    $scope.tiposabonos = JSON.parse(Ajax.responseText).tiposabonos;
                    localStorage.removeItem('filtrosTiposAbono');
                    document.getElementById('divSinResultados').style.display = 'none';
                }
                else
                {
                    $scope.tiposabonos = [];
                    document.getElementById('divSinResultados').style.display = 'block';
                }
        
            };
            
            if (localStorage.getItem('filtrosTiposAbono')!== null)
            {
            $scope.obtenerTiposAbonos();
            }
            
            $scope.redirigirtipoabono = function(idTipoAbono)
	    {
		    $scope.filtrosTiposAbono = [{filtronombreabono:document.getElementById("filtronombreabono").value,
                    filtrodescripcionabono:document.getElementById("filtrodescripcionabono").value}
                    ];
                localStorage.setItem('filtrosTiposAbono', JSON.stringify($scope.filtrosTiposAbono));
		    location.href = "FormularioDetalleAbono.php?idTipoAbono="+idTipoAbono;
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
            <a href="#">Tipo de Abono</a>
        </li>
    </ul>
</div>
<div class=" row"ng-app="BusquedaTiposAbono">
    <div ng_controller="CargaTiposAbono">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-edit"></i> Buscador Tipos de Abono</h2>
                </div>
                 <div class="alert alert-info" id="divSinResultados" style='display:none;'>
                    <strong></strong>No se han encontrado resultados para los filtros introducidos.
                </div>
                <div class="box-content">
                     <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                       <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Nombre Abono</label>
                                        <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12"  id="filtronombreabono">	
                                        <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Descripcion Abono</label>
                                        <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12"  id="filtrodescripcionabono">
                                </div>
                                      
                                        <input class="box btn-primary" type="button" value="Buscar" ng_click="obtenerTiposAbonos()"/>
                                
                                
                                
                                       
                                <div class="box-content" id="tiposabonos">
                                     
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
                                                <tr ng_repeat="tipoabono in tiposabonos" my-repeat-directive>
                                                    <td data-hide="phone">{{tipoabono.NombreAbono}}</td>
                                                    <td data-hide="phone,tablet">{{tipoabono.DescripcionAbono}}</td>
                                                    <td data-hide="phone,tablet">{{tipoabono.FechaAlta |date:'dd-MM-yyyy'}}</td>
                                                    <td data-hide="phone,tablet">{{tipoabono.FechaBaja |date:'dd-MM-yyyy'}}</td>
                                                    <td class="center"><a target="_self" href="" ng_click="redirigirtipoabono(tipoabono.idTipoAbono);" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a>
                                                    <a target="_self" ng_show="tipoabono.FechaBaja!==null"  class="btn btn-danger">Anulada</a></td>
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
                              
                                <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetalleAbono.php' "/>
                              
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
                      
</div>


<?php require('Pie.php'); ?>
