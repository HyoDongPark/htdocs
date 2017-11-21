<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-11-14
 * Time: 오후 2:16
 */

    class myValue {
        public $mSonOnj;

        function __construct($obj) {
            $this->mSonOnj = $obj;
        }
    }

    class myClass {
        public $value = 10;
    }

    $myClassObj = new myClass();
    $myValueObj = new myValue($myClassObj);

    $myValueCloneObj = clone $myValueObj;