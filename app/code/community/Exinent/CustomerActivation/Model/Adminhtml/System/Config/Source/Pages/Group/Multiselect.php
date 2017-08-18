<?php

class Exinent_CustomerActivation_Model_Adminhtml_System_Config_Source_Pages_Group_Multiselect {

    protected $_options;

    public function toOptionArray() {
        if (!$this->_options) {
            $this->_options = Mage::getModel('cms/page')->getCollection()
            
              ->addFieldToFilter('is_active',1)
              ->addFieldToFilter('identifier',array(array('nin'=>array('home','enable-cookies'))))->toOptionArray(); 
             // echo '<pre>';print_r($this->_options);
            array_unshift($this->_options, array('value' => '', 'label' => Mage::helper('adminhtml')->__('No page Selected')));
        }
        return $this->_options;
    }

}
