<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-12-25
 * Time: 오후 12:49
 */
    include_once "dataInfo/orderList.php";


    $orderObj       = new orderList();

    $backString     = "userid = 'test' AND recordtime > CURRENT_DATE()";

    $result         = $orderObj->select($backString);

    while ($print   = mysqli_fetch_array($result)) {
        $resultVal  = @$print[productid] * @$print[orderitemnum];

        echo "<tr>
                <td>$print[ordernum]</td>
                <td>$print[name]</td>
                <td>$print[orderitemnum]</td>
                <td>$print[productid]</td>
                <td>$resultVal</td>
                <td>$print[recordtime]</td>
              </tr>";
    }