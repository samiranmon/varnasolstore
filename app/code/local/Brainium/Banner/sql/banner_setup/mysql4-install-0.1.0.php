<?php
$installer = $this;
$installer->startSetup();
$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('banner')};
CREATE TABLE {$this->getTable('banner')} (
  `banner_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Banner Id',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Banner Title',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT 'Banner Url',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT 'Banner File Name',
  `description` text NOT NULL COMMENT 'Banner Content',
  `status` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Banner Status',
  `created_time` datetime DEFAULT NULL COMMENT 'Banner Created Time',
  `update_time` datetime DEFAULT NULL COMMENT 'Banner Update Time',
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB CHARSET=utf8 COMMENT='Banner Image Table';
");
$installer->endSetup(); 