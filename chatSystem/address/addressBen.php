<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-12-12
 * Time: 오전 9:25
 */
    require_once '../classes.php';

    class addressBen extends foundationDatabase {
        private $TABLE_NAME = "addressban";

        private $checked;

        function insert($MacHost) {
            $sql            = "INSERT INTO ".$this->TABLE_NAME." ";
            $sql           .= "(MacAddress, youBen) ";
            $sql           .= "VALUES ('$MacHost', '난 몇번은 봐줬다.')";

            $this->checked  = $this->connection->query($sql);

            return $this->checked;
        }

        function select() {
            $sql            = "SELECT MacAddress FROM ".$this->TABLE_NAME;

            $this->checked  = $this->connection->query($sql);

            return $this->checked;
        }
    }