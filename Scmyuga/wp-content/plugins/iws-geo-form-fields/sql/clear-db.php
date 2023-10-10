<?php
if(!defined('ABSPATH')){
    die();
}

/**
 * Remove all the tables created by IWS - Geo Form Fields from Database
 */

/**
 * Fucnction to clear Country Table
 */
function iws_clear_country(){
    global $wpdb, $table_prefix;
    $wp_iws_cities = sanitize_text_field($table_prefix.'iws_cities');
    $wpdb->query("DROP TABLE IF EXISTS `".esc_sql($wp_iws_states)."`;");
}

/**
 * Function to clear State Table
 */
function iws_clear_states(){
    global $wpdb, $table_prefix;
    $wp_iws_states = $table_prefix.'iws_states';
    $wpdb->query("DROP TABLE IF EXISTS `$wp_iws_states`;");
}

/**
 * Function to clear City Table
 */
function iws_clear_cities(){
    global $wpdb, $table_prefix;
    $wp_iws_countries = sanitize_text_field($table_prefix.'iws_countries');
    $wpdb->query("DROP TABLE IF EXISTS `".esc_sql($wp_iws_countries)."`;");
}

/**
 * Function to clear Country, State & City Tables
 */
function iws_gff_clear_db(){
    global $wpdb, $table_prefix;
    $wp_iws_countries = sanitize_text_field($table_prefix.'iws_countries');
    $wp_iws_states = sanitize_text_field($table_prefix.'iws_states');
    $wp_iws_cities = sanitize_text_field($table_prefix.'iws_cities');

    $wpdb->query("DROP TABLE IF EXISTS `".esc_sql($wp_iws_cities)."`;");
    $wpdb->query("DROP TABLE IF EXISTS `".esc_sql($wp_iws_states)."`;");
    $wpdb->query("DROP TABLE IF EXISTS `".esc_sql($wp_iws_countries)."`;");
    delete_option('iws-gff-labels');
    delete_option('iws-error-check');
}