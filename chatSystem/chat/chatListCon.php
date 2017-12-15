<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-12-12
 * Time: 오후 12:38
 */
    require_once '../classes.php';

    $chatListObj    = new chatList();

    $firstString    = "room_num, room_name, room_master, room_numpeople";
    $backString     = " ";

    $result         = $chatListObj->select($firstString, $backString);

    if(!is_null($result) && $result != false) {
        while ($print = mysqli_fetch_array($result)) {
            echo "<tr>
                <td>$print[room_num]</td>
                <td><a id='$print[room_num]' onclick='intoRoom(event.target.id)'>$print[room_name]</a></td>
                <td>$print[room_master]</td>
                <td>$print[room_numpeople]</td>
              </tr>";
        }
    }
