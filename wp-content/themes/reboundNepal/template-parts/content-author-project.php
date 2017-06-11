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
	<?php get_template_part('template-parts/content','project-info'); ?>
</div><!--end: .box-marked-project -->