<?php get_header(); ?>
<div class="gdlr-content">

	<?php
		global $gdlr_sidebar, $theme_option;
		if( empty($gdlr_post_option['sidebar']) || $gdlr_post_option['sidebar'] == 'default-sidebar' ){
			$gdlr_sidebar = array(
				'type'=>$theme_option['post-sidebar-template'],
				'left-sidebar'=>$theme_option['post-sidebar-left'],
				'right-sidebar'=>$theme_option['post-sidebar-right']
			);
		}else{
			$gdlr_sidebar = array(
				'type'=>$gdlr_post_option['sidebar'],
				'left-sidebar'=>$gdlr_post_option['left-sidebar'],
				'right-sidebar'=>$gdlr_post_option['right-sidebar']
			);
		}
		$gdlr_sidebar = gdlr_get_sidebar_class($gdlr_sidebar);
	?>
	<div class="with-sidebar-wrapper">
		<div class="with-sidebar-container container">
			<div class="with-sidebar-left <?php echo esc_attr($gdlr_sidebar['outer']); ?> columns">
				<div class="with-sidebar-content <?php echo esc_attr($gdlr_sidebar['center']); ?> columns">
					<div class="gdlr-item gdlr-blog-full gdlr-item-start-content">
					<?php while ( have_posts() ){ the_post(); ?>

						<!-- get the content based on post format -->
						<?php get_template_part('single/content'); ?>

						<?php gdlr_get_social_shares(); ?>

						<!-- related post section -->
						<?php

							if(!empty($theme_option['single-post-related']) && $theme_option['single-post-related'] != "disable"){
								$post_term = get_the_terms(get_the_ID(), 'post_tag');
								if( !empty($post_term) ){
									$post_tags = array();
									foreach( $post_term as $term ){ $post_tags[] = $term->term_id; }

									$args = array('suppress_filters' => false);
									$args['posts_per_page'] = (empty($theme_option['related-post-num-fetch']))? '4': $theme_option['related-post-num-fetch'];
									$args['post__not_in'] = array(get_the_ID());
									$args['tax_query'] = array(array('terms'=>$post_tags, 'taxonomy'=>'post_tag', 'field'=>'id'));
									$query = new WP_Query( $args );

									if($query->have_posts()){
										$count = 0;

										echo '<div class="gdlr-related-post-wrapper">';
										echo '<span class="related-post-header">' . __('You may also like', 'gdlr_translate') . '</span>';
										echo '<div class="clear"></div>';
										while($query->have_posts()){ $query->the_post(); $count++;
											echo '<div class="related-post-widget three columns">';
											echo '<div class="related-post-widget-item">';
											$thumbnail_size = empty($theme_option['related-post-thumbnail-size'])? 'thumbnail': $theme_option['related-post-thumbnail-size'];
											$thumbnail = gdlr_get_image(get_post_thumbnail_id(), $thumbnail_size);
											if( !empty($thumbnail) ){
												echo '<div class="related-post-thumbnail"><a href="' . get_permalink() . '" >' . $thumbnail . '</a></div>';
											}
											echo '<div class="related-post-title"><a href="' . get_permalink() . '" >' . get_the_title() . '</a></div>';
											echo '<div class="clear"></div>';
											echo '</div>';
											echo '</div>';

											if($count % 4 == 0){ echo '<div class="clear"></div>'; }
										}
										echo '<div class="clear"></div>';
										echo '</div>';
										wp_reset_postdata();
									}
								}
							}
						?>

						<!-- about author section -->
						<?php if($theme_option['single-post-author'] != "disable"){ ?>
							<div class="gdlr-post-author">
							<div class="post-author-title" ><?php echo __('About Post Author', 'gdlr_translate'); ?></div>
							<div class="post-author-avartar"><?php echo get_avatar(get_the_author_meta('ID'), 90); ?></div>
							<div class="post-author-content">
							<div class="post-author"><?php the_author_posts_link(); ?></div>
							<?php echo get_the_author_meta('description'); ?>
							</div>
							<div class="clear"></div>
							</div>
						<?php } ?>

						<?php comments_template( '', true ); ?>

					<?php } ?>
					</div>
				</div>
				<?php get_sidebar('left'); ?>
				<div class="clear"></div>
			</div>
			<div class="gdlr-sidebar gdlr-right-sidebar three columns">
				<div class="gdlr-item-start-content sidebar-right-item">
					<?php
						$contact = rwmb_meta( 'business_contact' );
						echo do_shortcode($contact);
 					?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>

</div><!-- gdlr-content -->
<?php get_footer(); ?>
