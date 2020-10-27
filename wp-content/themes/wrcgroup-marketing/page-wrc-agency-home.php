<?php
/**
 * Template Name: WRC Agency Home
 *
 * This template is the homepage for WRC Agency
 *
 * @package WRC Marketing
 */

get_header();
$hero_image = get_field('hero_image');
?>
<!-- HERO SECTION -->
<div class="wrc-agency_hero_unit" style="background-image:url('<?php echo $hero_image['sizes']['large'];?>')">
  <div class="wrc-agency_hero_unit_container wrc-agency_hero_container">
    <div class="wrc-agency_hero_content_box hero_content_center">
      <h1><?php echo get_field('hero_headline');?></h1>
    </div>
  </div>
</div>

<!-- ICON CALLOUT SECTION -->
<div class="wrc-agency_home_icon_container">
  <div class="wrc-agency_home_icon_callouts">
  <?php
    if( have_rows('icon_callouts') ): while( have_rows('icon_callouts') ): the_row();
    $icon = get_sub_field('icon');
    //Get image tag with srcset attributes, alt, etc
    $iconObject = wp_get_attachment_image( $icon['ID'], 'medium_large' );
  ?>
    <?php
      //Sometimes an icon will open a modal instead of a page
      if (get_sub_field('icon_modal')) { ?>
      <a class="wrc-agency_home_icon_callouts_single_icon bill__modal-trigger" href="#">
    <?php } else { ?>
      <a class="wrc-agency_home_icon_callouts_single_icon" href="<?php echo get_sub_field('icon_link');?>">
    <?php } ?>
      <?php echo $iconObject; ?>
      <h4><?php echo get_sub_field('icon_text');?></h4>
    </a>

  <?php
    endwhile;
    endif;
  ?>
  </div>


</div>

<?php
  $personal_image = get_field('personal_insurance_image');
  $commercial_image = get_field('commercial_insurance_image');

  $protectionID = get_field('wrc_agency_protection_section_id');

  if ($protectionID) { ?>
    <div id="<?php echo $protectionID; ?>" class="wrc-agency_home_full_width">
  <?php } else { ?>
    <div class="wrc-agency_home_full_width">
  <?php } ?>
    <h2><?php echo get_field('protection_headline'); ?></h2>
  </div>

<div class="wrc-agency_home_full_width wrc-agency_home_split_bg_img" style="background-image:url('<?php echo $personal_image['sizes']['large'];?>')">
  <div class="wrc-agency_home_split_bg_img_content">
    <div class="wrc-agency_home_split_bg_img_content_container">
      <h3><?php echo get_field('personal_insurance_headline'); ?></h3>
      <p><?php echo get_field('personal_insurance_subhead'); ?></p>
      <?php if ( have_rows('personal_list_items') ) : ?>
        <ul class="wrc-agency_agency_home_list_columns">
          <?php while ( have_rows('personal_list_items') ): the_row(); ?>
            <li><?php echo get_sub_field('list_item'); ?></li>
          <?php endwhile; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="wrc-agency_home_full_width wrc-agency_home_split_bg_img split_bg_left" style="background-image:url('<?php echo $commercial_image['sizes']['large'];?>')">
  <div class="wrc-agency_home_split_bg_img_content">
    <div class="wrc-agency_home_split_bg_img_content_container">
      <h3><?php echo get_field('commercial_insurance_headline'); ?></h3>
      <p><?php echo get_field('commercial_insurance_subhead'); ?></p>
      <?php if ( have_rows('commercial_list_items') ) : ?>
        <ul class="wrc-agency_agency_home_list_columns">
          <?php while ( have_rows('commercial_list_items') ): the_row(); ?>
            <li><?php echo get_sub_field('list_item'); ?></li>
          <?php endwhile; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="wrc-agency_home_full_width">
  <h2><?php echo get_field('agent_programs_headline'); ?></h2>
  <p class="wrc-agency_home_full_width_bullet_section_subhead"><?php echo get_field('agent_programs_subhead');?></p>
  <div class="wrc-agency_agency_home_programs">
    <div class="wrc-agency_agency_home_programs_col">
      <?php the_field('agent_programs_1stauto'); ?>
    </div>
    <div class="wrc-agency_agency_home_programs_col">
      <?php the_field('agent_programs_direct'); ?>
    </div>
  </div>
</div>

<div class="wrc-agency_agency_partners">
  <div class="wrc-agency_home_full_width">
    <h2><?php echo get_field('partnerships_headline'); ?></h2>
    <p class="wrc-agency_home_full_width_bullet_section_subhead"><?php echo get_field('partnerships_subhead');?></p>
    <?php if ( have_rows('partners_icons') ) : ?>
      <ul class="wrc-agency_agency_home_partner_list">
        <?php while ( have_rows('partners_icons') ): the_row();
          $partnerIcon = get_sub_field('partners_icon_img');
          $partnerIconObj = wp_get_attachment_image( $partnerIcon['ID'], 'medium_large' );
        ?>
          <li>
            <?php echo $partnerIconObj; ?>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php endif; ?>
  </div>
</div>

<?php if ( get_field('state_served_header') ) { ?>
  <div class="wrc-agency_states_served">
    <?php
      $stateImage = get_field('state_served_bg_image');
      $stateImgObject = wp_get_attachment_image( $stateImage['ID'], 'medium_large' );
    ?>
    <div class="wrc-agency_states_served_image">
      <?php echo $stateImgObject;?>
    </div>
    <div class="wrc-agency_states_served_content">
      <h2><?php echo get_field('state_served_header');?></h2>
      <p><?php echo get_field('state_served_content');?></p>
    </div>
  </div>
<?php } ?>



<!-- POST SECTION -->
<?php get_template_part('template-parts/content', 'homepage-post-section'); ?>
<?php
get_footer();
?>
