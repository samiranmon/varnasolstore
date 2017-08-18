<?php

class Brainium_Banner_Model_Mysql4_Banner_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('banner/banner');
    }
    protected function _filterStoreCondition($collection, $column) {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }
        $this->getCollection()->addStoreFilter($value);
    }

}
