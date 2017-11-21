<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-11-16
 * Time: 오전 11:40
 */
    class testIteration implements Iterator {
        public $GameComArray =  array("Nexon", "Netmarble", "BlueHole", "KOT");

        /**
         * Return the current element
         * @link http://php.net/manual/en/iterator.current.php
         * @return mixed Can return any type.
         * @since 5.0.0
         */
        public function current()
        {
            return current($this->GameComArray);
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
            next($this->GameComArray);
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
            return key($this->GameComArray);
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
            if((key($this->GameComArray) !== false) && (key($this->GameComArray) !== null)) {
                return true;
            }

            return false;
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
            reset($this->GameComArray);
        }
    }

    $obj = new testIteration();

    foreach ($obj as $key => $value) {
        echo $key." => ".$value."<br>";
    }
