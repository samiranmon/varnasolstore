<?php

class PI_Stores_Block_Adminhtml_Stores_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('storesGrid');
      $this->setDefaultSort('id');
  }

  protected function _prepareCollection()
  {

      $resource = Mage::getSingleton('core/resource');  
      $collection = Mage::getModel('stores/stores')->getCollection();      
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
    $hlp =  Mage::helper('stores'); 

    $this->addColumn('entity_id', array(
      'header'    => $hlp->__('Entity Id'),
      'align'     => 'right',     
      'index'     => 'entity_id',
    ));

    $this->addColumn('store_name', array(
      'header'    => $hlp->__('Store Name'),
      'align'     => 'right',     
      'index'     => 'store_name',
    ));	    

    $this->addColumn('address1', array(
      'header'    => $hlp->__('Address'),
      'align'     => 'right',     
      'index'     => 'address1',
    ));
    
    $this->addColumn('city', array(
      'header'    => $hlp->__('City'),
      'align'     => 'right',     
      'index'     => 'city',
    ));
    $this->addColumn('postcode', array(
      'header'    => $hlp->__('Postcode'),
      'align'     => 'right',     
      'index'     => 'postcode',
    ));
    return parent::_prepareColumns();
  }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }
  
  protected function _prepareMassaction()
  {
				$this->setMassactionIdField('entity_id');
				$this->getMassactionBlock()->setFormFieldName('stores');
				
				$this->getMassactionBlock()->addItem('delete', array(
				     'label'    => Mage::helper('stores')->__('Delete'),
				     'url'      => $this->getUrl('*/*/massDelete'),
				     'confirm'  => Mage::helper('stores')->__('Are you sure?')
				));
				
				return $this; 
  }

}
