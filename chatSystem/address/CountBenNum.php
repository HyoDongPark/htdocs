<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-12
 * Time: 오전 9:49
 */
    require_once '../classes.php';

    @session_start();

    if(is_null($_SESSION['Checked'])) {
        $_SESSION['Checked']    = 0;
    }
    else if($_SESSION['Checked'] == 3) {
        $hostname               = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $objBen                 = new addressBen();
        $objBen->insert($hostname);

        $result = $objBen->select();

        include_once "checkedBen.php";
    }
    else {
        $_SESSION['Checked']    = $_SESSION['Checked'] + 1;
    }