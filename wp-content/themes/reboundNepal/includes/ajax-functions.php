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
	if (!empty($error->get_error_message())){
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
		$headers[] = 'From: Rebound Nepal <admin@reboundnepal.com>';
		$headers[] = 'Content-Type: text/html; charset=UTF-8';
		wp_mail($email,'Rebound Nepal Registration',$message,$headers);
		echo json_encode(['type' => 'alert-success','text' => 'Please check email to verify your registration.']);
		die;
	}
}
add_action('wp_ajax_register_user','register_user');
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
	$email = sanitize_email($_POST['email']);
	if ($login = wp_signon(['user_login' => $email,
									'user_password' => $_POST['password'],
									'remember' => $remember])){
		if (is_wp_error($login)){
			echo json_encode(['type' => 'alert-warning','text' => $login->get_error_message()]);
			die;
		}
		echo json_encode(['type' => 'success-redirect','url' => site_url()]);
		die;
	}
}
add_action('wp_ajax_login_user','login_user');
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