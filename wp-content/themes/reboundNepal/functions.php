<?php
/**
 * Rebound Nepal functions and definitions
 *
 */

/**
 * Enqueue scripts and styles.
 */
function reboundnepal_scripts() {
	// Add custom fonts, and other css.
	wp_enqueue_style( 'reboundnepal-fonts', "http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300", array(), null );
	wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/css/font-awesome.min.css' ) );
	wp_enqueue_style( 'normalize-css', get_theme_file_uri( '/css/normalize.css' ) );
	wp_enqueue_style( 'jquery-slider-css', get_theme_file_uri( '/css/jquery.sidr.light.css' ) );
	wp_enqueue_style( 'animate-css', get_theme_file_uri( '/css/animate.min.css' ) );
	wp_enqueue_style( 'md-slider-css', get_theme_file_uri( '/css/md-slider.css' ) );
	if (is_singular('project')){
		wp_enqueue_style( 'responsive-slides-css', get_theme_file_uri( '/css/responsiveslides.css' ) );
	}
	wp_enqueue_style( 'reboundnepal-style', get_stylesheet_uri() );
	wp_enqueue_style( 'responsive-css', get_theme_file_uri( '/css/responsive.css' ) );
	wp_enqueue_style( 'custom-css', get_theme_file_uri( '/css/custom.css' ) );

	//Add js files
	wp_enqueue_script( 'raphael-js', get_theme_file_uri( '/js/raphael-min.js' ), array(), '1.0', true );
	wp_enqueue_script( 'jQuery', get_theme_file_uri( '/js/jquery-3.2.1.min.js' ));
	// wp_enqueue_script( 'jQuery-migrate', get_theme_file_uri( '/js/jquery-migrate-1.2.1.min.js' ), array(), '1.2.1', true );
	wp_enqueue_script( 'touchwipe-js', get_theme_file_uri( '/js/jquery.touchwipe.min.js' ), array(), '1.0', true );
	wp_enqueue_script( 'md-slider-js', get_theme_file_uri( '/js/md_slider.min.js' ), array(), '1.0', true );
	wp_enqueue_script( 'jQuery-sidr', get_theme_file_uri( '/js/jquery.sidr.min.js' ), array(), '1.0', true );
	wp_enqueue_script( 'jQuery-tweet', get_theme_file_uri( '/js/jquery.tweet.min.js' ), array(), '1.0', true );
	wp_enqueue_script( 'pie-js', get_theme_file_uri( '/js/pie.js' ), array(), '1.0', true );
	if (is_singular('project')){
		wp_enqueue_script( 'resposiveslides-js', get_theme_file_uri( '/js/responsiveslides.min.js' ), array(), '1.0', true );
	}
	wp_enqueue_script( 'script-js', get_theme_file_uri( '/js/script.js' ), array(), '1.0', true );
	wp_enqueue_script( 'custom-js', get_theme_file_uri( '/js/custom.js' ), array(), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'reboundnepal_scripts' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
*/
function reboundnepal_setup(){
	//Add features to theme
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5');
	add_theme_support( 'title-tag' );
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'footer-menu' => __( 'Footer Links Menu', 'reboundnepal' ),
	) );
}
add_action( 'after_setup_theme', 'reboundnepal_setup' );

/**
 * Remove admin login header
 */
// function remove_admin_login_header() {
// 	remove_action('wp_head', '_admin_bar_bump_cb');
// }
// add_action('get_header', 'remove_admin_login_header');

/**
 * Register custom post types
 */
