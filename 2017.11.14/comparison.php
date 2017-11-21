<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-11-14
 * Time: 오후 3:37
 */

    class A {
        private $value;

        function __construct($argValue) {
            $this->value = $argValue;
        }
    }

    $Aobj = new A(15);
    $Bobj = new A(25);
    $Cobj = new A(15);
    $AAobj = $Aobj;

    if($Aobj == $Bobj)
        echo "true<br>";
    else
        echo "false<br>";

    if($Aobj === $Cobj)
        echo "true<br>";
    else
        echo "false<br>";

    if($AAobj === $Aobj)
        echo "true<br>";
    else
        echo "false<br>";

