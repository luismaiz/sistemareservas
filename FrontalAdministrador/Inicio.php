<?php require('Cabecera.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        
    </ul>
</div>
<div class=" row">
   <div class="col-md-4 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="3 nuevas solicitudes." class="well top-block" href="Reservas.php">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Abonos diarios</div>
            <div>7</div>
            <span class="notification">7</span>
        </a>
    </div>
    <div class="col-md-4 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="14 nuevas solicitudes." class="well top-block" href="Reservas.php">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Clase Dirigidas</div>
            <div>14</div>
            <span class="notification">14</span>
        </a>
    </div>

    <div class="col-md-4 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="28 nuevas solicitudes." class="well top-block" href="Reservas.php">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Abonos mensuales</div>
            <div>28</div>
            <span class="notification">28</span>
        </a>
    </div>
</div>

<div class="row">
    
</div>

<div class="row">

</div><!--/row-->

<div class="row">
   
   
    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list"></i> Estadistica semanal</h2>

                <div class="box-icon">
                     <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <ul class="dashboard-list">
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-arrow-up"></i>
                            <span class="green">92</span>
                            Abonos mensuales
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-arrow-down"></i>
                            <span class="red">15</span>
                            Clases Dirigidas
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-minus"></i>
                            <span class="red">15</span>
                            Abono diario
                        </a>
                    </li>
                </ul>
            </div>
            <div id="piechart" style="height:300px"></div>
        </div>
    </div>
    <!--/span-->
    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list"></i> Estadistica mensual</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <ul class="dashboard-list">
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-arrow-up"></i>
                            <span class="green">536</span>
                            Abonos diarios
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-arrow-down"></i>
                            <span class="red">450</span>
                            Reservas clases Dirigidas
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-minus"></i>
                            <span class="blue">360</span>
                            Abono mensual
                        </a>
                    </li>
                    
                </ul>
            </div>
            <div id="donutchart" style="height: 300px;">
        </div>
    </div>
    <!--/span-->    
</div><!--/row-->


<!-- chart libraries start -->
<!--<script src="bower_components/flot/excanvas.min.js"></script>-->
<script src="bower_components/flot/jquery.flot.js"></script>
<script src="bower_components/flot/jquery.flot.pie.js"></script>
<!--<script src="bower_components/flot/jquery.flot.stack.js"></script>-->
<!--<script src="bower_components/flot/jquery.flot.resize.js"></script>-->
<!-- chart libraries end -->
<script src="js/init-chart.js"></script>
<?php require('Pie.php'); ?>
