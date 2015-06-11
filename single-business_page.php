<?php
/* single business type page
* Gets child pages and displays all child content
*/

get_header();
get_template_part('template-parts/banner');
?>
<?php get_header(); ?>
<a href="/planning-a-business" class="red">
	<div class="steps">
	<span><i class="fa fa-chevron-circle-left fa-3x"></i><br></i>Back to planning</span>
	</div>
</a>

  <div id="business-page" class="gdlr-content">
    <div class="with-sidebar-container container">
        <div class="with-sidebar-left eight columns">
          <div class="with-sidebar-content twelve columns">
            <div class="gdlr-item gdlr-blog-full gdlr-item-start-content">
              <?php
              //  get_template_part('templates/content', 'sidebar');
                ?>
              </div>
            </div>
          </div>
				<?php	//if ( is_active_sidebar( 'sidebar-announcements' ) ) : ?>
            <div class="gdlr-sidebar gdlr-right-sidebar four columns">
              <div class="gdlr-item-start-content sidebar-right-item">
              	<?php get_sidebar('announcements'); ?>
              </div>
            </div>
				<?php //endif;?>
          </div>
      <div class="clear"></div>
      <div id="document-section">
      <?php if( $post->post_parent !== 0 ) {
            ?><div class="child"> <?php
            get_template_part('templates/content', 'child');
            ?></div><?php
        } else {
          ?><div class="parent"> <?php
            get_template_part('templates/content', 'parent' );
            ?></div><?php
        }
      ?>
</div><!-- gdlr-content -->
<?php get_footer(); ?>
