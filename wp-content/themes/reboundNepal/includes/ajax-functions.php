<?php
/**
 * Contains all ajax functions
 */


/**
 * Handle user registration
 * @return error or success message
 */
function register_user(){
	$error = new WP_Error();
	if (empty($_POST['full_name']) || empty($_POST['email']) || empty($_POST['email_confirm']) || empty($_POST['password']) || empty($_POST['password_confirm']) ){
		$error->add('empty_fields','All fields are required');
	}
	if ($_POST['email'] !== $_POST['email_confirm']){
		$error->add('email_mismatch','Emails donot match');
	}
	if ($_POST['password'] !== $_POST['password_confirm']){
		$error->add('password_mismatch','Passwords donot match');
	}
	//Show warning message if error
	$errmsg = $error->get_error_message();
	if (!empty($errmsg)){
		echo json_encode(['type' => 'alert-warning','text' => $error->get_error_message()]);
		die;
	}
	//Sanitize data
	$full_name = sanitize_text_field($_POST['full_name']);
	$email = sanitize_email($_POST['email']);
	//Break full name to first and last name
	$name = explode(' ',$full_name);
	$fname = $name[0];
	$lname = isset($name[1])?$name[1]:'';
	//Insert user into the database
	if ($id = wp_insert_user(['user_login' => $email,
									'user_pass' => $_POST['password'],
									'user_nicename' => $full_name,
									'user_email' => $email,
									'display_name' => $full_name,
									'first_name' => $fname,
									'last_name' => $lname,
									'rich_editing' => true,
									'role' => 'author'])){
		if (is_wp_error($id)){
			echo json_encode(['type' => 'alert-warning','text' => $id->get_error_message()]);
			die;
		}
		//Set the approval status to 0
		add_user_meta($id,'approval_status',0);
		//Email message
		$token = md5(uniqid($email, true));
		//add token in user meta
		add_user_meta($id,'user_activation_token',$token);
		$message .= "Thank you for joining Rebound Nepal.<br>Please verify your account using the following link.<br><a href='".site_url("/verify-account?token={$token}")."'>".site_url("/verify-account?token={$token}")."</a>";
		// $headers[] = 'From: Rebound Nepal <admin@reboundnepal.com>';
		$headers[] = 'Content-Type: text/html; charset=UTF-8';
		if (wp_mail($email,'Rebound Nepal Registration',$message,$headers)){
			echo json_encode(['type' => 'alert-success','text' => 'Please check email to verify your registration.']);
		}else{
			echo json_encode(['type' => 'alert-error','text' => 'Email not sent.']);
		}
		die;
	}
}
add_action('wp_ajax_nopriv_register_user','register_user');


/**
 * Handle user login
 * @return error or success message
 */
function login_user(){
	$error = new WP_Error();
	if (empty($_POST['email']) || empty($_POST['password'])){
		$error->add('empty_fields','All fields are required');
	}
	//Show warning message if error
	if (!empty($error->get_error_message())){
		echo json_encode(['type' => 'alert-warning','text' => $error->get_error_message()]);
		die;
	}
	$remember = (isset($_POST['remember']))?1:0;
	//Sanitize data
	if ($login = wp_signon(['user_login' => $_POST['email'],
									'user_password' => $_POST['password'],
									'remember' => $remember])){
		if (is_wp_error($login)){
			echo json_encode(['type' => 'alert-warning','text' => $login->get_error_message()]);
			die;
		}
		$redirect = (isset($_POST['redirect']))?$_POST['redirect']:site_url();
		echo json_encode(['type' => 'success-redirect','url' => $redirect]);
		die;
	}
}
add_action('wp_ajax_nopriv_login_user','login_user');


/**
 * Handle visitor backer pledge
 * @return error or success message
 */
function add_visitor_backer(){
	$error = new WP_Error();
	if (empty($_POST['full_name']) || empty($_POST['email']) || empty($_POST['address']) || empty($_POST['contact'])){
		$error->add('empty_fields','All fields are required');
	}
	if (!isset($_POST['accept_terms'])){
		$error->add('terms_not_accepted','Please accept the agreement');
	}
	//Show warning message if error
	if (!empty($error->get_error_message())){
		echo json_encode(['type' => 'alert-warning','text' => $error->get_error_message()]);
		die;
	}
	//Sanitize data
	$full_name = sanitize_text_field($_POST['full_name']);
	$email = sanitize_email($_POST['email']);
	$address = sanitize_text_field($_POST['address']);
	$contact = sanitize_text_field($_POST['contact']);
	$project_id = intval($_POST['project_id']);
	//Insert user into the database
	global $wpdb;
	if ($wpdb->insert('rbnd_backers_visitors',['project_id' => $project_id,
																							'full_name' => $full_name,
																							'email' => $email,
																							'address' => $address,
																							'contact' => $contact])){
		echo json_encode(['type' => 'success-redirect','url' => get_post_permalink($project_id)."?action=pledge&user_type=visitor&uid=".$wpdb->insert_id]);
		die;
	}
	else{
		echo json_encode(['type' => 'alert-warning','text' => 'User details not saved']);
		die;
	}
}
add_action('wp_ajax_nopriv_register_visitor_pledge','add_visitor_backer');


/**
 * Edit profile info
 */
