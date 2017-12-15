<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-12
 * Time: 오후 11:39
 */
    require_once '../classes.php';

    $insertIntoObj = new chatData();
    $userinfoListObj = new loginData();
    $firstString = "user_name";
    $backString = "WHERE user_id = '".@$_SESSION['id']."'";
    $vale = $userinfoListObj->select($firstString,$backString);

    while($print = mysqli_fetch_row($vale)) {
        $pr = $print[0];
    }

    $insertIntoObj->insert(@$_POST['RoomNum'],$pr,@$_POST['userChat'], @$_SESSION['id']);
