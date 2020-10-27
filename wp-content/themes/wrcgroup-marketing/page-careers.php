<?php
/**
 * Template Name: Careers Page
 * Based on Global Template since Careers is not tied to a specific Site
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wrcgroup_marketing
 */


get_header(); ?>

<div class="child-page">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<?php
			$careerArgs = array(
				'post_type' => 'career',
		    	'posts_per_page' => -1,
				'order' => 'DESC',
				'orderby' => 'date'
			);

			$careerQuery = new WP_Query($careerArgs);

			if ($careerQuery->have_posts()): ?>
				<div class="career-list">
					<?php	while( $careerQuery->have_posts() ): $careerQuery->the_post();
						$careerSiteTaxes = wp_get_object_terms( get_the_ID(), 'career-site', array('fields' => 'names') );
					?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('career-list-item'); ?>>
							<h3><?php the_title(); ?></h3>

							<div class="post_meta">
								<?php if ($careerSiteTaxes) { ?>
									<span class="post_item_date">Company:
										<?php
											if (empty($careerSiteTaxes)) {
												echo " ";
											} else {
												echo '<span>'.implode( '</span> <span>', $careerSiteTaxes).'</span>';
											}
										?>
									</span>
								<?php } ?>
								<!-- <span class="post_item_date"><?php echo get_the_date('n/j/Y', get_the_ID());?></span> -->
							</div>
							<div class="career-content"><?php the_content(); ?></div>
						</article>
					<?php endwhile; ?>
				</div>
			<?php else: ?>
					<p> Currently no positions available.</p>
			<?php	endif;
					wp_reset_query();
			?>
			<div class="career-page-content">
				<?php
				while ( have_posts() ) : the_post();
					//get general Career Content to post above the page
					get_template_part( 'template-parts/content', 'page' );

				endwhile; // End of the loop.
				?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
	<div id="secondary" class="secondary__child-page">
		<nav class="nav-child-page">
			<span class="nav-child-page__title">Menu</span>
			<ul class="menu-child-page">

        <?php
          wp_nav_menu(array(
          'theme_location' => 'footer-menu',
          'container' => '',
          'menu_class' => 'menu-child-page',
          'menu_id' => 'menu-child-page'
          ));
        ?>

			</ul>
		</nav>
	</div>
</div>

<?php
get_footer();