function reboundnepal_register_post_types(){
	//Register home page slider
	register_post_type('home-slider',['labels' => ['name' => 'Home Page Sliders',
																								 'singular_name' => 'Home Page Slider',
																								 'add_new' => 'Add Slider',
																								 'add_new_item' => 'Add New Slider',
																								 'edit_item' => 'Edit Slider',
																								 'view_item' => 'View Slider',
																								 'not_found' => 'No Slider Found'],
																		'show_ui' => true,
																		'supports' => ['title','editor','thumbnail','custom-fields'],
																		'menu_icon' => 'dashicons-slides']);
	//Register Project
	register_post_type('project',['labels' => ['name' => 'Projects',
																						 'singular_name' => 'Project',
																						 'add_new' => 'Add Project',
																						 'add_new_item' => 'Add New Project',
																						 'edit_item' => 'Edit Project',
																						 'view_item' => 'View Project',
																						 'not_found' => 'No Project Found'],
																'public' => true,
																'supports' => ['title','editor','thumbnail','custom-fields','comments','author'],
																'menu_icon' => 'dashicons-media-spreadsheet',
																'taxonomies' => ['project-category']]);
	//Register Team
	register_post_type('our-team',['labels' => ['name' => 'Our Team',
																						 'singular_name' => 'Team',
																						 'add_new' => 'Add Member',
																						 'add_new_item' => 'Add New Member',
																						 'edit_item' => 'Edit Member',
																						 'view_item' => 'View Member',
																						 'not_found' => 'No Members Found'],
																'show_ui' => true,
																'supports' => ['title','editor','thumbnail','custom-fields'],
																'menu_icon' => 'dashicons-groups']);

	//Register Partners
	register_post_type('our-partners',['labels' => ['name' => 'Our Partners',
																						 'singular_name' => 'Partner',
																						 'add_new' => 'Add Partner',
																						 'add_new_item' => 'Add New Partner',
																						 'edit_item' => 'Edit Partner',
																						 'view_item' => 'View Partner',
																						 'not_found' => 'No Partners Found'],
																'show_ui' => true,
																'supports' => ['title','thumbnail','custom-fields'],
																'menu_icon' => 'dashicons-groups']);

	//Register Testimonials
	register_post_type('testimonials',['labels' => ['name' => 'Testimonials',
																						 'singular_name' => 'Testimonial',
																						 'add_new' => 'Add Testimonial',
																						 'add_new_item' => 'Add New Testimonial',
																						 'edit_item' => 'Edit Testimonial',
																						 'view_item' => 'View Testimonial',
																						 'not_found' => 'No Testimonial Found'],
																'show_ui' => true,
																'supports' => ['title','editor','thumbnail','custom-fields'],
																'menu_icon' => 'dashicons-testimonial']);

}
add_action('init','reboundnepal_register_post_types');

//Remove wrapping p tag in content
remove_filter('the_content','wpautop');

/**
 * Register custom taxonomy
 */
function reboundnepal_register_taxonomy(){
	//Register project category
	register_taxonomy('project-category',
										['project'],
										['labels' => ['name' => 'Project Categories',
																 'singular_name' => 'Project Category',
																 'add_new_item' => 'Add New Project Category',
																 'edit_item' => 'Edit Project Category',
																 'view_item' => 'View Project Category',
																 'not_found' => 'No Project Category Found'],
										'public' => true,
										'hierarchical' => true]);
	//Featured Category
	register_taxonomy('featured-category',
									['project'],
									['labels' => ['name' => 'Featured Categories',
															 'singular_name' => 'Featured Category',
															 'add_new_item' => 'Add New Featured Category',
															 'edit_item' => 'Edit Featured Category',
															 'view_item' => 'View Featured Category',
															 'not_found' => 'No Featured Category Found'],
									'public' => true,
									'hierarchical' => true]);
}
add_action('init','reboundnepal_register_taxonomy');


/**
 * Get the number of days left for project to end
 * @param  int 		$project_id   ID of Project Post
 * @return int             			Number of days
 */
function get_days_left($project_id){
	$end_date = strtotime(get_field('funding_end_date',$project_id));
	$today = strtotime(date('Y-m-d'));
	$days_left = floor( ($end_date - $today)/(60*60*24) );
	return $days_left;
}

/**
 * Get the amount funded of a project
 * @param  int 		$project_id Project ID
 */
