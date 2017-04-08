<?php
get_header();
	while(have_posts()):
		the_post();
		if (is_user_logged_in() || (isset($_GET['user_type']) && $_GET['user_type'] == 'visitor' && isset($_GET['uid']))){
			include(locate_template(('template-parts/content-donation-select.php')));
		}else{
			include(locate_template(('template-parts/content-pledge-form.php')));
		}
	endwhile;
	get_footer();
?>