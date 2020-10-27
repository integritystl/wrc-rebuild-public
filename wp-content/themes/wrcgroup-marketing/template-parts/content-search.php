<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wrcgroup_marketing
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-news-list'); ?>>
	<p><?php echo ('post' === get_post_type() ? 'News' : build_post_breadcrumbs(get_the_ID())); ?></p>
	<?php if ('post' === get_post_type() ) { ?>
		<h3 class="post_item_title"><a href="<?php the_permalink(); ?>?current_site=<?php echo $site; ?>"><?php the_title();?></a></h3>
	<?php } else { ?>
		<h3 class="post_item_title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
	<?php } ?>

	<div class="post_meta">
	<?php //if it's a news post, show category and tag data. otherwise just give link and excerpt ?>
	<?php if ( 'post' === get_post_type() ) : ?>
		<span class="post_item_date">
			POSTED ON <?php echo get_the_date('n/j/Y', get_the_ID());?>
			<?php if (has_category() ) { ?>
        <span class="categories">
					<?php
						$cat_names = array();
						foreach((get_the_category()) as $cat) {
							$cat_names[] = $cat->cat_name;
						}
						echo implode(', ', $cat_names);
					?>
        </span>
      <?php } ?>
		</span>
		<?php if ( has_tag() ) { ?>
      <span class="tags">
				<?php
					$tag_names = array();
					foreach( get_the_tags() as $tag ) {
						$tag_names[] =  $tag->name;
					}
					echo implode(', ', $tag_names);
				?>
      </span>
    <?php } ?>
	<?php endif; ?>
	</div>
	<p class="post_item_excerpt"><?php the_excerpt(); ?></p>
	<?php if ('post' === get_post_type() ) { ?>
		<a class="post_item_read_more" href="<?php the_permalink();?>?current_site=<?php echo $site; ?>">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>
	<?php } else { ?>
		<a class="post_item_read_more" href="<?php the_permalink();?>">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>
	<?php } ?>
</article>
