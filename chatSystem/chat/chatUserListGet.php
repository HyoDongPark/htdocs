<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-12
 * Time: 오후 8:40
 */
    require_once '../classes.php';
    @session_start();
    $userChatListObj            = new chatUserList();
    if(@$_POST['RoomNum'] && @$_SESSION['id']) {

        $userCheckInfoObj           = new loginData();
        $firstString                = "user_name";
        $backString                 = "WHERE user_id = '".@$_SESSION['id']."'";
        $checked                    = $userCheckInfoObj->select($firstString,$backString);

        while ($print               = mysqli_fetch_row($checked)) {
            $tempUserName           = $print[0];
        }
        $checked                    = $userChatListObj->insert(@$_POST['RoomNum'], $tempUserName, @$_SESSION['id']);
        if(!is_null($checked) || $checked != false) {
            echo "Y";
        }
        else {
            exit();
        }
    }
    else {

        $firstString                = "user_name, room_master";
        $result                     = $userChatListObj->select($firstString, $_SESSION['id']);

        while($print                = mysqli_fetch_array($result)) {
            echo "<tr>
                <td>$print[user_name]</td>
                <td>$print[room_master]</td>
              </tr>";
        }
    }