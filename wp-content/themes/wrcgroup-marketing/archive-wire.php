<?php
/**
 * Archive Page for The WiRe
 *
 * This template queries for the Wire Issues for a WRC
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wrcgroup_marketing
 */


get_header(); ?>

<div class="child-page">
	<div id="primary" class="content-area wire-page">
		<main id="main" class="site-main" role="main">
            <h1 class="news-title">The WiRe Archive</h1>

            <div class="wire-grid-container">
                <?php //Get The WiRe Issues
                $args = array(
                    'post_type' => 'wire',
                    'posts_per_page' => -1
                );
                $wireIssues = new WP_Query( $args );
                ?>
                <?php if ( $wireIssues->have_posts() ):
                    while ( $wireIssues->have_posts() ): $wireIssues->the_post();

                    get_template_part('template-parts/content', 'newsletter-grid');

                    endwhile;
                endif; ?>
            </div><!-- .wire-grid-container -->


		</main><!-- #main -->
	</div><!-- #primary -->
</div>

<?php
get_footer();
