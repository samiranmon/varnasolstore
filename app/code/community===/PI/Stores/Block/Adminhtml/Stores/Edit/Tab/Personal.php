<?php
class PI_Stores_Block_Adminhtml_Stores_Edit_Tab_Personal extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
	  $form = new Varien_Data_Form();
	  $this->setForm($form);
	  $fieldset = $form->addFieldset('stores_form', array('legend'=>Mage::helper('stores')->__('Stores information')));

	  $hlp = Mage::helper('stores');	

	 	$fieldset->addField('store_name', 'text', array(
		  'label'     => $hlp->__('Store Name'),
		  'class'     => 'required-entry',
		  'required'  => true,
		  'name'      => 'store_name',
		  
	  ));



		$fieldset->addField('phonenumber', 'text', array(
		  'label'     => $hlp->__('Phone Number'),
		  'name'      => 'phonenumber',
		  
	  ));

		$fieldset->addField('email', 'text', array(
		  'label'     => $hlp->__('E-Mail'),
		  'name'      => 'email',
		  
	  ));

		$fieldset->addField('web', 'text', array(
		  'label'     => $hlp->__('Web'),
		  'name'      => 'web',
		  
	  ));
	  
	 	$fieldset->addField('address1', 'editor', array(
		  'label'     => $hlp->__('Address'),	  
		  'name'      => 'address1',
		  
	  ));
	  
	  /*$fieldset->addField('address2', 'editor', array(
		  'label'     => $hlp->__('Address Line 2'),
		  'name'      => 'address2',
		  
	  ));*/
	  
	  $fieldset->addField('city', 'text', array(
		  'label'     => $hlp->__('City'),			  
		  'name'      => 'city',
		  
	  ));
	  
	  	  
	   $fieldset->addField('postcode', 'text', array(
		  'label'     => $hlp->__('Postcode'),
		  'class'     => 'required-entry',
		  'required'  => true,
		  'name'      => 'postcode',
		  
	  ));
	  
	  $contentField = $fieldset->addField('country', 'note', array(
		 // 'label'     => $hlp->__('Country'),		  
		  //'required'  => true,
		 // 'name'      => 'country',
		  //'values'    => Mage::getModel('adminhtml/system_config_source_country')->toOptionArray(), 
    
	  ));
		
		$renderer = $this->getLayout()->createBlock('stores/adminhtml_country')
                    ->setTemplate('stores/country.phtml');
    $contentField->setRenderer($renderer);		  	

	 
	if ( Mage::registry('stores_data') ) { 
          $form->setValues(Mage::registry('stores_data')->getData());
	 
	}
	
  }
}

?>

