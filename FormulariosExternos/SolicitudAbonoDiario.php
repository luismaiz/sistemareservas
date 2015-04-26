<?php require_once 'CabeceraExterna.php'; ?>
<div id="maininner" class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-sm-offset-1">
    <section id="content"><div id="system-message-container">
        </div>
        <div id="system">
            <h2>Solicitud Abono Diario</h2>
            <form class="submission box style" id="contact-form">
                <fieldset>
                    <div class="form-group has-success has-feedback">
                        <div class="col-md-5 col-sm-5 input-group-lg">
                            <label class="control-label" > Nombre</label><input type="text" class="form-control" required pattern="^[a-zA-Z0-9]{4,12}$" value="" placeholder="Blanca" />
                        </div>
                        <div class="col-md-5 col-sm-5 input-group-lg">
                            <label class="control-label" > Apellidos </label><input type="text" class="form-control" required pattern="^[a-zA-Z0-9]{4,12}$" value="" placeholder="Garcia" /><br />
                        </div>
                        <br />
                        <div class="col-md-5 col-sm-5 input-group-lg">
                            <label class="control-label" > Dni</label><input type="text" class="form-control" required pattern="^[a-zA-Z0-9]{4,12}$" value="" placeholder="05330762y" />
                        </div>
                        <div class="col-md-5 col-sm-5 input-group-lg">
                            <label class="control-label" >E-mail</label><input type="text" class="form-control" required pattern="^[a-zA-Z0-9-\_.]+@[a-zA-Z0-9-\_.]+\.[a-zA-Z0-9.]{2,5}$" value="" placeholder="info@developerji.com" /><br />   
                        </div>
                        <br />
                        <div class="col-md-3 col-sm-3 input-group-lg">
                            <label class="control-label">Escribe el número que ves:</label>
                            <input type="text" class="form-control" id="txtCaptcha"  />
                        </div>
                        <div class="col-md-2 col-sm-2 input-group-lg">
                            <label class="control-label">&nbsp;</label>
                            <input type="button" class="form-control" id="btnrefresh" value="Refresh" onclick="DrawCaptcha();" />
                        </div>
                        <div class="col-md-5 col-sm-5 input-group-lg">
                            <label class="control-label">&nbsp;</label>
                            <input type="text" class="form-control" id="resCaptcha">
                        </div>
                                                    </div>
                            <div class="col-md-12 col-sm-12 input-group-lg">
                        <label class="control-label">
                            <input type="checkbox" name="aceptado" value="aceptado" />Acepto los términos y condiciones</label>
                    </div>
                </fieldset>
                <div class="col-md-offset-1">
                    <button class="btn btn-default" type="submit">Enviar</button>
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
<?php require_once 'PieExterno.php'; ?>
