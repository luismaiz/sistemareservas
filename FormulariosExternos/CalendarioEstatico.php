<?php require('CabeceraExterna.php'); ?>
<!-- inline scripts related to this page -->
<script type="text/javascript">
    var Ajax = new AjaxObj();
    var Actividades;
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
                                
				$scope.salas = JSON.parse(Ajax.responseText).salas;
				Salas = $scope.salas;
				}
            };
            $scope.obtenerSalas();
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
        
        /* initialize the calendar
-----------------------------------------------------------------*/
        var CalLoading = true;
        var lastView;;
        $('#calendar').fullCalendar({
            editable:false,
            minTime: "09:00",
            maxTime: "22:00",
            allDaySlot:false,
            timeFormat: 'H:mm' ,
            lazyFetching: false,
            hiddenDays: [ 0 ],
                        
            buttonHtml: {
                prev: '<i class="ace-icon fa fa-chevron-left"></i>',
                next: '<i class="ace-icon fa fa-chevron-right"></i>'
            },
	
            header: {
                left: 'prev,next hoy',
                center: 'title',
                right: ''
            },
            eventLimit: true, // allow "more" link when too many events
            defaultView: 'agendaWeek',            
                        
            events: function(start, end, timezone, callback) {
                            
                $.ajax({
                    url: BASE_URL.concat('sistemareservas/Negocio/NegocioAdministrador/ClasesBO.php?url=obtenerClases'),
                    dataType: "json",
                    data: "",
                    async: false,
                    success: function(doc) {
                        
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
                        }
						
                        callback(events);
                    }
                });
            },
                       
            
            
            eventClick: function(calEvent, jsEvent, view) { 
            
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
            
                                }                                   
                   
                    
                  });
            })

</script>
<div class="row"ng-app="Clases">
    <div ng_controller="CargaClases">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <div class="space"></div>
                <div id="calendar"></div>
            </div>
            <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12">
                
            </div>
            
        </div>
    </div><!-- /.col -->
    
    <div id="fullCalModal" class="modal fade" style="display:none;">
                      <div class="modal-dialog">
                       <div class="modal-content" style="background-color: #005580">
                        <div class="modal-body" >
                            
                            <!--<label style="color: #ffffff" id="title" class="control-label col-lg-6 col-md-12 col-sm-12 col-xs-12" >Clase</label>-->
                            <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>
                            <div class="form-group">
                            <div class="col-md-12">
                          <form role="form" name="formulario">
				<input  type="hidden" class="input-sm" name="idClase" id="idClase">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label style="color: #ffffff" id="title" class="control-label col-lg-6 col-md-12 col-sm-12 col-xs-12" ></label>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label style="color: #ffffff" class="control-label" >Actividad</label>
                                <select ng-disabled="true"  name="idActividad" id="idActividad" class="form-control" >	
                                    <option ng_repeat="actividad in actividades" value="{{actividad.idActividad}}">{{actividad.NombreActividad}}</option>
                                    <!--<select ng-model="selectedActividades" ng-options="actividad.NombreActividad for actividad in actividades track by actividad.idActividad"  id="idActividad" name="idActividad" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" >-->	
                                </select>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label style="color: #ffffff" class="control-label" >Sala</label>
                                <select  ng-disabled="true" name="idSala" id="idSala" class="form-control" >	
                                    <option ng_repeat="sala in salas" value="{{sala.idSala}}">{{sala.NombreSala}}</option>
                                    <!--<select ng-model="selectedSalas" ng-options="sala.NombreSala for sala in salas track by sala.idSala"  name="idSala" id="idSala" class="input-sm col-lg-4 col-md-4 col-sm-6 col-xs-12" >-->	
                                </select>
                                </div>
                                <div  class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label style="color: #ffffff" class="control-label" >Inicio</label>
                                <input ng-disabled="true" id="fechaInicio"  type="text"  class="form-control" name="fechaInicio" required>
                                <span  class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.fechaInicio.$dirty && formulario.fechaInicio.$invalid">
                                    
                                </span>
                                </div>
                                <div  class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label style="color: #ffffff" class="control-label" >Fin</label>
                                <input ng-disabled="true" id="fechaFin" type="text"  class="form-control" name="fechaFin" required>
                                <span  class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="color:red" ng-show="formulario.fechaFin.$dirty && formulario.fechaFin.$invalid">
                                    
                                </span>
                                </div>
                             </form>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                         <button id ="cancelar"type="button" class="btn btn-Default" data-dismiss="modal"><i class="ace-icon fa fa-times"></i>Cancelar</button>
                       </div>
                      </div>
                     </div>
    </div>
    

    </div>
</div><!-- /.row -->
<?php require('PieExterno.php'); ?>