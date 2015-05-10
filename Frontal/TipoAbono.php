<?php require('Cabecera.php'); ?>
<script>
 var Ajax = new AjaxObj();

var app = angular.module('BusquedaTiposAbono', ["ngStorage"])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });

function CargaTiposAbono($scope, $http,$location,$localStorage) {
    
    $scope.tiposabonos = [];
    
    if (typeof($location.search().detalle) !== "undefined")
            {
            $scope.resultado = localStorage.getItem('tiposabonos');
            $scope.filtrosTiposAbono = localStorage.getItem('filtrosTiposAbono');
            $scope.tiposabonos = (localStorage.getItem('tiposabono')!==null) ? JSON.parse($scope.resultado) : JSON.parse(Ajax.responseText).tiposabonos;
            
            document.getElementById("filtronombreabono").value = JSON.parse($scope.filtrosTiposAbono)[0].filtronombreabono;
            document.getElementById("filtrodescripcionabono").value = JSON.parse($scope.filtrosTiposAbono)[0].filtrodescripcionabono;
            
            alert('hola');
            } 
    
    $scope.obtenerTiposAbonos = function() {
        
                
                $scope.filtrosTiposAbono = [{filtronombreabono:document.getElementById("filtronombreabono").value,
                                    filtrodescripcionabono:document.getElementById("filtrodescripcionabono").value}
                    ];
                localStorage.setItem('filtrosTiposAbono', JSON.stringify($scope.filtrosTiposAbono));
                
                
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
                    localStorage.setItem('tiposabonos', JSON.stringify($scope.tiposabonos));
                    document.getElementById('divSinResultados').style.display = 'none';
                }
                else
                {
                    $scope.tiposabonos = [];
                    document.getElementById('divSinResultados').style.display = 'block';
                }
        
            };
            $(function () {
                $('.footable').footable();
                });
}
            
        </script>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
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
                                                <tr ng_repeat="tipoabono in tiposabonos">
                                                    <td>{{tipoabono.NombreAbono}}</td>
                                                    <td>{{tipoabono.DescripcionAbono}}</td>
                                                    <td>{{tipoabono.FechaAlta |date:'dd-MM-yyyy'}}</td>
                                                    <td>{{tipoabono.FechaBaja |date:'dd-MM-yyyy'}}</td>
                                                    <td class="center"><a href="FormularioDetalleAbono.php?idTipoAbono={{tipoabono.idTipoAbono}}" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a></td>
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
