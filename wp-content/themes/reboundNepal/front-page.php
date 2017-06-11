<?php get_header(); ?>
	<div id="home-slider">
		<div class="md-slide-items md-slider" id="md-slider-1" data-thumb-width="105" data-thumb-height="70">
			<?php
				//Loop through home page sliders
				$sliders = new WP_Query(['post_type' => 'home-slider']);
				if ($sliders->have_posts()){
					while($sliders->have_posts()){
						$sliders->the_post();
			?>
			<div class="md-slide-item slide-0" data-timeout="6000">
				<div class="md-mainimg"><?php the_post_thumbnail('full'); ?></div>
				<div class="md-objects">
					<div class="md-object slide-with-background" data-x="20" data-y="58" data-width="500" data-height="170" data-padding-top="30" data-padding-bottom="30" data-padding-left="35" data-padding-right="35" data-start="300" data-stop="3600" data-easein="random" data-easeout="keep">
						<h2 class="rs slide-title"><?php the_title(); ?></h2>
						<p class="rs slide-description2"><?php the_content(); ?></p>
					</div>
				</div>
			</div>
			<?php
					}
					wp_reset_postdata();
				}
			?>
		</div>
	</div><!--end: #home-slider -->
	<div class="home-feature-category">
		<div class="container_12 clearfix">
			<div class="grid_4 left-lst-category">
				<div class="wrap-lst-category">
					<h3 class="title-welcome rs"><?php the_field('welcome_text'); ?></h3>
					<p class="description rs"><?php the_field('about_rebound_nepal'); ?></p>
					<nav class="lst-category">
						<ul class="rs nav nav-category">
						<?php
							//Get latest staff picked project
							$staff_picked = new WP_Query(['post_type' => 'project',
																				'tax_query' => [['taxonomy' => 'featured-category',
																												'field' => 'slug',
																												'terms' => 'staff-picks']],
																					'posts_per_page' => 1]);
							if ($staff_picked->have_posts()){
								while ($staff_picked->have_posts()) {
									$staff_picked->the_post();
									$staff_picked_project = get_post();
								}
							}
							wp_reset_postdata();
							$categories = get_terms(['taxonomy' => 'project-category',
																			'hide_empty' => false]);
							foreach ($categories as $category) {
						?>
							<li <?php if (has_term($category->term_id,'project-category',$staff_picked_project)) {echo "class='active'";$picked_category = $category;} ?>>
								<a href="<?php echo get_term_link($category); ?>">
									<?php echo $category->name; ?>
									<span class="count-val">(<?php echo $category->count; ?>)</span>
									<i class="icon iPlugGray"></i>
								</a>
							</li>
				<?php } ?>
						</ul>
						<p class="rs view-all-category">
							<a href="<?php echo site_url('/all-project-categories/'); ?>" class="be-fc-orange">+ View all categories</a>
						</p>
					</nav><!--end: .lst-category -->
				</div>
			</div><!--end: .left-lst-category -->
			<div class="grid_8 marked-category">
				<div class="wrap-title clearfix">
					<h2 class="title-mark rs">Staff Picks: <span class="fc-orange"><?php echo $picked_category->name; ?></span></h2>
					<a href="<?php echo get_term_link($picked_category); ?>" class="count-project be-fc-orange">See all <span class="fw-b"><?php echo $picked_category->count; ?></span> <?php echo $picked_category->name; ?> projects</a>
				</div>
				<?php
					if ($staff_picked->have_posts()){
						while ($staff_picked->have_posts()) {
							$staff_picked->the_post();
							get_template_part('template-parts/content','author-project');
						}
					}
			?>
			</div><!--end: .marked-category -->
			<div class="clear"></div>
		</div>
	</div><!--end: .home-feature-category -->
	<div class="home-popular-project">
		<div class="container_12">
			<div class="grid_12 wrap-title">
				<h2 class="common-title">Popular</h2>
				<?php
					//Get latest 4 popular posts
					$popular = new WP_Query(['post_type' => 'project',
																	'tax_query' => [['taxonomy' => 'featured-category',
																									'field' => 'slug',
																									'terms' => 'popular']],
																		'posts_per_page' => 4]);
				?>
				<a class="be-fc-orange" href="<?php echo get_term_link('popular','featured-category'); ?>">View all</a>
			</div>
			<div class="clear"></div>
			<div class="lst-popular-project clearfix">
			<?php
				if ($popular->have_posts()):
					while ($popular->have_posts()):
						$popular->the_post();
						get_template_part('template-parts/content','project');
					endwhile;
				endif;
				wp_reset_postdata();
				?>
				<!-- <div class="clear clear-2col"></div> -->
			</div>
		</div>
	</div><!--end: .home-popular-project -->
	<div class="home-discover-friends">
		<div class="container_12">
			<div class="row-friends">
				<?php
					$team = new WP_Query(['post_type' => 'our-team',
																'posts_per_page' => 18]);
					$team_array = $team->posts;
					for ($i = 0;$i < 8 ; $i ++):
				?>
				<a class="thumb-avatar" href="<?php echo get_permalink($team_array[$i]); ?>"><?php echo get_the_post_thumbnail($team_array[$i],'full'); ?></a>
				<?php
					endfor;
				?>
				<div class="clear"></div>
			</div>
			<div class="row-friends row-connect-fb">
				<a class="thumb-avatar t-first" href="<?php echo get_permalink($team_array[8]); ?>"><?php echo get_the_post_thumbnail($team_array[8],'full'); ?></a>
				<div class="connect-fb">
					<p class="rs description">Discover great projects with your friends!</p>
					<a href="#" class="btn btn-fb">Meet Our Team</a>
				</div>
				<a class="thumb-avatar t-last" href="<?php echo get_permalink($team_array[9]); ?>"><?php echo get_the_post_thumbnail($team_array[0],'full'); ?></a>
				<div class="clear"></div>
			</div>
			<div class="row-friends">
			<?php for ($i=1; $i < 9 ; $i++) : ?>
				<a class="thumb-avatar" href="<?php echo get_permalink($team_array[$i]); ?>"><?php echo get_the_post_thumbnail($team_array[$i],'full'); ?></a>
			<?php endfor; ?>
				<div class="clear"></div>
			</div>
		</div>
	</div><!--end: .home-discover-friends -->

	<div class="additional-info-line">
		<div class="container_12">
			<div class="grid_9">
				<h2 class="rs title"><?php the_field('last_section_title'); ?></h2>
				<p class="rs description"><?php the_field('last_section_description'); ?></p>
			</div>
			<div class="grid_3 ta-r">
				<a class="btn bigger btn-red" href="how-it-work.html">Learn more</a>
			</div>
			<div class="clear"></div>
		</div>
	</div><!--end: .additional-info-line -->
<?php get_footer(); ?>