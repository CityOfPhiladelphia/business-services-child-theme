<?php

/**
 * Contains :
 * custom post types
    * Business Type - business_page

 *
 * @link https://github.com/kdemi/business-services-child-theme
 *
 * @package business-services-child-theme
 */
/**
 *  Create Custom Post Types
 *
 * Additional custom post types can be defined here
 * http://codex.wordpress.org/Post_Types
 *
 * @link https://github.com/kdemi/business-services-child-theme
 *
 *
 */

 /*-----------------------------------------------------------------------------------*/
 /*	Custom Post Types
 /*-----------------------------------------------------------------------------------*/

if (!class_exists('BusinessServicesCustomPostTypes')){
    class BusinessServicesCustomPostTypes{
        function create_business_post_type() {
          register_post_type( 'business_page',
            array(
                'labels' => array(
                    'name' => __( 'Business Type' ),
                    'singular_name' => __( 'Business Type' ),
                    'add_new'   => __('Add Business Type Page'),
                    'all_items'   => __('All Business Type Pages'),
                    'add_new_item' => __('Add Business Type Page'),
                    'edit_item'   => __('Edit Business Type Page'),
                    'view_item'   => __('View Business Type Page'),
                    'search_items'   => __('Search Business Type Pages'),
                    'not_found'   => __('Business Type Page Not Found'),
                    'not_found_in_trash'   => __('Business Type Page not found in trash'),
              ),
                'public' => true,
                'has_archive' => true,
                'menu_position' => 5,
                'menu_icon' => 'dashicons-store',
                'hierarchical' => true,
                'supports' => array('title', 'excerpt', 'editor', 'thumbnail', 'page-attributes'),
                'taxonomies' => array('category'),
                'rewrite' => array(
                    'slug' => 'business',
                ),
            )
          );
        }

    }//end class

}

if (class_exists("BusinessServicesCustomPostTypes")){
    $custom_post_types = new BusinessServicesCustomPostTypes();
}

if (isset($custom_post_types)){
    //actions
    add_action( 'init', array($custom_post_types, 'create_business_post_type'));

    register_activation_hook( __FILE__, array($custom_post_types, 'rewrite_flush') );
}

/*-----------------------------------------------------------------------------------*/
/*	Create Custom Taxonomies
/*-----------------------------------------------------------------------------------*/

if (!class_exists('BusinessServicesTaxonomy')){
    class BusinessServicesTaxonomy{
      function create_content_type_tax() {

        $labels = array(
          'name'                       => 'Content Types',
          'singular_name'              => 'Content Type',
          'menu_name'                  => 'Content Types',
          'all_items'                  => 'All Content Types',
          'parent_item'                => 'Parent Item',
          'parent_item_colon'          => 'Parent Item:',
          'new_item_name'              => 'New Content Types',
          'add_new_item'               => 'Add New Content Type',
          'edit_item'                  => 'Edit Content Type',
          'update_item'                => 'Update Content Type',
          'separate_items_with_commas' => 'Separate items with commas',
          'search_items'               => 'Search Items',
          'add_or_remove_items'        => 'Add or remove items',
          'choose_from_most_used'      => 'Choose from the most used items',
          'not_found'                  => 'Not Found'
        );
        $args = array(
          'labels'                     => $labels,
          'hierarchical'               => true,
          'public'                     => true,
          'show_ui'                    => true,
          'show_admin_column'          => true,
          'show_in_nav_menus'          => true
        );
        register_taxonomy( 'content_type', array( 'post' ), $args );
      }
    }//end class
  }

if (class_exists("BusinessServicesTaxonomy")){
    $custom_taxonomy = new BusinessServicesTaxonomy();
}
if (isset($custom_taxonomy)){
    //actions
    add_action( 'init', array($custom_taxonomy, 'create_content_type_tax'), 0);
}
/*-----------------------------------------------------------------------------------*/
/*	Remove unnecessary theme options
/*-----------------------------------------------------------------------------------*/

function remove_parent_features() {
 	remove_action( 'init', 'gdlr_register_portfolio_admin_option' );
    remove_action('init', 'gdlr_init_page_feature');

   //remove theme support for post formats
   remove_theme_support('post-formats');
}

