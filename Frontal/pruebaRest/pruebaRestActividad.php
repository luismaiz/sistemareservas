<html>
    <head>
        <script>
            function AjaxObj()
            {
                var xmlhttp = null;

                if (window.XMLHttpRequest)
                {
                    xmlhttp = new XMLHttpRequest();

                    if (xmlhttp.overrideMimeType)
                    {
                        xmlhttp.overrideMimeType('text/xml');
                    }
                }
                else if (window.ActiveXObject)
                { 
                    // Internet Explorer    
                    try
                    {
                        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                    }
                    catch (e)
                    {
                        try
                        {
                            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        catch (e)
                        {
                            xmlhttp = null;
                        }
                    }
	
                    if (!xmlhttp && typeof XMLHttpRequest!='undefined')
                    {
                        xmlhttp = new XMLHttpRequest();
	  
                        if (!xmlhttp)
                        {
                            failed = true;
                        }
                    }
                }
                return xmlhttp;
            }

            var Ajax = new AjaxObj();

            function crearActividad() {	
                var Url = "http://www.rightwatch.es/pfgreservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearActividad";		
                //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearActividad";		        
	
                var Params = 'idActividad='+ document.getElementById('idActividad').value +
                    '&NombreActividad='+ document.getElementById('NombreActividad').value +
                    '&IntensidadActividad='+ document.getElementById('IntensidadActividad').value +
                    '&Edad_Minima='+ document.getElementById('Edad_Minima').value +
                    '&Edad_Max='+ document.getElementById('Edad_Max').value +
                    '&Grupo='+ document.getElementById('Grupo').value +
                    '&Descripcion='+ document.getElementById('Descripcion').value +
                    '&FechaAlta='+ document.getElementById('FechaAlta').value +
                    '&FechaBaja='+ document.getElementById('FechaBaja').value;
		     
                alert(Params);
		     
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
            }

            function actualizarActividad() {	
                //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=actualizarActividad";			
                var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarActividad";		        
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
                var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=borrarActividad";		        
                var Params = 'idActividad='+ document.getElementById('idActividad').value;

	
                Ajax.open("DELETE", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
                Ajax.send(Params); // Enviamos los datos
            }

            function obtenerActividades(){
                //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=obtenerActividades";	
                var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerActividades";		        
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
                var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerActividad";
                var Params = 'idActividad='+ document.getElementById('idActividad').value;

	
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
    </head>
    <body>

        <form>
            idActividad: <input type="text" id="idActividad" name="idActividad"/>
            NombreActividad: <input type="text" id="NombreActividad" name="NombreActividad"/>
            IntensidadActividad: <input type="text" id="IntensidadActividad" name="IntensidadActividad"/>
            Edad_Minima: <input type="text" id="Edad_Minima" name="Edad_Minima"/>  
            Edad_Max: <input type="text" id="Edad_Max" name="Edad_Max"/>  
            <br>
            Grupo: <input type="text" id="Grupo" name="Grupo"/>  
            Descripcion: <input type="text" id="Descripcion" name="Descripcion"/>  
            FechaAlta: <input type="text" id="FechaAlta" name="FechaAlta"/>  
            FechaBaja: <input type="text" id="FechaBaja" name="FechaBaja"/>  
            <br><br>
            <input type="button" value="Crear Actividad" onclick="crearActividad()"/>
            <input type="button" value="Obtener Actividad" onclick="obtenerActividad()"/>
            <input type="button" value="Actualizar Actividad" onclick="actualizarActividad()"/>
            <input type="button" value="Borrar Actividad" onclick="borrarActividad()"/>
        </form>


        <input type="button" value="Obtener Actividades" onclick="obtenerActividades()"/>
        <div id="actividades">
        </div>


    </body>
</html>