function get_project_funded_amount($project_id){
	global $wpdb;
	$funded_amount = $wpdb->get_var($wpdb->prepare('SELECT SUM(total) FROM ((SELECT SUM(pledged_amount) as total FROM rbnd_backers_registered WHERE project_id = %d) UNION ALL (SELECT SUM(pledged_amount) as total FROM rbnd_backers_visitors WHERE project_id = %d) ) t1',$project_id,$project_id));
	return isset($funded_amount)?$funded_amount:0;
}

/**
 * Get the percentage funded of a project
 * @param  int 		$project_id Project ID
 */
function get_project_completed_percentage($project_id){
	$project = get_post($project_id);
	global $wpdb;
	$funded_amount = get_project_funded_amount($project_id);
	$target_amount = get_selected_currency_amount($project_id,'stretch_target',false);
	if ($target_amount){
		$percentage = $funded_amount/$target_amount*100;
	}else{
		$percentage = 0;
	}
	return round($percentage);
}

/**
 * Get the total backers of a project
 * @param  int 		$project_id Project ID
 */
function get_project_backers($project_id,$field='count'){
	global $wpdb;
	$visitor_sql = "SELECT full_name,email,address,contact,pledged_amount,backed_date,'visitor' as user_type FROM {$wpdb->prefix}backers_visitors WHERE completed_status = 1";
  $registered_sql = "SELECT display_name as full_name,user_email as email,m1.meta_value as address,m2.meta_value as contact,pledged_amount,backed_date,'registered' as user_type FROM {$wpdb->prefix}backers_registered t1 JOIN {$wpdb->users} u1 ON u1.ID = t1.backer_id LEFT JOIN {$wpdb->usermeta} m1 ON (m1.user_id = t1.backer_id AND m1.meta_key = 'address' ) LEFT JOIN {$wpdb->usermeta} m2 ON (m2.user_id = t1.backer_id AND m2.meta_key = 'contact' )  WHERE completed_status = 1";
	$visitor_sql .= " AND project_id = ".$project_id;
	$registered_sql .= " AND project_id = ".$project_id;
  $sql = $visitor_sql." UNION ".$registered_sql;
  $result = $wpdb->get_results( $sql, 'ARRAY_A' );
	if ($field == 'count') return count($result);
	else return $result;
}

/**
 * Get the number of days between two dates
 * @param  date 		$end_date   	Ending At
 * @param  date 		$start_date   Starting From
 * @return int             			Number of days
 */
function get_days_between($end_date,$start_date){
	$end_date = strtotime($end_date);
	$start_date = strtotime($start_date);
	$days_left = floor( ($end_date - $start_date)/(60*60*24) );
	return $days_left;
}

/**
 * Register widget area.
 */
function reboundnepal_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer Widget', 'reboundnepal' ),
		'id'            => 'footer-widget',
		'description'		=> 'Add content at the footer section',
		'before_widget' => '<div class="grid_3">',
		'after_widget'  => '</div>',
		'before_title'	=> '<h3 class="rs title">',
		'after_title'		=> '</h3>'
	) );
}
add_action( 'widgets_init', 'reboundnepal_widgets_init' );


//Add custom class to nav menu
class reboundnepal_walker_nav_menu extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth = 0, $args = array()) {
  	$output .= "<p class='rs term-privacy'>";
  }
  function end_lvl(&$output, $depth = 0, $args = array()) {
    $output .= "\n</p>";
  }
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	$output .= "<a class='fw-b be-fc-orange' href='".$item->url."'>".$item->title."</a>";
	}
  function end_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
  	$output .= "\n</a>\n";
  }
}

/**
 * Display formatted comments
 * @param  WP_Comment $comment Comment Object
 * @param  array 			$args    Array of arguments supplied to wp_list_comments
 * @param  int 				$depth   Depth of comment
 */
