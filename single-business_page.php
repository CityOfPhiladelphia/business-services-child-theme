<?php

get_header();
get_template_part('template-parts/banner');
?>
<?php get_header(); ?>

  <div id ="business-page" class="gdlr-content">
    <div class="with-sidebar-container container">
        <div class="with-sidebar-left eight columns">
          <div class="with-sidebar-content twelve columns">
            <div class="gdlr-item gdlr-blog-full gdlr-item-start-content">
              <?php
                get_template_part('templates/content', 'sidebar');
                ?>
              </div>
            </div>
          </div>
            <div class="gdlr-sidebar gdlr-right-sidebar four columns">
              <div class="gdlr-item-start-content sidebar-right-item">
              <?php dynamic_sidebar('sidebarbusiness'); ?>
              </div>
            </div>
          </div>
      <div class="clear"></div>
      <div id="document-section">
        <div id="must-have">
          <div class="container">
          <h2>Required</h2>
          <div class="inner">
              <div class="right one columns label">Download PDF</div>
              <div class="right one columns label">Online Service</div>
          <?php
            $required_docs = get_field('required');

            $business_page_category = get_the_category();
            $business_page_cat_id = $business_page_category[0]->cat_ID;

              if( $required_docs )  {

                foreach( $required_docs as $required_doc ){

                    $content_types =  wp_get_post_terms( $required_doc->ID, 'content_type' );
                    $pdf =  rwmb_meta( 'business_pdf', $args = array(), $required_doc->ID );
                    $link =  rwmb_meta( 'business_link', $args = array(), $required_doc->ID );

                    foreach ( $content_types as $content_type ){

                      echo '<div class="document-row group">
                              <div class="list nine columns">';
                          $cat_child_args = array(
                            'type'                     => 'post',
                            'child_of'                 => $business_page_cat_id,
                            'orderby'                  => 'name',
                            'taxonomy'                 => 'category',
                            'pad_counts'               => false

                          );
                        $category_children = get_categories( $cat_child_args );

                        $categories = get_the_category($required_doc->ID);
                        echo '<div class="business-flag">';
                          foreach ( $categories as $category ) {
                            foreach ( $category_children as $child ) {

                              if ( $category->term_id == $child->term_id ){

                                echo '<span>' . $category->name . '</span>';
                              }
                            }
                          }
                          echo '</div>';
                          echo '<a class="h3" href="' . $required_doc->guid .'">'  . $required_doc->post_title . '</a>';

                          //pass the post ID to get_post, then extract the excerpt. BOOYAH
                          echo  '<p>' . get_post($required_doc->ID)->post_excerpt . '</p>';

                        echo '</div>';// ten

                        echo '<div class="more one columns">' . '<a href="' . $required_doc->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>';

                     echo '<div class="link one columns">';
                        if ( !$link == '' ){
                          echo '<a href="' . $link . '" class="button red">
                            <i class="fa fa-link fa-inverse"></i>
                        </a>';
                      }else {
                        echo '<span class="button red inactive"><i class="fa fa-link fa-inverse"></i></span>';
                      }
                      echo '</div>';//one
                     echo '<div class="pdf one columns">';
                        if ( !$pdf == '' ){
                            echo '<a href="' . $pdf . '" class="button red">
                            <i class="fa fa-file-pdf-o fa-inverse"></i>
                            </a>';
                        }else {
                            echo '<span class="button red inactive"><i class="fa fa-file-pdf-o fa-inverse"></i></span>';
                        }
                      echo '</div>';//one
                    echo '</div>';
                      }
                    }
                }//end foreach

          ?>
              </div><!--inner-->
            </div><!--.container-->
          </div><!--#must-have-->
          <div class="clear"></div>
    <?php
      $maybe_docs = get_field('might_need');
        if( !$maybe_docs == '') {?>
          <div id="might-need">
            <div class="container">
              <h2>You Might Need</h2>
              <div class="inner">
                <?php
                foreach( $maybe_docs as $maybe_doc ){

                    $content_types =  wp_get_post_terms( $maybe_doc->ID, 'content_type' );
                    $pdf =  rwmb_meta( 'business_pdf', $args = array(), $maybe_doc->ID );
                    $link =  rwmb_meta( 'business_link', $args = array(), $maybe_doc->ID );

                    foreach ( $content_types as $content_type ){

                      echo '<div class="document-row group">
                              <div class="list nine columns">';
                          $cat_child_args = array(
                            'type'                     => 'post',
                            'child_of'                 => $business_page_cat_id,
                            'orderby'                  => 'name',
                            'taxonomy'                 => 'category',
                            'pad_counts'               => false

                          );
                        $category_children = get_categories( $cat_child_args );

                        $categories = get_the_category($maybe_doc->ID);
                        echo '<div class="business-flag">';
                          foreach ( $categories as $category ) {
                            foreach ( $category_children as $child ) {

                              if ( $category->term_id == $child->term_id ){

                                echo '<span>' . $category->name . '</span>';
                              }
                            }
                          }
                          echo '</div>';
                          echo '<a class="h3" href="' . $maybe_doc->guid .'">'  . $maybe_doc->post_title . '</a>';
                            //pass the post ID to get_post, then extract the excerpt. BOOYAH
                            echo  '<p>' . get_post($maybe_doc->ID)->post_excerpt . '</p>';
                          echo '</div>';// ten

                          echo '<div class="more one columns">' . '<a href="' . $maybe_doc->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>';

                        echo '<div class="pdf one columns">';
                          if ( !$pdf == '' ){
                              echo '<a href="' . $pdf . '" class="button red">
                              <i class="fa fa-file-pdf-o fa-inverse"></i>
                              </a>';
                          }else {
                              echo '<span class="button red inactive"><i class="fa fa-file-pdf-o fa-inverse"></i></span>';
                          }
                        echo '</div>';//one

                       echo '<div class="link one columns">';
                          if ( !$link == '' ){
                            echo '<a href="' . $link . '" class="button red">
                              <i class="fa fa-link fa-inverse"></i>
                          </a>';
                        }else {
                          echo '<span class="button red inactive"><i class="fa fa-link fa-inverse"></i></span>';
                        }
                        echo '</div>';//one
                      echo '</div>';
                      }
                  }//end foreach
                ?>
              </div><!--.inner -->
            </div><!--.container-->
          </div><!-- #might-need -->

              <?php  }//end if ?>

</div><!-- gdlr-content -->
<?php get_footer(); ?>


<?php
  $taxonomies = array('content_type');
  $args = array(
      'orderby'           => 'name',
      'order'             => 'ASC',
      'hide_empty'        => true,
      'hierarchical'      => true,
  );

  $terms = get_terms($taxonomies, $args);
  $tax_slugs = array();
    foreach($terms as $term) {
      array_push($tax_slugs, $term->slug);
    }
?>
<div id="dom-target"><?php foreach($tax_slugs as $key => $value){echo  htmlspecialchars($value . " ") ;}?></div>
