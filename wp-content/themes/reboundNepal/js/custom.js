// IIFE - Immediately Invoked Function Expression
//Flag to denote searching action
var isSearching = false;
(function($, window, document) {
  // The $ is now locally scoped
 // Listen for the jQuery ready event on the document
  $(function() {
    // The DOM is ready!
    
    // Get posts while writing up search keywork
		$('#sys_txt_keyword').keyup(function(event) {
			$('#search').show();
			//Search only when current search timeout has passed
			if (!window.isSearching){
				window.isSearching = true;
				$('.list-project-result .result-container').hide();
				$('.list-project-result .loader').show();
				var input = $(this);
				setTimeout(function(){
					$.ajax({
						url: admin_ajax_url,
						type: 'GET',
						data: {
							key:input.val(),
							action:'searchProjects'
						},
					}).done(function(res) {
						var output = $.parseHTML(res);
						$('.list-project-result .loader').hide();
						$('.list-project-result .result-container').html(output).show();
						window.isSearching = false;
					}).fail(function() {
						console.log("error");
					});
				},2000);
			}
		});

		//Hide search box on cross
		$('.iBigX').click(function() {
			$(this).closest('.dropdown-search-result').hide();
		});

		//Show dropdown on discover
		$('#discover-projects').on('click',function(){
			$('#discover').show();
		});

		$('.view-all').on('click',function(e){
			e.preventDefault();
			$('#rebound-search-form').submit();
		});

		//Handle ajax form submit
		$('.ajax-form').on('submit',function(e){
			e.preventDefault();
			//Get action attribute of form
			var ajaxurl = $(this).attr('action');
			var form = $(this);
			var formData = new FormData(form[0]);
			$.ajax({
				url: ajaxurl,
				type: 'POST',
				context:this,
				data: formData,
				contentType: false, 
    		processData: false,
			})
			.done(function(res) {
					response = $.parseJSON(res);
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

    $('#forgot-password-toggle').on('click',function(){
    	$('#login-form').hide();
    	$('#forgot-password').show();
    });
    $('.login-form-toggle').on('click',function(){
    	$('#forgot-password').hide();
    	$('#login-form').show();
    });

    $('.donation-amount-field').on('change',function(){
    	var input = $(this);
    	var parent = input.closest('.donate-options');
    	//For paypal
    	parent.find('.donation-amount-value').val(input.val());
    	//For khalti
    	parent.find('.wpkhalti-payment-btn').data('amount',input.val()*100);
    });

  });
 // The rest of the code goes here!
}(window.jQuery, window, document));
// The global jQuery object is passed as a parameter