<?php
/**
 * Created by PhpStorm.
 * User: anthonypucelle
 * Date: 2019-03-14
 * Time: 14:36
 */

require_once "../../static_block/res2_bdd.php";

class Slider extends BDD
{

    const screen_width               = '1420';
    const screen_height              = '950';
    const screenThumb_width          = '465';
    const screenThumb_height         = '311';
    const screenMedia_path           = '../../../slider/images/';
    const screenMedia_path_thumbs    = SELF::screenMedia_path . 'thumbs/';
    const screenMedia_path_master    = SELF::screenMedia_path . 'master/';
    const screenMedia_max            = '10000000';
    const screenMedia_extensions     = array('jpg', 'jpeg');

    function deleteScreen ($Id) {

        $screen_ordre = $this->getScreenOrderPerId($Id);

        $query = $this->getPdo()->query("UPDATE screen SET Ordre= Ordre -1 WHERE Ordre > ' $screen_ordre[0] ' ");

        $query->closeCursor();

        $delete= $this->getPdo()->query("DELETE FROM screen WHERE ID = ' $Id ' ");

        $delete->closeCursor();

        header("Location:../../admin.php?page=screen&delete=on");

        exit;
    }
    
    function resizeScreenImage ($image, $target_width, $target_height){

        $image_source   = imagecreatefromjpeg($image['tmp_name']) or die ("Erreur");

        $image_new      = imagecreatetruecolor($target_width, $target_height) or die ("Erreur");
        $image_sizes    = array();
        
        list($image_width, $image_height) = getimagesize($image['tmp_name']);
        $image_ratio        = $image_width / $image_height;
        $screen_ratio       = $target_width / $target_height;

        if ( $image_ratio >= $screen_ratio){
            $image_sizes['yo']     = $image_height;
            $image_sizes['xo']     = ceil(($image_sizes['yo'] * $target_width) / $target_height);
            $image_sizes['xo_ini'] = ceil(($image_width - $image_sizes['xo']) / 2 );
            $image_sizes['xy_ini'] = 0;
        } else {
            $image_sizes['xo'] = $image_width;
            $image_sizes['yo'] = ceil(($image_sizes['xo'] * $target_height) / $target_width);
            $image_sizes['xy_ini'] = ceil(($image_height - $image_sizes['yo']) / 2 );
            $image_sizes['xo_ini'] = 0;
        }

        imagecopyresampled($image_new, $image_source, 0, 0, $image_sizes['xo_ini'], $image_sizes['xy_ini'], $target_width, $target_height, $image_sizes['xo'], $image_sizes['yo']);

        return $image_new;

    }

    function uploadScreenImage ($image) {

        $url_referer        = $_SERVER['HTTP_REFERER'];
        $image_path         = pathinfo($image['name']);
        $image_extension    = strtolower($image_path['extension']);

        // ==========================
        // TEST FILE
        // $check = $this->checkScreenImageSize($image);
        // TODO: move this into its own function
        // ==========================

        if (filesize($image['tmp_name']) > SELF::screenMedia_max){

            header("Location:".$url_referer."&size=on");
            exit;

        } else if (!in_array($image_extension, SELF::screenMedia_extensions)) {

            header("Location:".$url_referer."&ext=on");
            exit;

        }

        $image_newName  = time();
        $image_fullName   = $image_newName.'.'.$image_extension;


        // Resize and save main image
        $image_new        = $this->resizeScreenImage($image,SELF::screen_width, SELF::screen_height);
        imagejpeg($image_new , SELF::screenMedia_path.$image_fullName);

        // Resize and save thumb image
        $imageThumb_new   = $this->resizeScreenImage($image,SELF::screenThumb_width, SELF::screenThumb_height);
        imagejpeg($imageThumb_new , SELF::screenMedia_path_thumbs.$image_fullName);

        // Save master image
        $image_source   = imagecreatefromjpeg($image['tmp_name']) or die ("Erreur");
        imagejpeg($image_source, SELF::screenMedia_path_master.$image_fullName);

        return $image_fullName;

    }

    function saveImageDB($reference, $image_name){

        if ($reference) {
            $query = $this->getPdo()->prepare("UPDATE screen SET Picture = :image WHERE Reference = :ref");

            $query->execute(array(
                'image' => $image_name,
                'ref' => $reference
            ));

            return true;
        }else{
            return false;
        }

    }

    function getScreenDetailsPerRef($reference){

        $query = $this->getPdo()->query("SELECT * FROM screen WHERE Reference = '$reference' ");

        return $query->fetch();

    }

    function getScreenOrderPerRef($reference){
        $query = $this->getPdo()->query("SELECT Ordre FROM screen WHERE Reference = '$reference' ");

        return $query->fetch();
    }

    function getScreenOrderPerId($Id){
        $query = $this->getPdo()->query("SELECT Ordre FROM screen WHERE ID = '$Id' ");

        return $query->fetch();
    }

    function getPropertyDetailsPerRef($reference) {

        $query = $this->getPdo()->query("SELECT * FROM property WHERE Reference = '$reference' ");

        return $query->fetch();

    }

    function getScreenLatestOrdre(){

        $query = $this->getPdo()->query("SELECT Ordre FROM screen ORDER BY Ordre DESC LIMIT 0,1");
        $ordre = $query->fetch();
        $ordre = $ordre[0];
        $ordre++;

        return $ordre;
    }

