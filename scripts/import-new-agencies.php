<?php 

// Include WordPress
define('WP_USE_THEMES', false);
require('wp-load.php');

$file_path = '/Users/aaronrowe/Desktop/marketing_agencies.csv';

$db_user = 'root';
$db_pass = 'root';
$db_name = 'wrc_marketing_new';
$db_host = 'localhost';
$dbi = new wpdb($db_user, $db_pass, $db_name, $db_host);


//delete stuff
$delete_agent_meta = $dbi->query("delete from wp_postmeta where post_id in (select id from wp_posts where post_type = 'agent');");
var_dump("deleted agent meta: $delete_agent_meta");
$delete_agents = $dbi->query("delete from wp_posts where post_type = 'agent'");
var_dump("deleted agents: $delete_agents");


//import new stuff
//$input_csv_contents = file_get_contents($file_path);
$agencies_data_all = get_csv($file_path);


$new_posts = 0;
array_shift($agencies_data_all);
foreach($agencies_data_all as $agency){
	$agent_code = $agency[0];
	$agent_name = empty($agency[1]) ? '' : ucwords(strtolower($agency[1]));
	$agent_address = empty($agency[2]) ? '' : ucwords(strtolower($agency[2]));
	$agent_city = empty($agency[3]) ? '' : ucwords(strtolower($agency[3])); 
	$agent_state = $agency[4];
	$agent_zip = $agency[5];
	$agent_phone = $agency[6];
	$agent_website = $agency[7];

	//Add pluses for the Address spaces for Google
	$safe_address = str_replace(' ', '+', $agent_address);

	// Group our separate data
  $agentAddressArray = [$safe_address, $agent_city, $agent_state, $agent_zip ];
  //var_dump($agentAddressArray); die;

	$agentFullAddress = implode('+', $agentAddressArray);
	//$agentLatLong = getLatLong($agentFullAddress);

	$agent_lat = null;
	$agent_long = null;
	if(!empty($agentLatLong)){
		$agent_lat = $agentLatLong[0];
		$agent_long = $agentLatLong[1];
	}

	if(wp_insert_post(array(
		'post_title' => $agent_name,
		'post_type' => 'agent',
		'post_status' => 'publish',
		'meta_input' => array(
			'agent_code' => $agent_code,
			'agent_address' => $agent_address,
			'agent_city' => $agent_city,
			'agent_state' => $agent_state,
			'agent_zip' => $agent_zip,
			'agent_phone' => $agent_phone,
			'agent_website' => $agent_website,
			'agent_lat' => $agent_lat,
			'agent_long' => $agent_long,
		)
	))){
		$new_posts++;
	}

}

var_dump("finished, inserted $new_posts new posts");
die;

function get_csv($file_path){
	$arrResult = array();
	$handle = fopen($file_path, "r");
	if(empty($handle) === false) {
			while(($data = fgetcsv($handle, 1000, ",")) !== FALSE){
					$arrResult[] = $data;
			}
			fclose($handle);
	}

	return $arrResult;
}

?>