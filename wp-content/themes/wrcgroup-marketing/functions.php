<?php
/**
 * wrcgroup_marketing functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wrcgroup_marketing
 */

require_once( __DIR__ . '/wrc_infrastructure/CustomPostTypes/SiteCPT.php');
require_once( __DIR__ . '/wrc_infrastructure/CustomPostTypes/AgentCPT.php');
require_once( __DIR__ . '/wrc_infrastructure/CustomPostTypes/MutualCPT.php');
require_once( __DIR__ . '/wrc_infrastructure/CustomPostTypes/CareerCPT.php');
require_once( __DIR__ . '/wrc_infrastructure/CustomPostTypes/HelpCPT.php');
require_once( __DIR__ . '/wrc_infrastructure/CustomPostTypes/WiReCPT.php');
require_once( __DIR__ . '/wrc_infrastructure/CustomPostTypes/AgencyNewsletterCPT.php');
require_once( __DIR__ . '/wrc_infrastructure/CustomPostTypes/MutualManagerCPT.php');
require_once( __DIR__ . '/wrc_infrastructure/CustomTaxonomies/postTaxonomies.php');
require_once( __DIR__ . '/wrc_infrastructure/CustomTaxonomies/careerTaxonomies.php');
require_once( __DIR__ . '/wrc_infrastructure/GlobalACF/OptionsPage.php');
require_once( __DIR__ . '/wrc_infrastructure/TemplateACFFields/TemplateACFFields.php');
require_once( __DIR__ . '/wrc_infrastructure/Services/CommonServices.php');
require_once( __DIR__ . '/wrc_infrastructure/News/NewsACF.php');





//add custom post types and related data during initialization
if( ! function_exists('wrcgroup_infrastructure')){
	function wrcgroup_infrastructure(){
		\WRCInfrastructure\CustomTaxonomies\postTaxonomies::setupPostTaxonomies();
		\WRCInfrastructure\CustomTaxonomies\careerTaxonomies::setupCareerTaxonomies();
		\WRCInfrastructure\CustomPostTypes\SiteCPT::setupSites();
		\WRCInfrastructure\CustomPostTypes\AgentCPT::setupAgents();
		\WRCInfrastructure\CustomPostTypes\MutualCPT::setupMutuals();
		\WRCInfrastructure\CustomPostTypes\CareerCPT::setupCareers();
		\WRCInfrastructure\CustomPostTypes\HelpCPT::setupHelp();
		\WRCInfrastructure\CustomPostTypes\WiReCPT::setupWiRe();
		\WRCInfrastructure\CustomPostTypes\AgencyNewsletterCPT::setupAgencyNewsletter();
		\WRCInfrastructure\CustomPostTypes\MutualManagerCPT::setupMutualManager();
		\WRCInfrastructure\GlobalACF\OptionsPage::setupACFOptionsPage();
		\WRCInfrastructure\TemplateACFFields\TemplateACFFields::setupTemplateACFFields();
		\WRCInfrastructure\News\NewsACF::setupNewsFields();

	}
}
add_action('init', 'wrcgroup_infrastructure');

