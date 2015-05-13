<?php require('Cabecera.php'); ?>
<!-- inline scripts related to this page -->
<script type="text/javascript">
    var Ajax = new AjaxObj();
    var Actividades;
    var app = angular.module('Clases',  [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
                      
    function CargaClases($scope, $http,$location) {
                          $scope.obtenerActividades = function() {
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividades');
                
                var Params = '';        
	        Ajax.open("GET", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                                 
                                 alert('estamos');
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    $scope.actividades = JSON.parse(Ajax.responseText).actividades;
                    Actividades = $scope.actividades;
                    alert(Actividades[0].NombreClase);
                }
                else
                {
                    $scope.actividades = [];
                }
            };
            
            $scope.obtenerActividades();
     }
                      
    
    jQuery(function($) {
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
            minTime: "10:00",
            maxTime: "20:00",
            allDaySlot:false,
            timeFormat: 'H:mm' ,
            
            //isRTL: true,
            buttonHtml: {
                prev: '<i class="ace-icon fa fa-chevron-left"></i>',
                next: '<i class="ace-icon fa fa-chevron-right"></i>'
            },
	
            header: {
                left: '',
                center: 'title',
                right: 'agendaWeek'
            },
            eventLimit: true, // allow "more" link when too many events
            defaultView: 'agendaWeek',            
            timeFormat: 'HH:mm',
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            businessHours: true, // display business hours
            businessHours:
                {
                start: '10:00',
                end:   '20:00',
                dow: [ 1, 2, 3, 4, 5]
            },
                    
            events: function(start, end, timezone, callback) {
                                
                $.ajax({
                    url: BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ClasesBO.php?url=obtenerClases'),
                    dataType: "json",
                    data: "",
                    async: true,
                    success: function(doc) {
                        var events = [];
                        alert(doc.clases[0].idActividad);
                        for(i=0; i<doc.clases.length; i++){
                            //alert(Actividades[i].idActividad);
                            //alert(doc.clases[i].idActividad);
                            events.push({
                                
                                //hay que obtener el nombre de la actividad
                                title: Actividades[doc.clases[i].idActividad].NombreActividad,
                                idActividad: Actividades[doc.clases[i].idActividad].idActividad,
                                intensidad: Actividades[doc.clases[i].idActividad].IntensidadActividad,
                                idSala: doc.clases[i].idSala,
                                idClase: doc.clases[i].idClase,
                                allDay: false,
                                //allDay: doc.clases[i].Dia === 0 ? false : true,
                                //start: new Date(y, m, doc.clases[i].Dia, (doc.clases[i].HoraInicio).substring(0,2), (doc.clases[i].HoraInicio).substring(3,5)),
                                start: doc.clases[i].Dia === 1 ? '' : new Date(new Date(doc.clases[i].FechaInicio).getUTCFullYear(), new Date(doc.clases[i].FechaInicio).getUTCMonth(), new Date(doc.clases[i].FechaInicio).getUTCDate(), (doc.clases[i].HoraInicio).substring(0,2), (doc.clases[i].HoraInicio).substring(3,5)),
                                //end: doc.clases[i].FechaFin,//new Date(y, m, doc.clases[i].Dia, (doc.clases[i].HoraFin).substring(0,2), (doc.clases[i].HoraFin).substring(3,5)),
                                end:  new Date(new Date(doc.clases[i].FechaInicio).getFullYear(), new Date(doc.clases[i].FechaInicio).getMonth(), new Date(doc.clases[i].FechaInicio).getDate(), (doc.clases[i].HoraFin).substring(0,2), (doc.clases[i].HoraFin).substring(3,5)),                                
                                //constraint: 'businessHours',
                                //backgroundColor: Actividades[doc.clases[i].idActividad].Descripcion,
                                //borderColor: Actividades[doc.clases[i].idActividad].idActividad.Descripcion
                            });
                        }
                        callback(events);
                    }
                });
            },
                    
            drop: function(event, allDay) { // this function is called when something is dropped   
                     
                 alert('hola');       
                // retrieve the dropped element's stored Event Object
                var $color = $(this).attr('color');
                //alert("idActividad "+ $idActividad);
                        
                var originalEventObject = $(this).data('eventObject');
                //alert("originalEventObject " + originalEventObject);
                var $extraEventClass = $color//;$(this).attr('data-class');
                //alert("$extraEventClass " + $extraEventClass);
                var $idActividad = $(this).attr('idActividad');
                alert("idActividad "+ $idActividad);
                        
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);
                //alert("copiedEventObject " + copiedEventObject);
                        
                var mes = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                var semana = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
			
                // assign it the date that was reported
                //Wed May 27 2015 02:00:00 GMT+0200 (Hora de verano romance)
                copiedEventObject.start =  semana[(event._d).getUTCDay()] + " " + mes[event._d.getUTCMonth()] + " " + event._d.getUTCDate() + " " + event._d.getUTCFullYear() + " " + (event._d).getUTCHours() + ":" + (event._d).getUTCMinutes() + ":" + (event._d).getUTCSeconds() + "Z";
                copiedEventObject.end =  semana[(event._d).getDay()] + " " + mes[event._d.getMonth()] + " " + event._d.getDate() + " " + event._d.getFullYear() + " " + (event._d).getHours() + ":" + (event._d).getMinutes() + ":" + (event._d).getSeconds() + "Z";
                //alert(copiedEventObject.start);
                copiedEventObject.allDay = false;
                copiedEventObject.color = $color;
                if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];                
                var $HoraInicio = (event._d).getUTCHours() + ":" + (event._d).getUTCMinutes() + ":" + (event._d).getUTCSeconds();
                var $HoraFin = (event._d).getHours() + ":" + (event._d).getMinutes() + ":" + (event._d).getSeconds();
                var json = { idActividad:$idActividad, idSala:3, FechaInicio:(new Date(copiedEventObject.start)).toISOString().substring(0,10), HoraInicio:$HoraInicio, FechaFin:(new Date(copiedEventObject.end)).toISOString().substring(0,10),HoraFin:$HoraFin, Ocupacion:20, Dia:0, Publicada:1 };
                //alert("json: " + jQuery.param(json));
                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);			
                
                alert((jQuery.param(json)));
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ClasesBO.php?url=crearClase');		
                		
                var Params ='idActividad='+  +
                    '&idSala='+ 3 +
                    '&FechaInicio='+ (new Date(copiedEventObject.start)).toISOString().substring(0,10)+
            '&HoraInicio='+ $HoraInicio+
            '&FechaFin='+ (new Date(copiedEventObject.end)).toISOString().substring(0,10)+
            '&HoraFin='+ $HoraFin+
            '&Ocupacion='+ 20+
            '&Dia='+ 0+
            '&Publicada='+ 1;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                alert(Ajax.responseText);
               
            },
            eventDrop: function(calEvent, delta) {                
                var json = {idClase:calEvent.idClase,idActividad:calEvent.idActividad,idSala:calEvent.idSala,FechaInicio:calEvent.start._d.getUTCFullYear() + "-" + (calEvent.start._d.getUTCMonth()+1) + "-" + calEvent.start._d.getUTCDate(), HoraInicio:calEvent.start._d.getUTCHours() + ":" + calEvent.start._d.getUTCMinutes(), FechaFin:calEvent.end._d.getUTCFullYear() + "-" + (calEvent.end._d.getUTCMonth()+1) + "-" + calEvent.end._d.getUTCDate(), HoraFin:calEvent.end._d.getUTCHours() + ":" + calEvent.end._d.getUTCMinutes(), Ocupacion:20, Dia:calEvent._fullDay, Publicada:1};
                $.ajax({
                    type: "POST",
                    url: BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ClasesBO.php?url=actualizarClase'),
                    data: jQuery.param( json ),
                    contentType: "application/x-www-form-urlencoded; charset=utf-8",
                    dataType: "json",
                    async: false,
                        
                    success: function(data, textStatus) {
                        alert("clase actualizada");
                    },
                    error: function( jqXHR, textStatus, errorThrown ) {
                }});
            },
            eventResize: function(calEvent) {
                var json = {idClase:calEvent.idClase,idActividad:calEvent.idActividad,idSala:calEvent.idSala,FechaInicio:calEvent.start._d.getUTCFullYear() + "-" + (calEvent.start._d.getUTCMonth()+1) + "-" + calEvent.start._d.getUTCDate(), HoraInicio:calEvent.start._d.getUTCHours() + ":" + calEvent.start._d.getUTCMinutes(), FechaFin:calEvent.end._d.getUTCFullYear() + "-" + (calEvent.end._d.getUTCMonth()+1) + "-" + calEvent.end._d.getUTCDate(), HoraFin:calEvent.end._d.getUTCHours() + ":" + calEvent.end._d.getUTCMinutes(), Ocupacion:20, Dia:calEvent._fullDay, Publicada:1};
                $.ajax({
                    type: "POST",
                    url: BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ClasesBO.php?url=actualizarClase'),
                    data: jQuery.param( json ),
                    contentType: "application/x-www-form-urlencoded; charset=utf-8",
                    dataType: "json",
                    async: true,

                    success: function(data, textStatus) {
                        alert("clase actualizada");
                    },
                    error: function( jqXHR, textStatus, errorThrown ) {
                }});    
            },
            selectable: true,
            selectHelper: true,
            
            eventClick: function(calEvent, jsEvent, view) {     
            
            
            $('#NombreClase').val(calEvent.idActividad);
            $('#NombreSala').val(calEvent.idActividad);
            //$('#eventUrl').attr('href',calEvent.idActividad);
            $('#fullCalModal').modal();
                    $(document).ready(function(){
                        $("#diaCompleto").keydown(function() {
                            if($("#checkbox").is(':checked')) {  
                                alert("EstÃ¡ activado");  
                            } else {  
                                alert("No estÃ¡ activado");  
                            }  
                        });  

                    });  
                    $('#fechaInicio').datetimepicker({
                        dayOfWeekStart : 1,
                        lang:'es',
                        disabledDates:[],
                        startDate: calEvent._start._d.toLocaleDateString() + " " + calEvent._start._d.getHours() + ":" + calEvent._start._d.getMinutes(),
                        timeFormat: "HH:mm:ss",
                        dateFormat: "yyyy-mm-dd",
                        timepickerScrollbar:false
                        });
                    $('#fechaFin').datetimepicker({
                        dayOfWeekStart : 1,
                        lang:'es',
                        disabledDates:[],
                        startDate: calEvent._start._d.toLocaleDateString() + " " + calEvent._start._d.getHours() + ":" + calEvent._start._d.getMinutes(),
                        timeFormat: "HH:mm:ss",
                        dateFormat: "yyyy-mm-dd",
                        timepickerScrollbar:false
                        });   
                        
                    
                        
                    $('#fullCalModal').find('form').on('submit', function(ev){
                      var json = {idClase: calEvent.idClase, idActividad: calEvent.idActividad, idSala:calEvent.idSala, FechaInicio:$("#fechaInicio").val().substring(0,9), HoraInicio:$("#fechaInicio").val().substring(10,15), FechaFin:$("#fechaFin").val().substring(0,9), HoraFin:$("#fechaFin").val().substring(10,15), Dia:0, Ocupacion:20, Publicada:1};
                      $.ajax({
                        type: "POST",
                        url: BASE_URL.concat('sistemareservasNegocio/NegocioAdministrador/ClasesBO.php?url=actualizarClase'),
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
                        $('#fullCalModal').modal("hide");
                      });
                      
                      $('#fullCalModal').find('button[data-action=delete]').on('click', function() {                        
                        calendar.fullCalendar('removeEvents' , function(ev){
                          $.ajax({
                            type: "POST",
                            url: BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ClasesBO.php?url=borrarClase'),
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
                        $('#fullCalModal').modal("hide");
                      });
			
                      $('#fullCalModal').modal('show').on('hidden', function(){
                        $('#fullCalModal').remove();
                      });                      
                    }
                  });
                })

</script>
<div class="row"ng-app="Clases">
    <div ng_controller="CargaClases">
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
                        <h4>Actividades</h4>
                    </div>

                    <div class="widget-body" id="actividades">		
                        <div class='widget-main no-padding'>
                            <div id='external-events'>
                                <div class='external-event' ng_repeat="actividad in actividades"><i class='ace-icon fa fa-arrows'></i>
                                {{actividad.NombreActividad}}
                                </div>
                                </div>
                            </div>
                            
                    </div>
                </div>
            </div>
        </div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
    
    <div id="fullCalModal" class="modal fade" style="display:none;">
                      <div class="modal-dialog">
                       <div class="modal-content">
                        <div class="modal-body">
                         <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>
                         
                          <form role="form" class="no-margin"  name="formulario">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input ng-model="clase.idClase" type="hidden" class="input-sm" name="idClase" id="idClase">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Nombre Clase</label>
                                <input type="text" ng-model="clase.NombreClase" value="{{calEvent.idSala}}"  class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="nombreclase" id="NombreClase" required >
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Nombre Sala</label>
                                <input type="text" ng-model="clase.NombreSala"   class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="nombresala" id="NombreSala" required >
                                </div>
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Actividad</label>
                                <input type="text" ng-model="clase.Actividad"   class="input-sm col-lg-6 col-md-6 col-sm-8 col-xs-12" name="nombresala" id="NombreSala" required >
                              </div>
                                <div  class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Fecha Inicio</label>
                                <input id="FechaInicio" ng_disabled="true" ng-model="clase.FechaInicio" type="text" class="input-sm col-md-2 col-sm-4 col-xs-7" name="FechaInicio">
                                </div>
                                <div  class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-2 col-md-12 col-sm-12 col-xs-12" >Fecha Fin</label>
                                <input id="FechaFin" ng_disabled="true" ng-model="clase.FechaFin" type="text" class="input-sm col-md-2 col-sm-4 col-xs-7" name="FechaFin">
                                </div>
                             </form>
                        </div>
                        <div class="modal-footer">
                         <button type="button" class="btn btn-sm btn-danger" data-action="delete"><i class="ace-icon fa fa-trash-o"></i> Delete Event</button>
                         <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>
                       </div>
                      </div>
                     </div>
                    
    </div>
    

    </div>
</div><!-- /.row -->
<?php require('Pie.php'); ?>