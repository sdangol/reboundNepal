<?php
get_header();
	while(have_posts()):
		the_post();
?>
<div class="container_12">
	<div class="how-it-work">
		<div class="grid_12 short-introduce">
			<h3 class="rs title"><span class="fc-black"><?php the_title(); ?></h3>
			<div class="box-introduce">
				<div class="wrap-2col">
					<div class="left-intro">
						<?php the_content(); ?>
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