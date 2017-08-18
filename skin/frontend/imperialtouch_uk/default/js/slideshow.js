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
 * @package     rwd_default
 * @copyright   Copyright (c) 2006-2016 X.commerce, Inc. and affiliates (http://www.magento.com)
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

    
$j(document).ready(function () {

    // ==============================================
    // UI Pattern - Slideshow
    // ==============================================

    $j('.slideshow-container .slideshow')
        .cycle({
            slides: '> li',
            pager: '.slideshow-pager',
            pagerTemplate: '<span class="pager-box"></span>',
            speed: 600,
            pauseOnHover: true,
            swipe: true,
            prev: '.slideshow-prev',
            next: '.slideshow-next',
            fx: 'scrollHorz'
        });
        
        
//        setTimeout(function(){
//           $j('.slideshow-container .slideshow').cycle('pause'); 
//        }, 10000);
        //$j('.slideshow-container .slideshow').cycle({timeout:6000});
        
         //$j('.slideshow-container .slideshow').cycle('pause'); 
});


function footerMenu(){
        
    if(jQuery(window).width() < 770) {
        
        
        jQuery(".footerrTop .links").children("ul").hide();
        jQuery(".footerrTop .links .block-title").unbind();
        jQuery(".footerrTop .links .block-title").click(function(){
        
            if(jQuery(this).parents(".links").siblings(".footerrTop .links").children("ul").is(":visible")){
            jQuery(this).parents(".footerrTop .links").siblings(".footerrTop .links").children("ul").slideUp();
            
        }
            
            
        jQuery(this).next("ul").slideToggle();    
        });
    }
        
        else{
         jQuery(".footerrTop .links .block-title").unbind(); 
        jQuery(".footerrTop .links").children("ul").show();     
        }
        
    }
        
jQuery(window).resize(function()  {
    footerMenu();
}); 

jQuery(window).load(function(){
    footerMenu();
});

