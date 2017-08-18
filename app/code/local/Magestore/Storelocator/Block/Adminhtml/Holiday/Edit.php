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
 * Class Magestore_Storelocator_Block_Adminhtml_Holiday_Edit
 */
class Magestore_Storelocator_Block_Adminhtml_Holiday_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    /**
     * Magestore_Storelocator_Block_Adminhtml_Holiday_Edit constructor.
     */
    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'storelocator';
        $this->_controller = 'adminhtml_holiday';

        $this->_updateButton('save', 'label', Mage::helper('storelocator')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('storelocator')->__('Delete Item'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
                ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }	
            
            Event.observe('holiday_date_to','change',function(){
                            if(!$('date').value){
                                    alert('" . $this->__('You need to insert data into From Date') . "');
                                    $('holiday_date_to').value='';
                                }
                            if($('date').value && ($('date').value>$('holiday_date_to').value)){
                                alert('" . $this->__('Invalid Date') . "');
                                    $('holiday_date_to').value='';
                            }
                            });
        ";
    }

    /**
     * @return mixed
     */
    public function getHeaderText() {
        if (Mage::registry('holiday_data') && Mage::registry('holiday_data')->getId()) {
            return Mage::helper('storelocator')->__("Edit Holiday '%s'", $this->htmlEscape(Mage::registry('holiday_data')->getData('date')));
        } elseif ($this->getRequest()->getParam('id')) {
            return Mage::helper('storelocator')->__("Edit Holiday '%s'", Mage::getModel('storelocator/holiday')->load($this->getRequest()->getParam('id'))->getDate());
        } else {
            return Mage::helper('storelocator')->__('Add Holiday');
        }
    }

}
