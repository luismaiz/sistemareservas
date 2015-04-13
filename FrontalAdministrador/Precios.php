<?php require('headerReservas.php'); ?>
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
                            <div class="col-md-4">
                                <div>
					<label class="control-label" >Actividad</label>
                                        <input type="text"  id="FiltroPrecioActividad">
                                </div>	
				</div>
                            <div class="col-md-4">
                                <div>
					<label class="control-label" >Tarifa</label>
                                        <input type="text"  id="FiltroPrecioTarifa"></div>	
				</div>
                                <div class="col-md-4">
                                    <div>
					<label class="control-label" >Abono</label>
                                        <input type="text"  id="FiltroPrecioAbono"></div>	
				</div>
                                <div class="col-md-4">
                                    <input class="btn btn-default" type="button" value="Buscar"/>
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
                                <a class="btn btn-info" href="#">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Edit
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
                            <input class="btn btn-default" type="button" value="Añadir" onClick=" window.location.href='file:///C:/Users/Alejandro/Downloads/Proyecto/charisma-master/charisma-master/FormularioNuevaSala.html' "/>
                        </div>
                        
                    </div>
</div>

<?php require('footerReservas.php'); ?>
