<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-12
 * Time: 오전 8:30
 */
    require_once '../classes.php';
    @session_start();

    $loginObj                   = new loginData();

    if(!is_null(@$_POST['IdValue']) && !is_null(@$_POST['PwValue'])) {
        $id                     = @$_POST['IdValue'];
        $pw                     = @$_POST['PwValue'];

        $firstString            = "user_id, password";
        $backString             = "WHERE user_id = '$id' and password = '$pw'";

        $result                 = $loginObj->select($firstString,$backString);

        if(is_null($result) || $result == false) {
            echo "N";
        }
        else {
            @$_SESSION['id']     = $id;
            @$_SESSION['pw']     = $pw;
            echo "Y";
        }
    }
    else if(!is_null(@$_POST['NewIdValue']) &&
            !is_null(@$_POST['NewPwValue']) &&
            !is_null(@$_POST['NewNicValue'])) {

        $result                 = $loginObj->insert(
                                        @$_POST['NewIdValue'],
                                        @$_POST['NewPwValue'],
                                        @$_POST['NewNicValue']
                                    );
        if(is_null($result) || $result == false) {
            echo "N";
        }
        else {
            echo "Y";
        }
    }