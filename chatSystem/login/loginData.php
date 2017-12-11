<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-11
 * Time: 오전 8:07
 */
    include "../connect/foundationDatabase.php";

    class loginData extends foundationDatabase {
        const TABLE_NAME    = "userinfo";

        private $check;
        //유저 회원 가입
        function insert($userId, $userPass, $userName) {
            $sql            = "INSERT INTO ".loginData::TABLE_NAME." ";
            $sql           .= "(user_id, password, user_name) ";
            $sql           .= "VALUES ";
            $sql           .= "('$userId', '$userPass', '$userName')";

            $this->check    = $this->connection->query($sql);

            return $this->check;
        }
        //유저 조회
        function select($firstString, $backString) {
            $sql            = "SELECT $firstString ";
            $sql           .= "FROM ".loginData::TABLE_NAME." ";
            $sql           .= "$backString";

            $this->check    = $this->connection->query($sql);

            return $this->check;
        }
        //유저 업데이트
        function update($updateValue, $userId) {
            $sql            = "UPDATE ".loginData::TABLE_NAME." ";
            $sql           .= "SET ";
            $sql           .= "$updateValue ";
            $sql           .= "WHERE user_id = '$userId'";

            $this->check    = $this->connection->query($sql);

            return $this->check;
        }
    }