<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-11-24
 * Time: 오후 8:25
 */
class connectInfo {
    protected $DATABASE_HOST                = "localhost";
    protected $DATABASE_USER_ID             = "root";
    protected $DATABASE_USER_PASSWORD       = "qweasd45";
    protected $DATABASE_NAME                = "board";
    protected $DATABASE_PORT                = "3306";
    protected $connect;

    function __construct() {
        $this->connect = new mysqli(
            $this->DATABASE_HOST,
            $this->DATABASE_USER_ID,
            $this->DATABASE_USER_PASSWORD,
            $this->DATABASE_NAME,
            $this->DATABASE_PORT
        );
        if($this->connect->connect_errno) {
            echo "연결 실패 : ".$this->connect->connect_error."<br>";
            exit();
        }
    }
    function __destruct() {
        if($this->connect == null || $this->connect == false)
            $this->connect->close();
    }
}