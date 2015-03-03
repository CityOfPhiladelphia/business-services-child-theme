<?php
/**

Custom function for filtering the sections array. Good for child themes to override or add to the sections.

NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
so you must use get_template_directory_uri() if you want to use any of the built in icons
**/

// REMOVE COMMENTS AROUND THIS FUNCTION IF YOU WANT TO PLAY WITH THEME OPTIONS
/*
function dynamic_section($sections) {
    //$sections = array();
    $sections[] = array(
        'title' => __('Section via hook', 'framework'),
        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'framework'),
        'icon' => 'el-icon-paper-clip',
        // Leave this as a blank section, no options just some intro text set above.
        'fields' => array()
    );

    return $sections;
}
*/

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
                'taxonomies' => array('category'),
                'public' => true,
                'has_archive' => true,
                'menu_position' => 5,
                'menu_icon' => 'dashicons-store',
                'hierarchical' => true,
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

if (!class_exists('BusinessServicesFunctionalityTaxonomy')){
    class BusinessServicesFunctionalityTaxonomy{
      function create_functionality_tax() {

        $labels = array(
          'name'                       => 'Functionality',
          'singular_name'              => 'Functionality',
          'menu_name'                  => 'Functionality',
          'all_items'                  => 'All Functionality',
          'parent_item'                => 'Parent Item',
          'parent_item_colon'          => 'Parent Item:',
          'new_item_name'              => 'New Content Types',
          'add_new_item'               => 'Add New Functionality',
          'edit_item'                  => 'Edit Functionality',
          'update_item'                => 'Update Functionality',
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
        register_taxonomy( 'functionality', array( 'post' ), $args );
      }
    }
  }//end class

  if (class_exists("BusinessServicesFunctionalityTaxonomy")){
      $custom_function_tax = new BusinessServicesFunctionalityTaxonomy();
  }
  if (isset($custom_function_tax)){
      //actions
      add_action( 'init', array($custom_function_tax, 'create_functionality_tax'), 0);
  }


/*-----------------------------------------------------------------------------------*/
/*	Remove unnecessary post types
/*-----------------------------------------------------------------------------------*/

function remove_medical_press_theme_features() {
   // remove Movie Custom Post Type
   remove_action( 'init', 'create_doctor_post_type' );
   remove_action( 'init', 'create_gallery_post_type' );
   remove_action( 'init', 'create_testimonial_post_type' );
   remove_action( 'init', 'create_service_post_type' );
}

add_action( 'after_setup_theme', 'remove_medical_press_theme_features', 10 );

/*-----------------------------------------------------------------------------------*/
/*	Remove tags
/*-----------------------------------------------------------------------------------*/

function unregister_taxonomy(){
    register_taxonomy('post_tag', array());
}
add_action('init', 'unregister_taxonomy');


/*-----------------------------------------------------------------------------------*/
/*	Override Parent Theme Breadcrumb
/*-----------------------------------------------------------------------------------*/

if (!function_exists('theme_breadcrumb')) {
    function theme_breadcrumb()
    {

        echo '<ul class="breadcrumb clearfix">';

        /* For all pages other than front page */
        if (!is_front_page()) {
            echo '<li>';
            echo '<a href="' . home_url() . '">' . get_bloginfo('name') . '</a>';
            echo '<span class="divider"></span></li>';
        }

        /* For index.php OR blog posts page */
        if (is_home()) {
            $page_for_posts = get_option('page_for_posts');
            if ($page_for_posts) {
                $blog = get_post($page_for_posts);
                echo '<li>';
                echo $blog->post_title;
                echo '</li>';
            } else {
                echo '<li>';
                _e('Blog', 'framework');
                echo '<li>';
            }
        }

        if (is_category() || is_singular('post')) {
            $category = get_the_category();
            $ID = $category[0]->cat_ID;
            echo '<li>';
            echo get_category_parents($ID, TRUE, ' <span class="divider"></span></li><li>', FALSE);
        }

        if (is_tax('gallery-item-type') || is_tax('department')) {
            $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            if (!empty($current_term->name)) {
                echo '<li class="active">';
                echo $current_term->name;
                echo '</li>';
            }
        }

        if (is_singular('post') || is_singular('business_page') || is_singular('service') || is_singular('gallery-item') || is_page()) {
            global $post;
            $parent_id = $post->post_parent;
            if(  is_page() && $parent_id ){
                $parents = array();
                while ( $parent_id ) {
                    $parents[] = $parent_id;
                    $page = get_post( $parent_id );
                    $parent_id = $page->post_parent;
                }
                $parents_count = count( $parents );
                for( $i = $parents_count; $i > 0; ){
                    $parent_id = $parents[--$i];
                    echo '<li>';
                        echo '<a href="' . get_the_permalink( $parent_id ) . '">' ;
                        echo get_the_title( $parent_id );
                        echo '</a>';
                        echo '<span class="divider"></span>';
                    echo '</li>';
                }
            }

            echo '<li class="active">';
            the_title();
            echo '</li>';
        }

        if (is_tag()) {
            echo '<li>';
            _e('Tag: ', 'framework');
            echo single_tag_title('', FALSE);
            echo '</li>';
        }

        if (is_404()) {
            echo '<li>';
            _e('404 - Page not Found', 'framework');
            echo '</li>';

        }

        if (is_search()) {
            echo '<li>';
            _e('Search', 'framework');
            echo '</li>';
        }

        if (is_year()) {
            echo '</li>';
            echo get_the_time('Y');
            echo '</li>';
        }

        echo "</ul>";

    }
}


/*-----------------------------------------------------------------------------------*/
/*	Register Taxonomy for Media
/*-----------------------------------------------------------------------------------*/
function business_register_taxonomy_for_images() {
    register_taxonomy_for_object_type( 'category', 'attachment' );
}
add_action( 'init', 'business_register_taxonomy_for_images' );


/*-----------------------------------------------------------------------------------*/
/*	Add cateogry filter to Media
/*-----------------------------------------------------------------------------------*/
function business_add_image_category_filter() {
    $screen = get_current_screen();
    if ( 'upload' == $screen->id ) {
        $dropdown_options = array( 'show_option_all' => __( 'View all categories', 'olab' ), 'hide_empty' => false, 'hierarchical' => true, 'orderby' => 'name', );
        wp_dropdown_categories( $dropdown_options );
    }
}
add_action( 'restrict_manage_posts', 'business_add_image_category_filter' );
