<div class="layout-2cols">
  <div class="content grid_12">
      <div class="single-page">
          <div class="wrapper-box box-post-comment">
              <h2 class="common-title">Please fill up the following details</h2>
              <div class="box-white">
                  <form id="pledge-form" class="clearfix ajax-form" action="<?php echo admin_url('admin-ajax.php?action=register_visitor_pledge') ?>" method="post">
                      <p class="rs pb30">Become a member and save yourself from filling up your info everytime.</p>
                      <div class="alert-msg" style="display:none;">
                        <!-- Alert message is shown here -->
                      </div>
                      <div class="form form-post-comment">
                          <div class="left-input">
                              <label for="txt_name_contact">
                                  <input id="txt_name_contact" type="text" name="full_name" class="txt fill-width txt-name" placeholder="Enter Your Full Name"/>
                              </label>
                              <label for="txt_email_contact">
                                  <input id="txt_email_contact" type="email" name="email" class="txt fill-width txt-email" placeholder="Enter Your Email" />
                              </label>
                              <label for="txt_address">
                                  <input id="txt_address" type="text" name="address" class="txt fill-width txt-address" placeholder="Enter Your Address" />
                              </label>
                              <label for="txt_contact">
                                  <input id="txt_contact" type="text" name="contact" class="txt fill-width txt-contact" placeholder="Enter Your Contact Number" />
                              </label>
                          </div>
                          <div class="right-input">
                              <label for="txt_agreement">
                                  <textarea id="txt_agreement" cols="30" rows="10" class="txt fill-width" readonly>
                                  	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                  </textarea>
                              </label>
                              <label for="txt_accept" class="accept-checkbox">
                              		<span>I accept the agreement</span>
                                  <input id="txt_accept" type="checkbox" name="accept_terms" />
                              </label>
                          </div>
                          <div class="clear"></div>
                          <p class="rs ta-r clearfix">
													<span id="response"></span>   
														<input type="hidden" name="project_id" value="<?php the_ID(); ?>">
                           <input type="submit" class="btn btn-white btn-submit-comment" value="Send">
                         </p>
                      </div>
                  </form>
              </div>
          </div><!--end: .box-list-comment -->
      </div>
  </div><!--end: .content -->
  <div class="clear"></div>
</div>