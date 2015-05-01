<?php require('Cabecera.php'); ?>

<head>

    <meta charset="utf-8">
    <title>Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
    <link id="bs-css" href="Utilidades/css/bootstrap-cerulean.min.css" rel="stylesheet">

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
    <link rel="shortcut icon" href="Utilidades/img/favicon.ico">




    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />


    <meta name="description" content="with draggable and editable events" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="Utilidades/css/bootstrap.min.css" />
    <link rel="stylesheet" href="Utilidades/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="Utilidades/css/jquery-ui.custom.min.css" />
    <link rel="stylesheet" href="Utilidades/css/fullcalendar.min.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />
    <!--<link rel="stylesheet" href="Utilidades/fonts/fonts.googleapis.com" />-->
    

    <!-- ace styles -->
    <!--<link rel="stylesheet" href="Utilidades/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />-->

    <!--[if lte IE 9]>
            <link rel="stylesheet" href="dist/css/ace-part2.min.css" class="ace-main-stylesheet" />
    <![endif]-->

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="dist/css/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="Utilidades/js/ace-extra.min.js"></script>        

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="dist/js/html5shiv.min.js"></script>
    <script src="dist/js/respond.min.js"></script>
    <![endif]-->		




    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script src="Utilidades/js/jquery.min.js"></script>

    <!-- <![endif]-->

    <!--[if IE]>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <![endif]-->

    <!--[if !IE]> -->
    <script type="text/javascript">
        window.jQuery || document.write("<script src='Utilidades/js/jquery.min.js'>"+"<"+"/script>");
    </script>

    <!-- <![endif]-->

    <!--[if IE]>
    <script type="text/javascript">
    window.jQuery || document.write("<script src='jquery1x.min.js'>"+"<"+"/script>");
    </script>
    <![endif]-->
    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='Utilidades/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>
    <script src="Utilidades/js/bootstrap.min.js"></script>

    <!-- page specific plugin scripts -->
    <script src="Utilidades/js/jquery-ui.custom.min.js"></script>
    <script src="Utilidades/js/jquery.ui.touch-punch.min.js"></script>
    <script src="Utilidades/js/moment.min.js"></script>
    <script src="Utilidades/js/fullcalendar.min.js"></script>
    <script src="Utilidades/js/bootbox.min.js"></script>

    <!-- ace scripts -->
    <script src="Utilidades/js/ace-elements.min.js"></script>
    <script src="Utilidades/js/ace.min.js"></script>
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        jQuery(function($) {

            /* initialize the external events
-----------------------------------------------------------------*/
        
            /*$.ajax({
                type: "GET",
                url: "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerActividades",
                data: "{}",
                contentType: "application/json; charset=utf-8",
                dataType: "json",

                success: function(data, textStatus) {
                    var contenido = "<div class='widget-main no-padding'><div id='external-events'>";								  
													
                    var div = document.getElementById("actividades");                      
                    //contenido = contenido + '<form>';                

                    var color = ["grey","success","danger","purple","yellow","pink","info"];

                    for(i=0; i<data.actividades.length; i++){						  
                        contenido = contenido + "<div class='external-event label-" + color[i] + "' data-class='label-" + color[i] + "'><i class='ace-icon fa fa-arrows'></i>";
                        //alert(contenido);
                        contenido = contenido + data.actividades[i].NombreActividad;
                        contenido = contenido + "<input type='hidden' id='idActividad' name='idActividad' value='" + data.actividades[i].idActividad + "'/>";
                        contenido = contenido + "</div>";
                    }
                    contenido = contenido + "<label><input type='checkbox' class='ace ace-checkbox' id='drop-remove' /><span class='lbl'> Remove after drop</span></label>";

                    contenido = contenido + "</div></div>";

                    div.innerHTML = contenido;	
                }
                             
            });*/

            obtenerActividades();             
                

            $('#external-events div.external-event').each(function() {
				
                //alert("crear");

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });
		
            });
            /* initialize the calendar
-----------------------------------------------------------------*/

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();


            var calendar = $('#calendar').fullCalendar({
                //isRTL: true,
                buttonHtml: {
                    prev: '<i class="ace-icon fa fa-chevron-left"></i>',
                    next: '<i class="ace-icon fa fa-chevron-right"></i>'
                },
	
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'agendaWeek,month,agendaDay'
                },
                eventLimit: true, // allow "more" link when too many events
                //businessHours: true, // display business hours
                businessHours:
                    {
                    start: '09:00',
                    end:   '21:00',
                    dow: [ 1, 2, 3, 4, 5]
                },/*,
                {
                        start: '15:00',
                        end:   '21:00',
                        dow: [ 1, 2, 3, 4, 5]
                },
                {
                        start: '09:00',
                        end:   '14:00',
                        dow: [6]
                }]*/
                events: function(start, end, timezone, callback) {
                    var NombreActividad = "";
                    var ColorActividad = "";
                    $.ajax({
                        url: "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerClases",
                        dataType: "json",
                        data: "",
                        success: function(doc) {
                            //alert(doc.clases.length);
                            var events = [];
                            for(i=0; i<doc.clases.length; i++){
                                    
                                $.ajax({
                                    type: "POST",
                                    url: "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerActividad",                            
                                    data: jQuery.param( {idActividad: doc.clases[i].idActividad} ),//JSON.stringify(json),
                                    contentType: "application/x-www-form-urlencoded; charset=utf-8",
                                    dataType: "json",
                                    async: false,

                                    success: function(data, textStatus) {
                                        //alert("NombreActividad: " + data.actividad.NombreActividad);
                                        //alert("NombreActividad: " + data.actividad.Descripcion);
                                        NombreActividad = data.actividad.NombreActividad;
                                        ColorActividad = data.actividad.Descripcion;
                                    },
                                    error: function( jqXHR, textStatus, errorThrown ) {
                                        
                                    }});
                                //alert(doc.clases[i].Dia);
                                //alert((doc.clases[i].HoraInicio).substring(0,2));
                                //alert((doc.clases[i].HoraInicio).substring(3,5));
                                //alert("Nombre" + NombreActividad);
                                //alert("Color" + ColorActividad);
                                //$(doc).find('event').each(function() {                                    
                                //var obj = jQuery.param({ idActividad: (doc.clases[i].idActividad)});
                                events.push({
                                    //title: $(this).attr('title'),
                                    //start: $(this).attr('start'), // will be parsed
                                    //end: $(this).attr('end') // will be parsed
                                    //hay que obtener el nombre de la actividad
                                        
                                    title: doc.clases[i].idActividad + " " + NombreActividad,
                                    //idActividad: doc.clases[i].idActividad,
                                    //start: new Date(y, m, 1, 12, 10),
                                    //end: new Date(y, m, 1, 12, 15),
                                    start: new Date(y, m, doc.clases[i].Dia, (doc.clases[i].HoraInicio).substring(0,2), (doc.clases[i].HoraInicio).substring(3,5)),
                                    end: new Date(y, m, doc.clases[i].Dia, (doc.clases[i].HoraFin).substring(0,2), (doc.clases[i].HoraFin).substring(3,5)),
                                    allDay: false,
                                    //constraint: 'businessHours',
                                    backgroundColor: ColorActividad,//"#00c0ef",
                                    borderColor: ColorActividad//"#00c0ef"
                                })
                                //});
                            }
                            callback(events);
                        }
                    });
                }
                    
                    
                /*events: [
                    $.ajax({
                        type: "GET",
                        url: "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerClases",
                        data: "",
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",

                        success: function(data, textStatus) {
                            //#remove any events that have been loaded
                            //var Clase = JSON.stringify(data);
                            //var Clase = jQuery.parseJSON(data);	
                            //alert(Clase);
                            //$('#calendar').fullCalendar('removeEvents');
                            //alert((data.clases[0].HoraInicio).substring(3,5));
                            alert("length" + data.clases.length);
                            for (i = 0; i < data.clases.length; i++) {
                                    
                                var the_event = {
                                    //console.log(data.clases[i]);                                        
                                    title: (data.clases[i].idActividad),
                                    start: new Date(y, m, d, (data.clases[i].HoraInicio).substring(0,2), (data.clases[i].HoraInicio).substring(3,5)),
                                    end: new Date(y, m, d, (data.clases[i].HoraFin).substring(0,2), (data.clases[i].HoraFin).substring(3,5)),
                                    allDay: false,
                                    backgroundColor: "#00c0ef",
                                    borderColor: "#00c0ef"
                                }
                                alert(the_event.title);
                                $('#calendar').fullCalendar('addEventSource',the_event,true);
                                $('#calendar').fullCalendar('rerenderEvents');
                            }
                        }
                    })*/
                /*
                            jQuery.ajax({
                                    type: "GET",
                                    url: "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerClases",
                                    data: "{}",
                                    contentType: "application/json; charset=utf-8",
                                    dataType: "json",

                                    success: function(data, status, jqXHR) {
                                      //remove any events that have been loaded
                                      alert(jQuery.parseJSON(data));
                                    }
                            })
                 */
                //obtenerClases();
                /*{
                title: 'All Day Event',
                start: new Date(y, m, 14),
                className: 'label-important'
            },
            {
                title: 'Long Event',
                start: moment().subtract(5, 'days').format('YYYY-MM-DD'),
                end: moment().subtract(1, 'days').format('YYYY-MM-DD'),
                className: 'label-success'
            },
            {
                title: 'Some Event',
                start: new Date(y, m, d-3, 16, 0),
                allDay: false,
                className: 'label-info'
            }*/
                //]
                ,
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                eventDrop: function (event, dayDelta, minuteDelta, allDay, revertFunc) {
                    alert(
                    event.title + " was moved " +
                        dayDelta + " days and " +
                        minuteDelta + " minutes."
                );
                },
              
                drop: function(event, delta, revertFunc,date, allDay) { // this function is called when something is dropped
                    alert("borrado");
		
                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');
                    alert("originalEventObject " + originalEventObject);
                    var $extraEventClass = $(this).attr('data-class');
                    alert("$extraEventClass " + $extraEventClass);
			
			
                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);
                    alert("copiedEventObject " + copiedEventObject);
			
                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];
                        
                    alert(date);
                    //var json = {"idActividad": "1", "idSala": "3", "HoraInicio": "10", "HoraFin":"11", "Ocupacion": "20", "Dia": "16", "Publicada": "1"};
                    var json = { idActividad:1, idSala:3, HoraInicio:10, HoraFin:11, Ocupacion:20, Dia:16, Publicada:1 };
                        
                    alert(jQuery.param(json));
                        
                    $.ajax({
                        type: "POST",
                        url: "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=crearClase",                            
                        data: (jQuery.param(json)),//JSON.stringify(json),
                        contentType: "application/x-www-form-urlencoded; charset=utf-8",
                        dataType: "json",
                        
                        success: function(data, textStatus) {
                            alert(data);
                            alert(textStatus);
                            alert(data.success);
                            alert(data.message);
                            alert("actividad guardada");
                        },
                        error: function( jqXHR, textStatus, errorThrown ) {
                            alert(jqXHR);
                            alert(jqXHR.responseText);
                            alert(jqXHR.status);
                            alert(jqXHR.fail);
                            alert(jqXHR.message);
                            alert(textStatus);
                            alert(errorThrown);
                            alert("actividad no guardada");
                        }});
			
                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			
                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                        $.ajax({
                            type: "DELETE",
                            url: "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=borrarClase",
                            data: JSON.stringify({"idClase": "1"}),
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",

                            success: function(data, textStatus) {
                                alert("actividad guardada");
                            }
                             
                        });
                    }
			
                }
                ,
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                        
			
                    bootbox.prompt("New Event Title:", function(title) {
                        alert("crear");
                        if (title !== null) {
                            calendar.fullCalendar('renderEvent',
                            {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay,
                                className: 'label-info'
                            },
                            true // make the event "stick"
                        );
                        }
                    });
			

                    calendar.fullCalendar('unselect');
                }
                ,
                eventClick: function(calEvent, jsEvent, view) {
                    alert("actualizar");
                    //display a modal
                    var modal = 
                        '<div class="modal fade">\
              <div class="modal-dialog">\
               <div class="modal-content">\
                     <div class="modal-body">\
                       <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
                       <form class="no-margin">\
                              <label>Change event name &nbsp;</label>\
                              <input class="middle" autocomplete="off" type="text" value="' + calEvent.title + '" />\
                             <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Save</button>\
                       </form>\
                     </div>\
                     <div class="modal-footer">\
                            <button type="button" class="btn btn-sm btn-danger" data-action="delete"><i class="ace-icon fa fa-trash-o"></i> Delete Event</button>\
                            <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>\
                     </div>\
              </div>\
             </div>\
            </div>';
		
		
                                              var modal = $(modal).appendTo('body');
                                              modal.find('form').on('submit', function(ev){
                                                  ev.preventDefault();

                                                  calEvent.title = $(this).find("input[type=text]").val();
                                                  calendar.fullCalendar('updateEvent', calEvent);
                                                  modal.modal("hide");
                                              });
                                              modal.find('button[data-action=delete]').on('click', function() {
                                                  calendar.fullCalendar('removeEvents' , function(ev){
                                                      return (ev._id == calEvent._id);
                                                  })
                                                  modal.modal("hide");
                                              });
			
                                              modal.modal('show').on('hidden', function(){
                                                  modal.remove();
                                              });


                                              //console.log(calEvent.id);
                                              //console.log(jsEvent);
                                              //console.log(view);

                                              // change the border color just for fun
                                              //$(this).css('border-color', 'red');

                                          }
		
                                      });


                                  })

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
			
                                  var Ajax = new AjaxObj();
		
                                  function obtenerActividades(){		
                                      var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerActividades";
                                      //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerSalas";
                                      var Params = '';

	
                                      Ajax.open("GET", Url, false);
                                      Ajax.setRequestHeader("Content-Type","application/json");
                                      Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");                
                                      Ajax.send(Params); // Enviamos los datos

                                      var RespTxt = Ajax.responseText;
			
                                      //alert(RespTxt);
	
                                      var Clase = eval('(' + RespTxt + ')');	
                                      //alert(Clase);
                                      var contenido = "<div class='widget-main no-padding'><div id='external-events'>";
								  
													
                                      var div = document.getElementById("actividades");                      
                                      //contenido = contenido + '<form>';                
			
                                      var color = ["grey","success","danger","purple","yellow","pink","info"];
        
                                      for(i=0; i<Clase.actividades.length; i++){						  
                                          contenido = contenido + "<div class='external-event label-" + color[i] + "' data-class='label-" + color[i] + "'><i class='ace-icon fa fa-arrows'></i>";
                                          //alert(contenido);
                                          contenido = contenido + Clase.actividades[i].NombreActividad;
                                          contenido = contenido + "<input type='hidden' id='idActividad' name='idActividad' value='" + Clase.actividades[i].idActividad + "'/>";
                                          contenido = contenido + "</div>";
                                      }
                                      contenido = contenido + "<label><input type='checkbox' class='ace ace-checkbox' id='drop-remove' /><span class='lbl'> Remove after drop</span></label>";
			
                                      contenido = contenido + "</div></div>";

                                      div.innerHTML = contenido;	
                                  }		
							  
                                  /*function obtenerClases(){		
                              var Url = "http://www.rightwatch.es/pfgreservas/AdministradorBO.php?url=obtenerClases";
                              //var Url = "http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/AdministradorBO.php?url=obtenerSalas";
                              var Params = '';

	
                              Ajax.open("GET", Url, false);
                              Ajax.setRequestHeader("Content-Type","application/json");
                              Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");                
                              Ajax.send(Params); // Enviamos los datos

                              var RespTxt = Ajax.responseText;
			
                              //alert(RespTxt);
	
                              var Clase = eval('(' + RespTxt + ')');	
	
                              //alert(Clase);

                                                                    var contenido = '';
                                  
        
                              for(i=0; i<Clase.clases.length; i++){
                                                                      contenido = contenido + '{title: ';
                                                                      contenido = contenido + Clase.clases[i].idActividad;
                                                                      contenido = contenido + ', start: new Date(y,m,' + Clase.clases[i].Dia + ',' + Clase.clases[i].HoraInicio + ',' + Clase.clases[i].HoraFin + '), allDay: false, className:"label-info"}';
                              }                                  
								  
                                                              //return '{title: 'Some Event', start: new Date(y, m, d-3, 16, 0), allDay: false, className: 'label-info'}';
								  
                                                              return contenido;
                          }	*/	             
            
    </script>


</head>

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-sm-9">
                <div class="space"></div>

                <div id="calendar"></div>
            </div>

            <div class="col-sm-3">
                <div class="widget-box transparent">
                    <div class="widget-header">
                        <h4>Draggable events</h4>
                    </div>

                    <div class="widget-body" id="actividades">												
                    </div>
                </div>
            </div>
        </div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->
<?php require('Pie.php'); ?>