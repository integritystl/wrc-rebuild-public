<div class="flex_content_callout_block">
  <div class="callout_block_wrapper">
    <?php if ( get_sub_field('callout_heading') ) { ?>
      <h2><?php the_sub_field('callout_heading')?></h2>
    <?php } ?>
    <p><?php the_sub_field('callout_subhead');?></p>
    <?php if (get_sub_field('callout_button_link') ) { ?>
      <a href="<?php the_sub_field('callout_button_link'); ?>" class="btn-primary"><?php the_sub_field('callout_button_text'); ?></a>
    <?php } ?>
  </div>
</div>
