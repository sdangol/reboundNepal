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
	                          <p class="rs ta-c donate-options">
	                          	<!-- <a class="btn big btn-red btn-back-project" href="#">Esewa</a> -->
	                          	<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" class="text-center">
																<p class="rs ta-c form">
																	$<input type="number" name="amount" class="txt" value="10">
																</p>
																<input type="hidden" name="cmd" value="_donations">
																<input type="hidden" name="business" value="merchant@dangol.com">
																<input type="hidden" name="lc" value="US">
																<input type="hidden" name="item_name" value="Rebound Nepal">
																<input type="hidden" name="currency_code" value="USD">
																<input type="hidden" name="no_note" value="0">
																<input type="hidden" name="cn" value="Add special instructions to the seller:">
																<input type="hidden" name="no_shipping" value="2">
																<input type="hidden" name="rm" value="1">
																<input type="hidden" name="return" value="<?php echo site_url('thank-you'); ?>">
																<input type="hidden" name="cancel_return" value="<?php echo site_url('donation-cancelled'); ?>">
																<input type="hidden" name="notify_url" value="<?php echo site_url('?AngellEYE_Paypal_Ipn_For_Wordpress&action=ipn_handler'); ?>">
																<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHosted">
																<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
																<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
															</form>
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
	                          <p class="rs fw-thin pb20">Ships within <?php the_sub_field('ships_to'); ?></p>
	                          <p class="rs ta-c donate-options">
	                          	<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" class="text-center paypal-form">
																<p class="rs ta-c form">
																	$<input type="number" name="amount" class="txt" value="10">
																</p>
																<input type="hidden" name="cmd" value="_donations">
																<input type="hidden" name="business" value="6HBYSAURPWP4W">
																<input type="hidden" name="lc" value="US">
																<input type="hidden" name="item_name" value="Rebound Nepal">
																<input type="hidden" name="currency_code" value="USD">
																<input type="hidden" name="no_note" value="0">
																<input type="hidden" name="cn" value="Add special instructions to the seller:">
																<input type="hidden" name="no_shipping" value="2">
																<input type="hidden" name="rm" value="1">
																<input type="hidden" name="return" value="<?php site_url('thank-you'); ?>">
																<input type="hidden" name="cancel_return" value="<?php site_url('donation-cancelled'); ?>">
																<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHosted">
																<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
																<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
															</form>
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