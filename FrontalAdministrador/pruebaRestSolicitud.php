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

function crearTipoSolicitud() {
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearTipoSolicitud";
	var Params = 'idTipoSolicitud='+ document.getElementById('idTipoSolicitud').value +
		     '&NombreSolicitud='+ document.getElementById('NombreSolicitud').value +
		     '&DescripcionSolicitud='+ document.getElementById('DescripcionSolicitud').value +
		     '&FechaAlta='+ document.getElementById('FechaAlta').value +
		     '&FechaBaja='+ document.getElementById('FechaBaja').value;

	//alert(Params);
	
	Ajax.open("POST", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
}

function actualizarTipoSolicitud() {
    var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarTipoSolicitud";
	var Params = 'idTipoSolicitud='+ document.getElementById('idTipoSolicitud').value +
		     '&NombreSolicitud='+ document.getElementById('NombreSolicitud').value +
		     '&DescripcionSolicitud='+ document.getElementById('DescripcionSolicitud').value +
		     '&FechaAlta='+ document.getElementById('FechaAlta').value +
		     '&FechaBaja='+ document.getElementById('FechaBaja').value;

	//alert(Params);
	
	Ajax.open("PUT", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
}


function obtenerTiposSolicitud() {	
	//var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=obtenerSalas";		
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerTiposSolicitud";
	var Params = '';

	
	Ajax.open("GET", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
	
	var RespTxt = Ajax.responseText;	
	
	alert(RespTxt);
	
	var Clase = eval('(' + RespTxt + ')');	
	
	var contenido = "";		    
	var div = document.getElementById("tiposSolicitud");
	contenido = contenido + '<form>';
	
	for(i=0; i<Clase.tiposSolicitud.length; i++){
		contenido = contenido + 'idTipoSolicitud: <input type="text" id="idTipoSolicitud" name="idTipoSolicitud" value=' + Clase.tiposSolicitud[i].idTipoSolicitud + '/>';
		contenido = contenido + 'NombreSolicitud: <input type="text" id="NombreSolicitud" name="NombreSolicitud" value=' + Clase.tiposSolicitud[i].NombreSolicitud + '/>';
		contenido = contenido + 'DescripcionSolicitud: <input type="text" id="DescripcionSolicitud" name="DescripcionSolicitud" value=' + Clase.tiposSolicitud[i].DescripcionSolicitud + '/>';
		contenido = contenido + 'FechaAlta: <input type="text" id="FechaAlta" name="FechaAlta" value=' + Clase.tiposSolicitud[i].FechaAlta + '/>';
		contenido = contenido + 'FechaBaja: <input type="text" id="FechaBaja" name="FechaBaja" value=' + Clase.tiposSolicitud[i].FechaBaja + '/>';
		contenido = contenido + "</br>";
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

function obtenerTipoSolicitud() {		
        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerTipoSolicitud";
	var Params = 'idTipoSolicitud='+ document.getElementById('idTipoSolicitud').value;	
	
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
	  
	  document.getElementById('idTipoSolicitud').value=Clase.tipoSolicitud.idTipoSolicitud;
	  document.getElementById('NombreSolicitud').value=Clase.tipoSolicitud.NombreSolicitud;
	  document.getElementById('DescripcionSolicitud').value=Clase.tipoSolicitud.DescripcionSolicitud;
	  document.getElementById('FechaAlta').value=Clase.tipoSolicitud.FechaAlta;
	  document.getElementById('FechaBaja').value=Clase.tipoSolicitud.FechaBaja;	  	  	  
	  
}

function crearSolicitud() {		
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearSolcicitud";
		
	var Params = 'idSolicitud='+ document.getElementById('idSolicitud').value +
                     '&idTipoSolicitud='+ document.getElementById('idTipoSolicitud').value +
		     '&idTipoTarifa='+ document.getElementById('idTipoTarifa').value +
		     '&FechaSolicitud='+ document.getElementById('FechaSolicitud').value +
		     '&Nombre='+ document.getElementById('Nombre').value +
		     '&Apellidos='+ document.getElementById('Apellidos').value +		     
		     '&DNI='+ document.getElementById('DNI').value +
		     '&EMail='+ document.getElementById('EMail').value +
		     '&Direccion='+ document.getElementById('Direccion').value +		     
		     '&CP='+ document.getElementById('CP').value +
		     '&Sexo='+ document.getElementById('Sexo').value +
		     '&FechaNacimiento='+ document.getElementById('FechaNacimiento').value +
		     '&TutorLegal='+ document.getElementById('TutorLegal').value +
		     '&Localidad='+ document.getElementById('Localidad').value +
		     '&Telefono1='+ document.getElementById('Telefono1').value +
		     '&Telefono2='+ document.getElementById('Telefono2').value +
		     '&Provincia='+ document.getElementById('Provincia').value +		     
		     '&DescripcionSolicitud='+ document.getElementById('DescripcionSolicitud').value +
		     '&Otros='+ document.getElementById('Otros').value +
		     '&Localizador='+ document.getElementById('Localizador').value;
		     
	//alert(Params);
		     
	Ajax.open("POST", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
}

function actualizarSolicitud() {
        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarSolcicitud";
		
	var Params = 'idSolicitud='+ document.getElementById('idSolicitud').value +
                     '&idTipoSolicitud='+ document.getElementById('idTipoSolicitud').value +
		     '&idTipoTarifa='+ document.getElementById('idTipoTarifa').value +
		     '&FechaSolicitud='+ document.getElementById('FechaSolicitud').value +
		     '&Nombre='+ document.getElementById('Nombre').value +
		     '&Apellidos='+ document.getElementById('Apellidos').value +		     
		     '&DNI='+ document.getElementById('DNI').value +
		     '&EMail='+ document.getElementById('EMail').value +
		     '&Direccion='+ document.getElementById('Direccion').value +		     
		     '&CP='+ document.getElementById('CP').value +
		     '&Sexo='+ document.getElementById('Sexo').value +
		     '&FechaNacimiento='+ document.getElementById('FechaNacimiento').value +
		     '&TutorLegal='+ document.getElementById('TutorLegal').value +
		     '&Localidad='+ document.getElementById('Localidad').value +
		     '&Telefono1='+ document.getElementById('Telefono1').value +
		     '&Telefono2='+ document.getElementById('Telefono2').value +
		     '&Provincia='+ document.getElementById('Provincia').value +		     
		     '&DescripcionSolicitud='+ document.getElementById('DescripcionSolicitud').value +
		     '&Otros='+ document.getElementById('Otros').value +
		     '&Localizador='+ document.getElementById('Localizador').value;

	//alert(Params);
	
	Ajax.open("PUT", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
}


function obtenerSolicitudes() {		
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerSolicitudes";
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
		contenido = contenido + 'idSolicitud <input type="text" id="idSolicitud" name="idSolicitud" value=' + Clase.solicitudes[i].idSolicitud + '/>';
                contenido = contenido + 'idTipoSolicitud: <input type="text" id="idTipoSolicitud" name="idTipoSolicitud" value=' + Clase.solicitudes[i].idTipoSolicitud + '/>';
		contenido = contenido + 'idTipoTarifa: <input type="text" id="idTipoTarifa" name="idTipoTarifa" value=' + Clase.solicitudes[i].idTipoTarifa + '/>';
		contenido = contenido + 'FechaSolicitud: <input type="text" id="FechaSolicitud" name="FechaSolicitud" value=' + Clase.solicitudes[i].FechaSolicitud + '/>';
		contenido = contenido + 'Nombre: <input type="text" id="Nombre" name="Nombre" value=' + Clase.solicitudes[i].Nombre + '/>';
		contenido = contenido + 'Apellidos: <input type="text" id="Apellidos" name="Apellidos" value=' + Clase.solicitudes[i].Apellidos + '/>';		
		contenido = contenido + 'DNI <input type="text" id="DNI" name="DNI" value=' + Clase.solicitudes[i].DNI + '/>';
		contenido = contenido + 'EMail <input type="text" id="EMail" name="EMail" value=' + Clase.solicitudes[i].EMail + '/>';
		contenido = contenido + 'Direccion: <input type="text" id="Direccion" name="Direccion" value=' + Clase.solicitudes[i].Direccion + '/>';		
		contenido = contenido + 'CP: <input type="text" id="CP" name="CP" value=' + Clase.solicitudes[i].CP + '/>';
		contenido = contenido + 'Sexo <input type="text" id="Sexo" name="Sexo" value=' + Clase.solicitudes[i].Sexo + '/>';
		contenido = contenido + 'FechaNacimiento: <input type="text" id="FechaNacimiento" name="FechaNacimiento" value=' + Clase.solicitudes[i].FechaNacimiento + '/>';
		contenido = contenido + 'TutorLegal <input type="text" id="TutorLegal" name="TutorLegal" value=' + Clase.solicitudes[i].TutorLegal + '/>';
		contenido = contenido + 'Localidad: <input type="text" id="Localidad" name="Localidad" value=' + Clase.solicitudes[i].Localidad + '/>';
		contenido = contenido + 'Telefono1: <input type="text" id="Telefono1" name="Telefono1" value=' + Clase.solicitudes[i].Telefono1 + '/>';
		contenido = contenido + 'Telefono2: <input type="text" id="Telefono2" name="Telefono2" value=' + Clase.solicitudes[i].Telefono2 + '/>';
		contenido = contenido + 'Provincia: <input type="text" id="Provincia" name="Provincia" value=' + Clase.solicitudes[i].Provincia + '/>';		
		contenido = contenido + 'DescripcionSolicitud: <input type="text" id="DescripcionSolicitud" name="DescripcionSolicitud" value=' + Clase.solicitudes[i].DescripcionSolicitud + '/>';
		contenido = contenido + 'Otros: <input type="text" id="Otros" name="Otros" value=' + Clase.solicitudes[i].Otros + '/>';
		contenido = contenido + 'Localizador: <input type="text" id="Localizador" name="Localizador" value=' + Clase.solicitudes[i].Localizador + '/>';
		contenido = contenido + "</br>";
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

function obtenerSolicitud() {
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerSolicitud";
	var Params = 'idSolicitud='+ document.getElementById('idSolicitud').value;
	
	Ajax.open("POST", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
	
	var RespTxt = Ajax.responseText;	
	
	alert(RespTxt);
	
	var Clase = eval('(' + RespTxt + ')');
	  //alert('Estado: '+ Clase.estado);
	  //alert('idSala: '+ Clase.sala.idSala);
	  //alert('Nombre: '+ Clase.sala.Nombre);
	  //alert('Capacidad: '+ Clase.sala.Capacidad);
	  //alert('Descripcion: '+ Clase.sala.Descripcion);
	  	  
	  document.getElementById('idSolicitud').value=Clase.solicitud.idSolicitud;
          document.getElementById('idTipoSolicitud').value=Clase.solicitud.TipoSolicitud;	  	  
	  document.getElementById('idTipoTarifa').value=Clase.solicitud.idTipoTarifa;
	  document.getElementById('FechaSolicitud').value=Clase.solicitud.FechaSolicitud;
	  document.getElementById('Nombre').value=Clase.solicitud.Nombre;
	  document.getElementById('Apellidos').value=Clase.solicitud.Apellidos;	  
	  document.getElementById('DNI').value=Clase.solicitud.DNI;
	  document.getElementById('EMail').value=Clase.solicitud.EMail;
	  document.getElementById('Direccion').value=Clase.solicitud.Direccion;	  
	  document.getElementById('CP').value=Clase.solicitud.CP;
	  document.getElementById('Sexo').value=Clase.solicitud.Sexo;
	  document.getElementById('FechaNacimiento').value=Clase.solicitud.FechaNacimiento;
	  document.getElementById('TutorLegal').value=Clase.solicitud.TutorLegal;	  
	  document.getElementById('Localidad').value=Clase.solicitud.Localidad;
	  document.getElementById('Telefono1').value=Clase.solicitud.Telefono1;
	  document.getElementById('Telefono2').value=Clase.solicitud.Telefono2;
	  document.getElementById('Provincia').value=Clase.solicitud.Provincia;	  	  
	  document.getElementById('DescripcionSolicitud').value=Clase.solicitud.DescripcionSolicitud;	  
	  document.getElementById('Otros').value=Clase.solicitud.Otros;	  
	  document.getElementById('Localizador').value=Clase.solicitud.Localizador;	  
}
</script>
</head>
<body>

<form>
  idTipoSolicitud: <input type="text" id="idTipoSolicitud" name="idTipoSolicitud"/>
  NombreSolicitud: <input type="text" id="NombreSolicitud" name="NombreSolicitud"/>
  DescripcionSolicitud: <input type="text" id="DescripcionSolicitud" name="DescripcionSolicitud"/>
  FechaAlta: <input type="text" id="FechaAlta" name="FechaAlta"/>  
  FechaBaja: <input type="text" id="FechaBaja" name="FechaBaja"/>
  <br><br>
  <input type="button" value="Crear Tipo de Solicitud" onclick="crearTipoSolicitud()"/>  
  <input type="button" value="Actualizar Tipo de Solicitud" onclick="actualizarTipoSolicitud()"/>
  <input type="button" value="Obtener Tipo de Solicitud" onclick="obtenerTipoSolicitud()"/>
</form>

<input type="button" value="Obtener Tipos de Solicitudes" onclick="obtenerTiposSolicitud()"/>
<div id="tiposSolicitud">
</div>

<br><br>
<br><br>
<br><br>
<br><br>

<form>
  idSolicitud: <input type="text" id="idSolicitud" name="idSolicitud"/>
  idTipoSolicitud: <input type="text" id="idTipoSolicitud" name="idTipoSolicitud"/>
  idTipoTarifa: <input type="text" id="idTipoTarifa" name="idTipoTarifa"/>
  FechaSolicitud: <input type="text" id="FechaSolicitud" name="FechaSolicitud"/>
  Nombre: <input type="text" id="Nombre" name="Nombre"/>
  Apellidos: <input type="text" id="Apellidos" name="Apellidos"/>  
  DNI: <input type="text" id="DNI" name="DNI"/>
  EMail: <input type="text" id="EMail" name="EMail"/>
  Direccion: <input type="text" id="Direccion" name="Direccion"/>  
  CP: <input type="text" id="CP" name="CP"/>
  Sexo: <input type="text" id="Sexo" name="Sexo"/>
  FechaNacimiento: <input type="text" id="FechaNacimiento" name="FechaNacimiento"/>
  TutorLegal: <input type="text" id="TutorLegal" name="TutorLegal"/>
  Localidad: <input type="text" id="Localidad" name="Localidad"/>
  Telefono1: <input type="text" id="Telefono1" name="Telefono1"/>
  Telefono2: <input type="text" id="Telefono2" name="Telefono2"/>
  Provincia: <input type="text" id="Provincia" name="Provincia"/> 
  Descripcion: <input type="text" id="Descripcion" name="Descripcion"/>
  Otros: <input type="text" id="Otros" name="Otros"/>
  Localizador: <input type="text" id="Localizador" name="Localizador"/>
  <br><br>  
  <input type="button" value="Crear Solicitud" onclick="crearSolicitud()"/>
  <input type="button" value="Actualizar Solicitud" onclick="actualizarSolicitud()"/>
  <input type="button" value="Obtener Solicitud" onclick="obtenerSolicitud()"/>
</form>


<input type="button" value="Obtener Solicitudes" onclick="obtenerSolicitudes()"/>
<div id="solicitudes">
</div>

</body>
</html>