<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-11-30
 * Time: 오전 11:29
 */
    class mysqlConnect {
        const DB_LOCAL     = "localhost";
        const DB_ID        = "root";
        const DB_PASSWORD  = "qweasd45";
        const DB_NAME      = "board";
    }

    class tempName {
        function printValue() {
            foreach ($this as $key => $value) {
                echo "[$key] : $value <br>";
            }
        }
    }


    $obj = new mysqli(
        mysqlConnect::DB_LOCAL,
        mysqlConnect::DB_ID,
        mysqlConnect::DB_PASSWORD,
        mysqlConnect::DB_NAME
    );

    if($obj->connect_errno) {
        echo "CONNECT ERROR NUM : ".$obj->connect_error;
        exit();
    }

    $result = $obj->query("Select * from user");

    if($result == false) {
        exit();
    }

    echo "Current Field = : ".$result->current_field."<br>";
    echo "Current Field = : ".$result->field_count."<br>";
    echo "Current Field = : ".$result->num_rows."<br>";

    $recode_1 = $result->fetch_array();

    for($i = 0; $i < $result->field_count; $i++) {
        echo "{$recode_1[$i]} | &nbsp";

        echo "<br><br>Length count: <br>";

        foreach ($result->lengths as $i => $val) {
            printf("Field %2d has Length %2d<br>", $i + 1,$val);
        }
    }

    echo "<br><br>";


    $recode_2 = $result->fetch_row();

    foreach ($recode_2 as $key => $value) {
        echo "$key : $value <br>";
    }

    echo "<br><br>";

    $recode_3 = $result->fetch_assoc();

    foreach ($recode_3 as $key => $value) {
        echo "$key : $value <br>";
    }

    $recode_all = $result->fetch_all();

    echo "<br><br>";

    var_dump($result);

    echo "<br><br>";

    foreach ($recode_all as $array_key => $array) {
        foreach ($array as $key => $value) {
            echo "\t[$key][$array_key] : $value \t";
        }
        echo "<br>";
    }

    echo "<br><br>";

    $result = $obj->query("Select * from user");

    $recode_4 = $result->fetch_object("tempName");

    $recode_4->printValue();

    echo "<br><br>";

    $valObj = new tempName();

    $valObj->printValue();

    echo "<br><br>";

