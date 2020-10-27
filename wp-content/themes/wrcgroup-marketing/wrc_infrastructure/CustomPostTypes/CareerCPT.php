<?php
namespace WRCInfrastructure\CustomPostTypes;

class CareerCPT{

  public static function setupCareers(){
    self::createCareerPostType();
  }

  private static function createCareerPostType(){
    register_post_type( 'career',
      array(
        'labels' => array(
          'name' => __( 'Careers' ),
          'singular_name' => __( 'Career' ),
          'add_new_item' => __('Add New Career'),
          'edit_item' => __('Edit Career'),
          'new_item' => __('New Career'),
          'view_item' => __('View Career')
        ),
        'menu_icon' => 'dashicons-id',
        'show_ui' => true,
        'show_in_nav_menus' => false,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'taxonomies' => array('career-site'),
        'menu_position' => 20,
        'supports' => array('page-attributes', 'title', 'editor', 'revisions')
      )
    );
  }
}
