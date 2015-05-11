<?php require('Cabecera.php');?>
<script>
    var Ajax = new AjaxObj();
            var app = angular.module('BusquedaPrecios', ["ngStorage"])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });            
                     
    
    function CargaBusquedaPrecios($scope, $http, $location,$localStorage) {
        
        $scope.obtenerTipoSolicitud = function(){
        
        var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=obtenerTiposSolicitud');
        //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=obtenerTiposSolicitud";
        
        var Params = '';

        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
               
        $scope.tiposSolicitudes = JSON.parse(Ajax.responseText).tiposSolicitudes;
        
        };   
        $scope.obtenerTipoSolicitud();
        
        
        $scope.obtenerTipoAbono = function(){
        
        var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTiposAbono');		
        //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTiposAbono";		
        
        var Params = '';

        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
        
                       
        $scope.tiposAbonos = JSON.parse(Ajax.responseText).tiposAbonos;
        
        };   
        $scope.obtenerTipoAbono();
        
        
        $scope.obtenerTipoTarifa = function(){
        
        var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTiposTarifa');		
        //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTiposTarifa";		
        
        var Params = '';

        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
               
        $scope.tiposTarifas = JSON.parse(Ajax.responseText).tiposTarifas;
        
        };   
        $scope.obtenerTipoTarifa();
        
        
        $scope.obtenerPrecios = function() {
            
                $scope.filtrosprecios = [{filtroTipoSolicitud:document.getElementById("filtroTipoSolicitud").value,
                    filtroTipoAbono:document.getElementById("filtroTipoAbono").value,
                    filtroTipoTarifa:document.getElementById("filtroTipoTarifa").value}];
                localStorage.setItem('filtrosprecios', JSON.stringify($scope.filtrosprecios));
            
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/PreciosBO.php?url=obtenerPreciosFiltro');
                
                var Params =  'TipoSolicitud=' + document.getElementById("filtroTipoSolicitud").value +
                        '&TipoAbono=' + document.getElementById("filtroTipoAbono").value +
                        '&TipoTarifa=' + document.getElementById("filtroTipoTarifa").value;
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                  
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                alert(Ajax.responseText);
                
                if ($scope.estado === 'correcto')
                {
                    $scope.precios = JSON.parse(Ajax.responseText).precios;
                    localStorage.setItem('precios', JSON.stringify($scope.precios));
                    document.getElementById('divSinResultados').style.display = 'none';
                }
                else
                {
                    $scope.precios = [];
                    document.getElementById('divSinResultados').style.display = 'block';
                }
            };
            
            if (typeof($location.search().detalle) !== "undefined")
            {
                $scope.resultado = localStorage.getItem('precios');
                $scope.filtrosprecios = localStorage.getItem('filtrosprecios');
                $scope.precios = (localStorage.getItem('precios')!==null) ? JSON.parse($scope.resultado) : JSON.parse(Ajax.responseText).precios;
            
                document.getElementById("filtroTipoSolicitud").value = JSON.parse($scope.filtrosprecios)[0].filtroTipoSolicitud;
                document.getElementById("filtroTipoAbono").value = JSON.parse($scope.filtrosprecios)[0].filtroTipoAbono;
                document.getElementById("filtroTipoTarifa").value = JSON.parse($scope.filtrosprecios)[0].filtroTipoTarifa;
                
                $scope.obtenerPrecios();
            }
            
            
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
            <a href="#">Precios</a>
        </li>
    </ul>
</div>
<div class=" row" ng-app="BusquedaPrecios">
    <div ng_controller="CargaBusquedaPrecios">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Buscador Precios</h2>
            </div>
            <div class="alert alert-info" id="divSinResultados" style='display:none;'>
                    <strong></strong>No se han encontrado resultados para los filtros introducidos.
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Tipo Solicitud</label>
                                <select  id="filtroTipoSolicitud" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" >	
                                    <option ng_repeat="tiposolicitud in tiposSolicitudes" value="{{tiposolicitud.idTipoSolicitud}}">{{tiposolicitud.NombreSolicitud}}</option>
                                </select>
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Tipo Abono</label>
                                <select  id="filtroTipoAbono" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" >	
                                    <option ng_repeat="tipoabono in tiposAbonos" value="{{tipoabono.idTipoAbono}}">{{tipoabono.NombreAbono}}</option>
                                </select>
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Tipo Tarifa</label>
                                <select  id="filtroTipoTarifa" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" >	
                                    <option ng_repeat="tipotarifa in tiposTarifas" value="{{tipotarifa.idTipoTarifa}}">{{tipotarifa.NombreTarifa}}</option>
                                </select>
                                
                            </div>	
                            <input class="box btn-primary" type="button" value="Buscar" ng_click="obtenerPrecios()"/>
                            <div class="box-content" id="precios">
                            <table class="footable table-striped table-bordered responsive" data-page-size="5" data-page-navigation=".pagination" id="tabla">
                                            <thead>
                                                <tr>
                                                    <th>Tipo Solicitud</h6></th>
                                                    <th>Tipo Abono</th>
                                                    <th>Tipo Tarifa</th>
                                                    <th data-type="numeric">Precio</th>
                                                    <th data-sort-ignore="true"></th>
                                              </thead>      
                                                </tr>
                                                <tbody>
                                                <tr ng_repeat="precio in precios">
                                                    <td><select  ng_disabled="true">	
                                                            <option ng_repeat="tiposolicitud in tiposSolicitudes" ng_selected="{{precio.idTipoSolicitud}} == {{tiposolicitud.idTipoSolicitud}}">{{tiposolicitud.NombreSolicitud}}</option>
                                                    </select></td>
                                                    <td><select  ng_disabled="true">	
                                                            <option ng_repeat="tipoabono in tiposAbonos" ng_selected="{{precio.idTipoAbono}} == {{tipoabono.idTipoAbono}}">{{tipoabono.NombreAbono}}</option>
                                                    </select></td>
                                                    <td><select  ng_disabled="true">	
                                                            <option ng_repeat="tipotarifa in tiposTarifas" ng_selected="{{precio.idTipoTarifa}} == {{tipotarifa.idTipoTarifa}}">{{tipotarifa.NombreTarifa}}</option>
                                                    </select></td>
                                                    <td>{{precio.Precio}}€</td>
                                                    <td class="center"><a target="_self" href="FormularioDetallePrecio.php?idPrecio={{precio.idPrecio}}" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a>
                                                    <a  ng_show="precio.FechaBaja!==null"  class="btn btn-danger">Anulado</a></td>
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
                            <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetallePrecio.php' "/>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    </div>
</div>

<?php require('Pie.php'); ?>
