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
 * Class Magestore_Storelocator_Model_System_Config_Defaultcountry
 */
class Magestore_Storelocator_Model_System_Config_Defaultcountry
{

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $optionCountry = array();
        $optionCountry[] = array('value' => '', 'label' => 'Please select country');
        $collection = Mage::getResourceModel('directory/country_collection')
            ->loadByStore();
        if (count($collection)) {
            foreach ($collection as $item) {
                $optionCountry[] = array('value' => $item->getId(), 'label' => $item->getName());
            }
        }

        return $optionCountry;
    }

}