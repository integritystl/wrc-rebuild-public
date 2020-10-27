<?php
namespace WRCInfrastructure\CustomTaxonomies;

class careerTaxonomies {

  public static function setupCareerTaxonomies() {
    self::createCareerTaxonomy();
  }

  //Similar to the Post Site taxonmy for Posts used to attached a Post to a Site CPT
  private static function createCareerTaxonomy() {
    $labels = array (
      'name' => 'Career Site',
      'singular_name' => 'Career Site',
      'search_items' => 'Search Career Sites',
      'all_items' => 'All Career Sites',
      'update_item' => 'Update Career Site',
      'edit_item' => 'Edit Career Site',
      'add_new_item' => 'Add New Career Site',
      'new_item_name' => 'New Career Site Name',
      'menu_name' => 'Career Site'
    );

    $args = array (
      'hierarchical' => true,
      'labels' => $labels,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'career-site')
    );

    register_taxonomy('career-site', array('career'), $args);
  }
}
