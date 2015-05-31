<?php require('Cabecera.php'); ?>

<script>
    
    var Ajax = new AjaxObj();
            var app = angular.module('BusquedaReservas', ["ngStorage"])            
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
                        
    
    function CargaBusquedaReservas($scope,$http, $location,$localStorage) {
        
        $scope.solicitudes = [];
        $scope.abonos = [];
	//localStorage.removeItem('filtros');
		       
	$scope.obtenerTipoSolicitud = function(){

        var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=obtenerTiposSolicitud');

        var Params = '';
		
        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
               
        $scope.tiposSolicitudes = JSON.parse(Ajax.responseText).tiposSolicitudes;
        
	$scope.tiposSolicitudes.unshift({idTipoSolicitud:'0',NombreSolicitud:"--Tipo Solicitud--"});
	
		for(var i = $scope.tiposSolicitudes.length - 1; i >= 1; i--) {
			if($scope.tiposSolicitudes[i].FechaBaja !== null) {
			$scope.tiposSolicitudes.splice(i, 1);
    }
}	
	
				
		if (localStorage.getItem('filtros')!== null)
		{
		    $scope.selected = $scope.tiposSolicitudes[JSON.parse(localStorage.getItem('filtros'))[0].TipoSolicitud];
		}
                else
                {
                    $scope.selected = $scope.tiposSolicitudes[0];
                }
                
		
        };   
        $scope.obtenerTipoSolicitud();
		$scope.obtenerReservas = function() {
				$scope.solicitudes = [];
				
				if (localStorage.getItem('filtros')!== null)
				{
					//$scope.saved = localStorage.getItem('solicitudes');
					$scope.filtros = localStorage.getItem('filtros');
					//$scope.solicitudes = (localStorage.getItem('solicitudes')!==null) ? JSON.parse($scope.saved) : JSON.parse(Ajax.responseText).solicitudes;
					document.getElementById("filtroLocalizador").value = JSON.parse($scope.filtros)[0].Localizador;
					document.getElementById("filtroNombre").value = JSON.parse($scope.filtros)[0].Nombre;
					document.getElementById("filtroApellidos").value = JSON.parse($scope.filtros)[0].Apellidos;
					document.getElementById("filtroDni").value = JSON.parse($scope.filtros)[0].Dni;
					document.getElementById("filtroEmail").value = JSON.parse($scope.filtros)[0].Email;      
					document.getElementById("filtroFechaSolicitudDesde").value = JSON.parse($scope.filtros)[0].FechaSolicitudDesde;
                    document.getElementById("filtroFechaSolicitudHasta").value = JSON.parse($scope.filtros)[0].FechaSolicitudHasta;
					$scope.selected = $scope.tiposSolicitudes[JSON.parse($scope.filtros)[0].TipoSolicitud];
					document.getElementById("filtroGestionado").value = JSON.parse($scope.filtros)[0].Gestionado;
				}
                             
                             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerReservasFiltro');
                var Params =  'Localizador=' + document.getElementById("filtroLocalizador").value + 
                '&Nombre=' + document.getElementById("filtroNombre").value +    
                '&Apellidos='+ document.getElementById("filtroApellidos").value +
                '&DNI=' + document.getElementById("filtroDni").value +
                '&Email=' + document.getElementById("filtroEmail").value +
                '&FechaSolicitudDesde=' + document.getElementById("filtroFechaSolicitudDesde").value +
                '&FechaSolicitudHasta=' + document.getElementById("filtroFechaSolicitudHasta").value +
                '&TipoSolicitud=' + $scope.selected.idTipoSolicitud +
                '&Gestionado=' + document.getElementById("filtroGestionado").value;
                
		Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                //alert(Ajax.responseText);
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    $scope.solicitudes = JSON.parse(Ajax.responseText).solicitudes;
                    localStorage.removeItem('filtros');
                    document.getElementById('divSinResultados').style.display = 'none';
                }
                else
                {
                    $scope.solicitudes = [];
					localStorage.removeItem('filtros');
                    document.getElementById('divSinResultados').style.display = 'block';
                }
            };	
			
            if (localStorage.getItem('filtros')!== null)
            {
                
				$scope.obtenerReservas();
            }
        
        
        $scope.obtenerReservasSolicitudesPendientes = function() {
                
                $scope.solicitudes = [];
                $scope.abonos = [];
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerSolicitudesPendientes');
      
                var Params = 'TipoSolicitud=1';    
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                  
                                        
                $scope.solicitudes = JSON.parse(Ajax.responseText).solicitudes;
                $scope.selected = $scope.tiposSolicitudes[1];
				document.getElementById("filtroGestionado").value='0';
                
            };
            if (typeof($location.search().solicitudes) !== "undefined")
            {
                
                $scope.obtenerReservasSolicitudesPendientes();
            }
        $scope.obtenerAbonosPendientes = function() {
                
                $scope.solicitudes = [];
                $scope.abonos = [];
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=obtenerAbonosPendientes');
        
                var Params = 'TipoSolicitud=3';    
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
  //              alert(Ajax.responseText);
                $scope.solicitudes = JSON.parse(Ajax.responseText).abonos;
                $scope.selected = $scope.tiposSolicitudes[3];
				document.getElementById("filtroGestionado").value='0';
        
            };
            if (typeof($location.search().abonos) !== "undefined")
            {
                
                $scope.obtenerAbonosPendientes();
            }
            
            
       
               
        $scope.validarSolicitud = function(idSolicitud){
                          
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=validarSolicitud');
                
                var Params = 'idSolicitud='+ idSolicitud;
               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
            
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    $scope.obtenerReservas();
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
			
			$scope.cancelarAnulacion = function(idSolicitud){
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ReservasBO.php?url=cancelarAnulacion');
                
                var Params = 'idSolicitud='+ idSolicitud;
               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
            
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divAnulacion').style.display = 'block';
                    $scope.obtenerReservas();
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            
            $(function () {
                $('.footable').footable();
                });
		$scope.redirigirdiario = function(idSolicitud)
		{
		    $scope.filtros = [{Localizador:document.getElementById("filtroLocalizador").value,
                    Nombre:document.getElementById("filtroNombre").value,
                    Apellidos:document.getElementById("filtroApellidos").value,
                    Dni:document.getElementById("filtroDni").value,
                    Email:document.getElementById("filtroEmail").value,
                    FechaSolicitudDesde:document.getElementById("filtroFechaSolicitudDesde").value,
                    FechaSolicitudHasta:document.getElementById("filtroFechaSolicitudHasta").value,
                    TipoSolicitud:document.getElementById("filtroTipoSolicitud").value,
                    Gestionado:document.getElementById("filtroGestionado").value}];
                    localStorage.setItem('filtros', JSON.stringify($scope.filtros));
		    location.href = "FormularioDetalleSolicitudAbonoDiario.php?idSolicitud="+idSolicitud;
		};
		
                $scope.redirigirclases = function(idSolicitud)
		{
		    $scope.filtros = [{Localizador:document.getElementById("filtroLocalizador").value,
                    Nombre:document.getElementById("filtroNombre").value,
                    Apellidos:document.getElementById("filtroApellidos").value,
                    Dni:document.getElementById("filtroDni").value,
                    Email:document.getElementById("filtroEmail").value,
                    FechaSolicitudDesde:document.getElementById("filtroFechaSolicitudDesde").value,
                    FechaSolicitudHasta:document.getElementById("filtroFechaSolicitudHasta").value,
                    TipoSolicitud:document.getElementById("filtroTipoSolicitud").value,
                    Gestionado:document.getElementById("filtroGestionado").value}];
                    localStorage.setItem('filtros', JSON.stringify($scope.filtros));
		    location.href = "FormularioDetalleSolicitudClasesDirigidas.php?idSolicitud="+idSolicitud;
		};
                
                $scope.redirigirmensual = function(idSolicitud)
		{
		    $scope.filtros = [{Localizador:document.getElementById("filtroLocalizador").value,
                    Nombre:document.getElementById("filtroNombre").value,
                    Apellidos:document.getElementById("filtroApellidos").value,
                    Dni:document.getElementById("filtroDni").value,
                    Email:document.getElementById("filtroEmail").value,
                    FechaSolicitudDesde:document.getElementById("filtroFechaSolicitudDesde").value,
                    FechaSolicitudHasta:document.getElementById("filtroFechaSolicitudHasta").value,
                    TipoSolicitud:document.getElementById("filtroTipoSolicitud").value,
                    Gestionado:document.getElementById("filtroGestionado").value}];
                    localStorage.setItem('filtros', JSON.stringify($scope.filtros));
		    location.href = "FormularioDetalleSolicitudAbonoMensual.php?idSolicitud="+idSolicitud;
		};
		
		        
    }
    
     $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            dayNamesMin: ['Do','Lun','Ma','Mi','Ju','Vi','Sá'],
            weekHeader: 'Sm',
            dateFormat:'dd-mm-yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
            };
 $.datepicker.setDefaults($.datepicker.regional['es']);
            
            $(function() {
                $( "#filtroFechaSolicitudDesde" ).datepicker({
                    dateFormat:'dd-mm-yy'
                });
            });
            $(function() {
                $( "#filtroFechaSolicitudHasta" ).datepicker({
                    dateFormat:'dd-mm-yy'
                });
            });
      
