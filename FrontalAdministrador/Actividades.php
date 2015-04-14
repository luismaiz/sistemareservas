<?php require('Cabecera.php'); ?>
<script>
    var Ajax = new AjaxObj();
    function obtenerActividades(){
                //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=obtenerActividades";	
                var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerActividades";		        
                var Params = '';

                Ajax.open("GET", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
                Ajax.send(Params); // Enviamos los datos
	
                var RespTxt = Ajax.responseText;
                
                               
                var Clase = eval('(' + RespTxt + ')');	
                
                //alert(Clase);
	
                var contenido = '<table class="table table-striped table-bordered responsive"><thead><tr><th>Actividad</th><th>Descripcion</th><th>Intensidad</th><th>Grupo</th><th>Edad Minima</th><th>Edad Maxima</th><th></th></tr>';
                                                    
                var div = document.getElementById("actividades");                
	
                for(i=0; i<Clase.actividades.length; i++){		
                    //contenido = contenido + '<th>' + Clase.actividades[i].idActividad + '</th>';
                    contenido = contenido + '<tr>';
                    contenido = contenido + '<td>' + Clase.actividades[i].NombreActividad + '</td>';
                    contenido = contenido + '<td>' + Clase.actividades[i].IntensidadActividad + '</td>';
                    contenido = contenido + '<td>' + Clase.actividades[i].Edad_Minima + '</td>';
                    contenido = contenido + '<td>' + Clase.actividades[i].Edad_Max + '</td>';                    
                    contenido = contenido + '<td>' + Clase.actividades[i].Grupo + '</td>';
                    contenido = contenido + '<td>' + Clase.actividades[i].Descripcion + '</td>';
                    contenido = contenido + '<td class="center"><a href="FormularioDetalleActividad.php#obtenerActividad()?idActividad=' + Clase.actividades[i].idActividad + '" class="btn btn-info2"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a></td>';	
                    contenido = contenido + '</tr>';
                }
                contenido = contenido + '</thead></table>';
	
                div.innerHTML = contenido;
	
                //alert('Estado: '+ Clase.estado);
                //alert('idSala: '+ Clase.salas.length);
                //alert('idSala: '+ Clase.salas[0].idSala);
                //alert('NombreActividad: '+ Clase.salas[0].NombreActividad);
                //alert('Capacidad: '+ Clase.salas[0].Capacidad);
                //alert('Descripcion: '+ Clase.salas[0].Descripcion);
	  
                //document.getElementById('idSala').value=Clase.salas[0].idSala;
                //document.getElementById('NombreActividad').value=Clase.salas[0].NombreActividad;
                //document.getElementById('Capacidad').value=Clase.salas[0].Capacidad;
                //document.getElementById('Descripcion').value=Clase.salas[0].Descripcion;
            }
</script>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="#">Actividades</a>
        </li>
    </ul>
</div>
<div class=" row">
<div class="box col-md-12">
                        <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Buscador Actividades</h2>
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
                                        <input type="text" class="input-sm"  id="filtroactividad">
                                        <label class="control-label" >Intensidad</label>
                                        <input type="text" class="input-sm"  id="filtrointensidad">
                                        <label class="control-label" >Grupo</label>
                                        <input type="text" class="input-sm"  id="filtrogrupo">
                                        <input class="box btn-primary" type="button" value="Buscar" onClick="obtenerActividades();"/>
                        
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
                                    <h2><i class="glyphicon glyphicon-th"></i> Actividades </h2>

                                    <div class="box-icon">
                                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                                class="glyphicon glyphicon-chevron-up"></i></a>
                                    </div>
                                </div>
                               <div class="box-content" id="actividades"></div>
                            </div>
                            <br>
                            <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetalleActividad.php' "/>
                            
                        </div>
                        
                    </div>
</div>

<?php require('Pie.php'); ?>
