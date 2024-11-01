<?php
/*
 Plugin Name: J Cart Upsell and Cross-sell for WooCommerce
 Description: Boost your woocommerce with targeted upsells, gifts and a cool modal shipping cart
 Version:     3.8.2
 Author:      Giacomo Zoffoli 
 Text Domain: woo_j_cart
 Domain Path: /languages
 Requires at least: 5.0
 Requires PHP: 7.1
 WC required at least: 3.2.0
 WC tested up to: 8.6.0
 */

namespace WcJUpsellator;

use WcJUpsellator\Utility\Notice;

// Make sure we don't expose any info if called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/* Define variables */
define( 'WC_J_UPSELLATOR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WC_J_UPSELLATOR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
/* Define variables */

if ( function_exists( 'wju_fs' ) ) 
{
    wju_fs()->set_basename( false, __FILE__ );

} else {

    final class WcJUpsellator
    { 

      /**
       * Constructor
       *
       * @since 1.0.0
       * @access public
      */

      public function __construct()
      {

        $this->declareHPOSCompatibility();
       
        if( defined( 'WC_J_UPSELLATOR_PLUGIN_DIR' ) )
        {
           
            /* Add textdomain for translations */
            add_action( 'plugins_loaded', array( $this, 'bootstrap' ) );
            add_action( 'init', array( $this, 'load_textdomain' ) );
            add_action( 'init', array( $this, 'init' ) );             
           
        }

      } 

      /**
        * Fired by `init` action hook.
      *   
      * @access public
      */
      public function init() 
      {	
        
          // Check for woocommerce
          if( class_exists( 'woocommerce' ) )
          {  
              require_once( 'plugin.php' );
              return;	  

          }else{
                
              add_action( 'admin_notices', array( $this, 'woocommerceMissing' ) );
                
          } 

      } 
      /**
       * Bootstrap, fired by `plugins_loaded` action hook.
       *
       * @access private
       * Loads class autoloader, configuration variables and Helpers
      */
      public function bootstrap()
      {		
          require( WC_J_UPSELLATOR_PLUGIN_DIR . '/helpers/Freemius.php' );
          require( WC_J_UPSELLATOR_PLUGIN_DIR . '/autoloader.php' );
          require( WC_J_UPSELLATOR_PLUGIN_DIR . '/helpers/Helpers.php' );
          require( WC_J_UPSELLATOR_PLUGIN_DIR . '/config/defines.php' );
          require( WC_J_UPSELLATOR_PLUGIN_DIR . '/config/configuration.php' );		

          require( WC_J_UPSELLATOR_PLUGIN_DIR . '/app/Shortcodes/CartCount.php' );
          require( WC_J_UPSELLATOR_PLUGIN_DIR . '/app/Shortcodes/Upsells.php' );
          require( WC_J_UPSELLATOR_PLUGIN_DIR . '/app/Shortcodes/DynamicBar.php' );
         
      }
      
      public function woocommerceMissing()
      {	  	  
          $notice = new Notice();
          $notice->setText('This plugin requires WooCommerce > 3 to work.');
          $notice->error();
          
          $notice->show();
      }
      
      public function load_textdomain() 
      {    
          load_plugin_textdomain( 'woo_j_cart', false, basename( __DIR__ ) . '/languages/' );	   
      }    
      
      public function declareHPOSCompatibility()
      {
            add_action( 'before_woocommerce_init', function() {
                if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
                    \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
                }
            });
      }
      
    }

    new WcJUpsellator();

  }
