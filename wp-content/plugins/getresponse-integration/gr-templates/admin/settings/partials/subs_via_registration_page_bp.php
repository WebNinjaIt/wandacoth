<?php

defined( 'ABSPATH' ) || exit;

$registration_type    = gr_get_option( 'registration_checkout_enabled' );
$bp_registration_type = gr_get_option( 'bp_registration_on' );
?>
<?php _e('BuddyPress module is active. Option is available on ', 'Gr_Integration'); ?>
<a href="<?php esc_url(admin_url('admin.php?page=gr-integration-buddypress')) ?>">
	<?php _e( 'BuddyPress Tab', 'Gr_Integration' ); ?>
</a>