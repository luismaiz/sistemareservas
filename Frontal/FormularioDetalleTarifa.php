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
                
                //var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTipoTarifa";
                var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TarifasBO.php?url=obtenerTipoTarifa";
                var Params = 'idTipoTarifa='+ idTipoTarifa;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                $scope.tipotarifa = JSON.parse(Ajax.responseText).tipotarifa;
                //$scope.sala.CapacidadSala = parseInt($scope.sala.CapacidadSala);
        
            };
            if (typeof($location.search().idTipoTarifa) !== "undefined")
                $scope.obtenerTiposTarifa($location.search().idTipoTarifa);
            
            $scope.guardarTipoTarifa = function() {
                if (typeof($location.search().idTipoTarifa) !== "undefined")
                    $scope.actualizarTipoTarifa();    
                else
                    $scope.crearTipoTarifa();            
        
            };
            
            $scope.actualizarTipoTarifa = function(){
                                   
             
                //var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=actualizarTipoTarifa";
                var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TarifasBO.php?url=actualizarTipoTarifa";
                var Params = 'idTipoTarifa='+ $location.search().idTipoTarifa +
                    '&NombreTarifa='+ document.getElementById('NombreTarifa').value +
                    '&DescripcionTarifa='+ document.getElementById('DescripcionTarifa').value +
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
            
            $scope.crearTipoTarifa = function(){
                                   
             
                //var Url = "http://localhost:8080/sistemareservas/Negocio/NegocioAdministrador/TarifasBO.php?url=actualizarTipoTarifa";
                var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TarifasBO.php?url=actualizarTipoTarifa";
                var Params = 'idTipoTarifa='+ $location.search().idTipoTarifa +
                    '&NombreTarifa='+ document.getElementById('NombreTarifa').value +
                    '&DescripcionTarifa='+ document.getElementById('DescripcionTarifa').value +
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
    
    
//    function TipoTarifa(){      
//        //alert(document.getElementById("idSala"));
//        if(document.getElementById("idTipoTarifa").value == "")
//            crearTipoTarifa();
//        else
//            actualizarTipoTarifa();
//    }
//    
//    function crearTipoTarifa() {	
//        //alert("crear");
//        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=crearTipoTarifa";
//        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearTipoTarifa";		
//        var Params = 'idTipoTarifa='+ document.getElementById('idTipoTarifa').value +
//            '&NombreTarifa='+ document.getElementById('NombreTarifa').value +
//            '&DescripcionTarifa='+ document.getElementById('DescripcionTarifa').value +
//            '&FechaAlta='+ document.getElementById('FechaAlta').value +
//            '&FechaBaja='+ document.getElementById('FechaBaja').value;
//
//        //alert(Params);
//	
//        Ajax.open("POST", Url, false);
//        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
//        Ajax.send(Params); // Enviamos los datos
//        
//        mostrarRespuesta(Ajax.responseText);
//    }   
//
//    function actualizarTipoTarifa() {
//        //alert("actualizar");
//        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=actualizarTipoTarifa";
//        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarTipoTarifa";
//        var Params = 'idTipoTarifa='+ document.getElementById('idTipoTarifa').value +
//            '&NombreTarifa='+ document.getElementById('NombreTarifa').value +
//            '&DescripcionTarifa='+ document.getElementById('DescripcionTarifa').value +
//            '&FechaAlta='+ document.getElementById('FechaAlta').value +
//            '&FechaBaja='+ document.getElementById('FechaBaja').value;
//
//        //alert(Params);
//	
//        Ajax.open("PUT", Url, false);
//        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
//        Ajax.send(Params); // Enviamos los datos
//        
//        mostrarRespuesta(Ajax.responseText);
//    }            
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
                            </div>
            <div class="box-content">

                <form role="form"  name="formulario">
                                <div class="form-group col-md-12">
                                <input ng-model="tipotarifa.idTipoTarifa" type="hidden" class="input-sm" name="idTipoTarifa" id="idTipoTarifa">
                                <label class="control-label col-md-2" >Nombre Tarifa</label>
                                <input ng-model="tipotarifa.NombreTarifa"  type="text" class="input-sm col-md-4" name="nombretarifa" id="NombreTarifa" required >
                                <span style="color:red" ng-show="formulario.nombretarifa.$dirty && formulario.nombretarifa.$invalid">
                                <span ng-show="formulario.nombretarifa.$error.required">Nombre de tarifa obligatorio.</span>
                                 </span>
                                </div>
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Descripción Tarifa</label>
                                <input ng-model="tipotarifa.DescripcionTarifa" ng-required=true" type="text" class="input-sm col-md-6"  name="descripciontarifa" id="DescripcionTarifa">
                                <span style="color:red" ng-show="formulario.descripciontarifa.$dirty && formulario.descripciontarifa.$invalid">
                                <span ng-show="formulario.descripciontarifa.$error.required">Descripción de tarifa obligatorio.</span>
                                 </span>
                                </div>
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Fecha Alta</label>
                                <input ng-model="tipotarifa.FechaAlta" type="date" class="input-sm" name="FechaAlta" id="FechaAlta">
                                </div>
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-2" >Fecha Baja</label>
                                <input ng-model="tipotarifa.FechaBaja" type="date" class="input-sm" name="FechaBaja" id="FechaBaja">                                     
                                </div>
                                <input class="box btn-primary " type="button" value="Cancelar" onClick=" window.location.href='TipoTarifa.php' " />
                                <input class="box btn-primary " type="submit" value="Aceptar" ng-click="guardarTipoTarifa();" ng-disabled="formulario.$invalid" />

                </form>
            </div>
        </div>


    </div>

</div>
</div>
<?php require('Pie.php'); ?>
