<?php
	while ( have_posts() ){ the_post();
		$content = gdlr_content_filter(get_the_content(), true);
		if(!empty($content)) : ?>
			<div class="main-content-container container gdlr-item-start-content">
				<div class="gdlr-item gdlr-main-content">
					<?php echo $content; ?>
				</div>
			</div>
		<?php endif; ?>
  	<div id="document-section">
			<?php
			$section_1 = get_field('section_content_1');
			if( !$section_1 == false ):
			?>
			<div class="parent">
				<div id="must-have">
					<div class="container">
						<div class="inner">
							<?php
							$section_title_1 = get_field('section_title_1');
							if( !$section_title_1 == false ):
								echo '<h2>' . $section_title_1 . '</h2>';
							endif;
							foreach( $section_1 as $section_1_content ): ?>
								<div class="document-row group">
									<div class="list ten columns">
										<a href="<?php echo get_permalink( $section_1_content->ID ); ?>">
											<?php echo get_the_title( $section_1_content->ID ); ?>
										</a>
										<?php echo  '<p>' . get_post($section_1_content->ID)->post_excerpt . '</p>';?>
									</div>
										<?php echo '<div class="more one columns">' . '<a href="' . $section_1_content->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>'; ?>
									</div>
							<?php endforeach; ?>
						</div>
					</div><!-- container -->
				</div><!--must have -->
			</div><!--parent -->
		<?php endif; ?>
		<?php
		$section_2 = get_field('section_content_2');
		if( !$section_2 == false ):
		?>
		<div class="parent">
			<div id="must-have">
				<div class="container">
					<div class="inner">
						<?php
						$section_title_2 = get_field('section_title_2');
						if( !$section_title_2 == false ):
							echo '<h2>' . $section_title_2 . '</h2>';
						endif;
						foreach( $section_2 as $section_2_content ): ?>
							<div class="document-row group">
								<div class="list ten columns">
									<a href="<?php echo get_permalink( $section_2_content->ID ); ?>">
										<?php echo get_the_title( $section_2_content->ID ); ?>
									</a>
									<?php echo  '<p>' . get_post($section_2_content->ID)->post_excerpt . '</p>';?>
								</div>
									<?php echo '<div class="more one columns">' . '<a href="' . $section_2_content->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>'; ?>
								</div>
						<?php endforeach; ?>
					</div>
				</div><!-- container -->
			</div><!--must have -->
		</div><!--parent -->
		<?php endif; ?>
		<?php
		$section_3 = get_field('section_content_3');
		if( !$section_3 == false ):
		?>
		<div class="parent">
			<div id="must-have">
				<div class="container">
					<div class="inner">
						<?php
						$section_title_3 = get_field('section_title_3');
						if( !$section_title_3 == false ):
							echo '<h2>' . $section_title_3 . '</h2>';
						endif;
						foreach( $section_3 as $section_3_content ): ?>
							<div class="document-row group">
								<div class="list ten columns">
									<a href="<?php echo get_permalink( $section_3_content->ID ); ?>">
										<?php echo get_the_title( $section_3_content->ID ); ?>
									</a>
									<?php echo  '<p>' . get_post($section_3_content->ID)->post_excerpt . '</p>';?>
								</div>
									<?php echo '<div class="more one columns">' . '<a href="' . $section_3_content->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>'; ?>
								</div>
						<?php endforeach; ?>
					</div>
				</div><!-- container -->
			</div><!--must have -->
		</div><!--parent -->
		<?php endif; ?>
		<?php
		$section_4 = get_field('section_content_4');
		if( !$section_4 == false ):
		?>
		<div class="parent">
			<div id="must-have">
				<div class="container">
					<div class="inner">
						<?php
						$section_title_4 = get_field('section_title_4');
						if( !$section_title_4 == false ):
							echo '<h2>' . $section_title_4 . '</h2>';
						endif;
						foreach( $section_4 as $section_4_content ): ?>
							<div class="document-row group">
								<div class="list ten columns">
									<a href="<?php echo get_permalink( $section_4_content->ID ); ?>">
										<?php echo get_the_title( $section_4_content->ID ); ?>
									</a>
									<?php echo  '<p>' . get_post($section_4_content->ID)->post_excerpt . '</p>';?>
								</div>
									<?php echo '<div class="more one columns">' . '<a href="' . $section_4_content->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>'; ?>
								</div>
						<?php endforeach; ?>
					</div>
				</div><!-- container -->
			</div><!--must have -->
		</div><!--parent -->
		<?php endif; ?>
		<?php
		$section_5 = get_field('section_content_5');
		if( !$section_5 == false ):
		?>
		<div class="parent">
			<div id="must-have">
				<div class="container">
					<div class="inner">
						<?php
						$section_title_5 = get_field('section_title_5');
						if( !$section_title_5 == false ):
							echo '<h2>' . $section_title_5 . '</h2>';
						endif;
						foreach( $section_5 as $section_5_content ): ?>
							<div class="document-row group">
								<div class="list ten columns">
									<a href="<?php echo get_permalink( $section_5_content->ID ); ?>">
										<?php echo get_the_title( $section_5_content->ID ); ?>
									</a>
									<?php echo  '<p>' . get_post($section_5_content->ID)->post_excerpt . '</p>';?>
								</div>
									<?php echo '<div class="more one columns">' . '<a href="' . $section_5_content->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>'; ?>
								</div>
						<?php endforeach; ?>
					</div>
				</div><!-- container -->
			</div><!--must have -->
		</div><!--parent -->
		<?php endif; ?>
		<?php
		$section_6 = get_field('section_content_6');
		if( !$section_6 == false ):
		?>
		<div class="parent">
			<div id="must-have">
				<div class="container">
					<div class="inner">
						<?php
						$section_title_6 = get_field('section_title_6');
						if( !$section_title_6 == false ):
							echo '<h2>' . $section_title_6 . '</h2>';
						endif;
						foreach( $section_6 as $section_6_content ): ?>
							<div class="document-row group">
								<div class="list ten columns">
									<a href="<?php echo get_permalink( $section_6_content->ID ); ?>">
										<?php echo get_the_title( $section_6_content->ID ); ?>
									</a>
									<?php echo  '<p>' . get_post($section_6_content->ID)->post_excerpt . '</p>';?>
								</div>
									<?php echo '<div class="more one columns">' . '<a href="' . $section_6_content->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>'; ?>
								</div>
						<?php endforeach; ?>
					</div>
				</div><!-- container -->
			</div><!--must have -->
		</div><!--parent -->
		<?php endif; ?>
		<?php
		$section_7 = get_field('section_content_7');
		if( !$section_7 == false ):
		?>
		<div class="parent">
			<div id="must-have">
				<div class="container">
					<div class="inner">
						<?php
						$section_title_7 = get_field('section_title_7');
						if( !$section_title_7 == false ):
							echo '<h2>' . $section_title_7 . '</h2>';
						endif;
						foreach( $section_7 as $section_7_content ): ?>
							<div class="document-row group">
								<div class="list ten columns">
									<a href="<?php echo get_permalink( $section_7_content->ID ); ?>">
										<?php echo get_the_title( $section_7_content->ID ); ?>
									</a>
									<?php echo  '<p>' . get_post($section_7_content->ID)->post_excerpt . '</p>';?>
								</div>
									<?php echo '<div class="more one columns">' . '<a href="' . $section_7_content->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>'; ?>
								</div>
						<?php endforeach; ?>
					</div>
				</div><!-- container -->
			</div><!--must have -->
		</div><!--parent -->
		<?php endif; ?>
	</div><!--document section -->
  <?php
	}
?>
