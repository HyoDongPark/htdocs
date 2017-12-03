<?php
/**
 * Created by PhpStorm.
 * User: 영진전문대 박효동
 * Date: 2017-12-03
 * Time: 오후 8:10
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
imagerectangle($im, 100, 100, 200, 200, $white);

//output image
header('Content-type: image/png');
imagepng($im);

//clean up
imagedestroy($im);
