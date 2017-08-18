<?php
$installer = $this;

$installer->startSetup();

$this->_conn->addColumn($this->getTable('manufacturer'), 'legend', 'text');

$installer->endSetup(); 