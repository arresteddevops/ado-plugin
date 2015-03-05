<?php
   /*
   Plugin Name: Arrested DevOps Episodes
   Plugin URI: http://www.arresteddevops.com.com
   Description: Creates custom post types for ADO Episode
   Version: 1.2
   Author: Matt Stratton
   Author URI: http://mattstratton.com
   License: GPL2
   */

   // Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'ado_flush_rewrite_rules' );

// Flush your rewrite rules
function ado_flush_rewrite_rules() {
  flush_rewrite_rules();
}

function ado_episode() { 
// creating (registering) the custom type 
register_post_type( 'ado_episode', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
  // let's now add all the options for this post type
  array( 'labels' => array(
    'name' => __( 'Episodes', 'ado' ), /* This is the Title of the Group */
    'singular_name' => __( 'Episode', 'ado' ), /* This is the individual type */
    'all_items' => __( 'All Episodes', 'ado' ), /* the all items menu item */
    'add_new' => __( 'Add New', 'ado' ), /* The add new menu item */
    'add_new_item' => __( 'Add New Episode', 'ado' ), /* Add New Display Title */
    'edit' => __( 'Edit', 'ado' ), /* Edit Dialog */
    'edit_item' => __( 'Edit Episodes', 'ado' ), /* Edit Display Title */
    'new_item' => __( 'New Episode', 'ado' ), /* New Display Title */
    'view_item' => __( 'View Episode', 'ado' ), /* View Display Title */
    'search_items' => __( 'Search Episode', 'ado' ), /* Search Custom Type Title */ 
    'not_found' =>  __( 'No episodes found', 'ado' ), /* This displays if there are no entries yet */ 
    'not_found_in_trash' => __( 'Nothing found in Trash', 'ado' ), /* This displays if there is nothing in the trash */
    'parent_item_colon' => ''
    ), /* end of arrays */
    'description' => __( 'An episode of the ADO Podcast', 'ado' ), /* Custom Type Description */
    'public' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'show_ui' => true,
    'query_var' => true,
    'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
    'menu_icon' => get_stylesheet_directory_uri() . '/library/images/ado-episode-icon.png', /* the icon for the custom post type menu */
    'rewrite' => array( 'slug' => 'episodes', 'with_front' => false ), /* you can specify its url slug */
    'has_archive' => 'episodes', /* you can rename the slug here */
    'capability_type' => 'post',
    'hierarchical' => false,
    /* the next one is important, it tells what's enabled in the post editor */
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions')
  ) /* end of options */
); /* end of register post type */

/* this adds your post categories to your custom post type */
register_taxonomy_for_object_type( 'category', 'episode' );
/* this adds your post tags to your custom post type */
register_taxonomy_for_object_type( 'post_tag', 'episode' );

}

  // adding the function to the Wordpress init
  add_action( 'init', 'ado_episode');


 // Metaboxes code
 
 if ( file_exists(  plugin_dir_path( '/cmb2/init.php' ) ) ) {
  require_once  plugin_dir_path( '/cmb2/init.php' );
} elseif ( file_exists(  plugin_dir_path( '/CMB2/init.php') ) ) {
  require_once  plugin_dir_path( '/CMB2/init.php' );
}

add_filter( 'cmb2_meta_boxes', 'cmb2_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_sample_metaboxes( array $meta_boxes ) {

  // Start with an underscore to hide fields from custom fields list
  $prefix = '_cmb2_';

  $meta_boxes['episode_metabox'] = array(
    'id'            => 'episode_metabox',
    'title'         => __( 'Episode Information', 'cmb2'),
    'object_types'  => array('ado_episode', ),
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true,
    'fields'        => array(
        array(
          'name' => __( 'Episode Number', 'cmb2' ),
          'desc' => 'The episode number. DO NOT INCLUDE SPACES OR DASHES',
          'id'   => $prefix . 'ado_episode_number',
          'type' => 'textarea_small',
        ),
        array(
          'name'    => __( 'Summary', 'cmb2' ),
          'desc'    => __( 'A one paragraph summary of the episode. Used in podcast summary, feed, and also on the short display on the homepage', 'cmb2' ),
          'id'      => $prefix . 'ado_summary',
          'type'    => 'wysiwyg',
          'options' => array( 'textarea_rows' => 10, ),
      ), 
        array(
          'name'    => __( 'Show Notes', 'cmb2' ),
          'desc'    => __( 'All of the show notes. Go crazy.', 'cmb2' ),
          'id'      => $prefix . 'ado_show_notes',
          'type'    => 'wysiwyg',
          'options' => array( 'textarea_rows' => 10, ),
      ),                     
        array(
          'name'    => __( 'Check Outs', 'cmb2' ),
          'desc'    => __( 'Check outs for each person. You will have to write the UL list stuff by hand for now', 'cmb2' ),
          'id'      => $prefix . 'ado_checkouts',
          'type'    => 'wysiwyg',
          'options' => array( 'textarea_rows' => 5, ),
        ),
        array(
          'name'    => __( 'Sponsor 1 Text', 'cmb2' ),
          'desc'    => __( 'The text for Sponsor 1 ad. Please make sure to include inline links!', 'cmb2' ),
          'id'      => $prefix . 'ado_sponsor_1_text',
          'type'    => 'wysiwyg',
          'options' => array( 'textarea_rows' => 5, ),
        ),
        array(
          'name' => __( 'Sponsor 1 Banner', 'cmb2' ),
          'desc' => __( 'Upload the banner image for Sponsor 1 for this episode (you can also choose it from one already uploaded)', 'cmb2' ),
          'id'   => $prefix . 'sponsor_1_banner',
          'type' => 'file',
        ),
        array(
          'name' => __( 'Sponsor 1 URL', 'cmb2' ),
          'id'   => $prefix . 'ado_sponsor_1_url',
          'type' => 'text_url',
          // 'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
        ),
        array(
          'name'    => __( 'Sponsor 2 Text', 'cmb2' ),
          'desc'    => __( 'The text for Sponsor 2 ad. Please make sure to include inline links!', 'cmb2' ),
          'id'      => $prefix . 'ado_sponsor_2_text',
          'type'    => 'wysiwyg',
          'options' => array( 'textarea_rows' => 5, ),
        ),
        array(
          'name' => __( 'Sponsor 2 Banner', 'cmb2' ),
          'desc' => __( 'Upload the banner image for Sponsor 2 for this episode (you can also choose it from one already uploaded)', 'cmb2' ),
          'id'   => $prefix . 'ado_sponsor_2_banner',
          'type' => 'file',
        ),
        array(
          'name' => __( 'Sponsor 2 URL', 'cmb2' ),
          'id'   => $prefix . 'ado_sponsor_2_url',
          'type' => 'text_url',
          // 'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
        ),
    ),
  );
  return $meta_boxes;
}

// Needed to allow line breaks in user bios
remove_filter('pre_user_description', 'wp_filter_kses');
add_filter('pre_user_description', 'wp_filter_post_kses');
add_filter('pre_user_description', 'wptexturize');
add_filter('pre_user_description', 'wpautop');
add_filter('pre_user_description', 'convert_chars');
add_filter('pre_user_description', 'balanceTags', 50);

?>