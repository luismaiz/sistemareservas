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

            function crearSala() {
                var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearSala";		
                var Params = 'idSala='+ document.getElementById('idSala').value +
                    '&NombreSala='+ document.getElementById('NombreSala').value +
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
                var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarSala";
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
                var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=borrarSala";
                var Params = 'idSala='+ document.getElementById('idSala').value;

	
                Ajax.open("DELETE", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
            }

            function obtenerSalas() {
                //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=obtenerSalas";
                var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerSalas";
                var Params = '';

	
                Ajax.open("GET", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
	
                var RespTxt = Ajax.responseText;
        
                alert(RespTxt);
	
                var Clase = eval('(' + RespTxt + ')');	
        
                alert(Clase);
	
                var contenido = "";
                var div = document.getElementById("salas");
                contenido = contenido + '<form>';
	
                for(i=0; i<Clase.salas.length; i++){
                    contenido = contenido + 'idSala: <input type="text" id="idSala" name="idSala" value="' + Clase.salas[i].idSala + '"></input>';
                    contenido = contenido + 'NombreSala: <input type="text" id="NombreSala" name="NombreSala" value="' + Clase.salas[i].NombreSala + '"></input>';
                    contenido = contenido + 'CapacidadSala: <input type="text" id="CapacidadSala" name="CapacidadSala" value="' + Clase.salas[i].CapacidadSala + '"></input>';
                    contenido = contenido + 'DescripcionSala: <input type="text" id="DescripcionSala" name="DescripcionSala" value="' + Clase.salas[i].DescripcionSala + '"></input>';
                    contenido = contenido + 'FechaAlta: <input type="text" id="FechaAlta" name="FechaAlta" value="' + Clase.salas[i].FechaAlta + '"></input>';
                    contenido = contenido + 'FechaBaja: <input type="text" id="FechaBaja" name="FechaBaja" value="' + Clase.salas[i].FechaBaja + '"></input>';                    
                    contenido = contenido + "<br>";
                }
                contenido = contenido + '</form>';
	
                div.innerHTML = contenido;
	
                //alert('Estado: '+ Clase.estado);
                //alert('idSala: '+ Clase.salas.length);
                //alert('idSala: '+ Clase.salas[0].idSala);
                //alert('NombreSala: '+ Clase.salas[0].NombreSala);
                //alert('CapacidadSala: '+ Clase.salas[0].CapacidadSala);
                //alert('DescripcionSala: '+ Clase.salas[0].DescripcionSala);
	  
                //document.getElementById('idSala').value=Clase.salas[0].idSala;
                //document.getElementById('NombreSala').value=Clase.salas[0].NombreSala;
                //document.getElementById('CapacidadSala').value=Clase.salas[0].CapacidadSala;
                //document.getElementById('DescripcionSala').value=Clase.salas[0].DescripcionSala;
            }

            function obtenerSala() {
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
    </head>
    <body>

        <form method="post">
            idSala: <input type="text" id="idSala" name="idSala"/>
            NombreSala: <input type="text" id="NombreSala" name="NombreSala"/>
            CapacidadSala: <input type="text" id="CapacidadSala" name="CapacidadSala"/>
            DescripcionSala: <input type="text" id="DescripcionSala" name="DescripcionSala"/>
            FechaAlta: <input type="text" id="FechaAlta" name="FechaAlta"/>
            FechaBaja: <input type="text" id="FechaBaja" name="FechaBaja"/>
            
            </br></br>
            <input type="button" value="Crear Sala" onclick="crearSala()"/>
            <input type="button" value="Obtener Sala" onclick="obtenerSala()"/>
            <input type="button" value="Actualizar Sala" onclick="actualizarSala()"/>
            <input type="button" value="Borrar Sala" onclick="borrarSala()"/>
        </form>


        <input type="button" value="Obtener Salas" onclick="obtenerSalas()"/>
        <div id="salas">
        </div>


    </body>
</html>