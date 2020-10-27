<?php

// Include WordPress
define('WP_USE_THEMES', false);
require('wp-load.php');

$file_path = '/Users/aaronrowe/Desktop/test.json';

$db_user = 'root';
$db_pass = 'root';
$db_name = 'wrc_marketing_test';
$db_host = 'localhost';
$dbi = new wpdb($db_user, $db_pass, $db_name, $db_host);


/*$agency_query = "select ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count, pm1.meta_value as  meta_address, pm2.meta_value as  meta_address_2, pm5.meta_value as  meta_phone, pm6.meta_value as  meta_website from wp_posts as p left join wp_postmeta as pm1 on p.id = pm1.post_id and pm1.meta_key = 'agent_address_line_1' left join wp_postmeta as pm2 on p.id = pm2.post_id and pm2.meta_key = 'agent_address_line_2' left join wp_postmeta as pm5 on p.id = pm5.post_id and pm5.meta_key = 'agent_phone' left join wp_postmeta as pm6 on p.id = pm6.post_id and pm6.meta_key = 'agent_url' where post_type = 'agents_post_type' and (post_status = 'publish' or post_status = 'private') group by p.id;";
$agency_data = $dbi->get_results($agency_query);

$mutuals_query = "select ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count, pm1.meta_value as  meta_agent_address, pm5.meta_value as  meta_agent_phone, pm6.meta_value as  meta_agent_website, pm7.meta_value as meta_agent_city, pm8.meta_value as meta_agent_state, pm9.meta_value as meta_agent_zip, pm10.meta_value as meta_agent_manager, pm11.meta_value as meta_agent_manager_email from wp_posts as p left join wp_postmeta as pm1 on p.id = pm1.post_id and pm1.meta_key = 'address' left join wp_postmeta as pm5 on p.id = pm5.post_id and pm5.meta_key = 'phone' left join wp_postmeta as pm6 on p.id = pm6.post_id and pm6.meta_key = 'website' left join wp_postmeta as pm7 on p.id = pm7.post_id and pm7.meta_key = 'city' left join wp_postmeta as pm8 on p.id = pm8.post_id and pm8.meta_key = 'state' left join wp_postmeta as pm9 on p.id = pm9.post_id and pm9.meta_key = 'zip' left join wp_postmeta as pm10 on p.id = pm10.post_id and pm10.meta_key = 'manager_name' left join wp_postmeta as pm11 on p.id = pm11.post_id and pm11.meta_key = 'manager_email' where post_type = 'client_companies' and (post_status = 'publish' or post_status = 'private') group by p.id order by post_title;";
$mutuals_data = $dbi->get_results($mutuals_query);*/

