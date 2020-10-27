<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wrcgroup_marketing
 */

 //Get ID of current site using query param if we have it
if (isset($_GET['current_site'])) {
	$siteID = $_GET['current_site'];
} else {
	$site = get_current_site();
	$siteID = $site->ID;
}


get_header(); ?>
	<div class="child-page">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-site="<?php echo($siteID); ?>">
					<?php
					//shared news heading items like featured image and meta
					get_template_part( 'template-parts/content', 'news-header' );

				 if(have_rows('news_flexible_content', get_the_ID())) {
					 get_template_part( 'template-parts/content', 'flex-news' );
				 } else {
					 //fallback to default WP content in case News is just dropped into default WizzyWig ?>
						<div class="post-entry"><?php the_content();?></div>
				<?php } ?>
			 </article>

			<?php endwhile; // End of the loop. ?>
			<?php if(get_post_type() !== 'espresso_events'){ ?>
			<nav class='navigation post-navigation' role='navigation'>
				<h2 class='screen-reader-text'>Post navigation</h2>
				<div class="news-links">
					<a href="<?php the_field('site_news_link', $siteID); ?>">Back to All News</a>
				</div>
			</nav>
		<?php } ?>

			</main><!-- #main -->
		</div><!-- #primary -->
		<?php 
			if(get_post_type() !== 'espresso_events'){
				get_sidebar('news'); 

			}
		?>

<?php
get_footer();
