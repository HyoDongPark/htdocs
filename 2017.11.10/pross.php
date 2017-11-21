<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-11-10
 * Time: 오전 11:06
 */
    class Tese {
        public $b = 333;
    }


    class Test {
        public $i_va = "val";
        public $i_ca = "";
        public $obj;

        public function __construct($objt) {
            $this->obj = $objt;

        }

        public function print() {
            echo $this->i_ca." : ".$this->i_va."<br>";
        }

        public function setString($set) {
            $this->i_ca = $set;
        }
    }

    $obj2 = new Tese();

    $obj = new Test($obj2);

    $jsonString = json_encode($obj);

    echo $jsonString."<br>";