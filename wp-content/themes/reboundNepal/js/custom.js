// IIFE - Immediately Invoked Function Expression
(function($, window, document) {
  // The $ is now locally scoped
 // Listen for the jQuery ready event on the document
  $(function() {
    // The DOM is ready!
    // Show dropdown on search
		$('#sys_txt_keyword').focusin(function(event) {
			$('#search').show();
		});
		$('.iBigX').click(function() {
			$(this).closest('.dropdown-search-result').hide();
		});

		//Show dropdown on discover
		$('#discover-projects').on('click',function(){
			$('#discover').show();
		});

		//Handle ajax form submit
		$('.ajax-form').on('submit',function(e){
			e.preventDefault();
			//Get action attribute of form
			var ajaxurl = $(this).attr('action');
			var form = $(this);
			$.ajax({
				url: ajaxurl,
				type: 'POST',
				context:this,
				data: $(this).serialize(),
			})
			.done(function(response) {
				response = $.parseJSON(response);
				if (response.type == 'success-redirect'){
					//Reload the page if success
					window.location.href = response.url;
				}else{
					//Show error 
					$(this).find('.alert-msg').addClass(response.type).text(response.text).show();
				}
			})
			.fail(function() {
				console.log("error");
			});
		});

		//Reset error message on re writing form
		$('input[type=text],input[type=email],input[type=password]').keyup(function(){
      $('.alert-msg').hide();
    });

    //View payment options on pledging a project
    $('.btn-back-project').on('click',function(e){
    	e.preventDefault();
    	var form = $(this).closest('.form');
 			//Update amount respectively
    	form.fadeOut('fast',function(){
	    	form.siblings('.donate-options').fadeIn('fast');
    	});
    });

    //Show login popup if not logged in
    if ($get_vars.auth == 'required'){
    	$('#sys_popup_common').fadeIn();
    }
  });
 // The rest of the code goes here!
}(window.jQuery, window, document));
// The global jQuery object is passed as a parameter