function edit_user_profile(){
	$error = new WP_Error();
	if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['address']) || empty($_POST['email']) || empty($_POST['phone'])){
		$error->add('empty_fields','Fields marked * are required');
	}
	if (!is_email( $_POST['email'])){
		$error->add('invalid_email','Please enter a valid email');
	}

	if ($existing = email_exists( $_POST['email'])){
		if ($existing != get_current_user_id())
			$error->add('invalid_email','Email is already registered in the system');
	}
	//Show warning message if error
	if (!empty($error->get_error_message())){
		echo json_encode(['type' => 'alert-warning','text' => $error->get_error_message()]);
		die;
	}
	//Update user data
	$first_name = sanitize_text_field($_POST['first_name']);
	$last_name = sanitize_text_field($_POST['last_name']);
	$email = sanitize_email($_POST['email']);
	$address = sanitize_text_field($_POST['address']);
	$phone = sanitize_text_field($_POST['phone']);
	$description = sanitize_textarea_field($_POST['biography']);
	if (wp_update_user(['ID' => get_current_user_id(),
									'user_email' => $email,
									'first_name' => $first_name,
									'last_name' => $last_name,
									'display_name' => $first_name.' '.$last_name,
									'description' => $description])){
		update_user_meta(get_current_user_id(),'address',$address);
		update_user_meta(get_current_user_id(),'phone',$phone);
		if (isset($_FILES) && $_FILES['user_image']['error'] == 0){
			if ( ! function_exists( 'wp_handle_upload' ) ) {
			  require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}
			$uploadedfile = $_FILES['user_image'];
			$upload_overrides = array( 'test_form' => false );
			$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
			if ( $movefile && ! isset( $movefile['error'] ) )
				update_user_meta(get_current_user_id(),'user_image',$movefile['url']);
		}
		// echo json_encode(['type' => 'alert-success','text' => 'User profile updated']);
		echo json_encode(['type' => 'success-redirect','url' => $_SERVER['HTTP_REFERER']]);
		die;
	}
	else{
		echo json_encode(['type' => 'alert-warning','text' => 'Profile not updated']);
		die;
	}
}
add_action('wp_ajax_editprofile','edit_user_profile');


/**
 * Change password
 */
function change_user_password(){
	$error = new WP_Error();
	if (empty($_POST['old_password']) || empty($_POST['new_password']) || empty($_POST['password_confirm'])){
		$error->add('empty_fields','Fields marked * are required');
	}
	if ($_POST['new_password'] != $_POST['password_confirm']){
		$error->add('password_mismatch','Passwords donot match');
	}
	$user = wp_get_current_user();
	if (!wp_check_password($_POST['old_password'],$user->user_pass)){
		$error->add('incorrect_password','The old password is incorrect');
	}
	//Show warning message if error
	if (!empty($error->get_error_message())){
		echo json_encode(['type' => 'alert-warning','text' => $error->get_error_message()]);
		die;
	}
	wp_set_password($_POST['new_password'],$user->ID);
	echo json_encode(['type' => 'alert-success','text' => 'Password changed successfully']);
	die;
}
add_action('wp_ajax_change_password','change_user_password');


/**
 * Lost password
 */
function send_password_recovery_mail(){
	$error = retrieve_password();
	$error = new WP_Error();
	//Show warning message if error
	if (!empty($error->get_error_message())){
		echo json_encode(['type' => 'alert-warning','text' => $error->get_error_message()]);
		die;
	}
  if ( is_wp_error( $pass_err ) ) {
  	echo json_encode(['type' => 'alert-warning','text' => $pass_err->get_error_message()]);
		die;
  }else{
		echo json_encode(['type' => 'alert-success','text' => 'Reset link has been sent to your email']);
		die;
	}
}
add_action('wp_ajax_nopriv_forgot_password','send_password_recovery_mail');


function reset_user_password(){
	$error = new WP_Error();
	if (empty($_POST['password']) || empty($_POST['password_confirm'])){
		$error->add('empty_fields','Fields marked * are required');
	}
	if ($_POST['password'] != $_POST['password_confirm']){
		$error->add('password_mismatch','Passwords donot match');
	}
	//Show warning message if error
	if (!empty($error->get_error_message())){
		echo json_encode(['type' => 'alert-warning','text' => $error->get_error_message()]);
		die;
	}
	$user = check_password_reset_key( $_POST['key'], $_POST['login'] );
	if ( ! $user || is_wp_error( $user ) ) {
  	echo json_encode(['type' => 'alert-warning','text' => $user->get_error_message()]);
		die;
  }
	// Parameter checks OK, reset password
  reset_password( $user, $_POST['password'] );
	echo json_encode(['type' => 'alert-success','text' => 'Password changed successfully']);
	die;
}
add_action('wp_ajax_nopriv_reset_password','reset_user_password');


function search_projects(){
	$search = new WP_Query(['post_type' => 'project',
													's' => $_GET['key'],
													'posts_per_page' => 4 ]);
	ob_start();
	if ($search->have_posts()):
		while($search->have_posts()):
			$search->the_post();
			get_template_part('template-parts/content','project');
		endwhile;
	else:
		echo "<h2 class='fc-white text-center'>No Project Found</h2>";
	endif;
	$results = ob_get_clean();
	echo $results;
	wp_die();
}
add_action('wp_ajax_searchProjects','search_projects');
add_action('wp_ajax_nopriv_searchProjects','search_projects');