<?php

namespace WeDevs\Ninja\Admin;

use WeDevs\Ninja\Admin\Addressbook;

/**
 * Menu handler class
 */
class Menu {

	public $addressbook;
	
	function __construct( $addressbook ) {
		$this->addressbook = $addressbook;
		add_action('admin_enqueue_scripts', [$this, 'load_scripts']);
		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
		add_action( 'admin_menu', [ $this, 'add_addressbook_page' ] );
	}

	public function admin_menu() {
		$parent_slug = 'coding_ninja';
		$capability = 'manage_options';
		add_menu_page( __( 'Coding Ninja', 'coding-ninja' ), __( 'Coding Ninja', 'coding-ninja' ), $capability, $parent_slug, [ $this, 'addressbook_page' ], 'dashicons-universal-access-alt' );
		add_submenu_page( $parent_slug, __( 'Address Book', 'coding-ninja' ), __( 'Address Book', 'coding-ninja' ), $capability, $parent_slug, [ $this, 'addressbook_page' ] );
		add_submenu_page( $parent_slug, __( 'Settings', 'coding-ninja' ), __( 'Settings', 'coding-ninja' ), $capability, 'coding_ninja_settings', [ $this, 'settings_page' ] );
	}

	public function settings_page() {
		echo "<h1>Settings Page</h1>";
	}

	public function addressbook_page() {
		$this->addressbook->plugin_page();
	}

	public function add_addressbook_page() {
		add_options_page( __('XVR Addressbook', 'coding-ninja'), __('XVR Addressbook', 'coding-ninja'), 'manage_options', 'xvr_address_book', [ $this, 'render_addressbook_page' ] );
	}

	public function render_addressbook_page() {
		wp_enqueue_style('backend-vue-style');
		wp_enqueue_script('backend-vue-script');

		echo '<div class="wrap"><div id="app"></div></div>';
	}

	public function load_scripts() {
		$vueDirectory    = join( '/', [ CODING_NINJA_URL, 'addressbook', 'dist'] );
		wp_register_style( 'backend-vue-style', $vueDirectory . '/app.css');
		wp_register_script( 'backend-vue-script', $vueDirectory . '/app.js', [], '1.0.0', true );
	}

}