<?php require('Cabecera.php'); ?>
<script>
            var Ajax = new AjaxObj();
            var app = angular.module('BusquedaSolicitudes', []);
            
            function CargaSolicitudes($scope, $http) {
            
            $scope.solicitudes = [];
            $scope.abonos = [];
            $scope.obtenersolicitudes = function() {
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerSolicitudesPendientes');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerSolicitudesPendientes";
                var Params = 'TipoSolicitud=1';    
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
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
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerAbonosPendientes');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerAbonosPendientes";
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
            $scope.obtenerabonos ();
            
            $scope.obtenerSolicitudesMes = function() {
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerSolicitudesMesEstadistica');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerAbonosPendientes";
                var Params = '';    
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                alert(Ajax.responseText);
	
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                $scope.clases = parseInt(JSON.parse(Ajax.responseText).clases);
                $scope.mensual = parseInt(JSON.parse(Ajax.responseText).mensual);
                $scope.diario = parseInt(JSON.parse(Ajax.responseText).diario);
                
            };
            $scope.obtenerSolicitudesMes ();
            
            $scope.obtenerSolicitudesSemana = function() {
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerSolicitudesSemanaEstadistica');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerAbonosPendientes";
                var Params = '';    
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                alert(Ajax.responseText);
	
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                $scope.clasessemana = parseInt(JSON.parse(Ajax.responseText).clasessemana);
                $scope.mensualsemana = parseInt(JSON.parse(Ajax.responseText).mensualsemana);
                $scope.diariosemana = parseInt(JSON.parse(Ajax.responseText).diariosemana);
                
            };
            $scope.obtenerSolicitudesSemana ();
           
 
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

        <div class="col-md-6 col-sm-6 col-xs-12">
            <a  id="enlace" data-toggle="tooltip" title="{{numerosolicitudes}}  nuevas solicitudes." class="well top-block" href="Reservas.php?solicitudes=1">
                <i class="glyphicon glyphicon-user blue"></i>
                <div id="abonosdiarios">Solicitudes Clases pendientes</div>
                <div>{{numerosolicitudes}}</div>
                <span class="notification" ng-bind="numerosolicitudes"></span>
            </a>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <a data-toggle="tooltip" title="{{numeroabonos}} nuevas solicitudes." class="well top-block" href="Reservas.php?abonos=1">
                <i class="glyphicon glyphicon-user blue"></i>
                <div>Abonos diarios pendientes</div>
                <div>{{numeroabonos}}</div>
                <span class="notification" ng-bind="numeroabonos"></span>
            </a>
        </div>
    
<div class="row"></div>
<div class="row"></div><!--/row-->

<div class="row">
    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list"></i> Estadistica semanal</h2>
            </div>
            <div class="box-content">
                <ul class="dashboard-list">
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-play"></i>
                            <span class="green" ng-bind="diariosemana"></span>
                            Abono diario
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-play"></i>
                            <span class="green" ng-bind="mensualsemana"></span>
                            Abonos mensuales
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-play"></i>
                            <span class="green" ng-bind="clasessemana"></span>
                            Reservas Clases Dirigidas
                        </a>
                    </li>
                </ul>
            </div>
            <div id="piechart" style="height:300px" data-bind="data"></div>
        </div>
    </div>
    <!--/span-->
    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list"></i> Estadistica mensual</h2>
            </div>
            <div class="box-content">
                <ul class="dashboard-list">
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-play"></i>
                            <span class="green" ng-bind="diario"></span>
                            Abonos diarios
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-play"></i>
                            <span class="green" ng-bind="clases"></span>
                            Reservas clases Dirigidas
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-play"></i>
                            <span class="green" ng-bind="mensual"></span>
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
</div>
</div>
<!-- chart libraries start -->
<!--<script src="bower_components/flot/excanvas.min.js"></script>-->
<script src="Utilidades/bower_components/flot/jquery.flot.js"></script>
<script src="Utilidades/bower_components/flot/jquery.flot.pie.js"></script>
<!--<script src="bower_components/flot/jquery.flot.stack.js"></script>-->
<!--<script src="bower_components/flot/jquery.flot.resize.js"></script>-->
<!-- chart libraries end -->
<script src="Utilidades/js/init-chart.js"></script>
<?php require('Pie.php'); ?>
