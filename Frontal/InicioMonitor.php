<!--?php require('Cabecera.php'); ?>-->

<head>

    <meta charset="utf-8">
    <title>Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="Utilidades/css/bootstrap.min.css" />
    <link rel="stylesheet" href="Utilidades/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="Utilidades/css/jquery-ui.custom.min.css" />
    <link rel="stylesheet" href="Utilidades/css/fullcalendar.min.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

    <!-- ace styles -->
    <link rel="stylesheet" href="Utilidades/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

    <!-- The fav icon -->
    <link rel="shortcut icon" href="Utilidades/img/favicon.ico">

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
    
    
    <!--<link rel="stylesheet" href="Utilidades/css/jquery-ui.css" />
    <link rel="stylesheet" href="Utilidades/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="Utilidades/css/jquery-ui.structure.css" />
    <link rel="stylesheet" href="Utilidades/css/jquery-ui.structure.min.css" />
    <script src="Utilidades/js/jquery.js"></script>
    <script src="Utilidades/js/jquery-ui.js"></script>
    <script src="Utilidades/js/jquery-ui.min.js"></script>    -->

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        jQuery(function($) {

            /* initialize the external events
-----------------------------------------------------------------*/
        
            /*$.ajax({
                type: "GET",
                url: "../Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividades",
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
                defaultView: 'agendaWeek',
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                businessHours: true, // display business hours
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
                        url: "../Negocio/NegocioAdministrador/ClasesBO.php?url=obtenerClases",
                        dataType: "json",
                        data: "",
                        success: function(doc) {
                            //alert(doc.clases.length);
                            var events = [];
                            for(i=0; i<doc.clases.length; i++){
                                    
                                $.ajax({
                                    type: "POST",
                                    url: "../Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividad",                            
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
                                        
                                    title: NombreActividad,
                                    idClase: doc.clases[i].idClase,
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
                        url: "../Negocio/NegocioAdministrador/ClasesBO.php?url=obtenerClases",
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
                            //alert("length" + data.clases.length);
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
                                //alert(the_event.title);
                                $('#calendar').fullCalendar('addEventSource',the_event,true);
                                $('#calendar').fullCalendar('rerenderEvents');
                            }
                        }
                    })*/
                /*
                            jQuery.ajax({
                                    type: "GET",
                                    url: "../Negocio/NegocioAdministrador/ClasesBO.php?url=obtenerClases",
                                    data: "{}",
                                    contentType: "application/json; charset=utf-8",
                                    dataType: "json",

                                    success: function(data, status, jqXHR) {
                                      //remove any events that have been loaded
                                      //alert(jQuery.parseJSON(data));
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
                /*eventRender: function (event, element, view) {
                        //alert("eventRender");
                         var $idClase = $(this).attr('idClase');
                         //alert("idClase "+ $idClase);                         
                    },*/
              
                drop: function(event, delta, revertFunc,date, allDay) { // this function is called when something is dropped
                    //alert("borrado");
		
                    // retrieve the dropped element's stored Event Object
                    var $color = $(this).attr('color');
                    //alert("idActividad "+ $idActividad);
                        
                    var originalEventObject = $(this).data('eventObject');
                    //alert("originalEventObject " + originalEventObject);
                    var $extraEventClass = $color//;$(this).attr('data-class');
                    //alert("$extraEventClass " + $extraEventClass);
                    var $idActividad = $(this).attr('idActividad');
                    //alert("idActividad "+ $idActividad);
                        
                        
			
			
                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);
                    //alert("copiedEventObject " + copiedEventObject);
                        
                    var mes = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                    var semana = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
			
                    // assign it the date that was reported
                    //Wed May 27 2015 02:00:00 GMT+0200 (Hora de verano romance)
                    copiedEventObject.start =  semana[(event._d).getDay()] + " " + mes[event._d.getMonth()] + " " + event._d.getUTCDate() + " " + event._d.getUTCFullYear() + " " + (event._d).getUTCHours() + ":" + (event._d).getUTCMinutes() + ":" + (event._d).getUTCSeconds();
                    copiedEventObject.allDay = allDay;
                    if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];
                        
                    //alert("fecha: " + originalEventObject._d);
                    //var json = {"idActividad": "1", "idSala": "3", "HoraInicio": "10", "HoraFin":"11", "Ocupacion": "20", "Dia": "16", "Publicada": "1"};
                    var $HoraInicio = (event._d).getUTCHours() + ":" + (event._d).getUTCMinutes() + ":" + (event._d).getUTCSeconds();
                    var $HoraFin = (event._d).getHours() + ":" + (event._d).getMinutes() + ":" + (event._d).getSeconds();
                    var json = { idActividad:$idActividad, idSala:3, HoraInicio:$HoraInicio, HoraFin:$HoraFin, Ocupacion:20, Dia:(event._d).getDate(), Publicada:1 };
                        
                    //alert(jQuery.param(json));                       
			
                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			
                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                        $.ajax({
                            type: "DELETE",
                            url: "../Negocio/NegocioAdministrador/ClasesBO.php?url=borrarClase",
                            data: jQuery.param(json),//JSON.stringify({"idClase": "1"}),
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",

                            success: function(data, textStatus) {
                                //alert("actividad guardada");
                            },
                            error: function( jqXHR, textStatus, errorThrown ) {
                                    
                            }
                             
                        });
                    }
                    else{
                        $.ajax({
                            type: "POST",
                            url: "../Negocio/NegocioAdministrador/ClasesBO.php?url=crearClase",                            
                            data: (jQuery.param(json)),//JSON.stringify(json),
                            contentType: "application/x-www-form-urlencoded; charset=utf-8",
                            dataType: "json",
                        
                            success: function(data, textStatus) {
                                /*alert(data);
                                alert(textStatus);
                                alert(data.success);
                                alert(data.message);
                                alert("actividad guardada");*/
                            },
                            error: function( jqXHR, textStatus, errorThrown ) {
                                /*alert(jqXHR);
                                alert(jqXHR.responseText);
                                alert(jqXHR.status);
                                alert(jqXHR.fail);
                                alert(jqXHR.message);
                                alert(textStatus);
                                alert(errorThrown);
                                alert("actividad no guardada");*/
                            }});
                    }
			
                }
                ,
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                        
			
                    bootbox.prompt("New Event Title:", function(title) {
                        //alert("crear");
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
                    //alert("actualizar");					
                    /*$.datepicker.regional['es'] = {
                        closeText: 'Cerrar',
                        prevText: '<Ant',
                        nextText: 'Sig>',
                        currentText: 'Hoy',
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                        dayNamesMin: ['Do','Lun','Ma','Mi','Ju','Vi','Sá'],
                        weekHeader: 'Sm',
                        dateFormat:'dd-mm-yy',
                        firstDay: 1,
                        isRTL: false,
                        showMonthAfterYear: false,
                        yearSuffix: ''
                    };
                    $.datepicker.setDefaults($.datepicker.regional['es']); 
                    
                    $(function() {
                        $( "#FechaInicio" ).datepicker({
                            dateFormat:'dd-mm-yy'
                        });
                    });

                    $(function() {
                        $( "#FechaFin" ).datepicker({
                            dateFormat:'dd-mm-yy'    
                        });
                    });*/
                    //display a modal
                    var modal = 
                        '<div class="modal fade">\
                  <div class="modal-dialog">\
                   <div class="modal-content">\
                         <div class="modal-body">\
                           <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
                           <form class="no-margin">\
                                  <label>Nombre Actividad&nbsp;</label>\
                                  <input class="middle" autocomplete="off" disable="false" type="text" value="' + calEvent.title + '" />\
                                  <br><br><label>Fecha Inicio&nbsp;</label>\
                                  <input type="text" class="middle" id="FechaInicio" name="FechaInicio" value="' + calEvent._start._d + '" />\
                                  <br><br><label>Fecha Fin&nbsp;</label>\
                                  <input type="text" class="middle" autocomplete="off" id="FechaFin" name="FechaFin" value="' + calEvent._end._d + '" />\
                                  <input type="date" id="exampleInput" name="input" ng-model="example.value" placeholder="yyyy-MM-dd" min="2013-01-01" max="2013-12-31" required />\
                                  <label>Día Completo </label>\
                                  <input type="checkbox" id="diaCompleto" name="diaCompleto"/>\
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
                                                      //alert("actualizar");
							
                                                      $.ajax({
                                                          type: "POST",
                                                          url: "../Negocio/NegocioAdministrador/ClasesBO.php?url=actualizarClase",
                                                          data: jQuery.param( {idClase: calEvent.idClase, idActividad: calEvent.idActividad, idSala:idSala, HoraInicio:$(this).find("HoraInicio").val(), HoraFin:$(this).find("HoraFin").val(), Ocupacion:$(this).find("Ocupacion").val(), Dia:$(this).find("Dia").val(), Publicada:$(this).find("Publicada").val()} ),//JSON.stringify(json),															  

                                                          contentType: "application/x-www-form-urlencoded; charset=utf-8",
                                                          dataType: "json",
                                                          async: true,

                                                          success: function(data, textStatus) {
                                                              //alert("NombreActividad: " + data.actividad.NombreActividad);
                                                              //alert("NombreActividad: " + data.actividad.Descripcion);
                                                              //NombreActividad = data.actividad.NombreActividad;
                                                              //ColorActividad = data.actividad.Descripcion;
                                                              //alert("Clase Borrada");
                                                          },
                                                          error: function( jqXHR, textStatus, errorThrown ) {
                                                              //alert("Error al borrar Clase");
                                                          }});							
							
							
                                                      ev.preventDefault();

                                                      calEvent.title = $(this).find("input[type=text]").val();
                                                      calendar.fullCalendar('updateEvent', calEvent);
                                                      modal.modal("hide");
                                                  });
                                                  modal.find('button[data-action=delete]').on('click', function() {							
                                                      calendar.fullCalendar('removeEvents' , function(ev){
                                                          $.ajax({
                                                              type: "POST",
                                                              url: "../Negocio/NegocioAdministrador/ClasesBO.php?url=borrarClase",
                                                              data: jQuery.param( {idClase: calEvent.idClase} ),//JSON.stringify(json),
                                                              contentType: "application/x-www-form-urlencoded; charset=utf-8",
                                                              dataType: "json",
                                                              async: true,

                                                              success: function(data, textStatus) {
                                                                  //alert("NombreActividad: " + data.actividad.NombreActividad);
                                                                  //alert("NombreActividad: " + data.actividad.Descripcion);
                                                                  //NombreActividad = data.actividad.NombreActividad;
                                                                  //ColorActividad = data.actividad.Descripcion;
                                                                  //alert("Clase Borrada");
                                                              },
                                                              error: function( jqXHR, textStatus, errorThrown ) {
                                                                  //alert("Error al borrar Clase");
                                                              }});
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
                                          var Url = "../Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividades";
                                          //var Url = "../Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSalas";
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
                                              contenido = contenido + "<div class='external-event' style='background-color:" + Clase.actividades[i].Descripcion + "' color='" + Clase.actividades[i].Descripcion + "' idActividad='" + Clase.actividades[i].idActividad + "'><i class='ace-icon fa fa-arrows'></i>";
                                              //contenido = contenido + "<div class='external-event label-" + color[i] + "' data-class='label-" + color[i] + "' idActividad='" + Clase.actividades[i].idActividad + "'><i class='ace-icon fa fa-arrows'></i>";
                                              //alert(contenido);                    
                                              contenido = contenido + Clase.actividades[i].NombreActividad;
                                              //contenido = contenido + "<input type='hidden' id='idActividad' name='idActividad' value='" + Clase.actividades[i].idActividad + "'/>";
                                              contenido = contenido + "</div>";
                                          }
                                          contenido = contenido + "<label><input type='checkbox' class='ace ace-checkbox' id='drop-remove' /><span class='lbl'> Remove after drop</span></label>";
			
                                          contenido = contenido + "</div></div>";

                                          div.innerHTML = contenido;	
                                      }		
							  
                                      /*function obtenerClases(){		
                              var Url = "../Negocio/NegocioAdministrador/ClasesBO.php?url=obtenerClases";
                              //var Url = "../Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSalas";
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

                        angular.module('dateInputExample', [])
                             .controller('DateController', ['$scope', function($scope) {
                               $scope.example = {
                                 value: new Date(2013, 9, 22)
                               };
                             }]);
            
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
<!--?php require('Pie.php'); ?>-->