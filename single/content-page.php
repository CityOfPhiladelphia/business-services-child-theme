<?php
	while ( have_posts() ){ the_post();
		$content = gdlr_content_filter(get_the_content(), true);
		if(!empty($content)){
			?>
			<div class="main-content-container container gdlr-item-start-content">
				<div class="gdlr-item gdlr-main-content">
					<?php
						echo $content;?>

          <div id="document-section">
					<?php
							$menus = get_field('page_menu');
							if( $menus ):
								foreach( $menus as $menu ): ?>
  								<div class="list nine columns">
  									<a href="<?php echo get_permalink( $menu->ID ); ?>">
  										<?php echo get_the_title( $menu->ID );
                    ?>
  									</a>
                    <?php echo  '<p>' . get_post($menu->ID)->post_excerpt . '</p>';?>
  								</div>
	  							<?php endforeach; ?>
	  						<?php endif; ?>
						</div>
				 	</div>
	      </div>
      <?php
		}
	}
?>