    function generateNewReference($street){
        $reference_street = substr(htmlentities($street), 0, 3);
        $checkok = false;

        while($checkok != true){

            $reference_number = rand (100000, 999999);
            $reference = $reference_street."-".$reference_number;

            $checkref = $this->getScreenDetailsPerRef($reference);

            $checkok = ($checkref) ? false : true;

        }

        return $reference;
    }

//    EDIT SCREEN
    function editScreen ($POST, $Id, $advertising) {

        $reference      = $POST['Ref'];
        $screen_details = ($reference) ? $this->getScreenDetailsPerRef($reference) : '';

        if ($screen_details) {

            // =================================================
            // REGENERATE A REFERENCE IF STREET NAME HAS CHANGED
            // =================================================
            if ($POST['Street'] != $screen_details['Street']) {
                $reference = $this->generateNewReference($POST['Street']);
            }

        }

        if (!$advertising) {

            $property_reference = $POST['Reference'];

            $property = ($property_reference) ? $this->getPropertyDetailsPerRef($property_reference) : '';
            $category = ($property) ? ($POST['Category_reference']) ? $POST['Category_reference'] : $POST['Category'] : $POST['Category'];

            ($property) ? $this->updateScreenDB($property, $property_reference, $category, $Id) : $this->updateScreenDB($POST, $reference, $category, $Id);

        } else {
            $this->updateScreenAdvertisingDB($POST, $reference, $Id);
        }

    }

    function updateScreenDB($data, $reference, $category, $Id) {

        $query = $this->getPdo()->prepare("UPDATE screen SET Reference = :ref, Category= :category, Type= :type, Street= :street, Postcode= :postcode, Area= :area, Price= :price, PricePer= :per, Bedroom= :bedroom WHERE ID='$Id'");

        $query->execute(array(

            'ref'       => $reference,
            'category'  => $category,
            'type'      => htmlentities($data['Type']),
            'street'    => htmlentities($data['Street']),
            'postcode'  => htmlentities($data['Postcode']),
            'area'      => htmlentities($data['Area']),
            'price'     => htmlentities($data['Price']),
            'per'       => htmlentities($data['PricePer']),
            'bedroom'   => htmlentities($data['Bedroom'])

        ));

        header("Location:../../admin.php?page=screen&edit=on&reference=".$reference);

        exit;
    }

    function updateScreenAdvertisingDB($data, $reference, $Id)
    {
        $query = $this->getPdo()->prepare("UPDATE screen SET Reference = :ref, Street= :street, Advertising= :advert, Repeatable = :repeat WHERE ID='$Id'");

        $query->execute(array(

            'ref'       => $reference,
            'street'    => htmlentities($data['Street']),
            'advert'    => 'true',
            'repeat'    => false

        ));

        $query->closeCursor();

        header("Location:../../admin.php?page=screen&edit=on&reference=" . $reference);

        exit;
    }

//    ADD NEW SCREEN

    function addScreen ($POST, $image, $ordre, $advertising) {
        
        try
        {
            $reference = $this->generateNewReference($POST['Street']);

            $ordre = ($this->getScreenLatestOrdre()) ? $this->getScreenLatestOrdre() : $ordre;


            if (!$advertising) {

                $property_reference = $POST['Reference'];
                $property = ($property_reference) ? $this->getPropertyDetailsPerRef($property_reference) : '';
                $category = ($property) ? ($POST['Category_reference']) ? $POST['Category_reference'] : $POST['Category'] : $POST['Category'];

                ($property) ? $this->addScreenDB($property, $property_reference, $category, $image, $ordre) : $this->addScreenDB($POST, $reference, $category, $image, $ordre);

            } else {
                $this->addScreenAdvertisingDB($POST, $reference, $image, $ordre);
            }

        }

        catch(Exception $e)
        {
            die('Erreur : ' .$e->getMessage());
        }
    }

    function addScreenDB($data, $reference, $category, $image, $ordre) {

        $query = $this->getPdo()->prepare("INSERT INTO screen (Reference, Category, Type, Street, Postcode, Area, Price, PricePer, Ordre, Picture, Thumbnail, Advertising, Repeatable, Bedroom) VALUE (:reference, :category, :type, :street, :postcode, :area, :price, :per, :ordre, :image, :thumbnail, :advertising, :repeatable, :bedroom)");

        $query->execute(array(
            'reference' => $reference,
            'category'  => $category,
            'type'      => htmlentities($data['Type']),
            'street'    => htmlentities($data['Street']),
            'postcode'  => htmlentities($data['Postcode']),
            'area'      => htmlentities($data['Area']),
            'price'     => htmlentities($data['Price']),
            'per'       => htmlentities($data['PricePer']),
            'ordre'     => htmlentities($ordre),
            'image'     => $image,
            'thumbnail' => '',
            'advertising' => 'false',
            'repeatable' => false,
            'bedroom'   => htmlentities($data['Bedroom'])

        ));

        $query->closeCursor();

        header("Location:../../admin.php?page=screen");

        exit;
    }

    function addScreenAdvertisingDB($data, $reference, $image, $ordre){

        $query = $this->getPdo()->prepare("INSERT INTO screen (Reference, Street, Advertising, Ordre, Picture, Repeatable) VALUE (:reference, :street, :advert, :ordre, :image, :repeatable)");

        $query->execute(array(
            'reference' => $reference,
            'street' => $data['Street'],
            'advert' => 'true',
            'ordre' => $ordre,
            'image' => $image,
            'repeatable' => false
        ));

        $query->closeCursor();

        header("Location:../../admin.php?page=screen");

        exit;
    }
}