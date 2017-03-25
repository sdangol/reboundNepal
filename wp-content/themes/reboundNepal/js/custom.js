// IIFE - Immediately Invoked Function Expression
(function($, window, document) {
  // The $ is now locally scoped
 // Listen for the jQuery ready event on the document
  $(function() {
    // The DOM is ready!
		$('#sys_txt_keyword').focusin(function(event) {
			$('.dropdown-search-result').show();
		});
		$('.iBigX').click(function() {
			$('.dropdown-search-result').hide();
		});
  });
 // The rest of the code goes here!
}(window.jQuery, window, document));
// The global jQuery object is passed as a parameter