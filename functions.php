<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
 
    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
	
	wp_enqueue_style("bootstrap", "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css");
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version') 
    );
	
	wp_enqueue_style( styleAbout, get_stylesheet_directory_uri() . '/styleAbout.css' );
	wp_enqueue_style( AddToCart, get_stylesheet_directory_uri() . '/AddToCart.css' );
	wp_enqueue_style( CheckOut, get_stylesheet_directory_uri() . '/CheckOut.css' );
	
}

add_theme_support( 'post-thumbnails' ); 



function custom_theme() {
	
	//register custom navigation menu
	register_nav_menus( array(
		"primary" => __("Primary Menu", "storefront-child")
		
	));	
}

add_action( "after_setup_theme", "customtheme_setup" );

/*removes stuff*/
function removeThing() {
	//removes welcome banner
	remove_action( 'homepage', 'storefront_homepage_content', 10);
	remove_action( 'homepage', 'storefront_recent_products', 30);
	remove_action( 'homepage', 'storefront_featured_products', 40);
	remove_action( 'homepage', 'storefront_best_selling_products', 70);
	remove_action( 'storefront_footer', 'storefront_credit', 20);
	
	
	
}


add_action("init", "removeThing");


/*adds javascript */	
function storefront_child_scripts() {
	if (is_page(26) ) {
		wp_enqueue_script('MyScripts', get_stylesheet_directory_uri() . '/scripts.js');
	}
	
	if (is_page(27) ) {
      wp_enqueue_script('MyScripts', get_stylesheet_directory_uri() . '/aboutScripts.js');
  }
			
}

add_action('wp_enqueue_scripts', 'storefront_child_scripts');


//Adds widget area to middle of page

function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'right-sidebar',
		'id'            => 'right-sidebar',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );



/**
 * Removes coupon form, order notes, and several billing fields if the checkout doesn't require payment
 * Tutorial: http://skyver.ge/c
 */
 
function sv_free_checkout_fields() {
	
	// Bail we're not at checkout, or if we're at checkout but payment is needed
	if ( function_exists( 'is_checkout' ) && ( ! is_checkout() || ( is_checkout() && WC()->cart->needs_payment() ) ) ) {
		return;
	}
	
	// remove coupon forms since why would you want a coupon for a free cart??
	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
	
	// Remove the "Additional Info" order notes
	add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
	// Unset the fields we don't want in a free checkout
	function unset_unwanted_checkout_fields( $fields ) {
	
		// add or remove billing fields you do not want
		// list of fields: http://docs.woothemes.com/document/tutorial-customising-checkout-fields-using-actions-and-filters/#section-2
		$billing_keys = array(
			'billing_company',
			'billing_phone',
			'billing_address_1',
			'billing_address_2',
			'billing_city',
			'billing_postcode',
			'billing_country',
			'billing_state',
		);
		// unset each of those unwanted fields
		foreach( $billing_keys as $key ) {
			
			unset( $fields['billing'][$key] );
	
		}
		
		return $fields;
	}
	add_filter( 'woocommerce_checkout_fields', 'unset_unwanted_checkout_fields' );
	
	
	// A tiny CSS tweak for the account fields; this is optional
	function print_custom_css() {
		echo '<style>.create-account { margin-top: 6em; }</style>';
	}
	add_action( 'wp_head', 'print_custom_css' );
	
	


	
	
}
add_action( 'wp', 'sv_free_checkout_fields' );




/*makes certain fields unrequired */

add_action('wp_enqueue_scripts', 'override_woo_frontend_scripts');
function override_woo_frontend_scripts() {
	wp_deregister_script('wc-address-i18n');
}
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields', 10, 1 );
function custom_override_checkout_fields( $fields ) {
	$fields['billing']['billing_phone']['required'] = false;
	unset($fields['billing']['billing_phone']['validate']);
		
	$fields['billing']['billing_country']['required'] = false;
	unset($fields['billing']['billing_country']['validate']);
	
	$fields['billing']['billing_address_1']['required'] = false;
	unset($fields['billing']['billing_address_1']['validate']);
	
	$fields['billing']['billing_city']['required'] = false;
	unset($fields['billing']['billing_city']['validate']);
	
	$fields['billing']['billing_state']['required'] = false;
	unset($fields['billing']['billing_state']['validate']);
	
	$fields['billing']['billing_postcode']['required'] = false;
	unset($fields['billing']['billing_postcode']['validate']);		
	
	return $fields;
}


/*
add_filter('add_to_cart_redirect', 'themeprefix_add_to_cart_redirect');
function themeprefix_add_to_cart_redirect() {
 global $woocommerce;
 $checkout_url = $woocommerce->cart->get_checkout_url();
 return $checkout_url;
}
*/



?>