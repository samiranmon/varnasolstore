<?php

$mageFilename = 'app/Mage.php';
require_once $mageFilename;
Mage::setIsDeveloperMode(true);
ini_set('display_errors', 1);
umask(0);
Mage::app('admin');
Mage::register('isSecureArea', 1);
echo"Imported";

$gallery_img = 'demo.jpeg';
for ($i = 27; $i < 40; $i++) {
    $product = Mage::getModel('catalog/product')->load($i);
    //echo $product->getName();
    $filePath = Mage::getBaseDir('media') . DS . 'import' . DS . $gallery_img;
    if (file_exists(Mage::getBaseDir('media') . DS . 'import' . DS . $gallery_img)) {
        echo "exist";
        //$product->addImageToMediaGallery(Mage::getBaseDir('media') . DS . 'import' . DS . $gallery_img, false, false);
        $product->addImageToMediaGallery($filePath, array('image', 'small_image', 'thumbnail'), false, false);
    }
}
//($filePath, array('image', 'small_image', 'thumbnail'), false, false)