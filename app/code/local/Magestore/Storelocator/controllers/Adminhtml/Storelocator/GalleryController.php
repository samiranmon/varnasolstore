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
 * Class Magestore_Storelocator_Adminhtml_storelocator_GalleryController
 */
class Magestore_Storelocator_Adminhtml_storelocator_GalleryController extends Mage_Adminhtml_Controller_Action
{
    /**
     *
     */
    public function uploadAction()
    {
        try {
            $uploader = new Mage_Core_Model_File_Uploader('image');
            $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
            // $uploader->addValidateCallback('catalog_product_image',
            //  Mage::helper('catalog/image'), 'validateUploadFile');
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(true);
            $result = $uploader->save(
                Mage::getSingleton('storelocator/system_config_upload')->getBaseTmpMediaPath()
            );

            $result['tmp_name'] = str_replace(DS, "/", $result['tmp_name']);
            $result['path'] = str_replace(DS, "/", $result['path']);

            $result['url'] = Mage::getSingleton('storelocator/system_config_upload')->getTmpMediaUrl($result['file']);
            $file = $result['path'] . $result['file'];
            $fileStrLng = strlen($file);
            $strLength = strlen($result['file']);
            chmod(substr($file, 0, $fileStrLng - $strLength + 4), 0777);
            chmod(substr($file, 0, $fileStrLng - $strLength + 2), 0777);
            chmod($file, 0777);
            $result['file'] = $result['file'] . '.tmp';
            $result['cookie'] = array(
                'name' => session_name(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain()
            );

        } catch (Exception $e) {
            $result = array(
                'error' => $e->getMessage(),
                'errorcode' => $e->getCode());
        }

        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }

    /**
     * @return mixed
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('storelocator');
    }

} 
