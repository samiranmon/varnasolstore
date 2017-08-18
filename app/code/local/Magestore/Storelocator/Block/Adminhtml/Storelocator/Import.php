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
 * Class Magestore_Storelocator_Block_Adminhtml_Storelocator_Import
 */
class Magestore_Storelocator_Block_Adminhtml_Storelocator_Import extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Magestore_Storelocator_Block_Adminhtml_Storelocator_Import constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'storelocator';
        $this->_controller = 'adminhtml_storelocator';
        $this->_mode = 'import';
        $this->_updateButton('save', 'label', Mage::helper('storelocator')->__('Import'));
//                $this->_removeButton('delete');
//                $this->_removeButton('saveandcontinue');
//                $this->_removeButton('reset');
        //$editBlock->_updateButton('back', 'onclick', 'backEdit()');

    }

    /**
     * get text to show in header when edit an item
     *
     * @return string
     */
    public function getHeaderText() {
        return Mage::helper('storelocator')->__('Import Store');
    }
}
