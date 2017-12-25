<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-12-19
 * Time: 오후 1:48
 */
    include_once "connDB.php";

    class userInfo extends connDB {
        const TABLE_NAME    = "userinfo";
        private $checked;

        function select($firstString,$backString) {
            $sql            = "SELECT ";
            $sql           .= "$firstString ";
            $sql           .= "FROM ".self::TABLE_NAME." ";
            $sql           .= "WHERE $backString";

            $this->checked  = $this->conn->query($sql);

            return $this->checked;
        }
    }