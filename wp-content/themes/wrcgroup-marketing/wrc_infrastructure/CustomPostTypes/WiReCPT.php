<?php 
namespace WRCInfrastructure\CustomPostTypes;

class WiReCPT {
    public static function setupWiRe() {
        self::createWiReIssuePostType();
        self::createWirePostPostType();
        self::registerWiReTaxonomy();
        self::createWiReACFFields();
    }

    private static function createWiReIssuePostType() {
        register_post_type('wire',
            array(
                'labels' => array(
                    'name' => __( 'WiRe Issues' ),
                    'singular_name' => __( 'WiRe Issue' ),
                    'menu_name' => __('WiRe Issues'),
                    'name_admin_bar' => __( 'Wire Issue' ),
                    'add_new' => __( 'New Issue' ),
                    'add_new_item' => __( 'Add New Issue' ),
                    'new_item' => __( 'New Issue' ),
                    'edit_item' => __( 'Edit Issue' ),
                    'view_item' => __( 'View Issue' ),
                    'all_items' => __( 'All Issues' ),
                    'search_items' => __( 'Search Issues' ),
                    'not_found' => __( 'No Issues found' ),
                    'not_found_in_trash' => __( 'No Issues found in trash.' ),
                    'archives' => __( 'Issue archives' ),
                    'inster_into_item' => __( 'Insert into Issue' ),
                    'uploaded_to_this_item' => __( 'Uploaded to this Issue' ),
                    'filter_items_list' => __( 'Filter Issues list' ),
                    'items_list_navigation' => __( 'Issues list navigation' ),
                    'items_list' => __( 'Issues list' ),
                ),
                'public' => true,
                'show_in_menu' => true,
                'has_archive' => true,
                'hierarchical' => true,
                'taxonomies' => 'wire-issue-group',
                'rewrite' => array( 'slug' => 'wire' ),
                'menu_icon' => 'dashicons-text-page',
                'supports' => array('editor', 'title', 'thumbnail', 'revisions', 'excerpt')

            )
        );
    }


    private static function createWiRePostPostType() {
        register_post_type('wire-post',
            array(
                'labels' => array(
                    'name' => __( 'WiRe Posts' ),
                    'singular_name' => __( 'WiRe Post' ),
                    'menu_name' => __('WiRe Posts'),
                    'name_admin_bar' => __( 'Wire Post' ),
                    'add_new' => __( 'New WiRe Post' ),
                    'add_new_item' => __( 'Add New WiRe Post' ),
                    'new_item' => __( 'New WiRe Post' ),
                    'edit_item' => __( 'Edit WiRe Post' ),
                    'view_item' => __( 'View WiRe Post' ),
                    'all_items' => __( 'All WiRe Posts' ),
                    'search_items' => __( 'Search WiRe Posts' ),
                    'not_found' => __( 'No WiRe Posts found' ),
                    'not_found_in_trash' => __( 'No WiRe Posts found in trash.' ),
                    'archives' => __( 'WiRe Post archives' ),
                    'inster_into_item' => __( 'Insert into WiRe Post' ),
                    'uploaded_to_this_item' => __( 'Uploaded to this WiRe Post' ),
                    'filter_items_list' => __( 'Filter WiRe Posts list' ),
                    'items_list_navigation' => __( 'WiRe Posts list navigation' ),
                    'items_list' => __( 'WiRe Posts list' ),
                ),
                'public' => true,
                'show_in_menu' => 'edit.php?post_type=wire',
                'has_archive' => false,
                'hierarchical' => false,
                'taxonomies' => 'wire-issue-group',
                'supports' => array('editor', 'title', 'thumbnail', 'revisions', 'excerpt')

            )
        );
    }

    public static function registerWiReTaxonomy() {
        $args = array (
            'labels' => array(
              'name' => 'Issue Groups',
              'singular_name' => 'Issue Group',
              'all_items' => 'Issue Groups',
              'edit_item' => 'Edit Issue Groups',
              'view_item' => 'View Issue Group',
              'update_item' => 'Update Issue Group',
              'add_new_item' => 'Add Issue Group',
            ),
            'description' => 'Group WiRe Issue Posts and Issues together.',
            'public' => false,
            'show_ui' => true,
            'hierarchical' => false,
            'rewrite' => false,
            'capabilities' => array(
              'manage_terms', 'edit_terms', 'delete_terms', 'assign_terms'
            ),
      
          );
        register_taxonomy('wire-issue-group', array('wire', 'wire-post'), $args);
    }

