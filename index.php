<?php

$no_visible_elements = true;
include('Frontal/CabeceraInicio.php');
?>
<script>

    var Ajax = new AjaxObj();

    function login() {
        var Url = "http://localhost/PFC/sistemareservas/Negocio/LoginBO.php?url=iniciarSesion";
        var Params = 'NombreUsuario=' + document.getElementById("NombreUsuario").value + '&Password=' + document.getElementById("Password").value;

        Ajax.open("POST", Url, false);
        Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        Ajax.send(Params); // Enviamos los datos

        var RespTxt = Ajax.responseText;

        alert("Resultado:" + RespTxt);

        var Clase = eval('(' + RespTxt + ')');
        if (Clase) {
            alert(Clase);
            var tipo = parseInt((Clase.TipoUsuario));
            switch (tipo) {
                case 1:
                    location.href = "Frontal\InicioAdministrador.php";
                    break;
                case 2:
                    location.href = "Frontal\InicioMonitor.php";
                    break;
                case 3:
                    location.href = "Frontal\InicioGestor.php";
                    break;
            }
        }
    }

</script>

<div class="row">
    <div class="col-md-12 center login-header">
        <h2>Sistema de reservas FMN</h2>
    </div>
    <!--/span-->
</div><!--/row-->

<div class="row">
    <div class="well col-md-5 center login-box">
        <div class="alert alert-info">
            Introduzca el usuario y contraseña.
        </div>
        <form class="form-horizontal">
            <fieldset>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                    <input type="text" class="form-control" placeholder="Usuario" name="NombreUsuario" id="NombreUsuario">
                </div>
                <div class="clearfix"></div><br>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                    <input type="password" class="form-control" placeholder="Contraseña" name="Password" id="Password">
                </div>
                <div class="clearfix"></div>

                <div class="input-prepend">
                    <label class="remember" for="remember"><input type="checkbox" id="remember"> Recordar</label>
                </div>
                <div class="clearfix"></div>

                <p class="center col-md-5">
                    <button class="btn btn-primary" onclick="login()">Login</button>
                </p>
            </fieldset>
        </form>
    </div>
    <!--/span-->
</div><!--/row-->
<?php require('Frontal/PieInicio.php'); ?>