<?php

class Exinent_CustomerActivation_Block_Page_Html_Topmenu extends Mage_Page_Block_Html_Topmenu {

    protected $additionalLinks = array();

    public function addLink($label, $type, $value) {
        $ModuleStatus = Mage::getStoreConfig('customer/customeractivation/disable_ext', Mage::app()->getStore());

        if ('path' == $type && $ModuleStatus == 1) {
            $_coreUrlHelper = $this->helper('core/url');
            $currentPath = str_replace(Mage::getBaseUrl(), '', $_coreUrlHelper->getCurrentUrl());
            $url = Mage::getUrl($value);
            $data = array(
                'label' => $label,
                'url' => $url,
                'is_active' => (int) ($value == $currentPath),
            );
            $this->additionalLinks[$url] = $data;
        }
    }

    public function getAdditionalLinks() {
        return $this->additionalLinks;
    }

}

?>