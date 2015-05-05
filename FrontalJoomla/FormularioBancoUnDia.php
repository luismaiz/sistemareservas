
<?php require('Cabecera.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="StyleSheet.css" rel="stylesheet" />
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

  
<script type="text/javascript">

 function DrawCaptcha()
  {
  var a = Math.ceil(Math.random() * 6)+ '';
  var b = Math.ceil(Math.random() * 6)+ '';
  var c = Math.ceil(Math.random() * 6)+ '';
  var d = Math.ceil(Math.random() * 6)+ '';
  var e = Math.ceil(Math.random() * 6)+ '';
  var f = Math.ceil(Math.random() * 6)+ '';
  var g = Math.ceil(Math.random() * 6)+ '';
  var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' '+ f ;
  document.getElementById("txtCaptcha").value = code
  }
</script>
 <script type="text/javascript">

 function removeSpaces(string){
  return string.split(' ').join('');
 }
</script>
<script type="text/javascript">
function redireccionar(){
  window.locationf="http://www.cristalab.com";
} 
</script>



  
            <div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="Salas.php">Salas</a>
        </li>
        <li>
            <a href="#">Detalle Sala</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Formulario Bancario</h2>

                <div class="box-icon">
                   
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                   
                </div>
            </div>
            <div class="box-content">
                

                <form class="form-inline" role="form">
                    <div class="form-group has-success has-feedback">
                        <label class="control-label" >Entidad</label>
                        <input type="text" required pattern="^[a-zA-Z0-9]{4,12}$" placeholder="2804" id="Entidad">
                      <!--  <span class="glyphicon glyphicon-ok form-control-feedback"></span></br></p>-->
						
						<label class="control-label" >Oficina</label>
                        <input type="text" required pattern="^[a-zA-Z0-9]{4,12}$" placeholder="2804" id="Apellidos">
                       <!-- <span class="glyphicon glyphicon-ok form-control-feedback"></span></br></p>-->
					   
					   
					   <label class="control-label" >DigitoControl</label>
                        <input type="text" required pattern="^[a-zA-Z0-9]{4,12}$" placeholder="2804" id="DigitoControl">
                       <!-- <span class="glyphicon glyphicon-ok form-control-feedback"></span></br></p>-->
					   
						<label class="control-label" >CTA/Libreta</label>
                        <input type="text" required pattern="^[a-zA-Z0-9]{4,12}$" placeholder="2804" id="CapacidadSala"></br></p></br></p>
                      <!--  <span class="glyphicon glyphicon-ok form-control-feedback"></span></br></p>-->
                    </div>
					 <div class="form-group has-success has-feedback">
                        <label class="control-label" >Titular</label>
                        <input type="text" required pattern="^[a-zA-Z0-9]{4,12}$" placeholder="2804" id="Titular">
                      <!--  <span class="glyphicon glyphicon-ok form-control-feedback"></span></br></p>-->
						
						
                    </div>
				
				
				
				<input type="button" value="Aceptar" onClick=" ValidCaptcha();"/>
				<input type="reset" name="limpiar" value="Cancelar"onClick=" window.location.href='file:///D:/SistemaReservas/FrontalJoomla/FormularioActividadesClasesDirigidas.html'" />
                </form>
           

                <br>

            </div>
        </div>
    </div>
    
</div>

        
<?php require('Pie.php'); ?>
