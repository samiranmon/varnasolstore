<?php

class Vlabs_Photo_Block_Adminhtml_Photo_Renderer_Image extends
Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $html = '<img id="' . $this->getColumn()->getId() . '"
        src="' . Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "slider/" . $row->getData($this->getColumn()->getIndex()) . '"';
        $html .= 'style=width:70px;height:50px;/>';
        return $html;
    }

}

?>