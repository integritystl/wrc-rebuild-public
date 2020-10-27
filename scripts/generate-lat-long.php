<?php 

// Include WordPress
define('WP_USE_THEMES', false);
require('wp-load.php');

$file_path = '/Users/aaronrowe/Desktop/missing_latlong.csv';

$db_user = 'root';
$db_pass = 'root';
$db_name = 'wrc_marketing_new';
$db_host = 'localhost';
$dbi = new wpdb($db_user, $db_pass, $db_name, $db_host);

$agencies_data_all = get_csv($file_path);
//var_dump($agencies_data_all); die;
$new_posts = 0;

$insert_statement = 'insert into wp_postmeta (post_id, meta_key, meta_value) values ';

foreach($agencies_data_all as $agency){
  $agent_id = $agency[0];
	$agent_name = empty($agency[1]) ? '' : ucwords(strtolower($agency[1]));
	$agent_address = empty($agency[4]) ? '' : ucwords(strtolower($agency[4]));
	$agent_city = empty($agency[5]) ? '' : ucwords(strtolower($agency[5])); 
	$agent_state = $agency[6];
	$agent_zip = $agency[7];

	//Add pluses for the Address spaces for Google
	$safe_address = str_replace(' ', '+', $agent_address);

	// Group our separate data
  $agentAddressArray = array($safe_address, $agent_city, $agent_state, $agent_zip );
  //var_dump($agentAddressArray); die;

  $agentFullAddress = implode('+', $agentAddressArray);
  
	$agentLatLong = getLatLong($agentFullAddress);

	$agent_lat = null;
	$agent_long = null;
	if(!empty($agentLatLong)){
		$agent_lat = $agentLatLong[0];
		$agent_long = $agentLatLong[1];
	}else{
    var_dump("empty lat long: $agentFullAddress");
  }

  $insert_statement .= '(' . $agent_id . ', \'agent_lat\', \'' . $agent_lat . '\'), ';
  $insert_statement .= '(' . $agent_id . ', \'agent_long\', \'' . $agent_long . '\'), ';

}

var_dump($insert_statement);

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