<?php
	while ( have_posts() ){ the_post();
		$content = gdlr_content_filter(get_the_content(), true);
			?>
			<div class="main-content-container container gdlr-item-start-content">
				<div class="gdlr-item gdlr-main-content">
					<?php  echo $content; ?>
				</div>
			</div>
          <div id="document-section">
					<?php
							$required_menus = get_field('page_menu_required');
  				     if( !$required_menus == false ):
  						?>
							<div class="parent">
								<div id="must-have">
									<div class="container">
										<div class="inner">
											<?php
											$section_title = get_field('section_title');
											if( !$section_title == false ):
												echo '<h2>' . $section_title . '</h2>';
											endif;

  					 foreach( $required_menus as $required_menu ): ?>
									<div class="document-row group">
										<div class="list ten columns">
	  									<a href="<?php echo get_permalink( $required_menu->ID ); ?>">
	  										<?php echo get_the_title( $required_menu->ID );
	                    ?>
	  									</a>
	                    <?php echo  '<p>' . get_post($required_menu->ID)->post_excerpt . '</p>';?>
  									</div>
										<?php echo '<div class="more one columns">' . '<a href="' . $required_menu->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>'; ?>
								</div>
  							<?php endforeach; ?>
						</div>
					</div>
					</div>
				</div>
  							<?php endif; ?>


						<?php
						$maybe_menus = get_field('page_menu_may_need');
						if( !$maybe_menus == false):
						?>
							<div id="might-need">
								<div class="container">
									<div class="inner menu-page">
										<?php
										$section_title_may_need = get_field('section_title_may_need');
										if( !$section_title_may_need == false ):
											echo '<h2>' . $section_title_may_need . '</h2>';
										endif;
										?>
									<?php foreach( $maybe_menus as $maybe_menu ): ?>
										<div class="document-row group">
											<div class="list ten columns">
												<a href="<?php echo get_permalink( $maybe_menu->ID ); ?>">
													<?php echo get_the_title( $maybe_menu->ID );
												?>
												</a>
												<?php echo  '<p>' . get_post($maybe_menu->ID)->post_excerpt . '</p>';?>
											</div>
											<?php echo '<div class="more one columns">' . '<a href="' . $maybe_menu->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>'; ?>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
				</div>
									<?php endif; ?>
				</div>
			</div>
	</div>
        <?php
	}
?>
