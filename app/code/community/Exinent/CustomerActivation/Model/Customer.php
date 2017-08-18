<?php

class Exinent_CustomerActivation_Model_Customer extends Mage_Customer_Model_Customer {

    public function authenticate($login, $password) {
        $groupid = Mage::registry('groupId');
        if ($groupid == 2) {
            $collection = Mage::getModel('customer/customer')->getCollection()->addFieldToFilter('uniquelogin_id', $login);
            $custData = $collection->getData();
            $login = $custData[0]['email'];
        }
        return parent::authenticate($login, $password);
    }

}
