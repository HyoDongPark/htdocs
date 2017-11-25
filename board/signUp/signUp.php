<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-11-25
 * Time: 오후 1:15
 */
    include "../login/loginModel.php";

    $userId         = @$_POST['idMemberCheck'];
    $userPw         = @$_POST['pwMemberCheck'];
    $userName       = @$_POST['NameMemberCheck'];

    $obj            = new userInfo();

    $firstString    = "user_id";
    $backString     = "WHERE user_id = '$userId'";

    $result         = $obj->select($firstString, $backString);

    $tempId         = "";

    while($print    = mysqli_fetch_array($result)) {
        $tempId     = $print['user_id'];
    }

    if($tempId == $userId) {
        echo "중복";
    }
    else {
        $obj->insert($userId, $userName, $userPw);
        echo "OK";
    }
