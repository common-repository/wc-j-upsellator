<?php

/* Define variables for the plugin */
woo_j_env( 'public_css_path', WC_J_UPSELLATOR_PLUGIN_URL . 'assets' . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR );
woo_j_env( 'public_js_path', WC_J_UPSELLATOR_PLUGIN_URL . 'assets' . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR );
woo_j_env( 'admin_css_path', WC_J_UPSELLATOR_PLUGIN_URL . 'assets' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR );
woo_j_env( 'admin_js_path', WC_J_UPSELLATOR_PLUGIN_URL . 'assets' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR );
woo_j_env( 'img_path', WC_J_UPSELLATOR_PLUGIN_URL . 'assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR );
$options_keys = [
    'woo_j_upsellator_settings',
    'woo_j_upsellator_styles',
    'woo_j_upsellator_upsell',
    'woo_j_upsellator_shipping_bar',
    'woo_j_upsellator_cartpage',
    'woo_j_upsellator_integrations',
    'woo_j_upsellator_shop_pages',
    'woo_j_upsellator_gift',
    'woo_j_upsellator_exclusion'
];
woo_j_env( 'option_keys', $options_keys );