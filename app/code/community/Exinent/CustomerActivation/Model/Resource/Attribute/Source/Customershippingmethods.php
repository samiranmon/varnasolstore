<?php

class Exinent_CustomerActivation_Model_Resource_Attribute_Source_Customershippingmethods extends Mage_Eav_Model_Entity_Attribute_Source_Abstract {

    public function getAllOptions() {
        if (is_null($this->_options)) {
            $activeCarriers = Mage::getSingleton('shipping/config')->getActiveCarriers();
            foreach ($activeCarriers as $carrierCode => $carrierModel) {
                $allCarriers[$carrierCode] = array('value' => Mage::getStoreConfig('carriers/' . $carrierCode . '/title', Mage::app()->getStore()), 'label' => Mage::getStoreConfig('carriers/' . $carrierCode . '/title', Mage::app()->getStore()));
            }
            return $allCarriers;
        }
    }

    public function getOptionArray() {
        $_options = array();
        foreach ($this->getAllOptions() as $option) {
            $_options[$option["value"]] = $option["label"];
        }
        return $_options;
    }

    public function getOptionText($value) {
        $options = $this->getAllOptions();
        foreach ($options as $option) {
            if ($option["value"] == $value) {
                return $option["label"];
            }
        }
        return false;
    }

    public function getFlatColums() {
        $columns = array();
        $columns[$this->getAttribute()->getAttributeCode()] = array(
            "type" => "tinyint(1)",
            "unsigned" => false,
            "is_null" => true,
            "default" => null,
            "extra" => null
        );

        return $columns;
    }

    public function getFlatIndexes() {
        $indexes = array();

        $index = "IDX_" . strtoupper($this->getAttribute()->getAttributeCode());
        $indexes[$index] = array(
            "type" => "index",
            "fields" => array($this->getAttribute()->getAttributeCode())
        );

        return $indexes;
    }

    public function getFlatUpdateSelect($store) {
        return Mage::getResourceModel("eav/entity_attribute")
                        ->getFlatUpdateSelect($this->getAttribute(), $store);
    }

}
