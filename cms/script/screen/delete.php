<?php 

include '../../../static_block/bdd.php';
include '../../Slider/Block/Slider.php';

$slider = new Slider();
$Id     = (int)$_GET['delete'];

if(isset($_GET['delete'])) {

    $slider->deleteScreen($Id);

}

?>