<?php require('Cabecera.php'); ?>
<script>
 var Ajax = new AjaxObj();

var app = angular.module('BusquedaTiposTarifas', ["ngStorage"])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });

function CargaTiposTarifas($scope, $http,$location,$localStorage) {
    
    $scope.tipostarifas = [];
    
    
    $scope.obtenerTiposTarifas = function() {
                
                $scope.filtrosTarifas = [{filtronombretarifa:document.getElementById("filtronombretarifa").value,
                                    filtrodescripciontarifa:document.getElementById("filtrodescripciontarifa").value}
                    ];
                localStorage.setItem('filtrosTarifas', JSON.stringify($scope.filtrosTarifas));
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTiposTarifasFiltro');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTiposTarifasFiltro";
                
                var Params = 'NombreTarifa=' + document.getElementById("filtronombretarifa").value + '&DescripcionTarifa=' + document.getElementById("filtrodescripciontarifa").value;    
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
	
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    $scope.tipostarifas = JSON.parse(Ajax.responseText).tipostarifas;  
                    localStorage.setItem('tipostarifas', JSON.stringify($scope.tipostarifas));
                    document.getElementById('divSinResultados').style.display = 'none';
                }
                else
                {
                    $scope.tipostarifas = [];
                    document.getElementById('divSinResultados').style.display = 'block';
                }
        
            };
            
            if (typeof($location.search().detalle) !== "undefined")
            {
            $scope.resultado = localStorage.getItem('tipostarifas');
            $scope.filtrosTarifas = localStorage.getItem('filtrosTarifas');
            $scope.tipostarifas = (localStorage.getItem('tipostarifas')!==null) ? JSON.parse($scope.resultado) : JSON.parse(Ajax.responseText).tipostarifas;
                        
            document.getElementById("filtronombretarifa").value = JSON.parse($scope.filtrosTarifas)[0].filtronombretarifa;
            document.getElementById("filtrodescripciontarifa").value = JSON.parse($scope.filtrosTarifas)[0].filtrodescripciontarifa;
            
            $scope.obtenerTiposTarifas();
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
            <a href="#">Tipo de Tarifa</a>
        </li>
    </ul>
</div>
<div class=" row"ng-app="BusquedaTiposTarifas">
    <div ng_controller="CargaTiposTarifas">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-edit"></i> Buscador Tipos de Tarifa</h2>
                </div>
                 <div class="alert alert-info" id="divSinResultados" style='display:none;'>
                    <strong></strong>No se han encontrado resultados para los filtros introducidos.
                </div>
                <div class="box-content">
                     <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                       <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Nombre Tarifa</label>
                                        <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12"  id="filtronombretarifa">	
                                        <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Descripcion Tarifa</label>
                                        <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12"  id="filtrodescripciontarifa">
                                        </div>
                                        <input class="box btn-primary" type="button" value="Buscar" ng_click="obtenerTiposTarifas()"/>
                                       
                                <div class="box-content" id="tipostarifas">
                                     
                                       <table class="footable table-striped table-bordered responsive" data-page-size="5" data-page-navigation=".pagination" id="tabla">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Descripcion</th>
                                                    <th>Fecha Alta</th>
                                                    <th>Fecha Baja</th>
                                                    <th data-sort-ignore="true"></th>
                                                    
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr ng_repeat="tipotarifa in tipostarifas">
                                                    <td>{{tipotarifa.NombreTarifa}}</td>
                                                    <td>{{tipotarifa.DescripcionTarifa}}</td>
                                                    <td>{{tipotarifa.FechaAlta|date:'dd-MM-yyyy'}}</td>
                                                    <td>{{tipotarifa.FechaBaja|date:'dd-MM-yyyy'}}</td>
                                                    <td class="center"><a target="_self" href="FormularioDetalleTarifa.php?idTipoTarifa={{tipotarifa.idTipoTarifa}}" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a>
                                                    <a target="_self" ng_show="tipotarifa.FechaBaja!==null"  class="btn btn-danger">Anulada</a></td>
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
                               
                                <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetalleTarifa.php' "/>
                               
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
                      
</div>


<?php require('Pie.php'); ?>
