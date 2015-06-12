<?php
	while ( have_posts() ){ the_post();
	   $content = gdlr_content_filter(get_the_content(), true);
			?>
			<div class="main-content-container container gdlr-item-start-content">
				<div class="gdlr-item gdlr-main-content repo">
					<?php
					if(!empty($content)){
							echo $content;
						}
						?>

          <div id="document-section">
						<div id="document-sort">
							<input class="search filter-content" placeholder="Filter list..." />
							
              <div class="inner">
							<?php

								$full_list_args = array(
									'post_type' => 'post',
									'nopaging'	=> 'true',
                  'orderby'   => 'title',
                  'order'     => 'asc',
                  'tax_query' => array(
                		array(
                			'taxonomy' => 'content_type',
                			'field'    => 'slug',
                			'terms'    => 'license', 'permit',
                		),
                	),
								);
								$full_list_query = new WP_Query( $full_list_args );

								if ( $full_list_query->have_posts()) { ?>
                    <div class="list">
                    <?php
									while ( $full_list_query->have_posts() ) {

										$full_list_query->the_post();

                    $pdf =  rwmb_meta( 'business_pdf');
                    $link =  rwmb_meta( 'business_link');
                    $postid = get_the_ID();

                    ?><div class="document-row group">
                       <div class="list nine columns">
                         <a href="<?php the_permalink(); ?>" class="h3 title" title="<?php echo get_the_title() ?>">
                           <?php echo get_the_title() ?>
                       </a>
                         <p> <?php the_excerpt(); ?></p>
                       </div>

                    <div class="more one columns">
                      <a href="<?php the_permalink(); ?>" class="button full"><i class="fa fa-arrow-circle-right">
                          </i>Read More</a>
                    </div>
                  <div class="pdf one columns">
                    <?php
                      if ( !$pdf == '' ){
                        echo '<a href="' . $pdf . '" class="button red">
                        <i class="fa fa-file-pdf-o fa-inverse"></i>
                        </a>';
                      }else {
                        ?><span class="button red inactive"><i class="fa fa-file-pdf-o fa-inverse"></i></span><?php
                      }
                      ?>
                  </div>
                </div>

                <?php
                  }//end if
                }

								/* Restore original Post Data */
								wp_reset_postdata();
								?>
            </div>
          </div>
				</div>
     </div>
   </div>
 </div>
      <?php
		}//end while
?>
