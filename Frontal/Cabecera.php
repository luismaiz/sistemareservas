<?php
session_start();
if (!isset($_SESSION['User'])) {
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
        <!--<link id="bs-css" href="Utilidades/css/bootstrap-cerulean.min.css" rel="stylesheet">-->
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
        <script src="Utilidades/js/angular-1.2.9/angular-1.2.9/angular.js" type="text/javascript"></script>
        <!-- jQuery -->
        <script src="Utilidades/bower_components/jquery/jquery.min.js"></script>
        
        <!--<script src="Utilidades/bower_components/jquery/jquery.min.js" type="text/javascript"></script>-->
        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
        <!-- The fav icon -->
        <link rel="shortcut icon" href="Utilidades/img/favicon.ico">

        <script>
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
                            <div class="nav-canvas">
                                <div class="nav-sm nav nav-stacked">

                                </div>
                                <ul class="nav nav-pills nav-stacked main-menu">
                                    <li class="nav-header">Menú Principal</li>
                                    <li><a class="ajax-link" href="Inicio.php"><i class="glyphicon glyphicon-home"></i><span> Inicio</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="Reservas.php"><i class="glyphicon glyphicon-edit"></i><span> Reservas </span></a>
                                    </li>
                                    <li><a class="ajax-link" href="Salas.php"><i  class="glyphicon glyphicon-edit"></i><span> Salas</span></a></li>
                                    <li><a class="ajax-link" href="Actividades.php"><i class="glyphicon glyphicon-edit"></i><span> Actividades</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="TipoSolicitud.php"><i class="glyphicon glyphicon-edit"></i><span> Solicitudes</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="TipoAbono.php"><i class="glyphicon glyphicon-edit"></i><span> Abonos</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="TipoTarifa.php"><i class="glyphicon glyphicon-edit"></i><span> Tarifas</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="Precios.php"><i class="glyphicon glyphicon-edit"></i><span> Precios</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="Informes.php"><i class="glyphicon glyphicon-eye-open"></i><span> Informes</span></a>
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


