<?php

class Exinent_CustomerActivation_Block_Orderproduct extends Mage_Core_Block_Template {

    public function getSubCategories() {
        $cat = Mage::getModel('catalog/category')->load(2);
        return $cat->getChildren();
    }

    public function getCategoryObject($subCatid) {
        return Mage::getModel('catalog/category')->load($subCatid);
    }

    public function getProductCollection($_category) {
        $productCollection = Mage::getResourceModel('catalog/product_collection')
                ->addCategoryFilter($_category)
                ->addAttributeToFilter('type_id', 'configurable')
                ->addAttributeToSelect('*');
        return $productCollection;
    }

    public function loadProduct($productId) {
        return Mage::getModel('catalog/product')->load($productId);
    }

    public function getAttributes($product) {
        $attributes = $product->getTypeInstance(true)->getConfigurableAttributes($product);
        return $attributes;
    }

    public function getQty($product) {
        $conf = Mage::getModel('catalog/product_type_configurable')->setProduct($product);
        $simple_collection = $conf->getUsedProductCollection()->addAttributeToSelect('*')->addFilterByRequiredOptions();
        $stockArray = array();
        foreach ($simple_collection as $simple_product) {
            if ($simple_product->isSaleable()) {
                $stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($simple_product);
                array_push($stockArray, $stock->getQty());
            }
        }
        return $stockArray;
    }

    public function getSku($product) {
        $conf = Mage::getModel('catalog/product_type_configurable')->setProduct($product);
        $simple_collection = $conf->getUsedProductCollection()->addAttributeToSelect('*')->addFilterByRequiredOptions();
        $stockArray = array();
        foreach ($simple_collection as $simple_product) {
            if ($simple_product->isSaleable()) {
                array_push($stockArray, $simple_product->getId());
            }
        }
        return $stockArray;
    }

    public function getOrderSimpleProducts() {

        $collectionSimple = Mage::getResourceModel('catalog/product_collection')
                        ->addAttributeToFilter('type_id', array('eq' => 'simple'))->addAttributeToSelect('*');
        $i = 0;
        foreach ($collectionSimple as $product) {
            if ($product->isSaleable()) {
				$Products_one = Mage::getModel('catalog/product')->load($product->getId());
                $orderProduct[$i]['product_id'] = $product->getId();
                $orderProduct[$i]['product_url'] = $product->getUrlKey();
                $orderProduct[$i]['name'] = $product->getName();
                $orderProduct[$i]['price'] = $product->getFinalPrice();
                $orderProduct[$i]['sku'] = $product->getSku();
                $orderProduct[$i]['image'] = $Products_one->getImageUrl();
                $i++;
            }
        }
        return $orderProduct;
    }

    public function getOrderProduct() {
       // Mage::log('getOrderProduct',null,'yams.log');
        $orderProducts = array();
        $categoryArray = array();
        $data = array();
        $collectionSimple = Mage::getResourceModel('catalog/product_collection')
                ->addAttributeToFilter('type_id', array('eq' => 'simple'));
        $orderProduct['category'] = $_category->getName();
        array_push($categoryArray, $_category->getName());
        $orderProduct['name'] = $product->getName();
        $orderProduct['image'] = $product->getImageUrl();
        $orderProduct['qty'] = $this->getQty($product);
        $orderProduct['sku'] = $this->getSku($product);

        $subcats = $this->getSubCategories();
        foreach (explode(',', $subcats) as $subCatid) {
            $_category = $this->getCategoryObject($subCatid);
            if ($_category->getIsActive()) {
                $productCollection = $this->getProductCollection($_category);
                foreach ($productCollection as $product) {
                    $orderProduct = array();
                    $product = $this->loadProduct($product->getId());
                    $orderProduct['category'] = $_category->getName();
                    array_push($categoryArray, $_category->getName());
                    $orderProduct['confsku'] = $product->getSku();
                    $orderProduct['conf_id'] = $product->getId();
                    $orderProduct['name'] = $product->getName();
                    $orderProduct['image'] = $product->getImageUrl();
                    $orderProduct['qty'] = $this->getQty($product);
                    $orderProduct['sku'] = $this->getSku($product);
                    if (empty($orderProduct['qty'])) {
                        continue;
                    }
                    array_push($orderProducts, $orderProduct);
                }
            }
        }
        $categoryuniquearray = array_unique($categoryArray);
        $data[0] = $categoryuniquearray;
        $data[1] = $orderProducts;
        return $data;
    }

}

?>
