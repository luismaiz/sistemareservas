<?php require('Cabecera.php'); ?>

<script>
    
    var Ajax = new AjaxObj();
            var app = angular.module('BusquedaPrecios', [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
    
    function CargaBusquedaPrecios($scope, $http, $location) {
        
        $scope.obtenerTipoSolicitud = function(){
        
        //var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=obtenerTiposSolicitud";
        var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=obtenerTiposSolicitud";
        
        var Params = '';

        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
               
        $scope.tiposSolicitudes = JSON.parse(Ajax.responseText).tiposSolicitudes;
        
        };   
        $scope.obtenerTipoSolicitud();
        
        
        $scope.obtenerTipoAbono = function(){
        
        //var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTiposAbono";		
        var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTiposAbono";		
        
        var Params = '';

        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
        
        alert(Ajax.responseText);
               
        $scope.tiposAbonos = JSON.parse(Ajax.responseText).tiposAbonos;
        
        };   
        $scope.obtenerTipoAbono();
        
        
        $scope.obtenerTipoTarifa = function(){
        
        //var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTiposTarifa";		
        var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTiposTarifa";		
        
        var Params = '';

        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
               
        $scope.tiposTarifas = JSON.parse(Ajax.responseText).tiposTarifas;
        
        };   
        $scope.obtenerTipoTarifa();
        
        
        $scope.obtenerPrecios = function() {
            
                //var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/PreciosBO.php?url=obtenerPreciosFiltro";
                var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/PreciosBO.php?url=obtenerPreciosFiltro";
                
                var Params =  'TipoSolicitud=' + document.getElementById("filtroTipoSolicitud").value +
                        '&TipoAbono=' + document.getElementById("filtroTipoAbono").value +
                        '&TipoTarifa=' + document.getElementById("filtroTipoTarifa").value;
                
	        Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
  
                alert(Ajax.responseText);
                $scope.precios = JSON.parse(Ajax.responseText).precios;
                
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
    
    
    
    
    
    
    var Ajax = new AjaxObj();
    
    function obtenerPrecios() {	
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerPrecios";		
        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerPrecios";
        var Params = '';

	
        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
	
        var RespTxt = Ajax.responseText;
        
        //alert(RespTxt);
	
        var Clase = eval('(' + RespTxt + ')');	              
        
        var contenido = '<table class="table table-striped table-bordered responsive"><thead><tr><th>NombreSolicitud</th><th>NombreAbono</th><th>NombreActividad</th><th>NombrePrecio</th><th>DescripcionPrecio</th><th>Precio</th><th>FechaAlta</th><th>FechaBaja</th><th></th></tr>';
                                                    
        var div = document.getElementById("precios");                
	
        for(i=0; i<Clase.precios.length; i++){		
            //contenido = contenido + '<th>' + Clase.tiposTarifa[i].idTipoTarifa + '</th>';
            contenido = contenido + '<tr>';
            //contenido = contenido + '<td>' + Clase.precios[i].idPrecio + '</td>';
            contenido = contenido + '<td>';
            contenido = contenido + '<input type="hidden" id="idTipoSolicitud" name="idTipoSolicitud" value="' + Clase.precios[i].idTipoSolicitud + '"/>';
            contenido = contenido + obtenerTipoSolicitud(Clase.precios[i].idTipoSolicitud);
            contenido = contenido + '</td>';
            
            contenido = contenido + '<td>';
            contenido = contenido + '<input type="hidden" id="idTipoAbono" name="idTipoAbono" value="' + Clase.precios[i].idTipoAbono + '"/>';
            contenido = contenido + obtenerTipoAbono(Clase.precios[i].idTipoAbono);
            contenido = contenido + '</td>';
            
            contenido = contenido + '<td>';
            contenido = contenido + '<input type="hidden" id="idActividad" name="idActividad" value="' + Clase.precios[i].idActividad + '"/>';
            contenido = contenido + obtenerActividad(Clase.precios[i].idActividad);
            contenido = contenido + '</td>';            
            
            contenido = contenido + '<td>' + Clase.precios[i].NombrePrecio + '</td>';
            contenido = contenido + '<td>' + Clase.precios[i].DescripcionPrecio + '</td>';
            contenido = contenido + '<td>' + Clase.precios[i].Precio + '</td>';
            contenido = contenido + '<td>' + Clase.precios[i].FechaAlta + '</td>';
            contenido = contenido + '<td>' + Clase.precios[i].FechaBaja + '</td>';
            contenido = contenido + '<td class="center"><a href="FormularioDetallePrecio.php?idPrecio=' + Clase.precios[i].idPrecio + '" class="btn btn-info2"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a></td>';
            contenido = contenido + '</tr>';
        }
        contenido = contenido + '</thead></table>';
	
        div.innerHTML = contenido;	
	
        //alert('Estado: '+ Clase.estado);
        //alert('idSala: '+ Clase.salas.length);
        //alert('idSala: '+ Clase.salas[0].idSala);
        //alert('Nombre: '+ Clase.salas[0].Nombre);
        //alert('Capacidad: '+ Clase.salas[0].Capacidad);
        //alert('DescripcionTarifa: '+ Clase.salas[0].DescripcionTarifa);
	  
        //document.getElementById('idSala').value=Clase.salas[0].idSala;
        //document.getElementById('Nombre').value=Clase.salas[0].Nombre;
        //document.getElementById('Capacidad').value=Clase.salas[0].Capacidad;
        //document.getElementById('DescripcionTarifa').value=Clase.salas[0].DescripcionTarifa;
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
                            <div class="form-group">
                                <label class="control-label" >Tipo Solicitud</label>
                                <select  id="filtroTipoSolicitud" class="input-sm" >	
                                    <option ng_repeat="tiposolicitud in tiposSolicitudes" value="{{tiposolicitud.idTipoSolicitud}}">{{tiposolicitud.NombreSolicitud}}</option>
                                </select>
                                <label class="control-label" >Tipo Abono</label>
                                <select  id="filtroTipoAbono" class="input-sm" >	
                                    <option ng_repeat="tipoabono in tiposAbonos" value="{{tipoabono.idTipoAbono}}">{{tipoabono.NombreAbono}}</option>
                                </select>
                                <label class="control-label" >Tipo Tarifa</label>
                                <select  id="filtroTipoTarifa" class="input-sm" >	
                                    <option ng_repeat="tipotarifa in tiposTarifas" value="{{tipotarifa.idTipoTarifa}}">{{tipotarifa.NombreTarifa}}</option>
                                </select>
                                <input class="box btn-primary" type="button" value="Buscar" ng_click="obtenerPrecios()"/>
                            </div>	
                            <div class="box-content" id="precios">
                            <table class="table table-striped table-bordered responsive">
                                            <thead>
                                                <tr>
                                                    <th>Tipo Solicitud</h6></th>
                                                    <th>Tipo Abono</th>
                                                    <th>Tipo Tarifa</th>
                                                    <th>Precio</th>
                                                    <th></th>
                                              </thead>      
                                                </tr>
                                                <tr ng_repeat="precio in precios">
                                                    <td>{{precio.idTipoSolicitud}}</td>
                                                    <td>{{precio.idTipoAbono}}</td>
                                                    <td>{{precio.idTipoTarifa}}</td>
                                                    <td>{{precio.Precio}}</td>
                                                    <td class="center"><a href="FormularioDetallePrecio.php?idPrecio={{precio.idPrecio}}" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a></td>
                                                </tr>
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
