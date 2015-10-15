<?php
/**
 * Plugin Name: woocommerce pending order customer-email
 * Plugin URI: http://pronet-it.de
 * Description: Plugin adds an E-Mail Template which is only used for order status pending
 * Author: Ingo Marent
 * Author URI: http://Ribasys.com
 * Version: 0.1
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 *  Add a custom email to the list of emails WooCommerce should load
 *
 * @since 0.1
 * @param array $email_classes available email classes
 * @return array filtered available email classes
 */
function add_expedited_order_woocommerce_email( $email_classes ) {

	// include our custom email class
	require_once( 'includes/class-wc-expedited-order-email.php' );

	// add the email class to the list of email classes that WooCommerce loads
	$email_classes['WC_Email_Custom_Customer_Processing_Order'] = new WC_Email_Custom_Customer_Processing_Order();

	return $email_classes;

}
add_filter( 'woocommerce_email_classes', 'add_expedited_order_woocommerce_email' );

add_action( 'woocommerce_email', 'know_now_email_hooks' );

function know_now_email_hooks( $email_class ) {

		/**
		 * Hooks for sending emails during store events
		 **/
		//remove_action( 'woocommerce_low_stock_notification', array( $email_class, 'low_stock' ) );
		//remove_action( 'woocommerce_no_stock_notification', array( $email_class, 'no_stock' ) );
		//remove_action( 'woocommerce_product_on_backorder_notification', array( $email_class, 'backorder' ) );
		
		// New order emails
		//remove_action( 'woocommerce_order_status_pending_to_processing_notification', array( $email_class->emails['WC_Email_New_Order'], 'trigger' ) );
		//remove_action( 'woocommerce_order_status_pending_to_completed_notification', array( $email_class->emails['WC_Email_New_Order'], 'trigger' ) );
		//remove_action( 'woocommerce_order_status_pending_to_on-hold_notification', array( $email_class->emails['WC_Email_New_Order'], 'trigger' ) );
		//remove_action( 'woocommerce_order_status_failed_to_processing_notification', array( $email_class->emails['WC_Email_New_Order'], 'trigger' ) );
		//remove_action( 'woocommerce_order_status_failed_to_completed_notification', array( $email_class->emails['WC_Email_New_Order'], 'trigger' ) );
		//remove_action( 'woocommerce_order_status_failed_to_on-hold_notification', array( $email_class->emails['WC_Email_New_Order'], 'trigger' ) );
		
		
		// Processing order emails
		//remove_action( 'woocommerce_order_status_pending_to_processing_notification', array( $email_class->emails['WC_Email_Customer_Processing_Order'], 'trigger' ) );
		remove_action( 'woocommerce_order_status_pending_to_on-hold_notification', array( $email_class->emails['WC_Email_Customer_Processing_Order'], 'trigger' ) );
		add_action( 'woocommerce_order_status_on-hold_to_processing_notification', array( $email_class->emails['WC_Email_Customer_Processing_Order'], 'trigger' ) );
		// Completed order emails
		//remove_action( 'woocommerce_order_status_completed_notification', array( $email_class->emails['WC_Email_Customer_Completed_Order'], 'trigger' ) );
			
		// Note emails
		//remove_action( 'woocommerce_new_customer_note_notification', array( $email_class->emails['WC_Email_Customer_Note'], 'trigger' ) );
}
