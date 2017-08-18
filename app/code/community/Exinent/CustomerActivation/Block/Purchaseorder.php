<?php

class Exinent_CustomerActivation_Block_Purchaseorder extends Mage_Payment_Block_Form_Purchaseorder {

    protected function _construct() {
        parent::_construct();
        $this->setTemplate('customerActivation/form/purchaseorder.phtml');
    }

}
