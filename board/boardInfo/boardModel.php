<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-11-25
 * Time: 오후 3:26
 */
    include "../mysqliConnect/connectInfo.php";

    class boardInfo extends connectInfo {
        private $TABLE_NAME = "gboard";
        //<----------------------보드 입력---------------------------------------------------------------->
        function insert($userId, $subject, $contents) {
            $currentTime = date("Y-m-d H:m:s");

            $sql         = "INSERT INTO $this->TABLE_NAME ";
            $sql        .= "(user_id, subject, contents, reg_date) ";
            $sql        .= "VALUES ";
            $sql        .= "('$userId', '$subject', '$contents', '$currentTime')";

            $this->connect->query($sql);
        }
        //<--------------------------현재 보드 목록-------------------------------------------------------->
        function select($firstString, $backString) {
            if($firstString == null || $firstString == "") {
                $firstString = "*";
            }
            if($backString == null || $backString == "") {
                $backString = " ";
            }

            $sql         = "SELECT $firstString from ".$this->TABLE_NAME." $backString";

            $result      = $this->connect->query($sql);

            return $result;
        }
        //<-----------------------------보드 업데이트------------------------------------------------------>
        function update($boardId, $subject , $contents) {
            $currentTime = date("YY-mm-dd H:m:s");

            $sql         = "UPDATE $this->TABLE_NAME SET subject = '$subject',contents = '$contents', reg_date = '$currentTime'";
            $sql        .= " WHERE board_id = '$boardId'";
            $this->connect->query($sql);
        }
        //<------------------------------보드 삭제--------------------------------------------------------->
        function delete($boardId) {

                $sql = "DELETE FROM $this->TABLE_NAME WHERE board_id = '$boardId'";

                $this->connect->query($sql);
        }
    }