function reboundnepal_comments($comment, $args, $depth) {
    ?>
    <div class="media comment-item lv<?php echo $depth; ?>" id="comment-<?php comment_ID() ?>">
    	<a href="<?php //echo get_author_posts_url($comment_author->ID); ?>" class="thumb-left">
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
      </a>
      <div class="media-body">
        <h4 class="rs comment-author">
            <a href="<?php //echo get_author_posts_url($comment_author->ID); ?>" class="be-fc-orange fw-b"><?php echo $comment->comment_author; ?></a>
            <span class="fc-gray">says:</span>
        </h4>
        <p class="rs comment-content">
			    <?php if ( $comment->comment_approved == '0' ) : ?>
			         <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
			          <br />
			    <?php endif; ?>
			    <?php comment_text(); ?>
        </p>
        <p class="rs time-post"><?php echo (get_days_between(date('Y-m-d'),$comment->comment_date) == -1)?"Today":get_days_between(date('Y-m-d'),$comment->comment_date)." days ago"; ?></p>
    	</div>
  	</div>
    <?php
    }

/**
 * Override the automatic closing of comments
 */
function reboundnepal_comments_end(){
	return;
}

/**
 * Check if the user account has been verified
 * @param  WP_User/WP_Error 	$user     	User Object/Error Object
 * @param  string 						$password 	Plain text password
 * @return WP_User/WP_Error           		User Object if approved, else Error Object
 */
function login_check_approved($user,$username,$password){
	if (!isset($user) || is_wp_error($user)) return new WP_Error('invalid_cred','Invalid username/password');
	else{
		if ( user_can($user->ID,'administrator') || get_user_meta($user->ID,'approval_status',true) == 1) return $user;
		else return new WP_Error('not_verified','Account has not been verified');
	}
}
add_filter('authenticate','login_check_approved',20,3);

/**
 * Prevent users other than admin from the backend
 */
// function blockusers_init() {
// 	if ( is_admin() && ! current_user_can( 'administrator' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
// 		wp_redirect( home_url() );
// 		exit;
// 	}
// }
// add_action( 'init', 'blockusers_init' );

//Remove admin bar in frontend
add_filter('show_admin_bar', '__return_false');

function pledge_page_template( $template ) {
	if ( is_singular( 'project' ) && isset($_GET['action']) && $_GET['action'] == 'pledge' ) {
		$new_template = locate_template( array( 'pledge.php' ) );
		if ( '' != $new_template ) {
			return $new_template ;
		}
	}
	return $template;
}
add_filter( 'template_include', 'pledge_page_template', 99 );

function alter_query( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_tax() ) {
        $query->set( 'posts_per_page', 6 );
        return;
    }

    if ( is_author() ) {
        $query->set( 'post_type', 'project' );
        $query->set( 'posts_per_page', 2 );
        return;
    }

    if (is_search()){
    	$query->set( 'post_type', 'project' );
      $query->set( 'posts_per_page', 9 );
      return;
    }
}
add_action( 'pre_get_posts', 'alter_query', 1 );


/**
 * Add project from frontend
 */
function my_pre_save_post( $post_id ) {
  // check if this is to be a new post
  if( $post_id == 'new' ) {
	  $post = array(
	      'post_status'  => 'publish',
	      'post_title'  => $_POST['title'],
	      'post_content' => $_POST['description'],
	      'post_type'  => 'project',
	  );
	  // insert the post
	  $post_id = wp_insert_post( $post );
	}else{
		wp_update_post(['ID' => $post_id,
										'post_title'  => $_POST['title'],
	      						'post_content' => $_POST['description']]);
	}
    //Assign project category
    wp_set_object_terms($post_id,$_POST['category'],'project-category');

    //Set post thumbnail
    set_post_thumbnail($post_id,$_POST['feature-image']);

    //Save the acf fields
    do_action('acf/save_post', $post_id);

    wp_redirect(get_permalink($post_id));
    die;
}
add_filter('acf/pre_save_post' , 'my_pre_save_post' );


/**
 * Redirects to the custom password reset page, or the login page
 * if there are errors.
 */
