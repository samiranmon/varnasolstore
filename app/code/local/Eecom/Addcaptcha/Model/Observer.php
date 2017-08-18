<?php
/**
 * Easy Contacts Form Captcha Extension
 *
 * @category     Extension
 * @copyright    Copyright © 2015 Envision Ecommerce (http://www.envisionecommerce.com/store/)
 * @author       Envision Ecommerce
 * @terms of use http://www.envisionecommerce.com/store/terms-of-use
 * @version      Release: 1.0.0
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Eecom_Addcaptcha_Model_Observer
{
    public function checkContacts($observer){
        $formId = 'contacts';
        $captchaModel = Mage::helper('captcha')->getCaptcha($formId);
        if ($captchaModel->isRequired()) {
            $controller = $observer->getControllerAction();
            $word = $this->_getCaptchaString($controller->getRequest(), $formId);
            if (!$captchaModel->isCorrect($word)) {
                Mage::getSingleton('customer/session')->addError(Mage::helper('captcha')->__('Incorrect CAPTCHA.'));
                $controller->setFlag('', Mage_Core_Controller_Varien_Action::FLAG_NO_DISPATCH, true);
                $url =  Mage::getUrl('contacts');
                $controller->getResponse()->setRedirect($url);
            }
        }
        return $this;
    }
    /**
     * Get Captcha String
     *
     * @param Varien_Object $request
     * @param string $formId
     * @return string
     */
    protected function _getCaptchaString($request, $formId)
    {
        $captchaParams = $request->getPost(Mage_Captcha_Helper_Data::INPUT_NAME_FIELD_VALUE);
        return $captchaParams[$formId];
    }
}