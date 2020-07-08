<?php


namespace WeDevs\Ninja;


use WeDevs\Ninja\API\Address_Book;

class API {
	/**
	 * API constructor
	 */
	public function __construct() {
		add_action( 'rest_api_init', [ $this, 'register_rest_api' ] );
	}

	/**
	 * Registers rest api
	 */
	public function register_rest_api() {
		$address_book = new Address_Book();
		$address_book->register_routes();
	}
}