if ( ! function_exists( 'wrcgroup_marketing_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wrcgroup_marketing_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on wrcgroup_marketing, use a find and replace
	 * to change 'wrcgroup_marketing' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wrcgroup_marketing', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'footer-menu' => esc_html__( 'Global Footer Menu', 'wrcgroup_marketing' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wrcgroup_marketing_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'wrcgroup_marketing_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wrcgroup_marketing_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wrcgroup_marketing_content_width', 640 );
}
add_action( 'after_setup_theme', 'wrcgroup_marketing_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wrcgroup_marketing_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wrcgroup_marketing' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wrcgroup_marketing' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wrcgroup_marketing_widgets_init' );

/**
 * Enqueue scripts and styles.
 *
 * @todo the site isn't using the minified stylesheet. and it looks like the min process isn't setup in gulpfile
 */
function wrcgroup_marketing_scripts() {
	wp_enqueue_style( 'wrcgroup_marketing-style', get_stylesheet_uri(), array());
	//Move Jquery to footer
	wp_deregister_script( 'jquery' );
	wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-3.4.1.min.js', array(), null, true);
	//For DataTables JS on Find an Agent/Mutual
	if (is_page_template('page-find-agent.php') || is_page_template('page-1stauto-home.php') || is_page_template('page-wrc-home.php')){
		wp_enqueue_style( 'wrcgroupd_marketing-datables-style', '//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css', array('jquery'), null, true);
		wp_enqueue_script( 'wrcgroupd_marketing-datatables-scripts', '//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js', array('jquery'), '20170829', true);
	}

	//Tablepress loads a min stylesheet of DataTable that we don't need on Find Agent/Mutual pages
	if ( is_page_template('page-find-agent.php') ) {
		add_filter( 'tablepress_use_default_css', '__return_false' );
	}

	if ( is_page_template('page-find-agent.php') || is_page_template('page-1stauto-home.php') || is_page_template('page-wrc-home.php')  ){
		wp_enqueue_script( 'find-agent-search', get_template_directory_uri() . '/js/find-agent-search.js', array('jquery'), false, true );
		//need a check if we're on 1st Auto Home or WRC Home so we don't run parts of ajax vars there
		if (is_page_template('page-find-agent.php')) {
			$tablePage = true;
		} else {
			$tablePage = false;
		}

		wp_localize_script( 'find-agent-search', 'rest_object', array(
			'api_nonce' => wp_create_nonce( 'wp_rest' ),
			'api_url'   => home_url('/wp-json/rest/v3/'),
			'permalink' => get_the_permalink(),
			'isTablePage' => $tablePage,
			'objectType' => get_field('display_agents_or_mutuals', get_the_ID()),
		) );
	}

	wp_enqueue_script( 'wrcgroup_marketing-parsley', get_template_directory_uri() . '/js/parsley.min.js', array('jquery'), '20170821', true );
	wp_enqueue_script( 'wrcgroup_marketing-sidr', get_template_directory_uri() . '/js/jquery.sidr.min.js', array('jquery'), '20171001', true );
	wp_enqueue_script( 'wrcgroup_marketing-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), false, true );

	if(is_page_template('page-help.php')) {
		wp_enqueue_script( 'wrcgroup_marketing-help', get_template_directory_uri() . '/js/help.js', array('jquery'), false, true );
	}
	//wp_enqueue_script( 'wrcgroup_marketing-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if (is_page_template('page-news.php') || is_single() ){
		$site = get_current_site();
		wp_enqueue_script( 'news-load-more', get_template_directory_uri() . '/js/news-load-more.js', ('jquery'), '1.0', true );

		if ( is_single() ) {
			$newsURL = get_field('site_news_link', $site);
			$redirectNews = true;
		} else {
			$newsURL = '';
			$redirectNews = false;
		}

		wp_localize_script( 'news-load-more', 'rest_object',
			array(
					'api_nonce' => wp_create_nonce( 'wp_rest' ),
					'api_url'   => home_url('/wp-json/rest/v3/'),
					'posts_per_page' => get_option('posts_per_page'),
					'single' => is_single(),
					'newsURL' => $newsURL, //need the newsURL to help redirect single posts with ajax
					'redirect' => $redirectNews,
			)
		);
	}
	if (is_search()){
		$site = get_current_site();
		if(isset($_GET['current_site'])){
			$site = $_GET['current_site'];
		}

		wp_enqueue_script( 'results-load-more', get_template_directory_uri() . '/js/results-load-more.js', ('jquery'), '1.0', true );

		wp_localize_script( 'results-load-more', 'rest_object',
			array(
					'api_nonce' => wp_create_nonce( 'wp_rest' ),
					'api_url'   => home_url('/wp-json/rest/v3/'),
					'posts_per_page' => get_option('posts_per_page'),
					'current_site' => $site,
					//'newsURL' => get_field('site_news_link', $site), //need the newsURL to help redirect single posts with ajax
			)
		);

	}
}
add_action( 'wp_enqueue_scripts', 'wrcgroup_marketing_scripts' );

add_action( 'admin_enqueue_scripts', 'wrcgroup_marketing_admin_scripts' );
if(!function_exists('wrcgroup_marketing_admin_scripts')){
	function wrcgroup_marketing_admin_scripts(){
		wp_enqueue_script( 'wrcgroup_marketing_admin-input_mask', get_template_directory_uri() . '/js/jquery.inputmask.js', array('jquery'), '20170821', true );
		wp_enqueue_script( 'wrcgroup_marketing_admin-input', get_template_directory_uri() . '/js/admin-custom-input.js', array('jquery'), '20170821', true );
		wp_enqueue_script( 'wrcgroup_marketing_admin-simplyCountable', get_template_directory_uri() . '/js/jquery.simplyCountable.js', array('jquery'), '20180126', true );
		wp_enqueue_script( 'wrcgroup_marketing_admin-excerpt-count', get_template_directory_uri() . '/js/admin-excerpt-count.js', array('jquery'), '20180126', true );
	}
}

//Use Geolocation to search Agent/Mutual tables by distance from User if we have it
add_action( 'rest_api_init', 'rest_find_agent_endpoint' );
function rest_find_agent_endpoint(){
	register_rest_route( 'rest/v3', '/load_location_dist/', array(
	    'methods'   => 'POST',
	    'callback'  => 'load_location_dist',
	) );
}
//not sure i need this?
function load_location_dist($request){
	$params = $request->get_params();
	$userLat = $params["lat"];
	$userLong = $params["long"];
	$objType = $params["objectType"];
	$distanceSearch = $params["distanceSearch"];

	$radiusArgs = array(
		'post_type' => $objType,
		//'post_type' => 'mutual',
		'posts_per_page' => -1,
		'order' => 'ASC',
		'orderby' => 'title',
		'post_status' => 'publish'
	);
	$radiusQuery = new WP_Query($radiusArgs);

	$radiusSearch = NULL;
	$radiusLat = 'no lat long';

	if( isset($radiusQuery) && $radiusQuery->have_posts() ):
		while( $radiusQuery->have_posts() ): $radiusQuery->the_post();
			//echo get_the_title();
			if(!$distanceSearch){
				$dist = find_distance($userLat, $userLong, get_field('agent_lat'), get_field('agent_long') );
					//echo "<p class='distance'>" . $dist . "</p>";
				echo $dist;
				// if($dist != null) {
				// 	echo $dist;
				// 	echo "<p>distance</p>";
				// }
			}
		endwhile;
	endif;
	die();
}

//Add endpoint to re-save Agents & Mutual post types so we have lat/long data after an import
//Leave this commented out until times when we need to use it
//add_action( 'rest_api_init', 'rest_agent_mutual_save_endpoint' );

function rest_agent_mutual_save_endpoint(){
	register_rest_route( 'rest/v3', '/agent_mutual_save/', array(
		'methods'   => 'GET',
		'callback'  => 'agent_mutual_save',
	) );
}
//Run our lat long function to check addresses and resave
function agent_mutual_save($request) {
	$params = $request->get_params();
	// var_dump($params);
	// wp_die();
	//WP Query for agent and mutual posts
	$agentMutualArgs = array(
		'post_type' => array('mutual', 'agent'),
		//'post_type' => 'mutual',
		'posts_per_page' => -1,
		'post_status' => 'publish',
	);

	$agentMutualQuery = new WP_Query($agentMutualArgs);

	if( $agentMutualQuery->have_posts() ):
		while( $agentMutualQuery->have_posts() ): $agentMutualQuery->the_post();

				//check if the key exists at all, also check if there's a key with no value
					 $idGroup = array();
					 $missingGroup = array();
					 foreach ($agentMutualQuery->posts as $agentPost) {
						 $idGroup[] = $agentPost->ID; //all ids
						 $latField = get_post_meta($agentPost->ID, 'agent_lat', true);
						 $longField = get_post_meta($agentPost->ID, 'agent_long', true);
						 //if there's not a lat/long, add the post ID to an array
						 //this also catches if its null or the key doesn't exist
						 if (!$latField || !$longField) {
						 	$missingGroup[] = $agentPost->ID;
						}
					 }

					//Now run a check through the posts in batches of ten
					//pass the ID through the function
					//it'll have to be re-run if more than 10 are found
					if ( count($missingGroup) <= 10 ) {
						foreach($missingGroup as $updateId){
							add_lat_long_for_search($updateId);
						}
						return new \WP_REST_Response(
							array('message' => 'These posts were missing latitude and/or longitude. We attempted to save them.',
							'total_query' => $agentMutualQuery->found_posts,
							'total_found_from_query' => count($missingGroup),
							'posts_update_attempt' => $missingGroup,
							'total_posts_checked' => $missingGroup,
						));
					} else {
						//Split up the array of posts missing lat/long into a batch of 10,
						//then run the function on those 10
						$updatedIds = array_slice($missingGroup, 0, 10);

						foreach($updatedIds as $updateId){
							//var_dump($updateId);
							add_lat_long_for_search($updateId);
						}

						return new \WP_REST_Response(
							array('message' => 'Updated a batch of 10. These posts were missing latitude and/or longitude. We attempted to save them.',
							'total_query' => $agentMutualQuery->found_posts,
							'total_found_from_query' => count($missingGroup),
							'posts_update_attempt' => $updatedIds,
							'total_posts_checked' => $missingGroup,

						));
					}

		endwhile;
	else:

	endif;
	// wp_die();
}

//Add endpoint for Load More News button
add_action( 'rest_api_init', 'rest_news_load_endpoint' );
function rest_news_load_endpoint(){
	register_rest_route( 'rest/v3', '/load_more_news/', array(
	    'methods'   => 'POST',
	    'callback'  => 'load_more_news',
	    'args'      => array(
	        'category'  => array( 'required' => false ),
					'tag'  => array( 'required' => false ),
					'ppp'  => array( 'required' => true, 'default' => get_option('posts_per_page') ),
					'paged'  => array( 'required' => true ),
	    )
	) );
}

function load_more_news($request){
	$params = $request->get_params();
	$site = $params["site"];
	$pageNum = $params["paged"];

	$newsTax = get_field('post_site_taxonomy', $site);

	$newsArgs = array(
		'post_type' => 'post',
		'posts_per_page' => $params["ppp"],
		'paged' => $params["paged"],
		'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'post-site',
				'field' => 'term_id',
				'terms' => $newsTax
			),
		)
	);

	if(!empty($params["category"])){
		//add category if it's sent
		$cat_string = htmlspecialchars($params["category"]);
		$cat_int = intval($cat_string);
		array_push($newsArgs['tax_query'], array(
			'taxonomy' => 'category',
			'field' => 'term_id',
			'terms' => $cat_int
		));
	}

	if(!empty($params["tag"])){
		//add a tag if it's sent
		$tag_string = htmlspecialchars($params["tag"]);
		$tag_int = intval($tag_string);
		$newsArgs['tag_id'] = $tag_int;
	}

	$newsQuery = new WP_Query($newsArgs);

	if( $newsQuery->have_posts() ):
		while( $newsQuery->have_posts() ): $newsQuery->the_post();
				//share $site variable in template partial by using locate template
				include(locate_template('template-parts/content-news-list.php'));
		endwhile;
	else:
		echo "<p class='load-more-no-posts'>No more posts.</p>";
	endif;
	//wp_reset_query();
	die();
}

