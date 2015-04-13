<?php require('headerReservas.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        
    </ul>
</div>
<div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="6 new members." class="well top-block" href="#">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Total Members</div>
            <div>507</div>
            <span class="notification">6</span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="4 new pro members." class="well top-block" href="#">
            <i class="glyphicon glyphicon-star green"></i>

            <div>Pro Members</div>
            <div>228</div>
            <span class="notification green">4</span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="$34 new sales." class="well top-block" href="#">
            <i class="glyphicon glyphicon-shopping-cart yellow"></i>

            <div>Sales</div>
            <div>$13320</div>
            <span class="notification yellow">$34</span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="12 new messages." class="well top-block" href="#">
            <i class="glyphicon glyphicon-envelope red"></i>

            <div>Messages</div>
            <div>25</div>
            <span class="notification red">12</span>
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
        </div>
    </div>
    <!--/span-->    
</div><!--/row-->
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list-alt"></i> Pie</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    
                </div>
            </div>
            <div class="box-content">
                <div id="piechart" style="height:300px"></div>
            </div>
        </div>
    </div>
</div><!--/row-->
<?php require('footerReservas.php'); ?>
