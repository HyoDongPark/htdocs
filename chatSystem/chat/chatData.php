<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-11
 * Time: 오후 1:23
 */
    require_once '../classes.php';

    class chatData extends foundationDatabase {
        private $check = 0;

        function tableNameSearch($userId)
        {
            $sql                = "SELECT room_name, room_num FROM userinfo WHERE user_id = '$userId'";
            $such               = $this->connection->query($sql);

            $room_name          = "";
            $room_num           = 0;

            while ($print       = mysqli_fetch_array($such)) {
                $room_num       = $print[room_num];
                $room_name      = $print[room_name];
            }

            $tableName          = $room_name."_".$room_num;

            return $tableName;
        }

        function create($roomName, $userId) {
            $sql                = "CALL chatsystem.room_make('$roomName', '$userId',@RESULT)";
            $this->connection->query($sql);
            $sql                = "SELECT @RESULT";
            $this->check        = $this->connection->query($sql);

            while($print        = mysqli_fetch_row($this->check)) {
                $temp           = $print[0];
            }
            return $temp;
        }

        function insert($roomNum, $userName, $userChat, $userId) {
            $tableName          = $this->tableNameSearch($userId);

            $sql                = "INSERT INTO $tableName ";
            $sql               .= "(room_num,user_name,user_chat) ";
            $sql               .= "VALUES ($roomNum,'$userName','$userChat')";

            $this->check        = $this->connection->query($sql);

            return $this->check;
        }

        function select($intoTime,$userId) {
            $tableName          = $this->tableNameSearch($userId);

            $sql                = "SELECT  user_name, user_chat";
            $sql               .= "FROM $tableName ";
            $sql               .= "WHERE user_chat_time > $intoTime";

            $this->check        = $this->connection->query($sql);

            return $this->check;
        }

        function delete($userId) {
            $tableName          = $this->tableNameSearch($userId);

            $sql                = "DROP TABLE $tableName";

            $this->check        = $this->connection->query($sql);

            return $this->check;
        }
    }