<?php
namespace WRCInfrastructure\CustomPostTypes;

class SiteCPT{

  public static function setupSites(){
    self::createSitePostType();
    self::createSiteFields();
  }

  private static function createSitePostType(){
    register_post_type( 'site',
      array(
        'labels' => array(
          'name' => __( 'Sites' ),
          'singular_name' => __( 'Site' )
        ),
        'show_ui' => true,
        'show_in_nav_menus' => false,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-admin-site',
        'menu_position' => 20,
        'supports' => array('page-attributes', 'title')
      )
    );
  }

  private static function createSiteFields(){
    if( function_exists('acf_add_local_field_group') ){
      acf_add_local_field_group(array(
        'key' => 'group_sites',
        'title' => 'Site Options',
        'fields' => array (
          array (
            'key' => 'field_site_top_menu',
            'label' => 'Top Menu',
            'name' => 'top_menu',
            'type' => 'nav_menu',
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_site_footer_menu',
            'label' => 'Footer Menu',
            'name' => 'footer_menu',
            'type' => 'nav_menu',
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_site_landing_page',
            'label' => 'Landing Page',
            'name' => 'landing_page',
            'allow_archives' => false,
            'type' => 'page_link',
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_site_logo',
            'label' => 'Logo',
            'name' => 'site_logo',
            'type' => 'image',
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_site_favicon',
            'label' => 'Favicon',
            'name' => 'site_favicon',
            'type' => 'image',
            'instructions' => 'This image is used by browsers to add an icon onto the window tab.',
            'wrapper' => array (
              'width' => '50',
            ),
          ),
          array (
            'post_type' => array (
              0 => 'page',
            ),
            'taxonomy' => array (
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'allow_archives' => 1,
            'key' => 'field_site_news_link',
            'label' => 'News Link',
            'name' => 'site_news_link',
            'type' => 'page_link',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_site_post_tax_link',
            'label' => 'Post Site Taxonomy',
            'name' => 'post_site_taxonomy',
            'type' => 'taxonomy',
            'taxonomy' => 'post-site',
            'field_type' => 'select',
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'post_type' => array (
              0 => 'page',
            ),
            'taxonomy' => array (
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'allow_archives' => 1,
            'key' => 'field_site_help_link',
            'label' => 'Help Link',
            'name' => 'site_help_link',
            'type' => 'page_link',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_site_career_tax_link',
            'label' => 'Career Site Taxonomy',
            'name' => 'career_site_taxonomy',
            'type' => 'taxonomy',
            'taxonomy' => 'career-site',
            'field_type' => 'select',
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'post_type' => array (
              0 => 'page',
            ),
            'taxonomy' => array (
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'allow_archives' => 0,
            'key' => 'field_site_careers_link',
            'label' => 'Careers Link',
            'name' => 'site_careers_link',
            'type' => 'page_link',
            'instructions' => 'This is used to link the homepage careers button to the Careers page.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_site_events_page',
            'label' => 'Events Page',
            'name' => 'site_events_page',
            'post_type' => 'page',
            'allow_archives' => false,
            'allow_null' => 1, // In case a Site doesn't have any events
            'type' => 'post_object',
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_site_phone',
            'label' => 'Phone Number',
            'name' => 'site_phone',
            'type' => 'text',
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
        ),
        'location' => array (
          array (
            array (
              'param' => 'post_type',
              'operator' => '==',
              'value' => 'site',
            ),
          ),
        ),
      ));
    }
  }
}
