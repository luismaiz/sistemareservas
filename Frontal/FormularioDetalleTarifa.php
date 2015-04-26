<?php require('Cabecera.php'); ?>


<script>
           
    var Ajax = new AjaxObj();
    
    function TipoTarifa(){      
        //alert(document.getElementById("idSala"));
        if(document.getElementById("idTipoTarifa").value == "")
            crearTipoTarifa();
        else
            actualizarTipoTarifa();
    }
    
    function crearTipoTarifa() {	
        //alert("crear");
        var Url = "http://localhost/Sistemareservas/AdministradorBO.php?url=crearTipoTarifa";
        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearTipoTarifa";		
        var Params = 'idTipoTarifa='+ document.getElementById('idTipoTarifa').value +
            '&NombreTarifa='+ document.getElementById('NombreTarifa').value +
            '&DescripcionTarifa='+ document.getElementById('DescripcionTarifa').value +
            '&FechaAlta='+ document.getElementById('FechaAlta').value +
            '&FechaBaja='+ document.getElementById('FechaBaja').value;

        //alert(Params);
	
        Ajax.open("POST", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
        
        mostrarRespuesta(Ajax.responseText);
    }   

    function actualizarTipoTarifa() {
        //alert("actualizar");
        var Url = "http://localhost/Sistemareservas/AdministradorBO.php?url=actualizarTipoTarifa";
        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarTipoTarifa";
        var Params = 'idTipoTarifa='+ document.getElementById('idTipoTarifa').value +
            '&NombreTarifa='+ document.getElementById('NombreTarifa').value +
            '&DescripcionTarifa='+ document.getElementById('DescripcionTarifa').value +
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
            <a href="TipoTarifa.php">Tarifas</a>
        </li>
        <li>
            <a href="#">Detalle Tarifa</a>
        </li>
    </ul>
</div>
<div class=" row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Detalle Tarifa</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">

                <form class="form-group">
                    <label class="control-label" >Nombre</label>
                    <input type="hidden" class="input-sm" name="idTipoTarifa" id="idTipoTarifa"/>
                    <input type="text" class="input-sm" name="NombreTarifa" id="NombreTarifa"/><br><br>

                    <label class="control-label" >Descripcion</label>
                    <input type="text" class="input-sm"  id="DescripcionTarifa" name="DescripcionTarifa"/><br><br>

                    <label class="control-label" >Fecha Alta</label>
                    <input type="datetime" class="input-sm" name="FechaAlta" id="FechaAlta"/>

                    <label class="control-label" >Fecha Baja</label>
                    <input type="datetime" class="input-sm" name="FechaBaja" id="FechaBaja"/>

                    <input class="box btn-primary " type="button" value="Cancelar" onClick=" window.location.href='TipoTarifa.php' " />
                    <input class="box btn-primary " type="button" value="Aceptar" onclick="TipoTarifa()"/>

                </form>
            </div>
        </div>


    </div>

</div>
<script>
    function obtenerTipoTarifa(idTipoTarifa) {	
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerTipoTarifa";
        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerTipoTarifa";
        var Params = 'idTipoTarifa='+ idTipoTarifa;
        
        //alert(Params);
	
        Ajax.open("POST", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
	
        var RespTxt = Ajax.responseText;	
	
        alert(RespTxt);
	
        var Clase = eval('(' + RespTxt + ')');
        //alert('idTipoTarifa: '+ Clase.tipoTarifa.idTipoTarifa);
        //alert('idSala: '+ Clase.sala.idSala);
        //alert('Nombre: '+ Clase.sala.Nombre);
        //alert('Capacidad: '+ Clase.sala.Capacidad);
        //alert('DescripcionTarifa: '+ Clase.sala.DescripcionTarifa);
	  
        document.getElementById('idTipoTarifa').value=Clase.tipoTarifa.idTipoTarifa;
        document.getElementById('NombreTarifa').value=Clase.tipoTarifa.NombreTarifa;
        document.getElementById('DescripcionTarifa').value=Clase.tipoTarifa.DescripcionTarifa;
        alert(Clase.tipoTarifa.FechaAlta);
        document.getElementById('FechaAlta').value=Clase.tipoTarifa.FechaAlta;
        document.getElementById('FechaBaja').value=Clase.tipoTarifa.FechaBaja;
    }
</script>
<?php

if (isset($_GET['idTipoTarifa'])) {
    $test = $_GET['idTipoTarifa'];
    //echo $test;
    echo '<script>
           var varjs="' . $test . '";
           obtenerTipoTarifa(varjs);
           </script>';
} else {
    $test = '';
}
?>
<?php require('Pie.php'); ?>
