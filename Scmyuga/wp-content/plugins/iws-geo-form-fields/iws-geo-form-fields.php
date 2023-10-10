<?php
/**
 * Plugin Name: IWS - Geo Form Fields
 * Description: This plugin enables you to use Country > State > City drop-down or Text search selection on your forms built with <strong>Elementor, Contact form 7 or Custom HTML</strong>. Support for forms like Gravity forms, Ninja Form is <strong>coming soon!</strong>
 * Author: ITs. Web Space
 * Author URI: https://www.itswebspace.in/about/
 * Version: 1.0
 * Requires at least: 5.7
 * Requires PHP: 7.2
 * Plugin URI: https://www.itswebspace.in/plugins/geo-form-fields/?source=wp_dash
 * Text Domain: iws-geo-form-fields
 */

// Terminate if accessed directly
if(!defined('ABSPATH')){
    die();
}
define('IWS_GFF_TXT_DOMAIN', 'iws-geo-form-fields');
define('IWS_GFF_SLUG', 'iws-geo-form-fields');
define('IWS_GFF_ADMIN_PAGE', admin_url('options-general.php?page=iws-geo-form-fields&tab=iws-test-search'));
define('IWS_GFF_PLUGIN_URL', plugin_dir_url(__FILE__));
define('IWS_GFF_PLUGIN_PATH', plugin_dir_path(__FILE__));

/**
 * Include Database opetation files
 */
require_once IWS_GFF_PLUGIN_PATH.'sql/setup-db.php';
require_once IWS_GFF_PLUGIN_PATH.'sql/clear-db.php';
require_once IWS_GFF_PLUGIN_PATH.'public/fetch.php';


/**
 * Creates necessary database tables on plugin activation
 */
function iws_geo_form_fields_activate(){

    $countries = create_iws_countries();
    if($countries['response']){
        $states = create_iws_states();
        if($states['response']){
            $cities = create_iws_cities();
            add_option('iws-error-check', $cities);
        }
    }

    // Prepare labels for Country, State and City
    if(get_option('iws-gff-labels', '0') == '0'){
        $iws_geo_labels = array(
            'country' => 'Country',
            'state' => 'State',
            'city' => 'City',
        );
        $iws_geo_labels = array_map('sanitize_text_field', $iws_geo_labels);
        add_option('iws-gff-labels', $iws_geo_labels);
    }
}
register_activation_hook(__FILE__, 'iws_geo_form_fields_activate');
/**
 * Remove all the database tables added by IWS - Geo Form Fields
 */
register_deactivation_hook(__FILE__, 'iws_gff_clear_db'); // function in sql/clear-db.php


/**
 * Add required scripts
 */
function iws_gff_enqueue_scripts(){
    $script_src = IWS_GFF_PLUGIN_URL.'public/assets/iws-geo-form-fields.js';
    $script_ver = filemtime(IWS_GFF_PLUGIN_PATH.'public/assets/iws-geo-form-fields.js');
    $style_src = IWS_GFF_PLUGIN_URL.'public/assets/iws-geo-form-fields.css';
    $style_ver = filemtime(IWS_GFF_PLUGIN_PATH.'public/assets/iws-geo-form-fields.css');

    $country_label = sanitize_text_field(get_option('iws-gff-labels', true)['country']);
    $state_label = sanitize_text_field(get_option('iws-gff-labels', true)['state']);
    $city_label = sanitize_text_field(get_option('iws-gff-labels', true)['city']);

    wp_enqueue_script('iws-geo-form-fields', $script_src, array('jquery'), $script_ver, true);
    $inline_script_code = "let ajaxUrl = '".esc_html(admin_url('admin-ajax.php'))."';
                            let selectedCountryId = selectedStateId = selectedCityId = '';
                            let iwsGeoLabels = {
                                country: '".esc_html($country_label)."', 
                                state: '".esc_html($state_label)."', 
                                city: '".esc_html($city_label)."'
                            };";
    wp_add_inline_script('iws-geo-form-fields', $inline_script_code, 'before' );
    
    wp_enqueue_style('iws-geo-form-fields', $style_src, '', $style_ver);

    if(is_admin()){
        $script_admin_src = IWS_GFF_PLUGIN_URL.'admin/assets/iws-geo-form-fields-admin.js';
        $script_admin_ver = filemtime(IWS_GFF_PLUGIN_PATH.'admin/assets/iws-geo-form-fields-admin.js');
        $style_admin_src = IWS_GFF_PLUGIN_URL.'admin/assets/iws-geo-form-fields-admin.css';
        $style_admin_ver = filemtime(IWS_GFF_PLUGIN_PATH.'admin/assets/iws-geo-form-fields-admin.css');
        wp_enqueue_script('iws-geo-form-fields-admin', $script_admin_src, array('jquery','iws-geo-form-fields'), $script_admin_ver, true);
        wp_enqueue_style('iws-geo-form-fields-admin', $style_admin_src, '', $style_admin_ver);
    }
}
add_action('wp_enqueue_scripts', 'iws_gff_enqueue_scripts');
add_action('admin_enqueue_scripts', 'iws_gff_enqueue_scripts');

