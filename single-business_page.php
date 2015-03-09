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
                                  if($required_docs)  {
                                    echo '<ul>';
                                    foreach($required_docs as $required_doc){
                                      echo '<li>' . '<a href="' . $required_doc->guid .'">'  . $required_doc->post_title . '</a></li>';
                                    }
                                    echo '</ul>';
                                  }

                                  echo '<h2>You Might Need</h2>' ;
                                  $maybe_docs = get_field('might_need');
                                    if($maybe_docs)  {
                                      echo '<ul>';
                                      foreach($maybe_docs as $maybe_doc){
                                        echo '<li>' . '<a href="' . $maybe_doc->guid .'">'  . $maybe_doc->post_title . '</a></li>';
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
