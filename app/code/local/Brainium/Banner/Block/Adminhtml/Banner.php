<?php

class Brainium_Banner_Block_Adminhtml_Banner extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_banner';
        $this->_blockGroup = 'banner';
        $this->_headerText = Mage::helper('banner')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('banner')->__('Add Item');
        parent::__construct();
    }

}
