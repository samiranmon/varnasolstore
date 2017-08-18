<?php
class Paypal_InContext_ExpressController extends Paypal_InContext_Controller_Express_Abstract
{
    /**
     * Config mode type
     *
     * @var string
     */
    protected $_configType = 'paypal/config';

    /**
     * Config method type
     *
     * @var string
     */
    protected $_configMethod = Mage_Paypal_Model_Config::METHOD_WPP_EXPRESS;

    /**
     * Checkout mode type
     *
     * @var string
     */
    protected $_checkoutType = 'paypal/express_checkout';

    /**
     * Redirect to login page
     *
     */
    public function redirectLogin()
    {
        $this->setFlag('', 'no-dispatch', true);
        Mage::getSingleton('customer/session')->setBeforeAuthUrl($this->_getRefererUrl());
        $this->getResponse()->setRedirect(
            Mage::helper('core/url')->addRequestParam(
                Mage::helper('customer')->getLoginUrl(),
                array('context' => 'checkout')
            )
        );
    }
}
