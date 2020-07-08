<?php

/**
 * Insert new address
 * @param  array  $args
 * @return integer|WP_Error
 */
function wd_cn_insert_address( $args = [] ) {
	global $wpdb;

	if ( empty( $args['name'] ) ) {
		return new \WP_Error( 'no-name', __( 'You must provide a name.', 'coding-ninja' ) );
	}

	$defaults = [
		'name'       => '',
		'address'    => '',
		'phone'      => '',
		'created_by' => get_current_user_id(),
		'created_at' => current_time( 'mysql' ),
	];

	$data = wp_parse_args( $args, $defaults );

	if ( isset( $data['id'] ) ) {

		$id = $data['id'];
		unset( $data['id'] );

		$updated = $wpdb->update(
			$wpdb->prefix . 'cn_addressbooks',
			$data,
			[ 'id' => $id ],
			[
				'%s',
				'%s',
				'%s',
				'%d',
				'%s'
			],
			[ '%d' ]
		);

		wd_cn_address_purge_cache( $id );

		return $updated;

	} else {

		$inserted = $wpdb->insert(
			$wpdb->prefix . 'cn_addressbooks',
			$data,
			[
				'%s',
				'%s',
				'%s',
				'%d',
				'%s'
			]
		);

		if ( ! $inserted ) {
			return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data', 'coding-ninja' ) );
		}

		wd_cn_address_purge_cache();

		return $wpdb->insert_id;
	}
}

/**
 * Gets all the address
 * @param  array  $args
 * @return array
 */
function wd_cn_get_addresses( $args = [] ) {
	global $wpdb;

    $defaults = [
        'number'  => 20,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'ASC'
    ];

    $args = wp_parse_args( $args, $defaults );

    $sql = $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}cn_addressbooks
            ORDER BY {$args['orderby']} {$args['order']}
            LIMIT %d, %d",
            $args['offset'], $args['number']
    );

    $items = $wpdb->get_results( $sql );

    return $items;
}

/**
 * Returns total number of address
 * @return integer
 */
function wd_cn_get_address_count() {
	global $wpdb;

    return (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}cn_addressbooks" );
}

/**
 * Returns a single address
 * @param integer 
 * @return array
 */
function wd_cn_get_address( $id ) {
	global $wpdb;

	return $wpdb->get_row(
		$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}cn_addressbooks WHERE id = %d", $id )
	);
}

/**
 * Deletes a single address
 * @param  integer
 * @return integer|boolean
 */
function wd_cn_delete_address( $id ) {
	global $wpdb;

	return $wpdb->delete(
		$wpdb->prefix . 'cn_addressbooks',
		[ 'id' => $id ],
		[ '%d' ]
	);
}

/**
 * Purge the cache for books
 *
 * @param  int $book_id
 *
 * @return void
 */
function wd_cn_address_purge_cache( $book_id = null ) {
	$group = 'address';

	if ( $book_id ) {
		wp_cache_delete( 'book-' . $book_id, $group );
	}

	wp_cache_delete( 'count', $group );
	wp_cache_set( 'last_changed', microtime(), $group );
}