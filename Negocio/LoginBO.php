<?php

require_once 'Entidades/UsuarioModel.class.php';
require_once 'AccesoDatos/ConexionBD.php';
require_once 'BLOWFISH.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$nom = htmlspecialchars(trim($_POST['Nombre']));
$pas = htmlspecialchars(trim($_POST['Password']));
$pass = crypt_blowfish_bydinvaders($pas);

$con = new ConexionBD();
$usuario = new UsuarioModel();

$filter = array();
$filer['NombreUsuario'] = $nom;
$filter['Password'] = $pass;
$user = $usuario->findByFilter($con, $filter);

if ($user) {
    echo 'Login Correcto';
    switch ($user->getFieldTypes()) {
        case 1:
            $_SESSION['User'] = $nom;
            session_start();
            header('Location: MonitorBO.php');

            break;

        case 2:
            $_SESSION['User'] = $nom;
            session_start();
            header('Location: AdministradorBO.php');
            break;

        case 3:
            $_SESSION['User'] = $nom;
            session_start();
            header('Location: GestorBO.php');
            break;
    }
} else {
    echo 'Los datos de conexión no son correctos';
}
