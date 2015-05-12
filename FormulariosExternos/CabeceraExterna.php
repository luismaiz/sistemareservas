<?php ?>
<html lang="es-es"><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Solicitud</title>
        <link rel="shortcut icon" href="../Frontal/Utilidades/img/favicon.ico">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="../Frontal/Utilidades/bower_components/jquery/jquery.min.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="media/jui/js/jquery.min.js" type="text/javascript"></script>
        <script src="media/jui/js/jquery-noconflict.js" type="text/javascript"></script>
        <script src="media/jui/js/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="media/jui/js/bootstrap.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="templates/yoo_subway/css/bootstrap.min.css">
        <link rel="stylesheet" href="templates/yoo_subway/css/tools.css">
        <link rel="stylesheet" href="templates/yoo_subway/css/animations.css">
        <link rel="stylesheet" href="templates/yoo_subway/css/background/gradientblue.css">
        <link rel="stylesheet" href="templates/yoo_subway/css/font2/opensanslight.css">
        <link rel="stylesheet" href="templates/yoo_subway/css/font3/opensanslight.css">
        <link rel="stylesheet" href="templates/yoo_subway/css/style.css">
        <link rel="stylesheet" href="templates/yoo_subway/fonts/opensanslight.css">
        <script src="templates/yoo_subway/warp/js/warp.js"></script>
        <link href="../Frontal/Utilidades/css/Angular.css" rel="stylesheet" type="text/css"/>
        <script src="../Frontal/Utilidades/js/angular-1.2.9/angular-1.2.9/angular.js" type="text/javascript"></script>
    </head>
    <body id="page" class="page  noblog  transparency-25 system-transparent">
        <div id="page-body">
            <div class="wrapper">
                <header id="header">
                    <div id="headerbar" class=" headerbar col-lg-offset-1 col-md-offset-1 col-sm-offet-1">
                        <a id="logo" href="http://www.centrodeportivom86.es">
                            <h1><img src="images/logo.png" alt="" width="186" height="98" border="0"></h1></a>
                    </div>
                </header>
                <script>
                    var BASE_URL = 'http://localhost/';
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

                            if (!xmlhttp && typeof XMLHttpRequest !== 'undefined')
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

             /*       function DrawCaptcha()
                    {
                        var a = Math.ceil(Math.random() * 6) + '';
                        var b = Math.ceil(Math.random() * 6) + '';
                        var c = Math.ceil(Math.random() * 6) + '';
                        var d = Math.ceil(Math.random() * 6) + '';
                        var e = Math.ceil(Math.random() * 6) + '';
                        var f = Math.ceil(Math.random() * 6) + '';
                        var g = Math.ceil(Math.random() * 6) + '';
                        var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' ' + f;
                        document.getElementById("txtCaptcha").value = code;
                    }*/
                </script>
