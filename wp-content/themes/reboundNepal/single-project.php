<?php
	get_header();
	while (have_posts()):
		the_post();
?>
<div class="layout-2cols">
  <div class="content grid_8">
      <div class="project-detail">
          <h2 class="rs project-title"><?php the_title(); ?></h2>
          <p class="rs post-by">by <?php the_author_posts_link(); ?></p>
          <div class="project-short big-thumb">
              <div class="top-project-info">
                  <div class="content-info-short clearfix">
                      <div class="thumb-img">
                          <div class="rslides_container">
                            <ul class="rslides" id="slider1">
                            	<?php
                            		$slides = get_field('images');
                            		foreach ($slides as $slide) {
                            	?>
                              <li><img src="<?php echo $slide['image']['url'] ?>" alt="<?php echo $slide['image']['alt'] ?>"></li>
                              <?php } ?>
                            </ul>
                          </div>
                      </div>
                  </div>
              </div><!--end: .top-project-info -->
              <div class="bottom-project-info clearfix">
                  <div class="project-progress sys_circle_progress" data-percent="87">
                      <div class="sys_holder_sector"></div>
                  </div>
                  <div class="group-fee clearfix">
                      <div class="fee-item">
                          <p class="rs lbl">Backers</p>
                          <span class="val">270</span>
                      </div>
                      <div class="sep"></div>
                      <div class="fee-item">
                          <p class="rs lbl">Pledged</p>
                          <span class="val">$38,000</span>
                      </div>
                      <div class="sep"></div>
                      <div class="fee-item">
                          <p class="rs lbl">Days Left</p>
                          <span class="val"><?php echo get_days_left(get_the_ID()); ?></span>
                      </div>
                  </div>
                  <div class="clear"></div>
              </div>
          </div>
          <div class="project-tab-detail tabbable accordion">
              <ul class="nav nav-tabs clearfix">
                <li class="active"><a href="#">About</a></li>
                <li><a href="#" class="be-fc-orange">Updates (0)</a></li>
                <li><a href="#" class="be-fc-orange">Backers (270)</a></li>
                <li><a href="#" class="be-fc-orange">Comments (<?php echo get_comments_number(); ?>)</a></li>
              </ul>
              <div class="tab-content">
                  <div>
                      <h3 class="rs alternate-tab accordion-label">About</h3>
                      <div class="tab-pane active accordion-content">
                          <div class="editor-content">
                              <h3 class="rs title-inside"><?php the_title(); ?></h3>
                              <p class="rs post-by">by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="fw-b fc-gray be-fc-orange"><?php the_author(); ?></a> in <span class="fw-b fc-gray"><?php the_field('location'); ?></span></p>
                              <?php the_content(); ?>
                          </div>
                          <div class="project-btn-action">
                              <a class="btn big btn-red" href="#">Ask a question</a>
                              <a class="btn big btn-black" href="#">Report this project</a>
                          </div>
                      </div><!--end: .tab-pane(About) -->
                  </div>
                  <div>
                      <h3 class="rs alternate-tab accordion-label">Updates (0)</h3>
                      <div class="tab-pane accordion-content">
                          <div class="tab-pane-inside">
                              <div class="list-last-post">
                                  <div class="media other-post-item">
                                      <a href="#" class="thumb-left">
                                          <img src="images/ex/binamra.jpg" alt="$TITLE">
                                      </a>
                                      <div class="media-body">
                                          <h4 class="rs title-other-post">
                                              <a href="#" class="be-fc-orange fw-b">Bnamra Dhakal</a>
                                          </h4>
                                          <p class="rs fc-gray time-post pb10">posted 5 days ago</p>
                                          <p class="rs description">Some update about the activities of the project. Curious minds post comments here to know the details of the work.</p>
                                      </div>
                                  </div><!--end: .other-post-item -->
                                  <div class="media other-post-item">
                                      <a href="#" class="thumb-left">
                                          <img src="images/ex/img2.jpg" alt="$TITLE">
                                      </a>
                                      <div class="media-body">
                                          <h4 class="rs title-other-post">
                                              <a href="#" class="be-fc-orange fw-b">Ram Kmar</a>
                                          </h4>
                                          <p class="rs fc-gray time-post pb10">posted 5 days ago</p>
                                          <p class="rs description">Nam nec sem ac risus congue varius. Maecenas interdum ipsum tempor ipsum fringilla eu vehicula urna vehicula.</p>
                                      </div>
                                  </div><!--end: .other-post-item -->
                                  <div class="media other-post-item">
                                      <a href="#" class="thumb-left">
                                          <img src="images/ex/img5.jpg" alt="$TITLE">
                                      </a>
                                      <div class="media-body">
                                          <h4 class="rs title-other-post">
                                              <a href="#" class="be-fc-orange fw-b">Sheetal Prasain</a>
                                          </h4>
                                          <p class="rs fc-gray time-post pb10">posted 5 days ago</p>
                                          <p class="rs description">Nam nec sem ac risus congue varius. Maecenas interdum ipsum tempor ipsum fringilla eu vehicula urna vehicula.</p>
                                      </div>
                                  </div><!--end: .other-post-item -->
                                  <div class="media other-post-item">
                                      <a href="#" class="thumb-left">
                                          <img src="images/ex/img8.jpg" alt="$TITLE">
                                      </a>
                                      <div class="media-body">
                                          <h4 class="rs title-other-post">
                                              <a href="#" class="be-fc-orange fw-b">Basanta Khadka</a>
                                          </h4>
                                          <p class="rs fc-gray time-post pb10">posted 5 days ago</p>
                                          <p class="rs description">Nam nec sem ac risus congue varius. Maecenas interdum ipsum tempor ipsum fringilla eu vehicula urna vehicula.</p>
                                      </div>
                                  </div><!--end: .other-post-item -->
                                  <div class="media other-post-item">
                                      <a href="#" class="thumb-left">
                                          <img src="images/ex/img6.jpg" alt="$TITLE">
                                      </a>
                                      <div class="media-body">
                                          <h4 class="rs title-other-post">
                                              <a href="#" class="be-fc-orange fw-b">Sarmila Malla</a>
                                          </h4>
                                          <p class="rs fc-gray time-post pb10">posted 5 days ago</p>
                                          <p class="rs description">Nam nec sem ac risus congue varius. Maecenas interdum ipsum tempor ipsum fringilla eu vehicula urna vehicula.</p>
                                      </div>
                                  </div><!--end: .other-post-item -->
                              </div>
                          </div>
                      </div><!--end: .tab-pane(Updates) -->
                  </div>
                  <div>
                      <h3 class="rs alternate-tab accordion-label">Backers (270)</h3>
                      <div class="tab-pane accordion-content">
                          <div class="tab-pane-inside">
                              <div class="project-author pb20">
                                  <div class="media">
                                      <a href="#" class="thumb-left">
                                          <img src="images/ex/binamra.jpg" alt="$USER_NAME"/>
                                      </a>
                                      <div class="media-body">
                                          <h4 class="rs pb10"><a href="#" class="be-fc-orange fw-b">Binamra Dhakal</a></h4>
                                          <p class="rs">Bhaktapur, Nepal</p>
                                          <p class="rs fc-gray">5 projects</p>
                                      </div>
                                  </div>
                              </div><!--end: .project-author -->
                              <div class="project-author pb20">
                                  <div class="media">
                                      <a href="#" class="thumb-left">
                                          <img src="images/ex/img2.jpg" alt="$USER_NAME"/>
                                      </a>
                                      <div class="media-body">
                                          <h4 class="rs pb10"><a href="#" class="be-fc-orange fw-b">Hari Sharan</a></h4>
                                          <p class="rs">Kathmandu, Nepal</p>
                                          <p class="rs fc-gray">5 projects</p>
                                      </div>
                                  </div>
                              </div><!--end: .project-author -->
                          </div>
                          <div class="project-btn-action">
                              <a class="btn btn-red" href="#">Ask a question</a>
                              <a class="btn btn-black" href="#">Report this project</a>
                          </div>
                      </div><!--end: .tab-pane(Backers) -->
                  </div>
                  <div>
                    <h3 class="rs active alternate-tab accordion-label">Comments (<?php comments_number(); ?>)</h3>
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                      comments_template();
                    endif;
                    ?>
                  </div>
                </div>
          </div><!--end: .project-tab-detail -->
      </div>
  </div><!--end: .content -->
  <div class="sidebar grid_4">
      <div class="project-runtime">
          <div class="box-gray">
              <div class="project-date clearfix">
                  <i class="icon iCalendar"></i>
                  <span class="val"><span class="fw-b">Launched: </span><?php echo date('M d,Y',strtotime(get_field('launch_date'))); ?></span>
              </div>
              <div class="project-date clearfix">
                  <i class="icon iClock"></i>
                  <span class="val"><span class="fw-b">Funding ends: </span><?php echo date('M d,Y',strtotime(get_field('funding_end_date'))); ?></span>
              </div>
              <a class="btn btn-green btn-buck-project" href="#">
                  <span class="lbl">Back This Project</span>
                  <span class="desc">$<?php the_field('minimum_pledge_amount'); ?> minimum pledge</span>
              </a>
              <p class="rs description">This project will only be funded if at least $<?php the_field('stretch_target'); ?> is pledged by <?php echo date('l M d,Y',strtotime(get_field('funding_end_date'))); ?>.</p>
          </div>
      </div><!--end: .project-runtime -->
      <div class="project-author">
          <div class="box-gray">
              <h3 class="title-box">Project by</h3>
              <div class="media">
                  <a href="#" class="thumb-left">
                    <?php echo get_avatar(get_the_author_meta('ID')); ?>
                  </a>
                  <div class="media-body">
                      <h4 class="rs pb10"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="be-fc-orange fw-b"><?php the_author(); ?></a></h4>
                      <p class="rs">Kathmandu, Nepal</p>
                      <p class="rs fc-gray"><?php echo count_user_posts(get_the_author_meta('ID'),'project') ?> projects</p>
                  </div>
              </div>
              <div class="author-action">
                  <a class="btn btn-red" href="mailto:<?php echo get_the_author_meta('email'); ?>">Contact me</a>
                  <a class="btn btn-white" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">See full bio</a>
              </div>
          </div>
      </div><!--end: .project-author -->
      <div class="clear clear-2col"></div>
      <!-- <div class="wrap-nav-pledge">
          <ul class="rs nav nav-pledge accordion">
              <li>
                  <div class=" pledge-label accordion-label clearfix">
                      <i class="icon iPlugGray"></i>
                      <span class="pledge-amount">Pledge $17 or more</span>
                      <span class="count-val">(12 of 31)</span>
                  </div>
                  <div class=" pledge-content accordion-content">
                      <div class="pledge-detail">
                          <p class="rs pledge-description">Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                          <p class="rs fw-b pb20">Ocupated (2 of 10)</p>
                          <p class="rs"><span class="fw-b">Estimated delivery:</span> Aug 2013</p>
                          <p class="rs fw-thin fc-gray pb20">Ships within the US only</p>
                          <p class="rs ta-c"><a class="btn big btn-red" href="#">Buck this project</a></p>
                      </div>
                  </div>
              </li>end: pledge-item
              <li>
                  <div class=" pledge-label accordion-label clearfix">
                      <i class="icon iPlugGray"></i>
                      <span class="pledge-amount">Pledge $32 or more</span>
                      <span class="count-val">(42 of 111)</span>
                  </div>
                  <div class=" pledge-content accordion-content">
                      <div class="pledge-detail">
                          <p class="rs pledge-description">Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                          <p class="rs fw-b pb20">Ocupated (2 of 10)</p>
                          <p class="rs"><span class="fw-b">Estimated delivery:</span> Aug 2013</p>
                          <p class="rs fw-thin fc-gray pb20">Ships within the US only</p>
                          <p class="rs ta-c"><a class="btn big btn-red" href="#">Buck this project</a></p>
                      </div>
                  </div>
              </li>end: pledge-item
              <li>
                  <div class="active pledge-label accordion-label clearfix">
                      <i class="icon iPlugGray"></i>
                      <span class="pledge-amount">Pledge $50 or more</span>
                      <span class="count-val">(7 of 13)</span>
                  </div>
                  <div class="active pledge-content accordion-content">
                      <div class="pledge-detail">
                          <p class="rs pledge-description">Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                          <p class="rs fw-b pb20">Ocupated (2 of 10)</p>
                          <p class="rs"><span class="fw-b">Estimated delivery:</span> Aug 2013</p>
                          <p class="rs fw-thin fc-gray pb20">Ships within the US only</p>
                          <p class="rs ta-c"><a class="btn big btn-red" href="#">Buck this project</a></p>
                      </div>
                  </div>
              </li>end: pledge-item
              <li>
                  <div class=" pledge-label accordion-label clearfix">
                      <i class="icon iPlugGray"></i>
                      <span class="pledge-amount">Pledge $54 or more</span>
                      <span class="count-val">(2 of 10)</span>
                  </div>
                  <div class=" pledge-content accordion-content">
                      <div class="pledge-detail">
                          <p class="rs pledge-description">Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                          <p class="rs fw-b pb20">Ocupated (12 of 30)</p>
                          <p class="rs"><span class="fw-b">Estimated delivery:</span> Aug 2013</p>
                          <p class="rs fw-thin fc-gray pb20">Ships within the US only</p>
                          <p class="rs ta-c"><a class="btn big btn-red" href="#">Buck this project</a></p>
                      </div>
                  </div>
              </li>end: pledge-item
              <li>
                  <div class=" pledge-label accordion-label clearfix">
                      <i class="icon iPlugGray"></i>
                      <span class="pledge-amount">Pledge $130 or more</span>
                      <span class="count-val">(23 of 47)</span>
                  </div>
                  <div class=" pledge-content accordion-content">
                      <div class="pledge-detail">
                          <p class="rs pledge-description">Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                          <p class="rs fw-b pb20">Ocupated (2 of 10)</p>
                          <p class="rs"><span class="fw-b">Estimated delivery:</span> Aug 2013</p>
                          <p class="rs fw-thin fc-gray pb20">Ships within the US only</p>
                          <p class="rs ta-c"><a class="btn big btn-red" href="#">Buck this project</a></p>
                      </div>
                  </div>
              </li>end: pledge-item
              <li>
                  <div class=" pledge-label accordion-label clearfix">
                      <i class="icon iPlugGray"></i>
                      <span class="pledge-amount">Pledge $110 or more</span>
                      <span class="count-val">(23 of 39)</span>
                  </div>
                  <div class=" pledge-content accordion-content">
                      <div class="pledge-detail">
                          <p class="rs pledge-description">Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                          <p class="rs fw-b pb20">Ocupated (2 of 10)</p>
                          <p class="rs"><span class="fw-b">Estimated delivery:</span> Aug 2013</p>
                          <p class="rs fw-thin fc-gray pb20">Ships within the US only</p>
                          <p class="rs ta-c"><a class="btn big btn-red" href="#">Buck this project</a></p>
                      </div>
                  </div>
              </li>end: pledge-item
          </ul>
      </div> --><!--end: .wrap-nav-pledge -->
  </div><!--end: .sidebar -->
  <div class="clear"></div>
</div>
<?php
	endwhile;
	get_footer();