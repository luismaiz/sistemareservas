<?php require('Cabecera.php'); ?>
<script>
           
    var Ajax = new AjaxObj();
    
    function Actividad(){      
        //alert(document.getElementById("idActividad"));
        if(document.getElementById("idActividad").value == "")
            crearActividad();
        else
            actualizarActividad();
    }
                
    function crearActividad() {	        
        //alert("crear");
        //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=crearActividad";		
        var Url = "http://localhost/Sistemareservas/AdministradorBO.php?url=crearActividad";		        
	
        var Params = '&NombreActividad='+ document.getElementById('NombreActividad').value +
            '&IntensidadActividad='+ document.getElementById('IntensidadActividad').value +
            '&EdadMinima='+ document.getElementById('EdadMinima').value +
            '&EdadMaxima='+ document.getElementById('EdadMaxima').value +
            '&Grupo='+ document.getElementById('Grupo').value +
            '&Descripcion='+ document.getElementById('Descripcion').value +
            '&FechaAlta='+ document.getElementById('FechaAlta').value +
            '&FechaBaja='+ document.getElementById('FechaBaja').value;
		     
        //alert(Params);
		     
        Ajax.open("POST", Url, true);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        Ajax.send(Params); // Enviamos los datos
        
        mostrarRespuesta(Ajax.responseText);
    }

    function actualizarActividad() {	
        alert("actualizar");
        //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=actualizarActividad";			
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=actualizarActividad";		        
        var Params = 'idActividad='+ document.getElementById('idActividad').value +
            '&NombreActividad='+ document.getElementById('NombreActividad').value + 
            '&IntensidadActividad='+ document.getElementById('IntensidadActividad').value + 
            '&EdadMinima='+ document.getElementById('EdadMinima').value +
            '&EdadMaxima='+ document.getElementById('EdadMaxima').value +
            '&Grupo='+ document.getElementById('Grupo').value +
            '&Descripcion='+ document.getElementById('Descripcion').value +
            '&FechaAlta='+ document.getElementById('FechaAlta').value +
            '&FechaBaja='+ document.getElementById('FechaBaja').value;
        
        alert(Params);

	
        Ajax.open("PUT", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
        
        mostrarRespuesta(Ajax.responseText);
    }

    function borrarActividad() {	
        //var Url = "http://www.rightwatch.es/pfgreservas/Api.php?url=borrarActividad";	
        var Url = "http://localhost/sistemareservas/AdministradorBO.php?url=borrarActividad";		        
        var Params = 'idActividad='+ document.getElementById('idActividad').value;

	
        Ajax.open("DELETE", Url, false);
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
            <a href="Actividades.php">Actividades</a>
        </li>
        <li>
            <a href="#">Detalle Actividad</a>
        </li>
    </ul>
</div>
<div class=" row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Detalle Actividad</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">

                <form class="form-group">
                    <label class="control-label" >NombreActividad</label>
                    <input value = "" type="hidden" class="input-sm" name="idActividad" id="idActividad">                    
                    <input type="text" class="input-sm"  id="NombreActividad" name="NombreActividad"/><br><br>

                    <label class="control-label" >IntensidadActividad</label>
                    <input type="text" class="input-sm"  id="IntensidadActividad" name="IntensidadActividad"/><br><br>

                    <label class="control-label" >Edad Mínima</label>
                    <input type="text" class="input-sm" name="EdadMinima" id="EdadMinima"/>

                    <label class="control-label" >Edad Máxima</label>
                    <input type="text" class="input-sm" name="EdadMaxima" id="EdadMaxima"/>

                    <label class="control-label" >Grupo</label>
                    <input type="text" class="input-sm" id="Grupo" name="Grupo"/><br><br>

                    <label class="control-label" >Descripcion</label>
                    <input type="color" class="input-sm" id="Descripcion" name="Descripcion"/><br><br>

                    <label class="control-label" >Fecha Alta</label>
                    <input type="date" class="input-sm" name="FechaAlta" id="FechaAlta"/>

                    <label class="control-label" >Fecha Baja</label>
                    <input type="date" class="input-sm" name="FechaBaja" id="FechaBaja"/>

                    <input class="box btn-primary" type="button" value="Cancelar" onClick=" window.location.href='Actividades.php' " />
                    <input class="box btn-primary" type="button" value="Aceptar" onclick="Actividad()"/>
                </form>
            </div>
        </div>


    </div>

</div>

<script>
    function obtenerActividad(idActividad) {	
        //var Url = "http://localhost:8080/pfgreservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerActividad";
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerActividad";		
        var Params = 'idActividad='+ idActividad;

        //alert('hola');
        Ajax.open("POST", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
	
        var RespTxt = Ajax.responseText;	
	
        //alert(RespTxt);
	
        var Clase = eval('(' + RespTxt + ')');
                
	  
        document.getElementById('idActividad').value=Clase.actividad.idActividad;
        document.getElementById('NombreActividad').value=Clase.actividad.NombreActividad;	  
        document.getElementById('IntensidadActividad').value=Clase.actividad.IntensidadActividad;
        document.getElementById('EdadMinima').value=Clase.actividad.EdadMinima;
        document.getElementById('EdadMaxima').value=Clase.actividad.EdadMaxima;
        document.getElementById('Grupo').value=Clase.actividad.Grupo;
        document.getElementById('Descripcion').value=Clase.actividad.Descripcion;
        document.getElementById('FechaAlta').value=Clase.actividad.FechaAlta;
        document.getElementById('FechaBaja').value=Clase.actividad.FechaBaja;  	  
    }
</script>

<?php

if (isset($_GET['idActividad'])) {
    $test = $_GET['idActividad'];
    echo '<script>
           var varjs="' . $test . '";
           obtenerActividad(varjs);
           </script>';
} else {
    $test = '';
}
?>              

<?php require('Pie.php'); ?>
