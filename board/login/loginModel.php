<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-11-24
 * Time: 오후 8:25
 */
    include "loginUser.php";

    @session_start();

    class userInfo extends UserLogin{

        private $TABLE_NAME = "user";
        //<-------------------------유저 정보 등록--------------------------------------------------------->
        function insert($userId, $userName, $userPw) {
            $currentTime = date("YY-mm-dd H:m:s");

            $sql         = "INSERT INTO $this->TABLE_NAME ";
            $sql        .= "(user_id, user_name, user_pw, reg_date) ";
            $sql        .= "VALUES ";
            $sql        .= "('$userId', '$userName', '$userPw', '$currentTime'";

            $this->connect->query($sql);
        }
        //<--------------------------현재 유저 목록-------------------------------------------------------->
        function select($firstString, $backString) {
            if($firstString == null || $firstString == "") {
                $firstString = "*";
            }
            if($backString == null || $backString == "") {
                $backString = " ";
            }

            $sql         = "SELECT $firstString from ".$this->TABLE_NAME."$backString";

            $result      = $this->connect->query($sql);

            return $result;
        }
        //<-----------------------------유저 업데이트------------------------------------------------------>
        function update($userPw) {
            $currentTime = date("YY-mm-dd H:m:s");

            $sql         = "UPDATE $this->TABLE_NAME SET user_pw = '$userPw' , reg_date = '$currentTime'";

            $this->connect->query($sql);
        }
        //<------------------------------유저 삭제--------------------------------------------------------->
        function delete($getId , $getPw) {
            $userId = $_SESSION['id'];
            $userPw = $_SESSION['passWord'];

            if($userId == null || $userPw == null) {
                echo "<script>alert('현재 로그인이 되어 있지 않습니다');</script>";
            }
            if($getId != $userId && $getPw != $userPw) {
                echo "<script>alert('아이디와 비밀번호가 일치 하지 않습니다.')</script>";
            }
            else {
                $sql = "DELETE FROM $this->TABLE_NAME WHERE user_id = $userId";

                $this->connect->query($sql);
            }
        }
    }