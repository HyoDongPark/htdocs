<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-11
 * Time: 오후 1:28
 */
    require_once '../classes.php';

    class chatList extends foundationDatabase {
        private $TABLE_NAME    = "roomlist";

        private $check;

        function select($firstString, $backString) {
            $sql            = "SELECT $firstString ";
            $sql           .= "FROM ".$this->TABLE_NAME." ";
            $sql           .= "$backString";

            $this->check    = $this->connection->query($sql);

            return $this->check;
        }

        function update($roomMaster, $roomPeople, $roomNum) {
            $sql            = "UPDATE ".$this->TABLE_NAME." ";
            $sql           .= "SET room_master =  '$roomMaster', room_numpeople = '$roomPeople' ";
            $sql           .= "WHERE room_num = $roomNum";

            $this->check    = $this->connection->query($sql);

            return $this->check;
        }

        function delete($room_num) {
            $sql            = "DELETE FROM ".$this->TABLE_NAME." WHERE room_num = $room_num";

            $this->check    = $this->connection->query($sql);

            return $this->check;
        }
    }