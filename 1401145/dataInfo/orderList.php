<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-12-19
 * Time: 오후 4:26
 */
    include_once "connDB.php";

    class orderList extends connDB {
        const TABLE_NAME    = "orderlist";

        private $checked;

        function insert($userId, $name, $productid, $orderItemNum) {
            $today          = date("Y-m-d H:i:s");

            $sql            = "INSERT INTO ";
            $sql           .= self::TABLE_NAME." ";
            $sql           .= "(userid, name, productid, orderitemnum, recordtime) ";
            $sql           .= "VALUES ";
            $sql           .= "('$userId','$name',$productid,$orderItemNum,'$today')";

            $this->checked  = $this->conn->query($sql);

            return $this->checked;
        }

        function select($backString) {
            $sql            = "SELECT * FROM ".self::TABLE_NAME." ";
            $sql           .= "WHERE $backString";

            $this->checked  = $this->conn->query($sql);

            return $this->checked;
        }
    }