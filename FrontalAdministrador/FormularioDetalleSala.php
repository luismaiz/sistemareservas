<?php require('Cabecera.php'); ?>


<script>
           
            var Ajax = new AjaxObj();
            
            function Sala(){      
                //alert(document.getElementById("idSala"));
                if(document.getElementById("idSala").value == "")
                    crearSala();
                else
                    actualizarSala();
            }
            
            function crearSala() {
                //alert("crear");
                var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=crearSala";		
                var Params ='&NombreSala='+ document.getElementById('NombreSala').value +
                    '&CapacidadSala='+ document.getElementById('CapacidadSala').value +
                    '&DescripcionSala='+ document.getElementById('DescripcionSala').value +
                    '&FechaAlta='+ document.getElementById('FechaAlta').value +
                    '&FechaBaja='+ document.getElementById('FechaBaja').value;

                //alert(Params);
	
	
                Ajax.open("POST", Url, true);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                mostrarRespuesta(Ajax.responseText);
            }

            function actualizarSala() {
                //alert("actualizar");
                var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=actualizarSala";
                var Params = 'idSala='+ document.getElementById('idSala').value +
                    '&NombreSala='+ document.getElementById('NombreSala').value +
                    '&CapacidadSala='+ document.getElementById('CapacidadSala').value +
                    '&DescripcionSala='+ document.getElementById('DescripcionSala').value +
                    '&FechaAlta='+ document.getElementById('FechaAlta').value +
                    '&FechaBaja='+ document.getElementById('FechaBaja').value;

                //alert(Params);
                
                Ajax.open("PUT", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                mostrarRespuesta(Ajax.responseText);
            }

            function borrarSala() {
                var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=borrarSala";
                var Params = 'idSala='+ document.getElementById('idSala').value;

	
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
                                <input value = "" type="hidden" class="input-sm" name="idSala" id="idSala">
                                <label class="control-label" >Nombre</label>
                                <input value = "" type="text" class="input-sm" name="nombresala" id="NombreSala"></br></br>
                                
                                <label class="control-label" >Descripcion</label>
                                <input type="text" class="input-sm"  id="DescripcionSala"></br></br>
                                
                                <label class="control-label" >Capacidad</label>
                                <input type="text" class="input-sm" id="CapacidadSala"></br></br>
                                            
                                <label class="control-label" >Fecha Alta</label>
                                <input type="date" class="input-sm" name="FechaAlta" id="FechaAlta">
                                
                                <label class="control-label" >Fecha Baja</label>
                                <input type="date" class="input-sm" name="FechaBaja" id="FechaBaja">
                                      
                                <input class="box btn-primary " type="button" value="Cancelar" onClick=" window.location.href='Salas.php' " />
                                <input class="box btn-primary " type="button" value="Aceptar" onclick="Sala()"/>
                               
                            </form>
                        </div>
                        </div>


                        </div>
                       
</div>
        <script>
            function obtenerSala(idSala) {
//                alert(idSala);
                
                var Url = "http://pfgreservas.rightwatch.es//Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerSala";
                var Params = 'idSala='+ idSala;

	
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
	
                var RespTxt = Ajax.responseText;
	
//                alert("Resultado:" + RespTxt);
	
                //alert(eval('(' + RespTxt + ')'));
                //alert("Prueba: " + $.parseJSON(RespTxt));
                //var Clase = eval('(' + RespTxt + ')');
                var Clase = eval('(' + RespTxt + ')');	
	
                //eval('(' + RespTxt + ')');
//                alert(Clase);
//                alert('Estado: '+ Clase.estado);
//                alert('idSala: '+ Clase.sala.idSala);
//                alert('NombreSala: '+ Clase.sala.NombreSala);
//                alert('CapacidadSala: '+ Clase.sala.CapacidadSala);
//                alert('DescripcionSala: '+ Clase.sala.DescripcionSala);
                
                document.getElementById('idSala').value= Clase.sala.idSala;
                document.getElementById('NombreSala').value= Clase.sala.NombreSala;
                document.getElementById('CapacidadSala').value= Clase.sala.CapacidadSala;
                document.getElementById('DescripcionSala').value= Clase.sala.DescripcionSala;
                document.getElementById('FechaAlta').value= Clase.sala.FechaAlta;
                document.getElementById('FechaBaja').value= Clase.sala.FechaBaja;                
            }
                         
        </script>
 <?php  
if(isset($_GET['idSala'])) {
    $test = $_GET['idSala'];
    echo '<script>
           var varjs="'.$test.'";
           obtenerSala(varjs);
           </script>';
} else {
    $test = '';
}
?>        
        
<?php require('Pie.php'); ?>
