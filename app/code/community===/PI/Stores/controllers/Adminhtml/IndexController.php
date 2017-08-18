<?php
class PI_Stores_Adminhtml_IndexController extends Mage_Adminhtml_Controller_action
{
	/**
			Action For the Grid Of the stores
	**/
	public function indexAction() 
	{   	
		$this->loadLayout(); 
		$this->_setActiveMenu('stores/stores');
		$this->_addBreadcrumb($this->__('Manage Stores Locations'), $this->__('Stores')); 
		$this->_addContent($this->getLayout()->createBlock('stores/adminhtml_stores'));
		$this->renderLayout(); 
  }
  /**
		Edit Aciton 
  **/
  public function editAction() 
  {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('stores/stores')->load($id);

		if ($model->getId() || $id == 0) 
		{
					$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
					if (!empty($data)) {
						$model->setData($data);
					}
					Mage::register('stores_data', $model);
					$this->loadLayout();
					$this->_setActiveMenu('stores/stores');

					$this->_addContent($this->getLayout()->createBlock('stores/adminhtml_stores_edit'))->_addLeft($this->getLayout()->createBlock('stores/adminhtml_stores_edit_tabs'));	
							  
					$this->renderLayout();
		} 
		else 
		{
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('teachers')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}
 /**
	new Action
 **/
	public function newAction() 
	{
		$this->editAction();
	}
	/**
		Multiple delete from grid
	**/
	public function massDeleteAction() 
	{	
		$webIds = $this->getRequest()->getParam('stores');

		if(!is_array($webIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
		} else {
			try {
				foreach ($webIds as $webId) {                 
	
							$web = Mage::getModel('stores/stores')->load($webId);
					$web->delete();		 	
				} 
				Mage::getSingleton('adminhtml/session')->addSuccess(
					Mage::helper('adminhtml')->__(
						'Total of %d record(s) were successfully deleted', count($webIds)
					)
				);
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
		}
		$this->_redirect('*/*/index');
    }
    public function saveAction() 
		{
			$id = $this->getRequest()->getParam('id');
			if ($data = $this->getRequest()->getPost()) 
			{
					
						/* # Set Latitude & Longitude */
						$_GeoOptions = Mage::getModel('stores/location')->getLatLongArray($data['country'], $data['postcode'], $data['city'],$data['address1']);
						$data['latitude']	= $_GeoOptions['latitude'];
						$data['longitude']	= $_GeoOptions['longitude'];

						if($_GeoOptions['latitude'])
						{
							try{

								//save the data in stores model
								$model = Mage::getModel('stores/stores');
								$model->setData($data)->setId($id);
								$model->save();	

								Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('stores')->__('Stores Location has been successfully saved'));

								Mage::getSingleton('adminhtml/session')->setFormData(false);

								$this->_redirect('*/*/');
								return;

							} 
							catch (Exception $e) 
							{
								Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
								Mage::getSingleton('adminhtml/session')->setFormData($data);
								$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
								return;
							}
						}
						else
						{
								Mage::getSingleton('adminhtml/session')->addError(Mage::helper('stores')->__('The current store location not exist'));

								Mage::getSingleton('adminhtml/session')->setFormData(false);

								$this->_redirect('*/*/');
								return;
						}
			}
	 	
		}
		/**
			Delete the stores location
		**/
		public function deleteAction() 
		{
				$id = $this->getRequest()->getParam('id');
				if($id)
				{
							Mage::getModel('stores/stores')->load($id)->delete();				
				}
				$this->_redirect('*/*/');
				return;

		}
		//Find the state from a country
		public function regionAction()
    {
				$params = $this->getRequest()->getParams();
				$currentId = $params['currentId'];
				$ModelData = array();
				$ModelData['country']='';
				$ModelData['area']='';
				$Modelarea = array();
				$Modelarea[1]='';
				if($currentId){
					$ModelData = Mage::getModel('stores/stores')->load($currentId)->getData();
					$Modelarea = explode(',',$ModelData['area']);
				}
				$regionCollection = Mage::getResourceModel('directory/region_collection')->addCountryFilter($params['id'])->load();
					if(count($regionCollection)):
						echo "<select name='area' id='region1' class='required-entry validate-select' ><option value=''>".$this->__('Please select region,state or province')."</option>";
									foreach($regionCollection as $region) {
											$regioncollect = Mage::getModel('directory/region')->load($region['region_id']);
				
									echo "<option value='".$regioncollect->getDefaultName().",".$regioncollect->getRegionId()."'"; 
									if($Modelarea[1]==$regioncollect->getRegionId()):echo "selected='selected'";endif;echo ">";
										echo $regioncollect->getDefaultName();
									echo "</option>";
									
							}
								
						echo "</select>";
				else:
					echo "<input type='text' name='area' id='region2' value'' title='".$this->__('address')."' class='input-text required-entry'/>";
				endif;
    }

}

?>
