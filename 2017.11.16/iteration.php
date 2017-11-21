<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-11-16
 * Time: 오전 11:03
 */
    class A {
        private         $pr_v   = 10;
        protected       $pro_v  = 20;
        public          $pu_v   = 30;
        public static   $pus_v  = 40;

        function __construct() {
            echo "A invoked<br>";
        }

        function printForeach($obj) {
            foreach ($obj as $key => $value) {
                echo "{$key} => {$value}<br>";
            }
        }
    }

    $obj = new A();

    foreach ($obj as $key => $value) {
        echo "{$key} => {$value}<br>";
    }

    echo "<hr>";
    $obj->printForeach($obj);