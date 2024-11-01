<?php
/*
Plugin Name: WooCommerce Remove Shipping from Cart Totals
Plugin URI: https://justentrepreneurship.com
Description: A plugin to remove Shipping from the Cart totals but still display the shipping cost to the customer.
Version: 1.0
Author: Afnan Abbasi
Author URI: https://fiverr.com/wpcoderpro
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: woocommerce-remove-shipping-from-cart-totals
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function woocommerce_rsfct_missing_wc_notice() {
	/* Show message if WooCommerce is deactivated. */
	echo '<div class="error"><p><strong>' . sprintf( esc_html__( 'WooCommerce Remove Shipping from Cart Totals requires WooCommerce to be installed and active. You can download %s here.', 'woocommerce-product-addons' ), '<a href="https://woocommerce.com/" target="_blank">WooCommerce</a>' ) . '</strong></p></div>';
}

add_action( 'plugins_loaded', 'woocommerce_rsfct_init', 9 );
function woocommerce_rsfct_init() {
if ( ! class_exists( 'WooCommerce' ) ) {
add_action( 'admin_notices', 'woocommerce_rsfct_missing_wc_notice' );
return;
}
}

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
  /*Remove Shipping from Cart Totals for Woocommerce */
add_action( 'woocommerce_after_calculate_totals', 'woocommerce_after_calculate_totals', 30 );
function woocommerce_after_calculate_totals( $cart ) {
    // Removing the shipping from the cart total
    $cart->total = $cart->total - $cart->shipping_total;

}
}
?>
