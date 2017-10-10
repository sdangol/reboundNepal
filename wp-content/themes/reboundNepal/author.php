<?php
	get_header();
	$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
	// set the "paged" parameter (use 'page' if the query is on a static front page)
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
?>
<div class="layout-2cols">
	<div class="content grid_8">
			<div class="project-detail">
					<div class="project-tab-detail tabbable accordion">
							<ul class="nav nav-tabs clearfix">
								<li class="active"><a href="#" class="be-fc-orange">Projects</a></li>
								<?php if (is_user_logged_in() && get_current_user_id() == $curauth->ID): ?>
								<li><a href="#">Profile</a></li>
								<li><a href="#" class="be-fc-orange">Account Settings</a></li>
								<?php endif; ?>
							</ul>
							<div class="tab-content">
								<div>
											<h3 class="rs alternate-tab accordion-label">Projects</h3>
											<div class="tab-pane accordion-content active">
												<?php
													if (have_posts()):
														while (have_posts()):
															the_post();
															get_template_part('template-parts/content','author-project');
														endwhile;
												?>
												<div class="rs ta-c pagination">
													<div class="nav-next alignright"><?php next_posts_link( 'Next' ); ?></div>
													<div class="nav-prev alignleft"><?php previous_posts_link( 'Prev' ); ?></div>
												</div>
												<?php	else: ?>
													<h3>No projects initiated</h3>
												<?php endif; ?>
												<?php wp_reset_postdata(); ?>
											</div><!--end: .tab-pane -->
								</div>
								<?php if (is_user_logged_in() && get_current_user_id() == $curauth->ID): ?>
								<div>
										<h3 class="rs alternate-tab accordion-label">Profile</h3>
										<div class="tab-pane accordion-content">
												<div class="form form-profile">
														<form action="<?php echo admin_url('admin-ajax.php?action=editprofile') ?>" class="ajax-form" enctype="multipart/form-data">
																<div class="alert-msg">
																	
																</div>
																<div class="row-item clearfix">
																		<label class="lbl" for="txt_first">First Name*:</label>
																		<div class="val">
																				<input class="txt" type="text" id="txt_first" value="<?php echo get_user_meta($curauth->ID,'first_name',true); ?>" name="first_name">
																		</div>
																</div>
																<div class="row-item clearfix">
																		<label class="lbl" for="txt_last">Last Name*:</label>
																		<div class="val">
																				<input class="txt" type="text" id="txt_last" value="<?php echo get_user_meta($curauth->ID,'last_name',true); ?>" name="last_name">
																		</div>
																</div>
																<div class="row-item clearfix">
																		<label class="lbl" for="txt_email">Email*:</label>
																		<div class="val">
																				<input class="txt" type="email" id="txt_email" value="<?php echo $curauth->user_email; ?>" name="email">
																		</div>
																</div>
																<div class="row-item clearfix">
																		<label class="lbl" for="txt_location">Address*:</label>
																		<div class="val">
																				<input class="txt" type="text" id="txt_location" value="<?php echo get_user_meta($curauth->ID,'address',true); ?>" name="address">
																		</div>
																</div>
																<div class="row-item clearfix">
																		<label class="lbl" for="txt_time_zone">Contact*:</label>
																		<div class="val">
																				<input class="txt" type="text" id="txt_time_zone" value="<?php echo get_user_meta($curauth->ID,'phone',true); ?>" name="phone">
																		</div>
																</div>
																<div class="row-item clearfix">
																		<label class="lbl" for="user_image">Upload Profile Picture:</label>
																		<div class="val">
																			<input class="" type="file" id="user_image" name="user_image">
																		</div>
																</div>
																<div class="row-item clearfix">
																		<label class="lbl" for="txt_bio">Biography:</label>
																		<div class="val">
																				<textarea class="txt fill-width" id="txt_bio" cols="30" rows="10" name="biography"><?php echo get_user_meta($curauth->ID,'description',true); ?></textarea>
																				<p class="rs description-input">We suggest a short bio. If it’s 300 characters or less it’ll look great on your profile.</p>
																		</div>
																</div>
																<p class="wrap-btn-submit rs ta-r">
																		<button class="btn btn-red btn-submit-all">Update Profile</button>
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
													<div class="form form-profile">
														<form action="<?php echo admin_url('admin-ajax.php?action=change_password') ?>" class="ajax-form">
															<div class="alert-msg">
															</div>
															<div class="row-item clearfix">
																	<label class="lbl" for="txt_name1">Old Password*:</label>
																	<div class="val">
																			<input class="txt" type="password" id="txt_name1" value="" name="old_password">
																	</div>
															</div>
															<div class="row-item clearfix">
																<label class="lbl" for="txt_name1">New Password*:</label>
																<div class="val">
																	<input class="txt" type="password" id="txt_name1" value="" name="new_password">
																</div>
															</div>
															<div class="row-item clearfix">
																	<label class="lbl" for="txt_name1">Confirm Password*:</label>
																	<div class="val">
																			<input class="txt" type="password" id="txt_name1" value="" name="password_confirm">
																	</div>
															</div>
															<p class="wrap-btn-submit rs ta-r">
																<button class="btn btn-red btn-submit-all">Change Password</button>
															</p>
														</form>
													</div>
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