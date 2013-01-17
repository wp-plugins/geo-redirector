<?php

function geo_redirector_install() {

	//***Installer variables***
	global $wpdb;
	$table_name = $wpdb->prefix . "geo_redirector";
	$geo_redirector_db_version = "1.0.1";

	//***Installer***
	if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		$sql = "CREATE TABLE " . $table_name . " (
			id mediumint(11) NOT NULL AUTO_INCREMENT,
			address varchar(255) NOT NULL,
			latitude varchar(255) NOT NULL,
			longitude varchar(255) NOT NULL,
			cur_url mediumtext NOT NULL,
			red_url mediumtext NOT NULL,
			radius INT,
			isnot varchar(255) NOT NULL,
			UNIQUE KEY id (id)
		);";
		require_once(ABSPATH . 'wp-admin/upgrade.php');
		dbDelta($sql);
		//$demotarget = "http://www.webmaster-source.com/";
		//$demokey = "webresources";
		//$insert = "INSERT INTO " . $table_name . " (target, key1) " . "VALUES ('" . $wpdb->escape($demotarget) . "','" . $wpdb->escape($demokey) . "')";
		//$results = $wpdb->query( $insert );
		add_option("geo_redirector_db_version", $geo_redirector_db_version);
		
	}

	//***Upgrader***
	$installed_ver = get_option( "wsc_gocodes_db_version" );
	if ( $installed_ver != $geo_redirector_db_version ) {
		$sql = "CREATE TABLE " . $table_name . " (
			id mediumint(11) NOT NULL AUTO_INCREMENT,
			address varchar(255) NOT NULL,
			latitude varchar(255) NOT NULL,
			longitude varchar(255) NOT NULL,
			cur_url mediumtext NOT NULL,			
			red_url mediumtext NOT NULL,
			radius INT,
			isnot varchar(255) NOT NULL,
			UNIQUE KEY id (id)
		);";
		require_once(ABSPATH . 'wp-admin/upgrade.php');
		dbDelta($sql);
		update_option( "geo_redirector_db_version", $geo_redirector_db_version );
		
	}

}

function geo_redirector_uninstall() {
	
	global $wpdb;
	$table_name = $wpdb->prefix . "geo_redirector";
	if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
		$sql = "DROP TABLE " . $table_name . ";";
		$results = $wpdb->query($sql );
		delete_option('geo_redirector_db_version');
	}
	
}

?>