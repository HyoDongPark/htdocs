<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-11
 * Time: 오전 8:08
 */
    class foundationDatabase {
        const DATA_LOCAL            = "localhost";
        const DATA_USER             = "root";
        const DATA_PASS             = "qweasd45";
        const DATA_NAME             = "chat";
        const DATA_PORT             = "3306";

        protected $connection;

        function __construct() {
            $this->connection       = new mysqli(
                foundationData::DATA_LOCAL,
                foundationData::DATA_USER,
                foundationData::DATA_PASS,
                foundationData::DATA_NAME,
                foundationData::DATA_PORT
            );

            if($this->connection->connect_errno) {
                log($this->connection->connect_error);
                exit();
            }
        }

        function __destruct() {
            // TODO: Implement __destruct() method.
            $this->connection->close();
        }
    }