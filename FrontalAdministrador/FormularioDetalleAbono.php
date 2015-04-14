<?php require('Cabecera.php'); ?>


<script>
           
            var Ajax = new AjaxObj();
                
            
        </script>
        <?php  
if(isset($_GET['idAbono'])) {
    $test = $_GET['idAbono'];
    echo $test;
    echo '<script>
           var varjs="'.$test.'";
           obtenerAbono(varjs);
           </script>';
} else {
    $test = '';
}
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="#">Tipo Abono</a>
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
                                <input type="text" class="input-sm" name="nombreabono" id="NombreAbono"></br></br>
                                
                                <label class="control-label" >Descripcion</label>
                                <input type="text" class="input-sm"  id="DescripcionAbono"></br></br>
                                
                                <label class="control-label" >Fecha Alta</label>
                                <input type="date" class="input-sm" name="FechaAlta" id="FechaAlta">
                                
                                <label class="control-label" >Fecha Baja</label>
                                <input type="date" class="input-sm" name="FechaBaja" id="FechaBaja">
                                      
                                <input class="box btn-primary " type="button" value="Cancelar" onClick=" window.location.href='TipoAbono.php' " />
                                <input class="box btn-primary " type="button" value="Aceptar" onclick="crearAbono()"/>
                               
                            </form>
                        </div>
                        </div>


                        </div>
                       
</div>

<?php require('Pie.php'); ?>
