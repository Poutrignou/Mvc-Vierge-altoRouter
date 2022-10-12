<?php

abstract class Model {

    protected $db;
    protected static $instance = null;

    protected function __construct() {
        $dsn = "mysql:host=localhost;dbname=no_wayste";
        $login = "root";
        $password = "";

        $this->db = new PDO($dsn, $login, $password);
        $this->db->query("SET NAMES 'utf8'");
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected static abstract function getModel();

}