//Add endpoint for Load More button on Search Results
add_action( 'rest_api_init', 'rest_results_load_endpoint' );
function rest_results_load_endpoint(){
	register_rest_route( 'rest/v3', '/load_more_results/', array(
	    'methods'   => 'POST',
	    'callback'  => 'load_more_results',
	    'args'      => array(
	        'category'  => array( 'required' => false ),
					'tag'  => array( 'required' => false ),
					'ppp'  => array( 'required' => true, 'default' => get_option('posts_per_page') ),
					'page'  => array( 'required' => true ),
					'search' => array( 'required' => true, 'default' => get_search_query() )
	    )
	) );
}

if ( is_plugin_active( 'relevanssi/relevanssi.php' ) || is_plugin_active('relevanssi-premium/relevanssi.php') ) {
	//Relevanssi needs help accessing the Post Object field type from ACF for its search results because its just saved as an ID
	// https://wordpress.org/support/topic/wont-index-acf-post-object-data/
	// https://www.relevanssi.com/knowledge-base/advanced-custom-fields-relationship-fields/
	add_filter('relevanssi_content_to_index', 'add_post_object_data', 10, 2);
	function add_post_object_data($content, $post) {

			if(have_rows('help_questions', $post->ID)): while(have_rows('help_questions', $post->ID)): the_row();
				$helpPost = get_sub_field('help');
				$helpPostID = $helpPost->ID;
				$content .= get_field('label_question', $helpPostID);
				$content .= " " . get_field('answer', $helpPostID);
			endwhile; endif;

		return $content;
	}
	// Relevanssi doesn't understand using ACF Repeater Fields in the results excerpts unless we pass notation for it,
	//	this makes results found in these fields viewable
	// https://www.relevanssi.com/knowledge-base/add-custom-fields-search-excerpts/
	// https://www.relevanssi.com/knowledge-base/acf-subfields/
	add_filter('relevanssi_excerpt_content', 'acf_repeaters_to_excerpts', 2, 3);
	function acf_repeaters_to_excerpts($content, $post, $query) {
			//get arbitrary acf fields, maybe
	    $custom_field = get_post_meta($post->ID, 'field_%', true);
	    $content .= " " . $custom_field;

			// find Help content ACF
			if(have_rows('help_questions', $post->ID)): while(have_rows('help_questions', $post->ID)): the_row();
				$helpPost = get_sub_field('help');
				$helpPostID = $helpPost->ID;
				$content .= get_field('label_question', $helpPostID);
				$content .= " " . get_field('answer', $helpPostID);
			endwhile; endif;

			//For News Flexible content
			if(have_rows('news_flexible_content', $post->ID)): while(have_rows('news_flexible_content', $post->ID)): the_row();
				$content .= get_sub_field('content', $post->ID); //single column content field
			endwhile; endif;

	    return $content;
	}
}

