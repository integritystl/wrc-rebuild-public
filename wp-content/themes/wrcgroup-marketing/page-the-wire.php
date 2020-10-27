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
            <h1 class="news-title">The WiRe</h1>

            <div class="wire-grid-container">
                <?php //Get The WiRe Issues
                $args = array(
                    'post_type' => 'wire',
                    'posts_per_page' => 4,
                );
                $wireIssues = new WP_Query( $args );
                $issue_count = wp_count_posts('wire')->publish;
                ?>
                <?php if ( $wireIssues->have_posts() ):
                    while ( $wireIssues->have_posts() ): $wireIssues->the_post();

                    get_template_part('template-parts/content', 'newsletter-grid');

                    endwhile;
                endif; ?>
            </div><!-- .wire-grid-container -->
            <?php if ($issue_count >= 5) { ?>
                <a href="/wire/" class="post_item_read_more">The WiRe Archive <i class="fa fa-caret-right" aria-hidden="true"></i></a>
            <?php } ?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div>

<?php
get_footer();
