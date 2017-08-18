<?php
class Vlabs_Photo_Block_Monblock extends  Mage_Core_Block_Template
{
    public function methodblock()
     {
        
     $collection = Mage::getModel('photo/photo')->getCollection();
        foreach($collection as $data)
         {
             $retour .= $data->getData('title')
                     .' '.$data->getData('image').'<br />';
         }
        
         return $retour;
      }
}   