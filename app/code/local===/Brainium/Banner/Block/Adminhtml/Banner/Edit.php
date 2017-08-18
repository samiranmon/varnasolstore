<?php

class Brainium_Banner_Block_Adminhtml_Banner_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    protected function _prepareLayout() {
        // Load Wysiwyg on demand and Prepare layout
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled() && ($block = $this->getLayout()->getBlock('head'))) {
            $block->setCanLoadTinyMce(true);
        }
        parent::_prepareLayout();
    }

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'banner';
        $this->_controller = 'adminhtml_banner';

        $this->_updateButton('save', 'label', Mage::helper('banner')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('banner')->__('Delete Item'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
                ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('banner_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'banner_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'banner_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText() {
        if (Mage::registry('banner_data') && Mage::registry('banner_data')->getId()) {
            return Mage::helper('banner')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('banner_data')->getTitle()));
        } else {
            return Mage::helper('banner')->__('Add Item');
        }
    }

}
