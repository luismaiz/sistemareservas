<?php

$no_visible_elements = true;
include('Frontal/CabeceraInicio.php');
?>
<script>

    var Ajax = new AjaxObj();

    function login() {
        var Url = "http://localhost/sistemareservas/Negocio/LoginBO.php?url=iniciarSesion";
        var Params = 'NombreUsuario=' + document.getElementById("NombreUsuario").value + '&Password=' + document.getElementById("Password").value;

        Ajax.open("POST", Url, false);
        Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        Ajax.send(Params); // Enviamos los datos

        var RespTxt = Ajax.responseText;

        alert(RespTxt);

        var Clase = eval('(' + RespTxt + ')');
        
        if (Clase) {
            var tipo = parseInt((Clase.Usuario[0].TipoUsuario));
            switch (tipo) {
                case 1:
                    window.location = 'Frontal\\InicioAdministrador.php';
                    return false;
                    break;
                case 2:
                    window.location = 'Frontal\\InicioMonitor.php';
                    return false;
                    break;
                case 3:
                    window.location = 'Frontal\\InicioGestor.php';
                    return false;
                    break;
            }
        }
        return false;
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
        <form class="form-horizontal" onsubmit="return login();">
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
                    <button class="btn btn-primary" >Login</button>
                    
                </p>
            </fieldset>
        </form>
    </div>
    <!--/span-->
</div><!--/row-->
<?php require('Frontal/PieInicio.php'); ?>