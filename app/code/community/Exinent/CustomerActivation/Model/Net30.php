<?php

class Exinent_CustomerActivation_Model_Net30 extends Mage_Payment_Model_Method_Purchaseorder {

    /**
     * unique internal payment method identifier
     *
     * @var string [a-z0-9_]
     */
    protected $_code = 'net30';
    protected $_formBlockType = 'customeractivation/purchaseorder';
    protected $_infoBlockType = 'customeractivation/purchaseorderinfo';

    public function assignData($data) {
        if (!($data instanceof Varien_Object)) {
            $data = new Varien_Object($data);
        }

        $this->getInfoInstance()->setPoNumber($data->getPoNumber());


        return $this;
    }

}
