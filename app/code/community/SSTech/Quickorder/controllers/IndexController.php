<?php
class SSTech_Quickorder_IndexController extends Mage_Core_Controller_Front_Action{

    protected function _getSession()
	{
		return Mage::getSingleton('customer/session');
	}
    public function indexAction() {
      
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Quickorder"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("quickorder", array(
                "label" => $this->__("Quickorder"),
                "title" => $this->__("Quickorder")
		   ));

      $this->renderLayout();
      if (!$this->_getSession()->isLoggedIn()) {
           
        }
		$params = $this->getRequest()->getParams();
		$collection = $params['all'];
		if(count($params)){
			$add1 = true;
			foreach($collection as $products)
			{
				if(array_key_exists('checkbox',$products))
				{
					$add = true;
					if($products['qty']>0)
						break;
					else {
						$add = false;
						$add1 = false;
					}
				}
				else
					$add = false;
			}
			if($add && $add1)
			{
				$cart = Mage::getModel('checkout/cart');
				$cart->init();
				foreach ($collection as $products) {
					if($products['checkbox']==1 && $products['qty']>0) {
						$pModel = Mage::getModel('catalog/product');
						$pModel->load($products['product_id']);
						if ($pModel->getTypeId() == Mage_Catalog_Model_Product_Type::TYPE_SIMPLE) {
							try	{
								$cart->addProduct($pModel, array('qty' => $products['qty']));
							} catch (Exception $e) {
								continue;
							}
						}
					}
				}
				$cart->save();
				if ($this->getRequest()->isXmlHttpRequest()) {
					exit('1');
				}
				$message = $this->__('Products were added to your shopping cart.');
				Mage::getSingleton('checkout/session')->addSuccess($message);
				$this->_redirect('checkout/cart');
			}
			else
			{
				if(!$add1){
					Mage::getSingleton('core/session')->addError('Quantity should be greater than Zero!');
				} else{
					Mage::getSingleton('core/session')->addError('Please select products');
				}
				
				$this->_redirect('quickorder');
			}
		
		}
	  
    }
   
}
