<?php

use Getresponse\WordPress\ApiException;
use Getresponse\WordPress\ApiFactory;
use Getresponse\WordPress\AutoresponderService;
use Getresponse\WordPress\CampaignService;
use Getresponse\WordPress\GrCache;
use Getresponse\WordPress\OrdersMap;
use Getresponse\WordPress\ProductsMap;
use Getresponse\WordPress\ShopService;
use Getresponse\WordPress\VariantsMap;
use Getresponse\WordPress\WoocommerceService;

defined( 'ABSPATH' ) || exit;

/**
 * @param string $string
 * @return string
 */
function gr_sanitize_text_values( $string ) {
    if ( is_object( $string ) || is_array( $string ) ) {
        return '';
    }

    $string = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $string );
    $string = strip_tags( $string );

    return (string) $string;
}

/**
 * @param $current_store
 * @param $name
 * @param bool $disabled
 */
function gr_return_ecommerce_stores_selector( $current_store, $name, $disabled = false ) {

    try {
	    $ecommerce = new ShopService(
            ApiFactory::create_api(),
            new GrCache(),
            new ProductsMap(),
            new OrdersMap(),
            new VariantsMap(),
            new WoocommerceService(ApiFactory::create_api())
        );
	    $stores = $ecommerce->get_shops();
    } catch (ApiException $e) {
        $stores = array();
    }

	if (empty($stores)) {
		_e( 'To send ecommerce data, first create a GetResponse store in the <a href="#stores">Stores section</a>', 'Gr_Integration' );

		return;
	}

	?>
    <select name="<?php esc_attr_e($name) ?>" id="<?php esc_attr_e($name) ?>" <?php if ($disabled) :?>disabled<?php endif ?>>
    	<option value="" disabled selected>Select a store</option>
		<?php foreach ( $stores as $store ):?>
			<option
                    value="<?php esc_attr_e($store['shopId']) ?>"
                    id="<?php esc_attr_e($store['shopId'])?>"
                    <?php if ($current_store === $store['shopId']):?>selected="selected"<?php endif?>
            ><?php esc_attr_e($store['name'])?>
            </option>'
		}
		<?php endforeach; ?>
    </select>
<?php }

/**
 * Return campaign selector.
 *
 * @param string $name
 * @param string $selected_option
 * @param bool $is_autoresponder_status
 * @param string $current_autoresponder_id
 * @param bool $disabled
 */
