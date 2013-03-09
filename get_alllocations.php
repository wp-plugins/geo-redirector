<?php
include('../../../wp-blog-header.php');
//print_r( $_REQUEST);

//echo plugins_url();

include('include.php');

	global $wpdb;
	$table_name = $wpdb->prefix . "geo_redirector";
	$result_current = $wpdb->get_results( "SELECT * FROM ".$table_name.""); 
	echo array2json($result_current);

?>