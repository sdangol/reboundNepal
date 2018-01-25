<footer id="footer">
		<div class="container_12 main-footer">
			<?php dynamic_sidebar('footer-widget'); ?>
			<!-- <div class="grid_3 about-us">
				<h3 class="rs title">About</h3>
				<p class="rs description">Rebound is a crowdfuding webapplication that help its users to get funds for a campaign or take part in some campaigns. Some text describing Rebound Nepal</p>
				<p class="rs email"><a class="fc-default  be-fc-orange" href="mailto:info@reboundnepal.org">info@reboundnepal.org</a></p>
				<p class="rs">(+977) 985 - 110 - 1112</p>
			</div> --><!--end: .contact-info -->
			<!-- <div class="grid_3 recent-tweets">
				<h3 class="rs title">Recent Tweets</h3>
				<div class="lst-tweets" id="sys_lst_tweets">

				</div>
			</div> --><!--end: .recent-tweets -->
			<!-- <div class="clear clear-2col"></div> -->
		<!-- 	<div class="grid_3 email-newsletter">
				<h3 class="rs title">Newsletter Signup</h3>
				<div class="inner">
					<p class="rs description">Nam aliquet, velit quis consequat interdum, odio dolor elementum.</p>
					<form action="#">
						<div class="form form-email">
							<label class="lbl" for="txt-email">
								<input id="txt-email" type="text" class="txt fill-width" placeholder="Enter your e-mail address"/>
							</label>
							<button class="btn btn-green" type="submit">Submit</button>
						</div>
					</form>
				</div>
			</div> --><!--end: .email-newsletter -->
	<!-- 		<div class="grid_3">
				<h3 class="rs title">Discover &amp; Create</h3>
				<div class="footer-menu">
					<ul class="rs">
						<li><a class="be-fc-orange" href="#">What is Rebound</a></li>
						<li><a class="be-fc-orange" href="#">Start a project</a></li>
						<li><a class="be-fc-orange" href="#">Project Guidlines</a></li>
						<li><a class="be-fc-orange" href="#">Press</a></li>
						<li><a class="be-fc-orange" href="#">Stats</a></li>
					</ul>
					<ul class="rs">
						<li><a class="be-fc-orange" href="#">Staff Picks</a></li>
						<li><a class="be-fc-orange" href="#">Popular</a></li>
						<li><a class="be-fc-orange" href="#">Recent</a></li>
						<li><a class="be-fc-orange" href="#">Small Projects</a></li>
						<li><a class="be-fc-orange" href="#">Most Funded</a></li>
					</ul>
					<div class="clear"></div>
				</div>
			</div> -->
			<div class="clear"></div>
		</div>
		<div class="copyright">
			<div class="container_12">
				<div class="grid_12">
					<a class="logo-footer" href="<?php echo get_theme_file_uri('/images/logo.png'); ?>"><img width="100" src="<?php echo get_theme_file_uri('/images/logo.png'); ?>" alt="reboundNepal"/></a>
					<p class="rs term-privacy">
						<a class="fw-b be-fc-orange" href="<?php echo site_url('terms-and-conditions'); ?>">Terms & Conditions</a>
						<span class="sep">/</span>
						<a class="fw-b be-fc-orange" href="<?php echo site_url('privacy-policy'); ?>">Privacy Policy</a>
						<span class="sep">/</span>
						<a class="fw-b be-fc-orange" href="<?php echo site_url('faq'); ?>">FAQ</a>
					</p>
					<p class="rs ta-c fc-gray-dark site-copyright">
						Powered by <a href="http://sastracreations.com/" title="Sastra creations" target="_blank">Sastra Creations</a>.
					</p>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</footer><!--end: #footer -->

</div>