function load_more_results($request){
	$params = $request->get_params();

	$currentSearch = $params["search"];
	$site = $params["site"];

	if ( is_plugin_active( 'relevanssi/relevanssi.php' ) || is_plugin_active('relevanssi-premium/relevanssi.php') ) {
		$searchQuery = new WP_Query();
		    $searchQuery->query_vars['s'] = $currentSearch;
		    $searchQuery->query_vars['posts_per_page'] = $params["ppp"];
				$searchQuery->query_vars['paged'] = $params["page"];
		    relevanssi_do_query($searchQuery);
	} else {
		$searchArgs = array(
			's' => $currentSearch,
			'posts_per_page' => $params["ppp"],
			'paged' => $params["page"],
			'post_status' => 'publish',
		);
		$searchQuery = new WP_Query($searchArgs);
	}

	if( $searchQuery->have_posts() ):
		if ($params["page"] == 1 ) {
			echo "<header class='page-header'>
				<h1 class='page-title'>Search Results for: <span>" . $currentSearch . "</span></h1>
			</header>";
		}
	while( $searchQuery->have_posts() ): $searchQuery->the_post();
			//get_template_part( 'template-parts/content', 'search' );
			//share $site variable in template partial by using locate template
			include(locate_template('template-parts/content-search.php'));
		endwhile;
	else:
		if ($params["page"] != 1 ) {
			echo "<p class='load-more-no-posts'>No more posts.</p>";
		} else {
			echo "<header class='page-header'>
				<h1 class='page-title'>No Results for: <span>" . $currentSearch . "</span></h1>
			</header>";
			echo "<p class='search-no-results'>Please try another search.</p>";
			get_search_form();
		}

	endif;

die();
}

