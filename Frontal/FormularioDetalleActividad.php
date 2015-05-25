<?php require('Cabecera.php'); ?>
<script>
           
    var Ajax = new AjaxObj();
    
    var app = angular.module('DetalleActividad', [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
    
    function CargaDetalleActividad($scope, $http, $location) {
        
        $scope.actividad = [];
        $scope.estado = [];
        
        $scope.obtenerActividad = function(idActividad) {
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividad');
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividad";
                var Params = 'idActividad='+ idActividad;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                $scope.actividad = JSON.parse(Ajax.responseText).actividad;
                                
                $scope.actividad.EdadMinima = parseInt($scope.actividad.EdadMinima);
                $scope.actividad.EdadMaxima = parseInt($scope.actividad.EdadMaxima);
                
                if ($scope.actividad.FechaBaja !== "01-01-1970")
                {
                    document.getElementById('divBaja').style.display = 'block';
                    document.getElementById('activar').style.display = 'inline';
                }
                else
                {
                    $scope.actividad.FechaBaja = null;
                    document.getElementById('anular').style.display = 'inline';
                    document.getElementById('aceptar').style.display = 'inline';
                    document.getElementById('activar').style.display = 'none';
                }
            };
            if (typeof($location.search().idActividad) !== "undefined")
            {
                $scope.obtenerActividad($location.search().idActividad);
            }
             else
            {
                document.getElementById('aceptar').style.display = 'inline';
                //document.getElementById('activar').style.display = 'none';
            }
            
            $scope.guardarActividad = function() {
                if (typeof($location.search().idActividad) !== "undefined")
                    $scope.actualizarActividad();    
                else
                    $scope.crearActividad();            
        
            };
            
            $scope.crearActividad = function(){
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=crearActividad');
                var Params = 'NombreActividad='+ document.getElementById('NombreActividad').value +
                    '&IntensidadActividad='+ document.getElementById('IntensidadActividad').value +
                    '&Descripcion='+ document.getElementById('Descripcion').value +
                    '&Grupo='+ document.getElementById('Grupo').value +
                    '&EdadMinima='+ document.getElementById('EdadMinima').value +
                    '&EdadMaxima='+ document.getElementById('EdadMaxima').value;
               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
             
                
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    //$scope.obtenerActividad($location.search().idActividad);
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            
            $scope.actualizarActividad = function(){
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=actualizarActividad');
                
                var Params = 'idActividad='+ $location.search().idActividad +
                    '&NombreActividad='+ document.getElementById('NombreActividad').value +
                    '&IntensidadActividad='+ document.getElementById('IntensidadActividad').value +
                    '&Descripcion='+ document.getElementById('Descripcion').value +
                    '&Grupo='+ document.getElementById('Grupo').value +
                    '&EdadMinima='+ document.getElementById('EdadMinima').value +
                    '&EdadMaxima='+ document.getElementById('EdadMaxima').value;
               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
             
                
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    $scope.obtenerActividad($location.search().idActividad);
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
               
            
            
            $scope.anularActividad = function(){
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=anularActividad');
                var Params = 'idActividad='+ $location.search().idActividad;
                
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divBaja').style.display = 'inline';
                    document.getElementById('divCorrecto').style.display = 'block';
                    $scope.obtenerActividad($location.search().idActividad);
                    document.getElementById('anular').style.display = 'none';
                    document.getElementById('aceptar').style.display = 'none';
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                }
            };
            
            $scope.activarActividad = function(){
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=activarActividad');
                var Params = 'idActividad='+ $location.search().idActividad;
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    document.getElementById('divBaja').style.display = 'none';
                    $scope.obtenerActividad($location.search().idActividad);
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
            <a href="Actividades.php">Actividades</a>
        </li>
        <li>
            <a href="#">Detalle Actividad</a>
        </li>
    </ul>
</div>
<div class=" row" ng-app="DetalleActividad">
    <div ng_controller="CargaDetalleActividad">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Detalle Actividad</h2>
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
                                    <strong>Esta actividad se encuentra dada de baja.</strong>
                            </div>
                            </div>
            <div class="box-content">

                <form role="form"  name="formulario">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Nombre Actividad</label>
                    <input ng-model="actividad.idActividad" type="hidden" class="input-sm col-md-4" name="idActividad" id="idActividad">                    
                    <input ng-disabled="actividad.FechaBaja!==null" ng-model="actividad.NombreActividad" type="text" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12"  id="NombreActividad" name="NombreActividad" required/>
                    <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.NombreActividad.$dirty && formulario.NombreActividad.$invalid">
                                <span ng-show="formulario.NombreActividad.$error.required">* Nombre de actividad obligatorio.</span>
                    </span>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Descripcion</label>
                    <input ng-disabled="actividad.FechaBaja!==null" ng-model="actividad.DescripcionActividad" type="text" class="input-sm col-lg-8 col-md-8 col-sm-10 col-xs-12" id="Descripcion" name="Descripcion" required/>
                    <span class="col-lg-2 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.Descripcion.$dirty && formulario.Descripcion.$invalid">
                                <span ng-show="formulario.Descripcion.$error.required">* Descripción de actividad obligatorio.</span>
                    </span>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Intensidad Actividad</label>
                    <input ng-disabled="actividad.FechaBaja!==null" class="input-sm color" ng-model="actividad.IntensidadActividad"   id="IntensidadActividad" name="IntensidadActividad" required>
                    <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12"  style="color:red" ng-show="formulario.IntensidadActividad.$dirty && formulario.IntensidadActividad.$invalid">
                                <span ng-show="formulario.IntensidadActividad.$error.required">* Intensidad de actividad obligatorio.</span>
                    </span>
                   
                    </div>    
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Edad Mínima</label>
                    <input ng-disabled="actividad.FechaBaja!==null" ng-model="actividad.EdadMinima" type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" name="EdadMinima" id="EdadMinima" required ng-pattern="/^\d+$/"/>
                    <span  class="col-md-4 col-sm-5 col-xs-12" style="color:red" ng-show="formulario.EdadMinima.$dirty && formulario.EdadMinima.$invalid">
                                    <span ng-show="formulario.EdadMinima.$error.required">* Edad Mínima  obligatoria.</span>
                                    <span ng-show="formulario.EdadMinima.$error.pattern">* Edad Mínima debe ser un valor numérico.</span>
                                </span>
                    </div>    
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Edad Máxima</label>
                    <input ng-disabled="actividad.FechaBaja!==null" ng-model="actividad.EdadMaxima" type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" name="EdadMaxima" id="EdadMaxima" required ng-pattern="/^\d+$/"/>
                    <span  class="col-md-4 col-sm-5 col-xs-12" style="color:red" ng-show="formulario.EdadMaxima.$dirty && formulario.EdadMaxima.$invalid">
                                    <span ng-show="formulario.EdadMaxima.$error.required">* Edad Máxima  obligatoria.</span>
                                    <span ng-show="formulario.EdadMaxima.$error.pattern">* Edad Máxima debe ser un valor numérico.</span>
                                </span>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label ng_show="false" class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Grupo</label>
                    <input ng_show="false" ng-model="actividad.Grupo" type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" id="Grupo" name="Grupo"/>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12 " >Fecha Alta</label>
                    <input ng_disabled="true" ng-model="actividad.FechaAlta" type="text" class="input-sm col-md-2 col-sm-4 col-xs-8" name="FechaAlta" id="FechaAlta" />
                    </div>    
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Fecha Baja</label>
                    <input ng_disabled="true" ng-model="actividad.FechaBaja" type="text" class="input-sm col-md-2 col-sm-4 col-xs-8" name="FechaBaja" id="FechaBaja" />
                    </div>
                     <input style='display:none;' id="anular" class="btn btn-sm btn-danger" type="submit" value="Anular" ng-click="anularActividad();"/>
                     <input style='display:none;' id="aceptar" class="btn btn-sm btn-success" type="submit" value="Aceptar" ng-click="guardarActividad();" ng-disabled="formulario.$invalid" />
                     <input style='display:none;' id="activar" class="btn btn-sm btn-action" type="submit" value="Activar" ng-click="activarActividad();"/>
                     <input class="btn btn-sm btn-action" type="button" value="Cancelar" onClick=" window.location.href='Actividades.php' " />
                </form>
            </div>
        </div>
    </div>
    </div>
</div>

<?php require('Pie.php'); ?>
