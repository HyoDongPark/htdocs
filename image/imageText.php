<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-03
 * Time: 오후 7:54
 */
    //set up canvas
    $height             = 200;
    $width              = 200;

    $im                 = imagecreatetruecolor($width, $height);
    $orangeRedBack      = imagecolorallocate($im,255,051,000);
    $white              = imagecolorallocate($im, 255,255,255);

    //draw on canvas
    imagefill($im,0,0,$white);

    //image String Text
    imagestring($im, 20, 100, 120, "yhee~", $orangeRedBack);

    //output image
    header('Content-type: image/png');
    imagepng($im);

    //clean up
    imagedestroy($im);