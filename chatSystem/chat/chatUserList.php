<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-11
 * Time: 오후 8:06
 */
    include "../connect/foundationDatabase.php";

    class chatUserList extends foundationDatabase {

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

            $tableName          = $room_name."_".$room_num."_user";

            return $tableName;
        }

        function insert() {

        }

        function select() {

        }

        function update() {

        }

        function delete() {

        }
    }