// Function for calculating approximate distance between two coordinate points
// Based on: http://www.movable-type.co.uk/scripts/latlong.html
function find_distance($lat1, $lon1, $lat2, $lon2) {
	if(!$lat2 || !$lon2) {
		return null;
	}
	$r = 6371000;
	$l1 = deg2rad($lat1);
	$l2 = deg2rad($lat2);
	$d1 = deg2rad($lat2-$lat1);
	$d2 = deg2rad($lon2-$lon1);

	$a = (sin($d1/2) * sin($d1/2)) + (cos($l1) * cos($l2) * sin($d2/2) * sin($d2/2));
	$b = 2 * atan2(sqrt($a), sqrt(1-$a));
	$dist = $r * $b * 0.00062137; // Convert from meters to miles
	$dist = round($dist);
	return $dist;
}

//Nab latitude and longitude from Google Maps to use for Agent things based on status codes
//https://developers.google.com/maps/documentation/geocoding/intro#StatusCodes
function getLatLong($queryLatLong){
	$getGeocode = wp_remote_retrieve_body( wp_remote_get('https://maps.googleapis.com/maps/api/geocode/json?address=' . $queryLatLong . '&key=AIzaSyABV32JcJ3PG7HkBWdvFFIJN7CatoOPjC4') );
	$geoOutput = json_decode($getGeocode);
	if ( $geoOutput->status === "OK" ) {
		$latitude = $geoOutput->results[0]->geometry->location->lat;
		$longitude = $geoOutput->results[0]->geometry->location->lng;
		$queryLatLong = array($latitude, $longitude);
	 	return $queryLatLong;
	} else if ( empty($geoOutput->results[0]) ) {
		//empty results return as:
		// "results": [],
		$queryLatLong = false;
		//$queryLatLong = $geoOutput->results;
		return $queryLatLong;
	} else {
		return;
	}
}

