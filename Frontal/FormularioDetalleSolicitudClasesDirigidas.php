<?php require('Cabecera.php'); ?>
<script>
           
            var Ajax = new AjaxObj();
                
                    
        </script>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="#">Reservas</a>
        </li>
        <li>
            <a href="#">Detalle Solicitud Clase Dirigida</a>
        </li>
    </ul>
</div>
<div class=" row">
<div class="box col-md-12">
                        <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Datos personales</h2>
                        
                        </div>
                        <div class="box-content">
                            <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="form-group">
                                <label class="control-label" >Nombre</label>
                                <input type="text" class="input-sm"  id="Nombre">
                                
                                <label class="control-label" >Apellidos</label>
                                <input type="text" class="input-sm"  id="Apellidos">
                                
                                <label class="control-label" >DNI</label>
                                <input type="text" class="input-sm" id="dni"></br></br>
                                                                            
                                <label class="control-label" >Fecha Nacimiento</label>
                                <input type="date" class="input-sm" name="FechaNacimiento" id="FechaNacimiento">
                                
                                <label class="control-label" >Fecha Solicitud</label>
                                <input type="date" class="input-sm" name="FechaSolicitud" id="FechaSolicitud">
                                                              
                                    </div>
                                </div>
                            </div>
                                
                            </div>
                        </div>
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Contacto</h2>
                        
                        </div>
                             <div class="box-content">
                            <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" >Direccion</label>
                                <input type="text" class="input-sm"  id="direccion">
                                
                                <label class="control-label" >Localidad</label>
                                <input type="text" class="input-sm"  id="localidad">
                                
                                <label class="control-label" >Provincia</label>
                                <input type="text" class="input-sm" id="provincia">
                                <label class="control-label" >Codigo Postal</label>
                                <input type="text" class="input-sm" id="codigopostal"></br></br>
                                <label class="control-label" >Telefono</label>
                                <input type="tel" class="input-sm"  id="telefono">
                                
                                <label class="control-label" >Email</label>
                                <input type="email" class="input-sm"  id="email">
                                
                                    </div>
                                </div>
                            </div>
                            </div>
                    </div>
                            <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Datos de pago</h2>
                        
                        </div>
                            <div class="box-content">
                            <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" >IBAN</label>
                                        <input type="text" class="input-sm"  id="direccion">
                                
                                <label class="control-label" >Precio Abono</label>
                                <input type="text" disabled="true" class="input-sm"  id="localidad">
                                
                                <label class="control-label" >Total Pagado</label>
                                <input type="text" class="input-sm" id="provincia">
                                    </div>
                                </div>
                                <div class="box col-md-4"></div>
                                <div class="box col-md-4"></div>
                                    <div class="box col-md-4">
                                        <input class="box btn-primary" type="button" value="Cancelar" onClick=" window.location.href='Reservas.php' "/>
                                        <input class="box btn-primary" type="button" value="Aceptar" onclick="crearSala()"/>
                                    </div>
                            </div>
                            </div>
                                
                    </div>
                            
                        </div>
                       
</div>
</div>
<?php require('Pie.php'); ?>
