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
 * Class Magestore_Storelocator_Model_Adminhtml_Facebookcomment
 */
class Magestore_Storelocator_Model_Adminhtml_Facebookcomment
{
    /**
     * @return string
     */
    public function getCommentText()
    {
        $comment = 'To register a Facebook API key, please follow the guide <a href="' . Mage::getBlockSingleton('adminhtml/widget')->getUrl('*/storelocator_guide/index/') . '">here</a>';
        return $comment;
    }
}
