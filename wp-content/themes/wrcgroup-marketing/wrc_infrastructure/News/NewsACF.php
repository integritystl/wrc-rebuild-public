<?php
namespace WRCInfrastructure\News;

class NewsACF
{

  public static function setupNewsFields() {
    self::createNewsFields();
    self::newsAttachSites();
    self::addNewsTemplateFields();
  }

  private static function createNewsFields(){
    if( function_exists('acf_add_local_field_group') ){
      acf_add_local_field_group(array (
        'key' => 'field_group_flex_news_content',
        'name' => 'group_flex_news_content',
        'title' => 'News Content',
        'fields' => array (
          array (
            'layouts' => array (
              array (
                'key' => '5992fc8e2e5a6',
                'name' => 'single_column_content_block',
                'label' => 'Single Column Content Block',
                'display' => 'block',
                'sub_fields' => array (
                  array (
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                    'default_value' => '',
                    'delay' => 0,
                    'key' => 'field_5992fdb857b61',
                    'label' => 'Content',
                    'name' => 'content',
                    'type' => 'wysiwyg',
                    'instructions' => 'This is for displaying full width, single column content',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                  ),
                ),
                'min' => '',
                'max' => '',
              ),
              array (
                'key' => '5992fece57b66',
                'name' => 'quote_block',
                'label' => 'Quote Block',
                'display' => 'block',
                'sub_fields' => array (
                  array (
                    'default_value' => '',
                    'new_lines' => 'wpautop',
                    'maxlength' => '',
                    'placeholder' => '',
                    'rows' => '',
                    'key' => 'field_5992fee857b67',
                    'label' => 'Quote',
                    'name' => 'quote',
                    'type' => 'textarea',
                    'instructions' => 'This field holds text you would like to show up as a stylized quote.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                  ),
                ),
                'min' => '',
                'max' => '',
              ),
              array (
                'key' => '5992ff1257b68',
                'name' => 'embedded_video_block',
                'label' => 'Embedded Video Block',
                'display' => 'block',
                'sub_fields' => array (
                  array (
                    'key' => 'field_5992ff4257b69',
                    'label' => 'embedded_video',
                    'name' => 'embedded_video',
                    'type' => 'oembed',
                    'instructions' => 'This field is used to embed a video in the post.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                  ),
                ),
                'min' => '',
                'max' => '',
              ),
              array (
                'key' => '5994375e00de1',
                'name' => 'multi_column_image_block',
                'label' => 'Multi-Column Image Block',
                'display' => 'block',
                'sub_fields' => array (
                  array (
                    'sub_fields' => array (
                      array (
                        'return_format' => 'id',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '0.5',
                        'mime_types' => '',
                        'key' => 'field_5994379a95d8b',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                          'width' => '',
                          'class' => '',
                          'id' => '',
                        ),
                      ),
                    ),
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'table',
                    'button_label' => '',
                    'collapsed' => '',
                    'key' => 'field_5994378795d8a',
                    'label' => 'Images',
                    'name' => 'images',
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                  ),
                ),
                'min' => '',
                'max' => '',
              ),
              array (
                'key' => '5994383cff747',
                'name' => 'single_column_image_block',
                'label' => 'Single Column Image Block',
                'display' => 'block',
                'sub_fields' => array (
                  array (
                    'return_format' => 'id',
                    'preview_size' => 'thumbnail',
                    'key' => 'field_59943846ff748',
                    'label' => 'Image',
                    'name' => 'image',
                    'type' => 'image',
                  ),
                ),
                'min' => '',
                'max' => '',
              ),
              array (
                'key' => '5992ff6857b6a',
                'name' => 'callout_block',
                'label' => 'Callout Block',
                'display' => 'block',
                'sub_fields' => array (
                  array (
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'key' => 'field_5992ff7257b6b',
                    'label' => 'Callout Heading',
                    'name' => 'callout_heading',
                    'type' => 'text',
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
                    'default_value' => '',
                    'new_lines' => 'wpautop',
                    'maxlength' => '',
                    'placeholder' => '',
                    'rows' => '',
                    'key' => 'field_5992ff8657b6c',
                    'label' => 'Callout Box Content',
                    'name' => 'callout_subhead',
                    'type' => 'wysiwyg',
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
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'key' => 'field_5992ff9b57b6d',
                    'label' => 'Callout Button Text',
                    'name' => 'callout_button_text',
                    'type' => 'text',
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
                    'default_value' => '',
                    'placeholder' => '',
                    'key' => 'field_5992ffa857b6e',
                    'label' => 'Callout Button Link',
                    'name' => 'callout_button_link',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                      'width' => '50',
                      'class' => '',
                      'id' => '',
                    ),
                  ),
                ),
                'min' => '',
                'max' => '',
              ),
            ),
            'min' => '',
            'max' => '',
            'button_label' => 'Add Row',
            'key' => 'field_5992fc7d57b60',
            'label' => 'News Flexible Content',
            'name' => 'news_flexible_content',
            'type' => 'flexible_content',
            'instructions' => 'Reorderable mixed content for News Posts',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
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
              'value' => 'post',
            ),
          ),
        ),
        'hide_on_screen' => array (
        //  0 => 'the_content',
        //  1 => 'excerpt',
        )
      ));

    }
  }

  private static function newsAttachSites(){
    if( function_exists('acf_add_local_field_group') ){
      acf_add_local_field_group(array (
        'key' => 'group_site_post_search',
        'title' => 'Attached Site',
        'fields' => array (
          array (
            'key' => 'field_attached_site',
            'label' => 'Attached Site',
            'name' => 'attached_site',
            'type' => 'post_object',
            'post_type' => 'site',
            'instructions' => 'The Primary Site the Post will show on. If Post appears on more than 1 Site, defaults to WRC automatically.',
            'required' => 1,
          ),
        ),
        'location' => array (
          array (
            array (
              'param' => 'post_type',
              'operator' => '==',
              'value' => 'post'
            ),
          ),
        ),
      ));
    }
  }

  private static function addNewsTemplateFields(){
    //news archive template fields
    if( function_exists('acf_add_local_field_group') ){
      acf_add_local_field_group(array(
        'key' => 'group_news_template',
        'title' => 'News Options',
        'fields' => array (
          array (
            'key' => 'field_site_news_categories',
            'label' => 'News Categories',
            'name' => 'news_categories',
            'type' => 'taxonomy',
            'taxonomy' => 'category',
          ),
        ),
        'location' => array(
          array(
            array(
              'param' => 'page_template',
              'operator' => '==',
              'value' => 'page-news.php'
            )
          )
        ),
      ));
    }
  }

}
