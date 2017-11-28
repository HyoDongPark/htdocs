<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-11-23
 * Time: 오후 12:44
 */

    class db_info {
        const db_url    = "localhost";
        const user_id   = "root";
        const passwd    = "qweasd45";
        const db        = "yjc_test";
    }

    $conn = new mysqli(db_info::db_url,db_info::user_id,db_info::passwd,db_info::db);

    if($conn->connect_errno) {
        echo "Failed to connect to MySQL : " . $conn->connect_error;
        exit();
    }

    $res = $conn->query("select * from customer");
    $row = $res->fetch_assoc();
