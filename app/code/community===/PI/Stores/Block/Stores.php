<?php

class PI_Stores_Block_Stores extends Mage_Core_Block_Template
{
		public function _prepareLayout()
		{			
		
		}	
		public function getPagerHtml()
		{
		return $this->getChildHtml('pager');
		} 
	
  public function getAllLocations()
	{
		$locations = Mage::registry('locations');

		if(isset($locations))
		{
			return $locations;
		}
		else
		{	
						$Collection = Mage::getModel('stores/stores')
													->getCollection()
													->addFieldToSelect('*');													
					return $Collection->getData();
		}
	}

	
	public function getLocationDetails($entity_id)
	{
						$Collection = Mage::getModel('stores/stores')
													->getCollection()
													->addFieldToFilter('entity_id',$entity_id)
													->addFieldToSelect('*');
					return $Collection->getData();
		
	}

}

?>
