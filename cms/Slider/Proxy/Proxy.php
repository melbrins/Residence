<?php

include $_SERVER['DOCUMENT_ROOT'].'/cms/Slider/Block/Slider.php';

$slider = new Slider();

if ($_GET['function2call'] === 'refresh-images') {
    echo $slider->refreshImages();
} else if ($_GET['function2call'] === 'resize-images') {
    echo $slider->resizeImages();
} else if ($_GET['function2call'] === 'update-slider-settings') {
    $result = $slider->updateSliderSettings($_GET['style']);

    if ($result === 'success') {
        header("Location:../../admin.php?page=screen&setting_update=success");
        exit;
    }
}


?>