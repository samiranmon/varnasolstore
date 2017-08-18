<?php
class Vlabs_Photo_Block_Adminhtml_Photo_Edit extends
                    Mage_Adminhtml_Block_Widget_Form_Container{
   public function __construct()
   {
        parent::__construct();
        $this->_objectId = 'id';
        //vwe assign the same blockGroup as the Grid Container
        $this->_blockGroup = 'photo';
        //and the same controller
        $this->_controller = 'adminhtml_photo';
        //define the label for the save and delete button
        $this->_updateButton('save', 'label','save');
        $this->_updateButton('delete', 'label', 'delete');
    }
       /* Here, we're looking if we have transmitted a form object,
          to update the good text in the header of the page (edit or add) */
    public function getHeaderText()
    {
        if( Mage::registry('photo_data')&&Mage::registry('photo_data')->getId())
         {
              return 'Editer '.$this->htmlEscape(
              Mage::registry('photo_data')->getTitle()).'<br />';
         }
         else
         {
             return 'Add a contact';
         }
    }
}