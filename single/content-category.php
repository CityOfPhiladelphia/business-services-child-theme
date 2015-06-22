<?php
/* launching-a-business loop */

	while ( have_posts() ){ the_post();
		$content = gdlr_content_filter(get_the_content(), true); ?>
      <div class="section-container container group">
				<?php
					if(!empty($content)){
	            echo $content;
						}
						$business_page_args = array(
							'post_type' => 'business_page',
							'nopaging'	=> 'true',
							'order'	=> 'asc',
							'orderby'=> 'title',
							'post_parent' => 0

						);
						$business_page_query = new WP_Query( $business_page_args );

						// The Loop
						if ( $business_page_query->have_posts() ) :
							?><div class="gdlr-item gdlr-accordion-item style-1"><?php
							while ( $business_page_query->have_posts() ) {
								$business_page_query->the_post();
								$postid = get_the_ID();

								$args = array(
									'post_parent' => $postid,
									'post_type'   => 'business_page',
									'numberposts' => -1,
									'order'	=> 'asc',
									'orderby'=> 'title'
								);
								$children_array = get_children( $args );
						?>
							<div class="accordion-tab">
								<h4 class="accordion-title link-style" id="page-<?php echo $postid; ?>">
									<i class="icon-plus"></i><span><?php echo get_the_title() ?></span></h4>
									<div class="accordion-content">
								<ul>
										<?php

										foreach ($children_array as $child){
											echo '<li><a href="' .  get_permalink( $child->ID ) . '">' . $child->post_title . '</a></li>';
										}?>
										</ul>
									</div>
								</div>
								<?php } ?>
								</div>
						<?php endif;
						wp_reset_postdata();
						?>
       	</div>
			</div><!-- gdlr-content -->
      <?php
		}//end while
?>
