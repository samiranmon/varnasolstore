<?php

include(Mage::getBaseDir() . "/app/code/core/Mage/Catalog/controllers/ProductController.php");

class Exinent_CustomerActivation_ProductController extends Mage_Catalog_ProductController {

    public function viewAction() {
        $ModuleStatus = Mage::getStoreConfig('customer/customeractivation/disable_ext', Mage::app()->getStore());
        if($ModuleStatus==1){
            $cmsPagesList = Mage::getStoreConfig('customer/customeractivation/require_aunthenticate_products', Mage::app()->getStore());
            $pages = explode(',', $cmsPagesList);
            $currentUrl = Mage::helper('core/url')->getCurrentUrl();
            $baseUrl = Mage::getBaseUrl();
            $cmspage = explode($baseUrl, $currentUrl);
            $cmspage = explode('.html', $cmspage[1]);
            $position = strrpos($cmspage[0], "/");
            if ($position) {
                $cmspage = substr($cmspage[0], $position + 1);
            } else {
                $cmspage = substr($cmspage[0], $position + 0);
            }

            if (in_array($cmspage, $pages)) {
                if (!Mage::getSingleton('customer/session')->isLoggedIn()) {
                    Mage::app()->getFrontController()->getResponse()
                            ->setRedirect(Mage::getUrl('customer/account/login'))
                            ->sendResponse();
                }else{
                    $customerGroups = Mage::getStoreConfig('customer/customeractivation/require_activation_groups', Mage::app()->getStore());
                    $customers = explode(',', $customerGroups);
                    $customer = Mage::getSingleton('customer/session')->getCustomer();
                    $customerId = $customer->getGroupId();
                    if(in_array($customerId, $customers)){

            
                    }else{
                        Mage::app()->getFrontController()->getResponse()
                            ->setRedirect(Mage::getBaseUrl())
                            ->sendResponse();
                    }
                }
            }
        }
        // Get initial data from request
        $categoryId = (int) $this->getRequest()->getParam('category', false);
        $productId = (int) $this->getRequest()->getParam('id');
        $specifyOptions = $this->getRequest()->getParam('options');

        // Prepare helper and params
        $viewHelper = Mage::helper('catalog/product_view');

        $params = new Varien_Object();
        $params->setCategoryId($categoryId);
        $params->setSpecifyOptions($specifyOptions);

        // Render page
        try {
            $viewHelper->prepareAndRender($productId, $this, $params);
        } catch (Exception $e) {
            if ($e->getCode() == $viewHelper->ERR_NO_PRODUCT_LOADED) {
                if (isset($_GET['store']) && !$this->getResponse()->isRedirect()) {
                    $this->_redirect('');
                } elseif (!$this->getResponse()->isRedirect()) {
                    $this->_forward('noRoute');
                }
            } else {
                Mage::logException($e);
                $this->_forward('noRoute');
            }
        }
    }

}