/**
 * Add settings in plugin actions links 
 *
 * @param  array  $plugin_actions
 * @param  string $plugin_file
 * @return array
 */
function iws_geo_form_fields_add_action_link( $plugin_actions, $plugin_file ) {
    $new_actions = array();
    if(basename(IWS_GFF_PLUGIN_PATH).'/iws-geo-form-fields.php' === $plugin_file ) {
        $new_actions['iws_gff_settings'] = sprintf('<a href="%s">'.esc_html(__('Settings', IWS_GFF_TXT_DOMAIN)).'</a>', esc_url(admin_url('options-general.php?page='.IWS_GFF_SLUG.'&tab=iws-test-search')));
        $new_actions['iws_gff_tutorials'] = sprintf('<a href="%s" target="blank">'.esc_html(__('Tutorials', IWS_GFF_TXT_DOMAIN)).'</a>', esc_url('https://www.youtube.com/channel/UChvgNtbMI8Pnan7R7FrSIng'));
    }
    return array_merge($new_actions, $plugin_actions);
}
add_filter( 'plugin_action_links', 'iws_geo_form_fields_add_action_link', 10, 2 );


/**
 * Admin Menu Page
 */
function iws_geo_form_fields_admin_page(){
    include IWS_GFF_PLUGIN_PATH.'admin/iws-admin-page.php';
}
/**
 * Admin Menu Settings > IWS - Geo Form Fields
 */
function iws_geo_form_fields_menu(){
    $page_title = $menu_title = __('IWS - Geo Form Fields', IWS_GFF_TXT_DOMAIN);
    $capability = 'manage_options';
    $slug = IWS_GFF_SLUG;
    $callback = 'iws_geo_form_fields_admin_page';
    add_submenu_page('options-general.php', $page_title, esc_html($menu_title), $capability, $slug, $callback);
}
add_action('admin_menu', 'iws_geo_form_fields_menu');

/* === IWS - Geo Form Fields Labels === */
/**
 * This function updates the labels for Country, State and City on the front-end and on Admin pannel
 * 
 * @param string $country_lable
 * @param string $state_lable
 * @param string $city_lable
 */
function iws_gff_update_geo_labels($country_lable, $state_lable, $city_lable){
    // If option not available then add otherwise update
    if(get_option('iws-gff-labels', true) == ''){
        $iws_geo_labels = array(
            'country' => 'Country',
            'state' => 'State',
            'city' => 'City',
        );
        $iws_geo_labels = array_map('sanitize_text_field', $iws_geo_labels);
        return add_option('iws-gff-labels', $iws_geo_labels);
    }else{
        $iws_geo_labels = array(
            'country' => $country_lable,
            'state' => $state_lable,
            'city' => $city_lable,
        );
        $iws_geo_labels = array_map('sanitize_text_field', $iws_geo_labels);
        return update_option('iws-gff-labels', $iws_geo_labels);
    }
}
/**
 * This function resets the labels for Country, State and City on the front-end and on Admin pannel
 * @return (bool) true if the value was updated, false otherwise.
 */
function iws_gff_reset_geo_labels(){
    delete_option('iws-gff-labels'); // Delete options
    $iws_geo_labels = array(
        'country' => 'Country',
        'state' => 'State',
        'city' => 'City',
    );
    $iws_geo_labels = array_map('sanitize_text_field', $iws_geo_labels);
    return add_option('iws-gff-labels', $iws_geo_labels);
}

/**
 * Handle Ajax calls for Country, State and City fields
 */
add_action('wp_ajax_iws_gff_fetch_countries', 'iws_gff_fetch_countries');
add_action('wp_ajax_nopriv_iws_gff_fetch_countries', 'iws_gff_fetch_countries');
add_action('wp_ajax_iws_gff_fetch_states', 'iws_gff_fetch_states');
add_action('wp_ajax_nopriv_iws_gff_fetch_states', 'iws_gff_fetch_states');
add_action('wp_ajax_iws_gff_fetch_cities', 'iws_gff_fetch_cities');
add_action('wp_ajax_nopriv_iws_gff_fetch_cities', 'iws_gff_fetch_cities');