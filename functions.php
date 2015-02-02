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



function remove_medical_press_theme_features() {
   // remove Movie Custom Post Type
   remove_action( 'init', 'create_doctor_post_type' );
   remove_action( 'init', 'create_gallery_post_type' );
}

add_action( 'after_setup_theme', 'remove_medical_press_theme_features', 10 );
