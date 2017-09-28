// IIFE - Immediately Invoked Function Expression
(function($, window, document) {
  // The $ is now locally scoped
 // Listen for the jQuery ready event on the document
  $(function() {
    // The DOM is ready!
    $('.wpkhalti-payment-btn').on('click',function(e){
    	var btn = $(this);
	    var config = {
	      // replace the publicKey with yours
	      "publicKey": btn.data('publickey'),
	      "productIdentity": btn.data('productidentity'),
	      "productName": btn.data('productname'),
	      "productUrl": btn.data('producturl'),
	      "eventHandler": {
	          onSuccess (payload) {
	              // hit merchant api for initiating verfication
	              $.ajax({
	              	url:ajax_object.ajax_url,
	              	context:this,
	              	data:{
	              		action:'verifyPayment',
	              		amount:payload.amount,
	              		token:payload.token,
	              		success_url:this.data('successurl'),
	              		failed_url:this.data('failedurl'),
	              		custom:this.data('custom'),
	              	},
	              	method:'POST',
	              	success:function(res){
	              		try{
	              			var response = JSON.parse(res);
	              		}catch(e){
	              			console.log('Invalid JSON format');
	              		}
	              		if (response.code == 200){
		              		$(this).text('Success');
		              		console.log('Khalti Transaction Success');
		              	}else{
		              		$(this).text('Failed');
		              		console.log('Khalti Transaction Failed');
		              	}
		              	if (response.action == 'redirect')
		              		window.location.href = response.url;
	              	},
	              	error:function(err){
	              		console.log(err);
	              	}
	              })
	          },
	          onError (error) {
	              console.log(error);
	          }
	      }
	    };
	    
	    config.eventHandler.onSuccess = config.eventHandler.onSuccess.bind(btn);
	    try{
	    	var checkout = new KhaltiCheckout(config);
		    checkout.show({amount: btn.data('amount')});
	    }catch(e){
	    	console.log("Error: " + e.message);
	    }
    });

	        
  });
 // The rest of the code goes here!
}(window.jQuery, window, document));
// The global jQuery object is passed as a parameter