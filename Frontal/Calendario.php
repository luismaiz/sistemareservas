<?php require('Cabecera.php'); ?>
<!-- inline scripts related to this page -->
<script type="text/javascript">
    var Ajax = new AjaxObj();
    var Actividades;
    var Sala;
    var arrayactividades=[];
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
                    for(var i = JSON.parse(Ajax.responseText).actividades.length - 1; i >= 1; i--) {
			if(JSON.parse(Ajax.responseText).actividades[i].FechaBaja !== null) {
			JSON.parse(Ajax.responseText).actividades.splice(i, 1);
                }
                }
                    $scope.actividades = JSON.parse(Ajax.responseText).actividades;
                    
            
                    Actividades = $scope.actividades;
                    
                    
                    for (var i=0;i<Actividades.length;i++)
                    {
                        arrayactividades[i] = (Actividades[i].idActividad);
                    }
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
                                for(var i = JSON.parse(Ajax.responseText).salas.length - 1; i >= 1; i--) {
                                    
                                if(JSON.parse(Ajax.responseText).salas[i].FechaBaja !== null) {
                                JSON.parse(Ajax.responseText).salas.splice(i, 1);
                                }
                                }
				$scope.salas = JSON.parse(Ajax.responseText).salas;
				
                                Salas = $scope.salas;
                                
				}
            };
            $scope.obtenerSalas();
            
            $scope.calendariosala = function(idSala){
              
              Sala=idSala;
              $('#calendar').fullCalendar( 'removeEvents');
              $('#calendar').fullCalendar( 'refetchEvents');
            };
     }
    
    jQuery(function($) {

 
        $('#fechaInicio').datetimepicker({
                        lang:'es',
                        format: 'd/m/Y H:i:00'//,
                        });
        $('#fechaFin').datetimepicker({
                        lang:'es',
                        format: 'd/m/Y H:i:00'//,
                        }); 
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
        var CalLoading = true;
        var lastView;;
        $('#calendar').fullCalendar({
            
            minTime: "09:00",
            maxTime: "22:00",
            allDaySlot:false,
            timeFormat: 'H:mm' ,
            lazyFetching: true,
            header:false,
            eventbordercolor:'red',
//            header: {
//				left: 'prev,next today',
//				center: 'title',
//				right: 'month,agendaWeek,agendaDay'
//			},
            columnFormat:'dddd',
                            
           
            eventLimit: true, // allow "more" link when too many events
            defaultView: 'agendaWeek',            
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            selectable: true,
            selectHelper: true,
            
            events: function(start, end, timezone, callback) {
              var json ="";
              
              if (typeof(Sala !== "undefined"))
              {
                json = {idSala:Sala};
                datos = jQuery.param( json );
              }
              else
                datos=json;  
                
                $.ajax({
                    url: BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ClasesBO.php?url=obtenerClases'),
                    dataType: "json",
                    data: datos,
                    async: false,
                    success: function(doc) {
                        
                        
                     if(typeof(doc)==="undefined")
                         return;
                     
                        var events = [];
                        for(i=0; i<doc.clases.length; i++){
                            
                            // Split timestamp into [ Y, M, D, h, m, s ]
                            
                            var fechainicio = doc.clases[i].FechaInicio.toLocaleString().split(/[- :]/);
                            var fechafin = doc.clases[i].FechaFin.toLocaleString().split(/[- :]/);
                                                     
                            // Apply each element to the Date function
                            var Cfechainicio = new Date(fechainicio[0], fechainicio[1]-1, fechainicio[2], fechainicio[3], fechainicio[4], fechainicio[5]);
                            var Cfechafin = new Date(fechafin[0], fechafin[1]-1, fechafin[2], fechafin[3], fechafin[4], fechafin[5]);
                            
                            events.push({
                                id:doc.clases[i].idClase,
                                title: Actividades[arrayactividades.indexOf(doc.clases[i].idActividad)].NombreActividad,
                                idActividad: doc.clases[i].idActividad,
                                idSala: doc.clases[i].idSala,
                                OcupacionClase: doc.clases[i].Ocupacion,
                                idClase: doc.clases[i].idClase,
                                allDay: false,
                                start: Cfechainicio,
                                end:  Cfechafin,
                                backgroundColor: "#"+doc.clases[i].Ocupacion,
                                borderColor: "#"+doc.clases[i].Ocupacion
                            });
                            
                            for (var loop = 1;
                                 loop <= 10;
                                 loop = loop + 1) {
                                     
                                 var cuenta = Cfechainicio.getTime()+(24 * 60 * 60 * 1000)*loop*7;    
                                 var cuentafin = Cfechafin.getTime()+(24 * 60 * 60 * 1000)*loop*7;    
                                                                          
                                var date = new Date(cuenta);
                                var date2 = new Date(cuentafin);
                                //alert(date2);
                                
                    events.push({
                        id:doc.clases[i].idClase,
                                title: Actividades[arrayactividades.indexOf(doc.clases[i].idActividad)].NombreActividad,
                                idActividad: doc.clases[i].idActividad,
                                idSala: doc.clases[i].idSala,
                                OcupacionClase: doc.clases[i].Ocupacion,
                                idClase: doc.clases[i].idClase,
                                allDay: false,
                                start: date,
                                end:  date2,
                                backgroundColor: "#"+doc.clases[i].Ocupacion,
                                borderColor: "#"+doc.clases[i].Ocupacion
                    });
            } // for loop
                            
                            
                            
                        }
						
                        callback(events);
                    }
                });
            },
            
            
            
            drop: function(event,allDay) { // this function is called when something is dropped 
                
                var inicio = new Date((event._d).getFullYear(), (event._d).getMonth(), (event._d).getDate(), (event._d).getHours(), (event._d).getMinutes(), (event._d).getSeconds()).toUTCString();
                var fin = new Date((event._d).getFullYear(), (event._d).getMonth(), (event._d).getDate(), ((event._d).getHours()+1), (event._d).getMinutes(), (event._d).getSeconds()).toUTCString();
                var originalEventObject = $(this).data('eventObject');
                var $idActividad = parseInt($(this).attr('id'));
                var copiedEventObject = $.extend({}, originalEventObject);
                copiedEventObject.start =  inicio;
                copiedEventObject.end =  fin;
                copiedEventObject.allDay = false;
                var json = {idActividad:$idActividad,idSala:161,FechaInicio:inicio, FechaFin:fin, Ocupacion:'', Dia:0, Publicada:1};
                
                $.ajax({
                    type: "POST",
                    url: BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ClasesBO.php?url=crearClaseGMT'),
                    data: jQuery.param( json ),
                    contentType: "application/x-www-form-urlencoded; charset=utf-8",
                    dataType: "json",
                    async: true,
                        
                    success: function(data, textStatus) {
                        copiedEventObject.idClase = data.idClase;
                        copiedEventObject.id = data.idClase;
                        //copiedEventObject.idSala = 3;
                        copiedEventObject.idActividad = $idActividad;
                        copiedEventObject.start = inicio;
                        copiedEventObject.end = fin;
                        copiedEventObject.Ocupacion = '';
                        //$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                        $('#calendar').fullCalendar('removeEvents' );
                        $('#calendar').fullCalendar( 'refetchEvents' );
                        //setTimeout(function() { $('#calendar').fullCalendar('refetchEvents');},0);
                    },
                    error: function( jqXHR, textStatus, errorThrown ) {

                }}); 
				
            },
            eventDrop: function(calEvent, delta) { 
                
               var originalEventObject = $(this).data('eventObject');
                var $idActividad = parseInt($(this).attr('id'));
                var copiedEventObject = $.extend({}, originalEventObject);
                var json = {idClase:calEvent._id,idActividad:calEvent.idActividad,idSala:calEvent.idSala,FechaInicio:calEvent.start._d.toUTCString(), FechaFin:calEvent.end._d.toUTCString(), Ocupacion:calEvent.OcupacionClase, Dia:calEvent._fullDay, Publicada:1};
                $.ajax({
                    type: "POST",
                    url: BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ClasesBO.php?url=actualizarClaseGMT'),
                    data: jQuery.param( json ),
                    contentType: "application/x-www-form-urlencoded; charset=utf-8",
                    dataType: "json",
                    async: true,
                        
                    success: function(data, textStatus) {
                                                                
                    //$('#calendar').fullCalendar('updateEvent',calEvent, true);
                    $('#calendar').fullCalendar('removeEvents' );
                    $('#calendar').fullCalendar( 'refetchEvents' );
                        
                    },
                    error: function( jqXHR, textStatus, errorThrown ) {
                }});
				
            },
            eventResize: function(calEvent) {
                
                                          
                
                var json = {idClase:calEvent._id,idActividad:calEvent.idActividad,idSala:calEvent.idSala,FechaInicio:calEvent.start._d.toUTCString(), FechaFin:calEvent.end._d.toUTCString(), Ocupacion:calEvent.OcupacionClase, Dia:calEvent._fullDay, Publicada:1};
                $.ajax({
                    type: "POST",
                    url: BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ClasesBO.php?url=actualizarClaseGMT'),
                    data: jQuery.param( json ),
                    contentType: "application/x-www-form-urlencoded; charset=utf-8",
                    dataType: "json",
                    async: true,

                    success: function(data, textStatus) {
                        
                        //$('#calendar').fullCalendar('updateEvent',calEvent, true);
                        //$('#calendar').fullCalendar( 'refetchEvents' );
                        //$('#calendar').fullCalendar('rerenderEvents'); 
                        $('#calendar').fullCalendar('removeEvents' );
                        $('#calendar').fullCalendar( 'refetchEvents' );
                    },
                    error: function( jqXHR, textStatus, errorThrown ) {
                }});    
				
            },
            dayClick: function(date, jsEvent, view) {
                
                $('#fullCalModal').modal();
                
                //$('#idActividad').attr("disabled", false);
                //$('#idSala').attr("disabled", false);    
                $('#fullCalModal').find('button[data-action=crear]').show();
                $('#fullCalModal').find('button[data-action=actualizar]').hide();
                $('#fullCalModal').find('button[data-action=delete]').hide();
                $('#fechaInicio').val('');
                $('#fechaFin').val('');
                $('#OcupacionClase').val('FFFFFF');
                $('#OcupacionClase').css('background-color',"#FFFFFF");
                
                 //$('#fullCalModal').find('button[data-action=crear]').on('click', function(ev) { 
                
            },
            eventClick: function(calEvent, jsEvent, view) { 
            $( "#calendar").unbind( "eventClick" );
            var Cfechainiciocarga=null;
            var Cfechafincarga =null;
            
            if(isNaN(calEvent.idSala))
            {            
            Cfechainiciocarga = new Date(calEvent._start._d.getFullYear(),calEvent._start._d.getMonth(),calEvent._start._d.getDate(),calEvent._start._d.getHours()-2,calEvent._start._d.getMinutes(),calEvent._start._d.getSeconds());
            Cfechafincarga = new Date(calEvent._end._d.getFullYear(),calEvent._end._d.getMonth(),calEvent._end._d.getDate(),calEvent._end._d.getHours()-2,calEvent._end._d.getMinutes(),calEvent._end._d.getSeconds());    
            
            }
            else
            {
            Cfechainiciocarga = new Date(calEvent._start._d.getFullYear(),calEvent._start._d.getMonth(),calEvent._start._d.getDate(),calEvent._start._d.getHours(),calEvent._start._d.getMinutes(),calEvent._start._d.getSeconds());
            Cfechafincarga = new Date(calEvent._end._d.getFullYear(),calEvent._end._d.getMonth(),calEvent._end._d.getDate(),calEvent._end._d.getHours(),calEvent._end._d.getMinutes(),calEvent._end._d.getSeconds());
            }
            
            $('#fullCalModal').modal('show');
            $('#idActividad').val(calEvent.idActividad);
            $('#idClase').val(calEvent.idClase);
            $('#idSala').val(calEvent.idSala);
            $('#OcupacionClase').val(calEvent.OcupacionClase);
            $('#OcupacionClase').css('background-color',"#"+calEvent.OcupacionClase);
            $('#fechaInicio').val(Cfechainiciocarga.toLocaleString());
            $('#fechaFin').val(Cfechafincarga.toLocaleString());
            $('#fullCalModal').find('button[data-action=crear]').hide();
            $('#fullCalModal').find('button[data-action=actualizar]').show();
            $('#fullCalModal').find('button[data-action=delete]').show();
            
            
            
            //$('#fullCalModal').find('button[data-action=actualizar]').on('click', function(ev){
            
            
                      
                       $('#fullCalModal').modal('show').on('hidden', function(){
                       $('#fullCalModal').remove();
                      });
                    }                                   
                   
                    
                  });
                  
                  $('#eliminar').on('click', function(ev) { 
            
                            //$('#calendar').fullCalendar('removeEvents' , function(calEvent._id){
                            $.ajax({
                            type: "POST",
                            url: BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ClasesBO.php?url=borrarClase'),
                            data: jQuery.param( {idClase: $('#idClase').val()} ),//JSON.stringify(json),
                            contentType: "application/x-www-form-urlencoded; charset=utf-8",
                            dataType: "json",
                            async: true,

                            success: function(data, textStatus) {
                                
                                $('#calendar').fullCalendar('removeEvents' , $('#idClase').val());
                                //$( "#calendar").bind( "eventClick" );
                                //$('#calendar').fullCalendar( 'refetchEvents' );
                                //$('#calendar').fullCalendar('rerenderEvents'); 
                            },
                            error: function( jqXHR, textStatus, errorThrown ) {
                            }
                          });
                          $('#fullCalModal').modal("hide");   
                      });
                      
                  $('#actualizar').on('click',function(ev) { 
                    var fechainicio=$('#fechaInicio').val().replace(/[^0-9]+/g, '');;
                    var fechafin = $('#fechaFin').val().replace(/[^0-9]+/g, '');;
                    var CfechainiciocargaActu=null;
                    var CfechafincargaActu = null;
                
                    if (fechainicio.length <14)
                    {
                        fechainicio = $('#fechaInicio').val().trim().split(/[/ :]/);
                        CfechainiciocargaActu = new Date(fechainicio[2],fechainicio[1]-1,fechainicio[0],fechainicio[3],fechainicio[4],fechainicio[5]);
                    }
                    else
                    {
                        fechainicio = $('#fechaInicio').val().replace(/[^0-9]+/g, '');
                        CfechainiciocargaActu = new Date(fechainicio.substring(4,8),fechainicio.substring(2,4)-1,fechainicio.substring(0,2),fechainicio.substring(8,10),fechainicio.substring(10,12),fechainicio.substring(12,14));
                    }
                    if (fechafin.length <14)
                    {
                        fechafin = $('#fechaFin').val().trim().split(/[/ :]/);
                        CfechafincargaActu = new Date(fechafin[2],fechafin[1]-1,fechafin[0],fechafin[3],fechafin[4],fechafin[5]);
                    }
                    else
                {
                    fechafin = $('#fechaFin').val().replace(/[^0-9]+/g, '');
                    CfechafincargaActu = new Date(fechafin.substring(4,8),fechafin.substring(2,4)-1,fechafin.substring(0,2),fechafin.substring(8,10),fechafin.substring(10,12),fechafin.substring(12,14));
                }
               
               var json = {idClase:$('#idClase').val(),idActividad:$('#idActividad').val(),idSala:$('#idSala').val(),FechaInicio:CfechainiciocargaActu.toUTCString(), FechaFin:CfechafincargaActu.toUTCString(), Ocupacion:$('#OcupacionClase').val(), Dia:0, Publicada:1};
               
                
                $.ajax({
                    type: "POST",
                    url: BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ClasesBO.php?url=actualizarClase'),
                    data: jQuery.param( json ),
                    contentType: "application/x-www-form-urlencoded; charset=utf-8",
                    dataType: "json",
                    async: true,
                        
                    success: function(data, textStatus) {
                        
                        //$('#calendar').fullCalendar('removeEvents' , $('#idClase').val());
                        $('#calendar').fullCalendar('removeEvents' );
                        $('#calendar').fullCalendar( 'refetchEvents' );
//                        var calEvent= new Object();
//                        calEvent.id = $('#idClase').val();
//                        calEvent.idClase = $('#idClase').val();
//                        calEvent.idActividad =$('#idActividad').val();
//                        calEvent.idSala =$('#idSala').val();
//                        calEvent.allDay = false;
//                        calEvent.start = CfechainiciocargaActu;
//                        calEvent.end = CfechafincargaActu;
//                        calEvent.OcupacionClase=$('#OcupacionClase').val();
//                        calEvent.backgroundColor= "#"+$('#OcupacionClase').val();
//                        calEvent.borderColor= "#"+$('#OcupacionClase').val();
//
//                        $('#calendar').fullCalendar('updateEvent',calEvent, false);
                    },
                    error: function( jqXHR, textStatus, errorThrown ) {
                }});
                    
                    $('#fullCalModal').modal("hide");   
               });  
               
                  $('#crear').on('click', function(ev) { 
                $('#fullCalModal').modal("hide");
                var fechainicio = $('#fechaInicio').val().trim().split(/[/ :]/);
                var fechafin = $('#fechaFin').val().trim().split(/[/ :]/);
                            
                var Cfechainiciocarga = new Date(fechainicio[2],isNaN(parseInt(fechainicio[1].substring(0,2)))?fechainicio[1].substring(1,3)-1:fechainicio[1].substring(0,2)-1,fechainicio[0],fechainicio[3],fechainicio[4],fechainicio[5]);
                var Cfechafincarga = new Date(fechafin[2],isNaN(parseInt(fechafin[1].substring(0,2)))?fechafin[1].substring(1,3)-1:fechafin[1].substring(0,2)-1,fechafin[0],fechafin[3],fechafin[4],fechafin[5]);
                    
                var json = {idActividad:$('#idActividad').val(),idSala:$('#idSala').val(),FechaInicio:Cfechainiciocarga.toUTCString(), FechaFin:Cfechafincarga.toUTCString(), Ocupacion:$('#OcupacionClase').val(), Dia:0, Publicada:1};
                $.ajax({
                    type: "POST",
                    url: BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ClasesBO.php?url=crearClase'),
                    data: jQuery.param( json ),
                    contentType: "application/x-www-form-urlencoded; charset=utf-8",
                    dataType: "json",
                    async: true,

                    success: function(data, textStatus) {
                        var objeto = new Object();
                    objeto.id = data.id;        
                    objeto.title= Actividades[arrayactividades.indexOf($('#idActividad').val())].NombreActividad;
                    objeto.idActividad= $('#idActividad').val();
                    objeto.idSala= $('#idSala').val();
                    objeto.OcupacionClase= $('#OcupacionClase').val();
                    objeto.idClase= 0;
                    objeto.allDay= false;
                    objeto.start= Cfechainiciocarga;
                    objeto.end=  Cfechafincarga;
                    objeto.backgroundColor= "#"+ $('#OcupacionClase').val();
                    objeto.borderColor= "#"+ $('#OcupacionClase').val();
                    objeto.dow=[1,2,3,4];
                    
                    //$('#calendar').fullCalendar('renderEvent', objeto, true);
                    $('#calendar').fullCalendar('removeEvents' );
                    $('#calendar').fullCalendar( 'refetchEvents' );

                    },
                    error: function( jqXHR, textStatus, errorThrown ) {
                }});
                            
                      });
                  
                })

