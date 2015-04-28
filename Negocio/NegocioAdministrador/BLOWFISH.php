<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Soporta Blowfish
function comprobar(){
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
    echo "Wiii, tengo CRYPT_BLOWFISH!\n";
}
}
//Salt Aleatorio
function crypt_blowfish_bydinvaders($password, $digito = 7) {
    $set_salt = './1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $salt = sprintf('$2a$%02d$', $digito);
    for ($i = 0; $i < 22; $i++) {
        $salt .= $set_salt[mt_rand(0, 22)];
    }
    return crypt($password, $salt);
}
