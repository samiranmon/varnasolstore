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
/** @var $previewModel Mage_XmlConnect_Model_Preview_Ipad */
$previewModel = Mage::helper('xmlconnect')->getPreviewModel();

$title1color = $previewModel->getConfigFontInfo('Title1/color');
$title2color = $previewModel->getConfigFontInfo('Title2/color');
$title5color = $previewModel->getConfigFontInfo('Title5/color');

$primaryColor = $previewModel->getData('conf/body/primaryColor');
$secondaryColor = $previewModel->getData('conf/body/secondaryColor');

$productImage = $previewModel->getPreviewImagesUrl('ipad/bg_product_image.png');
$backgroundIpadLandscapeImage = $previewModel->setOrientation(Mage_XmlConnect_Model_Device_Ipad::ORIENTATION_LANDSCAPE)->getBackgroundImage();
?>
<div class="ipad-catalog ipad-catalog-landscape" style="background: <?php echo $previewModel->getData('conf/body/backgroundColor'); ?>;">
    <div class="status-bar"></div>
    <div class="header-wrap" style="background-color:<?php echo $previewModel->getData('conf/navigationBar/tintColor'); ?>;">
        <div class="app-header">
            <?php echo $this->getChildHtml('tab_items'); ?>
        </div>
    </div>
    <div class="bg" style="background-image:url(<?php echo $backgroundIpadLandscapeImage; ?>)">
        <ul class="sections">
            <li class="arrow"><a href="#">Shirts</a></li>
            <li class="arrow"><a href="#">Sweatshirts</a></li>
            <li class="arrow"><a href="#">Jackets</a></li>
            <li><a href="#">Knits</a></li>
            <li class="active"><a href="#">Shorts</a></li>
            <li><a href="#">Pants</a></li>
            <li><a href="#">Swimsuits</a></li>
        </ul>
        <div class="filters-wrap" style="background-color:<?php echo $primaryColor; ?>;">
            <div class="filters">
                <span class="filter-button" style="background-color:<?php echo $secondaryColor; ?>;">Filter</span>
                <h3>Sort By:</h3>
                <ul>
                    <li class="position" style="background-color:<?php echo $secondaryColor; ?>;">Position</li>
                    <li class="home" style="background-color:<?php echo $primaryColor; ?>;">Home</li>
                    <li class="price" style="background-color:<?php echo $primaryColor; ?>;">Price</li>
                </ul>
            </div>
            <div class="filters-popup">
                <a href="#" class="apply-button">Apply</a>
                <h3>Edit Filter</h3>
                <ol>
                    <li><span class="delete-button">Delete</span> Price: $10-$20</li>
                    <li><span class="delete-button">Delete</span> Size: Small</li>
                </ol>
                <ul>
                    <li><a href="#">Price</a></li>
                    <li><a href="#">Brand</a></li>
                    <li><a href="#">Size</a></li>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="producst-list-wrap">
                <ol class="products-list">
                    <li>
                        <div class="product-image"><img src="<?php echo $productImage ?>" alt="Product Title" height="101" width="101" /></div>
                        <h4 style="color:<?php echo $title2color; ?>;">Product Title</h4>
                        <div class="price-box">
                            <span class="regular-price" style="color:<?php echo $title2color; ?>;">Regular $x.xx</span>
                            <span class="special-price" style="color:<?php echo $title5color; ?>;">Special $x.xx</span>
                        </div>
                        <div class="rating">
                            <span class="stars" style="color:<?php echo $secondaryColor; ?>;">
                                <span class="star">f</span><span class="star">f</span><span class="star">f</span><span class="star">f</span><span class="star">c</span>
                            </span>
                            <span  style="color:<?php echo $title2color; ?>;">(1)</span>
                        </div>
                        <div class="availability" style="color:<?php echo $title2color; ?>;">In Stock</div>
                    </li>
                    <li>
                        <div class="product-image"><img src="<?php echo $productImage ?>" alt="Product Title" height="101" width="101" /></div>
                        <h4 style="color:<?php echo $title2color; ?>;">Product Title</h4>
                        <div class="price-box">
                            <span class="regular-price" style="color:<?php echo $title2color; ?>;">Regular $x.xx</span>
                            <span class="special-price" style="color:<?php echo $title5color; ?>;">Special $x.xx</span>
                        </div>
                        <div class="rating">
                            <span class="stars" style="color:<?php echo $secondaryColor; ?>;">
                                <span class="star">f</span><span class="star">f</span><span class="star">f</span><span class="star">f</span><span class="star">c</span>
                            </span>
                            <span  style="color:<?php echo $title2color; ?>;">(1)</span>
                        </div>
                        <div class="availability" style="color:<?php echo $title2color; ?>;">In Stock</div>
                    </li>
                    <li>
                        <div class="product-image"><img src="<?php echo $productImage ?>" alt="Product Title" height="101" width="101" /></div>
                        <h4 style="color:<?php echo $title2color; ?>;">Product Title</h4>
                        <div class="price-box">
                            <span class="regular-price" style="color:<?php echo $title2color; ?>;">Regular $x.xx</span>
                            <span class="special-price" style="color:<?php echo $title5color; ?>;">Special $x.xx</span>
                        </div>
                        <div class="rating">
                            <span class="stars" style="color:<?php echo $secondaryColor; ?>;">
                                <span class="star">f</span><span class="star">f</span><span class="star">f</span><span class="star">f</span><span class="star">c</span>
                            </span>
                            <span  style="color:<?php echo $title2color; ?>;">(1)</span>
                        </div>
                        <div class="availability" style="color:<?php echo $title2color; ?>;">In Stock</div>
                    </li>
                    <li>
                        <div class="product-image"><img src="<?php echo $productImage ?>" alt="Product Title" height="101" width="101" /></div>
                        <h4 style="color:<?php echo $title2color; ?>;">Product Title</h4>
                        <div class="price-box">
                            <span class="regular-price" style="color:<?php echo $title2color; ?>;">Regular $x.xx</span>
                            <span class="special-price" style="color:<?php echo $title5color; ?>;">Special $x.xx</span>
                        </div>
                        <div class="rating">
                            <span class="stars" style="color:<?php echo $secondaryColor; ?>;">
                                <span class="star">f</span><span class="star">f</span><span class="star">f</span><span class="star">f</span><span class="star">c</span>
                            </span>
                            <span  style="color:<?php echo $title2color; ?>;">(1)</span>
                        </div>
                        <div class="availability" style="color:<?php echo $title2color; ?>;">In Stock</div>
                    </li>
                    <li>
                        <div class="product-image"><img src="<?php echo $productImage ?>" alt="Product Title" height="101" width="101" /></div>
                        <h4 style="color:<?php echo $title2color; ?>;">Product Title</h4>
                        <div class="price-box">
                            <span class="regular-price" style="color:<?php echo $title2color; ?>;">Regular $x.xx</span>
                            <span class="special-price" style="color:<?php echo $title5color; ?>;">Special $x.xx</span>
                        </div>
                        <div class="rating">
                            <span class="stars" style="color:<?php echo $secondaryColor; ?>;">
                                <span class="star">f</span><span class="star">f</span><span class="star">f</span><span class="star">f</span><span class="star">c</span>
                            </span>
                            <span  style="color:<?php echo $title2color; ?>;">(1)</span>
                        </div>
                        <div class="availability" style="color:<?php echo $title2color; ?>;">In Stock</div>
                    </li>
                    <li>
                        <div class="product-image"><img src="<?php echo $productImage ?>" alt="Product Title" height="101" width="101" /></div>
                        <h4 style="color:<?php echo $title2color; ?>;">Product Title</h4>
                        <div class="price-box">
                            <span class="regular-price" style="color:<?php echo $title2color; ?>;">Regular $x.xx</span>
                            <span class="special-price" style="color:<?php echo $title5color; ?>;">Special $x.xx</span>
                        </div>
                        <div class="rating">
                            <span class="stars" style="color:<?php echo $secondaryColor; ?>;">
                                <span class="star">f</span><span class="star">f</span><span class="star">f</span><span class="star">f</span><span class="star">c</span>
                            </span>
                            <span  style="color:<?php echo $title2color; ?>;">(1)</span>
                        </div>
                        <div class="availability" style="color:<?php echo $title2color; ?>;">In Stock</div>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php if ($this->getJsErrorMessage()) : ?>
<script type="text/javascript">
    alert('<?php echo $this->getJsErrorMessage(); ?>');
</script>
<?php endif; ?>
