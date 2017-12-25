<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-12-19
 * Time: 오후 2:30
 */
    include_once "connDB.php";

    class itemList extends connDB {
        const TABLE_NAME    = "itemlist";

        private $checked;

        function select($backString) {
            $sql            = "SELECT ";
            $sql           .= "* ";
            $sql           .= "FROM ".self::TABLE_NAME." ";
            $sql           .= "$backString";

            $this->checked  = $this->conn->query($sql);

            return $this->checked;
        }

        function update() {

        }
    }