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
 * Class Magestore_Storelocator_Block_Adminhtml_Grid_Renderer_Storeimage
 */
class Magestore_Storelocator_Block_Adminhtml_Grid_Renderer_Storeimage extends Mage_Adminhtml_Block_Widget implements Varien_Data_Form_Element_Renderer_Interface
{
    /**
     * @var
     */
    protected $_element;
	
	/**
	 * constructor
	*/
	public function __construct(){
       
		$this->setTemplate('storelocator/renderer/storeimage.phtml');
	}
	

    /**
     * @param Varien_Data_Form_Element_Abstract $element
     * @return mixed
     */
    public function render(Varien_Data_Form_Element_Abstract $element){
		$this->setElement($element);
		return $this->toHtml();
	}

    /**
     * @param Varien_Data_Form_Element_Abstract $element
     * @return $this
     */
	public function setElement(Varien_Data_Form_Element_Abstract $element){
		$this->_element = $element;
		return $this;
	}

    /**
     * @return mixed
     */
    public function getElement(){
		return $this->_element;
	}
	

    /**
     * get value of element
     * @param $id
     * @return mixed
     */
    public function getValues($id){
                return Mage::getModel('storelocator/image')->getCollection()->addFieldToFilter('storelocator_id', $id)->addFieldToFilter('image_delete', 2);		
	}
	

    /**
     * get button's html to show
     * @return mixed
     */
    public function getAddButtonHtml(){
		$button = $this->getLayout()->createBlock('adminhtml/widget_button')
			->setData(array(
				'label'	=> $this->__('Add Image'),
				'onclick'	=> 'return '.$this->getElement()->getName().'Control.addItem()',
				'class'	=> 'add'
			));
		$button->setName('add_'.$this->getElement()->getName().'_button');
		$this->setChild('add_button',$button);
		return $this->getChildHtml('add_button');
	}
	
	
}