<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-12-19
 * Time: 오후 2:17
 */
    include_once "dataInfo/itemList.php";

    $checkedPage = @$_POST['num'];

    $itemListObj = new itemList();

    $backString = "limit $checkedPage, 3";

    $result     = $itemListObj->select($backString);
    while ($print = mysqli_fetch_array($result)) {
        echo "<td width='250'><div>
                    <img src='$print[productimgsrc]' width='250' height='250'><br>
                    $print[productname] <br>
                    $print[productdescription] <br>
                    가격: $print[productprice] $<br>
                    재고: $print[productstock] 개 <br>
                    <input type='button' id='$print[productname]' value='장바구니 담기' onclick='addBucket(event.target.id)'>
                </div></td>";
    }

