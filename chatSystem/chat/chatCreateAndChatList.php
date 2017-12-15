<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-12
 * Time: 오후 1:20
 */
    require_once '../classes.php';

    @session_start();
    $chatOrUserListObj      = new chatData();

    $checked                = null;

    if(!is_null(@$_POST['RoomTitle']) && !is_null(@$_SESSION['id'])) {
       $checked             = $chatOrUserListObj->create($_POST['RoomTitle'], $_SESSION['id']);

       if($checked == 0)
           echo "Y";
       else
           echo "N";
    }
    else {

        $rainbowColor       = array("red","orange","yellow","blue","navy","purple");
        $tempColor          = 0;
        $tempTime           = null;

        $chatUserListObj    = new chatUserList();

        $firstString        = "room_insert";

        $result             = $chatUserListObj->select($firstString, @$_SESSION['id']);

        while($print        = mysqli_fetch_array($result)) {
            $tempTime       = $print[room_insert];
        }
        $firstString        = "user_name, user_chat";
        $checked            = $chatOrUserListObj->select($firstString, $tempTime, $_SESSION['id']);

        while ($print       = mysqli_fetch_array($checked)) {
            if($tempColor == count($rainbowColor)) {
                $tempColor  = 0;
            }
            echo "<div style='text-align: center; border: 2px solid $rainbowColor[$tempColor]'>
                    <font size='15' color='$rainbowColor[$tempColor]'>$print[user_name]</font>
                    <hr>
                    <font size='15' color='#a9a9a9'>$print[user_chat]</font>
                  </div>";
            $tempColor++;
        }
    }
