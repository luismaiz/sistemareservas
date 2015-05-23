<?php require('Cabecera.php'); ?>


<script>
          
     var Ajax = new AjaxObj();
    
    var app = angular.module('DetalleTipoSolicitud', [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });      
          
      function CargaDetalleTipoSolicitud($scope, $http, $location) {
        
        $scope.tiposolicitud = [];
        $scope.estado = [];
        
        $scope.obtenerTiposSolicitud = function(idTipoSolicitud) {
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=obtenerTipoSolicitud');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=obtenerTipoSolicitud";
                var Params = 'idTipoSolicitud='+ idTipoSolicitud;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                $scope.tiposolicitud = JSON.parse(Ajax.responseText).tipoSolicitud;
                if ($scope.tiposolicitud.FechaBaja !== "01-01-1970")
                {
                    document.getElementById('divBaja').style.display = 'block';
                    document.getElementById('activar').style.display = 'inline';
                }
                else
                {
                    $scope.tiposolicitud.FechaBaja = null;
                    document.getElementById('anular').style.display = 'inline';
                    document.getElementById('aceptar').style.display = 'inline';
                    document.getElementById('activar').style.display = 'none';
                }
        
            };
            if (typeof($location.search().idTipoSolicitud) !== "undefined")
            {
                $scope.obtenerTiposSolicitud($location.search().idTipoSolicitud);
            }
            else
            {
                document.getElementById('aceptar').style.display = 'inline';
            }
            
            $scope.guardarTipoSolicitud = function() {
                if (typeof($location.search().idTipoSolicitud) !== "undefined")
                    $scope.actualizarTipoSolicitud();    
                else
                    $scope.crearTipoSolicitud();            
        
            };
            
            $scope.crearTipoSolicitud = function(){
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=crearTipoSolicitud');
                
                var Params = 'NombreSolicitud='+ document.getElementById('NombreSolicitud').value +
                    '&DescripcionSolicitud='+ document.getElementById('DescripcionSolicitud').value;

               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
             
                alert(Ajax.responseText);
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    //$scope.obtenerTiposSolicitud($location.search().idTipoSolicitud);
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            $scope.actualizarTipoSolicitud = function(){
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=actualizarTipoSolicitud');
                
                var Params = 'idTipoSolicitud='+ $location.search().idTipoSolicitud +
                    '&NombreSolicitud='+ document.getElementById('NombreSolicitud').value +
                    '&DescripcionSolicitud='+ document.getElementById('DescripcionSolicitud').value;

               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
             
            
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    $scope.obtenerTiposSolicitud($location.search().idTipoSolicitud);
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            
            
            
            $scope.anularTipoSolicitud = function(){
                
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=anularTipoSolicitud');
                var Params = 'idTipoSolicitud='+ $location.search().idTipoSolicitud;
                
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                //alert(Ajax.responseText);    
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divBaja').style.display = 'none';
                    document.getElementById('divCorrecto').style.display = 'block';
                    $scope.obtenerTiposSolicitud($location.search().idTipoSolicitud);
                    document.getElementById('anular').style.display = 'none';
                    document.getElementById('aceptar').style.display = 'none';
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            
            $scope.activarTipoSolicitud = function(){
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=activarTipoSolicitud');
                var Params = 'idTipoSolicitud='+ $location.search().idTipoSolicitud;
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                //alert(Ajax.responseText);
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    document.getElementById('divBaja').style.display = 'none';
                    $scope.obtenerTiposSolicitud($location.search().idTipoSolicitud);
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
            <a href="TipoSolicitud.php">Solicitudes</a>
        </li>
        <li>    
            <a href="#">Detalle Tipo Solicitud</a>
        </li>
    </ul>
</div>
<div class=" row" ng-app="DetalleTipoSolicitud">
    <div ng_controller="CargaDetalleTipoSolicitud">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Detalle Solicitud</h2>
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
                                    <strong>Este tipo de solicitud se encuentra dado de baja.</strong>
                            </div>
                            </div>
            <div class="box-content">
<div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                <form role="form"  name="formulario">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input ng-model="tiposolicitud.idTipoSolicitud" type="hidden" class="input-sm" name="idTipoSolicitud" id="idTipoSolicitud">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Nombre Solicitud</label>
                                <input ng-model="tiposolicitud.NombreSolicitud"  type="text" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="nombresolicitud" id="NombreSolicitud" required >
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.nombresolicitud.$dirty && formulario.nombresolicitud.$invalid">
                                <span ng-show="formulario.nombresolicitud.$error.required">* Nombre de solicitud obligatorio.</span>
                                 </span>
                    </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Descripción Solicitud</label>
                                <input ng-model="tiposolicitud.DescripcionSolicitud" ng-required="true" type="text" class="input-sm col-lg-8 col-md-8 col-sm-10 col-xs-12"  name="descripcionsolicitud" id="DescripcionSolicitud">
                                <span class="col-lg-2 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.descripcionsolicitud.$dirty && formulario.descripcionsolicitud.$invalid">
                                <span ng-show="formulario.descripcionsolicitud.$error.required">* Descripción de solicitud obligatoria.</span>
                                 </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12 " >Fecha Alta</label>
                                <input ng_disabled="true" ng-model="tiposolicitud.FechaAlta" type="text" class="input-sm col-md-2 col-sm-4 col-xs-8" name="FechaAlta" id="FechaAlta" >
                                </div>
                               <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Fecha Baja</label>
                                <input ng_disabled="true" ng-model="tiposolicitud.FechaBaja" type="text" class="input-sm col-md-2 col-sm-4 col-xs-8" name="FechaBaja" id="FechaBaja" >                                     
                                </div>
                                <input style='display:none;' id="aceptar" class="btn btn-sm btn-success" type="submit" value="Aceptar" ng-click="guardarTipoSolicitud();" ng-disabled="formulario.$invalid" />
                                <input style='display:none;' id="anular" class="btn btn-sm btn-danger" type="submit" value="Anular" ng-click="anularTipoSolicitud();"/>
                                <input style='display:none;' id="activar" class="btn btn-sm btn-action" type="submit" value="Activar" ng-click="activarTipoSolicitud();"/>
                                <input class="btn btn-sm btn-action" type="button" value="Cancelar" onClick=" window.location.href='TipoSolicitud.php' " />

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
