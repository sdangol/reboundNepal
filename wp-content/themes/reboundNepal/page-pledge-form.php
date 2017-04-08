<?php
get_header();
	while(have_posts()):
		the_post();
?>
<div class="container_12">
	<div class="how-it-work">
		<div class="grid_12 short-introduce">
			<h2 class="rs title"><span class="fc-black"><?php the_title(); ?></span></h2>
			<h2>Back this project</h2>
			<div class="box-introduce">
				<div class="wrap-nav-pledge">
	          <ul class="rs nav nav-pledge accordion">
	              <li>
	                  <div class=" pledge-label accordion-label clearfix active">
	                      <i class="icon iPlugGray"></i>
	                      <span class="pledge-amount">Pledge without reward</span>
	                  </div>
	                  <div class=" pledge-content accordion-content active">
	                      <div class="pledge-detail">
			                      <p class="rs pledge-description">Please enter amount you want to pledge.</p>
	                          <p class="rs ta-c form">
	                          	$ <input class="txt" type="number" value="10">
	                          	<a class="btn big btn-red btn-back-project" href="#">Back this project</a>
	                          </p>
	                          <p class="rs ta-c donate-options" style="display: none">
	                          	<a class="btn big btn-red btn-back-project" href="#">Esewa</a>
	                          	<a class="btn big btn-red btn-back-project" href="#">Paypal </a>
	                          </p>
	                      </div>
	                  </div>
	              </li><!--end: pledge-item -->
	              <?php
	              	if( have_rows('pledge_rewards') ):
	              	while( have_rows('pledge_rewards') ): the_row();
	              ?>
	              <li>
	                  <div class=" pledge-label accordion-label clearfix">
	                      <i class="icon iPlugGray"></i>
	                      <span class="pledge-amount">Pledge $<?php the_sub_field('pledge_amount'); ?> or more</span>
	                  </div>
	                  <div class=" pledge-content accordion-content">
	                      <div class="pledge-detail">
	                          <p class="rs pledge-description"><?php the_sub_field('reward_description'); ?></p>
	                          <p class="rs"><span class="fw-b">Estimated delivery:</span> <?php echo date('M Y',get_sub_field('estimated_delivery')); ?></p>
	                          <p class="rs fw-thin fc-gray pb20">Ships within <?php the_sub_field('ships_to'); ?></p>
	                          <p class="rs ta-c form">
	                          	$ <input class="txt" type="number" value="10">
	                          	<a class="btn big btn-red btn-back-project" href="#">Back this project</a>
	                          </p>
	                          <p class="rs ta-c donate-options" style="display: none">
	                          	<a class="btn big btn-red btn-back-project" href="#">Esewa</a>
	                          	<a class="btn big btn-red btn-back-project" href="#">Paypal </a>
	                          </p>
	                      </div>
	                  </div>
	              </li><!--end: pledge-item -->
	            <?php endwhile; endif; ?>
	          </ul>
	      </div><!--end: .wrap-nav-pledge -->
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
	endwhile;
	get_footer();
?>