<?php
/* single business type page
* Gets child pages and displays all child content
*/

get_header();
?>

  <div id="business-page" class="gdlr-content">
    <div class="with-sidebar-container container">
        <div class="with-sidebar-left eight columns">
          <div class="with-sidebar-content twelve columns">
            <div class="gdlr-item gdlr-blog-full gdlr-item-start-content">
							<?php
								while ( have_posts() ){ the_post();
									$content = gdlr_content_filter(get_the_content(), true);
									echo $content;

									$all_pages_query = new WP_Query();
									$all_wp_pages = $all_pages_query->query(array(
										'post_type' => 'business_page',
										'posts_per_page' => -1,
										'order' => 'asc',
										'orderby' => 'title'
										)
									);
									$current_id = get_the_ID();
									// Filter through all pages and find this pages's children
									$children = get_page_children( $current_id, $all_wp_pages );
                  if (!$children == 0) {
  									echo '<ul>';
  									foreach($children as $child) {
  										echo '<li><a href="'. $child->post_name .'">' . $child->post_title ."</a></li>";
  									}
  									echo '</ul></div>';
								  }
                }
                /* Restore original Post Data */
                wp_reset_postdata();
								?>
              </div>
            </div>
          </div>

          <?php
        global $parentcategory;
        foreach((get_the_category()) as $category) {
          if ($category->category_parent == 0) {
            $parentcategory = $category->term_id;
          }
        }
        if ( $parentcategory == null)  {
          echo 'Select a parent for this business type.';
        }else{
					/*  displays annoucment sidebars */
						global $post;
            $current_id = get_the_ID();
						$get_related_announcements_query = new WP_Query();
						$all_annoucements = $get_related_announcements_query->query(array(
							'post_type' => 'post',
							'posts_per_page' => 5,
							'order' => 'DESC',
							'orderby' => 'date',
              'ignore_sticky_posts' => true,
							'tax_query' => array(
								'relation' => 'AND',
									array(
										'taxonomy' => 'content_type',
										'field'    => 'slug',
										'terms'    => 'announcements',
									),
									array(
										'taxonomy' => 'category',
										'field'    => 'id',
										'terms'    => array( $parentcategory, 153 ),
									),
								),
							)
						);
						if ( $get_related_announcements_query->have_posts() ) : ?>
            <div class="gdlr-sidebar gdlr-right-sidebar four columns gdlr-box-with-icon-item pos-top type-circle">
              <div class="gdlr-item-start-content sidebar-right-item">
								<div class="box-with-circle-icon" style="background-color: #455773">
									<i class="fa fa-bullhorn" style="color:#ffffff;"></i><br></div>
									<?php
								    echo'<h3>' .  __('Announcements', 'gdlr_translate') . '</h3>';
								  	echo '<ul class="left-align">';

								  	while ( $get_related_announcements_query->have_posts() ) {
								      $get_related_announcements_query->the_post();
								  		echo '<li><a href="' . get_permalink() .'">'. get_the_title() . '</a></li>';
								  	}
								  	echo '</ul>';
                  endif;

								  /* Restore original Post Data */
								  wp_reset_postdata();
                }
                ?>

              </div>
            </div>
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
