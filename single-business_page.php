<?php

get_header();
get_template_part('template-parts/banner');
?>
<div class=" page-top clearfix">
    <div class="container">
        <div class="row">
            <div class="<?php bc_all('12'); ?>">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <nav class="bread-crumb">
                    <?php theme_breadcrumb(); ?>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="business-page clearfix">
    <div class="container">
        <div class="row">
            <div class="<?php bc_all('12'); ?>">
                <?php
                if (have_posts()):
                    while (have_posts()):
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(' clearfix'); ?>>
                            <div class="entry-content">
                                <?php the_content(); ?>

                              <div id="must-have">
                              <?php
                                echo '<h2>You Must Have</h2>' ;
                                $required_docs = get_field('required');
                              //  var_dump($required_docs);
                                  if($required_docs)  {
                                    foreach($required_docs as $required_doc){
                                      $content_types =  wp_get_post_terms( $required_doc->ID, 'content_type' );

                                      if (! $content_types == ''){
                                        $content_types =  wp_get_post_terms( $required_doc->ID, 'content_type' );
                                        echo '<div ';
                                        foreach($content_types as $content_type){
                                          echo 'class=' . $content_type->slug . '>';
                                          }
                                        }else {
                                          echo '<div class="an-overview">';
                                        }

                                      echo '<a href="' . $required_doc->guid .'">'  . $required_doc->post_title . '</a>';

                                      //pass the post ID to get_post, then extract the excerpt. BOOYAH
                                      echo  '<p class="small">' . get_post($required_doc->ID)->post_excerpt . '</p>';
                                      echo '</div>';
                                    }
                                  }
                                  ?>
                                </div><!--#must-have-->
                                  <div id="might-need">
                                <?php
                                  echo '<h2>You Might Need</h2>' ;
                                  $maybe_docs = get_field('might_need');
                                    if($maybe_docs)  {
                                      echo '<ul>';

                                      foreach($maybe_docs as $maybe_doc){
                                        echo '<li>';
                                        echo '<a href="' . $maybe_doc->guid .'">'  . $maybe_doc->post_title . '</a>';

                                        $content_types =  wp_get_post_terms( $maybe_doc->ID, 'content_type' );
                                        foreach($content_types as $content_type){
                                          echo '<span class="label label-primary">' . $content_type->name . '</span>';
                                        }
                                        echo '<p>' .  get_post($maybe_doc->ID)->post_excerpt . '</p>';
                                        echo '</li>';
                                      }
                                      echo '</ul>';
                                    }
                                  ?>
                                </div><!--#might-need -->
                            </div>
                        </article>
                    <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>

    </div>
</div>
<?php get_footer(); ?>

    <?php

        $taxonomies = array(
            'content_type'
        );

        $args = array(
            'orderby'           => 'name',
            'order'             => 'ASC',
            'hide_empty'        => true,
            'exclude'           => array(),
            'exclude_tree'      => array(),
            'include'           => array(),
            'number'            => '',
            'fields'            => 'all',
            'slug'              => '',
            'parent'            => '',
            'hierarchical'      => true,
            'child_of'          => 0,
            'get'               => '',
            'name__like'        => '',
            'description__like' => '',
            'pad_counts'        => false,
            'offset'            => '',
            'search'            => '',
            'cache_domain'      => 'core'
        );

        $terms = get_terms($taxonomies, $args);
        $tax_slugs = array();
          foreach($terms as $term) {
            array_push($tax_slugs, $term->slug);
          }
?><div id='dom-target'><?php foreach($tax_slugs as $key => $value){echo  htmlspecialchars($value . " ") ;}?></div>
