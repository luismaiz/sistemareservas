<?php require('Cabecera.php'); ?>
<script>
 var Ajax = new AjaxObj();

var app = angular.module('BusquedaTiposTarifas', []);

function CargaTiposTarifas($scope, $http) {
    
    $scope.tipostarifas = [];
    
    $scope.obtenerTiposTarifas = function() {
                
                
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTiposTarifasFiltro";
                var Params = 'NombreTarifa=' + document.getElementById("filtronombretarifa").value + '&DescripcionTarifa=' + document.getElementById("filtrodescripciontarifa").value;    
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
	
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    $scope.tipostarifas = JSON.parse(Ajax.responseText).tipostarifas;    
                    document.getElementById('divSinResultados').style.display = 'none';
                }
                else
                {
                    $scope.tipostarifas = [];
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
                                <div class="form-group">
                                       <label class="control-label" >Nombre Tarifa</label>
                                        <input type="text" class="input-sm"  id="filtronombretarifa">	
                                        <label class="control-label" >Descripcion Tarifa</label>
                                        <input type="text" class="input-sm"  id="filtrodescripciontarifa">
                                        <input class="box btn-primary" type="button" value="Buscar" ng_click="obtenerTiposTarifas()"/></div>
                                       
                                <div class="box-content" id="tipostarifas">
                                     
                                       <table class="table table-striped table-bordered responsive">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</h6></th>
                                                    <th>Descripcion</th>
                                                    <th>Fecha Alta</th>
                                                    <th>Fecha Baja</th>
                                                    <th></th>
                                                    
                                                </tr>
                                              </thead>
                                                <tr ng_repeat="tipotarifa in tipostarifas">
                                                    <td>{{tipotarifa.NombreTarifa}}</td>
                                                    <td>{{tipotarifa.DescripcionTarifa}}</td>
                                                    <td>{{tipotarifa.FechaAlta}}</td>
                                                    <td>{{tipotarifa.FechaBaja}}</td>
                                                    <td class="center"><a href="FormularioDetalleTarifa.php?idTipoTarifa={{tipotarifa.idTipoTarifa}}" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a></td>
                                                </tr>
                                            
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
