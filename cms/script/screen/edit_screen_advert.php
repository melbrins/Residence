<?php

include '../../../static_block/bdd.php';
include '../../Slider/Block/Slider.php';

$slider = new Slider();

$Id         = $_POST['Clef'];
$reference  = $_POST['Ref'];

if(isset($_POST['delete'])){

    $slider->deleteScreen($reference, $Id);

} else if (isset($_FILES['Image']) AND $_FILES['Image']['error'] == 0) {

    $image              = $_FILES['Image'];
    $image_name         = $slider->uploadScreenImage($image);
    $save_image         = $slider->saveImageDB($reference, $image_name);
    $save_details       = $slider->editScreen($_POST, $Id, true);

} else {

    $save_details       = $slider->editScreen($_POST, $Id, true);

}

?>