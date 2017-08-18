<?php   
class SSTech_Quickorder_Block_Quickorder extends Mage_Core_Block_Template{
	
	public function getQuickattriute()
	{
                
		$quickorder = Mage::getStoreConfig('quickorder/quickorder/quickorder'); 
                $storeId = Mage::app()->getStore()->getStoreId();
		$product = Mage::getModel('catalog/product')->setStoreId(3)->getCollection();
                // $_productCollection = $product->getCollection()->addAttributeToFilter('type_id', array('eq' => 'simple'))->addAttributeToSelect('*');
		$_productCollection = $product->addAttributeToSelect('*');
		return $_productCollection;
		
    }

}
