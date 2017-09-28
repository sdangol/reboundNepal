<div class="bottom-project-info clearfix">
	<div class="project-progress sys_circle_progress" data-percent="<?php echo get_project_completed_percentage(get_the_ID()); ?>">
			<div class="sys_holder_sector"></div>
	</div>
	<div class="group-fee clearfix">
			<div class="fee-item">
					<p class="rs lbl">Backers</p>
					<span class="val"><?php echo get_project_backers(get_the_ID()); ?></span>
			</div>
			<div class="sep"></div>
			<div class="fee-item">
					<p class="rs lbl">Pledged</p>
					<span class="val"><?php echo get_selected_currency_sign(get_the_ID()); ?> <?php echo get_project_funded_amount(get_the_ID()) ?></span>
			</div>
			<div class="sep"></div>
			<div class="fee-item">
					<p class="rs lbl">Days Left</p>
					<span class="val"><?php echo (get_days_left(get_the_ID())<0)?"Expired":get_days_left(get_the_ID()); ?></span>
			</div>
	</div>
	<div class="clear"></div>
</div>