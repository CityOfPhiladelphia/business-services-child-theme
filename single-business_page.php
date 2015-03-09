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
                                <?php
                                /* output page contents */
                                the_content();

                                echo '<h2>You Must Have</h2>' ;
                                $required_docs = get_field('required');
                              //  var_dump($required_docs);
                                  if($required_docs)  {
                                    echo '<ul>';
                                    foreach($required_docs as $required_doc){
                                      echo '<li>';
                                      $content_types =  wp_get_post_terms( $required_doc->ID, 'content_type' );

                                      echo '<a href="' . $required_doc->guid .'">'  . $required_doc->post_title . '</a>';
                                      foreach($content_types as $content_type){
                                        echo '<span class="label label-primary">' . $content_type->name . '</span>';
                                      }
                                      //pass the post ID to get_post, then extract the excerpt. BOOYAH
                                      echo  '<p>' . get_post($required_doc->ID)->post_excerpt . '</p>';
                                      echo '</li>';
                                    }
                                    echo '</ul>';
                                  }

                                  echo '<h2>You Might Need</h2>' ;
                                  $maybe_docs = get_field('might_need');
                                    if($maybe_docs)  {
                                      echo '<ul>';

                                      echo '<li>';

                                      foreach($maybe_docs as $maybe_doc){

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
