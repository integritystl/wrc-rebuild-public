<?php /**
 *
 * Content for Any Newsletter Page and Newsletter Archive
 *
 *
 */
$permalink = get_permalink(); ?>

<article class="wire-grid-item">
    <a href="<?php echo $permalink; ?>">
        <div class="feature-image">
            <?php //check if there is an image, otherwise display an icon
            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'thumbnail');
            if ($featured_img_url) {
                the_post_thumbnail();
            } else { ?>
                <div class="wire-icon"></div>
            <?php }
            ?>
        </div>
    </a>

    <h2><a href="<?php echo $permalink; ?>"><?php the_title();?></a></h2>

</article>