<?php require('Cabecera.php'); ?>
<script>
            
    var Ajax = new AjaxObj();
                
    function obtenerTiposSolicitud() {	
        var Url = "http://localhost/Sistemareservas/AdministradorBO.php?url=obtenerTiposSolicitud";		
        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerTiposSolicitud";
        var Params = '';

	
        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
	
        var RespTxt = Ajax.responseText;	
	
        alert(RespTxt);
	
        var Clase = eval('(' + RespTxt + ')');	
	
        var contenido = '<table class="table table-striped table-bordered responsive"><thead><tr><th>Nombre Solicitud</th><th>Descripcion Solicitud</th><th>Fecha Alta</th><th>Fecha Baja</th><th></th></tr>';	    
        var div = document.getElementById("tiposSolicitud");

	
        for(i=0; i<Clase.tiposSolicitud.length; i++){
            contenido = contenido + '<tr>';
            //contenido = contenido + '<td>' + Clase.tiposSolicitud[i].idTipoSolicitud + '</td>';
            contenido = contenido + '<td>' + Clase.tiposSolicitud[i].NombreSolicitud + '</td>';
            contenido = contenido + '<td>' + Clase.tiposSolicitud[i].DescripcionSolicitud + '</td>';
            contenido = contenido + '<td>' + Clase.tiposSolicitud[i].FechaAlta + '</td>';
            contenido = contenido + '<td>' + Clase.tiposSolicitud[i].FechaBaja + '</td>';
            contenido = contenido + '<td class="center"><a href="FormularioDetalleTipoSolicitud.php?idTipoSolicitud=' + Clase.tiposSolicitud[i].idTipoSolicitud + '" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a></td>';
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
            <a href="TipoSolicitud.php">Tipos Solicitud</a>
        </li>
    </ul>
</div>
<div class=" row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Buscador Tipos Solicitud</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" >Nombre Tipo Solicitud</label>
                                <input type="text" class="input-sm"  id="filtronombreTipoSolicitud">	                                
                                <input class="box btn-primary" type="button" value="Buscar" onClick="obtenerTiposSolicitud()"/></div>
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
                    <h2><i class="glyphicon glyphicon-th"></i> Tipos Solicitud </h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content" id="tiposSolicitud">
                </div>
            </div>
            <br>
            <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetalleTipoSolicitud.php' "/>
        </div>

    </div>
</div>

<?php require('Pie.php'); ?>
