<?php require('Cabecera.php'); ?>


<script>
           
    var Ajax = new AjaxObj();


    function crearPrecio() {	
        //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=crearPrecio";		
        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearPrecio";
        var Params = 'idPrecio='+ document.getElementById('idPrecio').value +
            '&idTipoSolicitud='+ document.getElementById('idTipoSolicitud').value +
            '&idTipoAbono='+ document.getElementById('idTipoAbono').value +
            '&idActividad='+ document.getElementById('idTipoAbono').value +
            '&NombrePrecio='+ document.getElementById('NombrePrecio').value + 		     
            '&DescripcionPrecio='+ document.getElementById('DescripcionPrecio').value +
            '&Precio='+ document.getElementById('Precio').value + 		     
            '&FechaAlta='+ document.getElementById('FechaAltaPrecio').value +
            '&FechaBaja='+ document.getElementById('FechaBajaPrecio').value;

	
        Ajax.open("POST", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
        
        mostrarRespuesta(Ajax.responseText);
    }

    function actualizarPrecio() {
        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarPrecio";
        var Params = 'idPrecio='+ document.getElementById('idTipoTarifa').value +
            '&idTipoSolicitud='+ document.getElementById('idTipoSolicitud').value +
            '&idTipoAbono='+ document.getElementById('idTipoAbono').value +
            '&idActividad='+ document.getElementById('idTipoAbono').value +
            '&NombrePrecio='+ document.getElementById('NombrePrecio').value + 		     
            '&DescripcionPrecio='+ document.getElementById('DescripcionPrecio').value +
            '&Precio='+ document.getElementById('Precio').value + 		     
            '&FechaAlta='+ document.getElementById('FechaAltaPrecio').value +
            '&FechaBaja='+ document.getElementById('FechaBajaPrecio').value;


        //alert(Params);
	
        Ajax.open("PUT", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
        
        mostrarRespuesta(Ajax.responseText);
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
        <li>
            <a href="#">Detalle Precio</a>
        </li>
    </ul>
</div>
<div class=" row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Detalle Precio</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">

                <form class="form-group">
                    <label class="control-label" >idTipoSolicitud</label>
                    <input type="hidden" class="input-sm" name="idTipoSolicitud" id="idTipoSolicitud">
                    <input type="text" class="input-sm" name="NombreSolicitud" id="NombreSolicitud"></br></br>

                    <label class="control-label" >idTipoAbono</label>
                    <input type="hidden" class="input-sm" name="idTipoAbono" id="idTipoAbono">
                    <input type="text" class="input-sm" name="NombreAbono" id="NombreAbono"></br></br>

                    <label class="control-label" >idActividad</label>
                    <input type="hidden" class="input-sm" name="idActividad" id="idActividad">
                    <input type="text" class="input-sm" name="NombreActividad" id="NombreActividad">

                    <label class="control-label" >NombrePrecio</label>
                    <input type="text" class="input-sm" name="NombrePrecio" id="NombrePrecio">
                    
                    <label class="control-label" >DescripcionPrecio</label>
                    <input type="text" class="input-sm" name="DescripcionPrecio" id="DescripcionPrecio">
                    
                    <label class="control-label" >Precio</label>
                    <input type="text" class="input-sm" name="Precio" id="Precio"></br></br>
                    
                    <label class="control-label" >FechaAlta</label>
                    <input type="date" class="input-sm" name="FechaAlta" id="FechaAlta">
                    
                    <label class="control-label" >FechaBaja</label>
                    <input type="date" class="input-sm" name="FechaBaja" id="FechaBaja"></br></br>

                    <input class="box btn-primary " type="button" value="Cancelar" onClick=" window.location.href='Precios.php' " />
                    <input class="box btn-primary " type="button" value="Aceptar" onclick="crearPrecio()"/>

                </form>
            </div>
        </div>


    </div>

</div>

<script>
    function obtenerPrecio() {	
        //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=obtenerSala";
        var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerPrecio";
        var Params = 'idPrecio='+ document.getElementById('idPrecio').value;

	
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
        //alert('DescripcionTarifa: '+ Clase.sala.DescripcionTarifa);
	  
        document.getElementById('idPrecio').value=Clase.precio.idPrecio;	  
        document.getElementById('idTipoSolicitud').value=Clase.precio.idTipoSolicitud;
        document.getElementById('idTipoAbono').value=Clase.precio.idTipoAbono;
        document.getElementById('idActividad').value=Clase.precio.idActividad;
        document.getElementById('NombrePrecio').value=Clase.precio.NombrePrecio;
        document.getElementById('DescripcionPrecio').value=Clase.precio.DescripcionPrecio;
        document.getElementById('Precio').value=Clase.precio.Precio;	  
        document.getElementById('FechaAltaPrecio').value=Clase.precio.FechaAlta;
        document.getElementById('FechaBajaPrecio').value=Clase.precio.FechaBaja;
    }    
</script>
<?php
if (isset($_GET['idPrecio'])) {
    $test = $_GET['idPrecio'];
    echo $test;
    echo '<script>
           var varjs="' . $test . '";
           obtenerPrecio(varjs);
           </script>';
} else {
    $test = '';
}
?>
<?php require('Pie.php'); ?>
