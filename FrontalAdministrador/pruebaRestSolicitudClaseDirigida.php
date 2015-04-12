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

function crearDatosSolicitudClaseDirigida() {		
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearDatosSolicitudClaseDirigida";
		
	var Params = 'idSolicitud='+ document.getElementById('idSolicitud').value +
		     '&Titular='+ document.getElementById('Titular').value +
		     '&IBAN='+ document.getElementById('IBAN').value +
		     '&Entidad='+ document.getElementById('Entidad').value +
		     '&Oficina='+ document.getElementById('Oficina').value +
		     '&DigitoControl='+ document.getElementById('DigitoControl').value +
		     '&Cuenta='+ document.getElementById('Cuenta').value;
		     
	//alert(Params);
		     
	Ajax.open("POST", Url, true);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
}

function actualizarDatosSolicitudClaseDirigida() {
        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarDatosSolicitudClaseDirigida";
		
	var Params = 'idDatosSolicitudClaseDirigida='+ document.getElementById('idDatosSolicitudClaseDirigida').value +
		     '&idSolicitud='+ document.getElementById('idSolicitud').value +
		     '&Titular='+ document.getElementById('Titular').value +
		     '&IBAN='+ document.getElementById('IBAN').value +
		     '&Entidad='+ document.getElementById('Entidad').value +
		     '&Oficina='+ document.getElementById('Oficina').value +
		     '&DigitoControl='+ document.getElementById('DigitoControl').value +
		     '&Cuenta='+ document.getElementById('Cuenta').value;
		     
	//alert(Params);
		     
	Ajax.open("POST", Url, true);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
}

function obtenerDatosSolicitudClaseDirigida() {
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerDatosSolicitudClaseDirigida";
	var Params = 'idDatosSolicitudClaseDirigida='+ document.getElementById('idDatosSolicitudClaseDirigida').value;
	
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
	  
	  document.getElementById('idDatosSolicitudClaseDirigida').value=Clase.clase.idDatosSolicitudClaseDirigida;
	  document.getElementById('idSolicitud').value=Clase.clase.idSolicitud;
	  document.getElementById('Titular').value=Clase.clase.Titular;
	  document.getElementById('IBAN').value=Clase.clase.IBAN;
	  document.getElementById('Entidad').value=Clase.clase.Entidad;
	  document.getElementById('Oficina').value=Clase.clase.Oficina;
	  document.getElementById('DigitoControl').value=Clase.clase.DigitoControl;
	  document.getElementById('Cuenta').value=Clase.clase.Cuenta;
}

//Metodos CRUD Solicitud Clase Dirigida
function crearActividadSolicitudClaseDirigida() {		
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearActividadSolicitudClaseDirigida";
		
	var Params = 'idSolicitud='+ document.getElementById('idSolicitud').value +
		     '&idActividad='+ document.getElementById('idActividad').value;
		     
	//alert(Params);
		     
	Ajax.open("POST", Url, true);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
}

function actualizarActividadSolicitudClaseDirigida() {
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarActividadSolicitudClaseDirigida";
	var Params = 'IdActividadesSolicitudClaseDirigida='+ document.getElementById('IdActividadesSolicitudClaseDirigida').value +
		     '&idSolicitud='+ document.getElementById('idSolicitud:').value +
		     '&idActivida='+ document.getElementById('idActivida').value;

	//alert(Params);
	
	Ajax.open("PUT", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
}


function obtenerActividadesSolicitudClasDirigida() {
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerActividadesSolicitudClasDirigida";
	var Params = '';

	
	Ajax.open("GET", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
	
	var RespTxt = Ajax.responseText;		
	
	var Clase = eval('(' + RespTxt + ')');	
	
	var contenido = "";		    
	var div = document.getElementById("solicitudes");
	contenido = contenido + '<form>';
	
	for(i=0; i<Clase.solicitudes.length; i++){		
		contenido = contenido + 'IdActividadesSolicitudClaseDirigida: <input type="text" id="IdActividadesSolicitudClaseDirigida" name="IdActividadesSolicitudClaseDirigida" value=' + Clase.solicitudes[i].IdSolicitudClaseDirigida + '/>';
		contenido = contenido + 'idSolicitud: <input type="text" id="idSolicitud" name="idSolicitud" value=' + Clase.solicitudes[i].Solicitud + '/>';
		contenido = contenido + 'idActividad: <input type="text" id="idActividad" name="idActividad" value=' + Clase.solicitudes[i].Clase + '/>';		
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

function obtenerActividadSolicitudClaseDirigida() {
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerActividadSolicitudClaseDirigida";
	var Params = 'IdActividadesSolicitudClaseDirigida='+ document.getElementById('IdActividadesSolicitudClaseDirigida').value;
	
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
	  	  
	  document.getElementById('IdActividadesSolicitudClaseDirigida').value=Clase.solicitud.IdActividadesSolicitudClaseDirigida;
	  document.getElementById('idSolicitud').value=Clase.solicitud.idSolicitud;
	  document.getElementById('idActividad').value=Clase.solicitud.idActividad;
}
</script>
</head>
<body>

<form>
  idDatosSolicitudClaseDirigida: <input type="text" id="idDatosSolicitudClaseDirigida" name="idDatosSolicitudClaseDirigida"/>
  idSolicitud: <input type="text" id="idSolicitud" name="idSolicitud"/>
  Titular: <input type="text" id="Titular" name="Titular"/>
  IBAN: <input type="text" id="IBAN" name="IBAN"/>
  Entidad: <input type="text" id="Entidad" name="Entidad"/>
  Oficina: <input type="text" id="Oficina" name="Oficina"/>
  DigitoControl: <input type="text" id="DigitoControl" name="DigitoControl"/>
  Cuenta: <input type="text" id="Cuenta" name="Cuenta"/>
  <br><br>  
  <input type="button" value="Crear Clase yDirigida" onclick="crearClaseDirigida()"/> 
  <input type="button" value="Actualizar Clase Dirigida" onclick="actualizarClaseDirigida()"/>
  <input type="button" value="Obtener Clase Dirigida" onclick="obtenerClaseDirigida()"/>
</form>



<br><br>
<br><br>

<form>
  IdActividadesSolicitudClaseDirigida: <input type="text" id="IdActividadesSolicitudClaseDirigida" name="IdActividadesSolicitudClaseDirigida"/>
  idSolicitud: <input type="text" id="idSolicitud" name="idSolicitud"/>
  idActividad: <input type="text" id="idActividad" name="idActividad"/>
  <br><br>  
  <input type="button" value="Crear Solicitud Clase Dirigida" onclick="crearActividadSolicitudClaseDirigida()"/>
  <input type="button" value="Actualizar Solicitud Clase Dirigida" onclick="actualizarActividadSolicitudClaseDirigida()"/>
  <input type="button" value="Obtener Solicitud Clase Dirigida" onclick="obtenerActividadSolicitudClaseDirigida()"/>
</form>

<input type="button" value="Obtener Solicitudes Clases Dirigidas" onclick="obtenerActividadesSolicitudClaseDirigida()"/>
<div id="solicitudes">
</div>


</body>
</html>