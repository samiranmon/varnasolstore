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
 * Class Magestore_Storelocator_Block_Adminhtml_System_Config_Implementcode
 */
class Magestore_Storelocator_Block_Adminhtml_System_Config_Implementcode extends Mage_Adminhtml_Block_System_Config_Form_Field {

    /**
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element) {
        $layout = Mage::helper('storelocator')->returnlayout();
        $block = Mage::helper('storelocator')->returnblock();
        $text = Mage::helper('storelocator')->returntext();
        $template = Mage::helper('storelocator')->returntemplate();
        return '
<!-- <div class="entry-edit-head collapseable"><a onclick="Fieldset.toggleCollapse(\'storelocator_template\'); return false;" href="#" id="storelocator_template-head" class="open">Implement Code</a></div> -->
<input id="storelocator_template-state" type="hidden" value="1" name="config_state[storelocator_template]">
<fieldset id="storelocator_template" class="config collapseable" style="">
    <div id="messages" class="div-mess-storelocator">
        <ul class="messages mess-megamennu">
            <li class="notice-msg notice-storelocator">
                <ul>
                    <li>
                    ' . $text . '
                    </li>				
                </ul>
            </li>
        </ul>
    </div>
    <br/>  
    <div id="messages" class="div-mess-storelocator">
        <ul class="messages mess-megamennu">
            <li class="notice-msg notice-storelocator">
                <ul>
                    <li>
                    ' . Mage::helper('storelocator')->__('Option 1: Add the code below to a CMS Page or a Static Block') . '
                    </li>
                </ul>
            </li>
        </ul>
    </div>
        <ul>
            <li>
                <code>
                ' . $block . '
                </code>	
            </li>
        </ul>     
    <br/>
    <div id="messages" class="div-mess-storelocator">
       <ul class="messages mess-megamennu">
            <li class="notice-msg notice-storelocator">
                <ul>
                    <li>
                    ' . Mage::helper('storelocator')->__('Option 2: Add the code below to a template file') . '
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <ul>
        <li>
            <code>
            &lt;?php echo' . $template . ' ?&gt;
            </code>	
        </li>
    </ul>
    <br/>
    <div id="messages" class="div-mess-storelocator">
        <ul class="messages mess-megamennu">
            <li class="notice-msg notice-storelocator">
                <ul>
                    <li>
                    ' . Mage::helper('storelocator')->__('Option 3: Add the code below to a layout file') . '
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <ul>
        <li>
            <code>
            ' . $layout . '
            </code>	
        </li>
    </ul>
</fieldset>';
    }

}
