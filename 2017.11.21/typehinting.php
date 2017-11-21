<?php
/**
 * Created by PhpStorm.
 * User: 박효동 영진전문대
 * Date: 2017-11-21
 * Time: 오후 2:43
 */

    interface testInt {
        public function prtInt($value);
    }

    class typeValue implements testInt {
        public function prtInt($value) {
            echo "prtInt() in test is invoked<br>";
        }
    }

    class TypeHintingTest {

        private $arrayType  = array();
        private $value      = 30;

        function __construct(array $array) {
            $this->arrayTest($array);
        }

        function arrayTest( array $array ) {
            foreach ($array as $key => $value) {
                echo "{$key} => {$value}";
            }
        }

        function prtSomeThing() {
            echo $this->arrayTest();
        }

        function InterfaceTest (testInt $int) {
            $int->prtInt($int);
        }

        function callableTest(callable $callable, $data) {
            call_user_func($callable, $data);
        }
    }

    $arrayType = array("type" => "int", "value" => 20, "parents" => 30);

    $objTypeHinting = new TypeHintingTest($arrayType);
    $objTypeHinting->arrayTest($objTypeHinting->prtSomeThing());
    $objTypeHinting->InterfaceTest(50);