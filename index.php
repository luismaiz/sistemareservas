<?php
require 'FrontalGlobal/header.php';
?>
<form role="form" action="LoginBO.php" method="post" name="inicio" id="inicioSesion">
    <label>Usuario</label>
    <input id="nombre" name="Nombre" type="text" size="30" maxlength="40" required placeholder="Usuario">
    <label>Contraseña</label>
    <input id="password" name="Password" type="password" size="30" maxlength="40" required placeholder="Contraseña">
    <button type="submit" class="btn btn-warning btn-lg" id="boton">Entrar</button>
</form>
<?php
require 'FrontalGlobal/footer.php';
