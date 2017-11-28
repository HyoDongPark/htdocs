<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-11-27
 * Time: 오전 10:49
 */
    include "../boardInfo/boardModel.php";

    session_start();

    $boardObj               = new boardInfo();
    $page                   = @$_POST['page'];
    $selectValue            = @$_POST['selectValue'];
    $searchText             = @$_POST['searchText'];

    if($page != null && $selectValue == null && $searchText == null
        && @$_SESSION['searchValue'] == null && @$_SESSION['searchValue'] == null) {
        $firstString        = "";
        $backString         = "";

        @$_SESSION['page']  = $page;

        $result             = $boardObj->selectPage($firstString, $backString);

        $count              = mysqli_num_rows($result);

        if($count % 5 != 0 || $count > 5) {
            $value      = (int)($count / 5) + 1;
            $lastValue  = $value - 1;
        }
        else if($count % 5 == 0) {
            $value          = (int)($count / 5);
            $lastValue  = $value - 1;
        }
        else {
            $value          = (int)($count / 5);
            $lastValue  = $value;
        }

        echo "<li><button type='button' class='btn-success' id='0' onclick='pagination(event.target.id)'><<</button></li>";
        if($value < 5) {
            for($i = 0; $i < $value; $i ++ ) {
                $temp = $i + 1;
                echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
            }
        }
        else if($page < 3 && $value > 5) {
            for($i = 0; $i < 5; $i ++ ) {
                $temp = $i + 1;
                echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
            }
        }
        else {
            if($page + 2 > $value) {
                for ($i = $page - 2; $i <= $value; $i++) {
                    $temp = $i + 1;
                    echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
                }
            }
            else {
                for ($i = $page - 2; $i <= $page + 2; $i++) {
                    $temp = $i + 1;
                    echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
                }
            }
        }
        echo "<li><button type='button' class='btn-success' id='$lastValue' onclick='pagination(event.target.id)'>>></button></li>";
    }
    else if($selectValue != null && $searchText != null && $page != null) {

        switch ($selectValue) {
            case "제목":
                $searchValue        = "subject";
                break;
            case "내용":
                $searchValue        = "contents";
                break;
            case "작성자":
                $searchValue        = "user_id";
                break;
        }

        @$_SESSION['searchValue']   = $searchValue;
        @$_SESSION['searchText']    = $searchText;
        @$_SESSION['page']          = 0;

        $firstString                = "";
        $backString                 = "WHERE $searchValue LIKE '%$searchText%'";

        $result                     = $boardObj->selectPage($firstString, $backString);

        $count                      = mysqli_num_rows($result);

        if($count % 5 != 0 || $count > 5) {
            $value      = (int)($count / 5) + 1;
            $lastValue  = $value - 1;
        }
        else if($count % 5 == 0) {
            $value          = (int)($count / 5);
            $lastValue  = $value - 1;
        }
        else {
            $value          = (int)($count / 5);
            $lastValue  = $value;
        }

        echo "<li><button type='button' class='btn-success' id='0' onclick='pagination(event.target.id)'><<</button></li>";
        if($value < 5) {
            for($i = 0; $i < $value; $i ++ ) {
                $temp = $i + 1;
                echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
            }
        }
        else if(@$_SESSION['page'] < 3) {
            for($i = 0; $i < 5; $i ++ ) {
                $temp = $i + 1;
                echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
            }
        }
        echo "<li><button type='button' class='btn-success' id='$lastValue' onclick='pagination(event.target.id)'>>></button></li>";
    }
    else if($selectValue == null && $searchText == null && $page != null && @$_SESSION['searchText'] != null) {

        $firstString        = "";
        $backString         = "WHERE ".@$_SESSION['searchValue']." LIKE '%".@$_SESSION['searchText']."%'";

        $result             = $boardObj->selectPage($firstString, $backString);

        $count              = mysqli_num_rows($result);

        @$_SESSION['page']  = $page;

        if($count % 5 != 0 || $count > 5) {
            $value      = (int)($count / 5) + 1;
            $lastValue  = $value - 1;
        }
        else if($count % 5 == 0) {
            $value          = (int)($count / 5);
            $lastValue  = $value - 1;
        }
        else {
            $value          = (int)($count / 5);
            $lastValue  = $value;
        }

        echo "<li><button type='button' id='0' class='btn-success' onclick='pagination(event.target.id)'><<</button></li>";
        if($value < 5) {
            for($i = 0; $i < $value; $i ++ ) {
                $temp = $i + 1;
                echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
            }
        }
        else if(@$_SESSION['page'] < 3) {
            for($i = 0; $i < 5; $i ++ ) {
                $temp = $i + 1;
                echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
            }
        }
        else {
            if($page + 2 > $value) {
                for ($i = @$_SESSION['page'] - 2; $i <= @$_SESSION['page'] + 2; $i++) {
                    $temp = $i + 1;
                    echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
                }
            }
            else {
                for ($i = @$_SESSION['page'] - 2; $i <= $value; $i++) {
                    $temp = $i + 1;
                    echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
                }
            }
        }
        echo "<li><button type='button' class='btn-success' id='$lastValue' onclick='pagination(event.target.id)'>>></button></li>";
    }
    else if(@$_SESSION['page'] != null && @$_SESSION['searchValue'] != null && @$_SESSION['searchText']  != null) {

        $firstString        = "";
        $backString         = "WHERE ".@$_SESSION['searchValue']." LIKE '%".@$_SESSION['searchText']."%'";

        $result             = $boardObj->selectPage($firstString, $backString);

        $count              = mysqli_num_rows($result);

        if($count % 5 != 0 || $count > 5) {
            $value      = (int)($count / 5) + 1;
            $lastValue  = $value - 1;
        }
        else if($count % 5 == 0) {
            $value          = (int)($count / 5);
            $lastValue  = $value - 1;
        }
        else {
            $value          = (int)($count / 5);
            $lastValue  = $value;
        }

        echo "<li><button type='button' class='btn-success' id='0' onclick='pagination(event.target.id)'><<</button></li>";
        if($value < 5) {
            for($i = 0; $i < $value; $i ++ ) {
                $temp = $i + 1;
                echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
            }
        }
        else if(@$_SESSION['page'] < 3) {
            for($i = 0; $i < 5; $i ++ ) {
                $temp = $i + 1;
                echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
            }
        }
        else {
            if($page + 2 > $value) {
                for ($i = @$_SESSION['page'] - 2; $i <= @$_SESSION['page'] + 2; $i++) {
                    $temp = $i + 1;
                    echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
                }
            }
            else {
                for ($i = @$_SESSION['page'] - 2; $i <= $value; $i++) {
                    $temp = $i + 1;
                    echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
                }
            }
        }
        echo "<li><button type='button' class='btn-success' id='$lastValue' onclick='pagination(event.target.id)'>>></button></li>";
    }
    else {
        $firstString        = "";
        $backString         = "";

        if($page == null && is_null(@$_SESSION['page'])) {
            $page = 0;
        }
        else {
            $page = @$_SESSION['page'];
        }

        @$_SESSION['page']  = $page;

        $result             = $boardObj->selectPage($firstString, $backString);

        $count              = mysqli_num_rows($result);

        if($count % 5 != 0 || $count > 5) {
            $value      = (int)($count / 5) + 1;
            $lastValue  = $value - 1;
        }
        else if($count % 5 == 0) {
            $value          = (int)($count / 5);
            $lastValue  = $value - 1;
        }
        else {
            $value          = (int)($count / 5);
            $lastValue  = $value;
        }

        echo "<li><button type='button' class='btn-success' id='0' onclick='pagination(event.target.id)'><<</button></li>";
        if($value < 5) {
            for($i = 0; $i < $value; $i ++ ) {
                $temp = $i + 1;
                echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
            }
        }
        else if($page < 3 && $value > 5) {
            for($i = 0; $i < 5; $i ++ ) {
                $temp = $i + 1;
                echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
            }
        }
        else {
            if($page + 2 > $value) {
                for ($i = $page - 2; $i <= $value; $i++) {
                    $temp = $i + 1;
                    echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
                }
            }
            else {
                for ($i = $page - 2; $i <= $page + 2; $i++) {
                    $temp = $i + 1;
                    echo "<li><button type='button' class='btn-success' id='$i' onclick='pagination(event.target.id)'>$temp</button></li>";
                }
            }
        }
        echo "<li><button type='button' id='$lastValue' class='btn-success' onclick='pagination(event.target.id)'>>></button></li>";
    }


