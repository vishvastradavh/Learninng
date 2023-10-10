<?php
/**
 * This file defines the functions to Country, State & City Table in Database
 */
// Terminate if accessed directly
if(!defined('ABSPATH')){
    die();
}

/**
 * Function to create country table and insert 250 countries
 * @return array('response'=>(bool)$result, 'message'=>(string)$msg);
 */
function create_iws_countries(){
    global $wpdb, $table_prefix;
    $wp_iws_countries = sanitize_text_field($table_prefix.'iws_countries');
    $result = $msg = '';
    /**
    * DROP TABLE IF EXISTS `$wp_iws_countries` then Create new `$wp_iws_countries`
    */
    $dropped = $wpdb->query("DROP TABLE IF EXISTS `".esc_sql($wp_iws_countries)."`;");

    $query = "CREATE TABLE IF NOT EXISTS `".esc_sql($wp_iws_countries)."` (
        `id` mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
        `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
        `iso3` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `numeric_code` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `iso2` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `phonecode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `capital` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `native` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `region` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `subregion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `timezones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
        `latitude` decimal(10,8) DEFAULT NULL,
        `longitude` decimal(11,8) DEFAULT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $table_created = $wpdb->query($query); // Execute Create table

    require 'setup-countries-table.php';

    return array('response'=>esc_html($result), 'message'=>esc_html($msg));
}

/**
 * Function to create states table and insert 4,880 states
 * Return : array('response'=>(bool)$result, 'message'=>(string)$msg);
 */
function create_iws_states(){
    global $wpdb, $table_prefix;
    $wp_iws_countries = sanitize_text_field($table_prefix.'iws_countries');
    $wp_iws_states = sanitize_text_field($table_prefix.'iws_states');
    $result = $msg = '';
    /**
    * DROP TABLE IF EXISTS `$wp_iws_states` then Create new `$wp_iws_states`
    */
    $dropped = $wpdb->query("DROP TABLE IF EXISTS `".esc_sql($wp_iws_states)."`;");

    $query = "CREATE TABLE IF NOT EXISTS `".esc_sql($wp_iws_states)."` (
        `id` mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
        `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
        `country_id` mediumint UNSIGNED NOT NULL,
        `country_code` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
        `latitude` decimal(10,8) DEFAULT NULL,
        `longitude` decimal(11,8) DEFAULT NULL,
        PRIMARY KEY (`id`),
        KEY `iws_country_region` (`country_id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=4957 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;";
    $table_created = $wpdb->query($query); // Execute Create table
    
    require 'setup-states-table.php';   // Dump Data
    
    return array('response'=>esc_html($result), 'message'=>esc_html($msg));
}

/**
 * Function to create cities table and insert 1,49,066 cities
 * Return : array('response'=>(bool)$result, 'message'=>(string)$msg);
 */
function create_iws_cities(){
    global $wpdb, $table_prefix;
    $wp_iws_countries = sanitize_text_field($table_prefix.'iws_countries');
    $wp_iws_states = sanitize_text_field($table_prefix.'iws_states');
    $wp_iws_cities = sanitize_text_field($table_prefix.'iws_cities');
    $result = $msg = '';

    /**
    * DROP TABLE IF EXISTS `$wp_iws_cities` then Create new `$wp_iws_cities`
    */
    $dropped = $wpdb->query("DROP TABLE IF EXISTS `".esc_sql($wp_iws_cities)."`;");

    $query = "CREATE TABLE IF NOT EXISTS `".esc_sql($wp_iws_cities)."` (
        `id` mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
        `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
        `state_id` mediumint UNSIGNED NOT NULL,
        `country_id` mediumint UNSIGNED NOT NULL,
        `latitude` decimal(10,8) NOT NULL,
        `longitude` decimal(11,8) NOT NULL,
        PRIMARY KEY (`id`),
        KEY `iws_cities_fk_1` (`state_id`),
        KEY `iws_cities_fk_2` (`country_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=149067 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;";
    $table_created = $wpdb->query($query); // Execute Create table
    
    require 'setup-cities-table.php';   // Dump Data into table
    
    return array('response'=>esc_html($result), 'message'=>esc_html($msg));
}