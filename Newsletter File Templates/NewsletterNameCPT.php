<?php 
namespace WRCInfrastructure\CustomPostTypes;

class NewsletterNameCPT {
    public static function setupNewsletterName() {
        self::createNewsletterNameIssuePostType();
        self::createNewsletterNamePostPostType();
        self::registerNewsletterNameTaxonomy();
        self::createNewsletterNameACFFields();
    }

    private static function createNewsletterNameIssuePostType() {
        register_post_type('newsletter-name',
            array(
                'labels' => array(
                    'name' => __( 'Newsletter Name Issues' ),
                    'singular_name' => __( 'Newsletter Name Issue' ),
                    'menu_name' => __('Newsletter Name Issues'),
                    'name_admin_bar' => __( 'Newsletter Name Issue' ),
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
                'taxonomies' => 'newsletter-name-issue-group',
                'rewrite' => array( 'slug' => 'newsletter-name' ),
                'menu_icon' => 'dashicons-text-page',
                'supports' => array('editor', 'title', 'thumbnail', 'revisions', 'excerpt')

            )
        );
    }


    private static function createNewsletterNamePostPostType() {
        register_post_type('newsletter-name-post',
            array(
                'labels' => array(
                    'name' => __( 'Newsletter Name Posts' ),
                    'singular_name' => __( 'Newsletter Name Post' ),
                    'menu_name' => __('Newsletter Name Posts'),
                    'name_admin_bar' => __( 'Newsletter Name Post' ),
                    'add_new' => __( 'New Newsletter Name Post' ),
                    'add_new_item' => __( 'Add New Newsletter Name Post' ),
                    'new_item' => __( 'New Newsletter Name Post' ),
                    'edit_item' => __( 'Edit Newsletter Name Post' ),
                    'view_item' => __( 'View Newsletter Name Post' ),
                    'all_items' => __( 'All Newsletter Name Posts' ),
                    'search_items' => __( 'Search Newsletter Name Posts' ),
                    'not_found' => __( 'No Newsletter Name Posts found' ),
                    'not_found_in_trash' => __( 'No Newsletter Name Posts found in trash.' ),
                    'archives' => __( 'Newsletter Name Post archives' ),
                    'inster_into_item' => __( 'Insert into Newsletter Name Post' ),
                    'uploaded_to_this_item' => __( 'Uploaded to this Newsletter Name Post' ),
                    'filter_items_list' => __( 'Filter Newsletter Name Posts list' ),
                    'items_list_navigation' => __( 'Newsletter Name Posts list navigation' ),
                    'items_list' => __( 'Newsletter Name Posts list' ),
                ),
                'public' => true,
                'show_in_menu' => 'edit.php?post_type=newsletter-name',
                'has_archive' => false,
                'hierarchical' => false,
                'taxonomies' => 'wrcagency-newsletter-issue-group',
                'supports' => array('editor', 'title', 'thumbnail', 'revisions', 'excerpt')

            )
        );
    }

    public static function registerNewsletterNameTaxonomy() {
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
            'description' => 'Group Newsletter Name Issue Posts and Issues together.',
            'public' => false,
            'show_ui' => true,
            'hierarchical' => false,
            'rewrite' => false,
            'capabilities' => array(
              'manage_terms', 'edit_terms', 'delete_terms', 'assign_terms'
            ),
      
          );
        register_taxonomy('newsletter-name-issue-group', array('newsletter-name', 'newsletter-name-post'), $args);
    }

    public static function createNewsletterNameACFFields() {
        if( function_exists('acf_add_local_field_group') ):
            
            acf_add_local_field_group(array(
                'key' => 'group_5dcd7cbadi1234',
                'title' => 'Newsletter Name Issue Fields',
                'fields' => array(
                    array(
                        'key' => 'field_5dcd7d9f23sljd',
                        'label' => 'Newsletter Name Posts',
                        'name' => 'newsletter_name_posts',
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
                            0 => 'newsletter-name-post',
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
                            'value' => 'newsletter-name',
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
                'key' => 'group_5deaa7slje',
                'title' => 'Newsletter Name Post Thumbnail',
                'fields' => array(
                    array(
                        'key' => 'field_5deaa20912342fds',
                        'label' => 'Newsletter Name Post Thumbnail',
                        'name' => 'newsletter_name_post_thumbnail',
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
                            'value' => 'newsletter-name-post',
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