<?php

class myClass implements Iterator {
    private $checkNum       = 1;
    private $booleanValue   = true;
    private $valueCheck     = 0;
    public  $mAlist1        = array(1, 2, 11 , 12, 15, 16);
    public  $mAlist2        = array(4, 5, 6);
    public  $mAlist3        = array(8, 9, 10 , 14);

    public function next()
    {
        switch ($this->checkNum) {
            case 1:
                next($this->mAlist1);
                break;
            case 2:
                if ($this->booleanValue == true) {
                    reset($this->mAlist2);
                } else {
                    next($this->mAlist2);
                }
                break;
            case 3:
                if ($this->booleanValue == true) {
                    reset($this->mAlist3);
                    $this->booleanValue = false;
                } else {
                    next($this->mAlist3);
                }
                break;
        }
    }
    public function key()
    {
        switch ($this->checkNum) {
            case 1:
                $this->valueCheck = 0;
                $this->checkNum = 2;
                return key($this->mAlist1);
                break;
            case 2:
                $this->valueCheck = 0;
                $this->checkNum = 3;
                return key($this->mAlist2);
                break;
            case 3:
                $this->valueCheck = 0;
                $this->checkNum = 1;
                return key($this->mAlist3);
                break;
        }
    }
    public function rewind()
    {
        reset($this->mAlist1);
    }
    public function current()
    {
        switch ($this->checkNum) {
            case 1:
                return current($this->mAlist1);
                break;
            case 2:
                return current($this->mAlist2);
                break;
            case 3:
                return current($this->mAlist3);
                break;
        }
    }
    public function valid()
    {
        do {
        switch ($this->checkNum) {
            case 1:
                $ArrayString = $this->mAlist1;
                break;
            case 2:
                $ArrayString = $this->mAlist2;
                break;
            case 3:
                $ArrayString = $this->mAlist3;
                break;
        }
        if(key($ArrayString) !== NULL && key($ArrayString) !== false)
            return true;
        else {
            if($this->checkNum == 1) {
                $this->checkNum = 2;
                $this->valueCheck++;
            }
            else if($this->checkNum == 2) {
                $this->checkNum = 3;
                $this->valueCheck++;
            }
            else if($this->checkNum == 3) {
                $this->checkNum = 1;
                $this->valueCheck++;
            }
        }
        if($this->valueCheck == 2) {
            return false;
        }
        } while (true);
    }
}
$obj = new myClass();

foreach($obj as $key => $value) {
    echo $key." = ".$value."<br>";
}