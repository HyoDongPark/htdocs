<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-04
 * Time: 오전 10:17
 */

    class DataBase {
        const DB_HOST   = "localhost";
        const DB_USER   = "root";
        const DB_PASS   = "qweasd45";
        const DB_NAME   = "vote";
        const DB_TABLE  = "worldCup";

        private $conn;

        public function __construct()
        {
            $this->conn = new mysqli(
                DataBase::DB_HOST,
                DataBase::DB_USER,
                DataBase::DB_PASS,
                DataBase::DB_NAME
                );

            if(mysqli_connect_errno()) {
                exit();
            }
        }

        function select($country) {
            $query      = "SELECT vote FROM ".DataBase::DB_TABLE." WHERE contry = '$country'";
            $result     = $this->conn->query($query);
            $print      = mysqli_fetch_row($result);

            return $print[0];
        }

        function selectAll() {
            $query      = "SELECT vote FROM ".DataBase::DB_TABLE;
            $result     = $this->conn->query($query);
            $temp       = 0;
            $i          = 0;
            while($print = mysqli_fetch_row($result)) {
                $temp += $print[$i];
        }

            return $temp;
        }

        function update($country) {

            $voteValue = $this->select($country);

            $query = "UPDATE ".DataBase::DB_TABLE." SET vote = ".++$voteValue." WHERE contry = '$country'";

            $this->conn->query($query);
        }

        function __destruct() {
            // TODO: Implement __destruct() method.
            $this->conn->close();
        }
    }


    $country    = @$_GET['firstTeam'];
    $value      = @$_GET['value'];

    if(!is_null($country)) {

        $obj = new DataBase();

        switch ($country) {
            case "Germany":
                $obj->update($country);
                break;
            case "Mexico":
                $obj->update($country);
                break;
            case "Sweden":
                $obj->update($country);
                break;
            case "Korea":
                $obj->update($country);
                break;
        }
    }
    else if(!is_null($value)) {

        header("Content-Type: image/png");

        $obj        = new DataBase();

        $array      = array("Germany", "Mexico", "Sweden", "Korea");

        $allValue   = $obj->selectAll();
        $result     = $obj->select($array[$value]);

        $stringName = "";
        $height     = 0;

        switch ($value) {
            case 0:
                $stringName = "./독일.png";
                $height = 24;
                break;
            case 1:
                $stringName = "./멕시코.png";
                $height = 23;
                break;
            case 2:
                $stringName = "./스웨덴.png";
                $height = 23;
                break;
            case 3:
                $stringName = "./한국.png";
                $height = 23;
                break;
        }
        $result             = (int)$result;
        $allValue           = (int)$allValue;

        $percent            = ($result / $allValue) * 100;

        if(is_nan($percent))
            exit();

        $width              = (290 * $percent) / 100;

        $image              = @imagecreatefrompng($stringName);

        $black              = @imagecolorallocate($image, 0, 0, 0);

        $fontWidth          = @imagefontwidth(5);

        $fontText           = "$result";

        $testLength         = strlen($fontText);

        $xPos               = ($width - $fontWidth) / 2;
        $yPos               = 20;

        $thumb              = @imagecreate($width , $height);


        @imagestring($image, 20, $xPos, $yPos, $fontText, $black);

        @imagecopyresized($thumb, $image, 0, 0, 0, 0, $width, $height, 290, $height);

        @imagepng($thumb);

        @imagedestroy($imageCreate);

    }
    else {
        $obj                = new DataBase();

        $array              = array("Germany", "Mexico", "Sweden", "Korea");
        $percentArray       = array();
        $tempString         = "";
        $i                  = 0;

        while ($i != 4) {
        $allValue           = $obj->selectAll();
        $result             = $obj->select($array[$i]);

        $result             = (int)$result;
        $allValue           = (int)$allValue;
        $percentArray[$i]    = round(($result / $allValue) * 100);
        $i++;
        }

        foreach ($percentArray as $value) {
            $tempString .= $value.",";
        }

        echo $tempString;
    }