//Find Agent search from Homepage module
function home_search_query($homeQuery) {
	if ( isset($_GET[$homeQuery]) && !empty($_GET[$homeQuery]) ){
		$currentHomeQuery = $_GET[$homeQuery];
		if ( ctype_digit($currentHomeQuery) && ( strlen($currentHomeQuery) === 5) ) {

			$currentHomeQuery = getLatLong($currentHomeQuery);
			return $currentHomeQuery;
			// var_dump($currentHomeQuery);
			// echo $currentHomeQuery[0];
			// echo $currentHomeQuery[1];
		} else {
			//if it's not a zip code we're not doing anything special
			//return 'nope';
			return;
		}
	}
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
* Add SVG Support
*/
function svg_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'svg_mime_types');

/**-------------------------
*
* Services
*
* We use these to setup common functions that call into our services.
*
----------------------------**/
/**
* Get Site Functionality
**/
add_action('template_redirect', 'get_current_site');
function get_current_site() {
	return \WRCInfrastructure\Services\CommonServices::getCurrentSite();
}
//Excerpt truncation function
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

/**-------------------------
* Check Agent CPT for address, save it to the Lat/Long field for Distance searching
*
----------------------------**/
if(!function_exists('add_lat_long_for_search')) {
  function add_lat_long_for_search($post_id)
  {
    $post_type = get_post_type($post_id);
		if (!$post_type == 'agent' && !$post_type == 'mutual') return;

    if($post_type == 'agent' || $post_type == 'mutual') {
			//Get the data for location
      $agentAddress = sanitize_text_field( get_field('agent_address', $post_id) );
			$agentCity = sanitize_text_field( get_field('agent_city', $post_id) );
			$agentState = get_field('agent_state', $post_id);
			$agentZip = sanitize_text_field( get_field('agent_zip', $post_id) );

			//Add pluses for the Address spaces for Google
			$agentAddress = str_replace(' ', '+', $agentAddress);

			// Group our separate data
			$agentAddressArray = [$agentAddress, $agentCity, $agentState, $agentZip ];
			//Make it a single string so it's not all brackety when we use it for Google
			$agentFullAddress = implode('+', $agentAddressArray);

			//Query Google Maps to get lat/long to save to our post
			$agentLatLong = getLatLong($agentFullAddress);

			//if results are empty
			if ( empty($agentLatLong) ) {
				//bail is there's an error and don't update the lat/long fields
				return;
				//  print_r('Not saving');
				//  var_dump($agentLatLong);
			} else {
				// print_r('saved');
				// print_r($agentLatLong);
				$agentLat = $agentLatLong[0];
				$agentLong = $agentLatLong[1];

	      //We need to remove and re-add the action so that it doesn't infinite loop
	      remove_action('save_post', 'add_lat_long_for_search');

				 if ( isset( $agentFullAddress ) ) {
	       	update_post_meta($post_id, 'agent_lat', $agentLat);
					update_post_meta($post_id, 'agent_long', $agentLong);
	  		 }

				add_action( 'save_post', 'add_lat_long_for_search');
			}

    }
  }
}

add_action( 'save_post', 'add_lat_long_for_search');


//reusable header markup generation
if(!function_exists('get_sites_nav_markup')){
	function get_sites_nav_markup($current_site){
		$markup = '';

		$markup .= '<div class="site_navigation">';

		$siteArgs = array (
			'post_type' => 'site',
			'posts_per_page' => -1,
			'orderby' => 'menu_order',
			'order' => 'ASC'
		);

		$siteQuery = new WP_Query($siteArgs);
		if( $siteQuery->have_posts()){
			while($siteQuery->have_posts()){
				$siteQuery->the_post();

				$markup .= '<a class="site_nav_item top_nav_item';
				$markup .= (get_the_ID() === $current_site->ID ? ' active"' : '"');
				$markup .= 'href="' . get_field('landing_page') . '">';
				$markup .= get_the_title();
				$markup .= '</a>';
			}
		}
		wp_reset_query();
		$markup .= '</div>';

		return $markup;
	}
}

if(!function_exists('get_news_nav_item_markup')){
	function get_news_nav_item_markup($current_site){
		$markup = '';

		if($current_site){
			$markup .= '<a class="top_nav_item" ';
			$markup .= 'href="' . get_field('site_news_link', $current_site->ID) . '">';
			$markup .= 'News';
			$markup .= '</a>';
		}

		return $markup;
	}
}

