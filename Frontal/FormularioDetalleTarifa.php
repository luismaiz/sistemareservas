<?php require('Cabecera.php'); ?>


<script>
           
    var Ajax = new AjaxObj();
    
    var app = angular.module('DetalleTipoTarifa', [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
    
    function CargaDetalleTipoTarifa($scope, $http, $location) {
        
        $scope.tipotarifa = [];
        $scope.estado = [];
        
        $scope.obtenerTiposTarifa = function(idTipoTarifa) {
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTipoTarifa');
                
                var Params = 'idTipoTarifa='+ idTipoTarifa;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                $scope.tipotarifa = JSON.parse(Ajax.responseText).tipotarifa;
                
                if ($scope.tipotarifa.FechaBaja !== "01-01-1970")
                {
                    document.getElementById('divBaja').style.display = 'block';
                    document.getElementById('activar').style.display = 'inline';
                }
                else
                {
                    $scope.tipotarifa.FechaBaja = null;
                    document.getElementById('anular').style.display = 'inline';
                    document.getElementById('aceptar').style.display = 'inline';
                }
        
            };
            if (typeof($location.search().idTipoTarifa) !== "undefined")
            {
                $scope.obtenerTiposTarifa($location.search().idTipoTarifa);
            }
            else
            {
                document.getElementById('aceptar').style.display = 'inline';
            }
            
            $scope.guardarTipoTarifa = function() {
                if (typeof($location.search().idTipoTarifa) !== "undefined")
                    $scope.actualizarTipoTarifa();    
                else
                    $scope.crearTipoTarifa();            
        
            };
            $scope.crearTipoTarifa = function(){
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=crearTipoTarifa');
                
                var Params = 'idTipoTarifa='+ $location.search().idTipoTarifa +
                    '&NombreTarifa='+ document.getElementById('NombreTarifa').value +
                    '&DescripcionTarifa='+ document.getElementById('DescripcionTarifa').value;

               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
             
           
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    $scope.obtenerTiposTarifa($location.search().idTipoTarifa);
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            
            $scope.actualizarTipoTarifa = function(){
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=actualizarTipoTarifa');
                
                var Params = 'idTipoTarifa='+ $location.search().idTipoTarifa +
                    '&NombreTarifa='+ document.getElementById('NombreTarifa').value +
                    '&DescripcionTarifa='+ document.getElementById('DescripcionTarifa').value;

               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
             
            
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    $scope.obtenerTiposTarifa($location.search().idTipoTarifa);
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            
            
            
            $scope.anularTipoTarifa = function(){
                
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=anularTipoTarifa');
                var Params = 'idTipoTarifa='+ $location.search().idTipoTarifa;
                
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                //alert(Ajax.responseText);    
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divBaja').style.display = 'none';
                    document.getElementById('divCorrecto').style.display = 'block';
                    $scope.obtenerTiposTarifa($location.search().idTipoTarifa);
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            
            $scope.activarTipoTarifa = function(){
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=activarTipoTarifa');
                var Params = 'idTipoTarifa='+ $location.search().idTipoTarifa;
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                //alert(Ajax.responseText);
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    $scope.obtenerTiposTarifa($location.search().idTipoTarifa);
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
            <a href="#">Detalle Tarifa</a>
        </li>
    </ul>
</div>
<div class=" row" ng-app="DetalleTipoTarifa">
    <div ng_controller="CargaDetalleTipoTarifa">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Detalle Tarifa</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
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
                                    <strong>Este tipo de tarifa se encuentra dada de baja.</strong>
                            </div>
                            </div>
            <div class="box-content">
<div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                <form role="form"  name="formulario">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input ng-model="tipotarifa.idTipoTarifa" type="hidden" class="input-sm" name="idTipoTarifa" id="idTipoTarifa">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Nombre Tarifa</label>
                                <input ng-model="tipotarifa.NombreTarifa"  type="text" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="nombretarifa" id="NombreTarifa" required >
                                <span style="color:red" ng-show="formulario.nombretarifa.$dirty && formulario.nombretarifa.$invalid">
                                <span ng-show="formulario.nombretarifa.$error.required">Nombre de tarifa obligatorio.</span>
                                 </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Descripción Tarifa</label>
                                <input ng-model="tipotarifa.DescripcionTarifa" ng-required="true" type="text" class="input-sm col-lg-8 col-md-8 col-sm-10 col-xs-12"  name="descripciontarifa" id="DescripcionTarifa">
                                <span style="color:red" ng-show="formulario.descripciontarifa.$dirty && formulario.descripciontarifa.$invalid">
                                <span ng-show="formulario.descripciontarifa.$error.required">Descripción de tarifa obligatorio.</span>
                                 </span>
                                </div>
                                 <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12 " >Fecha Alta</label>
                                <input ng_disabled="true" ng-model="tipotarifa.FechaAlta" type="text" class="input-sm col-md-2 col-sm-4 col-xs-8" name="FechaAlta" id="FechaAlta" >
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Fecha Baja</label>
                                <input ng_disabled="true" ng-model="tipotarifa.FechaBaja" type="text" class="input-sm col-md-2 col-sm-4 col-xs-8" name="FechaBaja" id="FechaBaja" >                                     
                                </div>
                                <input style='display:none;' id="anular" class="btn btn-sm btn-danger" type="submit" value="Anular" ng-click="anularTipoTarifa();"/>
                                <input style='display:none;' id="aceptar" class="btn btn-sm btn-success" type="submit" value="Aceptar" ng-click="guardarTipoTarifa();" ng-disabled="formulario.$invalid" />
                                <input style='display:none;' id="activar" class="btn btn-sm btn-action" type="submit" value="Activar" ng-click="activarTipoTarifa();"/>
                                <input class="btn btn-sm btn-action" type="button" value="Cancelar" onClick=" window.location.href='TipoTarifa.php?detalle=1' " />

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
