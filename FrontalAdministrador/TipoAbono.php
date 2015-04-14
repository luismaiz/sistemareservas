<?php require('Cabecera.php'); ?>
<script>
 var Ajax = new AjaxObj();

            function obtenerTiposAbono(){
                alert(RespTxt);
                //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=obtenerActividades";	
                var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerTiposAbono";		        
                var Params = '';

	
                Ajax.open("GET", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
                Ajax.send(Params); // Enviamos los datos
	
                var RespTxt = Ajax.responseText;
                
                //alert(RespTxt);
	
                var Clase = eval('(' + RespTxt + ')');	
                
                //alert(Clase);
	
                var contenido = '<table class="table table-striped table-bordered responsive"><thead><tr><th>NombreAbono</th><th>DescripcionAbono</th><th>FechaAlta</th><th>FechaBaja</th><th></th></tr>';
                                                    
                var div = document.getElementById("tiposAbono");                
	
                for(i=0; i<Clase.tiposAbono.length; i++){		
                    //contenido = contenido + '<th>' + Clase.actividades[i].idTipoAbono + '</th>';
                    contenido = contenido + '<tr>';
                    contenido = contenido + '<td>' + Clase.tiposAbono[i].NombreAbono + '</td>';
                    contenido = contenido + '<td>' + Clase.tiposAbono[i].DescripcionAbono + '</td>';
                    contenido = contenido + '<td>' + Clase.tiposAbono[i].FechaAlta + '</td>';
                    contenido = contenido + '<td>' + Clase.tiposAbono[i].FechaBaja + '</td>';
                    contenido = contenido + '<td class="center"><a class="btn btn-info2" href="#"><i class="glyphicon glyphicon-edit icon-white"></i>Edit</a></td>';	
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
            <a href="#">Tipo de Abono</a>
        </li>
    </ul>
</div>
<div class=" row">
<div class="box col-md-12">
                        <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Buscador Tipos de Abono</h2>
                        <div class="box-icon">

                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        
                        </div>
                        </div>
                        <div class="box-content">
                            <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                
                                 <div class="form-group">
					<label class="control-label" >Tipos de Abono</label>
                                        <input type="text" class="input-sm" id="IntensidadActividad">	
				       <input class="box btn-primary" type="button" value="Buscar" onClick="obtenerTiposAbono()"/>
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
                                    <h2><i class="glyphicon glyphicon-th"></i> Tipos de abono </h2>

                                    <div class="box-icon">
                                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                                class="glyphicon glyphicon-chevron-up"></i></a>
                                    </div>
                                </div>
                            
                                <div class="box-content" id="tiposAbono">
                                                                    </div>
                            </div>
                            <br>
                            <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetalleAbono.php' "/>
                        </div>
                        
                    </div>
</div>

<?php require('Pie.php'); ?>
