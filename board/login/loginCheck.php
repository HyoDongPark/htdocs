<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-11-24
 * Time: 오후 11:13
 */
    @session_start();

    @$userId        = $_POST["idCheck"];
    @$userPw        = $_POST["pwCheck"];
    @$sessionCheck  = $_POST["sessionCheck"];
    @$sessionClear  = $_POST["sessionClear"];


    if($userId != "" && $userPw != "" || $userId != null && $userPw != null) {
        include "loginModel.php";

        $useObj = new userInfo();

        $tempUserId = "";
        $tempUserPw = "";

        $firstString = "user_id, user_pw";
        $backString = " WHERE user_id = '$userId'";

        $result = $useObj->select($firstString, $backString);

        while ($print = mysqli_fetch_array($result)) {
            $tempUserId = $print['user_id'];
            $tempUserPw = $print['user_pw'];
        }

        if ($userId != $tempUserId || $userPw != $tempUserPw || $result == false) {
            echo "아이디와 비밀번호가 맞지 않습니다.";
        } else {
            $_SESSION['id'] = $tempUserId;
            $_SESSION['passWord'] = $tempUserPw;
        }
    }
    if($sessionCheck != null || $sessionCheck != "") {
        $sessionIdCheck = false;
        $sessionPwCheck = false;

        if(@$_SESSION['id'] != null || @$_SESSION['id'] != false || @$_SESSION['id'] != "") {
            $sessionIdCheck = true;
        }
        if(@$_SESSION['passWord'] != null || @$_SESSION['passWord'] != false || @$_SESSION['passWord'] != "") {
            $sessionPwCheck = true;
        }
        if($sessionIdCheck == true && $sessionPwCheck == true) {
            echo "OK";
        }
        else {
            echo "NO";
        }
    }
    if($sessionClear != null || $sessionClear != "") {
        $sessionIdClear = false;
        $sessionPwClear = false;

        unset($_SESSION['id']);
        unset($_SESSION['passWord']);

        if(@$_SESSION['id'] == null || @$_SESSION['id'] == "") {
            $sessionIdClear = true;
        }
        if(@$_SESSION['passWord'] == null || @$_SESSION['passWord'] == "") {
            $sessionPwClear = true;
        }
        if($sessionIdClear == true && $sessionPwClear == true) {
            echo "OK";
        }
        else {
            echo "NO";
        }
    }