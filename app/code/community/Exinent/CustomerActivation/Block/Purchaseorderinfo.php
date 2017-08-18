<?php

class Exinent_CustomerActivation_Block_Purchaseorderinfo extends Mage_Payment_Block_Info {

    protected function _construct() {
        parent::_construct();
        $this->setTemplate('customerActivation/info/purchaseorder.phtml');
    }

    public function toPdf() {
        $this->setTemplate('payment/info/pdf/purchaseorder.phtml');
        return $this->toHtml();
    }

}
