<?php require('Cabecera.php'); ?>

<script>
    
    var Ajax = new AjaxObj();
            var app = angular.module('BusquedaReservas', [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
    
    function CargaBusquedaReservas($scope, $http, $location) {
        
        $scope.solicitudes = [];
        $scope.abonos = [];
      
        $scope.obtenerReservasSolicitudesPendientes = function() {
                
                $scope.solicitudes = [];
                $scope.abonos = [];
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerSolicitudesPendientes');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerSolicitudesPendientes";
                
                var Params = 'TipoSolicitud=1';    
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                  //  alert(Ajax.responseText);
                $scope.solicitudes = JSON.parse(Ajax.responseText).solicitudes;
        
            };
            if (typeof($location.search().solicitudes) !== "undefined")
            {
                
                $scope.obtenerReservasSolicitudesPendientes();
            }
            
        $scope.obtenerAbonosPendientes = function() {
                
                $scope.solicitudes = [];
                $scope.abonos = [];
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerAbonosPendientes');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerAbonosPendientes";
                
                var Params = 'TipoSolicitud=3';    
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
  //              alert(Ajax.responseText);
                $scope.solicitudes = JSON.parse(Ajax.responseText).abonos;
        
            };
            if (typeof($location.search().abonos) !== "undefined")
            {
                
                $scope.obtenerAbonosPendientes();
            }
            
            
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
        
        
                     
        $scope.obtenerReservas = function() {
            
                $scope.solicitudes = [];
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerReservasFiltro');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerReservasFiltro";
                
                var Params =  'Localizador=' + document.getElementById("filtroLocalizador").value + 
                '&Nombre=' + document.getElementById("filtroNombre").value +    
                '&Apellidos='+ document.getElementById("filtroApellidos").value +
                '&DNI=' + document.getElementById("filtroDni").value +
                '&Email=' + document.getElementById("filtroEmail").value +
                '&FechaSolicitud=' + document.getElementById("filtroFechaSolicitud").value +
                '&TipoSolicitud=' + document.getElementById("filtroTipoSolicitud").value;
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    $scope.solicitudes = JSON.parse(Ajax.responseText).solicitudes;
                    document.getElementById('divSinResultados').style.display = 'none';
                }
                else
                {
                    $scope.solicitudes = [];
                    document.getElementById('divSinResultados').style.display = 'block';
                }
            };
            
        $scope.validarSolicitud = function(idSolicitud){
                          
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=validarSolicitud');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=actualizarSala";
                var Params = 'idSolicitud='+ idSolicitud;
               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
            
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
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
            <a href="#">Reservas</a>
        </li>
    </ul>
</div>
<div class=" row" ng-app="BusquedaReservas">
<div ng_controller="CargaBusquedaReservas">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Buscador Reservas</h2>
            </div>
            <div class="alert alert-info" id="divSinResultados" style='display:none;'>
                    <strong></strong>No se han encontrado resultados para los filtros introducidos.
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Localizador</label>
                                <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" id="filtroLocalizador" name="filtroLocalizador" value="">	
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Tipo Solicitud</label>
                                <select  id="filtroTipoSolicitud" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" >	
                                    <option ng_repeat="tiposolicitud in tiposSolicitudes" value="{{tiposolicitud.idTipoSolicitud}}">{{tiposolicitud.NombreSolicitud}}</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12">Nombre</label>
                                <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" id="filtroNombre" name="filtroNombre" />
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Apellidos</label>
                                <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" id="filtroApellidos" name="filtroApellidos"/>
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >DNI</label>
                                <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" id="filtroDni" name="filtroDni"/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >eMail</label>
                                <input type="email" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" required id="filtroEmail" name="filtroEmail"/>
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Fecha Solicitud</label>
                                <input type="text" class="input-sm col-lg-4  col-md-4 col-sm-4 col-xs-7" id="filtroFechaSolicitud" name="filtroFechaSolicitud"/>
                            </div>
                            
                                <input class="box btn-primary" type="button" value="Buscar" ng_click="obtenerReservas()"/>
                           
                            <div class="box-content" id="reservas">
                            <table class="footable table-striped table-bordered responsive" data-page-size="10"">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Apellidos</th>
                                                    <th>Localizador</th>
                                                    <th>Fecha Solicitud</th>
                                                    <th></th>
                                                </tr>
                                              </thead>    
                                              <tr ng_repeat="solicitud in solicitudes">
                                                    <td>{{solicitud.Nombre}}</td>
                                                    <td>{{solicitud.Apellidos}}</td>
                                                    <td>{{solicitud.Localizador}}</td>
                                                    <td>{{solicitud.FechaSolicitud |date:'dd-MM-yyyy'}}</td>
                                                    <td class="center">
                                                        <a target="_self" ng_show="solicitud.idTipoSolicitud==1" href="FormularioDetalleSolicitudClasesDirigidas.php?idSolicitud={{solicitud.idSolicitud}}" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a>
                                                        <a target="_self" ng_show="solicitud.idTipoSolicitud==2" href="FormularioDetalleSolicitudAbonoMensual.php?idSolicitud={{solicitud.idSolicitud}}" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a>
                                                        <a target="_self" ng_show="solicitud.idTipoSolicitud==3" href="FormularioDetalleSolicitudAbonoDiario.php?idSolicitud={{solicitud.idSolicitud}}" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a>
                                                        <a target="_self" ng_show="solicitud.idTipoSolicitud==1 && solicitud.Gestionado==0" href="" class="btn btn-danger" ng_click="validarSolicitud(solicitud.idSolicitud);">Validar</a>
                                                        <a target="_self" ng_show="solicitud.idTipoSolicitud==3 && solicitud.Gestionado==0" href="" class="btn btn-danger" ng_click="validarSolicitud(solicitud.idSolicitud);">Validar</a>
                                                    </td>
                                                </tr>
<!--                                                <tr ng_repeat="abono in abonos">
                                                    <td>{{abono.Nombre}}</td>
                                                    <td>{{abono.Apellidos}}</td>
                                                    <td>{{abono.Localizador}}</td>
                                                    <td>{{abono.FechaSolicitud |date:'dd-MM-yyyy'}}</td>
                                                    <td class="center">
                                                        <a target="_self" href="FormularioDetalleSolicitudAbonoDiario.php?idSolicitud={{abono.idSolicitud}}" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a>
                                                        <a target="_self" href="FormularioDetalleSolicitudAbonoDiario.php" class="btn btn-danger">Sin validar</a>
                                                    </td>
                                                </tr>-->
                                            
                                        </table>
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
