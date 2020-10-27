<?php
namespace WRCInfrastructure\CustomTaxonomies;

class postTaxonomies {

  public static function setupPostTaxonomies() {
    self::createSiteTaxonomy();
  }

  private static function createSiteTaxonomy() {
    $labels = array (
      'name' => 'Post Sites',
      'singular_name' => 'Post Site',
      'search_items' => 'Search Post Sites',
      'all_items' => 'All Post Sites',
      'update_item' => 'Update Post Site',
      'edit_item' => 'Edit Post Site',
      'add_new_item' => 'Add New Post Site',
      'new_item_name' => 'New Post Site Name',
      'menu_name' => 'Post Site'
    );

    $args = array (
      'hierarchical' => true,
      'labels' => $labels,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'post-site')
    );

    register_taxonomy('post-site', array('post'), $args);
  }
}