<?php

namespace WeDevs\Ninja;

use WeDevs\Ninja\Admin\Menu;
use WeDevs\Ninja\Admin\Addressbook;

/**
 * Admin Class
 */
class Admin {
	
	/**
	 * Admin Constructor
	 */
	function __construct() {
		$addressbook = new Addressbook();
		$this->dispatch_actions( $addressbook );
		new Menu( $addressbook );
	}

	/**
	 * Dispatching all admin relation actions
	 * @return void
	 */
	public function dispatch_actions( $addressbook ) {
		add_action( 'admin_init', [ $addressbook, 'form_handler' ] );
	}
}