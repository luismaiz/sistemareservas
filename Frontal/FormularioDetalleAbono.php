<?php require('Cabecera.php'); ?>


<script>
           
    var Ajax = new AjaxObj();
    
    var app = angular.module('DetalleTipoAbono', [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
    
    function CargaDetalleTipoAbono($scope, $http, $location) {
        
        $scope.tipoabono = [];
        $scope.estado = [];
        
        $scope.obtenerTiposAbono = function(idTipoAbono) {
                
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTipoAbono";
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTipoAbono";
                var Params = 'idTipoAbono='+ idTipoAbono;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                $scope.tipoabono = JSON.parse(Ajax.responseText).tipoabono;
                //$scope.sala.CapacidadSala = parseInt($scope.sala.CapacidadSala);
        
            };
            if (typeof($location.search().idTipoAbono) !== "undefined")
                $scope.obtenerTiposAbono($location.search().idTipoAbono);
            
            $scope.guardarTipoAbono = function() {
                if (typeof($location.search().idTipoAbono) !== "undefined")
                    $scope.actualizarTipoAbono();    
                else
                    $scope.crearTipoAbono();            
        
            };
            
            $scope.actualizarTipoAbono = function(){
                                   
             
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=actualizarTipoAbono";
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=actualizarTipoAbono";
                var Params = 'idTipoAbono='+ $location.search().idTipoAbono +
                    '&NombreAbono='+ document.getElementById('NombreAbono').value +
                    '&DescripcionAbono='+ document.getElementById('DescripcionAbono').value +
                    '&FechaAlta='+ document.getElementById('FechaAlta').value +
                    '&FechaBaja='+ document.getElementById('FechaBaja').value;

               
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
            
            
            $scope.crearTipoAbono = function(){
                                   
             
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=crearTipoAbono";
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=crearTipoAbono";
                var Params = 'NombreAbono='+ document.getElementById('NombreAbono').value +
                    '&DescripcionAbono='+ document.getElementById('DescripcionAbono').value +
                    '&FechaAlta='+ document.getElementById('FechaAlta').value +
                    '&FechaBaja='+ document.getElementById('FechaBaja').value;

               
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
            <a href="TipoTarifa.php">Tarifas</a>
        </li>
        <li>
            <a href="#">Detalle Abono</a>
        </li>
    </ul>
</div>
<div class=" row" ng-app="DetalleTipoAbono">
    <div ng_controller="CargaDetalleTipoAbono">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Detalle Abono</h2>
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

                <form role="form"  name="formulario">
                    
                    <input ng-model="tipoabono.idTipoAbono" type="hidden" class="input-sm" name="idTipoAbono" id="idTipoAbono">
                    <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Nombre Abono</label>
                                <input ng-model="tipoabono.NombreAbono"  type="text" class="input-sm col-md-4" name="nombreabono" id="NombreAbono" required>
                                <span style="color:red" ng-show="formulario.nombreabono.$dirty && formulario.nombreabono.$invalid">
                                <span ng-show="formulario.nombreabono.$error.required">Nombre de abono obligatorio.</span>
                                 </span>
                      </div>          
                      <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Descripción Abono</label>
                                <input ng-model="tipoabono.DescripcionAbono" ng-required=true" type="textarea" class="input-sm col-md-6"  name="descripcionabono" id="DescripcionAbono">
                                <span style="color:red" ng-show="formulario.descripcionabono.$dirty && formulario.descripcionabono.$invalid">
                                <span ng-show="formulario.descripcionabono.$error.required">Descripción de abono obligatorio.</span>
                                </span>
                      </div>
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-2 " >Fecha Alta</label>
                                <input ng-model="tipoabono.FechaAlta" type="text" class="input-sm col-md-2 col-sm-4 col-xs-4" name="FechaAlta" id="FechaAlta" ng-pattern="/^(0?[1-9]|[12][0-9]|3[01])\-(0?[1-9]|1[012])\-(199\d|[2-9]\d{3})$/" required>
                                <span class="col-md-6 col-sm-5 col-xs-12" style="color:red" ng-show="formulario.FechaAlta.$dirty && formulario.FechaAlta.$invalid">
                                    <span ng-show="formulario.FechaAlta.$error.required">* Fecha obligatoria.</span>
                                    <span ng-show="formulario.FechaAlta.$error.pattern">* Formato de fecha no valido.</span>
                                </span>
                                </span>
                                </div>
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Fecha Baja</label>
                                <input ng-model="tipoabono.FechaBaja" type="text" class="input-sm col-md-2 col-sm-4 col-xs-4" name="FechaBaja" id="FechaBaja" ng-pattern="/^(0?[1-9]|[12][0-9]|3[01])\-(0?[1-9]|1[012])\-(199\d|[2-9]\d{3})$/" required>                                     
                                <span class="col-md-6 col-sm-5 col-XS-12" style="color:red" ng-show="formulario.FechaBaja.$dirty && formulario.FechaBaja.$invalid">
                                     <span ng-show="formulario.FechaBaja.$error.pattern">* Formato de fecha no valido.</span>
                                    <span ng-show="formulario.FechaBaja.$error.required">* Fecha obligatoria.</span>
                                </span>
                                </div>
                                <input class="box btn-primary" type="button" value="Cancelar" onClick=" window.location.href='TipoAbono.php' " />
                                <input class="box btn-primary" type="submit" value="Aceptar" ng-click="guardarTipoAbono();" ng-disabled="formulario.$invalid" />
                </form>
            </div>
        </div>


    </div>

</div>
</div>
<?php require('Pie.php'); ?>
