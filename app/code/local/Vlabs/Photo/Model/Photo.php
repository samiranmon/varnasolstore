<?php
class Vlabs_Photo_Model_Photo extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
         parent::_construct();
         $this->_init('photo/photo');
    }
}