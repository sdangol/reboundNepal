<!DOCTYPE html>
  <html>
  <!-- Mirrored from envato.megadrupal.com/html/kickstars/how-it-work.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 03 Feb 2017 13:39:46 GMT -->
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
      <script>
      !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
      n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
      document,'script','../../../connect.facebook.net/en_US/fbevents.js');

      fbq('init', '1031554816897182');
      fbq('track', "PageView");</script>
      <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=1031554816897182&amp;ev=PageView&amp;noscript=1"
      /></noscript>
      <?php wp_head(); ?>
    </head>
    <body>
      <div id="wrapper">
        <header id="header">
           <!--  <div class="wrap-top-menu">
               <div class="container_12 clearfix">
                   <div class="grid_12">
                       <nav class="top-menu">
                           <ul id="main-menu" class="nav nav-horizontal clearfix">
                               <li class="active"><a href="index-2.html">Home</a></li>
                               <li class="sep"></li>
                               <li><a href="all-pages.html">All Pages</a></li>
                               <li class="sep"></li>
                               <li><a href="how-it-work.html">Help</a></li>
                               <li class="sep"></li>
                               <li><a href="contact.html">Contact</a></li>
                           </ul>
                           <a id="btn-toogle-menu" class="btn-toogle-menu" href="#alternate-menu">
                               <span class="line-bar"></span>
                               <span class="line-bar"></span>
                               <span class="line-bar"></span>
                           </a>
                           <div id="right-menu">
                               <ul class="alternate-menu">
                                   <li><a href="index-2.html">Home</a></li>
                                   <li><a href="all-pages.html">All Pages</a></li>
                                   <li><a href="how-it-work.html">Help</a></li>
                                   <li><a href="contact.html">Contact us</a></li>
                               </ul>
                           </div>
                       </nav>
                       <div class="top-message clearfix">
                           <i class="icon iFolder"></i>
                           <span class="txt-message">Nulla egestas nulla ac diam ultricies id viverra nisi adipiscing.</span>
                           <i class="icon iX"></i>
                           <div class="clear"></div>
                       </div>
                       <i id="sys_btn_toggle_search" class="icon iBtnRed make-right"></i>
                   </div>
               </div>
           </div> --><!-- end: .wrap-top-menu -->
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
                            <span>Logged in as <a href="<?php echo get_author_posts_url($logged_user->ID); ?>"><?php echo $logged_user->display_name; ?></a></span>
                            <span><a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></span>
                          <?php endif; ?>
                        </div>
                        <div class="form-search">
                            <form action="#">
                                <label for="sys_txt_keyword">
                                    <input id="sys_txt_keyword" class="txt-keyword" type="text" placeholder="Search projects"/>
                                </label>
                                <button class="btn-search" type="reset"><i class="icon iMagnifier"></i></button>
                                <button class="btn-reset-keyword" type="reset"><i class="icon iXHover"></i></button>
                            </form>
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
                                <a href="<?php echo admin_url('post-new.php?post_type=project'); ?>" class="nav-title">Start</a>
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
                  <div class="title-result">Projects in <a href="#" class="fc-white">Kathmandu</a></div>
                  <i class="icon iBigX"></i>
                  <i class="iPickUp"></i>
                </div>
                <div class="clear"></div>
                <div class="list-project-result">
                  <div class="grid_3">
                    <div class="project-short sml-thumb">
                      <div class="top-project-info">
                        <div class="content-info-short clearfix">
                          <a href="#" class="thumb-img">
                            <img src="images/ex/th-292x204-1.jpg" alt="$TITLE">
                          </a>
                          <div class="wrap-short-detail">
                            <h3 class="rs acticle-title"><a class="be-fc-orange" href="#">Project title</a></h3>
                            <p class="rs tiny-desc">by <a href="#" class="fw-b fc-gray be-fc-orange">Binamra Dhakal</a></p>
                            <p class="rs title-description">Nam sit amet est sapien, a faucibus purus. Pellentesque placerat elementum adipiscing.</p>
                            <p class="rs project-location">
                              <i class="icon iLocation"></i>
                              Kathmandu, Nepal
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="bottom-project-info clearfix">
                        <div class="line-progress">
                          <div class="bg-progress">
                            <span  style="width: 50%"></span>
                          </div>
                        </div>
                        <div class="group-fee clearfix">
                          <div class="fee-item">
                            <p class="rs lbl">Funded</p>
                            <span class="val">50%</span>
                          </div>
                          <div class="sep"></div>
                          <div class="fee-item">
                            <p class="rs lbl">Pledged</p>
                            <span class="val">$38,000</span>
                          </div>
                          <div class="sep"></div>
                          <div class="fee-item">
                            <p class="rs lbl">Days Left</p>
                            <span class="val">25</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div><!--end: .grid_3 > .project-short-->
                  <div class="grid_3">
                    <div class="project-short sml-thumb">
                      <div class="top-project-info">
                        <div class="content-info-short clearfix">
                          <a href="#" class="thumb-img">
                            <img src="images/ex/th-192x135-1.jpg" alt="$TITLE">
                          </a>
                          <div class="wrap-short-detail">
                            <h3 class="rs acticle-title"><a class="be-fc-orange" href="#">Project title</a></h3>
                            <p class="rs tiny-desc">by <a href="#" class="fw-b fc-gray be-fc-orange">Binamra Dhakal</a></p>
                            <p class="rs title-description">Nam sit amet est sapien, a faucibus purus. Pellentesque placerat elementum adipiscing.</p>
                            <p class="rs project-location">
                              <i class="icon iLocation"></i>
                              Kathmandu, Nepal
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="bottom-project-info clearfix">
                        <div class="line-progress">
                          <div class="bg-progress">
                            <span class="success" style="width: 123%"></span>
                          </div>
                        </div>
                        <div class="group-fee clearfix">
                          <div class="fee-item">
                            <p class="rs lbl">Funded</p>
                            <span class="val">123%</span>
                          </div>
                          <div class="sep"></div>
                          <div class="fee-item">
                            <p class="rs lbl">Pledged</p>
                            <span class="val">$25,000</span>
                          </div>
                          <div class="sep"></div>
                          <div class="fee-item">
                            <p class="rs lbl">Days Left</p>
                            <span class="val">18</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div><!--end: .grid_3 > .project-short-->
                  <div class="grid_3">
                    <div class="project-short sml-thumb">
                      <div class="top-project-info">
                        <div class="content-info-short clearfix">
                          <a href="#" class="thumb-img">
                            <img src="images/ex/th-192x135-2.jpg" alt="$TITLE">
                          </a>
                          <div class="wrap-short-detail">
                            <h3 class="rs acticle-title"><a class="be-fc-orange" href="#">Project title</a></h3>
                            <p class="rs tiny-desc">by <a href="#" class="fw-b fc-gray be-fc-orange">Binamra Dhakal</a></p>
                            <p class="rs title-description">Nam sit amet est sapien, a faucibus purus. Pellentesque placerat elementum adipiscing.</p>
                            <p class="rs project-location">
                              <i class="icon iLocation"></i>
                              Kathmandu, Nepal
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="bottom-project-info clearfix">
                        <div class="line-progress">
                          <div class="bg-progress">
                            <span  style="width: 21%"></span>
                          </div>
                        </div>
                        <div class="group-fee clearfix">
                          <div class="fee-item">
                            <p class="rs lbl">Funded</p>
                            <span class="val">21%</span>
                          </div>
                          <div class="sep"></div>
                          <div class="fee-item">
                            <p class="rs lbl">Pledged</p>
                            <span class="val">$850K</span>
                          </div>
                          <div class="sep"></div>
                          <div class="fee-item">
                            <p class="rs lbl">Days Left</p>
                            <span class="val">2</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div><!--end: .grid_3 > .project-short-->
                  <div class="grid_3">
                    <div class="project-short sml-thumb">
                      <div class="top-project-info">
                        <div class="content-info-short clearfix">
                          <a href="#" class="thumb-img">
                            <img src="images/ex/th-192x135-3.jpg" alt="$TITLE">
                          </a>
                          <div class="wrap-short-detail">
                            <h3 class="rs acticle-title"><a class="be-fc-orange" href="#">Project title</a></h3>
                            <p class="rs tiny-desc">by <a href="#" class="fw-b fc-gray be-fc-orange">Binamra Dhakal</a></p>
                            <p class="rs title-description">Nam sit amet est sapien, a faucibus purus. Pellentesque placerat elementum adipiscing.</p>
                            <p class="rs project-location">
                              <i class="icon iLocation"></i>
                              Kathmandu, Nepal
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="bottom-project-info clearfix">
                        <div class="line-progress">
                          <div class="bg-progress">
                            <span  style="width: 50%"></span>
                          </div>
                        </div>
                        <div class="group-fee clearfix">
                          <div class="fee-item">
                            <p class="rs lbl">Funded</p>
                            <span class="val">50%</span>
                          </div>
                          <div class="sep"></div>
                          <div class="fee-item">
                            <p class="rs lbl">Pledged</p>
                            <span class="val">$138,662</span>
                          </div>
                          <div class="sep"></div>
                          <div class="fee-item">
                            <p class="rs lbl">Days Left</p>
                            <span class="val">44</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div><!--end: .grid_3 > .project-short-->
                </div>
                <div class="grid_12">
                  <div class="confirm-result">
                    Were you looking for projects in <a href="#" class="fc-white">Kathmandu</a>, in <a href="#" class="fc-white">Nepal</a>, or matching the word "<a href="#" class="fc-white">Kath</a>"?
                    <a href="category.html" class="view-all">View all</a>
                    <span class="clear"></span>
                  </div>
                </div>
              </div>
            </div>
  </header><!--end: #header -->