<?php

include $_SERVER['DOCUMENT_ROOT'].'/cms/Slider/Block/Slider.php';

$slider = new Slider();

if ($_GET['function2call'] === 'refresh-images') {
    echo $slider->refreshImages();
} else if ($_GET['function2call'] === 'resize-images') {
    echo $slider->resizeImages();
}


?>