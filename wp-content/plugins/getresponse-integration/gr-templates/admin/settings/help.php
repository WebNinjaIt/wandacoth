<?php

use Getresponse\WordPress\Api;

defined( 'ABSPATH' ) || exit;

/**
 * Display Settings form.
 */
?>

<?php gr_load_template( 'admin/settings/partials/messages.php' ); ?>

<?php gr_load_template( 'admin/settings/header.php' ); ?>

<h2 class="nav-tab-wrapper"><?php gr_get_admin_tabs( 'gr-integration-help' ) ?></h2>

<table class="form-table subscription-settings gr_box">
	<tbody>
		<tr>
			<td class="subscription-settings-cell">
				<h4><?php _e( 'GetResponse support', 'Gr_Integration' ); ?></h4>
				<p>
					<?php
					 _e(sprintf( __( 'Make sure to look at the our WordPress plugin: %s documentation %s or use the %s support forums %s on WordPress.org.', 'Gr_Integration' ),
						'<a title="GetResponse documentation" target="_blank" href="https://www.getresponse.com/help/integrations-and-api#subcat-wordpress-integration">',
						'</a>',
						'<a target="_blank" title="GetResponse support forum on WordPress.org" href="https://wordpress.org/support/plugin/getresponse-integration">',
						'</a>'));
					?>
				</p>
			</td>
		</tr>
		<tr>
			<td class="subscription-settings-cell">
				<h4><?php _e( 'Having problems with the plugin?', 'Gr_Integration' ); ?></h4>
				<p>
					<?php _e( 'You can drop us a line including the following details and we\'ll do what we can. ',
						'Gr_Integration' ); ?>
				</p>
				<p>
					<a href="<?php echo esc_url(gr()->contact_form_url) ?>" target="_blank">
						<?php _e( 'Contact us', 'Gr_Integration' ) ?>
					</a>
				</p>
			</td>
		</tr>

        <tr>
            <td class="subscription-settings-cell">
                <h4><?php _e( 'API health check', 'Gr_Integration' ); ?></h4>
                <p>
                    <?php _e('API status', 'Gr_Integration')?>:
                    <?php if($apiStatus === Api::STATUS_CONNECTED): ?>
                            <span class="gr-help-status connected">
                                <?php _e('Working fine', 'Gr_Integration')?>
                            </span>
                    <?php elseif ($apiStatus === Api::STATUS_DISCONNECTED):?>
                        <span class="gr-help-status disconnected">
                            <?php _e('Disconnected', 'Gr_Integration')?>
                        </span>
                    <?php else:?>
                        <span class="gr-help-status error">
                            <?php _e('Error found', 'Gr_Integration')?>
                        </span>

                        <p class="gr-help-status">
                    <?php _e('Error', 'Gr_Integration')?>:
                        <span class="details"><?php esc_html_e($apiErrorDetails)?></span></p>
                        <p><?php _e('If you don’t know how to fix this issue', 'Gr_Integration')?>,
                            <a href="<?php echo esc_url(gr()->contact_form_url) ?>" target="_blank"><?php _e( 'contact us', 'Gr_Integration' ) ?></a>.
                            <?php _e('Be sure to include the error in your message', 'Gr_Integration')?>.</p>
                    <?php endif ?>
                </p>
            </td>
        </tr>

		<tr>
			<td class="subscription-settings-cell">
				<h4><?php _e( 'App version', 'Gr_Integration' ); ?></h4>
				<div class="app-details">
					<textarea 
						id="appDetails"
						class="help-app-details"
						data-copytarget="#appDetails"
					>
						<?php
							gr_get_wp_details_list();
							gr_get_active_plugins_list();
							gr_get_gr_plugin_details_list();
							gr_get_widgets_list();
						?>
					</textarea>
					<div id="appDetailsCopyNotification" class="app-details-copy-notification hidden">
						<?php _e( 'Copied', 'Gr_Integration' ); ?>
					</div>
				</div>
			</td>
		</tr>
	</tbody>
</table>

<script>
	(function () {
		'use strict';
		document.body.addEventListener('click', copy, true);
		function copy(e) {
			var t = e.target, c = t.dataset.copytarget,
				inp = (c ? document.querySelector(c) : null);
			if (inp && inp.select) {
				inp.select();
				try {
					document.execCommand('copy');
					inp.blur();
					jQuery('#appDetailsCopyNotification').show();
					setTimeout(function () {
						jQuery('#appDetailsCopyNotification').hide();
					}, 1500);
				}
				catch (err) {
					alert('please press Ctrl/Cmd+C to copy');
				}
			}
		}
	})();

	if (window.canRunAds === undefined) {
		jQuery('#GrDetails').append('\nAdBlock : active');
	}

	function copyText(element) {
		element.focus();
		element.select();
	}

	jQuery('#getresponse_360_account').change(function () {
		var value = jQuery('#getresponse_360_account:checked').val();
		var selector = jQuery('#getresponse_360_account_options');
		if (value === '1') {
			selector.show();
		}
		else {
			selector.hide();
		}
	});
</script>
