<?php

$this->startSetup();

$this->updateAttribute('customer', 'customer_activated', 'frontend_input', 'select');
$this->updateAttribute('customer', 'customer_activated', 'source_model', 'customeractivation/resource_attribute_source_customeractivation');

$this->endSetup();
