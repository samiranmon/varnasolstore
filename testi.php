<?php

$mageFilename = 'app/Mage.php';
require_once $mageFilename;
Mage::setIsDeveloperMode(true);
ini_set('display_errors', 1);
umask(0);
Mage::app('admin');
Mage::register('isSecureArea', 1);
echo"Imported";


for ($i = 10; $i < 20; $i++) {
    Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID); //
    $product = Mage::getModel('catalog/product');
    $rand = rand(1, 9999);
    $product->setTypeId('simple')//type
            ->setAttributeSetId(4) // default attribute set
            ->setSku('Test1' . $i) // generate a random SKU
            ->setWebsiteIDs(array(1))
    ;
    $product
            ->setCategoryIds(array(2,28,29,30,31))
            ->setStatus(Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
            ->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH) // visible in catalog and search
    ;
    $product->setStockData(array(
        'use_config_manage_stock' => 0, // use global config?
        'manage_stock' => 1, // should we manage stock or not?
        'is_in_stock' => 1,
        'qty' => 5,
    ));
    $product
            ->setName('Test Product #' . $i) // add string attribute
            ->setShortDescription('Test Product #' . $i)  // add text attribute
            ->setDescription('Test Product #' . $i)  // add text attribute
            ->setPrice(24.50)
            ->setSpecialPrice(19.99)
            ->setTaxClassId(2)    // Taxable Goods by default
            ->setWeight(87)
    ;
    $product->save();
}

