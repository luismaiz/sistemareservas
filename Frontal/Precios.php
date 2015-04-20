<?php require('Cabecera.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="#">Precios</a>
        </li>
    </ul>
</div>
<div class=" row">
<div class="box col-md-12">
                        <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Buscador Precios</h2>
                        <div class="box-icon">

                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        
                        </div>
                        </div>
                        <div class="box-content">
                            <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="form-group">
					<label class="control-label" >Actividad</label>
                                    <select id="filtroactividad" class="input-sm" >	
                                        <option>Cardio</option>
                                        <option>Fitness</option>
                                        
                                    </select>
                                        <label class="control-label" >Tipo Abono</label>
                                    <select id="filtrotipoabono" class="input-sm" >	
                                        <option>Abono Diario</option>
                                        <option>Abono Mensual</option>
                                        <option>Clase Dirigida</option>
                                    </select>
                                        <label class="control-label" >Tipo Tarifa</label>
                                    <select id="filtrotipotarifa" class="input-sm" >	
                                        <option>Mayores</option>
                                        <option>Familiar</option>
                                        <option>Adulto</option>
                                    </select>
                                    <input class="box btn-primary" type="button" value="Buscar" onClick="obtenerPrecios()"/>
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
                                    <h2><i class="glyphicon glyphicon-th"></i> Precios </h2>

                                    <div class="box-icon">
                                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                                class="glyphicon glyphicon-chevron-up"></i></a>
                                    </div>
                                </div>
                                <div class="box-content">
                                        <table class="table table-striped table-bordered responsive">
                                            <thead>
                                                <tr>
                                                    <th>Actividad</th>
                                                    <th>Tarifa</th>
                                                    <th>Tipo Abono</th>
                                                    <th>Precio</th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                            <td class="center">Fitness</td>
                            <td class="center">Adulto</td>
                            <td class="center">Mensual</td>
                            <td class="center">30,65</td>
                            <td class="center">
                                <a class="btn btn-info2" href="#">
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
                            <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetallePrecios.php' "/>
                        </div>
                        
                    </div>
</div>

<?php require('Pie.php'); ?>
