<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-11-27
 * Time: 오전 10:49
 */
    include "../boardInfo/boardModel.php";

    $boardObj               = new boardInfo();
    $page                   = @$_POST['page'];

    if($page != null) {
        $firstString        = "";
        $backString         = "";

        @$_SESSION['page']  = $page;

        $result             = $boardObj->selectPage($firstString, $backString);

        $count              = mysqli_num_rows($result);

        if($count % 5 != 0)
            $value          = (int)($count / 5) + 1;
        else
            $value          = ($count / 5);

        if($page < 3) {

        }

    }
    else if(@$_SESSION['page'] != null) {

    }
