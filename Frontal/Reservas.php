<?php require('Cabecera.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="#">Reservas</a>
        </li>
    </ul>
</div>
<div class=" row">
<div class="box col-md-12">
                        <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Buscador Reservas</h2>
                        <div class="box-icon">

                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        
                        </div>
                        </div>
                        <div class="box-content">
                            <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" >Localizador</label>
                                    <input type="text" class="input-sm" id="filtrolocalizador">	
                                    <label class="control-label" >Tipo Abono</label>
                                    <select id="filtrotipoabono" class="input-sm" >	
                                        <option>Abono Diario</option>
                                        <option>Abono Mensual</option>
                                        <option>Clase Dirigida</option>
                                    </select>
                                </div>
                                <div class="form-group">
					<label class="control-label" >Nombre</label>
                                        <input type="text" class="input-sm"  id="filtronombre">	
                                        <label class="control-label" >Apellidos</label>
                                        <input type="text" class="input-sm"  id="filtroapellidos">
                                        <label class="control-label" >DNI</label>
                                        <input type="text" class="input-sm" id="filtrodni">
                                        <label class="control-label" >eMail</label>
                                        <input type="email" class="input-sm" id="filtrodni">
                                        <input class="box btn-primary" type="button" value="Buscar"/>
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
                                    <h2><i class="glyphicon glyphicon-th"></i> Reservas </h2>

                                    <div class="box-icon">
                                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                                class="glyphicon glyphicon-chevron-up"></i></a>
                                    </div>
                                </div>
                                <div class="box-content">
                                        <table class="table table-striped table-bordered responsive">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Apellidos</th>
                                                    <th>Fecha Solicitud</th>
                                                    <th>Tipo Tarifa</th>
                                                    <th>Tipo Solicitud</th>
                                                    <th></th>
                                                </tr>
                                                <tr> 
                            <td class="center">Pocholo</td>
                            <td class="center">Martinez Bordiu</td>
                            <td class="center">12/04/2015</td>
                            <td class="center">Adulto</td>
                            <td class="center">Mensual</td>
                            <td class="center">
                                <a class="btn btn-info2" href="FormularioDetalleSolicitudClasesDirigidas.php">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Detalle
                                </a>
                                
                            </td>
                                                <tr>
                                                    <tr> 
                            <td class="center">Pedro</td>
                            <td class="center">Martin Perez</td>
                            <td class="center">06/04/2015</td>
                            <td class="center">Solo Mañana</td>
                            <td class="center">Diario</td>
                            <td class="center">
                                <a class="btn btn-info2" href="FormularioDetalleSolicitudClasesDirigidas.php">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Detalle
                                </a>
                                
                            </td>
                                                <tr>
                                                    
                                                    
                                            </thead>
                                            <tbody>
                                            </tbody>    
                                        </table>            
                                                                    </div>
                            </div>
                            <br>
                        </div>
                        
                    </div>
</div>

<?php require('Pie.php'); ?>
