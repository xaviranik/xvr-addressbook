<?php

namespace WeDevs\Ninja\Traits;

trait Form_Error {

	/**
	 * Holds all errors
	 * @var array
	 */
	public $errors = [];

	/**
	 * Checks if key exists in error
	 * @param  string
	 * @return boolean
	 */
	public function has_error( $key ) {
		return isset( $this->errors[ $key ] ) ? true : false;
	}

	/**
	 * Gets the error for a key
	 * @param  integer
	 * @return string|boolean
	 */
	public function get_error( $key ) {
		if ( isset( $this->errors[ $key ] ) ) {
			return $this->errors[ $key ];
		}

		return false;
	}
}