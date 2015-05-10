<?php require('Cabecera.php'); ?>


<script>
           
     var Ajax = new AjaxObj();
            var app = angular.module('DetallePrecios', [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });  

     function CargaDetallePrecios($scope, $http, $location) {
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
        
        
        $scope.obtenerTipoAbono = function(){
        
        var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTiposAbono');		
        //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTiposAbono";		
        
        var Params = '';

        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
        
                       
        $scope.tiposAbonos = JSON.parse(Ajax.responseText).tiposAbonos;
        
        };   
        $scope.obtenerTipoAbono();
        
        
        $scope.obtenerTipoTarifa = function(){
        
        var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTiposTarifa');		
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
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/PreciosBO.php?url=obtenerPrecio');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSala";
                var Params = 'idPrecio='+ idPrecio;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                                      
                    alert(Ajax.responseText);
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
                                
                                alert('hola');
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/PreciosBO.php?url=crearPrecio');		
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/PreciosBO.php?url=crearPrecio";		
                var Params ='idTipoSolicitud='+ document.getElementById('idTipoSolicitud').value +
                            '&idTipoAbono='+ document.getElementById('idTipoAbono').value +
                            '&idTipoTarifa='+ document.getElementById('idTipoTarifa').value +
                            '&NombrePrecio='+ document.getElementById('NombrePrecio').value + 		     
                            '&DescripcionPrecio='+ document.getElementById('DescripcionPrecio').value +
                            '&Precio='+ document.getElementById('Precio').value + 		     
                            '&FechaAlta='+ document.getElementById('FechaAltaPrecio').value +
                            '&FechaBaja='+ document.getElementById('FechaBajaPrecio').value;

                alert('hola2');
                Ajax.open("POST", Url, true);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                alert(Ajax.responseText);
                
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
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/PreciosBO.php?url=actualizarPrecio');
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
    <div class="box ">
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
                    <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a href="#datosprecio">Precio Actual</a></li>
                                <li><a href="#historicoprecio">Histórico</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active" id="datosprecio">
                        <h3></h3>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Tipo Solicitud</label>
                                <select name="idTipoSolicitud" id="idTipoSolicitud" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" >	
                                    <option ng_repeat="tiposolicitud in tiposSolicitudes" ng_selected="{{tiposolicitud.idTipoSolicitud}} == {{precio.idTipoSolicitud}}" value="{{tiposolicitud.idTipoSolicitud}}">{{tiposolicitud.NombreSolicitud}}</option>
                                </select>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Tipo Abono</label>
                                <select  name="idTipoAbono" id="idTipoAbono" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" >	
                                    <option ng_repeat="tipoabono in tiposAbonos" ng_selected="{{tipoabono.idTipoAbono}} == {{precio.idTipoAbono}}" value="{{tipoabono.idTipoAbono}}">{{tipoabono.NombreAbono}}</option>
                                </select>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Tipo Tarifa</label>
                                <select name="idTipoTarifa" id="idTipoTarifa" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" >	
                                    <option ng_repeat="tipotarifa in tiposTarifas" ng_selected="{{tipotarifa.idTipoTarifa}} == {{precio.idTipoTarifa}}" value="{{tipotarifa.idTipoTarifa}}">{{tipotarifa.NombreTarifa}}</option>
                                </select>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                    <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >NombrePrecio</label>
                    <input type="text" ng-model="precio.NombrePrecio"   class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="NombrePrecio" id="NombrePrecio">
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                    <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >DescripcionPrecio</label>
                    <input type="text" ng-model="precio.DescripcionPrecio"   class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="DescripcionPrecio" id="DescripcionPrecio">
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                    <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Precio</label>
                    <input type="text" ng-model="precio.Precio" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" name="Precio" id="Precio">
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                    <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >FechaAlta</label>
                    <input ng-model="precio.FechaAlta" type="text" class="input-sm col-md-2 col-sm-4 col-xs-7" name="FechaAlta" id="FechaAlta" ng-pattern="/^(0?[1-9]|[12][0-9]|3[01])\-(0?[1-9]|1[012])\-(199\d|[2-9]\d{3})$/" required>
                    <span class="col-md-6 col-sm-5 col-xs-12" style="color:red" ng-show="formulario.FechaAlta.$dirty && formulario.FechaAlta.$invalid">
                                    <span ng-show="formulario.FechaAlta.$error.required">* Fecha obligatoria.</span>
                                    <span ng-show="formulario.FechaAlta.$error.pattern">* Formato de fecha no valido.</span>
                                </span>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >FechaBaja</label>
                    <input ng-model="precio.FechaBaja"  type="text" class="input-sm col-md-2 col-sm-4 col-xs-7" name="FechaBaja" id="FechaBaja" ng-pattern="/^(0?[1-9]|[12][0-9]|3[01])\-(0?[1-9]|1[012])\-(199\d|[2-9]\d{3})$/" required>
                    <span class="col-md-6 col-sm-5 col-XS-12" style="color:red" ng-show="formulario.FechaBaja.$dirty && formulario.FechaBaja.$invalid">
                                     <span ng-show="formulario.FechaBaja.$error.pattern">* Formato de fecha no valido.</span>
                                    <span ng-show="formulario.FechaBaja.$error.required">* Fecha obligatoria.</span>
                                </span>
                    </div>   
                    </div>
                    <div class="tab-pane active" id="historicoprecio">
                        <h3></h3>
                    </div>
                    <input class="box btn-primary " type="button" value="Cancelar" onClick=" window.location.href='Precios.php?detalle=1' " />
                    <input class="box btn-primary " type="button" value="Aceptar" onclick="crearPrecio()"/>
                    

                </form>
            </div>
        </div>


    </div>

</div>

</div>
<?php require('Pie.php'); ?>
