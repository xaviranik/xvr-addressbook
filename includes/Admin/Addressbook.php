<?php

namespace WeDevs\Ninja\Admin;
use WeDevs\Ninja\Traits\Form_Error;

/**
 * Addressbook Class
 */
class Addressbook
{
	use Form_Error;

	/**
	 * Plugin page router based on action
	 * @return void
	 */
	public function plugin_page() {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';

		switch ($action) {
			case 'new':
				$template = __DIR__ . '/views/address-new.php';
				break;

			case 'edit':
				$template = __DIR__ . '/views/address-edit.php';
				break;

			case 'view':
				$template = __DIR__ . '/views/address-view.php';
				break;
			
			default:
				$template = __DIR__ . '/views/address-list.php';
				break;
		}

		if ( file_exists( $template ) ) {
			include $template;
		}
	}

	public function form_handler() {
		if ( ! isset( $_POST['submit_address'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'new_address' ) ) {
			wp_die( 'Action not available' );
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'No permision to see this page' );
		}

		$name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
		$address = isset( $_POST['address'] ) ? sanitize_textarea_field( $_POST['address'] ) : '';
		$phone = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';

		if ( empty( $name ) ) {
			$this->errors['name'] = __( 'Please provide a name', 'coding-ninja' );
		}

		if ( empty( $phone ) ) {
			$this->errors['phone'] = __( 'Please provide a phone', 'coding-ninja' );
		}

		if ( ! empty( $this->errors ) ) {
			return;
		}

		$insert_id = wd_cn_insert_address([
			'name'    => $name,
			'address' => $address,
			'phone'   => $phone,
		]);

		if ( is_wp_error( $insert_id ) ) {
			wp_die( $insert_id->get_error_message() );	
		}

		$redirected_to = admin_url( "admin.php?page=coding_ninja&inserted=true" );
		wp_redirect( $redirected_to );
		exit();
	}
}