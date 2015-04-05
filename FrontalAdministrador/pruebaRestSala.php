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
		     '&Nombre='+ document.getElementById('Nombre').value + 
		     '&Capacidad='+ document.getElementById('Capacidad').value + 
		     '&Descripcion='+ document.getElementById('Descripcion').value;

	alert(Params);
	
	
	Ajax.open("POST", Url, true);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
}


function actualizarSala() {	
	var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarSala";		
	var Params = 'idSala='+ document.getElementById('idSala').value +
		     '&Nombre='+ document.getElementById('Nombre').value + 
		     '&Capacidad='+ document.getElementById('Capacidad').value + 
		     '&Descripcion='+ document.getElementById('Descripcion').value;

	
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

	
	Ajax.open("GET", Url, true);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
	
	var RespTxt = Ajax.responseText;	
	
	var Clase = eval('(' + RespTxt + ')');	
	
	var contenido = "";		    
	var div = document.getElementById("salas");
	contenido = contenido + '<form>';
	
	for(i=0; i<Clase.salas.length; i++){		
		contenido = contenido + 'idSala: <input type="text" id="idSala" name="idSala" value="' + Clase.salas[i].idSala + '"></input>';
		contenido = contenido + 'Nombre: <input type="text" id="Nombre" name="Nombre" value="' + Clase.salas[i].Nombre + '"></input>';
		contenido = contenido + 'Capacidad: <input type="text" id="Capacidad" name="Capacidad" value="' + Clase.salas[i].Capacidad + '"></input>';
		contenido = contenido + 'Descripcion: <input type="text" id="Descripcion" name="Descripcion" value="' + Clase.salas[i].Descripcion + '"></input>';
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

function obtenerSala() {	
        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerSala";		
	var Params = 'idSala='+ document.getElementById('idSala').value;

	
	Ajax.open("POST", Url, false);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	Ajax.send(Params); // Enviamos los datos
	
	var RespTxt = Ajax.responseText;	
	
	alert("Resultado:" + RespTxt);
	
	alert(eval('(' + RespTxt + ')'));
	var Clase = JSON.parse(RespTxt);
	
            //eval('(' + RespTxt + ')');
	  alert('Estado: '+ Clase.estado);
	  alert('idSala: '+ Clase.sala.idSala);
	  alert('Nombre: '+ Clase.sala.Nombre);
	  alert('Capacidad: '+ Clase.sala.Capacidad);
	  alert('Descripcion: '+ Clase.sala.Descripcion);
	  
	  document.getElementById('idSala').value=Clase.sala.idSala;
	  document.getElementById('Nombre').value=Clase.sala.Nombre;
	  document.getElementById('Capacidad').value=Clase.sala.Capacidad;
	  document.getElementById('Descripcion').value=Clase.sala.Descripcion;
}

</script>
</head>
<body>

    <form method="post">
  idSala: <input type="text" id="idSala" name="idSala"></input>
  Nombre: <input type="text" id="Nombre" name="Nombre"></input>
  Capacidad: <input type="text" id="Capacidad" name="Capacidad"></input>
  Descripcion: <input type="text" id="Descripcion" name="Descripcion"></input> 
  </br></br>
  <input type="button" value="Crear Sala" onclick="crearSala()"></input>
  <input type="button" value="Obtener Sala" onclick="obtenerSala()"></input>  
  <input type="button" value="Actualizar Sala" onclick="actualizarSala()"></input>  
  <input type="button" value="Borrar Sala" onclick="borrarSala()"></input>  
</form>


<input type="button" value="Obtener Salas" onclick="obtenerSalas()"></input>
<div id="salas">
</div>


</body>
</html>