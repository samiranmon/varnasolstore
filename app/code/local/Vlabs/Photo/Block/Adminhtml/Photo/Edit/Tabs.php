 <?php
  class Vlabs_Photo_Block_Adminhtml_Photo_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
  {
     public function __construct()
     {
          parent::__construct();
          $this->setId('photo_tabs');
          $this->setDestElementId('edit_form');
          $this->setTitle('Information Ingredient');
      }
      protected function _beforeToHtml()
      {
          $this->addTab('form_section', array(
                   'label' => 'Ingredient Information',
                   'title' => 'Ingredient Information',
                   'content' => $this->getLayout()
     ->createBlock('photo/adminhtml_photo_edit_tab_form')
     ->toHtml()
         ));
         return parent::_beforeToHtml();
    }
}
