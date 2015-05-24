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
<div class="row">
    <div id="maininner" class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-sm-offset-1">
        <section id="content"><div id="system-message-container">
            </div>
            <div id="system">
                <h2>Solicitud Abono Diario</h2>				
                <form class="submission box style" name="solADiario" novalidate action="https://www.sandbox.paypal.com/cgibin/webscr" method=post>
                    <fieldset>
                        <div class="form-group has-success has-feedback">						
                            <input name="cmd" type="hidden" value="_cart" /> <!-- comprar varios productos -->
                            <input name="upload" type="hidden" value="1" /> <!--  -->
                            <input name="business" type="hidden" value="businesstest@pfgreservas.com" /> <!-- cuenta vendedor -->
                            <input name="shopping_url" type="hidden" value="http://pfgreservas.rigthwatch.es" /> <!-- dirección tienda -->
                            <input name="currency_code" type="hidden" value="EUR" /> <!-- tipo moneda -->
                            <input name="return" type="hidden" value=""> <!-- pago realizado -->
                            <input name="cancel_return" type="hidden" value=""> <!-- pago no realizado -->
                            <input name="notify_url" type="hidden" value="">  <!-- control de pago -->
                            <input type="hidden" name="no_shipping" value="1"> <!-- no pedir direccion de entrega -->
                            <input name="rm" type="hidden" value="1"> <!-- numero de productos  -->
                            <!--AbonoDiario ; Nombre: AbonoDiario ; Valor : 10.05 , Cantidad : 1<br>-->
                            <input name="item_number_1" type="hidden" value="AbonoDiario"> <!-- identificador del producto -->
                            <input name="item_name_1" type="hidden" value="AbonoDiario">  <!-- nombre del producto -->
                            <input name="amount_1" type="hidden" value="10.05">  <!-- precio del producto -->
                            <input name="quantity_1" type="hidden" value="1">  <!-- cantidad del producto -->
                        </div>

                    </fieldset>
                    <div class="col-md-offset-1">                        
                        <input class="btn btn-default btn-lg" type="submit" value="PayPal"/>
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
