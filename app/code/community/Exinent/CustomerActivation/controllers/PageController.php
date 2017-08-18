<?php

require_once 'Mage/Cms/controllers/PageController.php';
class Exinent_CustomerActivation_PageController extends Mage_Cms_PageController
{

    public function viewAction()
    {
       // echo 'hii';exit;
    $ModuleStatus = Mage::getStoreConfig('customer/customeractivation/disable_ext', Mage::app()->getStore());
    if($ModuleStatus==1){
        $cmsPagesList = Mage::getStoreConfig('customer/customeractivation/require_aunthenticate_cms', Mage::app()->getStore());
        $pages = explode(',', $cmsPagesList);
        $currentUrl = Mage::helper('core/url')->getCurrentUrl();
        $baseUrl = Mage::getBaseUrl();
        $cmspage = explode($baseUrl, $currentUrl);
         $strlen = strlen($cmspage[1]);
         $slashchar = substr($cmspage[1], $strlen-1, $strlen);
        if($slashchar=='/'){
         $cmspage = substr($cmspage[1], 0, -1);
        }else{
           $cmspage = $cmspage[1];
        }
        if(in_array($cmspage, $pages)){

                if(!Mage::getSingleton('customer/session')->isLoggedIn()) {

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
        $pageId = $this->getRequest()
            ->getParam('page_id', $this->getRequest()->getParam('id', false));
        if (!Mage::helper('cms/page')->renderPage($this, $pageId)) {
            $this->_forward('noRoute');
        }
    }
}