</script>
<div class="row"ng-app="Clases">
    <div ng_controller="CargaClases">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div id="botonera" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <a  ng-repeat="sala in salas" target="_self"  href="" class="border-5 col-lg-2 btn btn-info" ng_click="calendariosala(sala.idSala);" id="sala.idSala">{{sala.NombreSala}}</a>
            </div>
            
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
                            
                            <label id="title" class="control-label col-lg-6 col-md-12 col-sm-12 col-xs-12" >Detalle Clase</label>
                            <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>
                            <div class="form-group">
                            <div class="col-md-12">
                          <form role="form" name="formulario">
				<input  type="hidden" class="input-sm" name="idClase" id="idClase">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label id="title" class="control-label col-lg-6 col-md-12 col-sm-12 col-xs-12" ></label>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-6 col-md-12 col-sm-12 col-xs-12" >Actividad</label>
                                <select   name="idActividad" id="idActividad" class="input-sm col-lg-6 col-md-6 col-sm-6 col-xs-12" >	
                                    <option ng_repeat="actividad in actividades" value="{{actividad.idActividad}}">{{actividad.NombreActividad}}</option>
                                    <!--<select ng-model="selectedActividades" ng-options="actividad.NombreActividad for actividad in actividades track by actividad.idActividad"  id="idActividad" name="idActividad" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" >-->	
                                </select>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-6 col-md-12 col-sm-12 col-xs-12" >Sala</label>
                                <select   name="idSala" id="idSala" class="input-sm col-lg-6 col-md-6 col-sm-6 col-xs-12" >	
                                    <option ng_repeat="sala in salas" value="{{sala.idSala}}">{{sala.NombreSala}}</option>
                                    <!--<select ng-model="selectedSalas" ng-options="sala.NombreSala for sala in salas track by sala.idSala"  name="idSala" id="idSala" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" >-->	
                                </select>
                                </div>
				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-6 col-md-12 col-sm-12 col-xs-12" >Ocupacion</label>
                                <input class="input-sm color" id="OcupacionClase" name="OcupacionClase" required>
                                <span  class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.OcupacionClase.$dirty && formulario.OcupacionClase.$invalid">
                                    <span ng-show="formulario.OcupacionClase.$error.required">* Indique la ocupación.</span>
                                </span>
                                </div>
                                <div  class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-6 col-md-12 col-sm-12 col-xs-12" >Inicio</label>
                                <input id="fechaInicio"  type="text"  class="input-sm col-md-6 col-sm-6 col-xs-12" name="fechaInicio" required>
                                <span  class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.fechaInicio.$dirty && formulario.fechaInicio.$invalid">
                                    <span ng-show="formulario.fechaInicio.$error.required">* Fecha inicio obligatoria.</span>
                                </span>
                                </div>
                                <div  class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label col-lg-6 col-md-12 col-sm-12 col-xs-12" >Fin</label>
                                <input id="fechaFin" type="text"  class="input-sm col-md-6 col-sm-6 col-xs-12" name="fechaFin" required>
                                <span  class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.fechaFin.$dirty && formulario.fechaFin.$invalid">
                                    <span ng-show="formulario.fechaFin.$error.required">* Fecha fin obligatoria.</span>
                                </span>
                                </div>
                             </form>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                         <button id="eliminar" type="button" class="btn btn-sm btn-danger" data-action="delete"><i class="ace-icon fa fa-trash-o"></i>Eliminar Clase</button>
                         <button id="actualizar" type="button" class="btn btn-sm btn-success" data-action="actualizar" ng-disabled="formulario.$invalid"></i>Actualizar Clase</button>
                         <button id="crear" type="button" class="btn btn-sm btn-success" data-action="crear" ng-disabled="formulario.$invalid"></i>Crear Clase</button>
                         <button id ="cancelar"type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i>Cancelar</button>
                       </div>
                      </div>
                     </div>
    </div>
    

    </div>
</div><!-- /.row -->
<?php require('Pie.php'); ?>