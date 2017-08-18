<?php
class PI_Stores_Block_Adminhtml_Stores extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    
    $this->_controller = 'adminhtml_stores';
    $this->_blockGroup = 'stores';
    $this->_headerText = Mage::helper('stores')->__('Manage Stores Location');
    $this->_addButtonLabel = Mage::helper('stores')->__('Add New');

    parent::__construct();
  }
}
