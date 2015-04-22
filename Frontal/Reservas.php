<?php require('Cabecera.php'); ?>

<script>
    
    var Ajax = new AjaxObj();
    
    function obtenerSolicitudes() {	
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerSolicitudes";
        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerPrecios";
        var Params = '';       
        
        Params += document.getElementById("filtroLocalizador").value == "" ? '': '&Localizador=' + document.getElementById("filtroLocalizador").value;
        Params += document.getElementById("filtroNombre").value == "" ? '': '&Nombre=' + document.getElementById("filtroNombre").value;
        Params += document.getElementById("filtroApellidos").value == "" ? '': '&Apellidos=' + document.getElementById("filtroApellidos").value;
        Params += document.getElementById("filtroDni").value == "" ? '': '&DNI=' + document.getElementById("filtroDni").value;
        Params += document.getElementById("filtroEmail").value == "" ? '': '&EMail=' + document.getElementById("filtroEmail").value;
        Params += document.getElementById("filtroFechaSolicitud").value == "" ? '': '&FechaSolicitud=' + document.getElementById("filtroFechaSolicitud").value;
        
        //alert(Params);
                
        Ajax.open("POST", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
	
        var RespTxt = Ajax.responseText;
        
        //alert(RespTxt);
	
        var Clase = eval('(' + RespTxt + ')');	              
        
        //alert(Clase);
        
        var contenido = '<table class="table table-striped table-bordered responsive"><thead><tr><th>Tipo Solicitud</th><th>Tipo Tarifa</th><th>Fecha Solicitud</th>' +
                         '<th>Nombre</th><th>Apellidos</th><th>DNI</th><th>EMail</th>' +
                         '<th>DescripcionSolicitud</th><th>Otros</th><th>Localizador</th><th></th></tr>';
                                                    
        var div = document.getElementById("reservas");                
	
        for(i=0; i<Clase.solicitudes.length; i++){		
            //contenido = contenido + '<th>' + Clase.tiposTarifa[i].idTipoTarifa + '</th>';
            contenido = contenido + '<tr>';
            //contenido = contenido + '<td>' + Clase.precios[i].idPrecio + '</td>';
            contenido = contenido + '<td>';
            contenido = contenido + '<input type="hidden" id="idTipoSolicitud" name="idTipoSolicitud" value="' + Clase.solicitudes[i].idTipoSolicitud + '"/>';
            contenido = contenido + obtenerTipoSolicitud(Clase.solicitudes[i].idTipoSolicitud);
            contenido = contenido + '</td>';
            
            contenido = contenido + '<td>';
            contenido = contenido + '<input type="hidden" id="idTipoTarifa" name="idTipoTarifa" value="' + Clase.solicitudes[i].idTipoTarifa + '"/>';
            contenido = contenido + obtenerTipoTarifa(Clase.solicitudes[i].idTipoTarifa);
            contenido = contenido + '</td>';               
            
            contenido = contenido + '<td>' + Clase.solicitudes[i].FechaSolicitud + '</td>';
            contenido = contenido + '<td>' + Clase.solicitudes[i].Nombre + '</td>';
            contenido = contenido + '<td>' + Clase.solicitudes[i].Apellidos + '</td>';
            contenido = contenido + '<td>' + Clase.solicitudes[i].DNI + '</td>';
            contenido = contenido + '<td>' + Clase.solicitudes[i].EMail + '</td>';            
            contenido = contenido + '<td>' + Clase.solicitudes[i].DescripcionSolicitud + '</td>';
            contenido = contenido + '<td>' + Clase.solicitudes[i].Otros + '</td>';
            contenido = contenido + '<td>' + Clase.solicitudes[i].Localizador + '</td>';
            
            contenido = contenido + '<td class="center"><a href="" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a></td>';
            contenido = contenido + '</tr>';
        }
        contenido = contenido + '</thead></table>';
	
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
    
    function obtenerTipoSolicitud(idTipoSolicitud){
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerTipoSolicitud";		
        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBxO.php?url=obtenerPrecio";
        var Params = 'idTipoSolicitud='+ idTipoSolicitud;

	
        Ajax.open("POST", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
	
        var RespTxt = Ajax.responseText;	
        
        //alert(RespTxt);
	
        var Clase = eval('(' + RespTxt + ')');
        
        return  Clase.tipoSolicitud.NombreSolicitud;        
    }
    
    function obtenerTipoTarifa(idTipoTarifa){        
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerTipoTarifa";
        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBxO.php?url=obtenerPrecio";
        var Params = 'idTipoTarifa='+ idTipoTarifa;

	
        Ajax.open("POST", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
	
        var RespTxt = Ajax.responseText;
	
        var Clase = eval('(' + RespTxt + ')');
        
        return  Clase.tipoTarifa.NombreTarifa;
    }    
</script>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="#">Reservas</a>
        </li>
    </ul>
</div>
<div class=" row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Buscador Reservas</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" >Localizador</label>
                                <input type="text" class="input-sm" id="filtroLocalizador" name="filtroLocalizador" value="">	
                                <label class="control-label" >Tipo Abono</label>
                                <select id="filtroTipoAbono" class="input-sm" >	
                                    <option>Abono Diario</option>
                                    <option>Abono Mensual</option>
                                    <option>Clase Dirigida</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nombre</label>
                                <input type="text" class="input-sm" pattern="^[a-zA-Z0-9]{4,12}$" id="filtroNombre" name="filtroNombre" value="" />
                                <label class="control-label" >Apellidos</label>
                                <input type="text" class="input-sm" pattern="[A-Za-z]" id="filtroApellidos" name="filtroApellidos" value="" />
                                <label class="control-label" >DNI</label>
                                <input type="text" class="input-sm" pattern="^[a-zA-Z0-9]{4,12}$" id="filtroDni" name="filtroDni"/>
                                <label class="control-label" >eMail</label>
                                <input type="email" class="input-sm" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="filtroEmail" name="filtroEmail"/><br>
                                <label class="control-label" >Fecha Solicitud</label>
                                <input type="datetime-local" class="input-sm" id="filtroFechaSolicitud" name="filtroFechaSolicitud"/>
                                <input class="box btn-primary" type="button" value="Buscar" onclick="obtenerSolicitudes()"/>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> Reservas </h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content" id="reservas">
                </div>
            </div>
            <br>
        </div>

    </div>
</div>

<?php require('Pie.php'); ?>
