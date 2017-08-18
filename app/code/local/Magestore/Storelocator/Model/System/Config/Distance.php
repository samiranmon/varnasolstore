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
 * Class Magestore_Storelocator_Model_System_Config_Distance
 */
class Magestore_Storelocator_Model_System_Config_Distance
{

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = array(
            array('value' => 'km', 'label' => Mage::helper('storelocator')->__('Kilometers')),
            array('value' => 'mi', 'label' => Mage::helper('storelocator')->__('Miles')),
        );
        return $options;
    }

}