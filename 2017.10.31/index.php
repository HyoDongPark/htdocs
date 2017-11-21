<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-10-31
 * Time: 오후 1:57
 */
trait IGoMoYa {
    private $text = "test i - variable";

    function __construct()
    {
        echo "construct1<br>";
    }
    function gora() {
        echo "gora method 1<br>";
    }
    function __destruct()
    {
        echo "destruct <br>";
    }
}
trait IGoMoYa2 {

    private $text = "test i - variable";

    function __construct()
    {
        echo "construct2<br>";
    }
    function gora() {
        echo "gora method 2<br>";
    }
    function __destruct()
    {
        echo "destruct <br>";
    }
}

class test {
    function __construct()
    {
        echo "test construct<br>";
    }
}

class Main extends test{

    use IGoMoYa,IGoMoYa2 {
        IGoMoYa2::__construct insteadof IGoMoYa;
        IGoMoYa::gora insteadof IGoMoYa2;
        IGoMoYa2::__destruct insteadof IGoMoYa;
    }

    //use IGoMoYa { IGoMoYa::__construct insteadof Main;}

    function __construct()
    {
        echo "main construct<br>";
    }
}

echo "Show main<br>";

$obj = new Main();
