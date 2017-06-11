<div class="grid_3">
	<div class="project-short sml-thumb">
		<div class="top-project-info">
			<div class="content-info-short clearfix">
				<a href="<?php the_permalink(); ?>" class="thumb-img">
					<?php the_post_thumbnail('full'); ?>
				</a>
				<div class="wrap-short-detail">
					<h3 class="rs acticle-title"><a class="be-fc-orange" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p class="rs tiny-desc">by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="fw-b fc-gray be-fc-orange"><?php the_author(); ?></a></p>
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
					<span  style="width: <?php echo get_project_completed_percentage(get_the_ID()); ?>%"></span>
				</div>
			</div>
			<div class="group-fee clearfix">
				<div class="fee-item">
					<p class="rs lbl">Funded</p>
					<span class="val"><?php echo get_project_completed_percentage(get_the_ID()); ?>%</span>
				</div>
				<div class="sep"></div>
				<div class="fee-item">
					<p class="rs lbl">Pledged</p>
					<span class="val">$<?php echo get_project_funded_amount(get_the_ID()) ?></span>
				</div>
				<div class="sep"></div>
				<div class="fee-item">
					<p class="rs lbl">Days Left</p>
					<span class="val"><?php echo (get_days_left(get_the_ID())<0)?"Expired":get_days_left(get_the_ID()); ?></span>
				</div>
			</div>
		</div>
	</div>
</div><!--end: .grid_3 > .project-short-->