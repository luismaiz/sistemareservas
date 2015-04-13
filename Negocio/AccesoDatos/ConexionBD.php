<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'sec-config.php';

/**
 * Description of ConexionBD
 *
 * @author Alicia Barco Oviedo 
 */
class ConexionBD extends PDO {

    private static $_instance = null;

    public function __construct() {
        $opciones = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );
        $dsn = SELF::ENGINE . ':host=' . SELF::HOST . ';dbname=' . SELF::DATABASE;
        try {
            parent::__construct($dsn, SELF::USER, SELF::PASSWORD, $opciones);
        } catch (PDOException $e) {
            echo 'Error en Conexión a la Base de Datos. Detalle: ' . $e->getMessage();
            exit;
        }
    }

    public function __destruct() {
        
    }

    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new ConexionBD();
        }
        return self::$_instance;
    }

}
