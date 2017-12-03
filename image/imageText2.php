<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-03
 * Time: 오후 8:01
 */
    $height             = 400;
    $width              = 400;

    $im                 = imagecreatetruecolor($width, $height);
    $color              = imagecolorallocate($im,051,255,000);
    $white              = imagecolorallocate($im, 255,255,255);

    //draw on canvas
    imagefill($im,0,0,$white);

    //image String Text
    imagettftext($im, 20, 90, 100, 100, $color, '08SeoulNamsanEB.ttf', "Yahoo");

    //output image
    header('Content-type: image/png');
    imagepng($im);

    //clean up
    imagedestroy($im);