<?php
/* single business type page
* Gets child pages and displays all child content
*/

get_header();
?>
<?php get_header(); ?>

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
									echo '<div class="gray-callout"><ul>';
									foreach($children as $child) {
										echo '<li><a href="#'. $child->post_name .'">' . $child->post_title ."</a></li>";
									}
									echo '</ul></div>';
								}
								?>
              </div>
            </div>
          </div>
					<?php
					/*  displays annoucment sidebars */
						global $post;
						$category = get_the_category();
						$get_all_annoucements_query = new WP_Query();
						$all_annoucements = $get_all_annoucements_query->query(array(
							'post_type' => 'post',
							'posts_per_page' => -1,
							'order' => 'asc',
							'orderby' => 'title',
							'tax_query' => array(
								'relation' => 'AND',
									array(
										'taxonomy' => 'content_type',
										'field'    => 'slug',
										'terms'    => 'annoucements',
									),
									array(
										'taxonomy' => 'category',
										'field'    => 'slug',
										'terms'    => $category[0]->slug,
									),
								),
							)
						);
            var_dump($get_all_annoucements_query);
						if ( $get_all_annoucements_query->have_posts() ) : ?>
            <div class="gdlr-sidebar gdlr-right-sidebar four columns gdlr-box-with-icon-item pos-top type-circle">
              <div class="gdlr-item-start-content sidebar-right-item">
								<div class="box-with-circle-icon" style="background-color: #455773">
									<i class="fa fa-bullhorn" style="color:#ffffff;"></i><br></div>
									<?php
								    echo'<h2>' .  __('Related Annoucements', 'gdlr_translate') . '</h2>';
								  	echo '<ul class="left-align">';

								  	while ( $get_all_annoucements_query->have_posts() ) {
								      $get_all_annoucements_query->the_post();
								  		echo '<li><a href="' . get_permalink() .'">'. get_the_title() . '</a></li>';
								  	}
								  	echo '</ul>';
								endif;
								  /* Restore original Post Data */
								  wp_reset_postdata();  ?>

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
