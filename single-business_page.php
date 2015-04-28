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

              if( $required_docs )  {

                foreach( $required_docs as $required_doc ){

                  $content_types =  wp_get_post_terms( $required_doc->ID, 'content_type' );

                  if ( !$content_types == '' ){

                    $content_types =  wp_get_post_terms( $required_doc->ID, 'content_type' );
                    $pdf =  rwmb_meta( 'business_pdf', $args = array(), $required_doc->ID );
                    $link =  rwmb_meta( 'business_link', $args = array(), $required_doc->ID );

                    foreach ( $content_types as $content_type ){

                      echo '<div class="' . $content_type->slug . ' group">';
                        echo '<div class="list nine columns">';
                          echo '<a href="' . $required_doc->guid .'">'  . $required_doc->post_title . '</a>';

                          //pass the post ID to get_post, then extract the excerpt. BOOYAH
                          echo  '<p>' . get_post($required_doc->ID)->post_excerpt . '</p>';

                            $categories = get_the_category($required_doc->ID);
                        
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
              }//end if
          ?>
              </div><!--inner-->
            </div><!--.container-->
          </div><!--#must-have-->
          <div class="clear"></div>
          <div id="might-need">
            <div class="container">
              <h2>You Might Need</h2>
              <div class="inner">
            <?php
              $maybe_docs = get_field('might_need');
                if( $maybe_docs ) {

                  foreach( $maybe_docs as $maybe_doc ){

                    $m_content_types =  wp_get_post_terms( $maybe_doc->ID, 'content_type' );

                    if ( !$m_content_types == '' ){
                      $m_content_types =  wp_get_post_terms( $maybe_doc->ID, 'content_type' );
                      $pdf =  rwmb_meta( 'business_pdf', $args = array(), $maybe_doc->ID );
                      $link =  rwmb_meta( 'business_link', $args = array(), $maybe_doc->ID );


                      foreach ( $m_content_types as $m_content_type ){
                        echo '<div class="' . $m_content_type->slug . ' group">';
                          echo '<div class="list nine columns">';
                            echo '<a href="' . $maybe_doc->guid .'">'  . $maybe_doc->post_title . '</a>';
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
                      }
                  }//end foreach
                }//end if
                ?>

      </div><!--.inner -->
    </div><!--.container-->
  </div><!-- #might-need -->
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
