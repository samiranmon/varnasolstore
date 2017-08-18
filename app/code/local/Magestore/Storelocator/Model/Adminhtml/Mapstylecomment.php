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
 * Class Magestore_Storelocator_Model_Adminhtml_Mapstylecomment
 */
class Magestore_Storelocator_Model_Adminhtml_Mapstylecomment
{
    /**
     * @return mixed
     */
    public function getCommentText()
    {
        return Mage::helper('storelocator')->__('Go to <a href="http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html" target="_blank">gmaps-samples-v3.googlecode.com</a>  to customize your own map style');
    }
}
