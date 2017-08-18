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
 * Class Magestore_Storelocator_Adminhtml_storelocator_SimiController
 */
class Magestore_Storelocator_Adminhtml_storelocator_SimiController extends Mage_Adminhtml_Controller_Action
{
    /**
     *
     */
    public function indexAction()
    {
        $url = "https://www.simicart.com/features/store-locator.html/?utm_source=Magestore&utm_medium=related&utm_campaign=SLpage";
        Mage::app()->getResponse()->setRedirect($url)->sendResponse();
    }

    /**
     * @return mixed
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('storelocator');
    }
}