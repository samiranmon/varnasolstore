<?php

class Exinent_CustomerActivation_Block_Adminhtml_Customer_Edit_Tab_Customerimages extends Mage_Adminhtml_Block_Template implements Mage_Adminhtml_Block_Widget_Tab_Interface {

    public function __construct() {
        //parent::_construct();
        $this->setTemplate('customerActivation/customerImages.phtml');
    }

    public function getCustomtabInfo() {
        $customer = Mage::registry('current_customer');
        $customtab = 'My Custom tab Action Contents Here';
        return $customtab;
    }

    public function getTabLabel() {
        return $this->__('CustomerImages');
    }

    public function getTabTitle() {
        return $this->__('Customer Uploded Images');
    }

    public function canShowTab() {
        $customer = Mage::registry('current_customer');
        return (bool) $customer->getId();
    }

    public function isHidden() {
        return false;
    }

    public function getAfter() {
        return 'tags';
    }

    public function getCustomerimages() {
        $customerId = $this->getRequest()->getParam('id');
        $customerObject = Mage::getModel('customer/customer')->load($customerId);

        return $customerObject;
    }

}
