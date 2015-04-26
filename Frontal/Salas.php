<?php require('Cabecera.php'); ?>
<script>
            
            var Ajax = new AjaxObj();
                
            function obtenerSalas() {
                
                //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=obtenerSalas";
                var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerSalas";

                //var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerSalas";
                //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerSalas";

                var Params = '';

	alert('hola');
                Ajax.open("GET", Url, false);
                Ajax.setRequestHeader("Content-Type","application/json");
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");                
                Ajax.send(Params); // Enviamos los datos
	
                var RespTxt = Ajax.responseText;
        
                var Clase = eval('(' + RespTxt + ')');	
        
                //alert(Clase);
                var contenido = '<table class="table table-striped table-bordered responsive"><thead><tr><th>Nombre</h6></th><th>Capacidad</th><th>Descripcion</th><th>FechaAlta</th><th>FechaBaja</th><th></th></tr>';
                var div = document.getElementById("salas");                      
                //contenido = contenido + '<form>';
	
                
        
                for(i=0; i<Clase.salas.length; i++){
                              
                    contenido = contenido + '<tr>';
                    contenido = contenido + '<input type="hidden" id="idSala" value=' + Clase.salas[i].idSala + '</input>';
                    contenido = contenido + '<td class="center">' + Clase.salas[i].NombreSala + '</td>';
                    contenido = contenido + '<td class="center">' + Clase.salas[i].CapacidadSala + '</td>';
                    contenido = contenido + '<td class="center">' + Clase.salas[i].DescripcionSala + '</td>';
                    contenido = contenido + '<td class="center">' + Clase.salas[i].FechaAlta + '</td>';
                    contenido = contenido + '<td class="center">' + Clase.salas[i].FechaBaja + '</td>';
                    contenido = contenido + '<td class="center"><a href="FormularioDetalleSala.php?idSala=' + Clase.salas[i].idSala + '" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a></td>';                    
                    contenido = contenido + '</tr>';
                    //contenido = contenido + "<br>";
                }
                contenido = contenido + '</table>';
	
                div.innerHTML = contenido;
	
                //alert('Estado: '+ Clase.estado);
                //alert('idSala: '+ Clase.salas.length);
                //alert('idSala: '+ Clase.salas[0].idSala);
                //alert('NombreSala: '+ Clase.salas[0].NombreSala);
                //alert('CapacidadSala: '+ Clase.salas[0].CapacidadSala);
                //alert('DescripcionSala: '+ Clase.salas[0].DescripcionSala);
	  
                //document.getElementById('idSala').value=Clase.salas[0].idSala;
                //document.getElementById('NombreSala').value=Clase.salas[0].NombreSala;
                //document.getElementById('CapacidadSala').value=Clase.salas[0].CapacidadSala;
                //document.getElementById('DescripcionSala').value=Clase.salas[0].DescripcionSala;
            }
            
        </script>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="#">Salas</a>
        </li>
    </ul>
</div>
<div class=" row">
<div class="box col-md-12">
                        <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Buscador Salas</h2>
                        <div class="box-icon">

                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        
                        </div>
                        </div>
                        <div class="box-content">
                            <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="form-group">
					<label class="control-label" >Nombre Sala</label>
                                        <input type="text" class="input-sm"  id="filtronombresala">	
                                        <label class="control-label" >Capacidad Sala</label>
                                        <input type="text" class="input-sm"  id="filtrocapacidadsala">
                                        <input class="box btn-primary" type="button" value="Buscar" onClick="obtenerSalas()"/></div>
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
                                    <h2><i class="glyphicon glyphicon-th"></i> Salas </h2>

                                    <div class="box-icon">
                                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                                class="glyphicon glyphicon-chevron-up"></i></a>
                                    </div>
                                </div>
                                <div class="box-content" id="salas">
                                </div>
                            </div>
                            <br>
                            <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetalleSala.php' "/>
                        </div>
                        
                    </div>
</div>

<?php require('Pie.php'); ?>
