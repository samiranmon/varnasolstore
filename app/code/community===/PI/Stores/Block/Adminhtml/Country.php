<?php
class PI_Stores_Block_Adminhtml_Country extends Mage_Adminhtml_Block_Widget_Form_Renderer_Fieldset_Element 
{
		//create country collection
 		 public function countryCollection()
		{
				$countryCollection = Mage::getResourceModel('directory/country_collection')
		            ->loadData()
		            ->toOptionArray(false);
				return $countryCollection;
		}
		
		//create state collection
		public function stateCollection($country_id)
		{
				$regionCollection = Mage::getModel('directory/region_api')->items($country_id);
				return $regionCollection;
		}
}