function redirectToCustomPasswordReset() {
  if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
  	$check = check_password_reset_key($_REQUEST['key'],$_REQUEST['login']);
  	if (is_wp_error($check)){
  		$redirect_url = site_url('?auth=required&err=invalid-reset');
  	}else{
	    $redirect_url = site_url("?auth=required&form=resetpass&key={$_REQUEST['key']}&login={$_REQUEST['login']}");
	  }
    wp_redirect( $redirect_url );
    exit;
  }
}
add_action( 'login_form_rp','redirectToCustomPasswordReset');
add_action( 'login_form_resetpass','redirectToCustomPasswordReset');


if (!function_exists('retrieve_password')){
	/**
	 * Handles sending password retrieval email to user.
	 *
	 * @return bool|WP_Error True: when finish. WP_Error on error
	 */
	function retrieve_password() {
		$errors = new WP_Error();

		if ( empty( $_POST['user_login'] ) ) {
			$errors->add('empty_username', __('<strong>ERROR</strong>: Enter a username or email address.'));
		} elseif ( strpos( $_POST['user_login'], '@' ) ) {
			$user_data = get_user_by( 'email', trim( wp_unslash( $_POST['user_login'] ) ) );
			if ( empty( $user_data ) )
				$errors->add('invalid_email', __('<strong>ERROR</strong>: There is no user registered with that email address.'));
		} else {
			$login = trim($_POST['user_login']);
			$user_data = get_user_by('login', $login);
		}

		/**
		 * Fires before errors are returned from a password reset request.
		 *
		 * @since 2.1.0
		 * @since 4.4.0 Added the `$errors` parameter.
		 *
		 * @param WP_Error $errors A WP_Error object containing any errors generated
		 *                         by using invalid credentials.
		 */
		do_action( 'lostpassword_post', $errors );

		if ( $errors->get_error_code() )
			return $errors;

		if ( !$user_data ) {
			$errors->add('invalidcombo', __('<strong>ERROR</strong>: Invalid username or email.'));
			return $errors;
		}

		// Redefining user_login ensures we return the right case in the email.
		$user_login = $user_data->user_login;
		$user_email = $user_data->user_email;
		$key = get_password_reset_key( $user_data );

		if ( is_wp_error( $key ) ) {
			return $key;
		}

		$message = __('Someone has requested a password reset for the following account:') . "\r\n\r\n";
		$message .= network_home_url( '/' ) . "\r\n\r\n";
		$message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
		$message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
		$message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
		$message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";

		if ( is_multisite() ) {
			$blogname = get_network()->site_name;
		} else {
			/*
			 * The blogname option is escaped with esc_html on the way into the database
			 * in sanitize_option we want to reverse this for the plain text arena of emails.
			 */
			$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
		}

		/* translators: Password reset email subject. 1: Site name */
		$title = sprintf( __('[%s] Password Reset'), $blogname );

		/**
		 * Filters the subject of the password reset email.
		 *
		 * @since 2.8.0
		 * @since 4.4.0 Added the `$user_login` and `$user_data` parameters.
		 *
		 * @param string  $title      Default email title.
		 * @param string  $user_login The username for the user.
		 * @param WP_User $user_data  WP_User object.
		 */
		$title = apply_filters( 'retrieve_password_title', $title, $user_login, $user_data );

		/**
		 * Filters the message body of the password reset mail.
		 *
		 * @since 2.8.0
		 * @since 4.1.0 Added `$user_login` and `$user_data` parameters.
		 *
		 * @param string  $message    Default mail message.
		 * @param string  $key        The activation key.
		 * @param string  $user_login The username for the user.
		 * @param WP_User $user_data  WP_User object.
		 */
		$message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );

		if ( $message && !wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) )
			wp_die( __('The email could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function.') );

		return true;
	}
}


/**
 * Delete the project
 */
