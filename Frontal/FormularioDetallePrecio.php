<?php require('Cabecera.php'); ?>


<script>
           
     var Ajax = new AjaxObj();
            var app = angular.module('DetallePrecios', [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });  

     function CargaDetallePrecios($scope, $http, $location) {
      $scope.obtenerTipoSolicitud = function(){
        
        var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=obtenerTiposSolicitud";
        //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=obtenerTiposSolicitud";
        
        var Params = '';

        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
               
        $scope.tiposSolicitudes = JSON.parse(Ajax.responseText).tiposSolicitudes;
        
        
        
        };   
        $scope.obtenerTipoSolicitud();
        
        
        $scope.obtenerTipoAbono = function(){
        
        var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTiposAbono";		
        //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTiposAbono";		
        
        var Params = '';

        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
        
                       
        $scope.tiposAbonos = JSON.parse(Ajax.responseText).tiposAbonos;
        
        };   
        $scope.obtenerTipoAbono();
        
        
        $scope.obtenerTipoTarifa = function(){
        
        var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTiposTarifa";		
        //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTiposTarifa";		
        
        var Params = '';

        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
               
        $scope.tiposTarifas = JSON.parse(Ajax.responseText).tiposTarifas;
        
        };   
        $scope.obtenerTipoTarifa();
        
        
        $scope.precio = [];
            $scope.estado = [];
            
            $scope.obtenerPrecios = function(idPrecio) {
                
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/PreciosBO.php?url=obtenerPrecio";
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSala";
                var Params = 'idPrecio='+ idPrecio;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                                      
                    
                $scope.precio = JSON.parse(Ajax.responseText).precio;
                //$scope.precio.CapacidadSala = parseInt($scope.sala.CapacidadSala);
        
            };
            if (typeof($location.search().idPrecio) !== "undefined")
                $scope.obtenerPrecios($location.search().idPrecio);
            
            $scope.guardarPrecio = function() {
                if (typeof($location.search().idPrecio) !== "undefined")
                    $scope.actualizarPrecio();    
                else
                    $scope.crearPrecio();            
        
            };
            
            $scope.crearPrecio = function() {
                                
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/PreciosBO.php?url=crearPrecio";		
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/PreciosBO.php?url=crearPrecio";		
                var Params ='idTipoSolicitud='+ document.getElementById('idTipoSolicitud').value +
                            '&idTipoAbono='+ document.getElementById('idTipoAbono').value +
                            '&idTipoTarifa='+ document.getElementById('idTipoTarifa').value +
                            '&NombrePrecio='+ document.getElementById('NombrePrecio').value + 		     
                            '&DescripcionPrecio='+ document.getElementById('DescripcionPrecio').value +
                            '&Precio='+ document.getElementById('Precio').value + 		     
                            '&FechaAlta='+ document.getElementById('FechaAltaPrecio').value +
                            '&FechaBaja='+ document.getElementById('FechaBajaPrecio').value;

                
                Ajax.open("POST", Url, true);
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
//            
            $scope.actualizarPrecio = function(){
                                   
             
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/PreciosBO.php?url=actualizarPrecio";
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/PreciosBO.php?url=actualizarPrecio";
                var Params = 'IdPrecio=' + $location.search().idPrecio + +
                            '&idTipoSolicitud='+ document.getElementById('idTipoSolicitud').value +
                            '&idTipoAbono='+ document.getElementById('idTipoAbono').value +
                            '&idTipoTarifa='+ document.getElementById('idTipoTarifa').value +
                            '&NombrePrecio='+ document.getElementById('NombrePrecio').value + 		     
                            '&DescripcionPrecio='+ document.getElementById('DescripcionPrecio').value +
                            '&Precio='+ document.getElementById('Precio').value + 		     
                            '&FechaAlta='+ document.getElementById('FechaAltaPrecio').value +
                            '&FechaBaja='+ document.getElementById('FechaBajaPrecio').value;

               
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
                $( "#FechaAlta" ).datepicker({
                    dateFormat:'dd-mm-yy'
                });
            });
            
            $(function() {
                $( "#FechaBaja" ).datepicker({
                    dateFormat:'dd-mm-yy'    
                });
            });
      
</script>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="#">Precios</a>
        </li>
        <li>
            <a href="#">Detalle Precio</a>
        </li>
    </ul>
</div>
<div class=" row" ng-app="DetallePrecios">
<div ng_controller="CargaDetallePrecios">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Detalle Precio</h2>
             </div>
             <div class="box-content alerts">
                                <div class="alert alert-danger" id="divError" style='display:none;'>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Error</strong> Se ha producido un error al realizar la operación.
                                </div>
                            <div class="alert alert-success" id="divCorrecto" style='display:none;'>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Correcto.</strong>  Operación realizada con éxito.
                            </div>
                            </div>
            <div class="box-content">

                <form ole="form"  name="formulario" novalidate="true">
                    <div class="form-group col-md-12"> 
                                <label class="control-label" >Tipo Solicitud</label>
                                <select name="idTipoSolicitud" id="idTipoSolicitud  class="input-sm" >	
                                    <option ng_repeat="tiposolicitud in tiposSolicitudes" value="{{tiposolicitud.idTipoSolicitud}}">{{tiposolicitud.NombreSolicitud}}</option>
                                </select>
                    </div>
                    <div class="form-group col-md-12"> 
                                <label class="control-label" >Tipo Abono</label>
                                <select  name="idTipoAbono" id="idTipoAbono" class="input-sm" >	
                                    <option ng_repeat="tipoabono in tiposAbonos" value="{{tipoabono.idTipoAbono}}">{{tipoabono.NombreAbono}}</option>
                                </select>
                    </div>
                    <div class="form-group col-md-12"> 
                                <label class="control-label" >Tipo Tarifa</label>
                                <select ng-model="tipotarifa.idTipoTarifa" id="filtroTipoTarifa" class="input-sm" >	
                                    <option ng_repeat="tipotarifa in tiposTarifas" value="{{tipotarifa.idTipoTarifa}}">{{tipotarifa.NombreTarifa}}</option>
                                </select>
                    </div>
                    <div class="form-group col-md-12"> 
                    <label class="control-label" >NombrePrecio</label>
                    <input type="text" class="input-sm" name="NombrePrecio" id="NombrePrecio">
                    </div>
                    <div class="form-group col-md-12"> 
                    <label class="control-label" >DescripcionPrecio</label>
                    <input type="text" class="input-sm" name="DescripcionPrecio" id="DescripcionPrecio">
                    </div>
                    <div class="form-group col-md-12"> 
                    <label class="control-label" >Precio</label>
                    <input type="text" class="input-sm" name="Precio" id="Precio">
                    </div>
                    <div class="form-group col-md-12"> 
                    <label class="control-label" >FechaAlta</label>
                    <input type="text" class="input-sm col-md-2 col-sm-4 col-xs-4" name="FechaAlta" id="FechaAlta" ng-pattern="/^(0?[1-9]|[12][0-9]|3[01])\-(0?[1-9]|1[012])\-(199\d|[2-9]\d{3})$/" required>
                    <span class="col-md-6 col-sm-5 col-xs-12" style="color:red" ng-show="formulario.FechaAlta.$dirty && formulario.FechaAlta.$invalid">
                                    <span ng-show="formulario.FechaAlta.$error.required">* Fecha obligatoria.</span>
                                    <span ng-show="formulario.FechaAlta.$error.pattern">* Formato de fecha no valido.</span>
                                </span>
                    </div>
                    <div class="form-group col-md-12">
                    <label class="control-label" >FechaBaja</label>
                    <input type="text" class="input-sm col-md-2 col-sm-4 col-xs-4" name="FechaBaja" id="FechaBaja" ng-pattern="/^(0?[1-9]|[12][0-9]|3[01])\-(0?[1-9]|1[012])\-(199\d|[2-9]\d{3})$/" required>
                    <span class="col-md-6 col-sm-5 col-XS-12" style="color:red" ng-show="formulario.FechaBaja.$dirty && formulario.FechaBaja.$invalid">
                                     <span ng-show="formulario.FechaBaja.$error.pattern">* Formato de fecha no valido.</span>
                                    <span ng-show="formulario.FechaBaja.$error.required">* Fecha obligatoria.</span>
                                </span>
                    </div>   
                    <input class="box btn-primary " type="button" value="Cancelar" onClick=" window.location.href='Precios.php' " />
                    <input class="box btn-primary " type="button" value="Aceptar" onclick="crearPrecio()"/>

                </form>
            </div>
        </div>


    </div>

</div>

</div>
<?php require('Pie.php'); ?>
