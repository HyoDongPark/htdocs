<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-12-25
 * Time: 오후 2:06
 */
    if (session_status() == 1) {
        session_start();
    }

    $price  = 0;
    $amount = 0;

    foreach (@$_SESSION as $value) {
        $price  = $price + ($value[1] * $value[2]);
        $amount = $amount + $value[2];
    }

    echo $price."/".$amount;