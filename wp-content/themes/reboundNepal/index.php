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
							<a href="category.html" class="be-fc-orange">+ View all categories</a>
						</p>
					</nav><!--end: .lst-category -->
				</div>
			</div><!--end: .left-lst-category -->
			<div class="grid_8 marked-category">
				<div class="wrap-title clearfix">
					<h2 class="title-mark rs">Staff Picks: <span class="fc-orange"><?php echo $picked_category->name; ?></span></h2>
					<a href="category.html" class="count-project be-fc-orange">See all <span class="fw-b"><?php echo $picked_category->count; ?></span> <?php echo $picked_category->name; ?> projects</a>
				</div>
				<div class="box-marked-project project-short">
					<div class="top-project-info">
						<div class="content-info-short clearfix">
							<a href="#" class="thumb-img">
								<?php echo get_the_post_thumbnail($staff_picked_project,'full'); ?>
							</a>
							<div class="wrap-short-detail">
								<h3 class="rs acticle-title"><a class="be-fc-orange" href="<?php echo get_permalink($staff_picked_project); ?>"><?php echo get_the_title($staff_picked_project); ?></a></h3>
								<p class="rs tiny-desc">by <a href="<?php echo get_author_posts_url($staff_picked_project->post_author); ?>" class="fw-b fc-gray be-fc-orange"><?php the_author_meta('display_name',$staff_picked_project->post_author); ?></a> in <span class="fw-b fc-gray"><?php the_field('location',$staff_picked_project->ID); ?></span></p>
								<p class="rs title-description"><?php echo wp_trim_words($staff_picked_project->post_content,25); ?></p>
							</div>
							<p class="rs clearfix comment-view">
								<a href="#" class="fc-gray be-fc-orange"><?php echo get_comments_number($staff_picked_project)." Comments"; ?></a>
								<span class="sep">|</span>
								<a href="#" class="fc-gray be-fc-orange">378 views</a>
							</p>
						</div>
					</div><!--end: .top-project-info -->
					<div class="bottom-project-info clearfix">
						<div class="project-progress sys_circle_progress" data-percent="76">
							<div class="sys_holder_sector"></div>
						</div>
						<div class="group-fee clearfix">
							<div class="fee-item">
								<p class="rs lbl">Backers</p>
								<span class="val">270</span>
							</div>
							<div class="sep"></div>
							<div class="fee-item">
								<p class="rs lbl">Pledged</p>
								<span class="val">$38,000</span>
							</div>
							<div class="sep"></div>
							<div class="fee-item">
								<p class="rs lbl">Days Left</p>
								<span class="val"><?php echo get_days_left($staff_picked_project->ID); ?></span>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
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
			?>
				<div class="grid_3">
					<div class="project-short sml-thumb">
						<div class="top-project-info">
							<div class="content-info-short clearfix">
								<a href="<?php the_permalink(); ?>" class="thumb-img">
									<?php the_post_thumbnail('full'); ?>
								</a>
								<div class="wrap-short-detail">
									<h3 class="rs acticle-title"><a class="be-fc-orange" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<p class="rs tiny-desc">by <a href="<?php echo get_author_posts_url(); ?>" class="fw-b fc-gray be-fc-orange"><?php the_author(); ?></a></p>
									<p class="rs title-description"><?php echo wp_trim_words(get_the_content(),25); ?></p>
									<p class="rs project-location">
										<i class="icon iLocation"></i>
										<?php the_field('location'); ?>
									</p>
								</div>
							</div>
						</div>
						<div class="bottom-project-info clearfix">
							<div class="line-progress">
								<div class="bg-progress">
									<span  style="width: 50%"></span>
								</div>
							</div>
							<div class="group-fee clearfix">
								<div class="fee-item">
									<p class="rs lbl">Funded</p>
									<span class="val">50%</span>
								</div>
								<div class="sep"></div>
								<div class="fee-item">
									<p class="rs lbl">Pledged</p>
									<span class="val">$38,000</span>
								</div>
								<div class="sep"></div>
								<div class="fee-item">
									<p class="rs lbl">Days Left</p>
									<span class="val"><?php echo get_days_left(get_the_ID()); ?></span>
								</div>
							</div>
						</div>
					</div>
				</div><!--end: .grid_3 > .project-short-->
				<?php
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