<?php

namespace WcJUpsellator\Integrations\Plugins;
use WcJUpsellator\Integrations\Plugins\BasePlugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/*
/* FOX – Currency Switcher Professional for WooCommerce
*/
class WMCCurcyIntegration extends BasePlugin
{       

    public static function load()
    {
        $page = new self();	       
        
        add_filter( 'wjufw_shipping_bar_limit', array( $page, 'changeLimit' ) );
        add_filter( 'wjufw_product_cart_limit', array( $page, 'changeLimit' ) );
        add_filter( 'wjufw_upsell_sale_price', array( $page, 'upsellSalePrice' ) );
        
    }

    public function changeLimit( $limit )
    {
        if( !function_exists('wmc_get_price') ) return $limit;
        
        return wmc_get_price( $limit );	
    } 

    public function upsellSalePrice( $price )
    {
        return wmc_revert_price( $price );
    }


}