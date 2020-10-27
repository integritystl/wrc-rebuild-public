<?php 
namespace WRCInfrastructure\CustomPostTypes;

class MutualManagerCPT {
    public static function setupMutualManager() {
        self::createMutualManagerIssuePostType();
        self::createMutualManagerPostPostType();
        self::registerMutualManagerTaxonomy();
        self::createMutualManagerACFFields();
    }

    private static function createMutualManagerIssuePostType() {
        register_post_type('mutual-manager',
            array(
                'labels' => array(
                    'name' => __( 'Mutual Manager Issues' ),
                    'singular_name' => __( 'Mutual Manager Issue' ),
                    'menu_name' => __('Mutual Manager Issues'),
                    'name_admin_bar' => __( 'Mutual Manager Issue' ),
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
                'taxonomies' => 'mutual-manager-issue-group',
                'rewrite' => array( 'slug' => 'mutual-manager' ),
                'menu_icon' => 'dashicons-text-page',
                'supports' => array('editor', 'title', 'thumbnail', 'revisions', 'excerpt')

            )
        );
    }


    private static function createMutualManagerPostPostType() {
        register_post_type('mutual-manager-post',
            array(
                'labels' => array(
                    'name' => __( 'Mutual Manager Posts' ),
                    'singular_name' => __( 'Mutual Manager Post' ),
                    'menu_name' => __('Mutual Manager Posts'),
                    'name_admin_bar' => __( 'Mutual Manager Post' ),
                    'add_new' => __( 'New Mutual Manager Post' ),
                    'add_new_item' => __( 'Add New Mutual Manager Post' ),
                    'new_item' => __( 'New Mutual Manager Post' ),
                    'edit_item' => __( 'Edit Mutual Manager Post' ),
                    'view_item' => __( 'View Mutual Manager Post' ),
                    'all_items' => __( 'All Mutual Manager Posts' ),
                    'search_items' => __( 'Search Mutual Manager Posts' ),
                    'not_found' => __( 'No Mutual Manager Posts found' ),
                    'not_found_in_trash' => __( 'No Mutual Manager Posts found in trash.' ),
                    'archives' => __( 'Mutual Manager Post archives' ),
                    'inster_into_item' => __( 'Insert into Mutual Manager Post' ),
                    'uploaded_to_this_item' => __( 'Uploaded to this Mutual Manager Post' ),
                    'filter_items_list' => __( 'Filter Mutual Manager Posts list' ),
                    'items_list_navigation' => __( 'Mutual Manager Posts list navigation' ),
                    'items_list' => __( 'Mutual Manager Posts list' ),
                ),
                'public' => true,
                'show_in_menu' => 'edit.php?post_type=mutual-manager',
                'has_archive' => false,
                'hierarchical' => false,
                'taxonomies' => 'mutual-manager-issue-group',
                'supports' => array('editor', 'title', 'thumbnail', 'revisions', 'excerpt')

            )
        );
    }

    public static function registerMutualManagerTaxonomy() {
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
            'description' => 'Group Mutual Manager Issue Posts and Issues together.',
            'public' => false,
            'show_ui' => true,
            'hierarchical' => false,
            'rewrite' => false,
            'capabilities' => array(
              'manage_terms', 'edit_terms', 'delete_terms', 'assign_terms'
            ),
      
          );
        register_taxonomy('mutual-manager-issue-group', array('mutual-manager', 'mutual-manager-post'), $args);
    }

    public static function createMutualManagerACFFields() {
        if( function_exists('acf_add_local_field_group') ):
            
            acf_add_local_field_group(array(
                'key' => 'group_5dcd7cbadijh345',
                'title' => 'Mutual Manager Issue Fields',
                'fields' => array(
                    array(
                        'key' => 'field_5dcd7d9f92kj3',
                        'label' => 'Mutual Manager Posts',
                        'name' => 'm_manager_posts',
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
                            0 => 'mutual-manager-post',
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
                            'value' => 'mutual-manager',
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
                'key' => 'group_5deaa2378293k',
                'title' => 'Mutual Manager Post Thumbnail',
                'fields' => array(
                    array(
                        'key' => 'field_5deaa20918234l',
                        'label' => 'Mutual Manager Post Thumbnail',
                        'name' => 'm_manager_post_thumbnail',
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
                            'value' => 'mutual-manager-post',
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