<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wrcgroup_marketing
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
	//Get the current site that we are on.
	$site = get_current_site();

  $siteFavicon = get_field('site_favicon', $site->ID);
  if ($siteFavicon) { ?>
    <link rel="shortcut icon" href="<?php echo $siteFavicon['url']; ?>">
  <?php } else { ?>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/wrc-building-favicon.png">
<?php  }
wp_head();

//markup for use in both main nav and custom mobile nav
$sites_nav_markup = get_sites_nav_markup($site);
$news_nav_item_markup = get_news_nav_item_markup($site);
$newsletter_item_markup = newsletter_dropdown_nav_item_markup();
$wire_item_markup = get_the_wire_nav_item_markup();
$mutualmanager_item_markup = get_the_mutual_manager_nav_item_markup();
$secure_email_nav_item_markup = get_secure_email_nav_item_markup();
$login_nav_item_markup = get_login_nav_item_markup($site);
$phone_nav_item_markup = get_phone_nav_item_markup($site);

if(!empty($site)){
	$menu = get_field('top_menu', $site->ID);
}
?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	
	<header id="masthead" class="site-header" role="banner">

		<!-- Adding Full Width Template stripped header -->
		<?php if(is_page_template('full-width.php')) { ?>
			<div class="top_nav no-nav">
				<div class="top_nav_container">
					<div class="organization_logo">
						
						<a href="<?php echo get_option("siteurl"); ?>"><img src="https://www.thewrcgroup.com/wp-content/uploads/2020/04/WRCLogoColor_CMYK_v2-01.svg" alt="The WRC Group Logo"></a>
					</div>
				</div>
			</div>
		<?php } else { ?>

		<!-- All other pages header -->	
		<div class="top_nav">
			<div class="top_nav_container">
				<div class="organization_logo">
				<?php
					$logo = get_field('wrc_group_logo', 'option');
					$logo = $logo['sizes']['medium'];
				?>
					<img src="<?php echo $logo;?>" alt="The WRC Group Logo"/>
				</div>
				<?php echo $sites_nav_markup; ?>
				<div class="eyebrow_nav">
					<div class="additional_nav_links_container">
						<?php
						//Put in Events link if one's been set in the Site settings
						$siteEvents = get_field('site_events_page', $site->ID);

						if($siteEvents) {
							$siteEventsLink = get_the_permalink($siteEvents->ID);?>
						<a class="top_nav_item" href="<?php echo $siteEventsLink; ?>">Events </a>
					<?php } ?>
						<?php echo $news_nav_item_markup; ?>
                        <?php echo $newsletter_item_markup; ?>
						<?php echo $secure_email_nav_item_markup; ?>
						<?php echo $login_nav_item_markup; ?>
					</div>
					<?php if ($site) { ?>
						<a class="top_nav_item" href="<?php the_field('site_help_link', $site->ID); ?>" aria-label="FAQs">
							<i class="fa fa-question-circle" aria-hidden="true"></i>
						</a>
					<?php } ?>
					<span class="top_nav_item" >
						<i class="fa fa-search" aria-label="Search"></i>
						<div class="top_nav__search" aria-expanded="false">
							<span class="close_header_search"><i class="fa fa-close"></i></span>
							<?php get_search_form(); ?>
						</div>
					</span>
					<div class="mobile-nav-menu-item">
						<button id="mobile-nav-trigger" aria-label="Mobile Menu Toggle">
              <span></span>
              <span></span>
              <span></span>
            </button>
						<div id="mobile-nav-dropdown">
              <div class="mobile-nav__sites-container">
              	<?php echo $sites_nav_markup; ?>
              </div>
							<?php if(!empty($site)) : ?>
								<div class="mobile-nav__site_top_menu">
						      <?php wp_nav_menu(array('menu' => $menu)); ?>
								</div>
							<?php endif; ?>
              <div class="mobile-nav__nav-list-container">
							<ul class="navigation-links-list">
								<?php echo $secure_email_nav_item_markup; ?>
								<?php echo $news_nav_item_markup; ?>
								<?php echo $wire_item_markup; ?>
								<?php echo $mutualmanager_item_markup; ?>
								<?php echo $login_nav_item_markup; ?>
							</ul>

              </div>
            </div>
					</div>
				</div>
			</div>
		</div>

		<?php
		// if we're on a Global page, we can't output any Site specific menus
			if ($site) {	?>
				<div class="site_specific_menu">
					<div class="site_specific_menu_container">
						<?php
							$siteLogo = get_field('site_logo', $site->ID);
							$siteLink = get_field('landing_page', $site->ID);
						?>
						<div class="site_specific_logo">
							<a href="<?php echo $siteLink; ?>">
								<?php echo file_get_contents(str_replace( home_url(), ".", $siteLogo['sizes']['medium'])); ?>
							</a>
						</div>

						<div class="site_top_menu">
				      <?php wp_nav_menu(array('menu' => $menu)); ?>
						</div>
						<?php echo $phone_nav_item_markup; ?>
					</div>
				</div>
			<?php
			//end site-specific menu
			} ?>
		<!-- Ends the full width if statement -->
		<?php } ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<?php if(get_field('announcements_enabled', 'options')) : ?>
			<?php
				$expirationTime = 60;
				if(get_field('announcement_refresh_time', 'options')){
					$expirationTime = get_field('announcement_refresh_time', 'options');
				}
			?>
			<div data-expiration="<?php echo $expirationTime; ?>" class="announcements-banner closed">
				<div class="container">
					<?php
						$announcementHeader = get_field('announcement_header', 'options');
						$announcementText = get_field('announcement_text', 'options');
					?>

					<h4 class="announcement-header"><?php echo $announcementHeader; ?></h4>
					<p class="announcement-text"><?php echo $announcementText; ?></p>
					<a href="" class="announcement-close">Close</a>
				</div>
			</div>
		<?php endif; ?>

		