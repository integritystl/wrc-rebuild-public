<?php
//the sidebar used on most internal Site-specific pages, except for News
//Get the current site that we are on.
$site = get_current_site();
//Using ID of current site, find the ID of the Landing Page it links to use for our Child Menu
 $siteID = $site->ID;
 $parentID = url_to_postid( get_field("landing_page", $siteID) );

	//Query for any posts that have exclude_from_left_nav set to true
	// get the ids to put in exclude param
		$pageArgs = array (
			'post_type' => 'page',
			'posts_per_page' => -1,
			'meta_query' => array(
		 'relation' => 'OR',
  		 array(
  			 'key' => 'exclude_from_left_nav',
  			 'value' => 1,
  			 'compare' => '='
  		 ),
     ),
		);

			$excludeQuery = new WP_Query($pageArgs);

    // exclude parameter takes a comma separated string
    $excludeIDs = '';
			if( $excludeQuery->have_posts() ):
				while( $excludeQuery->have_posts() ): $excludeQuery->the_post();
        $excludeIDs .= get_the_ID() . ',';
				endwhile;
			endif;
			wp_reset_query();
?>



<div id="secondary" class="secondary__child-page">
  <nav class="nav-child-page">
    <span class="nav-child-page__title">Menu</span>
    <ul class="menu-child-page">
      <?php
      //use exclude and pass the IDs of pages marked as Exclude
      $pageArgs = array(
        'title_li' => '',
        'child_of'=> $parentID,
        'exclude' => $excludeIDs,
      );
      wp_list_pages($pageArgs);
      ?>
    </ul>
  </nav>
</div>
