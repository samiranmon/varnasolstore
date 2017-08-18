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
 * Class Magestore_Storelocator_Model_Select_Search
 */
class Magestore_Storelocator_Model_Select_Search
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value'=>5, 'label'=>Mage::helper('storelocator')->__('None')),
            array('value'=>0, 'label'=>Mage::helper('storelocator')->__('Store Name')),
            array('value'=>1, 'label'=>Mage::helper('storelocator')->__('Country')),
            array('value'=>2, 'label'=>Mage::helper('storelocator')->__('State/ Province')),
            array('value'=>3, 'label'=>Mage::helper('storelocator')->__('City')),
            array('value'=>4, 'label'=>Mage::helper('storelocator')->__('Zip Code')),
           
        );
    }
}