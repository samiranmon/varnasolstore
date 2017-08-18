<?php

class PI_Stores_Block_Adminhtml_Stores_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
	  parent::__construct();
	  $this->setId('stores_tabs');
	  $this->setDestElementId('edit_form');
	  $this->setTitle(Mage::helper('stores')->__('Manage Stores Locations'));
  }

  protected function _beforeToHtml()
  {
	  $this->addTab('personalInfo', array(
		  'label'     => Mage::helper('stores')->__('Stores Information'),
		  'title'     => Mage::helper('stores')->__('Stores Information'),
		  'content'   => $this->getLayout()->createBlock('stores/adminhtml_stores_edit_tab_personal')->toHtml(),
	  ));		 
	 
	  return parent::_beforeToHtml();
  }
}
