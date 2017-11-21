<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-11-21
 * Time: 오후 3:30
 */
    function __autoload($arg) {
        include $arg.".php";
    }
    $obj = new test();
    $obj->prtSomething();