<?php
/**
 * Template Name: 1st Auto Home
 *
 * This template is the homepage for 1st Auto
 *
 * @package WRC Marketing
 */

get_header();
$hero_image = get_field('hero_image');
?>

<!-- HERO SECTION -->
<div class="firstauto_hero_unit" style="background-image:url('<?php echo $hero_image['sizes']['large'];?>')">
  <div class="firstauto_overlay"></div>
  <div class="firstauto_hero_unit_container">
    <div class="firstauto_hero_content_box">
      <h1><?php echo get_field('hero_headline');?></h1>
    </div>
  </div>
</div>
<div class="firstauto_home_navigation_cards">
  <div class="navigation_cards_wrapper">
    <?php
      if( have_rows('navigation_icons') ): while( have_rows('navigation_icons') ): the_row();
      $icon = get_sub_field('icon');
      $iconObject = wp_get_attachment_image( $icon['ID'], 'medium_large' );
      $iconSubtext = get_sub_field('icon_sub_text');

      //this is a <select> that returns a value matching a CSS class used to open differen modals
      $iconModal = get_sub_field('icon_modal');

      //Sometimes an icon will open a modal instead of a page or a link might be external ?>
      <?php if ($iconModal) { ?>
          <a href="#" class="navigation_card <?php echo $iconModal; ?>">
      <?php } else { ?>
          <a href="<?php echo get_sub_field('icon_link');?>" class="navigation_card">
      <?php } ?>
        <div class="firstauto_home_navigation_single_icon" >
          <?php echo $iconObject; ?>
          <h3><?php echo get_sub_field('icon_text');?></h3>
          <?php if ( $iconSubtext ) { ?>
            <span><?php echo get_sub_field('icon_sub_text'); ?> <i class="fa fa-external-link"></i></span>
          <?php } ?>
        </div>
      </a>
    <?php endwhile; endif; ?>
  </div>
</div>
<?php
  $subheaderID = get_field('1stauto_home_section_id');

  if ($subheaderID) { ?>
    <div id="<?php echo $subheaderID; ?>" class="firstauto_home_full_width_callouts">
 <?php } else { ?>
    <div class="firstauto_home_full_width_callouts">
 <?php } ?>
  <h2><?php echo get_field('subheader');?></h2>
  <?php
    if( have_rows('full_width_callout_sections') ): while( have_rows('full_width_callout_sections') ): the_row();
    $image = get_sub_field('image');
    $linkExt = get_sub_field('button_link_ext');
  ?>
    <div class="full_width_callout_section" style="background-image: url('<?php echo $image['sizes']['large'];?>')">
      <div class="firstauto_overlay"></div>
      <div class="full_width_callout_container">
        <div class="full_width_callout_info_container">
          <h3><?php echo get_sub_field('headline');?></h3>
          <p><?php echo get_sub_field('info');?></p>
          <?php if ( get_sub_field('button_link') ) { ?>
            <a href="<?php echo get_sub_field('button_link');?>" <?php if ( $linkExt ) { echo "target='_blank'"; } ?>>
              <?php echo get_sub_field('button_text');?>
              <?php if ( $linkExt ) { ?>
                <i class="fa fa-external-link" aria-hidden="true"></i>
              <?php } ?>
            </a>
        <?php } ?>
        </div>
      </div>
    </div>
  <?php endwhile; endif; ?>
</div>


<!-- Protection SECTION -->
<div class="firstauto_home_full_width">
  <h2><?php echo get_field('protection_headline');?></h2>
  <p class="firstauto_home_full_width_content"><?php echo get_field('protection_text');?></p>
  <div class="firstauto_home_protection_icons">
  <?php
    if( have_rows('protection_icons') ): while( have_rows('protection_icons') ): the_row();
    $icon = get_sub_field('icon');
    //Get image tag with srcset attributes, alt, etc
    $iconObject = wp_get_attachment_image( $icon['ID'], 'medium_large' );
    if (get_sub_field('icon_link')) { ?>
      <a class="firstauto_home_protection_single_icon" href="<?php echo get_sub_field('icon_link');?>">
   <?php } else { ?>
     <div class="firstauto_home_protection_single_icon">
   <?php } ?>
      <div class="protection_icon">
        <?php echo $iconObject; ?>
      </div>
      <h4><?php echo get_sub_field('icon_text');?></h4>
    <?php if (get_sub_field('icon_link')) { ?>
      </a>
    <?php } else { ?>
      </div>
    <?php } ?>
  <?php endwhile; endif; ?>
  </div>
  <a class="protections_link" href="<?php echo get_field('protection_button_link');?>"><?php echo get_field('protection_button_text');?></a>
</div>

<!-- Agent Search -->
<?php get_template_part('template-parts/content', 'homepage-agent-search'); ?>


<?php $mutuals_callout_background_image = get_field('mutuals_callout_background_image'); ?>
<div class="firstauto_home_mutuals_callout" style="background-image:url('<?php echo $mutuals_callout_background_image['sizes']['large'];?>')">
  <div class="firstauto_home_mutuals_callout_container">
    <h2><?php echo get_field('mutuals_callout_headline');?></h2>
    <p><?php echo get_field('mutuals_callout_subhead');?></p>
    <a href="<?php echo get_field('mutuals_callout_button_link');?>"><?php echo get_field('mutuals_callout_button_text');?></a>
  </div>
</div>

<!-- POST SECTION -->
<?php get_template_part('template-parts/content', 'homepage-post-section'); ?>

<?php
get_footer();
?>
