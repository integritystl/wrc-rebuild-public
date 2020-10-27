<?php
/**
 * Template Name: Global Page
 * For pages that are not children of any Sites, such as Careers, About WRC Agency Group, & any Legal pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wrcgroup_marketing
 */


get_header(); ?>

<div class="child-page">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );


			endwhile; // End of the loop.
			?>

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
