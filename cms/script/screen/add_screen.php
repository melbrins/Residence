<?php

include '../../../static_block/bdd.php';
include '../../Slider/Block/Slider.php';

$slider = new Slider();

$page           = $_POST['Page'];
$screen_ordre   = $_POST['Num_rows'];

$screen_ordre++;

if(isset($_FILES['Image']) AND $_FILES['Image']['error'] == 0) {

    $image              = $_FILES['Image'];
    $image_name         = $slider->uploadScreenImage($image);
    $save_details       = $slider->addScreen($_POST, $image_name, $screen_ordre, false);

}else{
	header("Location:../../screen_add.php?page=screen&picture_screen=on");
}

?>