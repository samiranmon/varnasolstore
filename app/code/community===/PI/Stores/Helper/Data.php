<?php

class PI_Stores_Helper_Data extends Mage_Core_Helper_Abstract
{
		function  getAllCategories($categories, $selCats) 
		{
				$selectedCats=$selCats;
				$array= '<ul>';
    		foreach($categories as $category) 
    		{
						  $cat = Mage::getModel('catalog/category')->load($category->getId());
						  $sel='';
						  if(in_array($category->getId(),$selectedCats))
						  	$sel='checked';			  
						  $array .= '<li class="map-lis">'.'<input type="checkbox" '.$sel.' name="categories[]" value="'.$category->getId().'" />&nbsp;'.$category->getName()."\n";

						  						 
						   $array .= '</li>';
    		}
		return  $array . '</ul>';
		}
			
		function getStoresUrl()
		{
			return Mage::getUrl('stores');
		}
}

?>
