<?php
session_start();
if (!isset($_SESSION['User'])) {
    echo($_SESSION['User']);
    header("location: ../index.php");
}
include 'config.php'
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Sistema de Reservas</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">


        <!-- The styles -->
        
        <link href="Utilidades/css/bootstrap-cerulean.min.css" rel="stylesheet" type="text/css"/>
        <link href="Utilidades/css/charisma-app.css" rel="stylesheet">
        <link href='Utilidades/bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
        <link href='Utilidades/bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
        <link href='Utilidades/bower_components/chosen/chosen.min.css' rel='stylesheet'>
        <link href='Utilidades/bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
        <link href='Utilidades/bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
        <link href='Utilidades/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
        <link href='Utilidades/css/jquery.noty.css' rel='stylesheet'>
        <link href='Utilidades/css/noty_theme_default.css' rel='stylesheet'>
        
        <link href='Utilidades/css/elfinder.min.css' rel='stylesheet'>
        <link href='Utilidades/css/elfinder.theme.css' rel='stylesheet'>
        <link href='Utilidades/css/jquery.iphone.toggle.css' rel='stylesheet'>
        <link href='Utilidades/css/uploadify.css' rel='stylesheet'>
        <link href='Utilidades/css/animate.min.css' rel='stylesheet'>
        <link href="Utilidades/css/Angular.css" rel="stylesheet" type="text/css"/>
        <link href="Utilidades/FooTable-2/css/footable.core.css" rel="stylesheet" type="text/css"/>
        <link href="Utilidades/FooTable-2/css/footable.metro.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
                
		<!-- The fav icon -->
        <link rel="shortcut icon" href="Utilidades/img/favicon.ico">
        
        <script src="Utilidades/js/angular-1.2.9/angular-1.2.9/angular.js" type="text/javascript"></script>
        <!-- jQuery -->
        <script src="Utilidades/bower_components/jquery/jquery.min.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="Utilidades/js/jscolor/jscolor.js" type="text/javascript"></script>
        <script src="Utilidades/FooTable-2/js/footable.js" type="text/javascript"></script>
        <script src="Utilidades/FooTable-2/js/footable.sort.js" type="text/javascript"></script>
        <script src="Utilidades/FooTable-2/js/footable.paginate.js" type="text/javascript"></script>
        <script src="Utilidades/js/angular-1.2.9/angular-1.2.9/ngStorage.min.js" type="text/javascript"></script>

		        
        
        <!-- Calendario -->
       <link rel="stylesheet" href="Utilidades/calendario/css/font-awesome.min.css" />
	    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />
		 <!-- ace styles -->
        <!--<link rel="stylesheet" href="Utilidades/calendario/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />-->
        <link rel="stylesheet" type="text/css" href="Utilidades/calendario/css/jquery.datetimepicker.css"/>
        <script src="Utilidades/calendario/js/jquery.datetimepicker.js" type="text/javascript"></script>
        
        <script>
            var BASE_URL = 'http://vw15115.dinaserver.com/hosting/reservascentro.es-web/';
            //var BASE_URL = 'http://localhost:8080/';
        function AjaxObj()
        {
            var xmlhttp = null;

            if (window.XMLHttpRequest)
            {
                xmlhttp = new XMLHttpRequest();

                if (xmlhttp.overrideMimeType)
                {
                    xmlhttp.overrideMimeType('text/xml');
                }
            }
            else if (window.ActiveXObject)
            {
                // Internet Explorer    
                try
                {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch (e)
                {
                    try
                    {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    catch (e)
                    {
                        xmlhttp = null;
                    }
                }

                if (!xmlhttp && typeof XMLHttpRequest != 'undefined')
                {
                    xmlhttp = new XMLHttpRequest();

                    if (!xmlhttp)
                    {
                        failed = true;
                    }
                }
            }
            return xmlhttp;
        }
                

    </script>
    </head>
    
    <body>

            <!-- topbar starts -->
            <div class="navbar navbar-default" role="navigation">
                <div class="navbar-inner">
                    <button type="button" class="navbar-toggle pull-left animated flip">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="Inicio.php"> <img alt="FMN Logo" src="Utilidades/img/FMN.jpg" class="hidden-xs"/>
                        <span >M-86</span></a>

                    <!-- user dropdown starts -->
                    <div class="btn-group pull-right">
                        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"><?php echo ' '.$_SESSION['User']; ?></span>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="CerrarSesion.php">Cerrar sesion</a></li>
                        </ul>
                    </div>
                    <!-- user dropdown ends -->
                    <!-- user dropdown ends -->

           
                </div>
            </div>
            <!-- topbar ends -->

        <div class="ch-container">
            <div class="row">
                    <!-- left menu starts -->
                    <div class="col-sm-2 col-lg-2">
                        <div class="sidebar-nav">
                            <div class="nav-canvas" id="menuadministrador" <?php if(($_SESSION["User"])=="administrador"){ echo ' style="display: block;"'; } else { echo ' style="display: none;"'; } ?>>
                                <div class="nav-sm nav nav-stacked">

                                </div>
                                <ul class="nav nav-pills nav-stacked main-menu">
                                    <li class="nav-header">Menú Principal</li>
                                    <li><a class="ajax-link" href="Inicio.php"><i class="glyphicon glyphicon-home"></i><span> Inicio</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="Reservas.php"><i class="glyphicon glyphicon-edit"></i><span> Reservas </span></a>
                                    </li>
									<li><a class="ajax-link" href="InicioMonitor.php"><i class="glyphicon glyphicon-edit"></i><span> Clases</span></a>
                                    </li>
									<li class="accordion">
										<a href="#"><i class="glyphicon glyphicon-plus"></i><span> Mantenimiento</span></a>
											<ul class="nav nav-pills nav-stacked">
											<li><a class="ajax-link" href="Salas.php"><i  class="glyphicon glyphicon-edit"></i><span> Salas</span></a></li>
											<li><a class="ajax-link" href="Actividades.php"><i class="glyphicon glyphicon-edit"></i><span> Actividades</span></a></li>
											<li><a class="ajax-link" href="TipoSolicitud.php"><i class="glyphicon glyphicon-edit"></i><span> Tipo Solicitud</span></a></li>
											<li><a class="ajax-link" href="TipoAbono.php"><i class="glyphicon glyphicon-edit"></i><span> Tipo Abono</span></a></li>
											<li><a class="ajax-link" href="TipoTarifa.php"><i class="glyphicon glyphicon-edit"></i><span> Tipo Tarifa</span></a></li>
											<li><a class="ajax-link" href="Precios.php"><i class="glyphicon glyphicon-edit"></i><span> Precios</span></a></li>
											</ul>
									</li>
                                    <li><a class="ajax-link" href="Informes.php"><i class="glyphicon glyphicon-eye-open"></i><span> Informes</span></a>
                                    </li>
                                </ul>
                            </div>
                            
                            
                            <div class="nav-canvas" id="menugestor" <?php if(($_SESSION["User"])=="gestor"){ echo ' style="display: block;"'; }else { echo ' style="display: none;"'; } ?>>
                                <div class="nav-sm nav nav-stacked">

                                </div>
                                <ul class="nav nav-pills nav-stacked main-menu">
                                    <li class="nav-header">Menú Principal</li>
                                    <li><a class="ajax-link" href="Inicio.php"><i class="glyphicon glyphicon-home"></i><span> Inicio</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="Reservas.php"><i class="glyphicon glyphicon-edit"></i><span> Reservas </span></a>
                                    </li>
									<li class="accordion">
										<a href="#"><i class="glyphicon glyphicon-plus"></i><span> Mantenimiento</span></a>
											<ul class="nav nav-pills nav-stacked">
											<li><a class="ajax-link" href="Salas.php"><i  class="glyphicon glyphicon-edit"></i><span> Salas</span></a></li>
											<li><a class="ajax-link" href="Actividades.php"><i class="glyphicon glyphicon-edit"></i><span> Actividades</span></a></li>
											<li><a class="ajax-link" href="TipoSolicitud.php"><i class="glyphicon glyphicon-edit"></i><span> Tipo Solicitud</span></a></li>
											<li><a class="ajax-link" href="TipoAbono.php"><i class="glyphicon glyphicon-edit"></i><span> Tipo Abono</span></a></li>
											<li><a class="ajax-link" href="TipoTarifa.php"><i class="glyphicon glyphicon-edit"></i><span> Tipo Tarifa</span></a></li>
											<li><a class="ajax-link" href="Precios.php"><i class="glyphicon glyphicon-edit"></i><span> Precios</span></a></li>
											</ul>
									</li>
                                    <li><a class="ajax-link" href="Informes.php"><i class="glyphicon glyphicon-eye-open"></i><span> Informes</span></a>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="nav-canvas" id="menumonitor" <?php if(($_SESSION["User"])=="monitor"){ echo ' style="display: block;"'; } else { echo ' style="display: none;"'; } ?>>
                                <div class="nav-sm nav nav-stacked">

                                </div>
                                <ul class="nav nav-pills nav-stacked main-menu">
                                    <li class="nav-header">Menú Principal</li>
                                    <li><a class="ajax-link" href="Inicio.php"><i class="glyphicon glyphicon-home"></i><span> Inicio</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="Clases.php"><i class="glyphicon glyphicon-edit"></i><span> Clases</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <!-- left menu ends -->
                    <noscript>
                    <div class="alert alert-block col-md-12">
                        <h4 class="alert-heading">Warning!</h4>
                    </div>
                    </noscript>

                    <div id="content" class="col-lg-10 col-sm-10">
                        <!-- content starts -->


