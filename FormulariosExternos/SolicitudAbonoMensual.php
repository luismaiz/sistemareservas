<?php require_once 'CabeceraExterna.php'; ?>
<script>
    var app = angular.module('solicitudAbonoMensual', []);
    app.controller('RegistrarSolicitudAbonoMensualController', function RegistrarSolicitudAbonoMensualController($scope, $http) {
        $scope.tiposabonos = [];
        $scope.s = {};
        $http.get("http://pfgreservas.rightwatch.es/Negocio/NegocioAdministrador/TiposAbonosBO.php?url=obtenerTiposAbono")
                .success(function (response) {

                    $scope.estado = response.estado;

                    if ($scope.estado === 'correcto')
                    {
                        $scope.tiposabonos = response.tiposAbonos;
                        document.getElementById('divSinResultados').style.display = 'none';
                    }
                    else
                    {
                        $scope.tiposabonos = [];
                        document.getElementById('divSinResultados').style.display = 'block';
                    }
                });
        $scope.avanzar = function (idTab) {
            if (idTab === 0) {
                $scope.tab1 = true;
                $scope.tab2 = false;
                $scope.tab3 = false;
            } else if (idTab === 1) {
                $scope.tab1 = false;
                $scope.tab2 = true;
                $scope.tab3 = false;
            } else if (idTab === 2) {
                $scope.tab1 = false;
                $scope.tab2 = false;
                $scope.tab3 = true;
            }
        };
        $scope.calcularFecha = function (fecha) {
            var values = fecha.split("/");
            var dia = parseInt(values[2]);
            var mes = parseInt(values[1]);
            var ano = parseInt(values[0]);

            // cogemos los valores actuales
            var fecha_hoy = new Date();
            var ahora_ano = fecha_hoy.getYear();
            var ahora_mes = fecha_hoy.getMonth() + 1;
            var ahora_dia = fecha_hoy.getDate();

            // realizamos el calculo
            var edad = (ahora_ano + 1900) - ano;
            if (ahora_mes < mes)
            {
                edad--;
            }
            if ((mes === ahora_mes) && (ahora_dia < dia))
            {
                edad--;
            }
            if (edad > 1900)
            {
                edad -= 1900;
            }
            return edad;
        };
        $scope.esMenor = function () {
            var edad = $scope.calcularFecha($scope.s.fechanacimiento);
            if (edad < 18) {
                $scope.menor = true;
            }else{
                $scope.menor = false;
            }
        };
        $scope.enviar = function () {
            $http.post("http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearSolicitud", $scope.s);
            conAjax.success(function (respuesta) {
                console.log(respuesta);
            });
        };
    });

