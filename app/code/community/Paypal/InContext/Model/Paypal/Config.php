<?php
class Paypal_InContext_Model_Paypal_Config extends Mage_Paypal_Model_Config
{

    /**
     * BN code getter
     *
     * @param string $countryCode ISO 3166-1
     */
    public function getBuildNotationCode($countryCode = null)
    {
        
        parent::getBuildNotationCode($countryCode);

        return 'IWD_SI_MagentoCE_WPS'; // community
        
    }
}