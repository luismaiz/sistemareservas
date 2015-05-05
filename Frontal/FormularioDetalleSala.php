<?php require('Cabecera.php'); ?> 
<script>
           
            var Ajax = new AjaxObj();
            var app = angular.module('DetalleSala', [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
                
            function CargaDetalleSala($scope, $http, $location) {
       
            $scope.sala = [];
            $scope.estado = [];
            $scope.msg = [];
            $scope.obtenerSalas = function(idSala) {
                
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSala";
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSala";
                var Params = 'idSala='+ idSala;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                    
                    
                $scope.sala = JSON.parse(Ajax.responseText).sala;
                $scope.sala.CapacidadSala = parseInt($scope.sala.CapacidadSala);
        
            };
            if (typeof($location.search().idSala) !== "undefined")
                $scope.obtenerSalas($location.search().idSala);
            
            $scope.guardarSala = function() {
                if (typeof($location.search().idSala) !== "undefined")
                    $scope.actualizarSala();    
                else
                    $scope.crearSala();            
        
            };
            
            $scope.crearSala = function() {
                                
                
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/SalasBO.php?url=crearSala";		
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=crearSala";		
                var Params ='NombreSala='+ document.getElementById('NombreSala').value +
                    '&CapacidadSala='+ document.getElementById('CapacidadSala').value +
                    '&DescripcionSala='+ document.getElementById('DescripcionSala').value +
                    '&FechaAlta='+ document.getElementById('FechaAlta').value +
                    '&FechaBaja='+ document.getElementById('FechaBaja').value;

                
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
            $scope.actualizarSala = function(){
                                   
             
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/SalasBO.php?url=actualizarSala";
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/SalasBO.php?url=actualizarSala";
                var Params = 'idSala='+ $location.search().idSala +
                    '&NombreSala='+ document.getElementById('NombreSala').value +
                    '&CapacidadSala='+ document.getElementById('CapacidadSala').value +
                    '&DescripcionSala='+ document.getElementById('DescripcionSala').value +
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
            <a href="Salas.php">Salas</a>
        </li>
        <li>
            <a href="#">Detalle Sala</a>
        </li>
    </ul>
</div>
<div class=" row" ng-app="DetalleSala">
<div ng_controller="CargaDetalleSala">
<div class="box col-md-12">
                        <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Detalle Sala</h2>
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
                            <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                            <form role="form"  name="formulario">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                 <input ng-model="sala.idSala" type="hidden" class="input-sm" name="idSala" id="idSala">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Nombre Sala</label>
                                <input type="text" ng-model="sala.NombreSala"   class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="nombresala" id="NombreSala" required >
                                <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.nombresala.$dirty && formulario.nombresala.$invalid">
                                <span ng-show="formulario.nombresala.$error.required">* Nombre de sala obligatorio.</span>
                                 </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Descripción</label>
                                <input type="text" ng-model="sala.DescripcionSala"  class="input-sm col-lg-8 col-md-8 col-sm-10 col-xs-12"  name="descripcionsala" id="DescripcionSala" required>
                                <span class="col-lg-2 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.descripcionsala.$dirty && formulario.descripcionsala.$invalid">
                                <span ng-show="formulario.descripcionsala.$error.required">* Descripción de sala obligatorio.</span>
                                </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">                                
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Capacidad</label>
                                <input type="text" ng-model="sala.CapacidadSala"  class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" name="capacidadsala" id="CapacidadSala" required ng-pattern="/^\d+$/"  >
                                <span  class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.capacidadsala.$dirty && formulario.capacidadsala.$invalid">
                                    <span ng-show="formulario.capacidadsala.$error.required">* Capacidad de sala obligatoria.</span>
                                    <span ng-show="formulario.capacidadsala.$error.pattern">* Capacidad de sala numérica.</span>
                                </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Fecha Alta</label>
                                <input ng-model="sala.FechaAlta" type="text" class="input-sm col-md-2 col-sm-4 col-xs-7" name="FechaAlta" id="FechaAlta" ng-pattern="/^(0?[1-9]|[12][0-9]|3[01])\-(0?[1-9]|1[012])\-(199\d|[2-9]\d{3})$/" required>
                                <span class="col-md-6 col-sm-5 col-xs-12" style="color:red" ng-show="formulario.FechaAlta.$dirty && formulario.FechaAlta.$invalid">
                                    <span ng-show="formulario.FechaAlta.$error.required">* Fecha obligatoria.</span>
                                    <span ng-show="formulario.FechaAlta.$error.pattern">* Formato de fecha no valido.</span>
                                </span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Fecha Baja</label>
                                <input ng-model="sala.FechaBaja" type="text" class="input-sm col-md-2 col-sm-4 col-xs-7" name="FechaBaja" id="FechaBaja" ng-pattern="/^(0?[1-9]|[12][0-9]|3[01])\-(0?[1-9]|1[012])\-(199\d|[2-9]\d{3})$/" required>
                                <span class="col-md-6 col-sm-5 col-xs-12" style="color:red" ng-show="formulario.FechaBaja.$dirty && formulario.FechaBaja.$invalid">
                                     <span ng-show="formulario.FechaBaja.$error.pattern">* Formato de fecha no valido.</span>
                                    <span ng-show="formulario.FechaBaja.$error.required">* Fecha obligatoria.</span>
                                </span>
                                </div>
                                <div class="form-group col-md-12">
                                <input class="box btn-primary" type="button" value="Cancelar" onClick=" window.location.href='Salas.php' " />
                                <input class="box btn-primary" type="submit" value="Aceptar" ng-click="guardarSala();" ng-disabled="formulario.$invalid" />
                                </div>
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
