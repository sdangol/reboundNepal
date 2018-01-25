<?php
/**
 * Template Name: Our Team
 */
get_header();
	while(have_posts()):
		the_post();
?>
<div class="container_12">
	<div class="how-it-work">
		<div class="grid_12 short-introduce">
			<h3 class="rs title"><span class="fc-black"><?php the_title(); ?></h3>
			<div class="box-introduce">
				<?php
					$team = new WP_Query(['post_type' => 'our-team']);
					$i = 0;
					while($team->have_posts()):
						$team->the_post();
						$i++;
				?>
						<div class="grid_6 team-member-container">
							<div class="team-member-portrait">
								<?php the_post_thumbnail( 'full' ); ?>
							</div>
							<div class="team-member-details">
								<?php the_content(); ?>
							</div>
						</div>
						<?php if ($i % 2 == 0): ?>
							<div class="clear"></div>
						<?php endif; ?>
					<?php endwhile; wp_reset_postdata(); ?>
					<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
	endwhile;
	get_footer();