<?php

class PI_Stores_Block_Searchstores extends Mage_Core_Block_Template
{
	public function _prepareLayout()
		{
			$msgs = $this->getLayout()->createBlock('core/messages', 'messages')
			->addMessages(Mage::getSingleton('core/session')->getMessages(true))	
			->addMessages(Mage::getSingleton('customer/session')->getMessages(true))
				->addMessages(Mage::getSingleton('checkout/session')->getMessages(true));
				//->getMessagesBlock();				
			$this->setMessagesBlock($msgs);			
			parent::_prepareLayout();
		}	
	
  public function getAllLocations()
	{
					$locations 		= 	Mage::registry('locations');	

						
					$categories			=		Mage::getSingleton('core/session')->getMapCategories();			
					$zipcode				=		Mage::getSingleton('core/session')->getMapZipcode();	
					$city						=		Mage::getSingleton('core/session')->getMapCity();
					$area						=		Mage::getSingleton('core/session')->getMapArea();	 	 
								
					if(empty($categories) && empty($zipcode) && empty($city) && empty($area))
					{	
									$collection = Mage::getModel('stores/stores')
																	->getCollection()
																	->addFieldToSelect('*');		
					}
					else
					{ 			$collection 	= 	Mage::getModel('stores/stores')
																	->getCollection();
													if(!empty($categories))
																foreach ($categories as $category){
																		$collection->addFieldToFilter('category',array('finset'=>$category));
																}
													if(!empty($zipcode)) 
																	$collection->addFieldToFilter('postcode',array('eq'=>$zipcode));
													if(!empty($city)) 
																	$collection	->addFieldToFilter('city',array('eq'=>$city));
													if(!empty($area))	
																$collection	->addFieldToFilter('area',array('finset'=>$area));
													$collection	->addFieldToSelect('*');																						
					}								
					return $collection->getData();
		
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
