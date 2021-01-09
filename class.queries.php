<?php 
/**
* insert setting data into `{prefix}options`
*/
class Queries {
	
	static $wpdb, $op_table;
	function __construct() {
		global $wpdb;
		$prefix = $wpdb->prefix;
		
		self::$wpdb = $wpdb;
		self::$op_table = $prefix."options";
	}

	public function installer() {
		$table = self::$op_table;
		
		$KSA_registerOnline = self::$wpdb->get_results("SELECT `option_id` FROM `{$table}` WHERE `option_name`='KSA_registerOnline_Username'");
		if (sizeof($KSA_registerOnline) == 0) {
			self::$wpdb->get_results("INSERT INTO `{$table}` 
				(`option_name`, `option_value`) VALUES 
				('KSA_registerOnline_Username', '123'),
				('KSA_registerOnline_Password', '123'),
				('KSA_registerOnline_PackageId', '123')");
		}
	}

	public function get_setting() {
		$table = self::$op_table;
		
		$KSA_registerOnline = self::$wpdb->get_results("SELECT * 
			FROM `{$table}` 
			WHERE `option_name`='KSA_registerOnline_Username'
			OR `option_name`='KSA_registerOnline_Password'
			OR `option_name`='KSA_registerOnline_PackageId'
			ORDER BY `option_id`");

		return $KSA_registerOnline;
	}

	public function update_setting($KSA_registerOnline_Username,$KSA_registerOnline_Password,$KSA_registerOnline_PackageId) {
		$table = self::$op_table;
		
		$x = self::$wpdb->update("{$table}"
			, array(
				'option_value' => $KSA_registerOnline_Username
			), array(
				'option_name' => 'KSA_registerOnline_Username'
			), array(
				'%s'
			)
		);

		self::$wpdb->update("{$table}"
			, array(
				'option_value' => $KSA_registerOnline_Password
			), array(
				'option_name' => 'KSA_registerOnline_Password'
			), array(
				'%s'
			)
		);

		self::$wpdb->update("{$table}"
			, array(
				'option_value' => $KSA_registerOnline_PackageId
			), array(
				'option_name' => 'KSA_registerOnline_PackageId'
			), array(
				'%s'
			)
		);

		return 1;
	}
}