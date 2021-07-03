<?php

/**
 * Fired during plugin activation
 *
 * @link       https://samuilmarinov.co.uk
 * @since      1.0.0
 *
 * @package    Form_Submissions
 * @subpackage Form_Submissions/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Form_Submissions
 * @subpackage Form_Submissions/includes
 * @author     samuil marinov <samuil.marinov@gmail.com>
 */
class Form_Submissions_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

	global $wpdb;

	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'submissions';
	$sql = "CREATE TABLE $table_name (
	id mediumint(9) NOT NULL AUTO_INCREMENT,
	name varchar(200) NOT NULL,
	email varchar(200) NOT NULL,
	phone varchar(200) NOT NULL,
	service varchar(200) NOT NULL,
	vehicle varchar(200) NOT NULL,
	pickup_time varchar(200) NOT NULL,
	return_time varchar(200) NOT NULL,
	pickup varchar(200) NOT NULL,
	destination varchar(200) NOT NULL,
	created_at datetime NOT NULL,
	PRIMARY KEY  (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	}

}
