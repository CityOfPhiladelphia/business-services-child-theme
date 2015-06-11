<?php
/*  displays annoucment sidebars */
  global $post;
  $category = get_the_category();
  $get_all_annoucements_query = new WP_Query();
  $all_annoucements = $get_all_annoucements_query->query(array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'order' => 'asc',
    'orderby' => 'title',
    'tax_query' => array(
      'relation' => 'AND',
    		array(
    			'taxonomy' => 'content_type',
    			'field'    => 'slug',
    			'terms'    => 'annoucements',
    		),
        array(
    			'taxonomy' => 'category',
    			'field'    => 'slug',
    			'terms'    => $category[0]->slug,
    		),
    	),
    )
  );

  if ( $get_all_annoucements_query->have_posts() ) {
    echo'<h2>' .  __('Related Annoucements') . '</h2>';
  	echo '<ul>';

  	while ( $get_all_annoucements_query->have_posts() ) {
      $get_all_annoucements_query->the_post();
  		echo '<li><a href="' . get_permalink() .'">'. get_the_title() . '</a></li>';
  	}
  	echo '</ul>';
  } else {
  	// no posts found
  }
  /* Restore original Post Data */
  wp_reset_postdata();  ?>
