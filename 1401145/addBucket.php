<?php
    @include_once "dataInfo/itemList.php";

    if (session_status() == 1) {
        session_start();
    }

    $idValue        = @$_POST['idValue'];

    $itemList       = new itemList();
    $backString     = "WHERE productname = '$idValue'";

    $result         = $itemList->select($backString);


    while (@$print  = mysqli_fetch_array($result)) {
        $tempArray  = array(@$print[productname], @$print[productprice], 1);
    }
    if(empty(@$_SESSION[$idValue])) {
        $_SESSION[$idValue] = $tempArray;
    }
    else {
        foreach (@$_SESSION as $key => $value) {
            if ($key == $idValue) {
                foreach ($value as $valueKey => $item) {
                    if($valueKey == 2) {
                        $item++;
                        $_SESSION[$idValue][$valueKey] = $item;
                    }
                }
            }
        }
    }

    $tempValue      = 0;

    foreach (@$_SESSION as $value) {
        $tempValue++;
        $result = $value[1] * $value[2];
        echo "<tr>
                <td>$tempValue</td>
                <td>$value[0]</td>
                <td>$value[1]</td>
                <td>$value[2]</td>
                <td>$result</td>
              </tr>";
    }
