<?php
    class ConnectionDB {
        private $hostname;
        private $username;
        private $password;
        private $database;
        private $port;
        private static $instance;

        private function __construct() {
            $this->hostname = "localhost";
            $this->username = "root";
            $this->password = "Mysql2021$";
            $this->database = "RapiReserva";
            $this->port = "3306";
        }

        public function getConnection() {
            return mysqli_connect($this->hostname, $this->username, $this->password, $this->database, $this->port);
        }

        public static function getInstanceConnection() {
            if(!isset(self::$instance)) {
                self::$instance = new self;
            }
            return self::$instance;
        }
    }