add_action( 'after_setup_theme', 'remove_parent_features', 11 );



/*-----------------------------------------------------------------------------------*/
/*	Remove tags
/*-----------------------------------------------------------------------------------*/

function unregister_taxonomy(){
    register_taxonomy('post_tag', array());
}
add_action('init', 'unregister_taxonomy');


/*-----------------------------------------------------------------------------------*/
/*	Register Taxonomy for Media
/*-----------------------------------------------------------------------------------*/
function business_register_taxonomy_for_images() {
    register_taxonomy_for_object_type( 'category', 'attachment' );
	register_taxonomy_for_object_type( 'content_type', 'attachment' );
}
add_action( 'init', 'business_register_taxonomy_for_images' );





/*-----------------------------------------------------------------------------------*/
/*	enqueue styles/scripts
/*-----------------------------------------------------------------------------------*/
function business_scripts() {
  wp_enqueue_script( 'custom_js', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), '0.1', true );
  wp_enqueue_script( 'list_js', '//cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js', '1.1.1', true );

  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'child-style',
      get_stylesheet_directory_uri() . '/child-custom.css',
      array('parent-style')
  );
}

add_action( 'wp_enqueue_scripts', 'business_scripts' );

/*-----------------------------------------------------------------------------------*/
/*	add business page sidebar
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'business_widgets_init' );
function business_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Business Page Sidebar', 'business' ),
        'id' => 'sidebarbusiness',
        'description' => __( 'Widgets in this area will be shown on Business Type Pages.', 'business' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s gdlr-item gdlr-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="gdlr-widget-title">',
        'after_title'   => '</h3><div class="clear"></div>'
        )
    );
}
/*-----------------------------------------------------------------------------------*/
/*	content type checkboses to radios (only allow one)


add_action( 'admin_footer', 'content_type_radios' );
function content_type_radios(){
	echo '<script type="text/javascript">';
	echo 'jQuery("#taxonomy-content_type input[type=checkbox]")';
	echo '.each(function(){this.type="radio"});</script>';
}
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	Filter upload size limit
/*-----------------------------------------------------------------------------------*/
function filter_site_upload_size_limit( $size ) {
  $size = 1024 * 64000;
  return $size;
}

add_filter( 'upload_size_limit', 'filter_site_upload_size_limit', 20 );


add_filter( 'rwmb_meta_boxes', 'business_register_meta_boxes' );

function business_register_meta_boxes( $meta_boxes )
{
    $prefix = 'business_';

    // 1st meta box
    $meta_boxes[] = array(
        'id'       => 'files',
        'title'    => 'PDF and Online Service Locations',
        'pages'    => array( 'post' ),
        'context'  => 'normal',
        'priority' => 'high',

        'fields' => array(
            array(
                'name'  => 'Associated PDF',
                'desc'  => 'Choose a PDF from the media library or upload a new one.',
                'id'    => $prefix . 'pdf',
                'type'  => 'file_input'
            ),
            array(
                'name'  => 'Renewable Online?',
                'desc'  => 'If this license or permit can be renewed through eClipse, check this box.',
                'id'    => $prefix . 'link',
                'type'  => 'checkbox'
            ),
        )
    );

    // 2nd meta box
    $meta_boxes[] = array(
        'id'       => 'sidebar',
        'title'    => 'Sidebar Contact Information',
        'pages'    => array( 'post' ),
        'context'  => 'side',
        'priority' => 'high',

        'fields' => array(
            array(
                'name'  => 'Contact',
                'desc'  => 'Enter the shortcode for a contact. E.g [text-blocks id="the-title"]',
                'id'    => $prefix . 'contact',
                'type'  => 'text'
			//	'clone' => true
            ),
        )
    );

    return $meta_boxes;
}

