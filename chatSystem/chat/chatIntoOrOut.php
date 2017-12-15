<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-12
 * Time: 오후 9:05
 */
    require_once '../classes.php';

    @session_start();

    if(@$_POST['RoomNum'] && @$_SESSION['id']) {
        $checked = 0;

        $userObj                    = new loginData();
        $chatListObj                = new chatList();
        $chatDataObj                = new chatData();
        $chatUserListObj            = new chatUserList();

        $firstString                = "room_name";
        $backString                 = "WHERE room_num = ".@$_POST['RoomNum'];

        $checked                    = $chatListObj->select($firstString, $backString);

        if(!is_null($checked) || $checked != false) {
            while ($result          = mysqli_fetch_array($checked)) {
                $tempRoomName       = $result[room_name];
            }
        }
        else {
            exit();
        }
        $SetUserUpdate              = "room_num  = ".@$_POST['RoomNum'].", ";
        $SetUserUpdate             .= "room_name = '$tempRoomName'";
        $checked                    = $userObj->update($SetUserUpdate, @$_SESSION['id']);
        if(!is_null($checked) || $checked != false) {
            $checked                = $chatUserListObj->insert(@$_POST['RoomNum'], $tempRoomName, @$_SESSION['id']);
            if(!is_null($checked) || $checked != false) {
                $tempNum            = 0;
                $firstString        = "count(*)";
                $checked            = $chatUserListObj->select($firstString, @$_SESSION['id']);
                while ($print       = mysqli_fetch_row($checked)) {
                    $tempNum        = $print[0];
                }
                $checked            = $chatListObj->update("",$tempNum,@$_POST['RoomNum']);
                if(!is_null($checked) || $checked != false) {
                    echo "Y";
                }
                else {
                    exit();
                }
            }
            else {
                exit();
            }
        }
        else {
            exit();
        }
    }
    else {

        $checked = 0;

        $userObj = new loginData();// 유저 정보
        $chatListObj = new chatList(); //방 리스트
        $chatDataObj = new chatData(); //동적 채팅방
        $chatUserListObj = new chatUserList();//동적 유저리스트

        $tempRoomName;
        $tempRoomNum;
        $tempRoomMaster;

        $tableName;
        $tableUserListName;

        $firstString = "user_num, user_name, user_master";
        $backString = "WHERE user_id = '" . @$_SESSION['id'] . "'";
        $checked = $userObj->select($firstString, $backString);

        if (!is_null($checked) || $checked != false) {
            while ($print = mysqli_fetch_array($checked)) {
                $tempRoomNum = $print[room_num];
                $tempRoomName = $print[user_name];
                $tempRoomMaster = $print[user_master];
            }
        }

        $firstString = "count(*)";

        $checked = $chatUserListObj->select($firstString, @$_SESSION['id']);
        $peopleNum = 0;
        while ($print = mysqli_fetch_row($checked)) {
            $peopleNum = $print[0];
        }

        if ($tempRoomMaster == "master" && $peopleNum == 1) {
            $tableName = $chatDataObj->tableNameSearch(@$_SESSION['id']);
            $tableUserListName = $chatUserListObj->tableNameSearch(@$_SESSION['id']);

            $sql = "DROP TABLE $tableName, $tableUserListName";
            $checked = $chatListObj->delete($tempRoomNum);
            if (!is_null($checked) || $checked != false) {
                $setValue = "room_name = null, room_master = null";
                $userObj->update($setValue, @$_SESSION['id']);

                echo "Y";
            } else {
                exit();
            }
        } else if ($tempRoomMaster == "master" && $peopleNum > 1) {
            $tableName = $chatDataObj->tableNameSearch(@$_SESSION['id']);
            $tableUserListName = $chatUserListObj->tableNameSearch(@$_SESSION['id']);

            $checked = $chatUserListObj->delete($tempRoomName, @$_SESSION['id']);
            if (!is_null($checked) || $checked != false) {
                $checked = $chatUserListObj->update(@$_SESSION['id']);
                if (!is_null($checked) || $checked != false) {
                    $firstString = "user_name";
                    $backString = "room_master = 'master'";
                    $checked = $chatUserListObj->selectAll($firstString, $backString, $tableName);
                    if (!is_null($checked) || $checked != false) {
                        while ($print = mysqli_fetch_row($checked)) {
                            $roomMasterName = $print[0];
                        }
                        $firstString = "user_id";
                        $backString = "WHERE user_name = '$roomMasterName'";
                        $checked = $userObj->select($firstString, $backString);
                        if (!is_null($checked) || $checked != false) {
                            while ($print   = mysqli_fetch_row($checked)) {
                                $tempUserId = $print[0];
                            }
                            $updateValue    = "room_master = 'master'";
                            $checked        = $userObj->update($updateValue, $tempUserId);
                            if (!is_null($checked) || $checked != false) {
                                $setValue = "room_num = null, room_name = null, room_master = null";
                                $userObj->update($setValue, @$_SESSION['id']);
                            }
                        }
                    }
                }
            } else {
                $checked = $chatUserListObj->delete($tempRoomName, @$_SESSION['id']);
                if (!is_null($checked) || $checked != false) {
                    $setValue = "room_num = null, room_name = null, room_master = null";
                    $userObj->update($setValue, @$_SESSION['id']);
                }
            }
        }
    }