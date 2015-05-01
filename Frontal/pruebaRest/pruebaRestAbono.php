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

function crearTipoAbono() {
	//var Url = "http://localhost:8080/hosting_pr/RestImplSolicitud.php?url=crearTipoSolicitud";	
        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearTipoAbono";	
	var Params = 'NombreAbono='+ document.getElementById('NombreAbono').value +
		     '&DescripcionAbono='+ document.getElementById('DescripcionAbono').value +
		     '&FechaAlta='+ document.getElementById('FechaAltaTipoSolicitud').value +
		     '&FechaBaja='+ document.getElementById('FechaBajaTipoSolicitud').value;

	//alert(Params);
	
	Ajax.open("POST", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
}

function actualizarTipoAbono() {
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarTipoAbono";
	var Params = 'idTipoAbono='+ document.getElementById('idTipoAbono').value +
		     '&NombreAbono='+ document.getElementById('NombreAbono').value +
		     '&DescripcionAbono='+ document.getElementById('DescripcionAbono').value +
		     '&FechaAlta='+ document.getElementById('FechaAltaTipoSolicitud').value +
		     '&FechaBaja='+ document.getElementById('FechaBajaTipoSolicitud').value;

	//alert(Params);
	
	Ajax.open("PUT", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
}


function obtenerTiposAbono() {	
	//var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=obtenerSalas";		
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerTiposAbono";
	var Params = '';

	
	Ajax.open("GET", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
	
	var RespTxt = Ajax.responseText;	
	
	alert(RespTxt);
	
	var Clase = eval('(' + RespTxt + ')');	
	
	var contenido = "";		    
	var div = document.getElementById("tiposAbono");
	contenido = contenido + '<form>';
	
	for(i=0; i<Clase.tiposAbono.length; i++){
		contenido = contenido + 'idTipoAbono: <input type="text" id="idTipoAbono" name="idTipoAbono" value=' + Clase.tiposSolicitudes[i].idTipoAbono + '/>';
		contenido = contenido + 'NombreAbono: <input type="text" id="NombreAbono" name="NombreAbono" value=' + Clase.tiposSolicitudes[i].NombreAbono + '/>';
		contenido = contenido + 'DescripcionAbono: <input type="text" id="DescripcionAbono" name="DescripcionAbono" value=' + Clase.tiposSolicitudes[i].DescripcionAbono + '/>';
		contenido = contenido + 'FechaAlta: <input type="text" id="FechaAlta" name="FechaAlta" value=' + Clase.tiposSolicitudes[i].FechaAlta + '/>';
		contenido = contenido + 'FechaBaja: <input type="text" id="FechaBaja" name="FechaBaja" value=' + Clase.tiposSolicitudes[i].FechaBaja + '/>';
		contenido = contenido + "<br>";
	}
	contenido = contenido + '</form>';
	
	div.innerHTML = contenido;
	
	  //alert('Estado: '+ Clase.estado);
	  //alert('idSala: '+ Clase.salas.length);
	  //alert('idSala: '+ Clase.salas[0].idSala);
	  //alert('Nombre: '+ Clase.salas[0].Nombre);
	  //alert('Capacidad: '+ Clase.salas[0].Capacidad);
	  //alert('Descripcion: '+ Clase.salas[0].Descripcion);
	  
	  //document.getElementById('idSala').value=Clase.salas[0].idSala;
	  //document.getElementById('Nombre').value=Clase.salas[0].Nombre;
	  //document.getElementById('Capacidad').value=Clase.salas[0].Capacidad;
	  //document.getElementById('Descripcion').value=Clase.salas[0].Descripcion;
}

function obtenerTipoAbono() {		
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerTipoAbono";
	var Params = 'idTipoAbono='+ document.getElementById('idTipoAbono').value;	
	
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
	  //alert('Descripcion: '+ Clase.sala.Descripcion);	  
	  
	  document.getElementById('idTipoAbono').value=Clase.tipoSolicitud.idTipoAbono;
	  document.getElementById('NombreAbono').value=Clase.tipoSolicitud.NombreAbono;
	  document.getElementById('DescripcionAbono').value=Clase.tipoSolicitud.DescripcionAbono;
	  document.getElementById('FechaAlta').value=Clase.tipoSolicitud.FechaAlta;
	  document.getElementById('FechaBaja').value=Clase.tipoSolicitud.FechaBaja;	  	  	  
	  
}

</script>
</head>
<body>

<form>
  idTipoAbono: <input type="text" id="idTipoAbono" name="idTipoAbono"/>
  NombreAbono: <input type="text" id="NombreAbono" name="NombreAbono"/>
  DescripcionAbono: <input type="text" id="DescripcionAbono" name="DescripcionAbono"/>
  FechaAlta: <input type="text" id="FechaAltaTipoSolicitud" name="FechaAltaTipoSolicitud"/>  
  FechaBaja: <input type="text" id="FechaBajaTipoSolicitud" name="FechaBajaTipoSolicitud"/>
  <br><br>
  <input type="button" value="Crear Tipo de Abono" onclick="crearTipoAbono()"/>
  <input type="button" value="Actualizar Tipo de Abono" onclick="actualizarTipoAbono()"/>
  <input type="button" value="Obtener Tipo de Abono" onclick="obtenerTipoAbono()"/>
</form>

<input type="button" value="Obtener Tipos de Abono" onclick="obtenerTiposAbono()"/>
<div id="tiposAbono">
</div>

</body>
</html>