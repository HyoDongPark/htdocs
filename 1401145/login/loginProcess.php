<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-12-19
 * Time: 오후 1:43
 */
    include_once "../dataInfo/userInfo.php";

    if (session_status()==1) {
        session_start();
    }

    $idValue            = $_POST['idValue'];
    $passValue          = $_POST['passValue'];

    $userObj            = new userInfo();

    $firstString        = "userid, password";
    $backString         = "userid = '$idValue'";

    $checkedValue       = $userObj->select($firstString, $backString);

    if($checkedValue == false) {
        exit();
    }
    else {
        while($print = mysqli_fetch_array($checkedValue)) {
            @$tempId    = @$print[userid];
            @$tempPass  = @$print[password];
        }

        if($tempId == $idValue && $tempPass == $passValue) {
            echo "Y";
        }
        else {
            echo "N";
        }
    }