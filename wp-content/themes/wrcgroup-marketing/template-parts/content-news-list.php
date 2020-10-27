<?php
//Partial used for News Page & any Posts related results pages

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-news-list'); ?>>

  <?php
    //must use 'include' with locate_template instead of get_template_part because
    //we're passing a variable for Site to add onto the link
    include(locate_template('template-parts/content-news-header.php'));
  ?>

 <p class="post_item_excerpt"><?php echo excerpt(100); ?></p>
 <a class="post_item_read_more" href="<?php the_permalink();?>?current_site=<?php echo $site; ?>">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>
</article>
