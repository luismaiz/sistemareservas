<?php require('Cabecera.php'); ?>
<script>
var Ajax = new AjaxObj();

            function obtenerTiposTarifa(){
                //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=obtenerActividades";	
                var Url = "http://pfgreservas.rightwatch.es/Negocio/AdministradorBO.php?url=obtenerTiposTarifa";		        
                var Params = '';

	
                Ajax.open("GET", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
                Ajax.send(Params); // Enviamos los datos
	
                var RespTxt = Ajax.responseText;
                
                //alert(RespTxt);
	
                var Clase = eval('(' + RespTxt + ')');	
                
                //alert(Clase);
	
                var contenido = '<table class="table table-striped table-bordered responsive"><thead><tr><th>NombreTarifa</th><th>DescripcionTarifa</th><th>FechaAlta</th><th>FechaBaja</th><th></th></tr>';
                                                    
                var div = document.getElementById("tiposTarifa");                
	
                for(i=0; i<Clase.tiposTarifa.length; i++){		
                    //contenido = contenido + '<th>' + Clase.tiposTarifa[i].idTipoTarifa + '</th>';
                    contenido = contenido + '<tr>';
                    contenido = contenido + '<td>' + Clase.tiposTarifa[i].NombreTarifa + '</td>';
                    contenido = contenido + '<td>' + Clase.tiposTarifa[i].DescripcionTarifa + '</td>';
                    contenido = contenido + '<td>' + Clase.tiposTarifa[i].FechaAlta + '</td>';
                    contenido = contenido + '<td>' + Clase.tiposTarifa[i].FechaBaja + '</td>';
                    contenido = contenido + '<td class="center"><a class="btn btn-info2" href="#"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a></td>';	
                    contenido = contenido + '</tr>';
                }
                contenido = contenido + '</thead></table>';
	
                div.innerHTML = contenido;	
            }
            
            </script>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="#">Tipo de Tarifa</a>
        </li>
    </ul>
</div>
<div class=" row">
<div class="box col-md-12">
                        <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Buscador Tipos de Tarifa</h2>
                        <div class="box-icon">

                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        
                        </div>
                        </div>
                        <div class="box-content">
                            <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="form-group">
					<label class="control-label" >Tipos de Tarifa</label>
                                         <input type="text" class="input-sm" id="IntensidadActividad">	
				        <input class="box btn-primary" type="button" value="Buscar"/>
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
                                    <h2><i class="glyphicon glyphicon-th"></i> Tipos de tarifa </h2>

                                    <div class="box-icon">
                                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                                class="glyphicon glyphicon-chevron-up"></i></a>
                                    </div>
                                </div>
                                <div class="box-content" id="tiposTarifa">

                                </div>
                            </div>
                            <br>
                            <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetalleTarifa.php' "/>
                        </div>
                        
                    </div>
</div>

<?php require('Pie.php'); ?>