<div class="popup-common" id="sys_popup_common">
	<div class="overlay-bl-bg"></div>
	<div class="container_12 pop-content">
		<div class="grid_12 wrap-btn-close ta-r">
			<i class="icon iBigX closePopup"></i>
		</div>
		<div class="grid_6 prefix_1">
			<div class="form login-form">
				<form id="register-form" action="<?php echo admin_url('admin-ajax.php?action=register_user'); ?>" class="ajax-form">
					<h3 class="rs title-form">Register</h3>
					<div class="box-white">
						<h4 class="rs title-box">New to Rebound?</h4>
						<p class="rs">A Rebound account is required to continue.</p>
						<div class="form-action">
							<div class="alert-msg" style="display:none;">
								<!-- Alert message is shown here -->
							</div>
							<label for="txt_name">
								<input id="txt_name" class="txt fill-width" type="text" placeholder="Enter full name" name="full_name" />
							</label>
							<div class="wrap-2col clearfix">
								<div class="col">
									<label for="txt_email">
										<input id="txt_email" class="txt fill-width" type="email" placeholder="Enter your e-mail address" name="email" />
									</label>
									<label for="txt_re_email">
										<input id="txt_re_email" class="txt fill-width" type="email" placeholder="Re-enter your e-mail adress" name="email_confirm" />
									</label>
								</div>
								<div class="col">
									<label for="txt_password">
										<input id="txt_password" class="txt fill-width" type="password" placeholder="Enter password" name="password" />
									</label>
									<label for="txt_re_password">
										<input id="txt_re_password" class="txt fill-width" type="password" placeholder="Re-enter password" name="password_confirm" />
									</label>
								</div>
							</div>
							<p class="rs pb10">By signing up, you agree to our <a href="#" class="fc-orange">terms of use</a> and <a href="#" class="fc-orange">privacy policy</a>.</p>
							<p class="rs ta-c">
								<button class="btn btn-red btn-submit" type="submit">Register</button>
							</p>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="grid_4">
			<div class="form login-form">
				<?php if (isset($_GET['form']) && $_GET['form'] == 'resetpass' && isset($_GET['key']) && isset($_GET['login'])): ?>
					<form id="reset-password" action="<?php echo admin_url('admin-ajax.php?action=reset_password'); ?>" class="ajax-form">
						<input type="hidden" name="key" value="<?php echo $_GET['key']; ?>">
						<input type="hidden" name="login" value="<?php echo $_GET['login']; ?>">
						<h3 class="rs title-form">Reset your Password</h3>
						<div class="box-white">
							<div class="form-action">
								<div class="alert-msg" style="display:none;">
									<!-- Alert message is shown here -->
								</div>
								<label for="txt_password">
									<input id="txt_password" class="txt fill-width" type="password" placeholder="Enter your new password" name="password"/>
								</label>
								<label for="txt_password_confirm">
									<input id="txt_password_confirm" class="txt fill-width" type="password" placeholder="Re-type Password" name="password_confirm"/>
								</label>
								<p class="rs ta-c pb10">
									<button class="btn btn-red btn-submit" type="submit">Confirm</button>
								</p>
								<p class="rs ta-c">
									<a href="#" class="fc-orange login-form-toggle">Back to login</a>
								</p>
							</div>
						</div>
					</form>
				<?php else: ?>
					<form id="login-form" action="<?php echo admin_url('admin-ajax.php?action=login_user'); ?>" class="ajax-form"">
						<h3 class="rs title-form">Login</h3>
						<div class="box-white">
							<h4 class="rs title-box">Already Have an Account?</h4>
							<p class="rs">Please log in to continue.</p>
							<div class="form-action">
								<div class="alert-msg" style="display:none;">
									<!-- Alert message is shown here -->
								</div>
								<label for="txt_email_login">
									<input id="txt_email_login" class="txt fill-width" type="text" placeholder="Enter your e-mail address" name="email"/>
								</label>
								<label for="txt_password_login">
									<input id="txt_password_login" class="txt fill-width" type="password" placeholder="Enter password" name="password"/>
								</label>

								<label for="chk_remember" class="rs pb20 clearfix">
									<input id="chk_remember" type="checkbox" class="chk-remember" name="remember"/>
									<span class="lbl-remember">Remember me</span>
								</label>
								<p class="rs ta-c pb10">
									<?php if (isset($_GET['redirect'])): ?>
										<input type="hidden" name="redirect" value="<?php echo site_url('/'.$_GET['redirect'].'/'); ?>">
									<?php endif; ?>
									<button class="btn btn-red btn-submit" type="submit">Login</button>
								</p>
								<p class="rs ta-c">
									<a href="#" class="fc-orange" id="forgot-password-toggle">I forgot my password</a>
								</p>
							</div>
						</div>
					</form>
				<?php endif; ?>
				<form id="forgot-password" action="<?php echo admin_url('admin-ajax.php?action=forgot_password'); ?>" class="ajax-form" style="display: none;">
					<h3 class="rs title-form">Forgot Password</h3>
					<div class="box-white">
						<p class="rs">We will send you a reset link.</p>
						<div class="form-action">
							<div class="alert-msg" style="display:none;">
								<!-- Alert message is shown here -->
							</div>
							<label for="txt_email_login">
								<input id="txt_email_login" class="txt fill-width" type="text" placeholder="Enter your e-mail address or username" name="user_login"/>
							</label>
							<p class="rs ta-c pb10">
								<button class="btn btn-red btn-submit" type="submit">Send reset link</button>
							</p>
							<p class="rs ta-c">
								<a href="#" class="fc-orange login-form-toggle">Back to login</a>
							</p>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<script>
	var admin_ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";
	var $get_vars = <?php echo json_encode($_GET); ?>;
</script>
<?php wp_footer(); ?>
</body>
</html>