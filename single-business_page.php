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
                                ?>
                            </div>
                        </article>
                    <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>
        <div class="row ">
            <?php
            global $paged;
            if (is_front_page()) {
                $paged = (get_query_var('page')) ? get_query_var('page') : 1;
            }

            $business_args = array(
                'post_type' => 'business_page',
                'posts_per_page' => 6,
                'paged' => $paged
            );

            // The Query
            $business_query = new WP_Query($business_args);

            // The Loop
            if ($business_query->have_posts()) {
                $loop_counter = 0;
                while ($business_query->have_posts()) {
                    $business_query->the_post();
                    ?>
                    <div class="<?php bc_all('6'); ?>">
                        <article <?php post_class('two-col-service') ?>>
                            <?php inspiry_standard_thumbnail('service-gallery-thumb') ?>
                            <div class="contents clearfix">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="entry-content">
                                    <p><?php inspiry_excerpt(30); ?></p>
                                </div>
                                <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read More', 'framework'); ?></a>
                            </div>
                        </article>
                    </div>
                    <?php
                    $loop_counter++;
                    if( ($loop_counter % 2) == 0 ){
                        ?>
                        <div class="hidden-xs clearfix"></div>
                        <?php
                    }
                }
            } else {
                nothing_found(__('No Business found !', 'framework'));
            }

            inspiry_pagination($business_query);

            /* Restore original Post Data */
            wp_reset_query();
            ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
