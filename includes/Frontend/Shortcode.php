<?php

namespace WeDevs\Ninja\Frontend;

/**
 * Shortcode handler class
 */
class Shortcode {
	
	/**
	 * Shortcode constructor
	 */
	function __construct() {
		add_shortcode( 'coding-ninja', [ $this, 'render_shortcode' ] );
	}

	/**
	 * Shortcode handler
	 * @param  array $attrs
	 * @param  string $content
	 * @return string
	 */
	public function render_shortcode( $attrs, $content = '' ) {
		return "<h6>Hello From Shortcode</h6>";
	}
}