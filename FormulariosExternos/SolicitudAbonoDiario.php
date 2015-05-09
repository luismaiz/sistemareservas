<?php require_once 'CabeceraExterna.php'; ?>
<script>
    var app = angular.module('solicitudAbonoDiario', []);
    app.controller('RegistrarSolicitudAbonoDiarioController', function RegistrarSolicitudAbonoDiarioController($scope, $http) {
        $scope.s = {};
        $scope.enviar = function(){
         $http.post("http://localhost/sistemareservas/Negocio/NegocioAdministrador/AdministradorBO.php?url=crearSolicitud", $.param($scope.s));
        conAjax.success(function (respuesta) {
            console.log(respuesta);
        });           
        };
    });
</script>
<div class="row" ng-app="solicitudAbonoDiario" ng-controller="RegistrarSolicitudAbonoDiarioController">
    <div id="maininner" class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-sm-offset-1">
        <section id="content"><div id="system-message-container">
            </div>
            <div id="system">
                <h2>Solicitud Abono Diario</h2>
                <form class="submission box style" name="solADiario" novalidate>
                    <fieldset>
                        <div class="form-group has-success has-feedback">
                            <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label" > Nombre</label><input type="text" name="nombre" ng-models="s.nombre" class="form-control" required pattern="^[a-zA-Z0-9]{4,12}$" value="" placeholder="Blanca" />
                            </div>
                            <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label" > Apellidos </label><input type="text" name="apellidos" ng-model="s.apellidos" class="form-control" required pattern="^[a-zA-Z0-9]{4,12}$" value="" placeholder="Garcia" />
                                <br />
                            </div>
                            <br />
                            <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label" >Dni</label><input type="text" name="dni" ng-model="s.dni" class="form-control" required pattern="^[a-zA-Z0-9]{4,12}$" value="" placeholder="05330762y" />
                            </div>
                            <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label" >E-mail</label><input type="email" name="mail" ng-model="s.mail" class="form-control" required pattern="^[a-zA-Z0-9-\_.]+@[a-zA-Z0-9-\_.]+\.[a-zA-Z0-9.]{2,5}$" value="" placeholder="info@developerji.com" /><br />
                            </div>
                            <br />
                            <div class="col-md-3 col-sm-3 input-group-lg">
                                <label class="control-label">Escribe el número que ves:</label>
                                <input type="text" name="captcha" ng-model="captcha" class="form-control" id="txtCaptcha" style=" text-align:center; border:none; font-weight: bold; font-family:Modern"  />
                            </div>
                            <div class="col-md-2 col-sm-2 input-group-lg">
                                <label class="control-label">&nbsp;</label>
                                <input type="button" class="form-control" id="btnrefresh" value="Refresh" onclick="DrawCaptcha();" />
                            </div>
                            <div class="col-md-5 col-sm-5 input-group-lg">
                                <label class="control-label">&nbsp;</label>
                                <input type="text" name="recaptcha" ng-model="recaptcha" class="form-control" id="resCaptcha"><br />
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 input-group-lg">
                            <label class="control-label">
                                <input type="checkbox" name="aceptado" ng-model="aceptado" value="aceptado" />&nbsp;Acepto los términos y condiciones</label>
                        </div>
                    </fieldset>
                    <div class="col-md-offset-1">
                        <button class="btn btn-default btn-lg" type="submit" ng-click="enviar();">Enviar</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <!-- maininner end -->
    <script type="text/javascript">

                function DrawCaptcha()
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
                }
    </script>
</div>
<?php require_once 'PieExterno.php'; ?>
