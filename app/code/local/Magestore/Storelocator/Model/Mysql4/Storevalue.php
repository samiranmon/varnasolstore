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
 * Class Magestore_Storelocator_Model_Mysql4_Storevalue
 */
class Magestore_Storelocator_Model_Mysql4_Storevalue extends Mage_Core_Model_Mysql4_Abstract
{
    /**
     *
     */
    public function _construct()
    {
        $this->_init('storelocator/storevalue', 'value_id');
    }

    /**
     * @param $storeLocatorId
     * @param $storeId
     * @param $attribute
     */
    public function loadAttribute($storeLocatorId, $storeId, $attribute)
    {
        //get Attribute of stores with parameter $storeLocatorId, $storeId, $attribute
    }
}