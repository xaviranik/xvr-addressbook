<div class="wrap">
	<h1 class="wp-heading-inline"><?php _e( 'New Address Book',  'coding-ninja' ); ?></h1>

	<form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row <?php echo $this->has_error( 'name' ) ? 'form-invalid' : '' ?>">
                    <th scope="row">
                        <label for="name"><?php _e( 'Name', 'coding-ninja' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" class="regular-text" value="" placeholder="John Doe">
                        <?php if( $this->has_error( 'name' ) ): ?>
                            <p class="description error"><?php echo $this->get_error( 'name' ) ?></p>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="address"><?php _e( 'Address', 'coding-ninja' ); ?></label>
                    </th>
                    <td>
                        <textarea class="regular-text" name="address" id="address" placeholder="221B Baker St, London"></textarea>
                    </td>
                </tr>
                <tr class="row <?php echo $this->has_error( 'name' ) ? 'form-invalid' : '' ?>">
                    <th scope="row">
                        <label for="phone"><?php _e( 'Phone', 'coding-ninja' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="phone" id="phone" class="regular-text" value="" placeholder="+111 1111 1111">
                        <?php if( $this->has_error( 'phone' ) ): ?>
                            <p class="description error"><?php echo $this->get_error( 'phone' ) ?></p>
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php wp_nonce_field( 'new_address' ); ?>
        <?php submit_button( __( 'Add Address', 'coding-ninja' ), 'primary', 'submit_address' ); ?>
    </form>
</div>