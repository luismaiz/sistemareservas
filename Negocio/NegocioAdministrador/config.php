<?php
session_start();

//Configuracion qr
$URL_QR='http://vw15115.dinaserver.com/hosting/reservascentro.es-web/sistemareservas/Frontal/Reservas.php';
$TEMP_DIR=dirname(__FILE__) . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;
$QR_DIR='temp/';
$QR_LIB='../UtilidadesNegocio/phpqrcode/qrlib.php';


//Configuración mail
$MAIL_HOST='mail.reservascentro.es';
$MAIL_USERNAME='reservascentro@reservascentro.es';
$MAIL_PASS='rjYaRJPl12';
$MAIL_FROM='reservascentro@reservascentro.es';
$MAIL_NAME='Reservas Centro';


?>