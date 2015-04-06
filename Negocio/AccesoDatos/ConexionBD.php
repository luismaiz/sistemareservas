<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConexionBD
 *
 * @author Alicia Barco Oviedo 
 */
class ConexionBD extends PDO {

    private $engine = 'mysql';
    private $host = 'hostingmysql321.nominalia.com:3306';
    private $database = 'sistemareservas';
    private $username= 'pfgreservas';
    private $password = 'pfgreservas';
    private static $_instance = null;

    public function __construct() {
        $opciones = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );
        $dsn = $this->engine . ':host=' . $this->host . ';dbname=' . $this->database;
        try {
            parent::__construct($dsn, $this->username, $this->password,$opciones);
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
