<?php
/**
 * Template Name: News
 *
 * This template queries for the news Posts for a Site
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wrcgroup_marketing
 */
 //Get the current site that we are on.
 $site = get_current_site();
 //Using ID of current site, find the ID of the Landing Page it links to use for our Child Menu
	$siteID = $site->ID;
	$parentID = url_to_postid( get_field('landing_page', $siteID) );

	//if we've filtered for any categories from a Single Post
	if ( isset($_GET['cat']) ) {
    $catID = $_GET['cat'];
	}

  //if we've filtered for any tags from a Single Post
  if ( isset($_GET['tag']) ) {
    $tagID = $_GET['tag'];
    $tagTitle = get_tag($tagID);
  }

get_header(); ?>

<div class="child-page">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
      <h1 class="news-title"><?php echo get_the_title($site->ID); ?> News</h1>
      <h2 class="tags-title"><?php if (!empty($tagID)) { echo $tagTitle->name; } ?></h2>
      <h1 class="archive-title"></h1>
      <div class="archive-description">
        <p></p>
      </div>
      <div id="news-list-container" data-site="<?php echo($site->ID); ?>" data-tag="<?php if (!empty($tagID)) { echo $tagID; }?>" data-category="<?php if (!empty($catID) ) { echo $catID; } ?>"></div>
      <div class="loading-screen">
        <div class="loader">Loading...</div>
      </div>
      <button id="load-more-btn" class="btn-hide" data-tag="<?php if (!empty($tagID)) { echo $tagID; }?>" data-category="<?php if (!empty($catID) ) { echo $catID; } ?>">Load More</button>

		</main><!-- #main -->
	</div><!-- #primary -->
  <?php
      if($siteID == 9) {
          get_sidebar('news-wrc');
      } else {
          get_sidebar('news');
      } ?>
</div>

<?php
get_footer();
