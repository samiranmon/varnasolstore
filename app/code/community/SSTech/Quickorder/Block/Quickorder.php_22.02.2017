<?php   
class SSTech_Quickorder_Block_Quickorder extends Mage_Core_Block_Template{
	
	public function getQuickattriute()
	{
		$quickorder = Mage::getStoreConfig('quickorder/quickorder/quickorder'); 
		$product = Mage::getModel('catalog/product');
		$_productCollection = $product->getCollection()->addAttributeToFilter('type_id', array('eq' => 'simple'))->addAttributeToSelect('*');
		return $_productCollection;
		
    }

}
