<?php

require_once 'Mage/Cms/controllers/IndexController.php';
class Exinent_CustomerActivation_IndexController extends Mage_Cms_IndexController
{

    public function indexAction($coreRoute = null) {

        $pageId = Mage::getStoreConfig(Mage_Cms_Helper_Page::XML_PATH_HOME_PAGE, Mage::app()->getStore());
        if (!Mage::helper('cms/page')->renderPage($this, $pageId)) {
            $this->_forward('defaultIndex');
        }
        $this->loadLayout();
       // $this->renderLayout();

    }

    public function wholesaleAction() {

        $this->loadLayout();
        $this->renderLayout();
    }

    public function wholesaleloginAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

}
