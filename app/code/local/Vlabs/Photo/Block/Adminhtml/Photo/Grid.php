<?php

class Vlabs_Photo_Block_Adminhtml_Photo_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('contactGrid');
        $this->setDefaultSort('id');
        //$this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('photo/photo')->getCollection();
         foreach ($collection as $view) {
            if ($view->getStores() && $view->getStores() != 0) {
                $view->setStores(explode(',', $view->getStores()));
            } else {
                $view->setStores(array('0'));
            }
        }

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('id', array(
            'header' => 'ID',
            'align' => 'right',
            'width' => '50px',
            'index' => 'id',
        ));
        $this->addColumn('title', array(
            'header' => 'Title',
            'align' => 'left',
            'index' => 'title',
        ));
//        $this->addColumn('image', array(
//            'header' => 'Image',
//            'align' => 'left',
//            'index' => 'image',
//        ));
        
        $this->addColumn('image', //the name of the column in your database
                array(
            'header' => Mage::helper('photo')->__('Image'),
                 
            'type' => 'image',
            'index' => 'image',
            'renderer' => 'photo/adminhtml_photo_renderer_image', //get the image HTML code
            
        ));

         $this->addColumn('details', array(
            'header' => 'Details',
            'align' => 'left',
            'index' => 'details',
        ));

         if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('stores', array(
                'header' => Mage::helper('photo')->__('Store View'),
                'index' => 'stores',
                'type' => 'store',
                'store_all' => true,
                'store_view' => true,
                'sortable' => true,
                // 'filter_condition_callback' => array($this, '_filterStoreCondition'),
            ));
        }


          $this->addColumn('category', array(
            'header' => Mage::helper('photo')->__('Category'),
            'index' => 'category',
            'type' => 'options',
            'options' => array(
                1 => 'A-G',
                2 => 'H-L',
                3 => 'M-S',
                4 => 'T-Z',
            ),
        ));

          $this->addColumn('status', array(
            'header' => Mage::helper('photo')->__('Status'),
            'index' => 'status',
            'type' => 'options',
            'options' => array(
                1 => 'Enabled',
                2 => 'Disabled',
            ),
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
