<?php
/**
 * The template for displaying all single Event posts for Event Espresso
 *
 * @package wrcgroup_marketing
 */

get_header();

while ( have_posts() ) : the_post(); ?>
<div class="page_container events-page">
	<div id="primary" class="content-area">
		<?php get_template_part('template-parts/content', 'espresso_events'); ?>

	</div><!-- #primary -->
</div>
<?php
endwhile;
get_footer();
