<?php
	get_header();
?>
<div class="layout-2cols">
	<div class="content grid_9">
			<div class="search-result-page">
					<div class="top-lbl-val">
							<h3 class="common-title"><span class="fc-orange">Search Results</span></h3>
					</div>
					<div class="list-project-in-category">
						<div id="list-project-ajax" class="list-project">
					<?php
						if (have_posts()):
							$i = 1;
							while (have_posts()):
								the_post();
								get_template_part('template-parts/content','project');
								if ($i%3 == 0) echo "<div class='clear'></div>";
								$i++;
							endwhile;
						else:
						?>
							<h2>No projects found.</h2>
			<?php endif; ?>
						</div>
					</div><!--end: .list-project-in-category -->
					<div class='clear'></div>
					<div class="rs ta-c pagination">
						<div class="nav-next alignright"><?php next_posts_link( 'Next' ); ?></div>
						<div class="nav-prev alignleft"><?php previous_posts_link( 'Prev' ); ?></div>
					</div>
			</div><!--end: .search-result-page -->
	</div><!--end: .content -->
	<?php get_sidebar(); ?>
	<div class="clear"></div>
</div>
<?php
	get_footer();