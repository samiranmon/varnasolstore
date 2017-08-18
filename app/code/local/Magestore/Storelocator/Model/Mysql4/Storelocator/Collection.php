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
 * Class Magestore_Storelocator_Model_Mysql4_Storelocator_Collection
 */
class Magestore_Storelocator_Model_Mysql4_Storelocator_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

    /**
     * @var null
     */
    protected $_store_id = null;
    /**
     * @var array
     */
    protected $_addedTable = array();
    /**
     * @var array
     */
    protected $_storeField = array('name', 'status', 'description', 'address', 'city', 'sort');

    /**
     *
     */
    public function _construct()
    {
        parent::_construct();

        $this->_init('storelocator/storelocator');
    }

    /**
     *  use for multi store
     * @param $field
     * @param null $condition
     * @return $this|Magestore_Storelocator_Model_Mysql4_Storelocator_Collection
     */
    public function addFieldToFilter($field, $condition = null)
    {
        $attributes = array(
            'name',
            'status',
            'description',
            'address',
            'city',
            'sort',
        );
        $storeId = $this->getStoreId();
        if (in_array($field, $attributes) && $storeId) {
            if (!in_array($field, $this->_addedTable)) {
                $this->getSelect()
                    ->joinLeft(array($field => $this->getTable('storelocator/storevalue')), "main_table.storelocator_id = $field.storelocator_id" .
                        " AND $field.store_id = $storeId" .
                        " AND $field.attribute_code = '$field'", array()
                    );
                $this->_addedTable[] = $field;
            }
            return $this->addNonReturnedFilter($field, $condition);
//            $this->getSelect()->where("IF($field.value IS NULL, main_table.$field, $field.value) = $condition");
//            return $this;
        }
        if ($field == 'store_id') {
            $field = 'main_table.storelocator_id';
        }
        return parent::addFieldToFilter($field, $condition);
    }

    /**
     * @param $storeId
     * @param null $array
     * @return $this
     */
    public function setStoreId($storeId, $array = null)
    {
        $this->_store_id = $storeId;
        if ($this->_store_id) {
            $storeField = (isset($array) && count($array)) ? $array : $this->_storeField;
            foreach ($storeField as $value) {
                $storeValue = Mage::getModel('storelocator/storevalue')->getCollection()
                    ->addFieldToFilter('store_id', $storeId)
                    ->addFieldToFilter('attribute_code', $value)
                    ->getSelect()
                    ->assemble();
                $this->getSelect()
                    ->joinLeft(
                        array(
                            'storelocator_value_' . $value => new Zend_Db_Expr("($storeValue)")), 'main_table.storelocator_id = storelocator_value_' . $value . '.storelocator_id', array(
                        $value => 'IF(storelocator_value_' . $value . '.value IS NULL,main_table.' . $value . ',storelocator_value_' . $value . '.value)'));
            }
        }
        return $this;
    }

    /**
     * @return null
     */
    public function getStoreId()
    {
        return $this->_store_id;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getAllField($name)
    {
        $idsSelect = clone $this->getSelect();
        $idsSelect->reset(Zend_Db_Select::ORDER);
        $idsSelect->reset(Zend_Db_Select::LIMIT_COUNT);
        $idsSelect->reset(Zend_Db_Select::LIMIT_OFFSET);
        $idsSelect->reset(Zend_Db_Select::COLUMNS);
        $idsSelect->columns('main_table.' . $name);
        $idsSelect->resetJoinLeft();
        return $this->getConnection()->fetchCol($idsSelect);
    }

    /**
     * @param $field
     * @param $condition
     * @return $this
     */
    public function addNonReturnedFilter($field, $condition)
    {
        /** @var Namespace_Module_Model_Resource_Model_Collection $this */
        $expression = 'IF(' . $field . '.value IS NULL, main_table.' . $field . ', ' . $field . '.value)';
        $condition = $this->_getConditionSql($expression, $condition);
        $this->_select->where($condition);

        return $this;
    }
}
