<?php require('Cabecera.php'); ?>
<!--<script>
           
            var Ajax = new AjaxObj();
                
           var app = angular.module('DetalleAbonoDiario', [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
                      
            function CargaDetalleAbonoDiario($scope, $http, $location) {
                
                alert('hola');
            }          
                        
        </script>-->
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="Reservas.php">Reservas</a>
        </li>
        <li>
            <a href="#">Detalle Abono Diario</a>
        </li>
    </ul>
</div>
<div class=" row" ng-app="DetalleAbonoDiario">
    <div ng_controller="CargaDetalleAbonoDiario">
<div class="box col-md-12">
                        <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Detalle Abono</h2>
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
                            </div>
                        <div class="box-content" >
                            
<!--                            <form class="form-group" name="formulario">
                               
                            </form>-->
                        </div>
                        </div>


                        </div>
    </div>
</div>

<?php require('Pie.php'); ?>