</script>    
<div class="row" ng-app="solicitudAbonoMensual" ng-controller="RegistrarSolicitudAbonoMensualController">
    <div id="maininner" class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-sm-offset-1" >
        <section id="content"><div id="system-message-container">
            </div>
            <div >
                <h2>Solicitud Abono Mensual</h2>
                <form class="submission box style" name="solAMensual" novalidate>
                    <div class="tab-content" ng-init="tab1 = true">
                        <div class="tab-pane active" id="tab1" ng-show="tab1">
                            <ol class="breadcrumb">
                                <li class="active">Abono Mensual</li>
                            </ol>
                            <fieldset>
                                <div id="divSinResultados"></div>
                                <div class="form-group has-success has-feedback">
                                    <div class="col-md-12 col-sm-12 input-group-lg">
                                        <h3>Tipo de abono </h3>
                                        <div id="tiposAbono">
                                            <p ng-repeat="tipoabono in tiposabonos"><label class="control-label">
                                                    <input type="radio" name="tipoabono" ng-model="s.tipoabono" ng-value="{{ tipoabono.idTipoAbono}}">&nbsp; {{ tipoabono.NombreAbono}}</label><br/></p>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <ul class="pager">
                                <li class="next"><a href="" ng-click="avanzar(1);">Siguiente &rarr;</a></li>
                            </ul>
                        </div>
                        <div class="tab-pane active" ng-show="tab2" id="2">
                            <ol class="breadcrumb">
                                <li class="active">Abono Mensual</li>
                                <li class="active">Datos Personales</li>
                            </ol>
                            <fieldset>
                                <div class="form-group has-success has-feedback">
                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                        <label class="control-label" > Nombre</label><input type="text" name="nombre" ng-model="s.nombre" class="form-control" required pattern="^[a-zA-Z0-9]{4,12}$" value="" placeholder="Blanca" />
                                    </div>
                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                        <label class="control-label" > Apellidos </label><input type="text" name="apellidos" ng-model="s.apellidos" class="form-control" required pattern="^[a-zA-Z0-9]{4,12}$" value="" placeholder="Garcia" /><br />
                                    </div>
                                    <br />
                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                        <label class="control-label" > Dni</label><input type="text" name="dni" ng-model="s.dni" class="form-control" required pattern="^[a-zA-Z0-9]{4,12}$" value="" placeholder="05330762y" />
                                    </div>
                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                        <label class="control-label" >E-mail</label><input type="mail" name="mail" ng-model="s.mail" class="form-control" required pattern="^[a-zA-Z0-9-\_.]+@[a-zA-Z0-9-\_.]+\.[a-zA-Z0-9.]{2,5}$" value="" placeholder="info@developerji.com" /><br />   
                                    </div>
                                    <br />
                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                        <label class="control-label" >&nbsp Mujer</label><input type="radio" ng-model="s.sexo" name="Sexo" value="M"  id="Sexo"/>
                                        <label class="control-label" >&nbsp Hombre</label><input type="radio" ng-model="s.sexo" name="Sexo" value="H" checked="checked" id="Sexo"/>
                                    </div>
                                    <div class="col-md-5 col-sm-5 input-group-lg">
                                        <label class="control-label" >Fecha nacimiento</label><input type="date" name="fechanacimiento" ng-model="s.fechanacimiento" class="form-control" id="FechaNacimiento" ng-change="esMenor();" >
                                    </div>
                                    <div class="col-md-5 col-sm-5 input-group-lg" ng-init="tutor = false">
                                        <label class="control-label" ng-show="menor">Tutor legal</label><input type="text" name="tutor" ng-model="s.tutor" class="form-control" required name="TutorLegal" placeholder="Alberto Fernandez" id="TutorLegal" ng-show="menor"/>
                                    </div> 
                                </div>
                                <div class="col-md-12 col-sm-12 input-group-lg">
                                    <label class="control-label">
                                        <input type="checkbox" name="aceptado" value="aceptado" />Acepto los términos y condiciones</label>
                                </div>
                            </fieldset>
                            <ul class="pager">
                                <li class="previous"><a href="" ng-click="avanzar(0);">&larr; Anterior</a></li>
                                <li class="next"><a href="" ng-click="avanzar(2);">Siguiente &rarr;</a></li>
                            </ul>
                        </div>
                        <div class="tab-pane active" ng-show="tab3" id="tab3">
                            <ol class="breadcrumb">
                                <li class="active">Abono Mensual</li>
                                <li class="active">Datos Personales</li>
                                <li class="active">Datos Dirección</li>
                            </ol>
                            <fieldset>
                                <div class="col-md-10 col-sm-10 input-group-lg">
                                    <label class="control-label" >Direccion&nbsp;</label><input type="text" class="form-control" name="direccion" ng-model="s.direccion" required  value="" placeholder="Calle los Emigrantes  16" id="Direccion" />  
                                </div>
                                <div class="col-md-5 col-sm-5 input-group-lg">
                                    <label class="control-label" >Localidad&nbsp;</label><input type="text" class="form-control" name="localidad" ng-model="s.localidad" required  value="" placeholder="Madrid" id="Localidad"/>
                                </div>
                                <div class="col-md-5 col-sm-5 input-group-lg">
                                    <label class="control-label" >Codigo Postal&nbsp;</label><input type="text" class="form-control" name="cp" ng-model="s.cp" size="5" maxlength="5"id="CP"/>
                                </div>
                                <div class="col-md-5 col-sm-5 input-group-lg">
                                    <label class="control-label" >&nbsp;Telefono 1 &nbsp;</label> <input type="tel" class="form-control" name="telefono1" ng-model="s.telefono1" required pattern="[0-9]{9}"id="Telefono1">
                                </div>
                                <div class="col-md-5 col-sm-5 input-group-lg">
                                    <label class="control-label" >&nbsp; Telefono 2 &nbsp;</label> <input type="tel" class="form-control" name="telefono2" ng-model="s.telefono2" required pattern="[0-9]{9}" value="Telefono" placeholder="60007287"id="Telefono2"/>   
                                </div>
                            </fieldset>
                            <ul class="pager">
                                <li class="previous"><a href="" ng-click="avanzar(1);">&larr; Anterior</a></li>
                                <li class="next"><a href="" ng-click="enviar();">&nbsp;Enviar&nbsp;&nbsp;</a></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>     
</div>
<?php require_once 'PieExterno.php'; ?>