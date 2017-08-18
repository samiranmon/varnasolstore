<?php

$installer = $this;
$installer->startSetup();


$installer->addAttribute("customer", "paymentmethods", array(
    "type" => "varchar",
    "backend" => "",
    "label" => "Payment Methods",
    "input" => "multiselect",
    "source" => "customeractivation/resource_attribute_source_Customerpayment",
    "backend" => "",
    "user_defined" => "1",
    "visible" => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique" => false,
    "note" => ""
));

$attribute = Mage::getSingleton("eav/config")->getAttribute("customer", "paymentmethods");


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


$installer->addAttribute("customer", "logo_image", array(
    "type" => "varchar",
    "backend" => "",
    "label" => "Logo Image",
    "input" => "text",
    "source" => "",
    "visible" => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "user_defined" => "0",
    "unique" => false,
    "note" => "Logo Image"
));

$attribute = Mage::getSingleton("eav/config")->getAttribute("customer", "logo_image");


$used_in_forms = array();

$used_in_forms[] = "adminhtml_customer";
$attribute->setData("used_in_forms", $used_in_forms)
        ->setData("is_used_for_customer_segment", true)
        ->setData("is_system", 0)
        ->setData("is_user_defined", 0)
        ->setData("is_visible", 1)
        ->setData("sort_order", 100)
;
$attribute->save();
$installer->endSetup();