//Allows for a dropdown menu for any added newsletters later
if(!function_exists('newsletter_dropdown_nav_item_markup')){
    function newsletter_dropdown_nav_item_markup() {
        $markup = '';

        $markup .= '<a class="top_nav_item dropdown-newsletter"';
        $markup .= 'href="#">';
        $markup .= 'Newsletters';
        $markup .= '</a>';
        // Adding in the dropdown items
	        $markup .= '<div class="child_nav_wrapper">';
		        $markup .= '<div class="child_nav"><a';
		        $markup .= ' href="/the-wire">';
		        $markup .= 'The WiRe';
		        $markup .= '</a></div>';

		        $markup .= '<div class="child_nav"><a';
		        $markup .= ' href="/mutual-manager">';
		        $markup .= 'Mutual Manager Messenger';
		        $markup .= '</a></div>';

		        $markup .= '<div class="child_nav"><a';
		        $markup .= ' href="/wrcagency-newsletter">';
		        $markup .= 'WRC Agency Newsletter';
		        $markup .= '</a></div>';
	        $markup .= '</div>';

        return $markup;
    }
}

//For mobile
if(!function_exists('get_the_wire_nav_item_markup')){
    function get_the_wire_nav_item_markup() {
        $markup = '';

        $markup .= '<a class="top_nav_item"';
        $markup .= ' href="/the-wire">';
        $markup .= 'The WiRe';
        $markup .= '</a>';

        return $markup;
    }
}

if(!function_exists('get_the_wire_nav_item_markup')){
    function get_the_wire_nav_item_markup() {
        $markup = '';

        $markup .= '<a class="top_nav_item"';
        $markup .= ' href="/wrcagency-newsletter">';
        $markup .= 'WRC Agency Newsletter';
        $markup .= '</a>';

        return $markup;
    }
}

if(!function_exists('get_the_mutual_manager_nav_item_markup')){
    function get_the_mutual_manager_nav_item_markup() {
        $markup = '';

        $markup .= '<a class="top_nav_item"';
        $markup .= ' href="/mutual-manager">';
        $markup .= 'Mutual Manager Newsletter';
        $markup .= '</a>';

        return $markup;
    }
}

if(!function_exists('get_secure_email_nav_item_markup')){
	function get_secure_email_nav_item_markup(){
		$markup = '';

		$markup .= '<a class="top_nav_item"';
		$markup .= ' href="' . get_field('secure_email_url' , 'options') . '"';
		$markup .= ' target="_blank">';
		$markup .= 'Secure Email';
		$markup .= '</a>';

		return $markup;
	}
}

if(!function_exists('get_login_nav_item_markup')){
	function get_login_nav_item_markup($current_site){
		$secureSiteRedirect = (empty($current_site) ? '' : '?site=' . $current_site->post_name);
		$markup = '';

		$markup .= '<div class="top_nav_item">';
		$markup .= '<a class="agent_mutual_login"';
		$markup .= ' href="' . get_field('portal_url' , 'options') . $secureSiteRedirect . '"';
		$markup .= ' target="_blank">';
		$markup .= '<i class="fa fa-user-o" aria-hidden="true"></i>';
		$markup .= 'Agent/Mutual Login';
		$markup .= '</a>';
		$markup .= '</div>';

		return $markup;
	}
}

if(!function_exists('get_phone_nav_item_markup')){
	function get_phone_nav_item_markup($current_site){
		$markup = '';
		$phoneNumber = get_field('site_phone', $current_site->ID);
		$formatedPhone = '';

		//Use field data for tel attribute, but output visually as (###) ###-####
		if (preg_match('/^\d\-(\d{3})\-(\d{3})\-(\d{4})$/', $phoneNumber, $matches)) {
			$formatedPhone = '(' . $matches[1] . ') ' .$matches[2] . '-' .$matches[3];
		} else {
			//fallback to what's in the field if it doesn't match
			$formatedPhone = $phoneNumber;
		}

		if(!empty($current_site)){
			$markup .= '<div class="site_phone">';
			$markup .= '<span><a href="tel:'. $phoneNumber .'">';
			$markup .= '<i class="fa fa-phone" aria-hidden="true"></i>';
			$markup .= $formatedPhone;
			$markup .= '</a></span>';
			$markup .= '</div>';
		}

		return $markup;
	}
}

