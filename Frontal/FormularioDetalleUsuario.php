<?php require('Cabecera.php'); ?>
<script>
           
    var Ajax = new AjaxObj();
    
    var app = angular.module('DetalleUsuario', [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
    
    function CargaDetalleUsuario($scope, $http, $location) {
        
        $scope.usuario = [];
        $scope.estado = [];
        
        $scope.obtenerUsuario = function(idUsuario) {
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/UsuariosBO.php?url=obtenerUsuario');
                
                var Params = 'idUsuario='+ idUsuario;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                $scope.usuario = JSON.parse(Ajax.responseText).usuario;                                
                $scope.usuario.TipoUsuario = parseInt($scope.usuario.TipoUsuario);
                
                if ($scope.usuario.FechaBaja !== "01-01-1970")
                {
                    document.getElementById('divBaja').style.display = 'block';
                }
                else
                {
                    $scope.usuario.FechaBaja = null;
                    document.getElementById('aceptar').style.display = 'inline';
                    
                }
                
                
                
            };
            if (typeof($location.search().idUsuario) !== "undefined")
            {
                $scope.obtenerUsuario($location.search().idUsuario);
            }
             else
            {
                document.getElementById('aceptar').style.display = 'inline';
                $scope.usuario.FechaBaja = null;
            }
            
            $scope.guardarUsuario = function() {
                if (typeof($location.search().idUsuario) !== "undefined")
                    $scope.actualizarUsuario();    
                else
                    $scope.crearUsuario();
            };
            
            $scope.crearUsuario = function(){
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/UsuariosBO.php?url=crearUsuario');
                var Params = 'NombreUsuario='+ document.getElementById('NombreUsuario').value +                    
                    '&Password='+ document.getElementById('Password').value +
                    '&TipoUsuario='+ document.getElementById('TipoUsuario').value;
               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
             
                
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    document.getElementById('divError').style.display = 'none';
                    //$scope.obtenerUsuario($location.search().idUsuario);
                }
                else
                {
                    document.getElementById('divError').style.display = 'block';
                    document.getElementById('divCorrecto').style.display = 'none';
                }
            };
            
            $scope.actualizarUsuario = function(){
                                   
             
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/UsuariosBO.php?url=actualizarUsuario');
                
                var Params = 'idUsuario='+ $location.search().idUsuario +
                    '&NombreUsuario='+ document.getElementById('NombreUsuario').value +
                    '&Password='+ document.getElementById('Password').value +
                    '&TipoUsuario='+ document.getElementById('TipoUsuario').value;
               
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
             
                
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    document.getElementById('divCorrecto').style.display = 'block';
                    $scope.obtenerUsuario($location.search().idUsuario);
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
            <a href="Usuarios.php">Usuarios</a>
        </li>
        <li>
            <a href="#">Detalle Usuario</a>
        </li>
    </ul>
</div>
<div class=" row" ng-app="DetalleUsuario">
    <div ng_controller="CargaDetalleUsuario">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Detalle Usuario</h2>
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
                                    <strong>Este Usuario se encuentra dada de baja.</strong>
                            </div>
                            </div>
            <div class="box-content">

                <form role="form"  name="formulario">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Nombre Usuario</label>
                    <input ng-model="usuario.idUsuario" type="hidden" class="input-sm col-md-4" name="idUsuario" id="idUsuario">                    
                    <input ng-model="usuario.NombreUsuario" type="text" class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12"  id="NombreUsuario" name="NombreUsuario" required/>                    
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Password</label>
                    <input ng-model="usuario.Password" type="text" class="input-sm col-lg-8 col-md-8 col-sm-10 col-xs-12" id="Password" name="Password" required/>
                    <span style="color:red" ng-show="formulario.Password.$dirty && formulario.Password.$invalid">
                                <span ng-show="formulario.Password.$error.required">Password de usuario obligatoria.</span>
                    </span>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Tipo Usuario</label>
                    <input ng-model="usuario.TipoUsuario" type="text" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" name="TipoUsuario" id="TipoUsuario" required ng-pattern="/^\d+$/"/>
                    <span  class="col-md-4 col-sm-5 col-xs-12" style="color:red" ng-show="formulario.TipoUsuario.$dirty && formulario.TipoUsuario.$invalid">
                    </span>
                    </div>    
                    
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12 " >Fecha Alta</label>
                    <input ng_disabled="true" ng-model="usuario.FechaAlta" type="text" class="input-sm col-md-2 col-sm-4 col-xs-8" name="FechaAlta" id="FechaAlta" />
                    </div>    
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Fecha Baja</label>
                    <input ng_disabled="true" ng-model="usuario.FechaBaja" type="text" class="input-sm col-md-2 col-sm-4 col-xs-8" name="FechaBaja" id="FechaBaja" />
                    </div>
                    <input style='display:none;' id="aceptar" class="btn btn-sm btn-success" type="button" value="Aceptar" ng-click="guardarUsuario()" ng-disabled="formulario.$invalid"/>
                    <input class="btn btn-sm btn-action" type="button" value="Cancelar" onClick=" window.location.href='Usuarios.php?detalle=1' " />
                </form>                        
            </div>
        </div>
    </div>
   </div>
        </div>
<?php require('Pie.php'); ?>
