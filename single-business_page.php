<?php

get_header();
get_template_part('template-parts/banner');
?>
<?php get_header(); ?>

  <div id="business-page" class="gdlr-content">
    <div class="with-sidebar-container container">
        <div class="with-sidebar-left eight columns">
          <div class="with-sidebar-content twelve columns">
            <div class="gdlr-item gdlr-blog-full gdlr-item-start-content">
              <?php
                get_template_part('templates/content', 'sidebar');
                ?>
              </div>
            </div>
          </div>
            <div class="gdlr-sidebar gdlr-right-sidebar four columns">
              <div class="gdlr-item-start-content sidebar-right-item">
              <?php dynamic_sidebar('sidebarbusiness'); ?>
              </div>
            </div>
          </div>
      <div class="clear"></div>
      <div id="document-section">
      <?php if( $post->post_parent !== 0 ) {
            get_template_part('templates/content', 'child');
        } else {
            get_template_part('templates/content', 'parent' );
        }
      ?>
</div><!-- gdlr-content -->
<?php get_footer(); ?>
