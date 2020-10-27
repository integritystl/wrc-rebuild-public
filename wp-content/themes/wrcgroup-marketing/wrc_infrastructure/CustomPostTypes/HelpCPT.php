<?php
namespace WRCInfrastructure\CustomPostTypes;

class HelpCPT {

	public static function setupHelp() {
		self::createHelpPostType();
		self::setHelpACF();
	}

	public static function createHelpPostType() {
		register_post_type( 'help',
			array(
				'labels' => array(
		          'name' => __( 'Help' ),
		          'singular_name' => __( 'Help' ),
		          'add_new_item' => __('Add New Help'),
		          'edit_item' => __('Edit Help')
		        ),
		        'show_ui' => true,
		        'show_in_nav_menus' => false,
		        'show_in_menu' => true,
		        'show_in_rest' => true,
		        'has_archive' => false,
						'exclude_from_search' => true,
						'publicly_queryable' => false,
		        'menu_icon' => 'dashicons-welcome-learn-more',
		        'menu_position' => 20,
		        'supports' => array('page-attributes', 'title')
			)
		);
	}

	public static function setHelpACF() {
		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array (
				'key' => 'group_59d652d87a82e',
				'title' => 'Help',
				'fields' => array (
					array (
						'key' => 'field_59d652dc19e07',
						'label' => 'Label/Question',
						'name' => 'label_question',
						'type' => 'text',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array (
						'key' => 'field_59d652ed19e08',
						'label' => 'Answer',
						'name' => 'answer',
						'type' => 'wysiwyg',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 1,
						'delay' => 0,
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'help',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => array (
					0 => 'the_content',
					1 => 'categories',
					2 => 'tags',
				),
				'active' => 1,
				'description' => '',
			));

			endif;
	}
}
