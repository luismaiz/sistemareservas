<?php require('Cabecera.php'); ?>
<script>
            var Ajax = new AjaxObj();
            var app = angular.module('BusquedaSolicitudes', []);
            
            function CargaSolicitudes($scope, $http) {
            
            $scope.solicitudes = [];
            $scope.abonos = [];
            $scope.obtenersolicitudes = function() {
                
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerSolicitudesPendientes";
                var Params = 'TipoSolicitud=1';    
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                //alert(Ajax.responseText);
	
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                $scope.numerosolicitudes = parseInt(JSON.parse(Ajax.responseText).numerosolicitudes);
                
                if ($scope.estado === 'correcto')
                {
                    $scope.solicitudes = JSON.parse(Ajax.responseText).solicitudes;
                    //document.getElementById('divSinResultados').style.display = 'none';
                }
                else
                {
                    $scope.solicitudes = [];
                    //document.getElementById('divSinResultados').style.display = 'block';
                }
        
            };
            
            $scope.obtenersolicitudes();
            
            $scope.obtenerabonos = function() {
                
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerAbonosPendientes";
                var Params = 'TipoSolicitud=3';    
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                //alert(Ajax.responseText);
	
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                $scope.numeroabonos = parseInt(JSON.parse(Ajax.responseText).numeroabonos);
                
                if ($scope.estado === 'correcto')
                {
                    $scope.abonos = JSON.parse(Ajax.responseText).abonos;
                    //document.getElementById('divSinResultados').style.display = 'none';
                }
                else
                {
                    $scope.abonos = [];
                    //document.getElementById('divSinResultados').style.display = 'block';
                }
        
            };

                $scope.obtenerabonos();
}
        </script>


<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        
    </ul>
</div>
<div class=" row" ng-app="BusquedaSolicitudes">
    <div ng_controller="CargaSolicitudes">
    
        <div class="col-md-6 col-sm-3 col-xs-6">
            <a  id="enlace" data-toggle="tooltip" title="{{numerosolicitudes}} nuevas solicitudes." class="well top-block" href="Reservas.php?solicitudes=1">
                    <i class="glyphicon glyphicon-user blue"></i>
                    <div id="abonosdiarios">Solicitudes Clases pendientes</div>
                    <div>{{numerosolicitudes}}</div>
                    <span class="notification" ng-bind="numerosolicitudes"></span>
                </a>
        </div>
        <div class="col-md-6 col-sm-3 col-xs-6">
            <a data-toggle="tooltip" title="{{numeroabonos}} nuevas solicitudes." class="well top-block" href="Reservas.php?abonos=1">
                <i class="glyphicon glyphicon-user blue"></i>
                <div>Abonos diarios pendientes</div>
                <div>{{numeroabonos}}</div>
                <span class="notification" ng-bind="numeroabonos"></span>
            </a>
        </div>
</div>
</div>
<div class="row"></div>
<div class="row"></div><!--/row-->

<div class="row">
   
   
    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list"></i> Estadistica semanal</h2>

                <div class="box-icon">
                     <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <ul class="dashboard-list">
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-arrow-up"></i>
                            <span class="green">92</span>
                            Abonos mensuales
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-arrow-down"></i>
                            <span class="red">15</span>
                            Clases Dirigidas
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-minus"></i>
                            <span class="red">15</span>
                            Abono diario
                        </a>
                    </li>
                </ul>
            </div>
            <div id="piechart" style="height:300px"></div>
        </div>
    </div>
    <!--/span-->
    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list"></i> Estadistica mensual</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <ul class="dashboard-list">
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-arrow-up"></i>
                            <span class="green">536</span>
                            Abonos diarios
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-arrow-down"></i>
                            <span class="red">450</span>
                            Reservas clases Dirigidas
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-minus"></i>
                            <span class="blue">360</span>
                            Abono mensual
                        </a>
                    </li>
                    
                </ul>
            </div>
            <div id="donutchart" style="height: 300px;">
        </div>
    </div>
        </div>
    <!--/span-->    
</div><!--/row-->

<!-- chart libraries start -->
<!--<script src="bower_components/flot/excanvas.min.js"></script>-->
<script src="Utilidades/bower_components/flot/jquery.flot.js"></script>
<script src="Utilidades/bower_components/flot/jquery.flot.pie.js"></script>
<!--<script src="bower_components/flot/jquery.flot.stack.js"></script>-->
<!--<script src="bower_components/flot/jquery.flot.resize.js"></script>-->
<!-- chart libraries end -->
<script src="Utilidades/js/init-chart.js"></script>
<?php require('Pie.php'); ?>