function gr_return_campaign_selector(
	$name,
	$selected_option,
	$is_autoresponder_status = false,
	$current_autoresponder_id = '',
    $disabled = false
) {
    $name = gr_sanitize_text_values( $name );
    $selected_option = gr_sanitize_text_values( $selected_option );
    $current_autoresponder_id = gr_sanitize_text_values( $current_autoresponder_id );
    $campaigns  = array();
    $responders = array();
	$api = ApiFactory::create_api();

	try {
		$campaign_service = new CampaignService( $api );
		$autoresponder_service = new AutoresponderService( $api );

		$campaigns  = $campaign_service->get_campaigns();
		$responders = $autoresponder_service->get_autoresponders();

	} catch (ApiException $e) {
	    $errorMessage = 'We cannot access Getresponse API. Please try again later.';
	    $errorMessage .= '<br />(' . $e->getMessage() . ')';
        ?><div class="error"><?php _e($errorMessage, 'Gr_Integration' ); ?></div>
		<?php } ?>

    <tr>
        <th>
            <label for="<?php esc_html_e($name) ?>_campaigns">
				<?php _e( 'Contact list', 'Gr_Integration' ); ?>
            </label>
        </th>
        <td>
            <select
	            <?php if ($disabled) :?>disabled<?php endif ?>
                    name="<?php esc_attr_e($name) ?>"
                    id="campaigns_for_<?php esc_attr_e($name) ?>"
                    class="campaign-select"
                    data-selected="<?php esc_attr_e($selected_option) ?>">

                <option disabled selected value=""><?php _e("Select a list")?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th>
            <label for="<?php esc_attr_e($name) ?>_autoresponder">
				<?php _e( 'Autoresponder day', 'Gr_Integration' ); ?>
            </label>
        </th>
        <td>
            <label for="<?php esc_attr_e($name) ?>_autoresponder_enabled">
                <input
	                <?php if ($disabled) :?>disabled<?php endif ?>
                    type="checkbox"
                    id="<?php esc_attr_e($name) ?>_autoresponder_enabled"
                    name="<?php esc_attr_e($name) ?>_autoresponder_enabled"
                    class="add_to_autoresponder_checkbox"
					<?php if ( $is_autoresponder_status ): ?>checked="checked"<?php endif ?>
                />
                Add to autoresponder cycle
            </label>
        </td>
    </tr>
    <tr>
    	<th></th>
        <td>
            <select
				<?php if ( $disabled || false === $is_autoresponder_status ): ?>disabled="disabled"<?php endif ?>
                name="<?php esc_attr_e($name) ?>_selected_autoresponder"
                id="responders_for_<?php esc_attr_e($name) ?>"
                data-selected="<?php esc_attr_e($current_autoresponder_id) ?>">
            </select>
        </td>
    </tr>

    <script type="text/javascript">

        window.addEventListener('load', function () {

            var campaigns_json = <?php echo wp_json_encode( $campaigns ) ?>;
            var responders_json = <?php echo wp_json_encode( $responders ) ?>;

            var campaigns = new Campaigns();
            var auto_responders = new AutoResponders();

            campaigns.load_campaigns('campaigns_for_<?php esc_html_e($name)?>', campaigns_json);
            auto_responders.load_responders('responders_for_<?php esc_html_e($name) ?>', responders_json);

            document.getElementById('campaigns_for_<?php esc_html_e($name)?>').addEventListener('change', function () {
                auto_responders.load_responders('responders_for_<?php esc_html_e($name) ?>', responders_json);
            });

            document.getElementById('<?php esc_html_e($name) ?>_autoresponder_enabled').addEventListener('click', function () {

                if (this.checked) {
                    document.getElementById('responders_for_<?php esc_html_e($name)?>').removeAttribute('disabled');
                } else {
                    document.getElementById('responders_for_<?php esc_html_e($name)?>').setAttribute('disabled', 'disabled');
                }
            });
        }, false);

    </script>
<?php }

/**
 * Get WP details list.
 */
function gr_get_wp_details_list() {
    $details = "Version : " . get_bloginfo( 'version' ) . "\n" .
    "Charset : " . get_bloginfo( 'charset' ) . "\n" .
    "Url : " . get_bloginfo( 'url' ) . "\n" .
    "Language : " . get_bloginfo( 'language' ) . "\n" .
    "PHP : " . phpversion() . "\n";

    echo esc_textarea($details);
}

/**
 * Return list of active plugins
 */
function gr_get_active_plugins_list() {
	$list =  "\nActive plugins:\n\n";
	foreach ( get_plugins() as $plugin_name => $plugin_details ) {
		if ( is_plugin_active( $plugin_name ) === true ) {
			foreach ( $plugin_details as $details_key => $details_value ) {
				if ( in_array( $details_key, array( 'Name', 'Version', 'PluginURI' ) ) ) {
					$list .=  $details_key . " : " . $details_value . "\n";
				}
			}
			$list .= "Path : " . $plugin_name . "\n";
            $list .= "-----\n";
		}
	}

    echo esc_textarea($list);
}

/**
 * Return list of active plugins
 */
function gr_get_gr_plugin_details_list() {
	$list = "\nGetresponse-integration details:\n";
	$details = gr()->db->get_gr_plugin_details();
	if ( !empty( $details ) ) {
        foreach ($details as $detail) {
            $list .= str_replace(gr_prefix(), '',
                    $detail->option_name) . " : " . $detail->option_value . "\n";
        }
    }

    echo esc_textarea($list);
}

/**
 * Return active widgets
 */
function gr_get_widgets_list() {
    echo esc_textarea("Widgets:\n" . serialize( get_option( 'sidebars_widgets')));
}

/**
 * Load tabs.
 *
 * * @param string $active
 *
 * @return mixed
 */
function gr_get_admin_tabs( $active = 'gr-integration' ) {
    echo gr()->gr_core_admin->get_admin_tabs( $active );
}
