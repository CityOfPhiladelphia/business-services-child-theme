<?php
	while ( have_posts() ){ the_post();
		$content = gdlr_content_filter(get_the_content(), true);
		if(!empty($content)){
			?>
			<div class="main-content-container container gdlr-item-start-content">
				<div class="gdlr-item gdlr-main-content">
					<?php
          echo $content;
            $menus = get_field('page_menu');
  				     if( $menus ):
  						?>	<ul>
  							<?php foreach( $menus as $menu ): ?>
  								<li>
  									<a href="<?php echo get_permalink( $menu->ID ); ?>">
  										<?php echo get_the_title( $menu->ID ); ?>
  									</a>
  								</li>
  							<?php endforeach; ?>
  							</ul>
  						<?php endif; ?>

					<div class="clear"></div>
				</div>
			</div>
			<?php
		}
	}
?>
