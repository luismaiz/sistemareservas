<?php require('Cabecera.php'); ?>


<script>
           
    var Ajax = new AjaxObj();
    
    function Usuario(){        
        if(document.getElementById("idUsuario").value == "")
            crearUsuario();
        else
            actualizarUsuario();        
    }
    
    function crearUsuario() {
        alert("crear");
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=crearUsuario";		
        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearPrecio";
        
        var Params = 'NombreUsuario='+ document.getElementById('NombreUsuario').value +
            '&Password='+ document.getElementById('Password').value +
            '&TipoUsuario='+ document.getElementById('TipoUsuario').value;

	
        Ajax.open("POST", Url, false);
        Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
        Ajax.send(Params); // Enviamos los datos
        
        mostrarRespuesta(Ajax.responseText);
    }

    function actualizarUsuario() {
        alert("actualizar");
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=actualizarUsuario";
        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=actualizarPrecio";
        
        var Params = 'idUsuario='+ document.getElementById('idUsuario').value +
            'NombreUsuario='+ document.getElementById('NombreUsuario').value +
            '&Password='+ document.getElementById('Password').value +
            '&TipoUsuario='+ document.getElementById('TipoUsuario').value;

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
            <a href="Usuarios.php">Usuarios</a>
        </li>
        <li>
            <a href="#">Detalle Usuario</a>
        </li>
    </ul>
</div>
<div class=" row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Detalle Usuario</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">

                <form class="form-group">
                    <label class="control-label" >NombreUsuario</label>
                    <input type="hidden" value="" class="input-sm" name="idUsuario" id="idUsuario">
                    <input type="text" class="input-sm" name="NombreUsuario" id="NombreUsuario"></br></br>

                    <label class="control-label" >Password</label>                    
                    <input type="password" class="input-sm" name="Password" id="Password"></br></br>

                    <label class="control-label" >TipoUsuario</label>                    
                    <input type="text" class="input-sm" name="TipoUsuario" id="TipoUsuario">
                    
                    <label class="control-label" >FechaAlta</label>
                    <input type="datetime" class="input-sm" name="FechaAlta" id="FechaAlta">
                    
                    <label class="control-label" >FechaBaja</label>
                    <input type="datetime" class="input-sm" name="FechaBaja" id="FechaBaja"></br></br>

                    <input class="box btn-primary " type="button" value="Cancelar" onClick=" window.location.href='Usuarios.php' " />
                    <input class="box btn-primary " type="button" value="Aceptar" onclick="Usuario()"/>

                </form>
            </div>
        </div>


    </div>

</div>

<script>
    function obtenerUsuario(idUsuario) {	
        var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerUsuario";
        //var Url = "http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerPrecio";
        var Params = 'idUsuario='+ idUsuario;

	
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
	  
        document.getElementById('idUsuario').value=Clase.usuario.idUsuario;	  
        document.getElementById('NombreUsuario').value=Clase.usuario.NombreUsuario;	  
        document.getElementById('Password').value=Clase.usuario.Password;	  
        document.getElementById('TipoUsuario').value=Clase.usuario.TipoUsuario;	  
        document.getElementById('FechaAlta').value=Clase.usuario.FechaAlta;
        document.getElementById('FechaBaja').value=Clase.usuario.FechaBaja;
    }    
</script>
<?php
if (isset($_GET['idUsuario'])) {
    $test = $_GET['idUsuario'];
    echo '<script>
           var varjs="' . $test . '";
           obtenerUsuario(varjs);
           </script>';
} else {
    $test = '';
}
?>
<?php require('Pie.php'); ?>
