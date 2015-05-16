<?php require('Cabecera.php'); ?>
<!-- inline scripts related to this page -->
<script type="text/javascript">
    var Ajax = new AjaxObj();
    var Actividades;
    var Salas;
    var app = angular.module('Clases',  [])            
                     .config(function($locationProvider) {
                          $locationProvider.html5Mode(true);
                      });
                      
    function CargaClases($scope, $http,$location) {
                $scope.obtenerActividades = function() {
                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ActividadesBO.php?url=obtenerActividadesFiltro');
                var Params = 'NombreActividad=' + '' + '&IntensidadActividad=' + '' + '&Grupo=' + '';    
                
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
        
                $scope.estado = JSON.parse(Ajax.responseText).estado;
                
                if ($scope.estado === 'correcto')
                {
                    $scope.actividades = JSON.parse(Ajax.responseText).actividades;
                    Actividades = $scope.actividades;
                }
                else
                {
                    $scope.actividades = [];
                }
            };
            
            $scope.obtenerActividades();
			
		$scope.obtenerSalas = function() {
		var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/SalasBO.php?url=obtenerSalasFiltro');
                var Params = 'NombreSala=' + '' + '&CapacidadSala=' + '';    
                
                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                Ajax.send(Params); 
				
				if ($scope.estado === 'correcto')
    				{
                                
				$scope.salas = JSON.parse(Ajax.responseText).salas;
				Salas = $scope.salas;
				}
            };
            $scope.obtenerSalas();
     }
    
    jQuery(function($) {
        $('#external-events .fc-event').each(function() {				
            
            var eventObject = {
                title: $.trim($(this).text()),
                idActividad:$(this).attr('id')
            };
            
            $(this).data('eventObject', eventObject);
            $(this).draggable({
                zIndex: 999,
                revert: true,      
                revertDuration: 0  
            });		
        });
        /* initialize the calendar
-----------------------------------------------------------------*/

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
            minTime: "09:00",
            maxTime: "22:00",
            allDaySlot:false,
            timeFormat: 'H:mm' ,
            hiddenDays: [ 0 ],
                        
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
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
                    
            events: function(start, end, timezone, callback) {
                                
                $.ajax({
                    url: BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ClasesBO.php?url=obtenerClases'),
                    dataType: "json",
                    data: "",
                    async: true,
                    success: function(doc) {
                        var events = [];
                        
                        for(i=0; i<doc.clases.length; i++){
                           
                            events.push({
                                
                                //hay que obtener el nombre de la actividad
                                title: Actividades[doc.clases[i].idActividad-1].NombreActividad,
                                idActividad: Actividades[doc.clases[i].idActividad-1].idActividad,
                                idSala: doc.clases[i].idSala,
                                OcupacionClase: doc.clases[i].Ocupacion,
                                idClase: doc.clases[i].idClase,
                                allDay: false,
                                start: doc.clases[i].Dia === 1 ? '' : new Date(new Date(doc.clases[i].FechaInicio).getUTCFullYear(), new Date(doc.clases[i].FechaInicio).getUTCMonth(), new Date(doc.clases[i].FechaInicio).getUTCDate(), (doc.clases[i].HoraInicio).substring(0,2), (doc.clases[i].HoraInicio).substring(3,5)),
                                end:  new Date(new Date(doc.clases[i].FechaInicio).getFullYear(), new Date(doc.clases[i].FechaInicio).getMonth(), new Date(doc.clases[i].FechaInicio).getDate(), (doc.clases[i].HoraFin).substring(0,2), (doc.clases[i].HoraFin).substring(3,5)),                                
                                backgroundColor: "#"+doc.clases[i].Ocupacion,
                                borderColor: "#"+doc.clases[i].Ocupacion
                            });
                        }
                        callback(events);
                    }
                });
            },
            dayClick: function(date, jsEvent, view) {
                $('#fullCalModal').modal();
            },
                    
            drop: function(event,date, allDay) { // this function is called when something is dropped   
                var inicio = new Date((event._d).getFullYear(), (event._d).getMonth(), (event._d).getDate(), (event._d).getHours(), (event._d).getMinutes(), (event._d).getSeconds()).toUTCString();
                var fin = new Date((event._d).getFullYear(), (event._d).getMonth(), (event._d).getDate(), ((event._d).getHours()+1), (event._d).getMinutes(), (event._d).getSeconds()).toUTCString();
                var horainicio = (event._d).getUTCHours() + ":" + (event._d).getUTCMinutes() + ":" + (event._d).getUTCSeconds();
                var horafin = (event._d).getUTCHours()+1 + ":" + (event._d).getUTCMinutes() + ":" + (event._d).getUTCSeconds();
                                                
                var originalEventObject = $(this).data('eventObject');
                var $idActividad = parseInt($(this).attr('id'));
                var copiedEventObject = $.extend({}, originalEventObject);
                copiedEventObject.start =  inicio;
                copiedEventObject.end =  fin;
                copiedEventObject.allDay = false;
                var $HoraInicio = horainicio;
                var $HoraFin = horafin;
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);			
                                
                var Url = BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ClasesBO.php?url=crearClase');		
                		
                var Params ='idActividad='+ $idActividad +
                    '&idSala='+ 3 +
                    '&FechaInicio='+ (new Date(copiedEventObject.start)).toISOString().substring(0,10)+
                    '&HoraInicio='+ $HoraInicio+
                    '&FechaFin='+ (new Date(copiedEventObject.end)).toISOString().substring(0,10)+
                    '&HoraFin='+ $HoraFin+
                    '&Ocupacion='+ ''+
                    '&Dia='+ 0+
                    '&Publicada='+ 1;

                Ajax.open("POST", Url, false);
                Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                Ajax.send(Params); // Enviamos los datos
                
                alert(Ajax.responseText);
            },
            eventDrop: function(calEvent, delta) {                
                var json = {idClase:calEvent.idClase,idActividad:calEvent.idActividad,idSala:calEvent.idSala,FechaInicio:calEvent.start._d.getUTCFullYear() + "-" + (calEvent.start._d.getUTCMonth()+1) + "-" + calEvent.start._d.getUTCDate(), HoraInicio:calEvent.start._d.getUTCHours() + ":" + calEvent.start._d.getUTCMinutes(), FechaFin:calEvent.end._d.getUTCFullYear() + "-" + (calEvent.end._d.getUTCMonth()+1) + "-" + calEvent.end._d.getUTCDate(), HoraFin:calEvent.end._d.getUTCHours() + ":" + calEvent.end._d.getUTCMinutes(), Ocupacion:calEvent.Ocupacion, Dia:calEvent._fullDay, Publicada:1};
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
                
        
                var json = {idClase:calEvent.idClase,idActividad:calEvent.idActividad,idSala:calEvent.idSala,FechaInicio:calEvent.start._d.getUTCFullYear() + "-" + (calEvent.start._d.getUTCMonth()+1) + "-" + calEvent.start._d.getUTCDate(), HoraInicio:calEvent.start._d.getUTCHours() + ":" + calEvent.start._d.getUTCMinutes(), FechaFin:calEvent.end._d.getUTCFullYear() + "-" + (calEvent.end._d.getUTCMonth()+1) + "-" + calEvent.end._d.getUTCDate(), HoraFin:calEvent.end._d.getUTCHours() + ":" + calEvent.end._d.getUTCMinutes(), Ocupacion:calEvent.Ocupacion, Dia:calEvent._fullDay, Publicada:1};
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
            //var data = event.dataTransfer.getData("Text");
            
            $('#idActividad').val(calEvent.idActividad);
            $('#idSala').val(calEvent.idSala);
            $('#OcupacionClase').val(calEvent.OcupacionClase);
            $('#FechaInicio').val(calEvent._start._d.toLocaleDateString() + " " + calEvent._start._d.getHours() + ":" + calEvent._start._d.getMinutes());
            $('#FechaFin').val(calEvent._end._d.toLocaleDateString() + " " + calEvent._end._d.getHours() + ":" + calEvent._end._d.getMinutes());
            $('#fullCalModal').modal();
 
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
                        $('#calendar').fullCalendar('updateEvent', calEvent);
                        $('#fullCalModal').modal("hide");
                      });
                      
                    $('#fullCalModal').find('button[data-action=delete]').on('click', function() {                        
                        $('#calendar').fullCalendar('removeEvents' , function(ev){
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
                          return (ev._id === calEvent._id);
                        });
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
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="space"></div>

                <div id="calendar"></div>
            </div>

            <div class="col-lg-3  hidden-md hidden-sm hidden-xs">
                <div class="widget-box transparent">
                    <div class="widget-header">
                        <h4>Actividades</h4>
                    </div>

                    <div class="widget-body" id="actividades">		
                        <div class='widget-main no-padding'>
                            <div id='external-events'>
                                <div id ="{{actividad.idActividad}}" class='fc-event' ng_repeat="actividad in actividades"><i class='ace-icon fa fa-arrows'></i>
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
                            <div class="form-group">
                            <div class="col-md-12">
                          <form role="form" name="formulario">
				<input  type="hidden" class="input-sm" name="idClase" id="idClase">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-4 col-md-12 col-sm-12 col-xs-12" >Actividad</label>
                                <select  name="idActividad" id="idActividad" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" >	
                                    <option ng_repeat="actividad in actividades" value="{{actividad.idActividad}}">{{actividad.NombreActividad}}</option>
                                </select>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-4 col-md-12 col-sm-12 col-xs-12" >Sala</label>
                                <select  name="idSala" id="idSala" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" >	
                                    <option ng_repeat="sala in salas" value="{{sala.idSala}}">{{sala.NombreSala}}</option>
                                </select>
                                </div>
				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-4 col-md-12 col-sm-12 col-xs-12" >Ocupacion</label>
                                <input class="input-sm color" id="OcupacionClase" name="OcupacionClase" required>
                                </div>
                                <div  class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-4 col-md-12 col-sm-12 col-xs-12" >Fecha Inicio</label>
                                <input ng_disabled="true" id="fechaInicio"  type="text" class="input-sm col-md-2 col-sm-4 col-xs-7" name="fechaInicio">
                                </div>
                                <div  class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-4 col-md-12 col-sm-12 col-xs-12" >Hora Inicio</label>
                                <input ng_disabled="true" id="horaInicio"  type="text" class="input-sm col-md-2 col-sm-4 col-xs-7" name="horaInicio">
                                </div>
                                <div  class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-4 col-md-12 col-sm-12 col-xs-12" >Fecha Fin</label>
                                <input ng_disabled="true" id="fechaFin" type="text" class="input-sm col-md-2 col-sm-4 col-xs-7" name="fechaFin">
                                </div>
                                <div  class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-4 col-md-12 col-sm-12 col-xs-12" >Hora Fin</label>
                                <input ng_disabled="true" id="horaFin" type="text" class="input-sm col-md-2 col-sm-4 col-xs-7" name="horaFin">
                                </div>
                             </form>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                         <button type="button" class="btn btn-sm btn-danger" data-action="delete"><i class="ace-icon fa fa-trash-o"></i>Eliminar Clase</button>
                         <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i>Cancelar</button>
                       </div>
                      </div>
                     </div>
                    
    </div>
    

    </div>
</div><!-- /.row -->
<?php require('Pie.php'); ?>