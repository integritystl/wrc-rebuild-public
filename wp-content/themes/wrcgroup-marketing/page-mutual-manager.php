<?php
/**
 * Archive Page for Mutual Manager Newsletter
 *
 * This template queries for the Mutual Manager Issues for a WRC
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wrcgroup_marketing
 */


get_header(); ?>

<div class="child-page">
	<div id="primary" class="content-area wire-page">
		<main id="main" class="site-main" role="main">
            <h1 class="news-title">Mutual Manager Messenger</h1>

            <div class="wire-grid-container">
                <?php //Get Mutual Manager Issues
                $args = array(
                    'post_type' => 'mutual-manager',
                    'posts_per_page' => 4,
                );
                $mMangagerIssues = new WP_Query( $args );
                $issue_count = wp_count_posts('mutual-manager')->publish;
                ?>
                <?php if ( $mMangagerIssues->have_posts() ):
                    while ( $mMangagerIssues->have_posts() ): $mMangagerIssues->the_post();

                    get_template_part('template-parts/content', 'newsletter-grid');

                    endwhile;
                endif; ?>
            </div><!-- .wire-grid-container -->
            <?php if ($issue_count >= 5) { ?>
                <a href="/mutual-manager/" class="post_item_read_more">Mutual Manager Messenger <i class="fa fa-caret-right" aria-hidden="true"></i></a>
            <?php } ?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div>

<?php
get_footer();
