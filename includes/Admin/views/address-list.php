<div class="wrap">
	<h1 class="wp-heading-inline"><?php _e( 'Address Book',  'coding-ninja' ); ?></h1>
	<a href="<?php echo( "admin.php?page=coding_ninja&action=new" ) ?>" class="page-title-action"><?php _e( 'Add New', 'coding-ninja' ) ?></a>

	<form action="" method="post">
        <?php
        $table = new WeDevs\Ninja\Admin\Address_List();
        $table->prepare_items();
        // $table->search_box( 'search', 'search_id' );
        $table->display();
        ?>
    </form>
</div>