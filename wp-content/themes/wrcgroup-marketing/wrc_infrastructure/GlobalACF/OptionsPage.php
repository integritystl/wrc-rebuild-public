<?php
namespace WRCInfrastructure\GlobalACF;

class OptionsPage
{
  public static function setupACFOptionsPage() {
    self::addOptionsPages();
    self::mainOptionsPage();
  }

  private static function mainOptionsPage() {
    if( function_exists('acf_add_local_field_group') ){
      acf_add_local_field_group(array (
        'key' => 'group_global_options',
        'title' => 'Global Settings',
        'fields' => array (
          array (
            'placement' => 'top',
            'endpoint' => 0,
            'key' => 'field_settings_announcement_tab',
            'label' => 'Emergency Announcement',
            'name' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_settings_announcement_enabled',
            'label' => 'Announcement Enabled',
            'name' => 'announcements_enabled',
            'type' => 'true_false',
            'instructions' => 'When enabled, this announcement appears in the header of the site until a user dismisses it.',
            'message' => '',
            'default_value' => 0,
          ),
          array (
    				'key' => 'field_settings_announcement_header',
    				'label' => 'Announcement Header',
    				'name' => 'announcement_header',
    				'type' => 'text',
    				'default_value' => '',
    				'placeholder' => '',
    				'prepend' => '',
    				'append' => '',
    				'formatting' => 'html',
    				'maxlength' => '',
    			),
    			array (
    				'key' => 'field_settings_announcement_text',
    				'label' => 'Announcement Text',
    				'name' => 'announcement_text',
    				'type' => 'text',
    				'default_value' => '',
    				'placeholder' => '',
    				'prepend' => '',
    				'append' => '',
    				'formatting' => 'html',
    				'maxlength' => '',
    			),
    			array (
    				'key' => 'field_settings_announcement_refresh_time',
    				'label' => 'Announcement Refresh Time',
    				'name' => 'announcement_refresh_time',
    				'type' => 'number',
    				'instructions' => 'Time (in minutes) before the announcement banner cookie expires. Defaults to 60.',
    				'default_value' => '',
    				'placeholder' => '',
    				'prepend' => '',
    				'append' => '',
    				'min' => '',
    				'max' => '',
    				'step' => '',
    			),

          array (
            'placement' => 'top',
            'endpoint' => 0,
            'key' => 'field_settings_header_tab',
            'label' => 'Header',
            'name' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_top_menu_logo',
            'label' => 'WRC Group Logo',
            'name' => 'wrc_group_logo',
            'type' => 'image',
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_site_default',
            'label' => 'Default Site',
            'name' => 'site_default',
            'instructions' => 'This Site will be used as a default if none is set elsewhere. Helps with global navigation of the site.',
            'type' => 'post_object',
            'post_type' => 'site',
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_secure_email_url',
            'label' => 'Secure Email URL',
            'name' => 'secure_email_url',
            'instructions' => 'This link outputs in the Header.',
            'type' => 'url',
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_portal_url',
            'label' => 'Portal URL',
            'name' => 'portal_url',
            'instructions' => 'This link outputs in the Header.',
            'type' => 'url',
            'wrapper' => array (
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'placement' => 'top',
            'endpoint' => 0,
            'key' => 'field_settings_modal_tab',
            'label' => 'Modal',
            'name' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_modal_help_text',
            'label' => 'Modal Window Help Text',
            'name' => 'modal_help_text',
            'type' => 'wysiwyg',
            'instructions' => 'The helper text that appears with the Pay Bill modal.',
            'media_upload' => 0,
          ),
          // array (
          //   'key' => 'field_first-otto-link',
          //   'label' => '1st Otto Policy Holder Link',
          //   'name' => '1st-otto-policy-link',
          //   'type' => 'url',
          // ),
          array (
            'key' => 'field_first-otto-agent-link',
            'label' => '1st Otto Agent Link',
            'name' => '1st-otto-agent-link',
            'type' => 'url',
          ),
          array (
            'placement' => 'top',
            'endpoint' => 0,
            'key' => 'field_settings_404_tab',
            'label' => '404 Page',
            'name' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
          ),
          array (
            'key' => 'field_404_content',
            'label' => '404 Content',
            'name' => '404_content',
            'type' => 'wysiwyg',
            'instructions' => '',
            'media_upload' => 0,
          ),
          array (
      			'placement' => 'top',
      			'endpoint' => 0,
      			'key' => 'field_settings_footer_tab',
      			'label' => 'Footer',
      			'name' => '',
      			'type' => 'tab',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array (
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      		),
          array (
            'key' => 'field_linkedin_url',
            'label' => 'Footer LinkedIn URL',
            'name' => 'footer_linkedin',
            'type' => 'url',
          ),
          array (
              'key' => 'field_facebook_url',
              'label' => 'Footer Facebook URL',
              'name' => 'footer_facebook',
              'type' => 'url',
          ),
          array (
              'key' => 'field_twittern_url',
              'label' => 'Footer Twitter URL',
              'name' => 'footer_twitter',
              'type' => 'url',
          ),
        ),
        'location' => array (
          array (
            array (
              'param' => 'options_page',
              'operator' => '==',
              'value' => 'global_settings',
            ),
          ),
        )
      ));
    }
  }
  private static function addOptionsPages() {
    if( function_exists('acf_add_options_page') ){
      acf_add_options_page(array(
        'page_title'    => 'Global Settings Page',
        'menu_title'    => 'Global Settings',
        'menu_slug'     => 'global_settings',
        'redirect'      => false,
        'capability'    => 'manage_options'
      ));
    }
  }
}
