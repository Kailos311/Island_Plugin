<?php
/*
 * This action hook registers our PHP class as a WooCommerce payment gateway
 */
add_filter( 'woocommerce_payment_gateways', 'bo_add_custom_point_gateway_class' );
function bo_add_custom_point_gateway_class( $gateways ) {
	$gateways[] = 'WC_Bo_Point_Gateway'; // your class name is here
	return $gateways;
}

/*
 * The class itself, please note that it is inside plugins_loaded action hook
 */
add_action( 'plugins_loaded', 'bo_init_point_gateway_class' );
function bo_init_point_gateway_class() {

	class WC_Bo_Point_Gateway extends WC_Payment_Gateway {

 		/**
 		 * Class constructor, more about it in Step 3
 		 */
 		public function __construct() {
            $this->id = 'bo_point'; // payment gateway plugin ID
            $this->icon = ''; // URL of the icon that will be displayed on checkout page near your gateway name
            $this->has_fields = true; // in case you need a custom credit card form
            $this->method_title = 'Account Balance';
            $this->method_description = 'Account Balance payment gateway'; // will be displayed on the options page

            // gateways can support subscriptions, refunds, saved payment methods,
            // but in this tutorial we begin with simple payments
            $this->supports = array(
                'products'
            );

            // Method with all the options fields
            $this->init_form_fields();

            

            // Load the settings.
            $this->init_settings();
            $this->title = $this->get_option( 'title' );
            $this->description = $this->get_option( 'description' );
            $this->enabled = $this->get_option( 'enabled' );
            $this->testmode = 'yes' === $this->get_option( 'testmode' );
            $this->private_key = $this->testmode ? $this->get_option( 'test_private_key' ) : $this->get_option( 'private_key' );
            $this->publishable_key = $this->testmode ? $this->get_option( 'test_publishable_key' ) : $this->get_option( 'publishable_key' );

            // This action hook saves the settings
            add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );

            // We need custom JavaScript to obtain a token
             

 		}

		/**
 		 * Plugin options, we deal with it in Step 3 too
 		 */
 		public function init_form_fields(){
            $this->form_fields = array(
                'enabled' => array(
                    'title'       => 'Enable/Disable',
                    'label'       => 'Enable Account Balance',
                    'type'        => 'checkbox',
                    'description' => '',
                    'default'     => 'no'
                ),
                'title' => array(
                    'title'       => 'Title',
                    'type'        => 'text',
                    'description' => 'This controls the title which the user sees during checkout.',
                    'default'     => 'Account Balance',
                    'desc_tip'    => true,
                ),
                'description' => array(
                    'title'       => 'Description',
                    'type'        => 'textarea',
                    'description' => 'This controls the description which the user sees during checkout.',
                    'default'     => 'Pay with your account balance.',
                ),
                 
            );
		 
	
	 	}

		/**
		 * You will need it if you want your custom credit card form, Step 4 is about it
		 */
		public function payment_fields() {
            $user_id = get_current_user_id();
            $current_currency = get_user_meta($user_id, 'currency', true) == '' ? 0 : (int) get_user_meta($user_id, 'currency', true);
            
            if ( $this->description ) { 
                // display the description with <p> tags etc.
                echo wpautop( wp_kses_post( $this->description ) ); 
            }
            echo '<p>Your balance: <strong>'.get_woocommerce_currency_symbol().$current_currency.'</strong></p>';

		 
				 
		}

		/*
		 * Custom CSS and JS, in most cases required only when you decided to go with a custom credit card form
		 */
	 	public function payment_scripts() {

	 
	 	}

		/*
 		 * Fields validation, more in Step 5
		 */
		public function validate_fields() {
            $user_id = get_current_user_id();
            $current_currency = get_user_meta($user_id, 'currency', true) == '' ? 0 : (int) get_user_meta($user_id, 'currency', true);
            $cart_total = (float) WC()->cart->total;
            if( $current_currency <  $cart_total) {
                wc_add_notice(  'Your balance is not enough!', 'error' );
                return false;
            }
            return true;
		 

		}

		/*
		 * We're processing the payments here, everything about it is in Step 5
		 */
		public function process_payment( $order_id ) {
            global $woocommerce;
            $user_id = get_current_user_id();
            $current_currency = get_user_meta($user_id, 'currency', true) == '' ? 0 : (int) get_user_meta($user_id, 'currency', true);
            $cart_total = (float) WC()->cart->total;
 
            // we need it to get any order detailes
            $order = wc_get_order( $order_id );
        
        
            if( $current_currency >=  $cart_total) {
                $remaining_balance= $current_currency - $cart_total;
                update_user_meta($user_id, 'currency', $remaining_balance);


                $order->payment_complete();
                $order->reduce_order_stock();
    
                // some notes to customer (replace true with false to make it private)
                $order->add_order_note( 'Hey, your order is paid! Thank you!', true );
    
                // Empty cart
                $woocommerce->cart->empty_cart();
    
                // Redirect to the thank you page
                return array(
                    'result' => 'success',
                    'redirect' => $this->get_return_url( $order )
                );
            }
            else{
                wc_add_notice(  'Your balance is not enough!', 'error' );
                return;
            }
        
             
		 
	 	}

		/*
		 * In case you need a webhook, like PayPal IPN etc
		 */
		public function webhook() {
 
	 	}
 	}
}