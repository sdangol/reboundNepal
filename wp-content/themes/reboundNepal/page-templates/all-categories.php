<?php
/**
 * Template Name: All Category
 */
	get_header();
	global $post;
	if ($post->post_name == 'all-project-categories'){
		$categories = get_terms(['taxonomy' => 'project-category',
														'hide_empty' => false]);
	}
	elseif ($post->post_name == 'all-featured-categories'){
		$categories = get_terms(['taxonomy' => 'featured-category',
														'hide_empty' => false]);
	}
?>
<div class="layout-2cols">
	<div class="content grid_9">
			<div class="search-result-page">
			<?php foreach ($categories as $category): ?>
					<div class="list-project-in-category">
							<div class="lbl-type clearfix">
									<h4 class="rs title-lbl"><a href="<?php echo get_term_link($category) ?>" class="be-fc-orange"><?php echo $category->name ?></a></h4>
									<a href="<?php echo get_term_link($category) ?>" class="view-all be-fc-orange">View all</a>
							</div>
							<div class="list-project">
								<?php
									$projects = new WP_Query(['post_type' => 'project',
																						'tax_query' => [['taxonomy' => $category->taxonomy,
																														'terms' => $category->term_id]],
																							'posts_per_page' => 3]);
									if ($projects->have_posts()):
										while ($projects->have_posts()) :
											$projects->the_post();
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
																			<p class="rs tiny-desc">by <a href="<?php get_author_posts_url(get_the_author_meta('ID')) ?>" class="fw-b fc-gray be-fc-orange"><?php the_author(); ?></a></p>
																			<p class="rs title-description"><?php echo wp_trim_words(get_the_content(),25); ?></p>
																			<p class="rs project-location">
																					<i class="icon iLocation"></i>
																					<?php the_field('location') ?>
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
															<div class="clear"></div>
													</div>
											</div>
									</div><!--end: .grid_3 > .project-short-->
								<?php
										endwhile;
									else:
								?>
									<h3>No projects found in this category</h3>
						<?php endif; ?>
									<div class="clear"></div>
							</div>
					</div><!--end: .list-project-in-category -->
			<?php endforeach; ?>
			</div><!--end: .search-result-page -->
	</div><!--end: .content -->
	<?php get_sidebar(); ?>
	<div class="clear"></div>
</div>
<?php
	get_footer();