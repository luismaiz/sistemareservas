<?php require('Cabecera.php'); ?>
<script>
            var Ajax = new AjaxObj();
            var app = angular.module('BusquedaSalas', []);
            
            function CargaSalas($scope, $http) {
            
            $scope.salas = [];

            $scope.obtenerSalas = function() {
                
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSalasFiltro";
                var Params = 'NombreSala=' + document.getElementById("filtronombresala").value + '&CapacidadSala=' + document.getElementById("filtrocapacidadsala").value;    
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
	
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    $scope.salas = JSON.parse(Ajax.responseText).salas;    
                    document.getElementById('divSinResultados').style.display = 'none';
                }
                else
                {
                    $scope.salas = [];
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
                    <div class="box-icon">
                       <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    </div>
                </div>
                <div class="alert alert-info" id="divSinResultados" style='display:none;'>
                    <strong></strong>No se han encontrado resultados para los filtros introducidos.
                </div>
            
            <div class="box-content">
                            <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="form-group">
					<label class="control-label" >Nombre Sala</label>
                                        <input type="text" class="input-sm"  id="filtronombresala">	
                                        <label class="control-label" >Capacidad Sala</label>
                                        <input type="text" class="input-sm"  id="filtrocapacidadsala">
                                        <input class="box btn-primary" type="button" value="Buscar" ng_click="obtenerSalas()"/></div>
                                        <div class="box-content" id="salas">
                                        <table class="table table-striped table-bordered responsive">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</h6></th>
                                                    <th>Capacidad</th>
                                                    <th>Descripción</th>
                                                    <th>Fecha Alta</th>
                                                    <th>Fecha Baja</th>
                                                    <th></th>
                                                    
                                                </tr>
                                                <tr ng_repeat="sala in salas">
                                                    <td>{{sala.NombreSala}}</td>
                                                    <td>{{sala.CapacidadSala}}</td>
                                                    <td>{{sala.DescripcionSala}}</td>
                                                    <td>{{sala.FechaAlta}}</td>
                                                    <td>{{sala.FechaBaja}}</td>
                                                    <td class="center"><a href="FormularioDetalleSala.php?idSala={{sala.idSala}}" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a></td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetalleSala.php' "/>
     
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require('Pie.php'); ?>
