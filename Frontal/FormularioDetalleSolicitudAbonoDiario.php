<?php require('Cabecera.php'); ?>
<!--<script>
           
            var Ajax = new AjaxObj();
                
<<<<<<< HEAD
            function crearSala() {
                var Url = "http://localhost/sistemareservas/AdministradorBO.php?url=crearSala";		
                var Params ='&NombreSala='+ document.getElementById('NombreSala').value +
                    '&CapacidadSala='+ document.getElementById('CapacidadSala').value +
                    '&DescripcionSala='+ document.getElementById('DescripcionSala').value +
                    '&FechaAlta='+ document.getElementById('FechaAlta').value +
                    '&FechaBaja='+ document.getElementById('FechaBaja').value;

                alert(Params);
	
	
                Ajax.open("POST", Url, true);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
            }


            function actualizarSala() {
                var Url = "http://localhost/Sistemareservas/AdministradorBO.php?url=actualizarSala";
                var Params = 'idSala='+ document.getElementById('idSala').value +
                    '&NombreSala='+ document.getElementById('NombreSala').value +
                    '&CapacidadSala='+ document.getElementById('CapacidadSala').value +
                    '&DescripcionSala='+ document.getElementById('DescripcionSala').value +
                    '&FechaAlta='+ document.getElementById('FechaAlta').value +
                    '&FechaBaja='+ document.getElementById('FechaBaja').value;

	
                Ajax.open("PUT", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
            }

            function borrarSala() {
                var Url = "http://localhost/Sistemareservas/AdministradorBO.php?url=borrarSala";
                var Params = 'idSala='+ document.getElementById('idSala').value;

	
                Ajax.open("DELETE", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
            }
            //coge una variable dada(por su número empezando desde 0 o su nombre)             
            function getVariable(variable){ 
		             
                var tipo = typeof variable; 
                var direccion = location.href; 
		                 
                if (tipo == "string"){ 
                    var posicion = direccion.indexOf("?"); 
                    posicion = direccion.indexOf(variable,posicion) + variable.length; 
                } 
                else if (tipo == "number"){ 
                    var posicion=0; 
                    for (var contador = 0 ; contador < variable + 1 ; contador++){ 
                        posicion = direccion.indexOf("=",++posicion); 
                        if (posicion == -1)posicion=999; 
                    } 
                } 
                if (direccion.charAt(posicion) == "="){ 
                    var ultima = direccion.indexOf("&",posicion); 
                    if (ultima == -1){ultima=direccion.length;}; 
                    return direccion.substring(posicion + 1,ultima); 
                } 
            } 

            function obtenerSala() {
                alert("dfjkaldjlafj");
                alert(getVariable("idSala"));
                var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerSala";
                var Params = 'idSala='+ document.getElementById('idSala').value;

	
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
	
                var RespTxt = Ajax.responseText;
	
                alert("Resultado:" + RespTxt);
	
                //alert(eval('(' + RespTxt + ')'));
                //alert("Prueba: " + $.parseJSON(RespTxt));
                //var Clase = eval('(' + RespTxt + ')');
                var Clase = eval('(' + RespTxt + ')');	
	
                //eval('(' + RespTxt + ')');
                alert(Clase);
                alert('Estado: '+ Clase.estado);
                alert('idSala: '+ Clase.sala.idSala);
                alert('NombreSala: '+ Clase.sala.NombreSala);
                alert('CapacidadSala: '+ Clase.sala.CapacidadSala);
                alert('DescripcionSala: '+ Clase.sala.DescripcionSala);
	  
                document.getElementById('idSala').value=Clase.sala.idSala;
                document.getElementById('NombreSala').value=Clase.sala.NombreSala;
                document.getElementById('CapacidadSala').value=Clase.sala.CapacidadSala;
                document.getElementById('DescripcionSala').value=Clase.sala.DescripcionSala;
                document.getElementById('FechaAlta').value=Clase.sala.FechaAlta;
                document.getElementById('FechaBaja').value=Clase.sala.FechaBaja;                
            }
            
        </script>
=======
            var app = angular.module('DetalleAbonoDiario', [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
                      
            function CargaDetalleAbonoDiario($scope, $http, $location) {
                
                alert('hola');
            }          
                        
        </script>-->
>>>>>>> 2d0608445159c82d4e918578dcf6eb0173a078f7
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
