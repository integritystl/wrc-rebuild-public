<?php
namespace WRCInfrastructure\CustomPostTypes;

class AgentCPT{

  public static function setupAgents(){
    self::createAgentPostType();
    self::createAgentFields();
  }

  private static function createAgentPostType(){
    register_post_type( 'agent',
      array(
        'labels' => array(
          'name' => __( 'Agencies' ),
          'singular_name' => __( 'Agency' ),
          'add_new_item' => __('Add New Agency'),
          'edit_item' => __('Edit Agency')
        ),
        'show_ui' => true,
        'show_in_nav_menus' => false,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-businessman',
        'menu_position' => 20,
        'supports' => array('page-attributes', 'title')
      )
    );
  }

  private static function createAgentFields(){
    if( function_exists('acf_add_local_field_group') ){
      acf_add_local_field_group(array(
        'key' => 'group_agent',
        'title' => 'Agent/Mutual Details',
        'fields' => array (
          array (
            'key' => 'field_agent_manager',
            'label' => 'Manager Name',
            'name' => 'agent_manager',
            'type' => 'text',
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_agent_manager_email',
            'label' => 'Manager Email',
            'name' => 'agent_manager_email',
            'type' => 'email',
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_agent_address',
            'label' => 'Street Address',
            'name' => 'agent_address',
            'type' => 'textarea',
            'new_lines' => 'br',
            'rows' => '4',
            'required' => 1,
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_agent_website',
            'label' => 'Website',
            'name' => 'agent_website',
            'type' => 'url',
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_agent_city',
            'label' => 'City',
            'name' => 'agent_city',
            'type' => 'text',
            'required' => 1,
            'wrapper' => array (
              'width' => '25',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_agent_state',
            'label' => 'State',
            'name' => 'agent_state',
            'type' => 'select',
            'allow_null' => 1,
            'required' => 1,
            'choices' => array(
              'AR'	=> 'Arkansas',
              'IL'	=> 'Illinois',
              'IA'	=> 'Iowa',
              'MO'	=> 'Missouri',
              'SD'	=> 'South Dakota',
              'WI'	=> 'Wisconsin'
            ),
            'wrapper' => array (
              'width' => '25',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_agent_zip',
            'label' => 'Zip',
            'name' => 'agent_zip',
            'type' => 'text',
            'required' => 1,
            'wrapper' => array (
              'width' => '25',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_agent_phone',
            'label' => 'Phone Number',
            'name' => 'agent_phone',
          //  'instructions' => 'Format of (###) ###-#### ',
            'type' => 'text',
            'wrapper' => array (
              'width' => '25',
              'class' => '',
              'id' => 'custom-phone-input',
            ),
          ),
          array (
            'key' => 'field_agent_other_state',
            'label' => 'Other States of Business',
            'name' => 'agent_other_state',
            'type' => 'checkbox',
            'layout' => 'horizontal',
            'instructions' => 'Select an additional state of business, if applicable.',
            'allow_null' => 1,
            'choices' => array(
              'AR'	=> 'Arkansas',
              'IL'	=> 'Illinois',
              'IA'	=> 'Iowa',
              'MO'	=> 'Missouri',
              'SD'	=> 'South Dakota',
              'WI'	=> 'Wisconsin'
            ),
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
          ),
          array(
            'key' => 'field_agent_lat',
            'label' => 'Latitude',
            'name' => 'agent_lat',
            'type' => 'text',
            'readonly' => 1,
            'instructions' => 'This value saves from the Address, City and Zip fields after saving and updates automatically. Used for our Distance filter.',
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array(
            'key' => 'field_agent_long',
            'label' => 'Longitude',
            'name' => 'agent_long',
            'type' => 'text',
            'readonly' => 1,
            'instructions' => 'This value saves from the Address, City and Zip fields after saving and updates automatically. Used for our Distance filter.',
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
              'value' => 'agent',
            ),
          ),
           array (
            array (
              'param' => 'post_type',
              'operator' => '==',
              'value' => 'mutual',
            ),
          ),
        ),
      ));
    }
  }
}
