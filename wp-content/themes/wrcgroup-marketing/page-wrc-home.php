<?php
/**
 * Template Name: WRC Home
 *
 * This template is the homepage for WRC
 *
 * @package WRC Marketing
 */

get_header();
$hero_image = get_field('hero_image');
?>


<!-- HERO SECTION -->
<div class="wrc_hero_unit" style="background-image:url('<?php echo $hero_image['sizes']['large'];?>')">
  <div class="wrc_hero_unit_container">
    <div class="wrc_hero_content_box">
      <h1><?php echo get_field('hero_headline');?></h1>
      <a class="wrc_hero_cta" href="<?php echo get_field('hero_cta_link');?>">
        <?php echo get_field('hero_cta_text');?>
      </a>
    </div>
  </div>
</div>
<!-- MUTUAL ASSISTANCE SECTION -->
<?php
  $mutualSectionID = get_field('wrc_home_subhead_section_id');
  if ($mutualSectionID) { ?>
    <div id="<?php echo $mutualSectionID; ?>" class="wrc_home_full_width">
 <?php } else { ?>
   <div class="wrc_home_full_width">
 <?php } ?>
  <div class="wrc_home_assistance_icons">
  <?php
    if( have_rows('assistance_icons') ): while( have_rows('assistance_icons') ): the_row();
    $icon = get_sub_field('icon');
    $iconObject = wp_get_attachment_image( $icon['ID'], 'medium_large' );

    // When looping through repeater, check if our link is a jump link or not
    // Currently the default is for the link to jump down the page
    if (get_sub_field('icon_jump_link') == 1 ) {
      //assign link and add to array
      $iconLink = "#" . get_sub_field('icon_link_target');
    } else {
      // just assign link from icon_page_link
      $iconLink = get_sub_field('icon_page_link');
    }
  ?>
    <a class="wrc_home_assistance_single_icon" href="<?php echo $iconLink;?>">
      <?php echo $iconObject; ?>
      <h4><?php echo get_sub_field('icon_text');?></h4>
    </a>
  <?php
    endwhile; endif;
  ?>
  </div>
  <h2><?php echo get_field('full_width_headline');?></h2>
  <div class="wrc_home_full_width_content"><?php echo get_field('full_width_content');?></div>
</div>
<?php
  //Customized Reinsurance got moved
?>
<?php
  $bulletId = get_field('field_bullet_section_id');
  $overlyImage = get_field('cr_background_image'); //used to link to in-page content
  if ($bulletId) { ?>
    <div id="<?php echo $bulletId; ?>" class="wrc_home_full_width_bullet_section" >
  <?php } else { ?>
    <div class="wrc_home_full_width_bullet_section" >
  <?php } ?>
    <?php if($overlyImage) { ?>
    <div class="wrc_home_full_width_bullet_section_overlay" style="background-image:url('<?php echo $overlyImage['sizes']['large']?>')"></div>
    <?php } ?>
    <div class="wrc_home_full_width_bullet_section_container">
      <h2><?php echo get_field('cr_headline'); ?></h2>
      <?php $swap_content = get_sub_field('cr_content_order');?>
      <?php if(!empty($swap_content) && count($swap_content) > 0 && $swap_content[0] === 'swap') : ?>
        <div class="wrc_home_full_width_bullet_section_bullets">
          <?php if( have_rows('cr_list_items') ): while( have_rows('cr_list_items') ): the_row(); ?>
          <h4><?php echo get_sub_field('cr_item');?></h4>
          <?php
          endwhile; endif;
          ?>
        </div>
        <div class="wrc_home_full_width_content"><?php echo get_field('cr_content');?></div>
      <?php else : ?>
        <div class="wrc_home_full_width_content"><?php echo get_field('cr_content');?></div>
        <div class="wrc_home_full_width_bullet_section_bullets">
          <?php if( have_rows('cr_list_items') ): while( have_rows('cr_list_items') ): the_row(); ?>
          <h4><?php echo get_sub_field('cr_item');?></h4>
          <?php
          endwhile; endif;
          ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
<?php

?>


<!-- Fifty Fifty Sections -->
<?php
  if( have_rows('fifty_fifty_sections') ): while( have_rows('fifty_fifty_sections') ): the_row();
  $image = get_sub_field('image');
  //Get full img with srcset attribute
  $imgObject = wp_get_attachment_image( $image['ID'], 'medium_large', "", ['class' => 'skip-lazy-load'] );
  $fiftyID = get_sub_field('section_id'); //used to link to in-page content
?>
  <?php if ($fiftyID) { ?>
    <div id="<?php echo get_sub_field('section_id'); ?>" class="wrc_home_fifty_fifty_section">
  <?php } else { ?>
    <div class="wrc_home_fifty_fifty_section">
  <?php } ?>
    <div class="wrc_home_fifty_fifty_section_image">
      <?php echo $imgObject; ?>
    </div>
    <div class="wrc_home_fifty_fifty_section_content">
      <div class="wrc_home_fifty_fifty_section_content_container">
        <?php echo get_sub_field('content'); ?>
      </div>
    </div>
  </div>
<?php
    endwhile; endif;
?>
<!-- FULL WIDTH BULLET SECTIONS -->
<?php
  $bulletId = get_field('field_bullet_section_id');
  if( have_rows('full_width_bullet_sections') ): while( have_rows('full_width_bullet_sections') ): the_row();
  $overlyImage = get_sub_field('image'); //used to link to in-page content
  if ($bulletId) { ?>
    <div id="<?php echo $bulletId; ?>" class="wrc_home_full_width_bullet_section" >
  <?php } else { ?>
    <div class="wrc_home_full_width_bullet_section" >
  <?php } ?>
    <?php if($overlyImage) { ?>
    <div class="wrc_home_full_width_bullet_section_overlay" style="background-image:url('<?php echo $overlyImage['sizes']['large']?>')"></div>
    <?php } ?>
    <div class="wrc_home_full_width_bullet_section_container">
      <h2><?php echo get_sub_field('headline'); ?></h2>
      <?php $swap_content = get_sub_field('content_order');?>
      <?php if(!empty($swap_content) && count($swap_content) > 0 && $swap_content[0] === 'swap') : ?>
        <div class="wrc_home_full_width_bullet_section_bullets">
          <?php if( have_rows('list_items') ): while( have_rows('list_items') ): the_row(); ?>
          <h4><?php echo get_sub_field('item');?></h4>
          <?php
          endwhile; endif;
          ?>
        </div>
        <div class="wrc_home_full_width_content"><?php echo get_sub_field('subhead');?></div>
      <?php else : ?>
        <div class="wrc_home_full_width_content"><?php echo get_sub_field('subhead');?></div>
        <div class="wrc_home_full_width_bullet_section_bullets">
          <?php if( have_rows('list_items') ): while( have_rows('list_items') ): the_row(); ?>
          <h4><?php echo get_sub_field('item');?></h4>
          <?php
          endwhile; endif;
          ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
<?php
  endwhile; endif;
?>
<!-- FIND A MUTUAL GOES HERE -->
<?php get_template_part('template-parts/content', 'homepage-agent-search'); ?>

<!-- POST SECTION -->
<?php get_template_part('template-parts/content', 'homepage-post-section'); ?>
<?php
get_footer();
?>
