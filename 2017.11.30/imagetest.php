<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-11-30
 * Time: 오후 12:45
 */
    $width  = 200;
    $height = 200;

    $image  = imagecreatetruecolor($width, $height);
    $white  = imagecolorallocate($image, 255,255,255);
    $blue   = imagecolorallocate($image, 0,0,64);

    imagefill($image, 0, 0, $blue);
    imageline($image, 0, 0, $width, $height, $white);
    imagestring($image, 4, 50, 150, 'value', $white);

    header("Content-type: image/png");
    imagepng($image);

    imagedestroy($image);

