<?php

$installer = $this;
$installer->startSetup();
$installer->addAttribute("customer", "store_type", array(
    "type" => "varchar",
    "backend" => "",
    "label" => "Store Type",
    "input" => "select",
    "source" => "customeractivation/resource_attribute_source_StoreType",
    "visible" => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "user_defined" => "1",
    "unique" => false,
    "note" => "Store Type"
));

$attribute = Mage::getSingleton("eav/config")->getAttribute("customer", "store_type");


$used_in_forms = array();

$used_in_forms[] = "adminhtml_customer";
$attribute->setData("used_in_forms", $used_in_forms)
        ->setData("is_used_for_customer_segment", true)
        ->setData("is_system", 0)
        ->setData("is_user_defined", 1)
        ->setData("is_visible", 1)
        ->setData("sort_order", 100)
;
$attribute->save();


$installer->addAttribute("customer", "iswebsite_live", array(
    "type" => "varchar",
    "backend" => "",
    "label" => "Iswebsite Live",
    "input" => "select",
    "source" => "customeractivation/resource_attribute_source_Iswebsitelive",
    "visible" => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "user_defined" => "1",
    "unique" => false,
    "note" => "Iswebsite Live"
));

$attribute = Mage::getSingleton("eav/config")->getAttribute("customer", "iswebsite_live");


$used_in_forms = array();

$used_in_forms[] = "adminhtml_customer";
$attribute->setData("used_in_forms", $used_in_forms)
        ->setData("is_used_for_customer_segment", true)
        ->setData("is_system", 0)
        ->setData("is_user_defined", 1)
        ->setData("is_visible", 1)
        ->setData("sort_order", 100)
;
$attribute->save();

$installer->addAttribute("customer", "date_founded", array(
    "type" => "varchar",
    "backend" => "",
    "label" => "Date Founded",
    "input" => "text",
    "source" => "",
    "visible" => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "user_defined" => "1",
    "unique" => false,
    "note" => "Date Founded"
));

$attribute = Mage::getSingleton("eav/config")->getAttribute("customer", "date_founded");


$used_in_forms = array();

$used_in_forms[] = "adminhtml_customer";
$attribute->setData("used_in_forms", $used_in_forms)
        ->setData("is_used_for_customer_segment", true)
        ->setData("is_system", 0)
        ->setData("is_user_defined", 1)
        ->setData("is_visible", 1)
        ->setData("sort_order", 100)
;
$attribute->save();


$installer->addAttribute("customer", "accountspayable_email", array(
    "type" => "varchar",
    "backend" => "",
    "label" => "Accounts Payable Email Address",
    "input" => "text",
    "source" => "",
    "visible" => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "user_defined" => "1",
    "unique" => false,
    "note" => "Accounts Payable Email Address"
));

$attribute = Mage::getSingleton("eav/config")->getAttribute("customer", "accountspayable_email");


$used_in_forms = array();

$used_in_forms[] = "adminhtml_customer";
$attribute->setData("used_in_forms", $used_in_forms)
        ->setData("is_used_for_customer_segment", true)
        ->setData("is_system", 0)
        ->setData("is_user_defined", 1)
        ->setData("is_visible", 1)
        ->setData("sort_order", 100)
;
$attribute->save();

$installer->addAttribute("customer", "website_url", array(
    "type" => "varchar",
    "backend" => "",
    "label" => "Website URL",
    "input" => "text",
    "source" => "",
    "visible" => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "user_defined" => "1",
    "unique" => false,
    "note" => "Website URL"
));

$attribute = Mage::getSingleton("eav/config")->getAttribute("customer", "website_url");


$used_in_forms = array();

$used_in_forms[] = "adminhtml_customer";
$attribute->setData("used_in_forms", $used_in_forms)
        ->setData("is_used_for_customer_segment", true)
        ->setData("is_system", 0)
        ->setData("is_user_defined", 1)
        ->setData("is_visible", 1)
        ->setData("sort_order", 100)
;
$attribute->save();
?>