//add_filter('uwpqsf_result_tempt', 'doc_filter_customize_output', '', 4);
function doc_filter_customize_output($results , $arg, $id, $getdata ){
	 // The Query
      $apiclass = new uwpqsfprocess();
      $query = new WP_Query( $arg );
		ob_start();	$result = '';
			// The Loop

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
        global $post;
        $pdf =  rwmb_meta( 'business_pdf');
        $link =  rwmb_meta( 'business_link');
        $postid = get_the_ID();

        ?><div class="document-row group">
           <div class="list nine columns">
             <a href="<?php the_permalink(); ?>" class="h3 title" title="<?php echo get_the_title() ?>">
               <?php echo get_the_title() ?>
           </a>
             <p> <?php the_excerpt(); ?></p>
           </div>

        <div class="more one columns">
          <a href="<?php the_permalink(); ?>" class="button full"><i class="fa fa-arrow-circle-right">
              </i>Read More</a>
        </div>
      <div class="pdf one columns">
        <?php
          if ( !$pdf == '' ){
            echo '<a href="' . $pdf . '" class="button red">
            <i class="fa fa-file-pdf-o fa-inverse"></i>
            </a>';
          }else {
            ?><span class="button red inactive"><i class="fa fa-file-pdf-o fa-inverse"></i></span><?php
          }
          ?>
      </div>
    </div>
    <?php
			}
          echo  $apiclass->ajax_pagination($arg['paged'],$query->max_num_pages, 4, $id, $getdata);
		 } else {
					 echo  'no post found';
				}
				/* Restore original Post Data */
				wp_reset_postdata();

		$results = ob_get_clean();
			return $results;
}
// Ultimate WP Query Search Filter heirarchy in drop downs


add_filter('uwpqsf_taxonomy_arg', 'custom_term_output','',1);
function custom_term_output($args){
  $args['parent'] = '0';
  return $args;
}

//add_filter('uwpqsf_tax_field_checkbox','custom_checkbox_output','',12);
function custom_checkbox_output($html,$type,$exc,$hide,$taxname,$taxlabel,$taxall,$opt,$c,$defaultclass,$formid,$divclass){

$eid = explode(",", $exc);//this is where you forgot to add,this will throw warning when debug mode is on

$args = array('hide_empty'=>$hide,'exclude'=>$eid, 'hierarchical' => true, 'parent' => 0 );//add new parameter to the parent argument.

$taxoargs = apply_filters('uwpqsf_taxonomy_arg',$args,$taxname,$formid);
$terms = get_terms($taxname,$taxoargs); $count = count($terms);

$html = '';

    if($type == 'checkbox')
    {
      $html  = '<div class="'.$defaultclass.' '.$divclass.' togglecheck" id="tax-check-'.$c.'"><span  class="taxolabel-'.$c.'">'.$taxlabel.'</span >';
		$html .= '<input  type="hidden" name="taxo['.$c.'][name]" value="'.$taxname.'">';
		$html .= '<input  type="hidden" name="taxo['.$c.'][opt]" value="'.$opt.'">';
				if(!empty($taxall)){
				$checkall = (isset($_GET['taxo'][$c]['call']) && $_GET['taxo'][$c]['call'] == '1'  ) ? 'checked="checked"' : '';
				$html .= '<label><input type="checkbox" id="tchkb-'.$c.'" name="taxo['.$c.'][call]" class="chktaxoall" value="1" '.$checkall.'>'.$taxall.'</label>';
				}
                if ( $count > 0 ){
                    foreach ( $terms as $term ) {
                        $selected = $terms[0]->term_id;
                        $html .= '<label><input type="checkbox" id="tchkb-'.$c.'" name="taxo['.$c.'][term]" value="'.$term->slug.'">'.$term->name.'</label>';

                        $args = array(
                            'hide_empty'    => false,
                            'hierarchical'  => true,
                            'parent'        => $term->term_id
                        );
                        $childterms = get_terms($taxname, $args);

                        foreach ( $childterms as $childterm ) {
                                $selected = $childterms[0]->term_id;

                            $html .= "<label class='child'><input type='checkbox' id='tchkb-".$c."' name='taxo[".$c."][term]' value='".$childterm->slug."'".">" . $childterm->name . '</label>';

                        }}
                     }
                     $html .= '</div>';
				return  $html;
    }

}
