<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-11-24
 * Time: 오후 8:25
 */
    include "loginModel.php";

    class userInfo extends UserLogin{

        private $TABLE_NAME = "user";

        function insert($userId, $userName, $userPw) {
            $currentTime = date("YY-mm-dd H:m:s");

            $sql         = "INSERT INTO $this->TABLE_NAME ";
            $sql        .= "(user_id, user_name, user_pw, reg_date) ";
            $sql        .= "VALUES ";
            $sql        .= "('$userId', '$userName', '$userPw', '$currentTime'";

            $this->connect->query($sql);
        }
        function select($firstString, $backString) {
            if($firstString == null || $firstString == "") {
                $firstString = "*";
            }
            if($backString == null || $backString == "") {
                $backString = " ";
            }

            $sql         = "SELECT $firstString from ".$this->TABLE_NAME.$backString;

            $result      = $this->connect->query($sql);

            return $result;
        }
        function update($userPw) {
            $currentTime = date("YY-mm-dd H:m:s");

            $sql         = "UPDATE $this->TABLE_NAME SET user_pw = '$userPw' , reg_date = '$currentTime'";

            $this->connect->query($sql);
        }
        function delete() {

        }
    }