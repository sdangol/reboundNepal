<?php
	get_header();
	while (have_posts()):
		the_post();
?>
<div class="layout-2cols">
	<div class="content grid_8">
			<div class="project-detail">
					<h2 class="rs project-title"><?php the_title(); ?></h2>
					<p class="rs post-by">by <?php the_author_posts_link(); ?></p>
					<div class="project-short big-thumb">
							<div class="top-project-info">
									<div class="content-info-short clearfix">
											<div class="thumb-img">
													<div class="rslides_container">
														<ul class="rslides" id="slider1">
															<li><?php the_post_thumbnail('full'); ?></li>
															<?php
																$slides = get_field('images');
																foreach ($slides as $slide) {
															?>
															<li><img src="<?php echo $slide['image']['url'] ?>" alt="<?php echo $slide['image']['alt'] ?>"></li>
															<?php } ?>
														</ul>
													</div>
											</div>
									</div>
							</div><!--end: .top-project-info -->
							<?php get_template_part('template-parts/content','project-info'); ?>
					</div>
					<div class="project-tab-detail tabbable accordion">
							<ul class="nav nav-tabs clearfix">
								<li class="active"><a href="#">About</a></li>
								<li><a href="#" class="be-fc-orange">Backers (<?php echo get_project_backers(get_the_ID()); ?>)</a></li>
								<li><a href="#" class="be-fc-orange">Comments (<?php echo get_comments_number(); ?>)</a></li>
							</ul>
							<div class="tab-content">
									<div>
											<h3 class="rs alternate-tab accordion-label">About</h3>
											<div class="tab-pane active accordion-content">
													<div class="editor-content">
															<h3 class="rs title-inside"><?php the_title(); ?></h3>
															<p class="rs post-by">by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="fw-b fc-gray be-fc-orange"><?php the_author(); ?></a> in <span class="fw-b fc-gray"><?php the_field('location'); ?></span></p>
															<?php the_content(); ?>
													</div>
											</div><!--end: .tab-pane(About) -->
									</div>
									<div>
										<?php
											$backers = get_project_backers(get_the_ID(),'all');
										?>
											<h3 class="rs alternate-tab accordion-label">Backers (<?php echo count($backers); ?>)</h3>
											<div class="tab-pane accordion-content">
													<div class="tab-pane-inside">
														<?php if (!empty($backers)): ?>
															<?php foreach ($backers as $backer): ?>
																<div class="project-author pb20">
																		<div class="media">
																			<a href="#" class="thumb-left">
																				<?php if ($backer['user_type'] == 'visitor'): ?>
																					<img src="<?php echo get_template_directory_uri().'/images/no-avatar.png'; ?>"/>
																				<?php else: ?>
																						<?php echo get_avatar($backer['email']); ?>
																				<?php endif; ?>
																			</a>
																				<div class="media-body">
																						<h4 class="rs pb10"><a href="#" class="be-fc-orange fw-b"><?php echo $backer['full_name']; ?></a></h4>
																						<p class="rs"><?php echo $backer['address'] ?></p>
																						<p class="rs fc-gray">Pledged <?php echo $backer['pledged_amount'] ?></p>
																				</div>
																		</div>
																</div><!--end: .project-author -->
															<?php endforeach; ?>
														<?php else: ?>
															<h4>No backers yet</h4>
														<?php endif; ?>
													</div>
													<div class="project-btn-action">
															<a class="btn btn-red" href="mailto:<?php echo get_the_author_meta('user_email'); ?>">Ask a question</a>
															<!-- <a class="btn btn-black" href="#">Report this project</a> -->
													</div>
											</div><!--end: .tab-pane(Backers) -->
									</div>
									<div>
										<h3 class="rs alternate-tab accordion-label">Comments (<?php comments_number(); ?>)</h3>
										<?php
										// If comments are open or we have at least one comment, load up the comment template.
										if ( comments_open() || get_comments_number() ) :
											comments_template();
										else:
										?>
											<h4>No comments have been posted yet.</h4>
										<?php endif; ?>
									</div>
							</div>
					</div><!--end: .project-tab-detail -->
			</div>
	</div><!--end: .content -->
	<div class="sidebar grid_4">
			<div class="project-runtime">
					<div class="box-gray">
							<div class="project-date clearfix">
									<i class="icon iCalendar"></i>
									<span class="val"><span class="fw-b">Launched: </span><?php echo date('M d,Y',strtotime(get_field('launch_date'))); ?></span>
							</div>
							<div class="project-date clearfix">
									<i class="icon iClock"></i>
									<span class="val"><span class="fw-b">Funding ends: </span><?php echo date('M d,Y',strtotime(get_field('funding_end_date'))); ?></span>
							</div>
							<a class="btn btn-green btn-buck-project" href="<?php echo $_SERVER['REQUEST_URI']."?action=pledge"; ?>">
									<span class="lbl">Back This Project</span>
									<span class="desc"><?php echo get_selected_currency_amount(get_the_ID(),'minimum_pledge_amount'); ?> minimum pledge</span>
							</a>
							<p class="rs description">This project will only be funded if at least <?php echo get_selected_currency_amount(get_the_ID(),'stretch_target'); ?> is pledged by <?php echo date('l M d,Y',strtotime(get_field('funding_end_date'))); ?>.</p>
					</div>
			</div><!--end: .project-runtime -->
			<?php if (is_user_logged_in() && get_the_author_meta('ID') == get_current_user_id()): ?>
				<div class="edit-project">
					<a class="btn btn-red" href="<?php echo add_query_arg('proj',get_the_ID(),site_url('/edit-project/')); ?>">Edit this project</a>
					<form action="<?php echo admin_url('admin-post.php?action=deleteProject') ?>" method="POST" class="delete-form">
						<a class="btn btn-black trash-btn" href="#">Delete this project</a>
						<input type="hidden" name="project_id" value="<?php the_ID(); ?>">
					</form>
				</div>
			<?php endif; ?>
			<div class="project-author">
					<div class="box-gray">
							<h3 class="title-box">Project by</h3>
							<div class="media">
									<a href="#" class="thumb-left">
										<?php echo get_avatar(get_the_author_meta('ID')); ?>
									</a>
									<div class="media-body">
											<h4 class="rs pb10"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="be-fc-orange fw-b"><?php the_author(); ?></a></h4>
											<p class="rs">Kathmandu, Nepal</p>
											<p class="rs fc-gray"><?php echo count_user_posts(get_the_author_meta('ID'),'project') ?> projects</p>
									</div>
							</div>
							<div class="author-action">
									<a class="btn btn-red" href="mailto:<?php echo get_the_author_meta('email'); ?>">Contact me</a>
									<a class="btn btn-white" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">See full bio</a>
							</div>
					</div>
			</div><!--end: .project-author -->
			<!-- Social Share -->
			<div class="social-share">
					<div class="box-gray">
						<h3 class="title-box">Share this project</h3>
						<?php echo do_shortcode('[apss_share]'); ?>	
					</div>
			</div><!--end: social share -->
			<div class="clear clear-2col"></div>
	</div><!--end: .sidebar -->
	<div class="clear"></div>
</div>
<script>
	$(function(){
		$('.trash-btn').on('click',function(e){
			e.preventDefault();
			var conf = window.confirm('Are you sure you want to delete this project?');
			if (conf){
				alert('Project Deleted');
				$(this).closest('form').submit();
			}
		})
	})
</script>
<?php
	endwhile;
	get_footer();