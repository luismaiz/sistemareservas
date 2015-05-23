<?php require('Cabecera.php'); ?>
<script>
            var Ajax = new AjaxObj();
            var app = angular.module('BusquedaSalas',  ['ngStorage'])            
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
                  
					  
            
            function CargaSalas($scope, $http,$location,$localStorage) {
            
            $scope.salas = [];
                    
            $scope.obtenerSalas = function() {
                
				if (localStorage.getItem('filtrosSalas')!== null)
				{
					$scope.filtrossalas = localStorage.getItem('filtrosSalas');
					document.getElementById("filtronombresala").value = JSON.parse($scope.filtrossalas)[0].filtronombresala;
					document.getElementById("filtrocapacidadsala").value = JSON.parse($scope.filtrossalas)[0].filtrocapacidadsala;
				}
                              
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSalasFiltro');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSalasFiltro";
                
                var Params = 'NombreSala=' + document.getElementById("filtronombresala").value + '&CapacidadSala=' + document.getElementById("filtrocapacidadsala").value;    
                
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
	
        
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                       
                if ($scope.estado === 'correcto')
                {
                    $scope.salas = JSON.parse(Ajax.responseText).salas;
                    localStorage.removeItem('filtrosSalas');
                    document.getElementById('divSinResultados').style.display = 'none';
                }
                else
                {
                    $scope.salas = [];
                    document.getElementById('divSinResultados').style.display = 'block';
                }
        
            };
			
			if (localStorage.getItem('filtrosSalas')!== null)
            {
				$scope.obtenerSalas();
            }
                    
                
				
				$scope.redirigirsalas = function(idSala)
		{
		    $scope.filtrossalas = [{filtronombresala:document.getElementById("filtronombresala").value,
                    filtrocapacidadsala:document.getElementById("filtrocapacidadsala").value}
                    ];
                localStorage.setItem('filtrosSalas', JSON.stringify($scope.filtrossalas));
		    location.href = "FormularioDetalleSala.php?idSala="+idSala;
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
            <a href="#">Salas</a>
        </li>
    </ul>
</div>
        
<div class=" row" ng-app="BusquedaSalas">
    <div ng_controller="CargaSalas">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-edit"></i> Buscador Salas</h2>
                </div>
                <div class="alert alert-info" id="divSinResultados" style='display:none;'>
                    <strong></strong>No se han encontrado resultados para los filtros introducidos.
                </div>
                <div class="box-content">
                     <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Nombre Sala</label>
                                        <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12"  id="filtronombresala">	
                                        <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Capacidad Sala</label>
                                        <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12 "  id="filtrocapacidadsala">
                                </div>
                                <input class="box btn-primary" type="submit" value="Buscar" ng_click="obtenerSalas()"/>
                                <div class="box-content" id="salas">
                                        <table class="table footable table-striped table-bordered" data-page-size="5" data-page-navigation=".pagination">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th data-hide="phone" data-type="numeric" >Capacidad</th>
                                                    <th data-hide="phone,tablet">Descripción</th>
                                                    <th data-hide="phone,tablet" data-type="numeric" data-value="303892481155">Fecha Alta</th>
                                                    <th data-hide="phone,tablet" data-type="numeric" data-value="303892481155">Fecha Baja</th>
                                                    <th data-sort-ignore="true"></th>
                                                    
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr ng_repeat="sala in salas" my-repeat-directive>
                                                    <td >{{sala.NombreSala}}</td>
                                                    <td data-hide="phone">{{sala.CapacidadSala}}</td>
                                                    <td data-hide="phone,tablet">{{sala.DescripcionSala}}</td>
                                                    <td data-hide="phone,tablet">{{sala.FechaAlta |date:'dd-MM-yyyy' }}</td>
                                                    <td data-hide="phone,tablet">{{sala.FechaBaja |date:'dd-MM-yyyy'}}</td>
                                                    <td class="center">
						    <a target="_self"  href="" class="btn btn-info" ng_click="redirigirsalas(sala.idSala);"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a>
                                                    <a target="_self" ng_show="sala.FechaBaja!==null"  class="btn btn-danger">Anulada</a></td>
                                                </tr>
                                                </tbody>
						<tfoot class="hide-if-no-paging">
                                                    <tr>
                                                        <td colspan="6" class="text-center hide-if-no-paging">
                                                            <ul class="pagination"></ul>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                        
                                        </table>
                               
                                <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetalleSala.php' "/>
                           </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
   


<?php require('Pie.php'); ?>
