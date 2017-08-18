<?php
class Vlabs_Photo_Model_Mysql4_Photo extends Mage_Core_Model_Mysql4_Abstract
{
     public function _construct()
     {
         $this->_init('photo/photo','id');
     }
}