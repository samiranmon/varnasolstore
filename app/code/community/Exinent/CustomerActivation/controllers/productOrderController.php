<?php

class Exinent_CustomerActivation_productOrderController extends Mage_Core_Controller_Front_Action {

    public function preDispatch() {
        parent::preDispatch();
        $action = $this->getRequest()->getActionName();
        $loginUrl = Mage::helper('customer')->getLoginUrl();
        $ModuleStatus = Mage::getStoreConfig('customer/customeractivation/disable_ext', Mage::app()->getStore());

        $customerGroups = Mage::getStoreConfig('customer/customeractivation/require_activation_groups', Mage::app()->getStore());
        $customers = explode(',', $customerGroups);
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        $customerId = $customer->getGroupId();
        if (in_array($customerId, $customers)) {
            
        } else {
            Mage::app()->getFrontController()->getResponse()
                    ->setRedirect(Mage::getBaseUrl())
                    ->sendResponse();
        }
        if (!Mage::getSingleton('customer/session')->authenticate($this, $loginUrl)) {
            $this->setFlag('', self::FLAG_NO_DISPATCH, true);
        } else if ($ModuleStatus == 0) {
            Mage::app()->getFrontController()->getResponse()
                    ->setRedirect(Mage::getBaseUrl())
                    ->sendResponse();
        }
    }

    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function quickorderproductAction() {
        Mage::log('quickorderproductAction',null,'yams.log');
        $this->loadLayout();
        $this->renderLayout();
    }

    public function submitorderbySimpleproductAction() {
          //Mage::log('tsfdsf',null,'yams.log');
        $minQty = Mage::getStoreConfig('customer/customeractivation/min_qty', Mage::app()->getStore());

        $params = $this->getRequest()->getParams();

        $cart = Mage::getModel('checkout/cart');
        foreach ($params as $sku => $qty) {

            $ids = explode('_', $sku);
            $productId = $ids[0];
            $product = Mage::getModel('catalog/product')->load($productId);

            if (($qty != null || $qty != '') && is_numeric($qty)) {
                
                $stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product);
                $productQty = $stock->getQty();

                if ($qty < $minQty )
                $qty = $minQty;
                if($qty > $productQty){
                    $message = Mage::helper('cataloginventory')->__('The requested quantity for "%s" is not available.', $product->getName());
                    Mage::getSingleton('core/session')->addError($message);
                    $options = array("product" => $productId, "qty" => $productQty);
                    $cart->addProduct($product, $options);
                }else{
                    $options = array("product" => $productId, "qty" => $qty);
                    $cart->addProduct($product, $options);
                }
            }
        }
        $cart->save();
        $this->_redirect('checkout/cart');
    }

    public function submitorderbyproductAction() {
        $params = $this->getRequest()->getParams();
        $cart = Mage::getModel('checkout/cart');
        foreach ($params as $sku => $qty) {
            $ids = explode('_', $sku);
            $confId = $ids[0];
            $productId = $ids[1];
            $_product = Mage::getModel('catalog/product')->load($productId);
            $optionvalue = $_product->getSize();
            $product = Mage::getModel('catalog/product')->load($confId);
            $options = array("product" => $productId, "super_attribute" => array(134 => $optionvalue), "qty" => $qty);
            if (($qty != null || $qty != '') && is_numeric($qty)) {
                $cart->addProduct($product, $options);
            }
        }
        $cart->save();
        $this->_redirect('checkout/cart');
    }

}
