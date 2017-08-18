<?php

require_once("Mage/Adminhtml/Block/Widget/Form/Renderer/Fieldset.php");
class Exinent_CustomerActivation_Block_Adminhtml_Rewrite_Fieldset extends Mage_Adminhtml_Block_Widget_Form_Renderer_Fieldset
{
	protected $_element;
 protected function _construct()
    {
        $this->setTemplate('customerActivation/fieldset.phtml');
    }
     
}  