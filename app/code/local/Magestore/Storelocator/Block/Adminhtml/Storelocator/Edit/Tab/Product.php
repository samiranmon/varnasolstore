<?php
/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_Storelocator
 * @module      Storelocator
 * @author      Magestore Developer
 *
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 *
 */

/**
 * Class Magestore_Storelocator_Block_Adminhtml_Storelocator_Edit_Tab_Product
 */
class Magestore_Storelocator_Block_Adminhtml_Storelocator_Edit_Tab_Product extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Magestore_Storelocator_Block_Adminhtml_Storelocator_Edit_Tab_Product constructor.
     */
    public function __construct(){
        parent::__construct();
        $this->setId('productsGrid');
        $this->setDefaultSort('entity_id');
        $this->setUseAjax(true);
        $this->setDefaultFilter(array('in_products'=>1));
    }

    /**
     * @return mixed
     */
    public function getCategory(){
        return Mage::getModel('catalog/category')->load(Mage::app()->getStore()->getRootCategoryId());
    }

    /**
     * @param $column
     * @return $this
     */
    protected function _addColumnFilterToCollection($column)
    {
        // Set custom filter for in category flag
        if ($column->getId() == 'in_products') {
            $productIds = $this->_getSelectedProducts();
            if (empty($productIds)) {
                $productIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('entity_id', array('in'=>$productIds));
            }
            elseif(!empty($productIds)) {
                $this->getCollection()->addFieldToFilter('entity_id', array('nin'=>$productIds));
            }
        }
        else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    protected function _prepareCollection()
    {
        if ($this->getCategory()->getId()) {
            $this->setDefaultFilter(array('in_products'=>1));
        }
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        $store = Mage::app()->getStore($storeId);
        $collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('sku')
            ->addAttributeToSelect('price')
            ->addStoreFilter($this->getRequest()->getParam('store'));
        $collection->joinAttribute(
                'status',
                'catalog_product/status',
                'entity_id',
                null,
                'inner',
                $store->getId()
            );
        $collection->joinAttribute(
            'visibility',
            'catalog_product/visibility',
            'entity_id',
            null,
            'inner',
            $store->getId()
        );
        $this->setCollection($collection);
        if ($this->getCategory()->getProductsReadonly()) {
            $productIds = $this->_getSelectedProducts();
            if (empty($productIds)) {
                $productIds = 0;
            }
            $this->getCollection()->addFieldToFilter('entity_id', array('in'=>$productIds));
        }
        return parent::_prepareCollection();
    }

    /**
     * @return mixed
     */
    protected function _prepareColumns(){
        if (!$this->getCategory()->getProductsReadonly()) {
            $this->addColumn('in_products', array(
                'header_css_class' => 'a-center',
                'type'      => 'checkbox',
                'name'      => 'in_products',
                'values'    => $this->_getSelectedProducts(),
                'field_name'=> 'products[]',
                'align'     => 'center',
                'index'     => 'entity_id'
            ));
        }
        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('catalog')->__('ID'),
            'sortable'  => true,
            'width'     => '60',
            'index'     => 'entity_id'
        ));
        $this->addColumn('name', array(
            'header' => Mage::helper('catalog')->__('Name'),
            'index' => 'name'
        ));

        $sets = Mage::getResourceModel('eav/entity_attribute_set_collection')
                ->setEntityTypeFilter(Mage::getModel('catalog/product')->getResource()->getTypeId())
                ->load()
                ->toOptionHash();

        $this->addColumn('set_name', array(
            'header' => Mage::helper('catalog')->__('Attrib. Set Name'),
            'width' => '130px',
            'index' => 'attribute_set_id',
            'type' => 'options',
            'options' => $sets,
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('catalog')->__('Status'),
            'width' => '90px',
            'index' => 'status',
            'type' => 'options',
            'options' => Mage::getSingleton('catalog/product_status')->getOptionArray(),
        ));

        $this->addColumn('visibility', array(
            'header' => Mage::helper('catalog')->__('Visibility'),
            'width' => '90px',
            'index' => 'visibility',
            'type' => 'options',
            'options' => Mage::getSingleton('catalog/product_visibility')->getOptionArray(),
        ));

        $this->addColumn('sku', array(
            'header' => Mage::helper('catalog')->__('SKU'),
            'width' => '80px',
            'index' => 'sku'
        ));
        $this->addColumn('price', array(
            'header' => Mage::helper('catalog')->__('Price'),
            'type' => 'currency',
            'currency_code' => (string) Mage::getStoreConfig(Mage_Directory_Model_Currency::XML_PATH_CURRENCY_BASE),
            'index' => 'price'
        ));
        $this->addColumn('position', array(
            'header'            => Mage::helper('catalog')->__('Sort Order'),
            'name'              => 'position',
            'index'             => 'status',
            'width'             => '10px',
            'editable'          => true,
            'filter'            => false,
       ));
        return parent::_prepareColumns();
    }

    /**
     * @return mixed
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/productgrid', array('_current'=>true));
    }

    /**
     * @return array
     */
    protected function _getSelectedProducts()
    {
        $products = $this->getRequest()->getPost('store_products');
        if (is_null($products)) {
            $store = Mage::getModel('storelocator/storelocator')->load($this->getRequest()->getParam('id'));
            return explode(',', $store->getProductIds());
        }
        return $products;
    }

    /**
     * @return array
     */
    public function getSelectedProducts(){
        $products = array();
        $store = Mage::getModel('storelocator/storelocator')->load($this->getRequest()->getParam('id'));
        $productIds = explode(',', $store->getProductIds());  
        foreach ($productIds as $productId){
            $products[$productId] = array('position'=> 0);
        }
        return $products;
    }
}
