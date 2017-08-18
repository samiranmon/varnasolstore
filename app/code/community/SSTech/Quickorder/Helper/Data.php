<?php
class SSTech_Quickorder_Helper_Data extends Mage_Core_Helper_Abstract
{
	 public function getQuickorderUrl() {
     $var = Mage::getUrl('quickorder');
     return $var; 

	}
}
	 
