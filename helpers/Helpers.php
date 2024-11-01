<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use WcJUpsellator\Core\Conf;
use WcJUpsellator\Core\Env;
/*
/* Display price
*/
function woo_j_price( $price, $extra_classes = [] )
{	
	extract(apply_filters('wc_price_args', wp_parse_args( [], array(		
		'currency' => '',
		'decimal_separator' => wc_get_price_decimal_separator(),
		'thousand_separator' => wc_get_price_thousand_separator(),
		'decimals' => wc_get_price_decimals(),		
	))));

	$price = apply_filters('formatted_woocommerce_price', number_format($price, $decimals, $decimal_separator, $thousand_separator), $price, $decimals, $decimal_separator, $thousand_separator);

	?>
		<div class='wc-timeline-product-price <?= implode(' ', $extra_classes )?> <?php echo woo_j_conf('currency_position') ? 'currency-before' : '' ?>'>
				<span class="wcj-price"><?php echo $price ?></span><span class="currency"><?php echo esc_html( woo_j_conf('currency') ) ?></span>							
		</div>
	<?php 
}
/*
/* Return the displayed price based on "display_prices_including_tax" option 
*/
function woo_j_get_price( $product, $price )
{
	if( WC()->cart->display_prices_including_tax()  ){
		
		return round( wc_get_price_including_tax( $product, array( 'price' => $price ) ), 2 );

	}else{

		return round( wc_get_price_excluding_tax( $product, array( 'price' => $price ) ) , 2 );
	} 
}

function woo_j_conf( $key, $variable = null )
{

		if( $key =='clear')			return Conf::clear('settings');
		if( !empty( $variable ) ) 	return Conf::set('settings', $key, $variable );
		else  		    			return Conf::get('settings', $key );
        
}

function woo_j_checkout( $key, $variable = null )
{

		if( $key =='clear')			return Conf::clear('checkout');
		if( !empty( $variable ) ) 	return Conf::set('checkout', $key, $variable );
		else  		    			return Conf::get('checkout', $key );
        
}

function woo_j_cartpage( $key, $variable = null )
{

		if( $key =='clear')			return Conf::clear('cartpage');
		if( !empty( $variable ) ) 	return Conf::set('cartpage', $key, $variable );
		else  		    			return Conf::get('cartpage', $key );
        
}

function woo_j_integrations( $key, $variable = null )
{

		if( $key =='clear')			return Conf::clear('integrations');
		if( !empty( $variable ) ) 	return Conf::set('integrations', $key, $variable );
		else  		    			return Conf::get('integrations', $key );
        
}

function woo_j_stats( $key, $variable = null )
{

		if( $key =='clear')			return Conf::clear('stats');
		if( !empty( $variable ) ) 	return Conf::set('stats', $key, $variable );
		else  		    			return Conf::get('stats', $key );
        
}

function woo_j_upsell( $key, $variable = null )
{		
		
		if( $key == 'clear')		return Conf::clear('upsell');
		if( !empty( $variable ) ) 	return Conf::set( 'upsell', $key, $variable );
		else  		    			return Conf::get( 'upsell', $key );
        
}

function woo_j_shop( $key, $variable = null )
{		
		
		if( $key == 'clear')		return Conf::clear('shop_pages');
		if( !empty( $variable ) ) 	return Conf::set( 'shop_pages', $key, $variable );
		else  		    			return Conf::get( 'shop_pages', $key );
        
}

function woo_j_exclusion( $key, $variable = null )
{		
		
		if( $key == 'clear')		return Conf::clear('exclusion');
		if( !empty( $variable ) ) 	return Conf::set( 'exclusion', $key, $variable );
		else  		    			return Conf::get( 'exclusion', $key );
        
}

function woo_j_gift( $key, $variable = null )
{		
		
		if( $key == 'clear')		return Conf::clear('gift');
		if( !empty( $variable ) ) 	return Conf::set( 'gift', $key, $variable );
		else  		    			return Conf::get( 'gift', $key );
        
}

function woo_j_shipping( $key, $variable = null )
{		
		
		if( $key == 'clear')		return Conf::clear('shipping_bar');
		if( !empty( $variable ) ) 	return Conf::set( 'shipping_bar', $key, $variable );
		else  		    			return Conf::get( 'shipping_bar', $key );
        
}

