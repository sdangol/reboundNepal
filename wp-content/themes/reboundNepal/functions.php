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
	wp_enqueue_script( 'jQuery', get_theme_file_uri( '/js/jquery-1.9.1.min.js' ), array(), '1.9.1', true );
	wp_enqueue_script( 'jQuery-migrate', get_theme_file_uri( '/js/jquery-migrate-1.2.1.min.js' ), array(), '1.2.1', true );
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
																		'public' => true,
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
																'supports' => ['title','editor','thumbnail','custom-fields','comments'],
																'menu_icon' => 'dashicons-media-spreadsheet',
																'taxonomies' => ['project-category']]);
	//Register Project
	register_post_type('our-team',['labels' => ['name' => 'Our Team',
																						 'singular_name' => 'Team',
																						 'add_new' => 'Add Member',
																						 'add_new_item' => 'Add New Member',
																						 'edit_item' => 'Edit Member',
																						 'view_item' => 'View Member',
																						 'not_found' => 'No Members Found'],
																'public' => true,
																'supports' => ['title','editor','thumbnail','custom-fields'],
																'menu_icon' => 'dashicons-groups']);

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
		if (get_user_meta($user->ID,'approval_status',true) == 1) return $user;
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


//Include file for ajax form handling
include_once __DIR__."/includes/ajax-functions.php";