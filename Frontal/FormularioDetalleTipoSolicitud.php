<?php require('Cabecera.php'); ?>


<script>
           
    var Ajax = new AjaxObj();
            
    function TipoSolicitud(){      
        //alert(document.getElementById("idSala"));
        if(document.getElementById("idSala").value == "")
            crearTipoSolicitud();
        else
            actualizarTipoSolicitud();
    }
            
    function crearTipoSolicitud() {
        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearTipoSolicitud";
        var Params = 'idTipoSolicitud='+ document.getElementById('idTipoSolicitud').value +
            '&NombreSolicitud='+ document.getElementById('NombreSolicitud').value +
            '&DescripcionSolicitud='+ document.getElementById('DescripcionSolicitud').value +
            '&FechaAlta='+ document.getElementById('FechaAlta').value +
            '&FechaBaja='+ document.getElementById('FechaBaja').value;

        //alert(Params);
	
        Ajax.open("POST", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
    }

    function actualizarTipoSolicitud() {
        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarTipoSolicitud";
        var Params = 'idTipoSolicitud='+ document.getElementById('idTipoSolicitud').value +
            '&NombreSolicitud='+ document.getElementById('NombreSolicitud').value +
            '&DescripcionSolicitud='+ document.getElementById('DescripcionSolicitud').value +
            '&FechaAlta='+ document.getElementById('FechaAlta').value +
            '&FechaBaja='+ document.getElementById('FechaBaja').value;

        //alert(Params);
	
        Ajax.open("PUT", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
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
<div class=" row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Detalle Sala</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">

                <form class="form-group">                    
                    <input value = "" type="hidden" class="input-sm" name="idTipoSolicitud" id="idTipoSolicitud">
                    <label class="control-label" >Nombre</label>                    
                    <input value = "" type="text" class="input-sm" name="NombreSolicitud" id="NombreSolicitud"></br></br>

                    <label class="control-label" >Descripcion Solicitud</label>
                    <input type="text" class="input-sm"  id="DescripcionSolicitud" name="DescripcionSolicitud"></br></br>

                    <label class="control-label" >Fecha Alta</label>
                    <input type="datetime" class="input-sm" name="FechaAlta" id="FechaAlta">

                    <label class="control-label" >Fecha Baja</label>
                    <input type="datetime" class="input-sm" name="FechaBaja" id="FechaBaja">

                    <input class="box btn-primary " type="button" value="Cancelar" onClick=" window.location.href='TipoSolicitud.php' " />
                    <input class="box btn-primary " type="button" value="Aceptar" onclick="TipoSolicitud()"/>

                </form>
            </div>
        </div>


    </div>

</div>
<script>
function obtenerTipoSolicitud(idTipoSolicitud) {		
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerTipoSolicitud";		
        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerTipoSolicitud";
        var Params = 'idTipoSolicitud='+ idTipoSolicitud;
	
        Ajax.open("POST", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
	
        var RespTxt = Ajax.responseText;	
	
        alert(RespTxt);
	
        var Clase = eval('(' + RespTxt + ')');
        //alert('Estado: '+ Clase.estado);
        //alert('idSala: '+ Clase.sala.idSala);
        //alert('Nombre: '+ Clase.sala.Nombre);
        //alert('Capacidad: '+ Clase.sala.Capacidad);
        //alert('Descripcion: '+ Clase.sala.Descripcion);	  
	  
        //document.getElementById('idTipoSolicitud').value=Clase.tipoSolicitud.idTipoSolicitud;
        document.getElementById('NombreSolicitud').value=Clase.tipoSolicitud.NombreSolicitud;
        document.getElementById('DescripcionSolicitud').value=Clase.tipoSolicitud.DescripcionSolicitud;
        document.getElementById('FechaAlta').value=Clase.tipoSolicitud.FechaAlta;
        document.getElementById('FechaBaja').value=Clase.tipoSolicitud.FechaBaja;	  	  	  
	  
    }
                         
</script>
<?php

if (isset($_GET['idTipoSolicitud'])) {
    $test = $_GET['idTipoSolicitud'];
    echo '<script>
           var varjs="' . $test . '";
           obtenerTipoSolicitud(varjs);
           </script>';
} else {
    $test = '';
}
?>        

<?php require('Pie.php'); ?>
