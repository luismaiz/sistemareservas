<?php require('headerReservas.php'); ?>
<script>
           
            var Ajax = new AjaxObj();
                
           function crearActividad() {	
			     alert("hola");
                //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=crearActividad";		
                var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=crearActividad";		        
	
                var Params = '&NombreActividad='+ document.getElementById('NombreActividad').value +
                    '&IntensidadActividad='+ document.getElementById('IntensidadActividad').value +
                    '&Edad_Minima='+ document.getElementById('Edad_Minima').value +
                    '&Edad_Maxima='+ document.getElementById('Edad_Maxima').value +
                    '&Grupo='+ document.getElementById('Grupo').value +
                    '&Descripcion='+ document.getElementById('Descripcion').value +
                    '&FechaAlta='+ document.getElementById('FechaAlta').value +
                    '&FechaBaja='+ document.getElementById('FechaBaja').value;
		     
                alert(Params);
		     
                Ajax.open("POST", Url, true);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
            }

            function actualizarActividad() {	
                //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=actualizarActividad";			
                var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=actualizarActividad";		        
                var Params = 'idActividad='+ document.getElementById('idActividad').value +
                    '&NombreActividad='+ document.getElementById('NombreActividad').value + 
                    '&IntensidadActividad='+ document.getElementById('IntensidadActividad').value + 
                    '&Edad_Minima='+ document.getElementById('Edad_Minima').value +
                    '&Edad_Max='+ document.getElementById('Edad_Max').value +
                    '&Grupo='+ document.getElementById('Grupo').value +
                    '&Descripcion='+ document.getElementById('Descripcion').value +
                    '&FechaAlta='+ document.getElementById('FechaAlta').value +
                    '&FechaBaja='+ document.getElementById('FechaBaja').value;

	
                Ajax.open("PUT", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
                Ajax.send(Params); // Enviamos los datos
            }

            function borrarActividad() {	
                //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=borrarActividad";	
                var Url = "http://localhost/sistemareservas/AdministradorBO.php?url=borrarActividad";		        
                var Params = 'idActividad='+ document.getElementById('idActividad').value;

	
                Ajax.open("DELETE", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
                Ajax.send(Params); // Enviamos los datos
            }

            function obtenerActividades(){
                //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=obtenerActividades";	
                var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerActividades";		        
                var Params = '';

	
                Ajax.open("GET", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
                Ajax.send(Params); // Enviamos los datos
	
                var RespTxt = Ajax.responseText;
                
                alert(RespTxt);
	
                var Clase = JSON.parse(RespTxt);
                
                alert(Clase);
	
                var contenido = "";
                var div = document.getElementById("actividades");
                contenido = contenido + '<form>';
	
                for(i=0; i<Clase.actividades.length; i++){		
                    contenido = contenido + 'idActividad: <input type="text" id="idActividad" name="idActividad" value="' + Clase.actividades[i].idActividad + '"/>';
                    contenido = contenido + 'NombreActividad: <input type="text" id="NombreActividad" name="NombreActividad" value="' + Clase.actividades[i].NombreActividad + '"/>';
                    contenido = contenido + 'IntensidadActividad: <input type="text" id="IntensidadActividad" name="IntensidadActividad" value="' + Clase.actividades[i].IntensidadActividad + '"/>';
                    contenido = contenido + 'Edad_Minima: <input type="text" id="Edad_Minima" name="Edad_Minima" value="' + Clase.actividades[i].Edad_Minima + '"/>';
                    contenido = contenido + 'Edad_Max: <input type="text" id="Edad_Max" name="Edad_Max" value="' + Clase.actividades[i].Edad_Max + '"/>';
                    contenido = contenido + '<br>';
                    contenido = contenido + 'Grupo: <input type="text" id="Grupo" name="Grupo" value="' + Clase.actividades[i].Grupo + '"/>';
                    contenido = contenido + 'Descripcion: <input type="text" id="Descripcion" name="Descripcion" value="' + Clase.actividades[i].Descripcion + '"/>';
                    contenido = contenido + 'FechaAlta: <input type="text" id="FechaAlta" name="FechaAlta" value="' + Clase.actividades[i].Edad_Minima + '"/>';
                    contenido = contenido + 'FechaBaja: <input type="text" id="FechaBaja" name="FechaBaja" value="' + Clase.actividades[i].Edad_Minima + '"/>';
                    contenido = contenido + "<br><br>";
		
                }
                contenido = contenido + '</form>';
	
                div.innerHTML = contenido;
	
                //alert('Estado: '+ Clase.estado);
                //alert('idSala: '+ Clase.salas.length);
                //alert('idSala: '+ Clase.salas[0].idSala);
                //alert('NombreActividad: '+ Clase.salas[0].NombreActividad);
                //alert('Capacidad: '+ Clase.salas[0].Capacidad);
                //alert('Descripcion: '+ Clase.salas[0].Descripcion);
	  
                //document.getElementById('idSala').value=Clase.salas[0].idSala;
                //document.getElementById('NombreActividad').value=Clase.salas[0].NombreActividad;
                //document.getElementById('Capacidad').value=Clase.salas[0].Capacidad;
                //document.getElementById('Descripcion').value=Clase.salas[0].Descripcion;
            }

            function obtenerActividad() {	
                var Url = "http://localhost:8080/pfgreservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerActividad";
                var Params = 'idActividad='+ document.getElementById('idActividad').value;

                alert('hola');
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
                Ajax.send(Params); // Enviamos los datos
	
                var RespTxt = Ajax.responseText;	
	
                alert(RespTxt);
	
                var Clase = eval('(' + RespTxt + ')');
                //alert('Estado: '+ Clase.estado);
                //alert('idSala: '+ Clase.sala.idSala);
                //alert('NombreActividad: '+ Clase.sala.NombreActividad);
                //alert('Capacidad: '+ Clase.sala.Capacidad);
                //alert('Descripcion: '+ Clase.sala.Descripcion);
	  
                document.getElementById('idActividad').value=Clase.actividad.idActividad;
                document.getElementById('NombreActividad').value=Clase.actividad.NombreActividad;	  
                document.getElementById('IntensidadActividad').value=Clase.actividad.IntensidadActividad;
                document.getElementById('Edad_Minima').value=Clase.actividad.Edad_Minima;
                document.getElementById('Edad_ma').value=Clase.actividad.Edad_m;
                document.getElementById('Grupo').value=Clase.actividad.Grupo;
                document.getElementById('Descripcion').value=Clase.actividad.Descripcion;
                document.getElementById('FechaAlta').value=Clase.actividad.FechaAlta;
                document.getElementById('FechaBaja').value=Clase.actividad.FechaBaja;  	  
            }
            
        </script>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="#">Detalle Actividad</a>
        </li>
    </ul>
</div>
<div class=" row">
<div class="box col-md-12">
                        <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Detalle Actividad</h2>
                        <div class="box-icon">

                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        
                        </div>
                        </div>
                        <div class="box-content">
                            
                            <form class="form-group">
                                <label class="control-label" >Actividad</label>
                                <input type="text"  id="NombreActividad"></br></br>
                                
                                <label class="control-label" >Descripcion</label>
                                <input type="text"  id="Descripcion"></br></br>
                                
                                <label class="control-label" >Grupo</label>
                                <input type="text" id="Grupo"></br></br>
                                            
                                <label class="control-label" >Intensidad</label>
                                <input type="color" id="IntensidadActividad"></br></br>
                                
                                <label class="control-label" >Edad Mínima</label>
                                <input type="text" name="FechaAlta" id="Edad_Minima">
                                
                                <label class="control-label" >Edad Máxima</label>
                                <input type="text" name="FechaBaja" id="Edad_Maxima">
                                
                                <input class="btn btn-default" type="button" value="Cancelar" onClick=" window.location.href='Actividades.php' " />
                                <input class="btn btn-default" type="button" value="Aceptar" onclick="crearSala()"/>
                            </form>
                        </div>
                        </div>


                        </div>
                       
</div>

<?php require('footerReservas.php'); ?>
