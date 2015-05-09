<?php require('Cabecera.php'); 
if (!empty($_SESSION['CriterioFiltro']) && !empty($_SESSION['TextoFiltro']))
{
echo('bien');    
//presentar tomando en cuenta los filtros antes seleccionados.
}
else
{
   echo('mal');  //presentar sin filtros
} 

?>
<script>
            var Ajax = new AjaxObj();
            var app = angular.module('BusquedaSalas', []);
            
            function CargaSalas($scope, $http) {
            
            $scope.salas = [];

            $scope.obtenerSalas = function() {
                
                
                
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
                    document.getElementById('divSinResultados').style.display = 'none';
                    <?php $_SESSION['Salas'] = "<script> document.write($scope.salas) </script>";?>
                     
                }
                else
                {
                    $scope.salas = [];
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
                                <input class="box btn-primary" type="button" value="Buscar" ng_click="obtenerSalas()"/>
                                <div class="box-content" id="salas">
                                        <table class="footable table-striped table-bordered responsive" data-page-size="10" >
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th data-type="numeric">Capacidad</th>
                                                    <th>Descripción</th>
                                                    <th data-type="numeric" data-value="303892481155">Fecha Alta</th>
                                                    <th data-type="numeric" data-value="303892481155">Fecha Baja</th>
                                                    <th data-sort-ignore="true"></th>
                                                    
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr ng_repeat="sala in salas">
                                                    <td>{{sala.NombreSala}}</td>
                                                    <td>{{sala.CapacidadSala}}</td>
                                                    <td>{{sala.DescripcionSala}}</td>
                                                    <td>{{sala.FechaAlta |date:'dd-MM-yyyy' }}</td>
                                                    <td>{{sala.FechaBaja |date:'dd-MM-yyyy'}}</td>
                                                    <td class="center"><a href="FormularioDetalleSala.php?idSala={{sala.idSala}}" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a></td>
                                                </tr>
                                                </tbody>
                                               
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



<?php require('Pie.php'); 

$_SESSION['CriterioFiltro'] = "TITULO";
$_SESSION['TextoFiltro'] = "Ultima hora";

echo($_SESSION['TextoFiltro']);
?>
