<?php require('Cabecera.php'); ?>
<script>
    var Ajax = new AjaxObj();
    var app = angular.module('BusquedaUsuarios',  ["ngStorage"])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
    
    function CargaUsuarios($scope, $http,$location,$localStorage) {
            
            $scope.usuarios = [];
                
            $scope.obtenerUsuarios = function() {
                
                $scope.filtrosUsuarios = [{filtrousuario:document.getElementById("filtrousuario").value}];
                localStorage.setItem('filtrosUsuarios', JSON.stringify($scope.filtrosUsuarios));
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/UsuariosBO.php?url=obtenerUsuariosFiltro');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividadesFiltro";
                var Params = 'NombreUsuario=' + document.getElementById("filtrousuario").value;        
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                                       
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    $scope.usuarios = JSON.parse(Ajax.responseText).usuarios;
                    localStorage.setItem('usuarios', JSON.stringify($scope.usuarios));
                    document.getElementById('divSinResultados').style.display = 'none';
                }
                else
                {
                    $scope.usuarios = [];
                    document.getElementById('divSinResultados').style.display = 'block';
                }
        
            };
            
            if (typeof($location.search().detalle) !== "undefined")
            {
            $scope.resultado = localStorage.getItem('usuarios');
            $scope.filtrosUsuarios = localStorage.getItem('filtrosUsuarios');
            $scope.usuarios = (localStorage.getItem('usuarios')!==null) ? JSON.parse($scope.resultado) : JSON.parse(Ajax.responseText).usuarios;
            
            document.getElementById("filtrousuario").value = JSON.parse($scope.filtrosUsuarios)[0].filtrousuario;
            
            $scope.obtenerUsuarios();
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
            <a href="#">Usuarios</a>
        </li>
    </ul>
</div>
<div class=" row" ng-app="BusquedaUsuarios">
    <div ng_controller="CargaUsuarios">
        <div class="box col-md-12">
                        <div class="box-inner">
                            <div class="box-header well" data-original-title="">
                                <h2><i class="glyphicon glyphicon-edit"></i> Buscador Usuarios</h2>
                            </div>
                                <div class="alert alert-info" id="divSinResultados" style='display:none;'>
                                    <strong></strong>No se han encontrado resultados para los filtros introducidos.
                                </div>
                            
                            <div class="box-content">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Usuario</label>
                                                <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12"  id="filtrousuario">
                                            </div>
                                                <input class="box btn-primary" type="button" value="Buscar" ng_click="obtenerUsuarios();"/>
                                                 <div class="box-content" id="usuarios">
                                        <table class="footable table-striped table-bordered responsive" data-page-size="5" data-page-navigation=".pagination" id="tabla">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Password</th>                                                    
                                                    <th data-type="numeric">Tipo Usuario</th>
                                                    <th></th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr ng_repeat="usuario in usuarios">
                                                    <td>{{usuario.NombreUsuario}}</td>
                                                    <td>{{usuario.Password}}</td>                                                    
                                                    <td>{{usuario.TipoUsuario}}</td>                                                    
                                                    <td class="center"><a target="_self" href="FormularioDetalleUsuario.php?idUsuario={{usuario.idUsuario}}" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a>
                                                    </td>
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
                                        <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetalleUsuario.php' "/>
                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                               </div>
                            </div>
                        </div>

      

<?php require('Pie.php'); ?>
