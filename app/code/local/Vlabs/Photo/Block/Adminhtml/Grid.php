<?php
class Vlabs_Photo_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
     //where is the controller
     $this->_controller = 'adminhtml_photo';
     $this->_blockGroup = 'photo';
     //text in the admin header
     $this->_headerText = 'Ingredient Management';
     //value of the add button
     $this->_addButtonLabel = 'Add a contact';
     parent::__construct();
     }
}