<?php

/**
* Plugin Name:       Coding Ninja
* Plugin URI:        https://zabiranik.me
* Description:       Basic plugin for Wordpress
* Version:           1.0.0
* Requires at least: 5.2
* Requires PHP:      7.2
* Author:            Zabir Anik
* Author URI:        https://zabiranik.me
* License:           GPL v2 or later
* License URI:       https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain:       coding-ninja
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Main plugin class
 */
final class Coding_Ninja {

	/**
	 * Coding Ninja Version
	 * @var string
	 */
	const version = '1.0.0';
	
	/**
	 * Class Constructor
	 */
	private function __construct() {
		$this->define_constants();

		register_activation_hook( __FILE__, [ $this, 'activate' ] );

		add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
	}

	/**
	 * Initializes a Singleton
	 * @return \Coding_Ninja
	 */
	public static function init() {

		static $instance = false;

		if ( ! $instance ) {
			$instance = new Self();
		}

		return $instance;
	}

	/**
	 * Defines plugin constants
	 * @return void
	 */
	public function define_constants() {
		define( 'CODING_NINJA_VERSION',  self::version );
		define( 'CODING_NINJA_FILE',  __FILE__ );
		define( 'CODING_NINJA_PATH',  __DIR__ );
		define( 'CODING_NINJA_URL',  plugins_url( '', CODING_NINJA_FILE ) );
		define( 'CODING_NINJA_ASSETS',  CODING_NINJA_URL . '/assets' );
	}

	/**
	 * Plugin init
	 * @return void
	 */
	public function init_plugin() {
		if ( is_admin() ) {
			new WeDevs\Ninja\Admin();
		} else {
			new WeDevs\Ninja\Frontend();
		}

		new WeDevs\Ninja\API();
	}

	/**
	 * Executes on plugin activation
	 * @return void
	 */
	public function activate() {
		$installer = new WeDevs\Ninja\Installer;
		$installer->run();
	}
}

/**
 * Coding Ninja Instance init
 * @return \Coding_Ninja
 */
function coding_ninja_init() {
	return Coding_Ninja::init();
}

// Initialize the plugin
coding_ninja_init();