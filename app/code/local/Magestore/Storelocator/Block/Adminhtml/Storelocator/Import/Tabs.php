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
 * Class Magestore_Storelocator_Block_Adminhtml_Storelocator_Import_Tabs
 */
class Magestore_Storelocator_Block_Adminhtml_Storelocator_Import_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    /**
     * Magestore_Storelocator_Block_Adminhtml_Storelocator_Import_Tabs constructor.
     */
    public function __construct()
  {
      parent::__construct();
      $this->setId('importstore_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('storelocator')->__('Import Store'));
  }

    /**
     * @return mixed
     */
    protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('storelocator')->__('Import Store'),
          'title'     => Mage::helper('storelocator')->__('Import Store'),
          'content'   => $this->getLayout()->createBlock('storelocator/adminhtml_storelocator_import_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}