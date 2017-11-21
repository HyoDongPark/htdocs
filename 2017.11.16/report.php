<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-11-16
 * Time: 오후 12:29
 */
    //<-------------------배열과 정수를 구분해 줍니다.-------------->
    class searchMember {
        public $totalArray      = array();
        public $totalVariable   = array();
        function __construct($object)
        {
            foreach ($object as $value) {
                if(is_array($value))
                    array_push($this->totalArray, $value);
                else if(is_int($value))
                    array_push($this->totalVariable, $value);
            }
        }
    }
    //<-------------------배열을 넣을 변수들을 따로 정의합니다.------>
    class valueCollect {
        public $value1           = 18;
        public $value2           = 20;
        //<----------배열과 인스턴스 변수를 구분 짓는 배열----------->
        public $array1           = array(4, 5, 6);
        public $array2           = array(7, 8, 9);
        public $array3           = array(10, 11, 12, 13, 14, 15);
        public $array4           = array(22, 32, 34);
        //<----------정의 끝------------------------------------->
    }
    //<--------------------------------------------------------->
    //<------------배열들을 정리하여 인덱스 순서대로 찍어냅니다.------>
    class valueIteration implements Iterator {
        private $totalArray         = array();  // 나누어 둔 값들을 가져와 사용합니다.
        private $totalVariable      = array();  //

        private $checkedValue       = 0;        // 현재 배열안의 배열의 인덱스 위치를 파악합니다.
        /**
         * Return the current element
         * @link http://php.net/manual/en/iterator.current.php
         * @return mixed Can return any type.
         * @since 5.0.0
         */
        function __construct($array)
        {
            $this->totalArray       = $array;   // 배열만 분리해놓은 것들로 값을 구합니다.
        }
        public function current()
        {
            // TODO: Implement current() method.
            $intoArray = current($this->totalArray);    // 배열안에 배열을 사용하여 값을 가져와 사용합니다.
            for($i = 0; $i < $this->checkedValue; $i++) {
                next($intoArray);                       // 배열 포인터가 움직이지 않아임의로 조종을 합니다.
            }
            return current($intoArray);                 // 다된값들은 다시 넘깁니다.
        }

        /**
         * Move forward to next element
         * @link http://php.net/manual/en/iterator.next.php
         * @return void Any returned value is ignored.
         * @since 5.0.0
         */
        public function next()
        {
            // TODO: Implement next() method.
            //배열의 마지막이 됬을 경우 값을 다시 처음으로 만들어 줍니다.
            if(key($this->totalArray) == (count($this->totalArray) - 1)) {
                for ($var = 0; $var < (count($this->totalArray) - 1) ; $var++) {
                    prev($this->totalArray);
                }
                $this->checkedValue++; // 그리고 마지막까지 감으로써 배열안의 배열인덱스도 증가시켜 줍니다.
            }
            else {
                next($this->totalArray); // 끝이 아닐경우 그냥 다음 포인터로 넘겨줍니다.
            }
        }

        /**
         * Return the key of the current element
         * @link http://php.net/manual/en/iterator.key.php
         * @return mixed scalar on success, or null on failure.
         * @since 5.0.0
         */
        public function key()
        {
            // TODO: Implement key() method.
            $intoArray = current($this->totalArray);
            for($i = 0; $i < $this->checkedValue; $i++) {
                next($intoArray);
            }
            return key($intoArray);
        }

        /**
         * Checks if current position is valid
         * @link http://php.net/manual/en/iterator.valid.php
         * @return boolean The return value will be casted to boolean and then evaluated.
         * Returns true on success or false on failure.
         * @since 5.0.0
         */
        public function valid()
        {
            // TODO: Implement valid() method.
            // 현재 포인터안의 배열을 가지고 와서 그 배열의 포인터의 위치를 파악합니다.
            $tempArray = current($this->totalArray);
            if(key($this->totalArray)!== null && key($this->totalArray)!== false && count($tempArray) > $this->checkedValue) {
                return true; // 이상이 없을 경우 그냥 값을 넘겨줍니다.
            }
            else {          // 값이 이상이 있을 경우
                if (count($tempArray) <= $this->checkedValue) { // 현재 값이 마지막이 라면
                    for($val = key($this->totalArray); $val < (count($this->totalArray)) ; $val++) {
                        $intoArray = current($this->totalArray); // 값을 검사하여 다음값도 마지막인지 아닌지 판단
                        if(count($intoArray) <= $this->checkedValue) {
                            if(key($this->totalArray) == (count($this->totalArray) - 1)) { // 만약 전체배열의 포인터가 마지막일 경우
                                for ($var = 0; $var < (count($this->totalArray) - 1) ; $var++) {
                                    // 앞에 값이 있을 수 있기 때문에 다시한번 맨앞으로 돌려줍니다.
                                    prev($this->totalArray);
                                }
                                $this->checkedValue++; // 그리고 배열 포인터 증가
                                for($val = key($this->totalArray); $val < (count($this->totalArray)) ; $val++) {
                                    $intoArray = current($this->totalArray);
                                    if(count($intoArray) > $this->checkedValue) { // 값이 마지막이 아니라면
                                        return true;
                                    }
                                    else // 마지막이라면
                                        next($this->totalArray);
                                }
                            }
                            else { // 현재 배열이 마지막일 경우
                                next($this->totalArray);
                            }
                        }
                        else // 값이 이상 없을 때
                            return true;
                    }
                    return false; // 배열의 모든 것들이 종료 되었을 때
                }
                else { // 전체적으로 이상이 없을 때
                    next($this->totalArray);
                    return true;
                }
            }
        }
        /**
         * Rewind the Iterator to the first element
         * @link http://php.net/manual/en/iterator.rewind.php
         * @return void Any returned value is ignored.
         * @since 5.0.0
         */
        public function rewind()
        {
            // TODO: Implement rewind() method.
            reset($this->totalArray);
            reset($this->totalVariable);
        }
    }
    //<--------------------------------------------------------->

    $objValue   = new valueCollect();
    $objSearch  = new searchMember($objValue);
    $objSort    = new valueIteration($objSearch->totalArray);

    foreach ($objSearch->totalVariable as $key => $value) {
        echo "{Key} : $key => {Value} : $value <br>";
    }
    echo "<hr>";
    foreach ($objSort as $key => $value) {
        echo "{Key} : $key => {Value} : $value <br>";
    }