$users_query = "select ID, user_login, user_pass, user_nicename, user_email, user_url, user_registered, user_activation_key, user_status, display_name, um1.meta_value as meta_admin_color, um7.meta_value as meta_comment_shortcuts, um9.meta_value as meta_description, um10.meta_value as meta_first_name, um13.meta_value as meta_last_name, um18.meta_value as meta_nickname, um24.meta_value as meta_rich_editing, um25.meta_value as meta_show_admin_bar_front, um29.meta_value as meta_use_ssl, um30.meta_value as meta_wp_capabilities, um31.meta_value as meta_wp_user_level, um37.meta_value as meta_wp_user_settings, um38.meta_value as meta_wp_user_settings_time from wp_users as u left join wp_usermeta as um0 on um0.user_id = u.id and um0.meta_key = 'address' left join wp_usermeta as um1 on um1.user_id = u.id and um1.meta_key = 'admin_color' left join wp_usermeta as um2 on um2.user_id = u.id and um2.meta_key = 'agency' left join wp_usermeta as um3 on um3.user_id = u.id and um3.meta_key = 'agree_with_terms_and_conditions' left join wp_usermeta as um4 on um4.user_id = u.id and um4.meta_key = 'approved' left join wp_usermeta as um5 on um5.user_id = u.id and um5.meta_key = 'ca' left join wp_usermeta as um6 on um6.user_id = u.id and um6.meta_key = 'city' left join wp_usermeta as um7 on um7.user_id = u.id and um7.meta_key = 'comment_shortcuts' left join wp_usermeta as um8 on um8.user_id = u.id and um8.meta_key = 'company' left join wp_usermeta as um9 on um9.user_id = u.id and um9.meta_key = 'description' left join wp_usermeta as um10 on um10.user_id = u.id and um10.meta_key = 'first_name' left join wp_usermeta as um11 on um11.user_id = u.id and um11.meta_key = 'ft' left join wp_usermeta as um12 on um12.user_id = u.id and um12.meta_key = 'last_change_password_date' left join wp_usermeta as um13 on um13.user_id = u.id and um13.meta_key = 'last_name' left join wp_usermeta as um14 on um14.user_id = u.id and um14.meta_key = 'last_password_reset' left join wp_usermeta as um15 on um15.user_id = u.id and um15.meta_key = 'li' left join wp_usermeta as um16 on um16.user_id = u.id and um16.meta_key = 'login_attempt_count' left join wp_usermeta as um17 on um17.user_id = u.id and um17.meta_key = 'mutual' left join wp_usermeta as um18 on um18.user_id = u.id and um18.meta_key = 'nickname' left join wp_usermeta as um19 on um19.user_id = u.id and um19.meta_key = 'old_passwords' left join wp_usermeta as um20 on um20.user_id = u.id and um20.meta_key = 'other_permissions' left join wp_usermeta as um21 on um21.user_id = u.id and um21.meta_key = 'pa' left join wp_usermeta as um22 on um22.user_id = u.id and um22.meta_key = 'password_reset_count' left join wp_usermeta as um23 on um23.user_id = u.id and um23.meta_key = 'phone' left join wp_usermeta as um24 on um24.user_id = u.id and um24.meta_key = 'rich_editing' left join wp_usermeta as um25 on um25.user_id = u.id and um25.meta_key = 'show_admin_bar_front' left join wp_usermeta as um26 on um26.user_id = u.id and um26.meta_key = 'sites' left join wp_usermeta as um27 on um27.user_id = u.id and um27.meta_key = 'states' left join wp_usermeta as um28 on um28.user_id = u.id and um28.meta_key = 'um' left join wp_usermeta as um29 on um29.user_id = u.id and um29.meta_key = 'use_ssl' left join wp_usermeta as um30 on um30.user_id = u.id and um30.meta_key = 'wp_capabilities' left join wp_usermeta as um31 on um31.user_id = u.id and um31.meta_key = 'wp_user_level' left join wp_usermeta as um32 on um32.user_id = u.id and um32.meta_key = 'zip' left join wp_usermeta as um33 on um33.user_id = u.id and um33.meta_key = 'default_password_nag' left join wp_usermeta as um34 on um34.user_id = u.id and um34.meta_key = 'locale' left join wp_usermeta as um35 on um35.user_id = u.id and um35.meta_key = 'password_reset_times' left join wp_usermeta as um37 on um37.user_id = u.id and um37.meta_key = 'wp_user-settings' left join wp_usermeta as um38 on um38.user_id = u.id and um38.meta_key = 'wp_user-settings-time' left join wp_usermeta as um39 on um39.user_id = u.id and um39.meta_key = 'initials' left join wp_usermeta as um40 on um40.user_id = u.id and um40.meta_key = 'state' group by u.ID";
$users_data = $dbi->get_results($users_query);

$json_array = array();
/*$json_array['agencies'] = $agency_data;
$json_array['mutuals'] = $mutuals_data;*/
$json_array['users'] = $users_data;


/*var_dump(count($agency_data));
var_dump(count($mutuals_data));*/
var_dump(count($users_data));

$export_json = json_encode($json_array);

$fp = fopen($file_path,"w");
fwrite($fp,$export_json);
fclose($fp);



?>