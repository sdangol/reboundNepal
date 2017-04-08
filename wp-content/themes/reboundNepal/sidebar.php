<div class="sidebar grid_3">
	<div class="left-list-category">
			<h4 class="rs title-nav">Featured</h4>
			<ul class="rs nav nav-category">
			<?php
				$featured_cats = get_terms(['taxonomy' => 'featured-category',
																		'hide_empty' => false]);
				foreach ($featured_cats as $featured) {
			?>
					<li class="<?php if ($featured->term_id == $current_term->term_id) echo 'active'; ?>">
							<a href="<?php echo get_term_link($featured); ?>">
									<?php echo $featured->name; ?>
									<span class="count-val">(<?php echo $featured->count; ?>)</span>
									<i class="icon iPlugGray"></i>
							</a>
					</li>
	<?php } ?>
			</ul>
	</div><!--end: .left-list-category -->
	<div class="left-list-category">
			<h4 class="rs title-nav">Category</h4>
			<ul class="rs nav nav-category">
			<?php
				$categories = get_terms(['taxonomy' => 'project-category',
											'hide_empty' => false]);
				foreach ($categories as $category) {
			?>
					<li class="<?php if ($category->term_id == $current_term->term_id) echo 'active'; ?>">
							<a href="<?php echo get_term_link($category); ?>">
									<?php echo $category->name; ?>
									<span class="count-val">(<?php echo $category->count; ?>)</span>
									<i class="icon iPlugGray"></i>
							</a>
					</li>
	<?php } ?>
			</ul>
	</div><!--end: .left-list-category -->
</div><!--end: .sidebar -->