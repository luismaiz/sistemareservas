<?php // require('Cabecera.php'); ?>
<!-- inline scripts related to this page -->
<script type="text/javascript">
    var Ajax = new AjaxObj();
    var Actividades;
    jQuery(function($) {

        obtenerActividades();

        $('#external-events div.external-event').each(function() {				
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
            timezone: 'Europe/Madrid',
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            businessHours: true, // display business hours
            businessHours:
                {
                start: '09:00',
                end:   '21:00',
                dow: [ 1, 2, 3, 4, 5]
            },
            events: function(start, end, timezone, callback) {
                $.ajax({
                    url: "../Negocio/NegocioAdministrador/ClasesBO.php?url=obtenerClases",
                    dataType: "json",
                    data: "",
                    async: true,
                    success: function(doc) {
                        var events = [];
                        for(i=0; i<doc.clases.length; i++){
                            events.push({
                                //hay que obtener el nombre de la actividad
                                title: Actividades[doc.clases[i].idActividad].NombreActividad,
                                idActividad: Actividades[doc.clases[i].idActividad].idActividad,
                                intensidad: Actividades[doc.clases[i].idActividad].IntensidadActividad,
                                idSala: doc.clases[i].idSala,
                                idClase: doc.clases[i].idClase,
                                allDay: doc.clases[i].Dia == 0 ? false : true,
                                //start: new Date(y, m, doc.clases[i].Dia, (doc.clases[i].HoraInicio).substring(0,2), (doc.clases[i].HoraInicio).substring(3,5)),
                                start: doc.clases[i].Dia == 1 ? '' : new Date(doc.clases[i].FechaInicio.substring(6,10), doc.clases[i].FechaInicio.substring(4,5)-1, doc.clases[i].FechaInicio.substring(0,2), (doc.clases[i].HoraInicio).substring(0,2), (doc.clases[i].HoraInicio).substring(3,5)),
                                //end: doc.clases[i].FechaFin,//new Date(y, m, doc.clases[i].Dia, (doc.clases[i].HoraFin).substring(0,2), (doc.clases[i].HoraFin).substring(3,5)),
                                end: doc.clases[i].Dia == 1 ? '' : new Date(doc.clases[i].FechaFin.substring(6,10), doc.clases[i].FechaFin.substring(4,5)-1, doc.clases[i].FechaFin.substring(0,2), (doc.clases[i].HoraFin).substring(0,2), (doc.clases[i].HoraFin).substring(3,5)),                                
                                //constraint: 'businessHours',
                                backgroundColor: Actividades[doc.clases[i].idActividad].Descripcion,
                                borderColor: Actividades[doc.clases[i].idActividad].idActividad.Descripcion
                            })
                        }
                        callback(events);
                    }
                });
            },
                    
            drop: function(event, allDay) { // this function is called when something is dropped                
                alert("crear " + allDay);
                // retrieve the dropped element's stored Event Object
                var $color = $(this).attr('color');
                alert("idActividad "+ $idActividad);
                        
                var originalEventObject = $(this).data('eventObject');
                alert("originalEventObject " + originalEventObject);
                var $extraEventClass = $color//;$(this).attr('data-class');
                alert("$extraEventClass " + $extraEventClass);
                var $idActividad = $(this).attr('idActividad');
                alert("idActividad "+ $idActividad);
                        
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);
                alert("copiedEventObject " + copiedEventObject);
                        
                var mes = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                var semana = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
			
                // assign it the date that was reported
                //Wed May 27 2015 02:00:00 GMT+0200 (Hora de verano romance)
                copiedEventObject.start =  semana[(event._d).getDay()] + " " + mes[event._d.getMonth()] + " " + event._d.getUTCDate() + " " + event._d.getUTCFullYear() + " " + (event._d).getUTCHours() + ":" + (event._d).getUTCMinutes() + ":" + (event._d).getUTCSeconds();
                alert(copiedEventObject.start);
                copiedEventObject.allDay = false;
                if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];                
                var $HoraInicio = (event._d).getUTCHours() + ":" + (event._d).getUTCMinutes() + ":" + (event._d).getUTCSeconds();
                var $HoraFin = (event._d).getHours() + ":" + (event._d).getMinutes() + ":" + (event._d).getSeconds();
                var json = { idActividad:$idActividad, idSala:3, HoraInicio:$HoraInicio, HoraFin:$HoraFin, Ocupacion:20, Dia:(event._d).getDate(), Publicada:1 };
                alert("json: " + jQuery.param(json));
                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);			
                
                /*$.ajax({
                    type: "POST",
                    url: "../Negocio/NegocioAdministrador/ClasesBO.php?url=crearClase",
                    data: (jQuery.param(json)),
                    contentType: "application/x-www-form-urlencoded; charset=utf-8",
                    dataType: "json",

                    success: function(data, textStatus) {
                    },
                    error: function( jqXHR, textStatus, errorThrown ) {
                    }});  */              
            },
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                bootbox.prompt("New Event Title:", function(title) {
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
            },
            eventClick: function(calEvent, jsEvent, view) {                
                //display a modal
                var modal = 
                    '<div class="modal fade">\
                      <div class="modal-dialog">\
                       <div class="modal-content">\
                        <div class="modal-body">\
                         <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
                         <form class="no-margin">\
                          <label>Nombre Actividad&nbsp;</label>\
                          <input class="middle" autocomplete="off" disable="false" type="text" readOnly value="' + calEvent.title + '" />\
                          <br><br><label>Fecha Inicio&nbsp;</label>\
                          <input type="text" class="middle" id="fechaInicio" name="fechaInicio" readOnly value="' + calEvent._start._d.toLocaleDateString() + " " + calEvent._start._d.getHours() + ":" + calEvent._start._d.getMinutes() + '" />\
                          <br><br><label>Fecha Fin&nbsp;</label>\
                          <input type="text" class="middle" autocomplete="off" id="fechaFin" name="fechaFin" readOnly value="' + calEvent._end._d.toLocaleDateString() + " " + calEvent._end._d.getHours() + ":" + calEvent._end._d.getMinutes() + '" />\
                          <label>Día Completo </label>\
                          <input type="checkbox" id="dia" name="dia"/>\
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
                    
                    $('#fechaInicio').datetimepicker({
                        dayOfWeekStart : 1,
                        lang:'es',
                        disabledDates:[],
                        startDate: calEvent._start._d.toLocaleDateString() + " " + calEvent._start._d.getHours() + ":" + calEvent._start._d.getMinutes(),
                        formatTime:'H:i',
                        formatDate:'d/m/Y',                        
                        timepickerScrollbar:false
                        });
                    $('#fechaFin').datetimepicker({
                        dayOfWeekStart : 1,
                        lang:'es',
                        disabledDates:[],
                        startDate:	'01/01/2005'
                        });                   
                        
                    modal.find('form').on('submit', function(ev){
                      var json = {idClase: calEvent.idClase, idActividad: calEvent.idActividad, idSala:calEvent.idSala, FechaInicio:$("#fechaInicio").val().substring(0,10), HoraInicio:$("#horaInicio").val().substring(11,15), FechaFin:$("#fechaFin").val().substring(0,10), HoraFin:$("#horaFin").val().substring(11,15), Dia:$("dia").val(), Ocupacion:$("#Ocupacion").val(), Publicada:$("#Publicada").val()};
                      $.ajax({
                        type: "POST",
                        url: "../Negocio/NegocioAdministrador/ClasesBO.php?url=actualizarClase",
                        data: jQuery.param( json ),
                        contentType: "application/x-www-form-urlencoded; charset=utf-8",
                        dataType: "json",
                        async: true,
                        
                        success: function(data, textStatus) {
                        },
                        error: function( jqXHR, textStatus, errorThrown ) {
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
                            },
                            error: function( jqXHR, textStatus, errorThrown ) {
                            }
                          });
                          return (ev._id == calEvent._id);
                        })
                        modal.modal("hide");
                      });
			
                      modal.modal('show').on('hidden', function(){
                        modal.remove();
                      });                      
                    }
                  });
                })

                function AjaxObj(){
                  var xmlhttp = null;

                  if (window.XMLHttpRequest){
                    xmlhttp = new XMLHttpRequest();

                    if (xmlhttp.overrideMimeType){
                      xmlhttp.overrideMimeType('text/xml');
                    }
                  }
                  else if (window.ActiveXObject){
                    // Internet Explorer    
                    try{
                      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                    }
                    catch (e){
                      try{
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                      }
                      catch (e){
                        xmlhttp = null;
                      }
                    }
	
                    if (!xmlhttp && typeof XMLHttpRequest!='undefined'){
                      xmlhttp = new XMLHttpRequest();
	  
                      if (!xmlhttp){
                        failed = true;
                      }
                    }
                  }
                  return xmlhttp;
                }
                
                function obtenerActividades(){		
                    var Url = "../Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividades";
                    var Params = '';
                    
                    Ajax.open("GET", Url, false);
                    Ajax.setRequestHeader("Content-Type","application/json");
                    Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");                
                    Ajax.send(Params); // Enviamos los datos

                    var RespTxt = Ajax.responseText;
                    var Clase = eval('(' + RespTxt + ')');	                    
                    Actividades = Clase.actividades;
                    var contenido = "<div class='widget-main no-padding'><div id='external-events'>";
                    var div = document.getElementById("actividades");                    
                    for(i=0; i<Clase.actividades.length; i++){						  
                        contenido = contenido + "<div class='external-event' style='background-color:" + Clase.actividades[i].Descripcion + "' color='" + Clase.actividades[i].Descripcion + "' idActividad='" + Clase.actividades[i].idActividad + "'><i class='ace-icon fa fa-arrows'></i>";                        
                        contenido = contenido + Clase.actividades[i].NombreActividad;                        
                        contenido = contenido + "</div>";
                    }
                    contenido = contenido + "<label><input type='checkbox' class='ace ace-checkbox' id='drop-remove' /><span class='lbl'> Remove after drop</span></label>";
                    contenido = contenido + "</div></div>";
                    div.innerHTML = contenido;
                }
</script>
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