<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-12-19
 * Time: 오후 1:44
 */
    class connDB {
        const DB_HOST = "localhost";
        const DB_USER = "root";
        const DB_PASS = "qweasd45";
        const DB_NAME = "finalexam";

        protected $conn;

        function __construct() {
            $this->conn = new mysqli(
                self::DB_HOST,
                self::DB_USER,
                self::DB_PASS,
                self::DB_NAME
            );

            if($this->conn->errno) {
                echo "ERROR ".$this->conn->error;
                exit();
            }
        }
    }