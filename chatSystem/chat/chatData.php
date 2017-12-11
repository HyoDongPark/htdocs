<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-11
 * Time: 오후 1:23
 */
    include "../connect/foundationDatabase.php";

    class chatData extends foundationDatabase {
        private $check;

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
            $sql                = "CALL room_make($roomName, $userId, $this->check)";

            $this->check        = $this->connection->query($sql);
        }

        function insert($roomNum, $userName, $userChat, $userId) {
            $tableName          = $this->tableNameSearch($userId);
            $tableNameUserList  = $tableName."_user";

        }

        function select() {

        }

        function update() {

        }

        function delete() {

        }
    }