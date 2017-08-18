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

$installer = $this;
$installer->startSetup();

$installer->run("
   
    
     ALTER TABLE {$this->getTable('storelocator')}
		ADD COLUMN `monday_open_break` varchar(5) NOT NULL
			AFTER `monday_open`,
		ADD COLUMN `monday_close_break` varchar(5) NOT NULL
			AFTER `monday_close`,
		ADD COLUMN `tuesday_open_break` varchar(5) NOT NULL
			AFTER `tuesday_open`,
		ADD COLUMN `tuesday_close_break` varchar(5) NOT NULL
			AFTER `tuesday_close`,
		ADD COLUMN `wednesday_open_break` varchar(5) NOT NULL
			AFTER `wednesday_open`,
		ADD COLUMN `wednesday_close_break` varchar(5) NOT NULL
			AFTER `wednesday_close`,
		ADD COLUMN `thursday_open_break` varchar(5) NOT NULL
			AFTER `thursday_open`,
		ADD COLUMN `thursday_close_break` varchar(5) NOT NULL
			AFTER `thursday_close`,
		ADD COLUMN `friday_open_break` varchar(5) NOT NULL
			AFTER `friday_open`,
		ADD COLUMN `friday_close_break` varchar(5) NOT NULL
			AFTER `friday_close`,
		ADD COLUMN `saturday_open_break` varchar(5) NOT NULL
			AFTER `saturday_open`,
		ADD COLUMN `saturday_close_break` varchar(5) NOT NULL
			AFTER `saturday_close`,
		ADD COLUMN `sunday_open_break` varchar(5) NOT NULL
			AFTER `sunday_open`,
		ADD COLUMN `sunday_close_break` varchar(5) NOT NULL
			AFTER `sunday_close`;

    ");

$installer->endSetup();
