<?php

namespace WcJUpsellator\Integrations\Plugins;
use WcJUpsellator\Integrations\Plugins\BasePlugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WOOCSIntegration extends BasePlugin
{       

    public static function load()
    {
        $page = new self();	       

        if (class_exists('WOOCS'))
        {
            add_filter( 'wjufw_shipping_bar_limit', array( $page, 'changeLimit' ) );
            add_filter( 'wjufw_product_cart_limit', array( $page, 'changeLimit' ) );
            add_filter( 'wjufw_upsell_sale_price', array( $page, 'upsellSalePrice' ) );
        }      
        
    }

    public function changeLimit( $limit )
    {
        return apply_filters('woocs_exchange_value', $limit);	
    } 

    public function upsellSalePrice( $price )
    {
        global $WOOCS;

        $currencies = $WOOCS->get_currencies();      

        return $WOOCS->back_convert( $price, $currencies[ $WOOCS->current_currency ]['rate'], 2 );
    }


}