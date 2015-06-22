
<div id="must-have">
  <div class="container">
    <?php
      $business_page_category = get_the_category();
      $business_page_cat_id = $business_page_category[0]->cat_ID;

      $current_id = get_the_ID();

      $required_docs = get_field('required');

      if( $required_docs )  {
      ?>
        <h3>Required</h3>
            <div class="inner">
              <div class="right one columns label">Download PDF</div>
              <div class="clear"></div>
          <?php
                foreach( $required_docs as $required_doc ){

                  $content_types =  wp_get_post_terms( $required_doc->ID, 'content_type' );
                  $pdf =  rwmb_meta( 'business_pdf', $args = array(), $required_doc->ID );
                  $link =  rwmb_meta( 'business_link', $args = array(), $required_doc->ID );

                    echo '<div class="document-row group">
                            <div class="list ten columns">';

                      echo '<a class="h3" href="' . $required_doc->guid .'">'  . $required_doc->post_title . '</a>';

                        //pass the post ID to get_post, then extract the excerpt. BOOYAH
                      echo  '<p>' . get_post($required_doc->ID)->post_excerpt . '</p>';

                      echo '</div>';// ten

                      echo '<div class="more one columns">' . '<a href="' . $required_doc->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>';

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
                  }//end foreach
              }//end required docs
              echo '</div>';

          ?>
        </div>
          </div><!--.container-->
        </div><!--#must-have-->
<?php
        $business_page_category = get_the_category();
        $business_page_cat_id = $business_page_category[0]->cat_ID;
          $maybe_docs = get_field('might_need');
            if( !$maybe_docs == '') {?>
              <div id="might-need">
                <div class="container">
                  <h3>Documents You May Need</h3pos>
                  <div class="inner">
                    <div class="right one columns label">Download PDF</div>
                    <div class="clearfix"></div>
                    <?php
                    foreach( $maybe_docs as $maybe_doc ){

                        $content_types =  wp_get_post_terms( $maybe_doc->ID, 'content_type' );
                        $pdf =  rwmb_meta( 'business_pdf', $args = array(), $maybe_doc->ID );
                        $link =  rwmb_meta( 'business_link', $args = array(), $maybe_doc->ID );

                        foreach ( $content_types as $content_type ){

                          echo '<div class="document-row group">
                                  <div class="list nine columns">';

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

                          echo '</div>';
                          }
                      }//end foreach
                    ?>
                  </div><!--.inner -->
              </div><!-- #might-need -->

                  <?php  }//end if
                  ?>
