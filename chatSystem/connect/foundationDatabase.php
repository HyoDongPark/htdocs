<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-11
 * Time: 오전 8:08
 */
    class foundationDatabase {
        protected $DATA_LOCAL       = "localhost";
        protected $DATA_USER        = "root";
        protected $DATA_PASS        = "qweasd45";
        protected $DATA_NAME        = "chatsystem";
        protected $DATA_PORT        = "3306";

        protected $connection;

        function __construct() {
            $this->connection       = new mysqli(
                $this->DATA_LOCAL,
                $this->DATA_USER,
                $this->DATA_PASS,
                $this->DATA_NAME,
                $this->DATA_PORT
            );

            if($this->connection->connect_errno) {
                log($this->connection->connect_error);
                exit();
            }
        }
        function __destruct()
        {
            $this->connection->close();
        }
    }