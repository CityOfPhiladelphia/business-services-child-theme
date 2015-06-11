<?php
/*
Displda Business Type page archives


/* launching-a-business loop */

get_header();

$get_top_level_business_pages = new WP_Query();
$top_level_business_pages = $get_top_level_business_pages->query(array(
  'post_type' => 'business_page',
  'nopaging'	=> 'true',
  'order'	=> 'asc',
  'orderby'=> 'title',
  'post_parent' => 0
  )
);
?>
<div class="main-content-container container gdlr-item-start-content">
  <div class="gdlr-item gdlr-main-content">
    <div class="container">
      <div class="inner">
<?php
	while ( $get_top_level_business_pages->have_posts() ){ $get_top_level_business_pages->the_post();		?>
				<a href="<?php the_permalink(); ?>" class="box-list twelve columns" title="<?php echo get_the_title() ?>">
					 	<h3><?php echo get_the_title() ?></h3>
						<p><?php echo get_the_excerpt() ?></p>
				</a>

    <?php
									}
								/* Restore original Post Data */
								wp_reset_postdata();
								?>
              </div>
            </div>
					</div>
       </div>
<?php get_footer();