function deleteProject(){
	if (is_admin() || get_current_user_id() == get_post_field('post_author',$_POST['project_id'])){
		wp_trash_post($_POST['project_id']);
	}
	wp_redirect(get_author_posts_url(get_current_user_id()));
	die;
}
add_action('admin_post_deleteProject','deleteProject');

/**
 * Add paypal donor info to db
 */
function save_paypal_donor($response){
	if (isset($response['custom'])){
		parse_str($response['custom'],$custom);
		global $wpdb;
		if ($custom['user_type'] == 'visitor'){
			$wpdb->update('rbnd_backers_visitors',['pledged_amount' => $response['payment_gross'], 'completed_status' => 1],['ID' => $custom['uid']]);
		}elseif ($custom['user_type'] == 'registered'){
			$wpdb->insert('rbnd_backers_registered',['project_id' => $custom['project_id'], 'backer_id' => $custom['uid'], 'pledged_amount' => $response['payment_gross'], 'completed_status' => 1]);
		}
	}
}
add_action('paypal_ipn_for_wordpress_payment_status_completed','save_paypal_donor',10,1);

/**
 * Add khalti donor info to db
 */
function save_khalti_donor($response){
	if (isset($response['custom'])){
		parse_str($response['custom'],$custom);
		global $wpdb;
		if ($custom['user_type'] == 'visitor'){
			$wpdb->update('rbnd_backers_visitors',['pledged_amount' => $response['amount'],'completed_status' => 1],['ID' => $custom['uid']]);
		}elseif ($custom['user_type'] == 'registered'){
			$wpdb->insert('rbnd_backers_registered',['project_id' => $custom['project_id'], 'backer_id' => $custom['uid'], 'pledged_amount' => $response['amount'],'completed_status' => 1]);
		}
	}
}
add_action('wp_khalti_success','save_khalti_donor',10,1);

/**
 * Return the amount according to the currency selected
 * @param  int  	 $post_id  		Post ID
 * @param  string  $field   		ACF Field Name
 * @param  boolean $prefix  		True if $ or Rs is to be prepended, otherwise false
 * @param  boolean $sub_field  	True if field to be obtained is inside repeater field, otherwise false
 */
function get_selected_currency_amount($post_id, $field, $prefix = true, $sub_field = false){
	//Check if parent or child field is queried
	if ($sub_field){
		$function = 'get_sub_field';
	}else{
		$function = 'get_field';
	}
	//Check type of cuurency selected
	if (get_field('currency',$post_id) == 'rupees'){
		$amt = $function($field.'_rs',$post_id);
		$sign = get_selected_currency_sign($post_id);
	}elseif (get_field('currency',$post_id) == 'dollars'){
		$amt = $function($field.'_dlr',$post_id);
		$sign = get_selected_currency_sign($post_id); 
	}
	//Append prefix
	if ($prefix) {
		return $sign.$amt;
	}else{
		return $amt;
	}
}

/**
 * Get selected currency sign
 */
function get_selected_currency_sign($post_id){
	if (get_field('currency',$post_id) == 'rupees'){
		return 'Rs. ';
	}elseif(get_field('currency',$post_id) == 'dollars'){
		return '$ ';
	}
}

// Custom avatar
function rbdn_custom_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
    $user = false;
    if ( is_numeric( $id_or_email ) ) {
        $id = (int) $id_or_email;
        $user = get_user_by( 'id' , $id );
    } elseif ( is_object( $id_or_email ) ) {
        if ( ! empty( $id_or_email->user_id ) ) {
            $id = (int) $id_or_email->user_id;
            $user = get_user_by( 'id' , $id );
        }
    } else {
        $user = get_user_by( 'email', $id_or_email );	
    }
    if ( $user && is_object( $user ) ) {
      $avatar = get_user_meta( $user->data->ID, 'user_image',true );
      $avatar = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
    }

    return $avatar;
}
add_filter( 'get_avatar' , 'rbdn_custom_avatar' , 1 , 5 );

//Include file for ajax form handling
include_once __DIR__."/includes/ajax-functions.php";