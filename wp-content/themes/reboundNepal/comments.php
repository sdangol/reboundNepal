<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 */
?>
<div class="tab-pane accordion-content">
  <div class="box-list-comment">
    <?php
    if ( have_comments() ) :
      echo wp_list_comments(['max_depth' => 3,
                        'style' => 'div',
                        'per_page' => 6,
                        'type' => 'comment',
                        'callback' => 'reboundnepal_comments',
                        'avatar_size' => 100,
                        'end-callback' => 'reboundnepal_comments_end']);
    ?>
    <?php endif; ?>
  </div>
</div><!--end: .tab-pane(Comments) -->