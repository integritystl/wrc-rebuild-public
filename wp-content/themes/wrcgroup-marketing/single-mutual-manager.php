<?php
/**
 * The template for displaying all single Mutual Manager Issues
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wrcgroup_marketing
 */

//set query param of wrc site
newsletter_wrc_site();

 //Get ID of current site using query param if we have it
if (isset($_GET['current_site'])) {
	$siteID = $_GET['current_site'];
}

get_header(); ?>
	<div class="child-page">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

                <div class="issue-header wire-header">
                    <div class="wire-title-super">Mutual Manager Messenger</div>
                    <h1>WRC Newsletter<br/><?php the_title(); ?></h1>
                </div>

                <div class="issue_template_content_section">
                    <?php
                    //Get the Mutual Manager Posts and loop through them
                    $MutualManagerPosts = get_field('m_manager_posts');
                    if ($MutualManagerPosts) : ?>
                        <div class="wire-grid-container">
                            <?php foreach ( $MutualManagerPosts as $post) :
                                setup_postdata( $post );
                                $permalink = get_permalink();
                                ?>

                                <div class="wire-grid-item wire-post">
                                    <a href="<?php echo $permalink . '?current_site=9'; ?>">
                                        <div class="feature-image">
                                            <?php //check if there is an image, otherwise display an icon
                                            $thumbnail_img_url = get_field('m_manager_post_thumbnail');
                                            if ($thumbnail_img_url) { ?>
                                                <img src="<?php echo $thumbnail_img_url; ?>" alt="<?php the_title();?>">
                                            <?php } else { ?>
                                                <div class="wire-icon"></div>
                                            <?php }
                                            ?>
                                        </div>
                                    </a>
                                    <h2><a href="<?php echo $permalink . '?current_site=9'; ?>"><?php the_title();?></a></h2>
                                    <?php the_excerpt(); ?>
                                    <span class="read-more"><a href="<?php echo $permalink . '?current_site=9'; ?>">Read More</a></span>
                                </div>

                            <?php endforeach; ?>

                        </div><!-- .MM-grid-container -->
                        <?php wp_reset_postdata();
                    endif; ?>

                </div><!-- .issue_template_content_section -->

            </main><!-- #main -->
        </div><!-- #primary -->
        <?php get_sidebar('mutual-manager'); ?>
<?php
get_footer();
