<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-12
 * Time: 오후 12:04
 */
    @session_start();

    if(!is_null($_SESSION['id']) && !is_null($_SESSION['pw'])) {
        if(is_null($_SESSION['Checked'])) {
            $_SESSION['Checked'] = 0;
        }
        include_once "../address/checkedBen.php";
        echo "<script>
                location.href = 'roomListPage.html';
              </script>";
    }
    else {
        echo "<script>
                location.href = 'login.html';
              </script>";
    }