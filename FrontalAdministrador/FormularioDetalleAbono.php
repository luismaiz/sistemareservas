<?php require('Cabecera.php'); ?>


<script>
           
    var Ajax = new AjaxObj();
    
    function Abono(){        
        //alert(document.getElementById("idTipoAbono"));
        if(document.getElementById("idTipoAbono").value == "")
            crearTipoAbono();
        else
            actualizarTipoAbono();
    }

    function crearTipoAbono() {
        //alert("crear");
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=crearTipoAbono";
        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearTipoAbono";	
        var Params = 'NombreAbono='+ document.getElementById('NombreAbono').value +
            '&DescripcionAbono='+ document.getElementById('DescripcionAbono').value +
            '&FechaAlta='+ document.getElementById('FechaAlta').value +
            '&FechaBaja='+ document.getElementById('FechaBaja').value;

        //alert(Params);
	
        Ajax.open("POST", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
        
        mostrarRespuesta(Ajax.responseText);
    }

    function actualizarTipoAbono() {
        //alert("actualizar");
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=actualizarTipoAbono";
        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarTipoAbono";
        var Params = 'idTipoAbono='+ document.getElementById('idTipoAbono').value +
            '&NombreAbono='+ document.getElementById('NombreAbono').value +
            '&DescripcionAbono='+ document.getElementById('DescripcionAbono').value +
            '&FechaAlta='+ document.getElementById('FechaAlta').value +
            '&FechaBaja='+ document.getElementById('FechaBaja').value;

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
            <a href="TipoAbono.php">Tipo Abono</a>
        </li>
        <li>
            <a href="#">Detalle Abono</a>
        </li>
    </ul>
</div>
<div class=" row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Detalle Abono</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">

                <form class="form-group">
                    <label class="control-label" >Nombre</label>
                    <input type="hidden" class="input-sm" name="idTipoAbono" id="idTipoAbono"/>
                    <input type="text" class="input-sm" name="NombreAbono" id="NombreAbono"/></br></br>

                    <label class="control-label" >Descripcion</label>
                    <input type="text" class="input-sm"  id="DescripcionAbono" name="DescripcionAbono"/></br></br>

                    <label class="control-label" >Fecha Alta</label>
                    <input type="date" class="input-sm" name="FechaAlta" id="FechaAlta"/>

                    <label class="control-label" >Fecha Baja</label>
                    <input type="date" class="input-sm" name="FechaBaja" id="FechaBaja"/>

                    <input class="box btn-primary " type="button" value="Cancelar" onClick=" window.location.href='TipoAbono.php' " />
                    <input class="box btn-primary " type="button" value="Aceptar" onclick="Abono()"/>

                </form>
            </div>
        </div>


    </div>

</div>

<script>
    function obtenerTipoAbono(idTipoAbono) {		
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerTipoAbono";
        var Params = 'idTipoAbono='+ idTipoAbono;	
	
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
        //alert('Descripcion: '+ Clase.sala.Descripcion);	  
	  
        document.getElementById('idTipoAbono').value=Clase.tipoSolicitud.idTipoAbono;
        document.getElementById('NombreAbono').value=Clase.tipoSolicitud.NombreAbono;
        document.getElementById('DescripcionAbono').value=Clase.tipoSolicitud.DescripcionAbono;
        document.getElementById('FechaAlta').value=Clase.tipoSolicitud.FechaAlta;
        document.getElementById('FechaBaja').value=Clase.tipoSolicitud.FechaBaja;	  	  	  
	  
    }
</script>

<?php

if (isset($_GET['idTipoAbono'])) {
    $test = $_GET['idTipoAbono'];
    echo '<script>
           var varjs="' . $test . '";
           obtenerTipoAbono(varjs);
           </script>';
} else {
    $test = '';
}
?>              
<?php require('Pie.php'); ?>
