<?php 
class PI_Stores_Block_Adminhtml_Stores_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
  public function __construct()
  { 
	parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'stores';
        $this->_controller = 'adminhtml_stores';
  }

  public function getHeaderText()
  {
	  if( Mage::registry('stores_data') && Mage::registry('stores_data')->getId() ) {
		  return Mage::helper('stores')->__("Edit Stores");
	  } else {
		  return Mage::helper('stores')->__('Add Stores');
	  }
  }
}
