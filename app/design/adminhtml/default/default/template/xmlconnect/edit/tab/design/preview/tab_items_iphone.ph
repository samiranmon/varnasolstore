<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE_AFL.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    design
 * @package     default_default
 * @copyright   Copyright (c) 2006-2016 X.commerce, Inc. and affiliates (http://www.magento.com)
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
?>
<?php
    /** @var $previewModel Mage_XmlConnect_Model_Preview_Iphone */
    $previewModel = Mage::helper('xmlconnect')->getPreviewModel();
?>
<?php if (($buttons = $previewModel->getTabItems()) && is_array($buttons) && ($buttonsCount = count($buttons))) :?>

<div class="bottom-buttons">
    <div class="gradient">
    <table width="100%">
        <tbody>
            <tr>
            <?php foreach ($buttons as $button) : ?>
                <td class="bottom-button<?php echo $button['active'] ? ' active' : ''; ?>" style="width:<?php echo (100/$buttonsCount) ?>%;background:url('<?php echo isset($button['image']) ? $button['image'] : ''; ?>') center 3px no-repeat;">
                    <div class="background"></div>
                    <p><?php echo isset($button['label']) ? $button['label'] : '&nbsp;'; ?></p>
                </td>
            <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
    </div>
</div>
<?php endif; ?>
