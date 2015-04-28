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
                
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=obtenerTipoSolicitud";
                var Params = 'idTipoSolicitud='+ idTipoSolicitud;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                $scope.tiposolicitud = JSON.parse(Ajax.responseText).tipoSolicitud;
                //$scope.sala.CapacidadSala = parseInt($scope.sala.CapacidadSala);
        
            };
            if (typeof($location.search().idTipoSolicitud) !== "undefined")
                $scope.obtenerTiposSolicitud($location.search().idTipoSolicitud);
            
            $scope.guardarTipoSolicitud = function() {
                if (typeof($location.search().idTipoSolicitud) !== "undefined")
                    $scope.actualizarTipoSolicitud();    
                else
                    $scope.crearTipoSolicitud();            
        
            };
            
            $scope.actualizarTipoSolicitud = function(){
                                   
             
                var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/TiposSolicitudesBO.php?url=actualizarTipoSolicitud";
                var Params = 'idTipoSolicitud='+ $location.search().idTipoSolicitud +
                    '&NombreSolicitud='+ document.getElementById('NombreSolicitud').value +
                    '&DescripcionSolicitud='+ document.getElementById('DescripcionSolicitud').value +
                    '&FechaAlta='+ document.getElementById('FechaAlta').value +
                    '&FechaBaja='+ document.getElementById('FechaBaja').value;

               
                Ajax.open("PUT", Url, false);
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
          
//    var Ajax = new AjaxObj();
//            
//    function TipoSolicitud(){      
//        //alert(document.getElementById("idSala"));
//        if(document.getElementById("idSala").value == "")
//            crearTipoSolicitud();
//        else
//            actualizarTipoSolicitud();
//    }
//            
//    function crearTipoSolicitud() {
//        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearTipoSolicitud";
//        var Params = 'idTipoSolicitud='+ document.getElementById('idTipoSolicitud').value +
//            '&NombreSolicitud='+ document.getElementById('NombreSolicitud').value +
//            '&DescripcionSolicitud='+ document.getElementById('DescripcionSolicitud').value +
//            '&FechaAlta='+ document.getElementById('FechaAlta').value +
//            '&FechaBaja='+ document.getElementById('FechaBaja').value;
//
//        //alert(Params);
//	
//        Ajax.open("POST", Url, false);
//        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
//        Ajax.send(Params); // Enviamos los datos
//    }
//
//    function actualizarTipoSolicitud() {
//        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarTipoSolicitud";
//        var Params = 'idTipoSolicitud='+ document.getElementById('idTipoSolicitud').value +
//            '&NombreSolicitud='+ document.getElementById('NombreSolicitud').value +
//            '&DescripcionSolicitud='+ document.getElementById('DescripcionSolicitud').value +
//            '&FechaAlta='+ document.getElementById('FechaAlta').value +
//            '&FechaBaja='+ document.getElementById('FechaBaja').value;
//
//        //alert(Params);
//	
//        Ajax.open("PUT", Url, false);
//        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
//        Ajax.send(Params); // Enviamos los datos
//    }   
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
                            </div>
            <div class="box-content">

                <form class="form-group" name="formulario">
                    <input ng-model="tiposolicitud.idTipoSolicitud" type="hidden" class="input-sm" name="idTipoSolicitud" id="idTipoSolicitud">
                                <label class="control-label col-md-2" >Nombre Solicitud</label>
                                <input ng-model="tiposolicitud.NombreSolicitud"  type="text" class="input-sm col-md-4" name="nombresolicitud" id="NombreSolicitud" required >
                                <span style="color:red" ng-show="formulario.nombresolicitud.$dirty && formulario.nombresolicitud.$invalid">
                                <span ng-show="formulario.nombresolicitud.$error.required">Nombre de solicitud obligatorio.</span>
                                 </span>
                                </br></br>
                                
                                <label class="control-label col-md-2" >Descripción Solicitud</label>
                                <input ng-model="tiposolicitud.DescripcionSolicitud" ng-required=true" type="text" class="input-sm col-md-4"  name="descripcionsolicitud" id="DescripcionSolicitud">
                                <span style="color:red" ng-show="formulario.descripcionsolicitud.$dirty && formulario.descripcionsolicitud.$invalid">
                                <span ng-show="formulario.descripcionsolicitud.$error.required">Descripción de solicitud obligatorio.</span>
                                 </span>
                                </br></br>
                                
                                </br></br>
                                            
                                <label class="control-label" >Fecha Alta</label>
                                <input ng-model="tiposolicitud.FechaAlta" type="date" class="input-sm" name="FechaAlta" id="FechaAlta">
                                
                                <label class="control-label" >Fecha Baja</label>
                                <input ng-model="tiposolicitud.FechaBaja" type="date" class="input-sm" name="FechaBaja" id="FechaBaja">                                     
                                <input class="box btn-primary " type="button" value="Cancelar" onClick=" window.location.href='TipoSolicitud.php' " />
                                <input class="box btn-primary " type="submit" value="Aceptar" ng-click="guardarTipoSolicitud();" ng-disabled="formulario.$invalid" />

                </form>
            </div>
        </div>


    </div>

</div>
</div>

  

<?php require('Pie.php'); ?>
