<?php
namespace WRCInfrastructure\CustomPostTypes;

class MutualCPT{

  public static function setupMutuals(){
    self::createMutualPostType();
  }

  private static function createMutualPostType(){
    register_post_type( 'mutual',
      array(
        'labels' => array(
          'name' => __( 'Mutuals' ),
          'singular_name' => __( 'Mutual' ),
          'add_new_item' => __('Add New Mutual'),
          'edit_item' => __('Edit Mutual')
        ),
        'show_ui' => true,
        'show_in_nav_menus' => false,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-building',
        'menu_position' => 20,
        'supports' => array('page-attributes', 'title')
      )
    );
  }
}