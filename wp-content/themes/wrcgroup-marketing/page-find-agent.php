<?php
/**
 * Template Name: Find an Agent/Mutual Search
 *
 *
 * @package wrcgroup_marketing
 */

get_header();

//Check if this is the page for agents or mutuals
$objectType = get_field('display_agents_or_mutuals');
//Grab the appropriate hero image
$heroImage = get_field('background_hero_image');
$heroImage = $heroImage['sizes']['large'];
//vars for Geolocation distances
$userLat = '';
$userLong = '';
	//Add a class based on objectType to the table for Various Needs
	if ($objectType == 'agent') {
		$tableClass = 'table-agent';
	} else {
		$tableClass = 'table-mutual';
	}

	//Set a flag we can read to render appropriate distance search dom notes if relevant
	$distanceSearch = false;
	//$distanceSearch = true;
	$have_user_location = false;
	//If we have user lat/long from geolocation to use, assign them to vars
	if ( isset($_POST['userLatitude']) && isset($_POST['userLongitude']) && $_POST['userLatitude'] != '' && $_POST['userLongitude'] != '' )  {
		$userLat = $_POST['userLatitude'];
		$userLong = $_POST['userLongitude'];
		$have_user_location = true;
	} else if ( isset($_GET['userLatitude']) && isset($_GET['userLongitude']) )  {
		$userLat = $_GET['userLatitude'];
		$userLong = $_GET['userLongitude'];
		$have_user_location = true;
	}
	// if (!empty($userLat) && !empty($userLong) ) {
	// 	//Set our distance flag to true so we can render the relevant dom nodes
	// 	$distanceSearch = true;
	// }


	if(($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agent-search-radius-submit'])) || isset($_GET['homepage_search']) || isset($_GET['state_filter'])) {
		if(isset($_POST['agent-search-keywords'])){
			$radiusSearch = $_POST['agent-search-keywords'];

		}
		else if(isset($_GET['homepage_search'])){
			$radiusSearch = $_GET['homepage_search'];

		}
		else{
			$radiusSearch = urldecode($_GET['state_filter']);
		}

		//Need error handling in case search keywords don't make for a valid Google Maps URL, like if someone dumped in a Title instead of City
		$radiusLat = getLatLong(sanitize_text_field($radiusSearch));
		$distanceSearch = true;
		$radiusArgs = array(
			'post_type' => $objectType,
			'posts_per_page' => -1,
			'order' => 'ASC',
			'orderby' => 'title',
			'post_status' => 'publish'
		);
		$radiusQuery = new WP_Query($radiusArgs);
	} else {
		if($have_user_location){
			$distanceSearch = true;
		}
		// No form submission search
		$radiusArgs = array(
			'post_type' => $objectType,
			'posts_per_page' => -1,
			'order' => 'ASC',
			'orderby' => 'title',
			'post_status' => 'publish'
		);
		$radiusQuery = new WP_Query($radiusArgs);

		$radiusSearch = NULL;
		$radiusLat = 'no lat long';
	}

	//We set a value here to jam into the filter box, however we only want to filter if the user has already given us
	//their location, so we need to check that first. This will be used near line 135 to jam into the search
	$filterValue = '';
	$distanceClass = 'secret-distance';
	if($have_user_location){
		$filterValue = $radiusSearch;
		$distanceClass = '';
	}

	$permalink = get_permalink();

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="agent_search_hero">
				<div class="agent_search_image">
					<img src="<?php echo $heroImage;?>" />
				</div>
				<div class="agent_search_hero_content">
					<h1><?php echo get_the_title();?></h1>
					<p>
						<?php echo get_field('hero_content');?>
					</p>
					<div class="form-location-reuse-wrapper">
						<button type="button" class="form-location-reuse-button">Use Location</button>
					</div>
					<div class="agent-search_block">
						<div class="agent_search_block-intro">
							<p>Select a State:</p>
								<ul class="state-select">
									<li><a href="<?php echo($permalink . '?state_filter=Arkansas'); ?>"><span>Arkansas</span></a></li>
									<li><a href="<?php echo($permalink . '?state_filter=Illinois'); ?>"><span>Illinois</span></a></li>
									<li><a href="<?php echo($permalink . '?state_filter=Iowa'); ?>"><span>Iowa</span></a></li>
									<li><a href="<?php echo($permalink . '?state_filter=Missouri'); ?>"><span>Missouri</span></a></li>
									<li><a href="<?php echo($permalink . '?state_filter=South%20Dakota'); ?>"><span>South Dakota</span></a></li>
									<li><a href="<?php echo($permalink . '?state_filter=Wisconsin'); ?>"><span>Wisconsin</span></a></li>
								</ul>
							<p>– or –</p>
						</div>
					<form class="agent-search__form" action="" method="post">
						<span class="form-location-info">Using your location</span>
						<div class="form-location-clear-wrapper">
							<span class="form-location-clear-info">Clear your location data to search by state.</span>
							<button type="button" class="form-location-clear-button">Clear Data</button>
						</div>
						<label for="agent-search-keywords" class="screen-reader-text">Search by City, State, or Zip Code</label>
						<div class="agent_search-input"><i class="fa fa-search"></i><input class="agent-distance-search-box" type="text" id="agent-search-keywords" name="agent-search-keywords" value="" placeholder="Search by City, State, or Zip Code" autocomplete="off"></div>
						<input type="hidden" id="agent-distance-search-userLat" name="userLatitude" value=""/>
						<input type="hidden" id="agent-distance-search-userLong" name="userLongitude" value=""/>
						<input type="submit" class="agent-distance-search-submit" value="See Results" name="agent-search-radius-submit" />
					</form>
				</div>
				</div>
			</div>

			<div class="loading-screen">
				<div class="loader">Loading...</div>
			</div>
			<div class="agent-search__container" id="agent-search__container"
				class="<?php echo $tableClass; ?>"
				data-lat="<?php if($userLat) { echo $userLat; } ?>"
				data-long="<?php if($userLong) { echo $userLong; } ?>"
				data-distance="<?php echo $distanceSearch; ?>"
				data-keyword="<?php echo $filterValue; ?>"
			>

			 <?php if ($radiusSearch !== NULL ) { ?>
				<div id="agent-search-term__container" style="opacity:1; visibility: visible; transition: opacity 0.5s ease-out, visibility 0.5s ease-out;">
			 <?php } else { ?>
				<div id="agent-search-term__container" style="opacity:0; visibility: hidden; transition: opacity 0.5s ease-out, visibility 0.5s ease-out;">
				<?php } ?>
					<span class="search-label">Search for:</span>
					<?php if ($radiusSearch !== NULL ) { ?>
						<span class="search-term"><?php echo $radiusSearch; ?><i class="fa fa-times-circle" aria-label="Remove Term"></i></span>
					<?php } ?>
					<span class="filter-term term-empty"></span>
					<span class="agent-search-clear"><i class="fa fa-times"></i> Clear All Filters</span>
				</div>

				<table id="agent-search__table" class="<?php echo $tableClass; ?>">
						<thead>
							<tr>
								<th>
									<?php
									//Check if we're showing Agents or Mutuals for different Table Headings
									if ($objectType == 'agent') {
										echo 'Agency';
									} else {
										echo 'Mutual';
									} ?>
								</th>
								<th>Address</th>
								<th>
									<?php
									//Check if we're showing Agents or Mutuals for different Table Headings
									if ($objectType == 'agent') {
										echo 'Phone';
									} else {
										echo 'Manager';
									} ?>
									</th>

									<th class="<?php echo $distanceClass; ?>">Miles Away</th>

							</tr>
						</thead>
						<tbody>
						<?php
							if( isset($radiusQuery) && $radiusQuery->have_posts() ):
								while( $radiusQuery->have_posts() ): $radiusQuery->the_post();
								//This is the distance.
								// We only add this if we are doing a distance search based on the User's GeoLocation, if provided
								// This comes from either the Form Submission or on initial Page Load.
								//var_dump($distanceSearch, $userLat, $userLong);
								if($distanceSearch){
 									if ( !empty($userLat) && !empty($userLong) ) {
										$dist = find_distance( get_field('agent_lat'), get_field('agent_long'), $userLat, $userLong );
											if($dist == null) {
												continue;
											}
									} else {
										//If user doesn't give location or blocks it we default to distance from what they searched
										$dist = find_distance($radiusLat[0], $radiusLat[1], get_field('agent_lat'), get_field('agent_long') );
									}
									//nothing
								} else {
									$dist = '';
								}
						?>
						<tr>
							<td>
								<?php
									//check for website first cuz some won't have it
									$agentWebsite = get_field('agent_website', get_the_ID());

									if ($agentWebsite) { ?>
										<a href="<?php echo get_field('agent_website', get_the_ID());?>" target="_blank"><?php echo get_the_title();?></a>
									<?php } else { ?>
										<?php echo get_the_title();?>
									<?php } ?>

							</td>
							<td>
								<?php echo get_field('agent_address', get_the_ID()); ?>
								<br />
								<?php echo get_field('agent_city', get_the_ID()); ?>, <?php echo get_field('agent_state', get_the_ID());?> <?php echo get_field('agent_zip', get_the_ID());?>
								<?php
									//find label of the state abbreviation
									//and output so we can use it in keyword searches (visibily hidden)
									$stateObj = get_field_object('field_agent_state', get_the_ID());
									$stateAbbr = $stateObj['value'];
									$stateLabel = $stateObj['choices'][ $stateAbbr ];
								?>
								<span class="agent-full-state"><?php echo $stateLabel; ?></span>
							</td>
							<td>
								<?php echo get_field('agent_phone', get_the_ID());?> <br />
								<?php echo get_field('agent_manager') ?><br />
								<a href="mailto:<?php echo get_field('agent_manager_email');?>">
									<?php echo get_field('agent_manager_email');?>
								</a>
							</td>
								<td class="<?php echo $distanceClass; ?>">
									<?php echo $dist;?>
								</td>
						</tr>
						<?php
								endwhile;
							endif;
							wp_reset_query();
						?>
						</tbody>
					</table>

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