</script>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="Inicio.php">Inicio</a>
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
			<div class="alert alert-warning" id="divAnulacion" style='display:none;'>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Correcto.</strong>  Se ha anulado la validación de la solicitud.
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Localizador</label>
                                <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" id="filtroLocalizador" name="filtroLocalizador" value="">	
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Tipo Solicitud</label>
                                <select ng-model="selected" ng-options="tiposolicitud.NombreSolicitud for tiposolicitud in tiposSolicitudes track by tiposolicitud.idTipoSolicitud"  id="filtroTipoSolicitud" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" >	
                              </select>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12">Nombre</label>
                                <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" id="filtroNombre" name="filtroNombre" />
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Apellidos</label>
                                <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" id="filtroApellidos" name="filtroApellidos"/>
                            </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >DNI</label>
                                <input type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" id="filtroDni" name="filtroDni"/>
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >eMail</label>
                                <input type="email" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" id="filtroEmail" name="filtroEmail"/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Fecha Solicitud Desde</label>
                                <input type="text" class="input-sm col-lg-4  col-md-4 col-sm-4 col-xs-7" id="filtroFechaSolicitudDesde" name="filtroFechaSolicitudDesde"/>
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Fecha Solicitud Hasta</label>
                                <input type="text" class="input-sm col-lg-4  col-md-4 col-sm-4 col-xs-7" id="filtroFechaSolicitudHasta" name="filtroFechaSolicitudHasta"/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" >Gestionado</label>
                                <select  id="filtroGestionado" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" >	
                                    <option value="">-- Estado --</option>
                                    <option value="1">Gestionado</option>
                                    <option value="0">Pendiente</option>
                                </select>
                            </div>
                            
                                <input class="box btn-primary" type="button" value="Buscar" ng_click="obtenerReservas()"/>
                           
                            <div class="box-content" id="reservas">
                            <table class="table footable table-striped table-bordered" data-page-size="10" data-page="true">
                                            <thead>
                                                <tr>
                                                    <th>Localizador</th>
                                                    <th>Apellidos</th>
                                                    <th data-hide="phone">Nombre</th>
                                                    <th data-hide="phone,tablet">Fecha Solicitud</th>
                                                    <th data-hide="phone,tablet">Tipo Solicitud</th>
                                                    <th data-sort-ignore="true"></th>
                                                </tr>
                                              </thead>    
                                              <tr ng_repeat="solicitud in solicitudes" my-repeat-directive>
                                                    <td>{{solicitud.Localizador}}</td>
                                                    <td>{{solicitud.Apellidos}}</td>
                                                    <td data-hide="phone">{{solicitud.Nombre}}</td>
                                                    <td data-hide="phone,tablet">{{solicitud.FechaSolicitud |date:'dd-MM-yyyy'}}</td>
                                                    <td data-hide="phone,tablet">
                                                        <p ng_show="solicitud.idTipoSolicitud==1">Clase Dirigida</p>
                                                        <p ng_show="solicitud.idTipoSolicitud==2">Mensual</p>
                                                        <p ng_show="solicitud.idTipoSolicitud==3">Diario</p>
                                                    </td>
                                                    <td class="center">
                                                        <a target="_self" ng_show="solicitud.idTipoSolicitud==1" href="" class="btn btn-info" ng_click="redirigirclases(solicitud.idSolicitud);"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a>
                                                        <a target="_self" ng_show="solicitud.idTipoSolicitud==2" href="" class="btn btn-info" ng_click="redirigirmensual(solicitud.idSolicitud);"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a>
                                                        <a target="_self"  ng_show="solicitud.idTipoSolicitud==3" href="" class="btn btn-info" ng_click="redirigirdiario(solicitud.idSolicitud);"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a>
                                                        <a target="_self"  ng_show="solicitud.idTipoSolicitud==3 && solicitud.Gestionado==0" href="" class="btn btn-success" ng_click="validarSolicitud(solicitud.idSolicitud);">Validar</a>
                                                        <a target="_self"  ng_show="solicitud.idTipoSolicitud==1 && solicitud.Gestionado==0" href="" class="btn btn-success" ng_click="validarSolicitud(solicitud.idSolicitud);">Validar</a>
							<a target="_self" ng_show="solicitud.Gestionado=='1' && solicitud.Anulado!='1'" ng_click="cancelarAnulacion(solicitud.idSolicitud)" class="btn btn-danger">Invalidar</a>
                                                        <a target="_self" ng_show="solicitud.Anulado!=='0'"  class="btn btn-danger">Anulada</a>
                                                        <i class="glyphicon glyphicon-bell blue" ng_show="solicitud.Confirmado!=1"></i></td>
                                                        
                                                    </td>
                                                </tr>
                                                <tfoot class="hide-if-no-paging">
                                                    <tr>
                                                        <td colspan="7" class="text-center hide-if-no-paging">
                                                            <ul display="inline" class="pagination pagination-centered hide-if-no-paging">
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
