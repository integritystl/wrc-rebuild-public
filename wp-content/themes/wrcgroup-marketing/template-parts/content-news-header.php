  <div class="featured-image-container">
    
    <?php
      //we have an extra span wrap to help prevent weird positioning issues with <sup> for 1st auto headlines
      if( is_single() ) { ?>
        <?php 
        $imgObject = wp_get_attachment_image( get_post_thumbnail_id(), 'full' );
        echo $imgObject; ?>
        <h1 class="post-title post_item_title"><span><?php the_title(); ?></span></h1>
      <?php } else { ?>
        <a href="<?php the_permalink(); ?>?current_site=<?php echo $site; ?>">
          <?php $imgObject = wp_get_attachment_image( get_post_thumbnail_id(), 'full' );
          echo $imgObject; ?>
        </a>
        <h3 class="post_item_title">
          <a href="<?php the_permalink(); ?>?current_site=<?php echo $site; ?>"><?php the_title();?></a>
        </h3>
    <?php } ?>
  </div>

  <div class="post_meta">
    <span class="post_item_date">
      POSTED ON <?php echo get_the_date('n/j/Y', get_the_ID());?>
      <?php if ( has_category() ) { ?>
        <span class="categories">
            <?php
            $cat_names = array();
              foreach((get_the_category()) as $cat) {
                  $cat_names[] = '<a href="#" data-category=' . $cat->term_id . ' class="post_item_cat">' . $cat->cat_name . '</a>';
                }
              echo implode(', ', $cat_names);
            ?>
        </span>
      <?php } ?>
    </span>
    <?php /**
     *
     * Note: Client wants to hide tags on all news items. Just hiding incase they ever want them back.
     *

    if ( has_tag() ) { ?>
      <span class="tags">
        <?php
          $tag_names = array();
          foreach( get_the_tags() as $tag ) {
            $tag_names[] = '<a href="#" data-tag=' . $tag->term_id . ' class="post_item_tax">' . $tag->name . '</a>';
          }
          echo implode(', ', $tag_names);
        ?>
      </span>
    <?php } */ ?>
  </div>
