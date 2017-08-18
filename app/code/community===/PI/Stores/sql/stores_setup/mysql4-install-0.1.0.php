<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('stores')};
CREATE TABLE {$this->getTable('stores')}(
	`entity_id` int(11) unsigned NOT NULL auto_increment,
	`store_name`varchar(255) , 	
	`address1`varchar(800) ,
	`address2`varchar(800) ,
	`area`varchar(800) ,
	`city`varchar(255) ,
	`postcode`varchar(255) ,
	`country`varchar(255) ,	
	`mobile`varchar(255) ,	
	`category`varchar(255) ,
	`phonenumber`varchar(255) ,
	`email`varchar(255) ,
	`web`varchar(255) ,	
	`latitude` varchar(255) DEFAULT NULL,
	`longitude` varchar(255) DEFAULT NULL,  
 	PRIMARY KEY (`entity_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

$installer->endSetup(); 

?>
