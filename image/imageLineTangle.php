<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-03
 * Time: 오후 8:14
 */
    //set up canvas
    $height          = 400;
    $width           = 400;

    $im              = imagecreatetruecolor($width, $height);
    $orangeRedBack   = imagecolorallocate($im,255,051,000);
    $white           = imagecolorallocate($im,255,255,255);

    //draw on canvas
    imagefill($im,0,0,$orangeRedBack);

    //draw tangle
    imagepolygon($im, array(250, 0, 350, 100, 350, 200, 150, 200, 150, 100), 5, $white);

    //output image
    header('Content-type: image/png');
    imagepng($im);

    //clean up
    imagedestroy($im);