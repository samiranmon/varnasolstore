<?php
class Vlabs_Photo_Block_Adminhtml_Photo_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
   protected function _prepareForm()
   {
       $form = new Varien_Data_Form();
       $this->setForm($form);
       $fieldset = $form->addFieldset('photo_form',
                                       array('legend'=>'information'));
        $fieldset->addField('title', 'text',
                       array(
                          'label' => 'Title',
                          'class' => 'required-entry',
                          'required' => true,
                           'name' => 'title',
                    ));
//        $fieldset->addField('image', 'text',
//                         array(
//                          'label' => 'Image',
//                          'class' => 'required-entry',
//                          'required' => true,
//                          'name' => 'image',
//                      ));
        
        $fieldset->addField('image', 'image', array(
          'label'     => Mage::helper('photo')->__('Image File'),
          'name'      => 'image',
	                 ));

         // $fieldset->addField('details', 'details',
         //               array(
         //                  'label' => 'Detail',
         //                  'class' => 'required-entry',
         //                  'required' => true,
         //                   'name' => 'details',
         //            ));
// Store selection 
        // if (!Mage::app()->isSingleStoreMode()) {
        $fieldset->addField('stores', 'multiselect', array(
                                'name'      => 'stores[]',
                                'label'     => Mage::helper('cms')->__('Store View'),
                                'title'     => Mage::helper('cms')->__('Store View'),
                                'required'  => true,
                                'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
                ));
      // }
      //       else {
      //   $fieldset->addField('stores', 'hidden', array(
      //                   'name'      => 'stores[]',
      //                   'value'     => Mage::app()->getStore(true)->getId()
      //   ));
      //   // $model->setStoreId(Mage::app()->getStore(true)->getId());
      //       }

          $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('photo')->__('Status'),
            'name' => 'status',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('photo')->__('Enabled'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('photo')->__('Disabled'),
                ),
            ),
        ));

           $fieldset->addField('category', 'select', array(
            'label' => Mage::helper('photo')->__('Category'),
            'name' => 'category',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('photo')->__('A-G'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('photo')->__('H-L'),
                ),
                array(
                    'value' => 3,
                    'label' => Mage::helper('photo')->__('M-S'),
                ),
                array(
                    'value' => 4,
                    'label' => Mage::helper('photo')->__('T-Z'),
                ),
            ),
        ));

         $fieldset->addField('details', 'textarea',
                   array(
                       'label' => 'Details',
                       'class' => 'required-entry',
                       'required' => true,
                       'name' => 'details',
                ));
 if ( Mage::registry('photo_data') )
 {
    $form->setValues(Mage::registry('photo_data')->getData());
  }
  return parent::_prepareForm();
 }
}