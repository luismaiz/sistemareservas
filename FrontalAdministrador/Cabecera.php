<?php include 'config.php' ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Sistema de Reservas</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">


        <!-- The styles -->
        <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">

        <link href="css/charisma-app.css" rel="stylesheet">
        <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
        <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
        <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
        <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
        <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
        <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
        <link href='css/jquery.noty.css' rel='stylesheet'>
        <link href='css/noty_theme_default.css' rel='stylesheet'>
        <link href='css/elfinder.min.css' rel='stylesheet'>
        <link href='css/elfinder.theme.css' rel='stylesheet'>
        <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
        <link href='css/uploadify.css' rel='stylesheet'>
        <link href='css/animate.min.css' rel='stylesheet'>

        <!-- jQuery -->
        <script src="bower_components/jquery/jquery.min.js"></script>

        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- The fav icon -->
        <link rel="shortcut icon" href="img/favicon.ico">
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
	
                    if (!xmlhttp && typeof XMLHttpRequest!='undefined')
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
            
            function mostrarRespuesta(json){
                var Clase = eval('(' + json + ')');                
                alert(Clase.msg);
                
            }

        </script>
    </head>
    <body>
        <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
            <!-- topbar starts -->
            <div class="navbar navbar-default" role="navigation">

                <div class="navbar-inner">

                    <a class="navbar-brand" href="Inicio.php"> <img alt="FMN Logo" src="img/FMN.jpg" class="hidden-xs"/>
                        <span >M-86</span></a>                    

                    <!-- user dropdown starts -->
                    <div class="btn-group pull-right">
                        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> administrador</span>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="login.php">Cerrar sesion</a></li>
                        </ul>
                    </div>
                    <!-- user dropdown ends -->
                </div>
            </div>
            <!-- topbar ends -->
        <?php } ?>
        <div class="ch-container">
            <div class="row">
                <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>

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
                                    <li><a class="ajax-link" href="TipoAbono.php"><i class="glyphicon glyphicon-edit"></i><span> Abonos</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="TipoTarifa.php"><i class="glyphicon glyphicon-edit"></i><span> Tarifas</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="TipoSolicitud.php"><i class="glyphicon glyphicon-edit"></i><span> Tipo Solicitud</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="Precios.php"><i class="glyphicon glyphicon-edit"></i><span> Precios</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="Usuarios.php"><i class="glyphicon glyphicon-edit"></i><span> Usuarios</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="Informes.php"><i class="glyphicon glyphicon-eye-open"></i><span> Informe</span></a>
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
                    <?php } ?>
