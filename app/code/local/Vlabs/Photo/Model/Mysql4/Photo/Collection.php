<?php
class Vlabs_Photo_Model_Mysql4_Photo_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
 {
     public function _construct()
     {
         parent::_construct();
         $this->_init('photo/photo');
     }
}