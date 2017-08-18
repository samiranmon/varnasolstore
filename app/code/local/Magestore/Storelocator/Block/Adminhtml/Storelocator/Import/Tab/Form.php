<?php
/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_Storelocator
 * @module      Storelocator
 * @author      Magestore Developer
 *
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 *
 */

/**
 * Class Magestore_Storelocator_Block_Adminhtml_Storelocator_Import_Tab_Form
 */
class Magestore_Storelocator_Block_Adminhtml_Storelocator_Import_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * @return mixed
     */
    protected function _prepareForm()
  {
	
      $importFile = Mage::getBaseUrl('media').'storelocator/import/sample_import_file.csv';
      $form = new Varien_Data_Form();
	
      $this->setForm($form);
      $fieldset = $form->addFieldset('import_form', array('legend'=>Mage::helper('storelocator')->__('Import Settings')));
       $fieldset->addField('', 'select', array(
			'label'		=> Mage::helper('storelocator')->__('Overwrite existing store(s)'),
			'required'	=> false,
			'name'		=> 'overwrite_store',
                        'width'         => '50px',
                        'values'        => array(
                            array(
                                    'value'     => 1,
                                    'label'     => Mage::helper('storelocator')->__('Yes'),
                                  ),

                             array(
                                    'value'     => 0,
                                    'label'     => Mage::helper('storelocator')->__('No'),
                                ),
                        ),
                    
		));
      $fieldset->addField('csv_store', 'file', array(
          'label'     => Mage::helper('storelocator')->__('Select File to Import'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'csv_store',
          'note'      => '<a href="'.$importFile.'">Sample File</a>',
      ));
      
      return parent::_prepareForm();
  }
}