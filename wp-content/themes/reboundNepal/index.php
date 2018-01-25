<?php
	get_header();
	while (have_posts()):
		the_post();
?>

	<div class="home-feature-category how-it-work">
		<div class="container_12 clearfix short-introduce">
			<h2 class="rs title"><span class="fc-black"><?php the_title(); ?></h2>
			<div class="box-introduce general-content">
				<?php if (has_post_thumbnail()): ?>
					<div class="left-intro">
						<?php the_content(); ?>
					</div>
					<div class="right-intro"><?php the_post_thumbnail('full'); ?></div>
				<?php else: ?>
				<p><?php the_content(); ?></p>
				<?php endif; ?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div><!--end: .home-feature-category -->
<?php
	get_footer();
	endwhile;
?>