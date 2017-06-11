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
											get_template_part('template-parts/content','project');
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