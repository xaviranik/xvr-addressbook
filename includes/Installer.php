<?php

namespace WeDevs\Ninja;

/**
 * Installer Class
 */
class Installer {
	
	public function run() {
		$this->add_version();
		$this->create_tables();
	}

	/**
	 * Adds plugin version
	 */
	public function add_version() {
		$installed = get_option( 'coding_ninja_installed' );

		if ( ! $installed ) {
			update_option( 'coding_ninja_installed', time() );
		}

		update_option( 'coding_ninja_version', CODING_NINJA_VERSION );
	}

	/**
	 * Creates plugin related tables
	 * @return void
	 */
	public function create_tables() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();

		$schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}cn_addressbooks` ( 
			`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , `address` VARCHAR(255) NULL , 
			`phone` VARCHAR(30) NULL , `created_by` BIGINT(20) NOT NULL , `created_at` DATETIME NOT NULL , 
			PRIMARY KEY (`id`)) 
			$charset_collate";

		if ( ! function_exists( 'dbDelta') ) {
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		}

		dbDelta( $schema );
	}
}