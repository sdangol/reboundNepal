<?php
	get_header();
	$current_term = get_queried_object();
?>
<div class="layout-2cols">
	<div class="content grid_9">
			<div class="search-result-page">
					<div class="top-lbl-val">
							<h3 class="common-title"><span class="fc-orange"><?php single_term_title(); ?></span></h3>
							<div class="count-result">
									<span class="fw-b fc-black"><?php echo $current_term->count ?></span> projects found in this category
							</div>
					</div>
					<div class="list-project-in-category">
						<div id="list-project-ajax" class="list-project">
					<?php
						if (have_posts()):
							$i = 1;
							while (have_posts()):
								the_post();
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
								if ($i%3 == 0) echo "<div class='clear'></div>";
								$i++;
							endwhile;
						else:
						?>
							<h2>No projects found in this category.</h2>
			<?php endif; ?>
						</div>
					</div><!--end: .list-project-in-category -->
					<div class='clear'></div>
					<div class="rs ta-c pagination">
						<div class="nav-next alignright"><?php next_posts_link( 'Next' ); ?></div>
						<div class="nav-prev alignleft"><?php previous_posts_link( 'Prev' ); ?></div>
						<!-- <a id="showmoreproject" class="btn btn-black btn-load-more" href="#">Show more projects</a> -->
					</div>
			</div><!--end: .search-result-page -->
	</div><!--end: .content -->
	<?php get_sidebar(); ?>
	<div class="clear"></div>
</div>
<?php
	get_footer();