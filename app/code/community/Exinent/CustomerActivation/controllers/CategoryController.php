<?php

include(Mage::getBaseDir() . "/app/code/core/Mage/Catalog/controllers/CategoryController.php");

class Exinent_CustomerActivation_CategoryController extends Mage_Catalog_CategoryController {

    protected function _initCatagory() {
        $ModuleStatus = Mage::getStoreConfig('customer/customeractivation/disable_ext', Mage::app()->getStore());
        if ($ModuleStatus == 1) {
            $cmsPagesList = Mage::getStoreConfig('customer/customeractivation/require_aunthenticate_categories', Mage::app()->getStore());
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
                } else {
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
                }
            }
        }
        Mage::dispatchEvent('catalog_controller_category_init_before', array('controller_action' => $this));
        $categoryId = (int) $this->getRequest()->getParam('id', false);
        if (!$categoryId) {
            return false;
        }

        $category = Mage::getModel('catalog/category')
                ->setStoreId(Mage::app()->getStore()->getId())
                ->load($categoryId);

        if (!Mage::helper('catalog/category')->canShow($category)) {
            return false;
        }
        Mage::getSingleton('catalog/session')->setLastVisitedCategoryId($category->getId());
        Mage::register('current_category', $category);
        Mage::register('current_entity_key', $category->getPath());

        try {
            Mage::dispatchEvent(
                    'catalog_controller_category_init_after', array(
                'category' => $category,
                'controller_action' => $this
                    )
            );
        } catch (Mage_Core_Exception $e) {
            Mage::logException($e);
            return false;
        }

        return $category;
    }

}
