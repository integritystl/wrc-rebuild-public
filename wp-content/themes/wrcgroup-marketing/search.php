<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package wrcgroup_marketing
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="page-full-width">

				<div id="search-results-container" data-search-terms="<?php echo get_search_query(); ?>"></div>
				<div class="loading-screen">
					<div class="loader">Loading...</div>
				</div>
				<button id="load-more-btn" class="btn-hide">Load More</button>

			</div>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
