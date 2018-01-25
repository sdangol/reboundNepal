<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
			<!--[if lte IE 7]>
			<link rel="stylesheet" href="css/ie7.css"/>
			<![endif]-->
			<!--[if lte IE 8]>
			<link rel="stylesheet" href="css/ie8.css"/>
			<![endif]-->
			<!--[if lt IE 9]>
			<script type="text/javascript" src="js/html5.js"></script>
			<![endif]-->
			<!-- <script>
			!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
			n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
			document,'script','../../../connect.facebook.net/en_US/fbevents.js');

			fbq('init', '1031554816897182');
			fbq('track', "PageView");</script>
			<noscript><img height="1" width="1" style="display:none"
			src="https://www.facebook.com/tr?id=1031554816897182&amp;ev=PageView&amp;noscript=1"
			/></noscript> -->
			<?php wp_head(); ?>
		</head>
		<body <?php body_class(); ?>>
			<div id="wrapper">
				<header id="header">
						<div class="container_12 clearfix">
								<div class="grid_12 header-content">
										<div id="sys_header_right" class="header-right">
												<div class="account-panel">
													<?php if (!is_user_logged_in()): ?>
														<a href="#" class="btn btn-red sys_show_popup_login">Register</a>
														<a href="#" class="btn btn-black sys_show_popup_login">Login</a>
													<?php
														else:
															$logged_user = wp_get_current_user();
													?>
														<ul class="profile-wrapper">
															<li class="dropdown">
																<div class="profile">
																	<?php echo get_avatar($logged_user->ID); ?>
																	<!-- user profile -->
																	<a href="#" class="dropdown-toggle" data-target="#profile-menu">
																		<?php echo $logged_user->display_name; ?>
																	</a>
																	<!-- more menu -->
																	<ul id="profile-menu" class="dropdown-menu">
																		<li><a href="<?php echo get_author_posts_url($logged_user->ID); ?>">My Profile</a></li>
																		<li><a href="<?php echo wp_logout_url( home_url() ); ?>">Log out</a></li>
																	</ul>
																</div>
															</li>
														</ul>
													<?php endif; ?>
												</div>
												<div class="form-search">
													<?php get_search_form(); ?>
												</div>
										</div>
										<div class="header-left">
												<h1 id="logo">
													<?php the_custom_logo(); ?>
												</h1>
												<div class="main-nav clearfix">
														<div class="nav-item">
																<a href="#" class="nav-title" id="discover-projects">Discover</a>
																<p class="rs nav-description">Great Projects</p>
														</div>
														<span class="sep"></span>
														<div class="nav-item">
																<a href="<?php echo site_url('start-project'); ?>" class="nav-title">Start</a>
																<p class="rs nav-description">Your Project</p>
														</div>
												</div>
										</div>
								</div>
						</div>
						<div class="dropdown-search-result" id="discover" style="z-index: 200; display: none;">
							<div class="container_12">
								<div class="grid_12 wrap-title-result">
									<div class="title-result">Discover our projects</div>
									<i class="icon iBigX"></i>
									<i class="iPickUp"></i>
								</div>
								<div class="clear"></div>
								<div class="list-project-result">
									<div class="grid_6">
										<h3 class="fc-white">Categories</h3>
										<nav class="lst-category">
											<ul class="rs nav nav-category">
											<?php
												$categories = get_terms(['taxonomy' => 'project-category',
																			'hide_empty' => false]);
												foreach ($categories as $category) {
											?>
												<li>
													<a href="<?php echo get_term_link($category); ?>">
														<?php echo $category->name; ?>
														<span class="count-val">(<?php echo $category->count; ?>)</span>
														<i class="icon iPlugGray"></i>
													</a>
												</li>
										<?php } ?>
											</ul>
										</nav>
									</div><!--end: .grid_6 > .project-short-->
									<div class="grid_6">
										<h3 class="fc-white">Featured</h3>
										<nav class="lst-category">
											<ul class="rs nav nav-category">
											<?php
												$featured_cats = get_terms(['taxonomy' => 'featured-category',
																										'hide_empty' => false]);
												foreach ($featured_cats as $featured) {
											?>
												<li>
													<a href="<?php echo get_term_link($featured); ?>">
														<?php echo $featured->name; ?>
														<span class="count-val">(<?php echo $featured->count; ?>)</span>
														<i class="icon iPlugGray"></i>
													</a>
												</li>
										<?php } ?>
											</ul>
										</nav>
									</div><!--end: .grid_6 > .project-short-->
								</div>
							</div>
						</div>
						<div class="dropdown-search-result" id="search" style="z-index: 200; display: none;">
							<div class="container_12">
								<div class="grid_12 wrap-title-result">
									<div class="title-result">Search Results</div>
									<i class="icon iBigX"></i>
									<i class="iPickUp"></i>
								</div>
								<div class="clear"></div>
								<div class="list-project-result">
									<div class="loader text-center">
										<img src="<?php echo get_template_directory_uri()."/images/Ellipsis.svg"; ?>" alt="">
									</div>
									<div class="result-container">
										<!-- Ajax pulled results go here -->
									</div>
								</div>
								<div class="grid_12">
									<div class="confirm-result">
										<a href="#" class="view-all">View all</a>
										<span class="clear"></span>
									</div>
								</div>
							</div>
						</div>
	</header><!--end: #header -->