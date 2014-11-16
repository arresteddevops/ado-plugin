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
?>