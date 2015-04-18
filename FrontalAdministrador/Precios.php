<?php require('Cabecera.php'); ?>

<script>
    
    var Ajax = new AjaxObj();
    
    function obtenerPrecios() {	
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerPrecios";		
        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerPrecios";
        var Params = '';

	
        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
	
        var RespTxt = Ajax.responseText;
        
        //alert(RespTxt);
	
        var Clase = eval('(' + RespTxt + ')');	              
        
        var contenido = '<table class="table table-striped table-bordered responsive"><thead><tr><th>NombreSolicitud</th><th>NombreAbono</th><th>NombreActividad</th><th>NombrePrecio</th><th>DescripcionPrecio</th><th>Precio</th><th>FechaAlta</th><th>FechaBaja</th><th></th></tr>';
                                                    
        var div = document.getElementById("precios");                
	
        for(i=0; i<Clase.precios.length; i++){		
            //contenido = contenido + '<th>' + Clase.tiposTarifa[i].idTipoTarifa + '</th>';
            contenido = contenido + '<tr>';
            //contenido = contenido + '<td>' + Clase.precios[i].idPrecio + '</td>';
            contenido = contenido + '<td>';
            contenido = contenido + '<input type="hidden" id="idTipoSolicitud" name="idTipoSolicitud" value="' + Clase.precios[i].idTipoSolicitud + '"/>';
            contenido = contenido + obtenerTipoSolicitud(Clase.precios[i].idTipoSolicitud);
            contenido = contenido + '</td>';
            
            contenido = contenido + '<td>';
            contenido = contenido + '<input type="hidden" id="idTipoAbono" name="idTipoAbono" value="' + Clase.precios[i].idTipoAbono + '"/>';
            contenido = contenido + obtenerTipoAbono(Clase.precios[i].idTipoAbono);
            contenido = contenido + '</td>';
            
            contenido = contenido + '<td>';
            contenido = contenido + '<input type="hidden" id="idActividad" name="idActividad" value="' + Clase.precios[i].idActividad + '"/>';
            contenido = contenido + obtenerActividad(Clase.precios[i].idActividad);
            contenido = contenido + '</td>';            
            
            contenido = contenido + '<td>' + Clase.precios[i].NombrePrecio + '</td>';
            contenido = contenido + '<td>' + Clase.precios[i].DescripcionPrecio + '</td>';
            contenido = contenido + '<td>' + Clase.precios[i].Precio + '</td>';
            contenido = contenido + '<td>' + Clase.precios[i].FechaAlta + '</td>';
            contenido = contenido + '<td>' + Clase.precios[i].FechaBaja + '</td>';
            contenido = contenido + '<td class="center"><a href="FormularioDetallePrecio.php?idPrecio=' + Clase.precios[i].idPrecio + '" class="btn btn-info2"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a></td>';
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
    
    function obtenerTipoAbono(idTipoAbono){        
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerTipoAbono";
        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBxO.php?url=obtenerPrecio";
        var Params = 'idTipoAbono='+ idTipoAbono;

	
        Ajax.open("POST", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
	
        var RespTxt = Ajax.responseText;
	
        var Clase = eval('(' + RespTxt + ')');
        
        return  Clase.tipoSolicitud.NombreAbono;
    }
    
    function obtenerActividad(idActividad){
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerActividad";
        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBxO.php?url=obtenerPrecio";
        var Params = 'idActividad='+ idActividad;

	
        Ajax.open("POST", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
	
        var RespTxt = Ajax.responseText;	
	
        //alert(RespTxt);
        
        var Clase = eval('(' + RespTxt + ')');
        
        return  Clase.actividad.NombreActividad;
    }
</script>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="#">Precios</a>
        </li>
    </ul>
</div>
<div class=" row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Buscador Precios</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" >Actividad</label>
                                <select id="filtroactividad" class="input-sm" >	
                                    <option>Cardio</option>
                                    <option>Fitness</option>

                                </select>
                                <label class="control-label" >Tipo Abono</label>
                                <select id="filtrotipoabono" class="input-sm" >	
                                    <option>Abono Diario</option>
                                    <option>Abono Mensual</option>
                                    <option>Clase Dirigida</option>
                                </select>
                                <label class="control-label" >Tipo Tarifa</label>
                                <select id="filtrotipotarifa" class="input-sm" >	
                                    <option>Mayores</option>
                                    <option>Familiar</option>
                                    <option>Adulto</option>
                                </select>
                                <input class="box btn-primary" type="button" value="Buscar" onClick="obtenerPrecios()"/>
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
                    <h2><i class="glyphicon glyphicon-th"></i> Precios </h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content" id="precios">
                    
                </div>
            </div>
            <br>
            <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetallePrecios.php' "/>
        </div>

    </div>
</div>

<?php require('Pie.php'); ?>
