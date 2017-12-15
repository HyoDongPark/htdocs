<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-11
 * Time: 오후 8:06
 */
    require_once '../classes.php';

    class chatUserList extends foundationDatabase {
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

            $tableName          = $room_name."_".$room_num."_user";

            return $tableName;
        }

        function insert($roomNum, $userName, $userId) {
            $tableName          = $this->tableNameSearch($userId);

            $result             = $this->select("COUNT(*)", $userId);

            $print              = mysqli_fetch_row($result);

            $intoNum            = $print[0];

            $intoNum++;

            $sql                = "INSERT INTO $tableName ";
            $sql               .= "(room_num, user_name, room_position) ";
            $sql               .= "VALUES ($roomNum, '$userName', $intoNum)";

            $this->check        = $this->connection->query($sql);

            return $this->check;
        }

        function select($firstString,$userId) {
            $tableName          = $this->tableNameSearch($userId);
            $sql                = "SELECT $firstString FROM $tableName";
            $this->check        = $this->connection->query($sql);

            return $this->check;
        }

        function selectAll($firstString,$backString,$roomName) {
            $sql                = "SELECT $firstString FROM $roomName ";
            $sql               .= "WHERE $backString";
            $this->check        = $this->connection->query($sql);

            return $this->check;
        }

        function update($userId) {
            $tableName          = $this->tableNameSearch($userId);

            $sql                = "UPDATE $tableName SET room_master = 'master' WHERE room_position = ";
            $sql               .= "(SELECT MIN(room_position) FROM $tableName)";

            $this->check        = $this->connection->query($sql);

            return $this->check;
        }

        function delete($userName,$userId) {
            $tableName          = $this->tableNameSearch($userId);

            $sql                = "DELETE FROM $tableName WHERE user_name = '$userName'";

            $this->check        = $this->connection->query($sql);

            return $this->check;
        }
    }