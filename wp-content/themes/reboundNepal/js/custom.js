// IIFE - Immediately Invoked Function Expression
(function($, window, document) {
  // The $ is now locally scoped
 // Listen for the jQuery ready event on the document
  $(function() {
    // The DOM is ready!
    // Show dropdown on search
		$('#sys_txt_keyword').focusin(function(event) {
			$('.dropdown-search-result').show();
		});
		$('.iBigX').click(function() {
			$('.dropdown-search-result').hide();
		});

		//Handle ajax form submit
		$('.ajax-form').on('submit',function(e){
			e.preventDefault();
			var ajaxurl = $(this).attr('action');
			var form = $(this);
			form.find('button[type=submit]').prop('disabled',true);
			$.ajax({
				url: ajaxurl,
				type: 'POST',
				context:this,
				data: $(this).serialize(),
			})
			.done(function(response) {
				response = $.parseJSON(response);
				if (response.type == 'login-success'){
					window.location.href = response.url;
				}else{
					$(this).find('.alert-msg').addClass(response.type).text(response.text).show();
					$(this).find('button[type=submit]').prop('disabled',false);
					if (response.type == 'alert-success') $(this).reset();
				}
			})
			.fail(function() {
				console.log("error");
			});
		});

		$('input[type=text],input[type=email],input[type=password]').keyup(function(){
      $('.alert-msg').hide();
    });
  });
 // The rest of the code goes here!
}(window.jQuery, window, document));
// The global jQuery object is passed as a parameter