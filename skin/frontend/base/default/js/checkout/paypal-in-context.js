var IWD = IWD||{};
var $ji = $ji||$j;
IWD.InContext = {
	//method after save start In-Context Checkout Experience	
	reinitDefaultMethods: function(){
		//rewrite on save method in Payment class.
		if (typeof(Payment)=="undefined"){
			return;
		}
		Payment.prototype.save = Payment.prototype.save.wrap(function(save) {
			
            var validator = new Validation(this.form);
            if (this.validate() && validator.validate()) {
                
            	if (payment.currentMethod=='paypal_express' || payment.currentMethod=='paypaluk_express'){
            		 var request = new Ajax.Request(
        		             this.saveUrl,
        		             {
        		                 method:'post',
        		                 onComplete: function(){},//remove default method like placeholder
        		                 onSuccess: function(){},//remove default method like placeholder
        		                 onFailure: checkout.ajaxFailure.bind(checkout),
        		                 parameters: Form.serialize(this.form)
        		             }
        		         );
            	}else{
            		save(); //return default method
            	}            	
            }
            
		});
		
		
		
	}
};

if (typeof(window.paypalCheckoutReady)=="undefined"){
	

window.paypalCheckoutReady = function() {
	
	if (typeof(IWD.OPC)!="undefined" || typeof(IWD.ES)!="undefined"  || typeof(IWD.LIPP) !="undefined"){
		return ;
	}
	
	if (typeof(PayPalLightboxConfig)=="undefined"){
		return;
	}
	if(typeof(PayPalLightboxConfig) != "object"){
		PayPalLightboxConfig = JSON.parse(PayPalLightboxConfig);
	}
	if (PayPalLightboxConfig.isActive==0){
		return;
	}
	
	if (typeof(IDS)=="undefined"){
		IDS = new Array();
		if ($('paypal-save-button')!=undefined){
			IDS.push('paypal-save-button');
		}
	}else{
		if ($('paypal-save-button')!=undefined){
			IDS.push('paypal-save-button');
		}
	}


	paypal.checkout.setup(PayPalLightboxConfig.merchantid, {
		environment: PayPalLightboxConfig.environment,
		button: IDS,
		click: function (e) { 
			e.preventDefault();
			if ($('paypal-save-button')!=undefined){
				if (payment.currentMethod!='paypal_express' && payment.currentMethod!='paypaluk_express'){
					return;
				}
			}
			//return if click by button in add to cart form
			if ($ji(e.target).closest('.add-to-cart').length>0){			
				return;
			}
			
			
			var link = $ji(e.target).parent().attr('href');
			//click by a tag with link to express start
			if (typeof(link)!="undefined"){
				//check type of paypal express
				if (link.indexOf('paypaluk')>=0 //old magento
                    ||
                    link.indexOf('payflow')>=0 //new magento
                ){
					var urlConnect = PayPalLightboxConfig.setExpressCheckoutUk;
				}else if (link.indexOf('paypal')>=0){
					var urlConnect = PayPalLightboxConfig.setExpressCheckout
				}
			}else{
				if (payment.currentMethod=='paypal_express'){
					var urlConnect = PayPalLightboxConfig.setExpressCheckout
				}
				
				if (payment.currentMethod=='paypaluk_express'){
					var urlConnect = PayPalLightboxConfig.setExpressCheckoutUk;
				}
			}

			paypal.checkout.initXO();
			$ji.support.cors = true;				    					    	
	    	$ji.ajax({
                url: urlConnect,
                type: "GET",		                     
                async: true,
                crossDomain: false,
               
                success: function (token) {
                	
                	if (token.indexOf('cart') != -1  || token.indexOf('login')!= -1){
                		paypal.checkout.closeFlow();
                		setLocation(token);
                		
                	}else{
                		var url = paypal.checkout.urlPrefix + token;               
                        paypal.checkout.startFlow(url);
                	}
                    
                },
                error: function (responseData, textStatus, errorThrown) {
                    alert("Error in ajax post"+responseData.statusText);
                    //Gracefully Close the minibrowser in case of AJAX errors
                    paypal.checkout.closeFlow();
                }
            });
		}
	}); 
	
	
};
};

document.observe("dom:loaded", function() {
	if (typeof(IWD.OPC)!="undefined" || typeof(IWD.ES)!="undefined" || typeof(IWD.LIPP) !="undefined"){
		return ;
	}
	if (typeof(PayPalLightboxConfig)!="undefined"){
		if(typeof(PayPalLightboxConfig) != "object"){
			PayPalLightboxConfig = JSON.parse(PayPalLightboxConfig);
		}
		if (PayPalLightboxConfig.isActive==0){
			return;
		}
		IWD.InContext.reinitDefaultMethods();
		
	}	
});