<?php
/**
 * Template Name: Start Project
 */
if (is_user_logged_in()):
	if (isset($_GET['proj']) && is_numeric($_GET['proj'])){
		$post_id = intval($_GET['proj']);
		$cur_post = get_post($post_id);
		if ($cur_post->post_author != get_current_user_id()){
			wp_redirect(site_url());
			die;
		}
		$cur_post_terms = wp_get_post_terms($post_id,'project-category',array('fields' => 'slugs'));
		$submit_msg = 'Update Project';
	}else{
		$post_id = 'new';
		$submit_msg = 'Start Project';
	}
	acf_form_head();
	get_header();
?>
<div class="layout-2cols">
	<div class="content grid_12">
			<div class="project-detail">
					<div class="project-tab-detail tabbable accordion">
							<ul class="nav nav-tabs clearfix">
								<li class="active"><a href="#" class="be-fc-orange">Project Details</a></li>
							</ul>
							<div class="tab-content">
								<div>
										<h3 class="rs alternate-tab accordion-label">Please fill up the following details</h3>
										<div class="tab-pane accordion-content active">
												<div class="form form-profile">
													<form id="post" class="acf-form" action="" method="post">
														<div class="acf_postbox no_box">
															<div class="inside">
																<div class="field field_type-text">
																	<p class="label">
																		<label for="">Title</label>
																	</p>
																	<div class="acf-input-wrap">
																		<input type="text" class="text" name="title" value="<?php echo (isset($cur_post))?$cur_post->post_title:''; ?>" placeholder="">
																	</div>
																</div>
																<div class="field">
																	<p class="label">
																		<label for="">Description</label>
																	</p>
																	<div class="acf-input-wrap">
																		<?php wp_editor((isset($cur_post))?$cur_post->post_content:'','description'); ?>
																	</div>
																</div>
																<div class="field">
																	<p class="label">
																		<label for="">Featured Image</label>
																	</p>
																	<div class="acf-image-uploader clearfix <?php echo (isset($cur_post))?'active':''; ?>" data-preview_size="thumbnail" data-library="all">
																		<input class="acf-image-value" type="hidden" name="feature-image" value="<?php echo (isset($cur_post))?get_post_thumbnail_id($cur_post):''; ?>">
																		<div class="has-image">
																			<div class="hover">
																				<ul class="bl">
																					<li><a class="acf-button-delete ir" href="#">Remove</a></li>
																					<li><a class="acf-button-edit ir" href="#">Edit</a></li>
																				</ul>
																			</div>
																			<img class="acf-image-image" src="<?php echo (isset($cur_post))?get_the_post_thumbnail_url($cur_post):''; ?>" alt="">
																		</div>
																		<div class="no-image">
																			<p>No image selected <input type="button" class="button add-image" value="Select Image"></p>
																		</div>
																	</div>
																</div>
																<div class="field inline-checkboxes">
																	<p class="label">
																		<label for="">Category</label>
																	</p>
																	<?php
																		$terms = get_terms(['taxonomy' => 'project-category',
																												'hide_empty' => false]);
																		foreach($terms as $term):
																	?>
																		<label class="checkbox-label">
																			<input type="checkbox" name="category[]" value="<?php echo $term->slug; ?>" <?php if (isset($cur_post_terms) && in_array($term->slug,$cur_post_terms)) echo "checked"; ?>><?php echo $term->name; ?>
																		</label>
																	<?php endforeach; ?>
																</div>
															</div>
														</div>
														<?php
															acf_form(['post_id' => $post_id,
																				'field_groups' => [23],
																				'form' => false,
																				'submit_value' => 'Start Project',
																				'updated_message' => false]);
														?>
														<button type="submit" class="acf-button"><?php echo $submit_msg; ?></button>
													</form>
												</div>
										</div><!--end: .tab-pane -->
								</div>
							</div>
					</div><!--end: .project-tab-detail -->
			</div>
	</div><!--end: .content -->
	<div class="clear"></div>
</div>
<?php
	get_footer();
else:
	wp_redirect(site_url('?auth=required&redirect=start-project'));
	die;
endif;