<?php require('Cabecera.php'); ?>

<script>
    
    var Ajax = new AjaxObj();
    
    function obtenerUsuarios() {	
        //var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerUsuarios";
        var Url = "http://localhost/Sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerPrecios";
        var Params = '';

	
        Ajax.open("GET", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
	
        var RespTxt = Ajax.responseText;
        
        //alert(RespTxt);
	
        var Clase = eval('(' + RespTxt + ')');
        
        var contenido = '<table class="table table-striped table-bordered responsive"><thead><tr><th>Nombre Usuario</th><th>Tipo de Usuario</th><th>FechaAlta</th><th>FechaBaja</th><th></th></tr>';
                                                    
        var div = document.getElementById("usuarios");                
	
        for(i=0; i<Clase.usuarios.length; i++){		
            //contenido = contenido + '<th>' + Clase.tiposTarifa[i].idTipoTarifa + '</th>';
            contenido = contenido + '<tr>';
            //contenido = contenido + '<td>' + Clase.precios[i].idPrecio + '</td>';
            contenido = contenido + '<td>' + Clase.usuarios[i].NombreUsuario + '</td>';
            
            var TipoUsuario = Clase.usuarios[i].TipoUsuario;
            //alert(TipoUsuario);
            
            switch(TipoUsuario){
                case '1':                     
                    TipoUsuario = 'Administrador';
                    break;
                case '2':                     
                    TipoUsuario = 'Monitor';
                    break;
                case '3':                     
                    TipoUsuario = 'Gestor';
                    break;
                default:
                    TipoUsuario = '';
                    break;
                    
            }
            contenido = contenido + '<td>' + TipoUsuario + '</td>';
            
            contenido = contenido + '<td>' + Clase.usuarios[i].FechaAlta + '</td>';
            contenido = contenido + '<td>' + (Clase.usuarios[i].FechaBaja == null ? '' : Clase.usuarios[i].FechaBaja) + '</td>';
            contenido = contenido + '<td class="center"><a href="FormularioDetalleUsuario.php?idUsuario=' + Clase.usuarios[i].idUsuario + '" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Detalle</a></td>';
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
            <a href="Usuarios.php">Usuarios</a>
        </li>
    </ul>
</div>
<div class=" row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Buscador Usuarios</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" >Nombre Usuario</label>
                                <input type="text" id="filtroNombreUsuario" name="filtroNombreUsuario" class="input-sm" >	
                                    
                                <label class="control-label" >Tipo Usuario</label>
                                <input type="text" id="filtroTipoUsuario" name="filtroTipoUsuario" class="input-sm" >	
                                
                                <input class="box btn-primary" type="button" value="Buscar" onClick="obtenerUsuarios()"/>
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
                    <h2><i class="glyphicon glyphicon-th"></i> Usuarios </h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content" id="usuarios">
                    
                </div>
            </div>
            <br>
            <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetalleUsuario.php' "/>
        </div>

    </div>
</div>

<?php require('Pie.php'); ?>
