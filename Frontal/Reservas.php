<?php require('Cabecera.php'); ?>

<script>
    
    var Ajax = new AjaxObj();
            var app = angular.module('BusquedaReservas', ["ngStorage"])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
    
    function CargaBusquedaReservas($scope,$http, $location,$localStorage) {
        
        $scope.solicitudes = [];
        $scope.abonos = [];
                
        if (typeof($location.search().detalle) !== "undefined")
        {
            $scope.saved = localStorage.getItem('solicitudes');
            $scope.filtrosguardados = localStorage.getItem('filtros');
            $scope.solicitudes = (localStorage.getItem('solicitudes')!==null) ? JSON.parse($scope.saved) : JSON.parse(Ajax.responseText).solicitudes;
            
            document.getElementById("filtroLocalizador").value = JSON.parse($scope.filtrosguardados)[0].Localizador;
            document.getElementById("filtroNombre").value = JSON.parse($scope.filtrosguardados)[0].Nombre;
            document.getElementById("filtroApellidos").value = JSON.parse($scope.filtrosguardados)[0].Apellidos;
            document.getElementById("filtroDni").value = JSON.parse($scope.filtrosguardados)[0].Dni;
            document.getElementById("filtroEmail").value = JSON.parse($scope.filtrosguardados)[0].Email;      
            document.getElementById("filtroFechaSolicitud").value = JSON.parse($scope.filtrosguardados)[0].FechaSolicitud;
            document.getElementById("filtroTipoSolicitud").value = JSON.parse($scope.filtrosguardados)[0].TipoSolicitud;
            
            alert('hola');
        }
        
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
                localStorage.setItem('solicitudes', JSON.stringify($scope.solicitudes));
                
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
                localStorage.setItem('solicitudes', JSON.stringify($scope.solicitudes));
        
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
                $scope.filtros = [{Localizador:document.getElementById("filtroLocalizador").value,
                    Nombre:document.getElementById("filtroNombre").value,
                    Apellidos:document.getElementById("filtroApellidos").value,
                    Dni:document.getElementById("filtroDni").value,
                    Email:document.getElementById("filtroEmail").value,
                    FechaSolicitud:document.getElementById("filtroFechaSolicitud").value,
                    TipoSolicitud:document.getElementById("filtroTipoSolicitud").value}];
                localStorage.setItem('filtros', JSON.stringify($scope.filtros));
                
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
                
                alert(Ajax.responseText);
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    $scope.solicitudes = JSON.parse(Ajax.responseText).solicitudes;
                    localStorage.setItem('solicitudes', JSON.stringify($scope.solicitudes));
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
            <div class="alert alert-success" id="divCorrecto" style='display:none;'>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Correcto.</strong>  Se ha validado la solicitud.
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
                            <table class="footable table-striped responsive" data-page-size="10" data-page="true">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Apellidos</th>
                                                    <th>Localizador</th>
                                                    <th>Fecha Solicitud</th>
                                                    <th data-sort-ignore="true"></th>
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
                                                        <i class="glyphicon glyphicon-bell blue" ng_show="solicitud.idTipoTarifa!=1"></i>
                                                        
                                                    </td>
                                                </tr>
                                                <tfoot class="hide-if-no-paging">
                                                    <tr>
                                                        <td colspan="7" class="text-center">
                                                            <ul display="inline" class="pagination pagination-centered">
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            
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
