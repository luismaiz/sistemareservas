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

function crearTipoTarifa() {	
	//var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=crearTipoPrecio";		
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearTipoTarifa";		
	var Params = 'idTipoTarifa='+ document.getElementById('idTipoTarifa').value +
		     '&NombreTarifa='+ document.getElementById('NombreTarifa').value +
		     '&DescripcionTarifa='+ document.getElementById('DescripcionTarifa').value +
		     '&FechaAlta='+ document.getElementById('FechaAltaTipoPrecio').value +
		     '&FechaBaja='+ document.getElementById('FechaBajaTipoPrecio').value;

	//alert(Params);
	
	Ajax.open("POST", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
}

function actualizarTipoTarifa() {
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarTipoTarifa";
	var Params = 'idTipoTarifa='+ document.getElementById('idTipoTarifa').value +
		     '&NombreTarifa='+ document.getElementById('NombreTarifa').value +
		     '&DescripcionTarifa='+ document.getElementById('DescripcionTarifa').value +
		     '&FechaAlta='+ document.getElementById('FechaAltaTipoPrecio').value +
		     '&FechaBaja='+ document.getElementById('FechaBajaTipoPrecio').value;

	//alert(Params);
	
	Ajax.open("PUT", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
}


function obtenerTiposTarifa() {	
	//var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=obtenerSalas";		
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerTiposTarifa";
	var Params = '';

	
	Ajax.open("GET", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
	
	var RespTxt = Ajax.responseText;	
	
	//alert(RespTxt);
	
	var Clase = eval('(' + RespTxt + ')');	
	
	var contenido = "";		    
	var div = document.getElementById("tiposPrecios");
	contenido = contenido + '<form>';
	
	for(i=0; i<Clase.tiposPrecios.length; i++){		
		contenido = contenido + 'idTipoTarifa: <input type="text" id="idTipoTarifa" name="idTipoTarifa" value=' + Clase.tiposPrecios[i].idTipoTarifa + '/>';
		contenido = contenido + 'NombreTarifa: <input type="text" id="NombreTarifa" name="NombreTarifa" value=' + Clase.tiposPrecios[i].NombreTarifa + '/>';
		contenido = contenido + 'DescripcionTarifa: <input type="text" id="DescripcionTarifa" name="DescripcionTarifa" value=' + Clase.tiposPrecios[i].DescripcionTarifa + '/>';
		contenido = contenido + 'FechaAlta <input type="text" id="FechaAltaTipoPrecio" name="FechaAlta" value=' + Clase.tiposPrecios[i].FechaAlta + '/>';
		contenido = contenido + 'FechaBaja: <input type="text" id="FechaBajaTipoPrecio" name="FechaBaja" value=' + Clase.tiposPrecios[i].FechaBaja + '/>';
		contenido = contenido + "<br>";
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

function obtenerTipoTarifa() {	
	//var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=obtenerSala";
        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerTipoTarifa";
	var Params = 'idTipoTarifa='+ document.getElementById('idTipoTarifa').value;

	
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
	  
	  document.getElementById('idTipoTarifa').value=Clase.tipoPrecio.idTipoTarifa;
	  document.getElementById('NombreTarifa').value=Clase.tipoPrecio.NombreTarifa;
	  document.getElementById('DescripcionTarifa').value=Clase.tipoPrecio.DescripcionTarifa;
	  document.getElementById('FechaAltaTipoPrecio').value=Clase.tipoPrecio.FechaAlta;
	  document.getElementById('FechaBajaTipoPrecio').value=Clase.tipoPrecio.FechaBaja;
}
</script>
</head>
<body>

<form>
  idTipoTarifa: <input type="text" id="idTipoTarifa" name="idTipoTarifa"/>
  NombreTarifa: <input type="text" id="NombreTarifa" name="NombreTarifa"/>
  DescripcionTarifa: <input type="text" id="DescripcionTarifa" name="DescripcionTarifa"/>
  FechaAlta: <input type="text" id="FechaAltaTipoPrecio" name="FechaAltaTipoPrecio"/>
  <br>
  FechaBaja: <input type="text" id="FechaBajaTipoPrecio" name="FechaBajaTipoPrecio"/>
  <br><br>
  <input type="button" value="Crear Tipo de Tarifa" onclick="crearTipoTarifa()"/>
  <input type="button" value="Actualizar Tipo de Tarifa" onclick="actualizarTipoTarifa()"/>
  <input type="button" value="Obtener Tipo de Tarifa" onclick="obtenerTipoTarifa()"/>
</form>

<input type="button" value="Obtener Tipos de Precio" onclick="obtenerTiposTarifa()"/>
<div id="tiposTarifa">
</div>


</body>
</html>