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
            <h1 class="news-title">WRC Agency Newsletter</h1>

            <div class="wire-grid-container">
                <?php //Get Newsletter Name Issues
                $args = array(
                    'post_type' => 'wrcagency-newsletter',
                    'posts_per_page' => -1
                );
                $newsletterIssues = new WP_Query( $args );
                ?>
                <?php if ( $newsletterIssues->have_posts() ):
                    while ( $newsletterIssues->have_posts() ): $newsletterIssues->the_post();

                    get_template_part('template-parts/content', 'newsletter-grid');

                    endwhile;
                endif; ?>
            </div><!-- .wire-grid-container -->


		</main><!-- #main -->
	</div><!-- #primary -->
</div>

<?php
get_footer();
