<?php

include('../../../wp-blog-header.php');

//print_r( $_REQUEST);



//echo plugins_url();



	global $wpdb;

	$table_name = $wpdb->prefix . "geo_redirector";





		$id = $_REQUEST['hid_id'];

		$address =  $_REQUEST['formatted_address']; // $_REQUEST['address'];

		$latitude = $_REQUEST['latitude'];

		$longitude = $_REQUEST['longitude'];

		$cur_url = $_REQUEST['cur_url'];

		$red_url = $_REQUEST['red_url'];

		$radius = $_REQUEST['radius'];

		$isnot = $_REQUEST['isnot'];

		

		echo 'test id -' . $id ;



		if( $id == ''){



		$insert = "INSERT INTO " . $table_name . " (address, latitude,longitude,cur_url,red_url,radius,isnot) " . "VALUES ('" . $wpdb->escape($address) . "','" . $wpdb->escape($latitude) . "','" . $wpdb->escape($longitude) . "','" . $wpdb->escape($cur_url) . "','" . $wpdb->escape($red_url) . "','" . $wpdb->escape($radius) . "','" . $wpdb->escape($isnot) . "')";

		$results = $wpdb->query( $insert );

		}

		else

		{

			$updatequery = "UPDATE " . $table_name . " SET address = '" . $wpdb->escape($address) . "', latitude = '" . $wpdb->escape($latitude) . "',longitude = '" . $wpdb->escape($longitude) . "',cur_url = '" . $wpdb->escape($cur_url) . "',red_url = '" . $wpdb->escape($red_url) . "',radius = '" . $wpdb->escape($radius) . "',isnot = '" . $wpdb->escape($isnot) . "' where id = '" . $wpdb->escape($id) . "';";

			

			$results = $wpdb->query( $updatequery );

			

			}



?>



