<?php require('Cabecera.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="#">Tipo de Tarifa</a>
        </li>
    </ul>
</div>
<div class=" row">
<div class="box col-md-12">
                        <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Buscador Tipos de Tarifa</h2>
                        <div class="box-icon">

                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        
                        </div>
                        </div>
                        <div class="box-content">
                            <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="form-group">
					<label class="control-label" >Tipos de Tarifa</label>
                                         <input type="text"  id="IntensidadActividad">	
				        <input class="box btn-primary" type="button" value="Buscar"/>
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
                                    <h2><i class="glyphicon glyphicon-th"></i> Tipos de tarifa </h2>

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
                                                    <th>Descripcion</th>
                                                    <th>Intensidad</th>
                                                    <th>Grupo</th>
                                                    <th>EdadMinima</th>
                                                    <th>EdadMaxima</th>
                                                    <th></th>
                                                </tr>
                                                <tr> 
                            <td class="center">Fitness</td>
                            <td class="center">Fitness</td>
                            <td class="center">Alta</td>
                            <td class="center">Mañana</td>
                            <td class="center">18</td>
                            <td class="center">65</td>
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
                            <input class="box btn-primary" type="button" value="Añadir" onClick=" window.location.href='FormularioDetalleTarifa.php' "/>
                        </div>
                        
                    </div>
</div>

<?php require('Pie.php'); ?>