function woo_j_env( $key, $variable = null )
{			
		
		if( !empty( $variable ) ) 	return Env::set( $key, $variable );
		else  		    			return Env::get( $key );
        
}

function woo_j_styles( $key, $variable = null )
{		
		
		if( $key == 'clear')		return Conf::clear('styles');
		if( !empty( $variable ) ) 	return Conf::set( 'styles', $key, $variable );
		else  		    			return Conf::get( 'styles', $key );
        
}
/*
/* Multilanguage Helpers
/* Polyland and WPML Compatible
*/
function wjc__( $string, $key = null ) 
{
    if ( function_exists('pll_translate_string')  )
	{
		return isset( $_GET['lang'] ) ? pll_translate_string( $string, sanitize_text_field( $_GET['lang'] )) : pll__( $string ); 
	}   
    
	if ( function_exists('icl_t')  )
	{         
		return icl_t( 'J Cart Upsell', $key, $string );
	}  

    return $string;
}
/*
/* Make a string translatable by multi-language plugins
/* Polyland and WPML Compatible
*/
function wjc__addStringTranslation( $key, $string )
{
	if( function_exists( 'pll_register_string' ) ) pll_register_string( $key, $string, 'J Cart Upsell' );
	if( function_exists( 'icl_register_string' ) ) icl_register_string( 'J Cart Upsell', $key, $string );	
}
/*
/* Translate subarrays by key
/* Polyland and WPML Compatible
*/
function wjc__loadSubArrTranslations( $array, $keys_to_translate, $baseTranslationStringKey = null )
{
	
	if ( empty( $array )  ) return $array;	
	if ( ( !function_exists( 'pll__' ) && !function_exists( 'icl_t' ) ) ) 	return $array;	
	
	$new_arr = [];

	foreach( $array as $index => $item )
	{
		foreach( $keys_to_translate as $key )
		{			
			$item[ $key ] 	=  wjc__( $item[ $key ], $baseTranslationStringKey . ($index+1) );		
		}
				
		$new_arr[] 		= $item;		
			
	}

	return $new_arr;

}
/*
/* Get page slug translated
/* Polyland and WPML Compatible
*/
function wjc_getpage( $id ) 
{
	$page = null;

    if ( function_exists( 'pll_get_post' ) )
	{
		$page = pll_get_post( $id, sanitize_text_field( $_GET['lang'] ?? null ) );  
	}  
	
	if ( function_exists( 'icl_object_id' ) )
	{
		$page = icl_object_id( $id, 'page', true, sanitize_text_field( $_GET['lang'] ?? null ) );  		
	} 
	
    return $page ? get_permalink( $page ) : get_permalink( $id );  
}

function woo_j_render_view( $template_path, $variables = [] )
{
		
		extract( $variables );
	
		include( WC_J_UPSELLATOR_PLUGIN_DIR . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $template_path.'.template.php' );	
}

function woo_j_render_template( $template_path, $variables = [] )
{
		
		$base_path = woo_j_template_path();

		extract( $variables );
		
		$template = locate_template( array( $base_path . $template_path.'.php' ) );
		
		if( $template )
		{
			include $template;	
			return;
		}
		
		include( WC_J_UPSELLATOR_PLUGIN_DIR . "/templates/" . $template_path.'.php' );
}

function woo_j_render_admin_view( $template_path, $variables = [] )
{
		
		extract( $variables );
	
		include( WC_J_UPSELLATOR_PLUGIN_DIR . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . $template_path.'.template.php' );	
}

if ( ! function_exists( 'woo_j_string_filter' ) ) 
{

	function woo_j_string_filter()
	{

		return array(		
			'strong' => array(),
			'em'     => array(),
			'b'      => array(),
			'i'      => array(),
			'br'      => array(),			
			'span' => array(
			  'class' => array(),
			  'style' => array(),
			),			
		  );
	}

}

/**
 * The plugin theme templates path
 *
 * @return    string    The plugin theme templates path.
 * @since     1.0.0
 */
function woo_j_template_path() {
	return apply_filters( 'wjufw_template_path', WC_J_UPSELLATOR_ITEM_SLUG .'/' );
}

/*
/* Get an array of options in a single call
/*
/* Needs WP 6.4
*/
function woo_j_get_all_options( Array $options )
{
	wp_prime_option_caches( $options );  
}




