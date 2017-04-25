<?php
	get_header();
	$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
	// set the "paged" parameter (use 'page' if the query is on a static front page)
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	var_dump($paged);
?>
<div class="layout-2cols">
	<div class="content grid_8">
			<div class="project-detail">
					<div class="project-tab-detail tabbable accordion">
							<ul class="nav nav-tabs clearfix">
								<li class="active"><a href="#" class="be-fc-orange">Projects</a></li>
								<?php if (is_user_logged_in()): ?>
								<li><a href="#">Profile</a></li>
								<li><a href="#" class="be-fc-orange">Account Settings</a></li>
								<?php endif; ?>
							</ul>
							<div class="tab-content">
								<div>
											<h3 class="rs alternate-tab accordion-label">Projects</h3>
											<div class="tab-pane accordion-content active">
												<?php
													$projects = new WP_Query(['author' => $curauth->ID,
																										'post_type' => 'project',
																										'posts_per_page' => 2,
																										'paged' => $paged]);
													if ($projects->have_posts()):
														while ($projects->have_posts()):
															$projects->the_post();
												?>
													<div class="box-marked-project project-short inside-tab">
															<div class="top-project-info">
																	<div class="content-info-short clearfix">
																			<a href="<?php the_permalink(); ?>" class="thumb-img">
																				<?php the_post_thumbnail('full'); ?>
																			</a>
																			<div class="wrap-short-detail">
																					<h3 class="rs acticle-title"><a class="be-fc-orange" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
																					<p class="rs tiny-desc">by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="fw-b fc-gray be-fc-orange"><?php the_author(); ?></a> in <span class="fw-b fc-gray"><?php the_field('location'); ?></span></p>
																					<p class="rs title-description"><?php echo wp_trim_words(get_the_content(),25); ?></p>
																			</div>
																			<p class="rs clearfix comment-view">
																					<a href="#" class="fc-gray be-fc-orange"><?php echo get_comments_number(get_the_ID())." Comments"; ?></a>
																					<span class="sep">|</span>
																					<a href="#" class="fc-gray be-fc-orange">378 views</a>
																			</p>
																	</div>
															</div><!--end: .top-project-info -->
															<div class="bottom-project-info clearfix">
																	<div class="project-progress sys_circle_progress" data-percent="33">
																			<div class="sys_holder_sector"></div>
																	</div>
																	<div class="group-fee clearfix">
																			<div class="fee-item">
																					<p class="rs lbl">Bankers</p>
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
																					<span class="val"><?php echo get_days_left(get_the_ID()); ?></span>
																			</div>
																	</div>
																	<div class="clear"></div>
															</div>
													</div><!--end: .box-marked-project -->
												<?php endwhile; ?>
												<div class="rs ta-c pagination">
													<div class="nav-next alignright"><?php next_posts_link( 'Next', $projects->max_num_pages ); ?></div>
													<div class="nav-prev alignleft"><?php previous_posts_link( 'Prev' ); ?></div>
												</div>
												<?php	else: ?>
													<h3>No projects initiated</h3>
												<?php endif; ?>
												<?php wp_reset_postdata(); ?>
											</div><!--end: .tab-pane -->
								</div>
								<?php if (is_user_logged_in()): ?>
								<div>
										<h3 class="rs alternate-tab accordion-label">Profile</h3>
										<div class="tab-pane accordion-content">
												<div class="form form-profile">
														<form action="<?php echo admin_url('admin-ajax.php?action=editprofile') ?>">
																<div class="row-item clearfix">
																		<label class="lbl" for="txt_name1">First Name:</label>
																		<div class="val">
																				<input class="txt" type="text" id="txt_name1" value="" name="first_name">
																		</div>
																</div>
																<div class="row-item clearfix">
																		<label class="lbl" for="txt_name1">Last Name:</label>
																		<div class="val">
																				<input class="txt" type="text" id="txt_name1" value="" name="last_name">
																		</div>
																</div>
																<div class="row-item clearfix">
																		<label class="lbl" for="txt_location">Address:</label>
																		<div class="val">
																				<input class="txt" type="text" id="txt_location" value="" name="address">
																		</div>
																</div>
																<div class="row-item clearfix">
																		<label class="lbl" for="txt_time_zone">Contact:</label>
																		<div class="val">
																				<input class="txt" type="text" id="txt_time_zone" value="" name="phone">
																		</div>
																</div>
																<div class="row-item clearfix">
																		<label class="lbl" for="txt_bio">Biography:</label>
																		<div class="val">
																				<textarea class="txt fill-width" name="txt_bio" id="txt_bio" cols="30" rows="10" name="biography"></textarea>
																				<p class="rs description-input">We suggest a short bio. If it’s 300 characters or less it’ll look great on your profile.</p>
																		</div>
																</div>
																<p class="wrap-btn-submit rs ta-r">
																		<button class="btn btn-red btn-submit-all">Save all settings</button>
																</p>
														</form>
												</div>
										</div><!--end: .tab-pane -->
								</div>
								<div>
										<h3 class="rs alternate-tab accordion-label">Account</h3>
										<div class="tab-pane accordion-content">
												<div class="tab-pane-inside">
												<!-- Password change settings-->
												</div>
										</div><!--end: .tab-pane -->
								</div>
							<?php endif; ?>
							</div>
					</div><!--end: .project-tab-detail -->
			</div>
	</div><!--end: .content -->
	<div class="sidebar grid_4">
			<div class="box-gray project-author">
					<h3 class="title-box">Member Details</h3>
					<div class="media">
						<a href="#" class="thumb-left">
							<?php echo get_avatar($curauth->ID); ?>
						</a>
						<div class="media-body">
							<h4 class="rs pb10"><a href="<?php echo get_author_posts_url($curauth->ID); ?>" class="be-fc-orange fw-b"><?php echo $curauth->display_name; ?></a></h4>
							<p class="rs"><?php echo get_user_meta($curauth->ID,'address',true); ?></p>
							<p class="rs fc-gray"><?php echo count_user_posts($curauth->ID,'project'); ?> projects</p>
							<p class="rs"><?php echo get_user_meta($curauth->ID,'phone',true); ?></p>
						</div>
					</div>
					<div>
						<p><?php the_author_meta('description',$curauth->ID); ?></p>
					</div>
			</div><!--end: .project-author -->
	</div><!--end: .sidebar -->
	<div class="clear"></div>
</div>
<?php
	get_footer();