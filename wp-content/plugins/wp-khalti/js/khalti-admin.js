// IIFE - Immediately Invoked Function Expression
(function($, window, document) {
  // The $ is now locally scoped
 // Listen for the jQuery ready event on the document
  $(function() {
    // The DOM is ready!
    $('#env-checkbox').on('change',function(){
    	var test = $('#test-keys');
    	var live = $('#live-keys');
    	if (this.checked){
    		test.show();
    		live.hide();
    	}else{
    		test.hide();
    		live.show();
    	}
    });
	        
  });
 // The rest of the code goes here!
}(window.jQuery, window, document));
// The global jQuery object is passed as a parameter