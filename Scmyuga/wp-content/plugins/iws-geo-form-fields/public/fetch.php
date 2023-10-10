<?php
// Terminate if accessed directly
if(!defined('ABSPATH')){
    die;
}

// Labels for Country, State and City
// $country_label = esc_html(get_option('iws-gff-labels', true)['country']);
// $state_label = esc_html(get_option('iws-gff-labels', true)['state']);
$city_label = esc_html(get_option('iws-gff-labels', true)['city']);

/**
 * Fetch All Countries from database
 * @return <option></option> if form field is type 'select'
 * @return <p></p> if form field is type 'text'
 */
function iws_gff_fetch_countries(){
    global $wpdb, $table_prefix;
    $wp_iws_countries = sanitize_text_field($table_prefix.'iws_countries');

    $country_name = sanitize_text_field($_POST['country_name']);
    $country_label = sanitize_text_field(get_option('iws-gff-labels', true)['country']);
    $responce = array();
    $html = $err_msg = "";
    $status = 200;
    if(isset($_POST['country_name'])){
        $query = "SELECT `id`, `name`  FROM `".esc_sql($wp_iws_countries)."` WHERE `name` LIKE '".esc_sql($country_name)."%' OR `iso3` LIKE '%".esc_sql($country_name)."%' ORDER BY `name`;";
    }else{
        $query = "SELECT `id`, `name`  FROM `".esc_sql($wp_iws_countries)."` ORDER BY `name`;";
    }
    $countries = $wpdb->get_results($query);
    if(count($countries)){
        if($_POST['fetch_for'] == "select-one"){
            $html = "<option vlaue='0' data-id='0'>Select ".esc_html($country_label)."</option>";
            foreach($countries as $country){
                $html .= "<option class='iws_country' vlaue='".esc_attr($country->name)."' data-id='".esc_attr($country->id)."'>".esc_html($country->name)."</option>";
            }
        }elseif($_POST['fetch_for'] == "text"){
            $html = "<div id='iws_country_list'>";
            foreach($countries as $country){
                $html .= "<p class='iws_country' data-id='".esc_attr($country->id)."'>".esc_html($country->name)."</p>";
            }
            $html .= "</div>";
        }
    }else{
        if(isset($_POST['country_name'])){
            $html = "<p id='iws-sure-is-country'>Are use sure, <strong>".esc_html($country_name)."</strong> is a country?</p>";
        }else{
            $html = "Something went Wrong! Try reloading the page.";
        }
        $err_msg = $wpdb->last_error;
        $status = 400;
    }
    $responce['html'] = $html;
    $responce['status'] = $status;
    $responce['error_msg'] = $err_msg;
    echo json_encode($responce);
    wp_die();
}

/**
 * Fetch All States from database
 * @return <option></option> if form field is type 'select'
 * @return <p></p> if form field is type 'text'
 */
function iws_gff_fetch_states(){
    global $wpdb, $table_prefix;
    $wp_iws_states = sanitize_text_field($table_prefix.'iws_states');

    $state_label = sanitize_text_field(get_option('iws-gff-labels', true)['state']);
    $responce = array();
    $html = $err_msg = "";
    $status = 200;
    $country_id = sanitize_text_field($_POST['country_id']);
    $state_name = sanitize_text_field($_POST['state_name']);
    if(isset($_POST['state_name'])){
        $query = "SELECT `id`, `name`  FROM `".esc_sql($wp_iws_states)."` WHERE `name` LIKE '".esc_sql($state_name)."%' AND `country_id` = ".esc_sql($country_id)." ORDER BY `name`;";
    }else{
        $query = "SELECT `id`, `name`  FROM `".esc_sql($wp_iws_states)."` WHERE `country_id` = ".esc_sql($country_id)." ORDER BY `name`;";
    }
    $states = $wpdb->get_results($query);
    if(count($states)){
        if($_POST['fetch_for'] == "select-one"){
            $html = "<option vlaue='0' data-id='0'>Select ".esc_html($state_label)."</option>";
            foreach($states as $state){
                $html .= "<option class='iws_state' vlaue='".esc_attr($state->name)."' data-id='".esc_attr($state->id)."'>".esc_html($state->name)."</option>";
            }
        }elseif($_POST['fetch_for'] == "text"){
            $html = "<div id='iws_state_list'>";
            foreach($states as $state){
                $html .= "<p class='iws_state' data-id='".esc_attr($state->id)."'>".esc_html($state->name)."</p>";
            }
            $html .= "</div>";
        }
    }else{
        if(isset($_POST['state_name'])){
            $html = "<p id='iws-sure-is-state'>Are use sure, <strong>".esc_html($state_name)."</strong> is a $state_label?</p>";
        }else{
            $html = "<option class='iws_state' vlaue='none' data-id='0' selected disabled>No ".esc_html($state_name)." Found</option>";
        }
        $err_msg = $wpdb->last_error;
        $status = 404;
    }
    $responce['html'] = $html;
    $responce['status'] = $status;
    $responce['error_msg'] = $err_msg;
    echo json_encode($responce);
    wp_die();
}

/**
 * Fetch All Cities from database
 * @return <option></option> if form field is type 'select'
 * @return <p></p> if form field is type 'text'
 */
function iws_gff_fetch_cities(){
    global $wpdb, $table_prefix;
    $wp_iws_cities = sanitize_text_field($table_prefix.'iws_cities');

    $city_label = sanitize_text_field(get_option('iws-gff-labels', true)['city']);
    $state_id = sanitize_text_field($_POST['state_id']);
    $city_name = sanitize_text_field($_POST['city_name']);
    $responce = array();
    $html = $err_msg = "";
    $status = 200;
    if(isset($_POST['city_name'])){
        $query = "SELECT `id`, `name`  FROM `".esc_sql($wp_iws_cities)."` WHERE `name` LIKE '".esc_sql($city_name)."%' AND `state_id` = ".esc_sql($state_id)." ORDER BY `name`;";
    }else{
        $query = "SELECT `id`, `name`  FROM `".esc_sql($wp_iws_cities)."` WHERE `state_id` = ".esc_sql($state_id)." ORDER BY `name`;";
    }
    $cities = $wpdb->get_results($query);
    if(count($cities)){
        if($_POST['fetch_for'] == "select-one"){
            $html = "<option vlaue='0' data-id='0'>Select ".esc_html($city_label)."</option>";
            foreach($cities as $city){
                $html .= "<option class='iws_city' vlaue='".esc_attr($city->name)."' data-id='".esc_attr($city->id)."'>".esc_html($city->name)."</option>";
            }
        }elseif($_POST['fetch_for'] == "text"){
            $html = "<div id='iws_city_list'>";
            foreach($cities as $city){
                $html .= "<p class='iws_city' data-id='".esc_attr($city->id)."'>".esc_html($city->name)."</p>";
            }
            $html .= "</div>";
        }
    }else{
        if(isset($_POST['city_name'])){
            $html = "<p id='iws-sure-is-city'>Are use sure, <strong>".esc_html($city_name)."</strong> is a $city_label?</p>";
        }else{
            $html = "<option class='iws_city' vlaue='none' data-id='0' selected disabled>No ".esc_html($city_name)." Found</option>";
        }
        $err_msg = $wpdb->last_error;
        $status = 400;
    }
    $responce['html'] = $html;
    $responce['status'] = $status;
    $responce['error_msg'] = $err_msg;
    echo json_encode($responce);
    wp_die();
}
