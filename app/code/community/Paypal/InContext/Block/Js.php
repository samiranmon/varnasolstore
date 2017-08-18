<?php
class Paypal_InContext_Block_Js extends Mage_Core_Block_Template{
    
    public function _construct(){
        $this->setTemplate('incontext/js.phtml');
    }
    
    public function getJsonConfig(){
        $_secure = false;
        $sheme = Mage::app()->getRequest()->getScheme();
        if ($sheme=='https'){
            $_secure = true;
        }
        
        $merchantId = Mage::getStoreConfig('payment/incontext/merchantid');
        $isActive = Mage::getStoreConfig('payment/incontext/enable');
        
        $environment = 'production';
        if (Mage::getStoreConfig('payment/incontext/sandbox')){
            $environment = 'sandbox';
        }
        if (empty($merchantId)){
            $isActive = false;
        }
        $config = new Varien_Object();
        $config->setData('isActive', $isActive);
        $config->setData('environment', $environment);
        $config->setData('merchantid',  $merchantId);   
        $config->setData('setExpressCheckout', $this->getUrl('incontext/express/start', array('_secure' => $_secure)));
        $config->setData('setExpressCheckoutUk', $this->getUrl('incontext/expressuk/start', array('_secure' => $_secure)));
        
        return Mage::helper('core')->jsonEncode($config);
    }
   
}