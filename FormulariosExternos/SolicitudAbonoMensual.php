<?php require_once 'CabeceraExterna.php'; ?>
<div id="maininner" class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-sm-offset-1">
    <section id="content"><div id="system-message-container">
        </div>
        <div id="system">
            <h2>Solicitud Abono Mensual</h2>
            <form class="submission box style" id="contact-form">
                <div id="rootwizard">
                    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                        <ul class="bwizard-steps">
                            <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="false"><span class="label">1</span>Abono Mensual</a></li>
                            <li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false"><span class="label">2</span>Datos Personales</a></li>
                            <li class=""><a href="#tab3" data-toggle="tab" aria-expanded="false"><span class="label">3</span>Datos Dirección</a></li>
                                                </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1" onload="obtenerTiposAbono();">
                            <fieldset>
                                <div class="form-group has-success has-feedback">
                                    <div class="col-md-12 col-sm-12 input-group-lg">
                                        <h3>Tipo de abono </h3>
                                        <div id="tiposAbono">
                                        </div>
                                        </fieldset>
                                        <div class="col-md-offset-1">
                                            <button class="btn btn-default" type="submit">Enviar</button>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab2">
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
                                                <!--
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
                                                </div>-->
                                                <div class="col-md-5 col-sm-5 input-group-lg">
                                                    <label class="control-label" > &nbsp Mujer</label>  <input type="radio"  name="Sexo" value="M"  id="Sexo"/>
                                                    <label class="control-label" > &nbsp Hombre</label>  <input type="radio" name="Sexo" value="H" checked="checked" id="Sexo"/>
                                                </div>
                                                <div class="col-md-5 col-sm-5 input-group-lg">
                                                    <label class="control-label" > Fecha nacimiento</label><input type="date" class="form-control" name="FechaNacimiento"id="FechaNacimiento">
                                                </div>
                                                <div class="col-md-5 col-sm-5 input-group-lg">
                                                    <label class="control-label" >Tutor legal</label> <input type= "text" class="form-control" required name="TutorLegal"  value="" placeholder="Alberto Fernandez" id="TutorLegal"/>
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
                                    </div>
                                    <div class="tab-pane" id="tab3">
                                        <fieldset>
                                            <div class="col-md-10 col-sm-10 input-group-lg">
                                                <label class="control-label" >Direccion  &nbsp  </label><input type="text" class="form-control" name="Direccion" required  value="" placeholder="Calle los Emigrantes  16" id="Direccion" />  
                                            </div>
                                            <div class="col-md-5 col-sm-5 input-group-lg">
                                                <label class="control-label" >Localidad &nbsp </label><input type="text" class="form-control" name="Localidad" required  value="" placeholder="Madrid" id="Localidad"/>
                                            </div>
                                            <div class="col-md-5 col-sm-5 input-group-lg">
                                                <label class="control-label" >Codigo Postal &nbsp </label><input type="text" class="form-control" name="cp" size="5" maxlength="5"id="CP"/>
                                            </div>
                                            <div class="col-md-5 col-sm-5 input-group-lg">
                                                <label class="control-label" >&nbsp  Telefono 1 &nbsp </label> <input type="tel" class="form-control" name="telefono1" required pattern="[0-9]{9}"id="Telefono1">
                                            </div>
                                            <div class="col-md-5 col-sm-5 input-group-lg">
                                                <label class="control-label" >&nbsp  Telefono 2 &nbsp </label> <input type="tel" class="form-control" name="telefono2" required pattern="[0-9]{9}" value="Telefono" placeholder="60007287"id="Telefono2"/>   
                                            </div>
                                        </fieldset>
                                        <div class="col-md-offset-1">
                                            <button class="btn btn-default" type="submit">Enviar</button>
                                        </div>
                                    </div>
                                </div>
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