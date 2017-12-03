<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-03
 * Time: 오후 8:19
 */
    //set up canvas
    $height          = 400;
    $width           = 400;

    $im              = imagecreatefromjpeg("title.jpg");

    //Filter apply
    imagefilter($im, IMG_FILTER_GRAYSCALE);

    //output image
    header('Content-type: image/png');
    imagepng($im);

    //clean up
    imagedestroy($im);