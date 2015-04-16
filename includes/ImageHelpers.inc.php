<?php

function resizeImage($imagePath, $width, $height) {
    //The blur factor where &gt; 1 is blurry, &lt; 1 is sharp.
    $imagick = new \Imagick(realpath($imagePath));

    $imagick->resizeImage($width, $height, imagick::FILTER_POINT, 1, false);

    $cropWidth = $imagick->getImageWidth();
    $cropHeight = $imagick->getImageHeight();
    
    $newWidth = $cropWidth / 2;
    $newHeight = $cropHeight / 2;

    $imagick->cropimage(
        $newWidth,
        $newHeight,
        ($cropWidth - $newWidth) / 2,
        ($cropHeight - $newHeight) / 2
    );

    $imagick->scaleimage(
        $imagick->getImageWidth() * 4,
        $imagick->getImageHeight() * 4
    );

    header("Content-Type: image/jpg");
    echo $imagick->getImageBlob();
}