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
 * Class Magestore_Storelocator_Block_Adminhtml_Storelocator
 */
class Magestore_Storelocator_Block_Adminhtml_Storelocator extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Magestore_Storelocator_Block_Adminhtml_Storelocator constructor.
     */
    public function __construct()
    {
        $this->_controller = 'adminhtml_storelocator';
        $this->_blockGroup = 'storelocator';
        $this->_headerText = Mage::helper('storelocator')->__('Store Management');
        $this->_addButton('import_store', array(
            'label' => Mage::helper('storelocator')->__('Import Store'),
            'onclick' => 'location.href=\'' . $this->getUrl('*/storelocator_import/importstore', array()) . '\'',
            'class' => 'add',
        ));
        $this->_addButtonLabel = Mage::helper('storelocator')->__('Add Store');
        parent::__construct();
    }
}