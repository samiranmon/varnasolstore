<?php

class PI_Stores_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {   	
    	$storeEnable = 1;
		if($storeEnable==1)
		{
				$this->loadLayout();   
				$this->getLayout()->getBlock('head')->setTitle($this->__('Storess'));  
				$this->renderLayout();
				Mage::getSingleton('core/session')->unsMapCategories();	
    		Mage::getSingleton('core/session')->unsMapZipcode();	
    		Mage::getSingleton('core/session')->unsMapCity();
				Mage::getSingleton('core/session')->unsMapArea();	
		}
		else
		{
			$this->_forward('noRoute');
		}
    }

		/*Clear filters*/
		public function clearFilterAction()
    {
				Mage::getSingleton('core/session')->unsMapCategories();	
    		Mage::getSingleton('core/session')->unsMapZipcode();	
    		Mage::getSingleton('core/session')->unsMapCity();
				Mage::getSingleton('core/session')->unsMapArea();	
				$this->_redirect('*/*');
        return;
		}
		
    public function searchresultAction()
    {
		$storeEnable = Mage::getStoreConfig('piextensionsstore/stores_group/stores_enabled');
		if($storeEnable==1)
		{
	    	//Mage::getSingleton('customer/session')->addSuccess("the heloo");	
				$data					=		$this->getRequest()->getPost();
    		$categories 	= 	$this->getRequest()->getPost('categories');	
				$zipcode 			= 	$this->getRequest()->getPost('zipcode');
				$city 				= 	$this->getRequest()->getPost('city');
				$area 				= 	$this->getRequest()->getPost('area');
				

				if(!empty($data))
				{	
					Mage::getSingleton('core/session')->setMapCategories($categories);				
					Mage::getSingleton('core/session')->setMapZipcode($zipcode);				
					Mage::getSingleton('core/session')->setMapCity($city);
					Mage::getSingleton('core/session')->setMapArea($area);
					
				}					

				if(empty($categories) && empty($zipcode) && empty($city) && empty($area))
				{	
										$collection = Mage::getModel('stores/stores')
																->getCollection()
																->addFieldToSelect('*');
				}
				else
				{
		
							$collection 	= 	Mage::getModel('stores/stores')
																->getCollection();
												if($categories){
																foreach ($categories as $category){
																		$collection->addFieldToFilter('category',array('finset'=>$category));
																}
												}
												if($zipcode)
																$collection->addFieldToFilter('postcode',array('eq'=>$zipcode));
												if($city)
																$collection	->addFieldToFilter('city',array('eq'=>$city));
												if($area)	
																$collection	->addFieldToFilter('area',array('finset'=>$area));
												$collection	->addFieldToSelect('*');																					
				}
				
				$collection_withdata = $collection->getData();
				//echo "<pre>";print_r($collection_withdata); exit;
				
				if(!empty($collection_withdata)){
					 
					 Mage::getSingleton('core/session')->addSuccess('Stores locations are listed below');
				}else{
		
					Mage::getSingleton('core/session')->addError('No Stores for current selection');
					//$this->_forward('index');
					$this->_redirect('*/*');
					return;	
				}
				$this->loadLayout();
				$this->getLayout()->getBlock('head')->setTitle($this->__('Stores'));       
				$this->renderLayout();
			}
			else
			{
				$this->_forward('noRoute');
			}
				
    }	

		
}
?>