    public static function createWiReACFFields() {
        if( function_exists('acf_add_local_field_group') ):

            acf_add_local_field_group(array(
                'key' => 'group_5dcd7ec384784',
                'title' => 'WiRe President\'s Message',
                'fields' => array(
                    array(
                        'key' => 'field_5dcd7eca3ad74',
                        'label' => 'President\'s Message',
                        'name' => 'wire_post_presidents_message',
                        'type' => 'checkbox',
                        'instructions' => 'Select if this post is for the president\'s message.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'Presidents Message' => 'Presidents Message',
                        ),
                        'allow_custom' => 0,
                        'default_value' => array(
                        ),
                        'layout' => 'horizontal',
                        'toggle' => 0,
                        'return_format' => 'value',
                        'save_custom' => 0,
                    ),
                    array(
                        'key' => 'field_5dcd7f303ad75',
                        'label' => 'President Message Title',
                        'name' => 'wire_president_message_title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5dcd7eca3ad74',
                                    'operator' => '==',
                                    'value' => 'Presidents Message',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 'The President\'s Message',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5dcd7f9e3ad76',
                        'label' => 'President Message Text',
                        'name' => '',
                        'type' => 'message',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5dcd7eca3ad74',
                                    'operator' => '==',
                                    'value' => 'Presidents Message',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => 'Use the WordPress content area below for the message.',
                        'new_lines' => 'wpautop',
                        'esc_html' => 0,
                    ),
                    array(
                        'key' => 'field_5dcd7fc73ad77',
                        'label' => 'President Message Image',
                        'name' => 'wire_president_message_image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5dcd7eca3ad74',
                                    'operator' => '==',
                                    'value' => 'Presidents Message',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                    array(
                        'key' => 'field_5dcd7ff13ad78',
                        'label' => 'President Message Name',
                        'name' => 'wire_president_message_name',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5dcd7eca3ad74',
                                    'operator' => '==',
                                    'value' => 'Presidents Message',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 'Terry Wendorff',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5dcd801a3ad79',
                        'label' => 'President Message Job Title',
                        'name' => 'wire_president_message_job_title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5dcd7eca3ad74',
                                    'operator' => '==',
                                    'value' => 'Presidents Message',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 'President & Chief Executive Officer',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'wire-post',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'acf_after_title',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));
            
            acf_add_local_field_group(array(
                'key' => 'group_5dcd7cbe0e833',
                'title' => 'WiRe Issue Fields',
                'fields' => array(
                    array(
                        'key' => 'field_5dcd7ce267403',
                        'label' => 'President Message',
                        'name' => 'wire_president_message',
                        'type' => 'post_object',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'post_type' => array(
                            0 => 'wire-post',
                        ),
                        'taxonomy' => '',
                        'allow_null' => 0,
                        'multiple' => 0,
                        'return_format' => 'object',
                        'ui' => 1,
                    ),
                    array(
                        'key' => 'field_5dcd7d9f9c796',
                        'label' => 'WiRe Posts',
                        'name' => 'wire_posts',
                        'type' => 'relationship',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'post_type' => array(
                            0 => 'wire-post',
                        ),
                        'taxonomy' => '',
                        'filters' => array(
                            0 => 'search',
                            1 => 'post_type',
                        ),
                        'elements' => '',
                        'min' => '',
                        'max' => '',
                        'return_format' => 'object',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'wire',
                        ),
                    ),
                ),
                'menu_order' => 1,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => array(
                    0 => 'the_content',
                ),
                'active' => true,
                'description' => '',
            ));


            acf_add_local_field_group(array(
                'key' => 'group_5deaa231c012d',
                'title' => 'WiRe Post Thumbnail',
                'fields' => array(
                    array(
                        'key' => 'field_5deaa23a1b55a',
                        'label' => 'WiRe Post Thumbnail',
                        'name' => 'wire_post_thumbnail',
                        'type' => 'image',
                        'instructions' => 'Leave blank if president\'s message. Used in conjunction with feature image.

            This image should be a square with minimum size 350px x 350px.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'wire-post',
                        ),
                    ),
                ),
                'menu_order' => 2,
                'position' => 'acf_after_title',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));
            
            endif;
    }


}