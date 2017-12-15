<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-12-12
 * Time: 오전 9:36
 */
    require_once '../classes.php';

    $hostname               = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $objBenChecked          = new addressBen();
    $result                 = $objBenChecked->select();

    while ($checked = mysqli_fetch_array($result)) {
        if($checked[MacAddress] == $hostname) {
            echo "<script>
                    alert('가서 네이버나 보세요.');
                    location.href = 'www.naver.com';
                  </script>";
        }
    }
