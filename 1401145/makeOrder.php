<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-19
 * Time: 오후 4:25
 */
    include_once "dataInfo/orderList.php";

    if (session_status() == 1) {
        session_start();
    }

    $orderObj = new orderList();

    foreach (@$_SESSION as $value) {
        $orderObj->insert("test",$value[0],$value[1],$value[2]);
    }

    session_destroy();



