<?php
class Paypal_InContext_ExpressukController extends Paypal_InContext_Controller_Express_Abstract
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
    protected $_configMethod = Mage_Paypal_Model_Config::METHOD_WPP_PE_EXPRESS;

    /**
     * Checkout mode type
     *
     * @var string
     */
    protected $_checkoutType = 'paypaluk/express_checkout';
}
