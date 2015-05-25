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
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTipoAbono');
                
                var Params = 'idTipoAbono='+ idTipoAbono;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                $scope.tipoabono = JSON.parse(Ajax.responseText).tipoabono;
                if ($scope.tipoabono.FechaBaja !== "01-01-1970")
                {
                    document.getElementById('divBaja').style.display = 'block';
                    document.getElementById('activar').style.display = 'inline';
                }
                else
                {
                    $scope.tipoabono.FechaBaja = null;
                    document.getElementById('anular').style.display = 'inline';
                    document.getElementById('aceptar').style.display = 'inline';
                    document.getElementById('activar').style.display = 'none';
                }
        
            };
            if (typeof($location.search().idTipoAbono) !== "undefined")
            {
                $scope.obtenerTiposAbono($location.search().idTipoAbono);
            }
            else
            {
                document.getElementById('aceptar').style.display = 'inline';
                document.getElementById('activar').style.display = 'none';
            }
            
            $scope.guardarTipoAbono = function() {
                if (typeof($location.search().idTipoAbono) !== "undefined")
                    $scope.actualizarTipoAbono();    
                else
                    $scope.crearTipoAbono();            
        
            };
            
            $scope.crearTipoAbono = function(){
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=crearTipoAbono');
                
                var Params = 'NombreAbono='+ document.getElementById('NombreAbono').value +
                    '&DescripcionAbono='+ document.getElementById('DescripcionAbono').value;

               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
             
                
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    //$scope.obtenerTiposAbono($location.search().idTipoAbono);
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            $scope.actualizarTipoAbono = function(){
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=actualizarTipoAbono');
                
                var Params = 'idTipoAbono='+ $location.search().idTipoAbono +
                    '&NombreAbono='+ document.getElementById('NombreAbono').value +
                    '&DescripcionAbono='+ document.getElementById('DescripcionAbono').value;

               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
             
                
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    $scope.obtenerTiposAbono($location.search().idTipoAbono);
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            
                       
            
            $scope.anularTipoAbono = function(){
                
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=anularTipoAbono');
                var Params = 'idTipoAbono='+ $location.search().idTipoAbono;
                
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divBaja').style.display = 'none';
                    document.getElementById('divCorrecto').style.display = 'block';
                    $scope.obtenerTiposAbono($location.search().idTipoAbono);
                    document.getElementById('anular').style.display = 'none';
                    document.getElementById('aceptar').style.display = 'none';
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            
            $scope.activarTipoAbono = function(){
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=activarTipoAbono');
                var Params = 'idTipoAbono='+ $location.search().idTipoAbono;
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                //alert(Ajax.responseText);
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    document.getElementById('divBaja').style.display = 'none';
                    $scope.obtenerTiposAbono($location.search().idTipoAbono);
                    document.getElementById('anular').style.display = 'inline';
                    document.getElementById('aceptar').style.display = 'inline';
                    document.getElementById('activar').style.display = 'none';
                    
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
            <a href="Inicio.php">Inicio</a>
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
                            <div class="alert alert-danger" id="divBaja" style='display:none;'>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Este tipo de abono se encuentra dado de baja.</strong>
                            </div>
                            </div>
            <div class="box-content">
<div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                <form role="form"  name="formulario">
                    <input ng-model="tipoabono.idTipoAbono" type="hidden" class="input-sm" name="idTipoAbono" id="idTipoAbono">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Nombre Abono</label>
                                <input ng-disabled="tipoabono.FechaBaja!==null" ng-model="tipoabono.NombreAbono"  type="text" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="nombreabono" id="NombreAbono" required>
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.nombreabono.$dirty && formulario.nombreabono.$invalid">
                                <span ng-show="formulario.nombreabono.$error.required">* Nombre de abono obligatorio.</span>
                                 </span>
                      </div>          
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Descripción Abono</label>
                                <input ng-disabled="tipoabono.FechaBaja!==null" ng-model="tipoabono.DescripcionAbono" ng-required="true" type="textarea" class="input-sm col-lg-8 col-md-8 col-sm-10 col-xs-12"  name="descripcionabono" id="DescripcionAbono">
                                <span class="col-lg-2 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.descripcionabono.$dirty && formulario.descripcionabono.$invalid">
                                <span ng-show="formulario.descripcionabono.$error.required">* Descripción de abono obligatorio.</span>
                                </span>
                      </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12 " >Fecha Alta</label>
                                <input ng_disabled="true" ng-model="tipoabono.FechaAlta" type="text" class="input-sm col-md-2 col-sm-4 col-xs-7" name="FechaAlta" id="FechaAlta" >
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Fecha Baja</label>
                                <input ng_disabled="true" ng-model="tipoabono.FechaBaja" type="text" class="input-sm col-md-2 col-sm-4 col-xs-7" name="FechaBaja" id="FechaBaja" >                                     
                                </div>
                                <input style='display:none;' id="anular" class="btn btn-sm btn-danger" type="submit" value="Anular" ng-click="anularTipoAbono();"/>
                                <input style='display:none;' id="aceptar" class="btn btn-sm btn-success" type="submit" value="Aceptar" ng-click="guardarTipoAbono();" ng-disabled="formulario.$invalid" />
                                <input style='display:none;' id="activar" class="btn btn-sm btn-action" type="submit" value="Activar" ng-click="activarTipoAbono();"/>
                                <input class="btn btn-sm btn-action" type="button" value="Cancelar" onClick=" window.location.href='TipoAbono.php' " />
                   
                </form>
            </div>
      </div>
</div>
                </div>
    
        </div>


    </div>

</div>
</div>
<?php require('Pie.php'); ?>
