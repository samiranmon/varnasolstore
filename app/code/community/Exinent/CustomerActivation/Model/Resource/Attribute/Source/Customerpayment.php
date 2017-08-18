<?php

class Exinent_CustomerActivation_Model_Resource_Attribute_Source_Customerpayment extends Mage_Eav_Model_Entity_Attribute_Source_Abstract {

     public function getAllOptions() {

        if (is_null($this->_options)) {
            $this->_options = array(
                array(
                    'label' => 'Net30',
                    'value' => 'net30'
                ),
                array(
                    'label' => 'Net15',
                    'value' => 'net15'
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

    /**
     * Get a text for option value
     *
     * @param string|integer $value
     * @return string
     */
    public function getOptionText($value) {
        $options = $this->getAllOptions();
        foreach ($options as $option) {
            if ($option["value"] == $value) {
                return $option["label"];
            }
        }
        return false;
    }

    /**
     * Retrieve Column(s) for Flat
     *
     * @return array
     */
    public function getFlatColums() {
        $columns = array(
            $this->getAttribute()->getAttributeCode() => array(
                'type' => 'int',
                'unsigned' => false,
                'is_null' => true,
                'default' => null,
                'extra' => null
            )
        );
        return $columns;
    }

    public function getFlatUpdateSelect($store) {
        return Mage::getResourceModel('eav/entity_attribute')
                        ->getFlatUpdateSelect($this->getAttribute(), $store);
    }


}
