<div class="flex_content_multi_column_image_block">
  <div class="multi_column_image_block_wrapper">
    <?php if( have_rows('images') ): ?>
      <?php while(have_rows('images')) : the_row();?>
        <div class="image_column">
          <?php
          $img = get_sub_field('image');
          //Get the image this way so we can output it with srcset attribute
          $imgObject = wp_get_attachment_image( $img, 'medium' ); ?>

          <?php echo $imgObject; ?>
        </div>
      <? endwhile; ?>
    <? endif; ?>
  </div>
</div>
