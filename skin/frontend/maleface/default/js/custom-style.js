//owl-carousel-2
jQuery(document).ready(function(){
 
jQuery('#owl-demo-1').owlCarousel({
    loop:true,
    navigation : false,  
    //margin:15,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:4,
            nav:false,
            loop:false
        }
    }
})

});

jQuery(document).click(function(e) {
    if (!jQuery(e.target).is('body')) {
        jQuery('.collapse').collapse('hide');        
    }
});