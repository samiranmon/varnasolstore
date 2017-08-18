<?php

class Exinent_CustomerActivation_Model_Resource_Attribute_Source_Customeractivation extends Mage_Eav_Model_Entity_Attribute_Source_Abstract {

    public function getAllOptions() {
        if ($this->_options === null) {
            $this->_options = array(
                array(
                    'value' => 'New',
                    'label' => 'New',
                ),
               
                array(
                    'value' => '1',
                    'label' => 'Approved',
                ),
               
            );
        }
        return $this->_options;
    }

    public function getOptionArray() {
        $_options = array();
        foreach ($this->getAllOptions() as $option) {
            $_options[$option['value']] = $option['label'];
        }
        return $_options;
    }

    public function getOptionText($value) {
        $options = $this->getAllOptions();
        foreach ($options as $option) {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }
        return false;
    }

}
