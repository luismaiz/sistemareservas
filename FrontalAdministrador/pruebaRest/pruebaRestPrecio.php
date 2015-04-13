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


function crearPrecio() {	
	//var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=crearPrecio";		
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearPrecio";
	var Params = 'idPrecio='+ document.getElementById('idPrecio').value +
                     '&idTipoSolicitud='+ document.getElementById('idTipoSolicitud').value +
                     '&idTipoAbono='+ document.getElementById('idTipoAbono').value +
                     '&idActividad='+ document.getElementById('idTipoAbono').value +
		     '&NombrePrecio='+ document.getElementById('NombrePrecio').value + 		     
		     '&DescripcionPrecio='+ document.getElementById('DescripcionPrecio').value +
		     '&Precio='+ document.getElementById('Precio').value + 		     
		     '&FechaAlta='+ document.getElementById('FechaAltaPrecio').value +
		     '&FechaBaja='+ document.getElementById('FechaBajaPrecio').value;

	
	Ajax.open("POST", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
}

function actualizarPrecio() {
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarPrecio";
	var Params = 'idPrecio='+ document.getElementById('idTipoTarifa').value +
                     '&idTipoSolicitud='+ document.getElementById('idTipoSolicitud').value +
                     '&idTipoAbono='+ document.getElementById('idTipoAbono').value +
                     '&idActividad='+ document.getElementById('idTipoAbono').value +
		     '&NombrePrecio='+ document.getElementById('NombrePrecio').value + 		     
		     '&DescripcionPrecio='+ document.getElementById('DescripcionPrecio').value +
		     '&Precio='+ document.getElementById('Precio').value + 		     
		     '&FechaAlta='+ document.getElementById('FechaAltaPrecio').value +
		     '&FechaBaja='+ document.getElementById('FechaBajaPrecio').value;


	//alert(Params);
	
	Ajax.open("PUT", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
}


function obtenerPrecios() {	
	//var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=obtenerSalas";		
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerPrecios";
	var Params = '';

	
	Ajax.open("GET", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
	
	var RespTxt = Ajax.responseText;		
	
	var Clase = eval('(' + RespTxt + ')');	
	
	var contenido = "";		    
	var div = document.getElementById("precios");
	contenido = contenido + '<form>';
	
	for(i=0; i<Clase.precios.length; i++){		
		contenido = contenido + 'idPrecio: <input type="text" id="idPrecio" name="idPrecio" value=' + Clase.precios[i].idPrecio + '/>';
                contenido = contenido + 'idTipoSolicitud: <input type="text" id="idTipoSolicitud" name="idTipoSolicitud" value=' + Clase.precios[i].idTipoSolicitud + '/>';
		contenido = contenido + 'idTipoAbono: <input type="text" id="idTipoAbono" name="idTipoAbono" value=' + Clase.precios[i].idTipoAbono + '/>';
                contenido = contenido + 'idActividad: <input type="text" id="idActividad" name="idActividad" value=' + Clase.precios[i].idActividad + '/>';
		contenido = contenido + 'NombrePrecio: <input type="text" id="NombrePrecio" name="NombrePrecio" value=' + Clase.precios[i].NombrePrecio + '/>';		
		contenido = contenido + 'DescripcionPrecio: <input type="text" id="DescripcionPrecio" name="DescripcionPrecio" value=' + Clase.precios[i].DescripcionPrecio + '/>';
		contenido = contenido + 'Precio: <input type="text" id="Precio" name="Precio" value=' + Clase.precios[i].Precio + '/>';		
		contenido = contenido + 'FechaAlta: <input type="text" id="FechaAltaPrecio" name="FechaAltaPrecio" value=' + Clase.precios[i].FechaAlta + '/>';
		contenido = contenido + 'FechaBaja: <input type="text" id="FechaBajaPrecio" name="FechaBajaPrecio" value=' + Clase.precios[i].FechaBaja + '/>';
		contenido = contenido + "</br>";
	}
	contenido = contenido + '</form>';
	
	div.innerHTML = contenido;
	
	  //alert('Estado: '+ Clase.estado);
	  //alert('idSala: '+ Clase.salas.length);
	  //alert('idSala: '+ Clase.salas[0].idSala);
	  //alert('Nombre: '+ Clase.salas[0].Nombre);
	  //alert('Capacidad: '+ Clase.salas[0].Capacidad);
	  //alert('DescripcionTarifa: '+ Clase.salas[0].DescripcionTarifa);
	  
	  //document.getElementById('idSala').value=Clase.salas[0].idSala;
	  //document.getElementById('Nombre').value=Clase.salas[0].Nombre;
	  //document.getElementById('Capacidad').value=Clase.salas[0].Capacidad;
	  //document.getElementById('DescripcionTarifa').value=Clase.salas[0].DescripcionTarifa;
}

function obtenerPrecio() {	
	//var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=obtenerSala";
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerPrecio";
	var Params = 'idPrecio='+ document.getElementById('idPrecio').value;

	
	Ajax.open("POST", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
	
	var RespTxt = Ajax.responseText;	
	
	//alert(RespTxt);
	
	var Clase = eval('(' + RespTxt + ')');
	  //alert('Estado: '+ Clase.estado);
	  //alert('idSala: '+ Clase.sala.idSala);
	  //alert('Nombre: '+ Clase.sala.Nombre);
	  //alert('Capacidad: '+ Clase.sala.Capacidad);
	  //alert('DescripcionTarifa: '+ Clase.sala.DescripcionTarifa);
	  
	  document.getElementById('idPrecio').value=Clase.precio.idPrecio;	  
          document.getElementById('idTipoSolicitud').value=Clase.precio.idTipoSolicitud;
	  document.getElementById('idTipoAbono').value=Clase.precio.idTipoAbono;
          document.getElementById('idActividad').value=Clase.precio.idActividad;
          document.getElementById('NombrePrecio').value=Clase.precio.NombrePrecio;
	  document.getElementById('DescripcionPrecio').value=Clase.precio.DescripcionPrecio;
	  document.getElementById('Precio').value=Clase.precio.Precio;	  
	  document.getElementById('FechaAltaPrecio').value=Clase.precio.FechaAlta;
	  document.getElementById('FechaBajaPrecio').value=Clase.precio.FechaBaja;
}
</script>
</head>
<body>

<form>
  idPrecio: <input type="text" id="idPrecio" name="idPrecio"/>
  idTipoSolicitud <input type="text" id="idTipoSolicitud" name="idTipoSolicitud"/>
  idTipoAbono: <input type="text" id="idTipoAbono" name="idTipoAbono"/>
  idActividad: <input type="text" id="idActividad" name="idActividad"/>
  NombrePrecio: <input type="text" id="NombrePrecio" name="NombrePrecio"/>
  DescripcionPrecio: <input type="text" id="DescripcionPrecio" name="DescripcionPrecio"/>
  Precio: <input type="text" id="Precio" name="Precio"/>
  <br><br>  
  FechaAlta <input type="text" id="FechaAltaPrecio" name="FechaAltaPrecio"/>
  FechaBaja: <input type="text" id="FechaBajaPrecio" name="FechaBajaPrecio"/>
  <br><br>  
  <input type="button" value="Crear Precio" onclick="crearPrecio()"/>
  <input type="button" value="Actualizar Precio" onclick="actualizarPrecio()"/>
  <input type="button" value="Obtener Precio" onclick="obtenerPrecio()"/>
</form>


<input type="button" value="Obtener Precios" onclick="obtenerPrecios()"/>
<div id="precios">
</div>


</body>
</html>