<?php
	while ( have_posts() ){ the_post();
		$content = gdlr_content_filter(get_the_content(), true);
		if(!empty($content)){
			?>
			<div class="main-content-container container gdlr-item-start-content">
				<div class="gdlr-item gdlr-main-content">
					<?php
						echo $content;?>
					</div>
				</div>

        <div id="document-section">
					<div class="parent">
						<div class="container">
							<div class="inner">
					<?php
							$menus = get_field('page_menu');
							if( $menus ):
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

									<?php echo '<div class="more one columns">' . '<a href="' . 	get_post($current_ID)->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>'; ?>
								</div>
									<?php endforeach; ?>
	  						<?php endif; ?>
							</div>
						</div>
						</div>
					</div>
			 	</div>
	    </div>
      <?php
		}
	}
?>
