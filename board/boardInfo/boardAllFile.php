<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-11-26
 * Time: 오후 5:24
 */
    session_start();

    include "boardModel.php";

    $boardObj       = new boardInfo();

    $userId         = @$_SESSION['id'];

    $allSet         = @$_POST['allSet'];
    $firstUp        = @$_POST['firstUp'];

    $titleText      = @$_POST['titleText'];
    $contentsText   = @$_POST['contentsText'];
    $boardId        = @$_POST['boardId'];
    $selectValue    = @$_POST['selectValue'];
    $searchText     = @$_POST['searchText'];
    $updateTitle    = @$_POST['updateTitle'];
    $updateContents = @$_POST['updateContents'];
    $delete         = @$_POST['deleteId'];


    if($titleText != null && $contentsText != null) {
        $boardObj->insert($userId, $titleText, $contentsText);

        echo "OK";
    }
    else if ($allSet != null){
        unset($_SESSION['searchValue']);
        unset($_SESSION['searchText']);
        unset($_SESSION['page']);
        unset($_SESSION['boardId']);

        $page = 0;

        $firstString    = "";
        $backString     = "";

        $result         = $boardObj->select($firstString, $backString, $page);

        while($print = mysqli_fetch_array($result)) {
            echo "<tr>
                <td>$print[board_id]</td>
                <td><a id='$print[board_id]'data-target='#modalReading' data-toggle='modal' onclick='reading(event.target.id)'>$print[subject]</a></td>
                <td>$print[user_id]</td>
                <td>$print[reg_date]</td>
                <td>$print[hits]</td>
              </tr>";
        }
    }
    else if($titleText == null && $contentsText == null && $boardId == null && $selectValue != null
        && $searchText != null && $updateTitle == null && $updateContents == null && $delete == null ) {

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

        $firstString                = "";
        $backString                 = "WHERE $searchValue LIKE '%$searchText%'";

        $result                     = $boardObj->select($firstString, $backString, (@$_SESSION['page'] * 5));

        while($print = mysqli_fetch_array($result)) {
            echo "<tr>
                <td>$print[board_id]</td>
                <td><a id='$print[board_id]'data-target='#modalReading' data-toggle='modal' onclick='reading(event.target.id)'>$print[subject]</a></td>
                <td>$print[user_id]</td>
                <td>$print[reg_date]</td>
                <td>$print[hits]</td>
              </tr>";
        }
    }
    else if($titleText == null && $contentsText == null && $boardId == null && $selectValue == null
        && $searchText == null && $updateTitle == null && $updateContents == null && $delete == null
        && @$_SESSION['searchValue'] != null && @$_SESSION['searchText'] != null && $firstUp == null) {

        $firstString                = "";
        $backString                 = "WHERE ".@$_SESSION['searchValue']." LIKE '%".@$_SESSION['searchText']."%'";


        $result                     = $boardObj->select($firstString, $backString, (@$_SESSION['page'] * 5));

        while($print = mysqli_fetch_array($result)) {
            echo "<tr>
                <td>$print[board_id]</td>
                <td><a id='$print[board_id]'data-target='#modalReading' data-toggle='modal' onclick='reading(event.target.id)'>$print[subject]</a></td>
                <td>$print[user_id]</td>
                <td>$print[reg_date]</td>
                <td>$print[hits]</td>
              </tr>";
        }
    }
    else if($titleText == null && $contentsText == null && $boardId != null && $selectValue == null
        && $searchText == null && $updateTitle == null && $updateContents == null && $delete == null) {

        $firstString                = "subject, contents, hits, user_id";
        $backString                 = "WHERE board_id = '$boardId'";
        $page                       = 0;

        $checkedValue               = "";
        $title                      = "";
        $contents                   = "";
        $userIdValue                = "";
        $hits                       = 0;

        @$_SESSION['boardId']       = $boardId;

        $result = $boardObj->select($firstString, $backString, (@$_SESSION['page'] * 5));

        while ($print = mysqli_fetch_array($result)) {
            $title                  = $print['subject'];
            $contents               = $print['contents'];
            $userIdValue            = $print['user_id'];
            $hits                   = $print['hits'];
        }

        if($userIdValue != @$_SESSION['id']) {
            $checkedValue           = "NO";
        }
        else {
            $checkedValue           = "OK";
        }

        $hits++;

        $upString                   = "hits = '$hits'";

        $boardObj->update($boardId, $upString);

        echo $title."|".nl2br($contents)."|".$checkedValue;
    }
    else if($titleText == null && $contentsText == null && $boardId == null && $selectValue == null
        && $searchText == null && $updateTitle != null && $updateContents != null && $delete == null) {

        $currentTime    = date("Y-m-d H:m:s");

        $upString       = "subject = '$updateTitle', contents = '$updateContents', reg_date = '$currentTime'";
        $boardVal       = @$_SESSION['boardId'];

        $boardObj->update($boardVal, $upString);

        echo $boardVal;
    }
    else if($firstUp != null) {
        $firstString    = "";
        $backString     = "WHERE board_id = ".@$_SESSION['boardId'];

        $result         = $boardObj->select($firstString, $backString, (@$_SESSION['page'] * 5));

        while ($print   = mysqli_fetch_array($result)) {
            $title      = $print['subject'];
            $contents   = $print['contents'];
        }

        echo $title."|".$contents;
    }
    else if($titleText == null && $contentsText == null && $boardId == null && $selectValue == null
        && $searchText == null && $updateTitle == null && $updateContents == null && $delete != null) {
        $boardObj->delete($_SESSION['boardId']);

        unset($_SESSION['boardId']);

        echo "OK";
    }
    else {
        $firstString    = "";
        $backString     = "";

        $result         = $boardObj->select($firstString, $backString, (@$_SESSION['page'] * 5));

        while($print = mysqli_fetch_array($result)) {
            echo "<tr>
                    <td>$print[board_id]</td>
                    <td><a id='$print[board_id]'data-target='#modalReading' data-toggle='modal' onclick='reading(event.target.id)'>$print[subject]</a></td>
                    <td>$print[user_id]</td>
                    <td>$print[reg_date]</td>
                    <td>$print[hits]</td>
                  </tr>";
        }
    }