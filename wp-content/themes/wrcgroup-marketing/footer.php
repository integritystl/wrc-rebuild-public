<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wrcgroup_marketing
 */

 //Get the current site that we are on.
 $site = get_current_site();

 //Find the Footer menu of the site we're on
 if ($site) {
   $footerMenu = get_field('footer_menu', $site->ID);
   $footerGoogle = get_field('footer_google_plus', $site->ID);
 }

?>

	</div><!-- #content -->

  <a href="#" id="back-to-top" title="Back to top">&uarr;</a>
<!-- Start Footer -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<div class="group-logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/THEWRCGROUPOFCOMPANIESwdmk_188_blk_JMb.svg" alt="WRC Companies" /></div>
				<div class="footer-logos">
					<?php
						$siteArgs = array (
							'post_type' => 'site',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC'
						);

						$siteQuery = new WP_Query($siteArgs);
						if( $siteQuery->have_posts()): while($siteQuery->have_posts()): $siteQuery->the_post();
						      $footerLogo = get_field('site_logo');
						?>
              <a href="<?php echo get_field('landing_page');?>" class="footer-logo
                <?php if(get_the_ID() == $site->ID) echo "active"; ?>">
                  <?php echo file_get_contents(str_replace( home_url(), ".", $footerLogo['sizes']['medium'] )); ?>
              </a>
						<?php
						endwhile; endif;
						wp_reset_postdata();

					?>

				</div>
				<?php if ($site && $footerMenu) { ?>
					<nav class="footer-site-menu">
						<?php wp_nav_menu(array(
							'menu' => $footerMenu,
							'container' => '',
						)); ?>
					</nav>
				<?php } ?>

				<nav class="footer-global-menu">
					<?php wp_nav_menu(array(
						'theme_location' => 'footer-menu',
						'container' => '',
					)); ?>
				</nav>
                <div class="footer-social">
                <?php //social icons
                    $linkedin = get_field('footer_linkedin', 'option');
                    $facebook = get_field('footer_facebook', 'option');
                    $twitter = get_field('footer_twitter', 'option');

                    if ($linkedin || $facebook || $twitter) :

                        if ($linkedin) { ?>
                    <a href="<?php echo $linkedin; ?>" target="_blank" aria-label="LinkedIn"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        <?php }
                        if ($facebook) { ?>
                    <a href="<?php echo $facebook; ?>" target="_blank" aria-label="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <?php }
                        if ($twitter) { ?>
                    <a href="<?php echo $twitter; ?>" target="_blank" aria-label="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <?php }

                        endif; ?>

                    <small>&copy; <?php echo date("Y"); ?> The WRC Group. All Rights Reserved.</small>
				</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
<!--End of Footer-->
  <?php
    //Nab the modals based on the sites that need them
    if ($site->post_name === '1st-auto' || $site->post_name === 'wrc-agency') {
      get_template_part( 'template-parts/modal', 'company' );
    }

     if ($site->post_name === '1st-auto') {
       get_template_part( 'template-parts/modal', 'otto' );
     }
  ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
