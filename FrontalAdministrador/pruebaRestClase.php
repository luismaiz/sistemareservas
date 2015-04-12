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

function crearClase() {
        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearClase";
	
	var Params = 'idClase='+ document.getElementById('idClase').value +
		     '&idActividad='+ document.getElementById('idActividad').value +
		     '&idSala='+ document.getElementById('idSala').value +
		     '&HoraInicio='+ document.getElementById('HoraInicio').value +
		     '&HoraFin='+ document.getElementById('HoraFin').value +
		     '&Ocupacion='+ document.getElementById('Ocupacion').value +
		     '&Dia='+ document.getElementById('Dia').value +
		     '&Publicada='+ document.getElementById('Publicada').value;
		     
	//alert(Params);
		     
	Ajax.open("POST", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	Ajax.send(Params); // Enviamos los datos
}

function actualizarClase() {
        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarClase";
	var Params = 'idClase='+ document.getElementById('idClase').value +
		     '&idActividad='+ document.getElementById('idActividad').value +
		     '&idSala='+ document.getElementById('idSala').value +
		     '&HoraInicio='+ document.getElementById('HoraInicio').value +
		     '&HoraFin='+ document.getElementById('HoraFin').value +
		     '&Ocupacion='+ document.getElementById('Ocupacion').value +
		     '&Dia='+ document.getElementById('Dia').value +
		     '&Publicada='+ document.getElementById('Publicada').value;

	
	Ajax.open("PUT", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
}

function borrarClase() {
        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=borrarClase";
        
	var Params = 'idClase='+ document.getElementById('idClase').value;

	
	Ajax.open("DELETE", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
}

function obtenerClases() {
        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerClases";
	var Params = '';

	
	Ajax.open("GET", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
	
	var RespTxt = Ajax.responseText;
	
	var Clase = eval('(' + RespTxt + ')');
	
	var contenido = "";
	var div = document.getElementById("clases");
	contenido = contenido + '<form>';
	
	for(i=0; i<Clase.clases.length; i++){		
		contenido = contenido + 'idClase: <input type="text" id="idClase" name="idClase" value=' + Clase.clases[i].idClase + '/>';
		contenido = contenido + 'idActividad: <input type="text" id="idActividad" name="idActividad" value=' + Clase.clases[i].idActividad + '/>';
		contenido = contenido + 'idSala: <input type="text" id="idSala" name="idSala" value=' + Clase.clases[i].idSala + '/>';
		contenido = contenido + 'HoraInicio: <input type="text" id="Hora_Inicio" name="Hora_Inicio" value=' + Clase.clases[i].HoraInicio + '/>';
		contenido = contenido + 'HoraFin: <input type="text" id="Hora_Fin" name="Hora_Fin" value=' + Clase.clases[i].HoraFin + '/>';
		contenido = contenido + 'Ocupacion: <input type="text" id="Ocupacion" name="Ocupacion" value=' + Clase.clases[i].Ocupacion + '/>';
		contenido = contenido + 'Dia: <input type="text" id="Dia" name="Dia" value=' + Clase.clases[i].Dia + '/>';
		contenido = contenido + 'Publicada: <input type="text" id="Publicada" name="Publicada" value=' + Clase.clases[i].Publicada + '/>';
		contenido = contenido + "<br><br>";
		
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

function obtenerClase(){
        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerClase";		        
	var Params = 'idClase='+ document.getElementById('idClase').value;

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
	  
	  document.getElementById('idClase').value=Clase.clase.idClase;
	  document.getElementById('idActividad').value=Clase.clase.idActividad;
	  document.getElementById('idSala').value=Clase.clase.idSala;
	  document.getElementById('HoraInicio').value=Clase.clase.HoraInicio;
	  document.getElementById('HoraFin').value=Clase.clase.HoraFin;
	  document.getElementById('Ocupacion').value=Clase.clase.Ocupacion;
	  document.getElementById('Dia').value=Clase.clase.Dia;
	  document.getElementById('Publicada').value=Clase.clase.Publicada;
}
</script>
</head>
<body>

<form>
  idClase: <input type="text" id="idClase" name="idClase"/>
  idActividad: <input type="text" id="idActividad" name="idActividad"/>
  idSala: <input type="text" id="idSala" name="idSala"/>
  HoraInicio: <input type="text" id="HoraInicio" name="HoraInicio"/>  
  HoraFin: <input type="text" id="HoraFin" name="HoraFin"/>    
  <br>
  Ocupacion: <input type="text" id="Ocupacion" name="Ocupacion"/>  
  Dia: <input type="text" id="Dia" name="Dia"/>  
  Publicada: <input type="text" id="Publicada" name="Publicada"/>  
  <br><br>
  <input type="button" value="Crear Clase" onclick="crearClase()"/>
  <input type="button" value="Obtener Clase" onclick="obtenerClase()"/>
  <input type="button" value="Actualizar Clase" onclick="actualizarClase()"/>
  <input type="button" value="Borrar Clase" onclick="borrarClase()"/>
</form>


<input type="button" value="Obtener Clases" onclick="obtenerClases()"/>
<div id="clases">
</div>


</body>
</html>