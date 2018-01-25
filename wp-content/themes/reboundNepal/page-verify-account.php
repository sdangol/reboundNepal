<?php
//Check if this page is loaded with the token
if (isset($_GET['token'])){
	//Search for users with the token
	$user_query = new WP_User_Query(['meta_query' => ['relation' => 'AND',
																										['key' => 'approval_status',
																										'value' => 0],
																										['key' => 'user_activation_token',
																										'value' => $_GET['token']]]]);
	$user = $user_query->get_results();
	//If token doesnt match with any user send them to home page
	if (empty($user)){
		wp_redirect(site_url('?response=invalid_token'));
		die;
	}else{
	//else activate their account
		update_user_meta($user[0]->ID,'approval_status',1);
	}
}
get_header();
	while(have_posts()):
		the_post();
?>
<div class="container_12">
	<div class="how-it-work">
		<div class="grid_12 short-introduce">
			<h3 class="rs title"><span class="fc-black">Your account has been</span> verified</h3>
			<div class="box-introduce">
				<div class="wrap-2col">
					<div class="left-intro">
						<?php the_content(); ?>
						<a class="btn btn-red btn-star-project" href="#">
							<span class="lbl">Start project</span>
							<span class="desc">Its free</span>
						</a>
					</div>
					<div class="right-intro"><?php the_post_thumbnail('full'); ?></div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
	endwhile;
	get_footer();
?>