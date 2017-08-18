<?php

class Exinent_CustomerActivation_Model_Resource_Attribute_Source_StoreType extends Mage_Eav_Model_Entity_Attribute_Source_Abstract {

    /**
     * Retrieve all options array
     *
     * @return array
     */
    public function getAllOptions() {

        if (is_null($this->_options)) {
            $this->_options = array(
                array(
                    'label' => 'Outdoor',
                    'value' => 'outdoor'
                ),
                array(
                    'label' => 'Surf',
                    'value' => 'surf'
                ),
                array(
                    'label' => 'Fashion',
                    'value' => 'fashion'
                ),
                array(
                    'label' => 'Natural_Food',
                    'value' => 'naturalfood'
                ),
                array(
                    'label' => 'Wellness - Yoga/Pilates/Medical/Spa/Beauty',
                    'value' => 'wellness'
                ),
                array(
                    'label' => 'Hospitality - Hotels',
                    'value' => 'hospitalityh'
                ),
                array(
                    'label' => 'Sporting_Goods',
                    'value' => 'sportinggoods'
                ),
                array(
                    'label' => 'Gift_Shop',
                    'value' => 'giftshop'
                ),
                array(
                    'label' => 'Footwear_Only',
                    'value' => 'footwear'
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
            if ($option["value"] == $value) {
                return $option["label"];
            }
        }
        return false;
    }

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
