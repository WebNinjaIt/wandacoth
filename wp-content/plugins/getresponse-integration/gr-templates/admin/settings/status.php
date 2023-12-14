<?php

defined( 'ABSPATH' ) || exit;

$apiKey = gr_get_option( 'api_key' );
$apiKey = strlen($apiKey) > 0 ? str_repeat("*", strlen($apiKey) - 6) . substr($apiKey, -6) : '';

?>

<?php gr_load_template( 'admin/settings/header.php' ); ?>

<h2 class="nav-tab-wrapper"><?php gr_get_admin_tabs( 'gr-integration-status' ) ?></h2>

<?php gr_load_template( 'admin/settings/partials/messages.php' ); ?>

<div class="wrap">
	<h1><?php _e( 'GetResponse account data', 'Gr_Integration' ); ?></h1>
	<table class="widefat importers striped gr_box form-table">
		<tbody>
			<tr>
				<td>
					<span><?php _e( 'Status', 'Gr_Integration' ); ?></span>
				</td>
				<td class="desc">
					<span><?php _e( 'CONNECTED', 'Gr_Integration' ); ?></span><br />
                    <form action="<?php echo esc_url(admin_url('admin.php?page=gr-integration-status')) ?>" method="post">
                        <input type="hidden" name="action" value="disconnect" />
                        <input name="getresponse_token" type="hidden" value="<?php echo wp_create_nonce('getresponse_token_nonce')?>" />
                        <input
                            class="disconnectAccountButton"
                            type="submit"
                            onclick="return confirm('Please confirm you want to disconnect your account. This will stop sending data to GetResponse')"
                            value="<?php _e( 'Disconnect', 'Gr_Integration' ) ?>" />
                    </form>
				</td>
			</tr>
			<tr>
				<td>
					<span><?php _e( 'API Key', 'Gr_Integration' ); ?></span>
				</td>
				<td class="desc">
					<span><?php esc_html_e($apiKey) ?></span>
				</td>
			</tr>

			<?php if (null !== gr_get_option('account_first_name') && null !== gr_get_option('account_last_name')) :?>

				<tr>
					<td>
						<span><?php _e( 'Name', 'Gr_Integration' ); ?></span>
					</td>
					<td class="desc">
						<span>
							<?php gr_get_option_e('account_first_name') ?> <?php gr_get_option_e('account_last_name') ?>
						</span>
					</td>
				</tr>

			<?php endif ?>

			<?php if (null !== gr_get_option('account_email')) :?>

				<tr>
					<td>
						<span><?php _e( 'Email', 'Gr_Integration' ); ?></span>
					</td>
					<td class="desc">
						<span><?php gr_get_option_e('account_email') ?></span>
					</td>
				</tr>

			<?php endif ?>

			<?php if (null !== gr_get_option('account_company_name')) :?>

				<tr>
					<td>
						<span><?php _e( 'Company', 'Gr_Integration' ); ?></span>
					</td>
					<td class="desc">
						<span><?php gr_get_option_e('account_company_name') ?></span>
					</td>
				</tr>

			<?php endif ?>

			<?php if (null !== gr_get_option('account_phone')) :?>

				<tr>
					<td>
						<span><?php _e( 'Phone', 'Gr_Integration' ); ?></span>
					</td>
					<td class="desc">
						<span><?php gr_get_option_e('account_phone') ?></span>
					</td>
				</tr>

			<?php endif ?>

			<tr>
				<td>
					<span><?php _e( 'Address', 'Gr_Integration' ); ?></span>
				</td>
				<td class="desc">
					<span>
						<?php gr_get_option_e('account_street') ?>
						<?php gr_get_option_e('account_zip_code') ?>
						<?php gr_get_option_e('account_city') ?>
						<?php gr_get_option_e('account_state') ?>
						<?php gr_get_option_e('account_country_name') ?>
					</span>
				</td>
			</tr>
		</tbody>
	</table>
</div>