if(!function_exists('build_post_breadcrumbs')){
	function build_post_breadcrumbs($post_id){
		$current_post = get_post($post_id);
		if($current_post->post_parent !== 0){
			return build_post_breadcrumbs($current_post->post_parent) . ' > ' . $current_post->post_title;
		}

		return $current_post->post_title;
	}
}
//disable Yoast SEO 'make primary' taxonomy feature
add_filter( 'wpseo_primary_term_taxonomies', '__return_empty_array' );

if(!function_exists('get_file_path_from_url')){
	function get_file_path_from_url($url){
		$base_url = site_url();
		$path_parts = explode($base_url, $url);
		if(count($path_parts) > 1){
			$file = $path_parts[1][0] == '/' ? substr($path_parts[1], 1) : $path_parts[1]; //remove initial slash if exists
			return ABSPATH . $file;
		}

		return $url;
	}
}



//Don't display the Users in the API for the site
/// https://wordpress.stackexchange.com/questions/252328/wordpress-4-7-1-rest-api-still-exposing-users
  add_filter( 'rest_endpoints', function( $endpoints ){
    if ( isset( $endpoints['/wp/v2/users'] ) ) {
      unset( $endpoints['/wp/v2/users'] );
    }
    if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
      unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
    }
    return $endpoints;
  });



//Add Query Variable for "WRC" site to The Wire Post Types
function newsletter_wrc_site() {
    $query_var = $_GET["current_site"];
    if ($query_var != 9) :
        wp_safe_redirect( add_query_arg( 'current_site', 9, get_permalink() ) );
    endif;
}

//Start individual newsletter stuffs

//Allow WiRe Posts to choose parent in editor
function wire_post_meta_boxes() {
    add_meta_box( 'wire-issue', 'The WiRe Issues', 'wire_post_parent_meta_box', 'wire-post', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'wire_post_meta_boxes' );
function wire_post_parent_meta_box( $post ) {
    $post_type_object = get_post_type_object( $post->post_type );
    $pages = wp_dropdown_pages( array( 'post_type' => 'wire', 'selected' => $post->post_parent, 'name' => 'parent_id', 'show_option_none' => __( '(no parent)' ), 'sort_column'=> 'menu_order, post_title', 'echo' => 0 ) );
    if ( ! empty( $pages ) ) {
        echo $pages;
    }
}

//Allow Mutual Manager Posts to choose parent in editor
function m_manager_post_meta_boxes() {
    add_meta_box( 'mutual-manager-issue', 'Mutual Manager Issues', 'm_manager_post_parent_meta_box', 'mutual-manager-post', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'm_manager_post_meta_boxes' );
function m_manager_post_parent_meta_box( $post ) {
    $post_type_object = get_post_type_object( $post->post_type );
    $pages = wp_dropdown_pages( array( 'post_type' => 'mutual-manager', 'selected' => $post->post_parent, 'name' => 'parent_id', 'show_option_none' => __( '(no parent)' ), 'sort_column'=> 'menu_order, post_title', 'echo' => 0 ) );
    if ( ! empty( $pages ) ) {
        echo $pages;
    }
}

function wrcagency_newsletter_post_meta_boxes() {
    add_meta_box( 'wrcagency-newsletter-issue', 'WRC Agency Issues', 'wrcagency_newsletter_post_parent_meta_box', 'wa-newsletter-post', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'wrcagency_newsletter_post_meta_boxes' );
function wrcagency_newsletter_post_parent_meta_box( $post ) {
    $post_type_object = get_post_type_object( $post->post_type );
    $pages = wp_dropdown_pages( array( 'post_type' => 'wrcagency-newsletter', 'selected' => $post->post_parent, 'name' => 'parent_id', 'show_option_none' => __( '(no parent)' ), 'sort_column'=> 'menu_order, post_title', 'echo' => 0 ) );
    if ( ! empty( $pages ) ) {
        echo $pages;
    }
}

//Allow WRC Agency Newsletter Posts to choose parent in editor


//Disable autocomplete on login
function disable_autocomplete_login_form() {
    echo <<<html
<script>
	document.getElementById( "user_login" ).autocomplete = "off";
    document.getElementById( "user_pass" ).autocomplete = "off";
</script>
html;
}

add_action( 'login_form', 'disable_autocomplete_login_form' );