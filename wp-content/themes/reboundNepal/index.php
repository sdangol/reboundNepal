<?php
	get_header();
	while (have_posts()):
		the_post();
?>

	<div class="home-feature-category how-it-work">
		<div class="container_12 clearfix short-introduce">
			<h2 class="rs title"><span class="fc-black"><?php the_title(); ?></h2>
			<?php the_content(); ?>
			<div class="clear"></div>
		</div>
	</div><!--end: .home-feature-category -->
<?php
	get_footer();
	endwhile;
?>