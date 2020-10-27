<?php
/**
 * Archive Page for Newsletter Name
 *
 * This template queries for the Newsletter Name Issues for a WRC
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wrcgroup_marketing
 */


get_header(); ?>

<div class="child-page">
    <div id="primary" class="content-area wire-page">
        <main id="main" class="site-main" role="main">
            <h1 class="news-title">Newsletter Name</h1>

            <div class="wire-grid-container">
                <?php 
                $args = array(
                    'post_type' => 'newsletter-name',
                    'posts_per_page' => 4,
                );
                $newsletterIssues = new WP_Query( $args );
                $issue_count = wp_count_posts('newsletter-name')->publish;
                ?>
                <?php if ( $newsletterIssues->have_posts() ):
                    while ( $newsletterIssues->have_posts() ): $newsletterIssues->the_post();

                    get_template_part('template-parts/content', 'newsletter-grid');

                    endwhile;
                endif; ?>
            </div><!-- .wire-grid-container -->
            <?php if ($issue_count >= 5) { ?>
                <a href="/newsletter-name/" class="post_item_read_more">Newsletter Name <i class="fa fa-caret-right" aria-hidden="true"></i></a>
            <?php } ?>
        </main><!-- #main -->
    </div><!-- #primary -->
</div>

<?php
get_footer();
