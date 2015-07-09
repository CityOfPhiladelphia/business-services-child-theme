<?php
/* landing page display */

	while ( have_posts() ){ the_post();
		$content = gdlr_content_filter(get_the_content(), true);
		if(!empty($content)){
			?>
			<div class="main-content-container container gdlr-item-start-content">
				<div class="gdlr-item gdlr-main-content">
					<?php
						echo $content;
						?>
					</div>
				</div>

				<?php	$menus = get_field('page_menu');
					if( $menus ):
						?>
        <div id="document-section">
					<div class="parent">
						<div class="container">
							<div class="menu-page inverse seven columns">
					<?php
					$section_title = get_field('section_title');
					if( !$section_title == false ):
						echo '<h2>' . $section_title . '</h2>';
					endif;

								foreach( $menus as $menu ):
									$current_ID = $menu->ID;
									 ?>
									<div class="document-row group">
  								<div class="list nine columns">
  									<a href="<?php echo get_permalink( 	$current_ID ); ?>">
  										<?php echo get_the_title( 	$current_ID );
                    ?>
  									</a>
                    <?php echo  '<p>' . get_post(	$current_ID )->post_excerpt . '</p>';?>
  								</div>
								</div>
									<?php endforeach; ?>
									</div>
								<?php
								/*  displays annoucment sidebars */
									global $post;
									$category = get_the_category();
									$get_all_announcements_query = new WP_Query();
									$all_annoucements = $get_all_announcements_query->query(array(
										'post_type' => 'post',
										'posts_per_page' => 10,
										'order' => 'asc',
										'orderby' => 'title',
										'tax_query' => array(
											'relation' => 'AND',
												array(
													'taxonomy' => 'content_type',
													'field'    => 'slug',
													'terms'    => 'announcements',
												),
											),
										)
									);
									if ( $get_all_announcements_query->have_posts() ) : ?>
			            <div class="gdlr-sidebar gdlr-right-sidebar five columns white-sidebar">
			              <div class="gdlr-item-start-content sidebar-right-item pad-30">
												<?php
											    echo'<h3>' .  __('Related Announcements', 'gdlr_translate') . '</h3>';
											  	echo '<ul class="left-align">';

											  	while ( $get_all_announcements_query->have_posts() ) {
											      $get_all_announcements_query->the_post();
											  		echo '<li><a href="' . get_permalink() .'">'. get_the_title() . '</a></li>';
											  	}
											  	echo '</ul>';
											endif;
											  /* Restore original Post Data */
											  wp_reset_postdata();  ?>

			              </div>
			            </div>
			          </div>
							</div>
		      	<div class="clear"></div>
					</div>
				</div>
	  <?php endif;
		}
	}
?>
