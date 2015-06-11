<?php
/* launching-a-business loop */

	while ( have_posts() ){ the_post();
		$content = gdlr_content_filter(get_the_content(), true);
			?>
			<div class="main-content-container container gdlr-item-start-content">
				<div class="gdlr-item gdlr-main-content">
          <div class="container">
            <div class="inner">
							<?php
							if(!empty($content)){
		              echo $content;
								}
								$category_args = array(
									'post_type' => 'business_page',
									'nopaging'	=> 'true',
									'order'	=> 'asc',
									'orderby'=> 'title',
									'post_parent' => 0

								);
								$category_query = new WP_Query( $category_args );

								// The Loop
								if ( $category_query->have_posts() ) {
									while ( $category_query->have_posts() ) {
										$category_query->the_post();
										?>
										<a href="<?php the_permalink(); ?>" class="box-list twelve columns" title="<?php echo get_the_title() ?>">

											 	<h3><?php echo get_the_title() ?></h3>
												<p><?php echo get_the_excerpt() ?></p>

										</a><?php
									}
								} else {
									// no posts found
								}
								/* Restore original Post Data */
								wp_reset_postdata();
								?>
              </div>
            </div>
					</div>
       </div>
      <?php
		}//end while
?>
