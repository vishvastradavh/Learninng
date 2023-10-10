<?php
// Terminate if accessed directly
if(!defined('ABSPATH')){
    die();
}

$subtab = isset($_GET['subtab']) ? sanitize_file_name($_GET['subtab']) : sanitize_file_name('iws-add-country');

/**
 * If New Country is submited
 */
if(isset($_POST['iws_add_country_location'])){
    global $wpdb, $table_prefix;
    $wp_iws_countries = sanitize_text_field($table_prefix."iws_countries");
    $country_name = sanitize_text_field($_POST['iws_country_name']);
    $iso3 = sanitize_text_field($_POST['iws_add_iso3']);
    $iso2 = sanitize_text_field($_POST['iws_add_iso2']);
    $phncode = sanitize_text_field($_POST['iws_add_phncode']);
    $numcode = sanitize_text_field($_POST['iws_add_numcode']);

    if(isset($_POST['iws_country_name'])){
        $data = array('name' => ucfirst($country_name));    // Convert first character to upper
        if($iso3 != ''){
            $data['iso3'] = strtoupper($iso3);
        }
        if($iso2 != ''){
            $data['iso2'] = strtoupper($iso2);
        }
        if($phncode != ''){
            $data['phonecode'] = $phncode;
        }
        if($numcode != ''){
            $data['numeric_code'] = $numcode;
        }
        $result = $wpdb->insert($wp_iws_countries, $data);
        if($result != false){
            echo "<div class='notice notice-success'><p>".esc_html($country_label)." Added. <a href='".esc_attr(IWS_GFF_ADMIN_PAGE.'&tab=iws-add-location&subtab=iws-add-state')."'>Add ".esc_html($state_label)."</a></p></div>";
        }else{
            echo "<div class='notice notice-error'><p> Failed to add ".esc_html($country_label)."!; ".esc_html($wpdb->last_error)."</p></div>";
        }
    }else{
        echo "<div class='notice notice-warning'><p>Please enter ".esc_html($country_label)." name</p></div>";
    }
}

/**
 * If New State is submited
 */
if(isset($_POST['iws_add_state_location'])){
    global $wpdb, $table_prefix;
    $wp_iws_countries = sanitize_text_field($table_prefix."iws_countries");
    $wp_iws_states = sanitize_text_field($table_prefix."iws_states");
    $country_name = sanitize_text_field($_POST['iws_country']);
    $country_id = sanitize_text_field($_POST['iws_cont_id']);
    $state_name = sanitize_text_field($_POST['iws_state_name']);
    $country_code = sanitize_text_field($wpdb->get_var("SELECT `iso2` FROM $wp_iws_countries WHERE `id` = $country_id"));

    if(isset($_POST['iws_state_name'])){
        $data = array('name' => ucfirst($state_name));
        if($country_id != 'None'){
            $data['country_id'] = $country_id;
        }
        if($country_code != null){
            $data['country_code'] = strtoupper($country_code);
        }
        $result = $wpdb->insert($wp_iws_states, $data);
        if($result != false){
            echo "<div class='notice notice-success'><p>".esc_html($state_label)." Added. <a href='".esc_attr(IWS_GFF_ADMIN_PAGE.'&tab=iws-add-location&subtab=iws-add-city')."'>Add ".esc_html($city_label)."</a></p></div>";
        }else{
            echo "<div class='notice notice-error'><p> Failed to add ".esc_html($state_label)."!; ".esc_html($wpdb->last_error)."</p></div>";
        }
    }else{
        echo "<div class='notice notice-warning'><p>Please enter ".esc_html($state_label)."</p></div>";
    }
}

/**
 * If New City is submited
 */
if(isset($_POST['iws_add_city_location'])){
    global $wpdb, $table_prefix;
    $wp_iws_countries = sanitize_text_field($table_prefix."iws_countries");
    $wp_iws_states = sanitize_text_field($table_prefix."iws_states");
    $wp_iws_cities = sanitize_text_field($table_prefix."iws_cities");
    $country_id = sanitize_text_field($_POST['iws_cont_id']);
    $state_id = sanitize_text_field($_POST['iws_stat_id']);
    $city_name = sanitize_text_field($_POST['iws_city_name']);

    if(isset($_POST['iws_city_name'])){
        $data = array('name' => ucfirst($city_name));
        if($country_id != ''){
            $data['country_id'] = $country_id;
        }
        if($state_id != ''){
            $data['state_id'] = $state_id;
            $result = $wpdb->insert($wp_iws_cities, $data);
            if($result != false){
                echo "<div class='notice notice-success'><p>".esc_html($city_label)." Added. <a href='".esc_attr(IWS_GFF_ADMIN_PAGE.'&tab=iws-test-search')."'>Perform a test search!</a></p></div>";
            }else{
                echo "<div class='notice notice-error'><p> Failed to add ".esc_html($city_label)."!; ".esc_html($wpdb->last_error)."</p></div>";
            }
        }
    }else{
        echo "<div class='notice notice-warning'><p>Please enter ".esc_html($city_label)."</p></div>";
    }
}

?>
<div class="iws-row-wrapper iws-add-location-page">
    <div class="iws-row">
        <h2><?php esc_html_e("Add New Location", IWS_GFF_TXT_DOMAIN); ?></h2>
        <div class="iws-tabs-wrapper nav-tab-wrapper">
            <!-- Add Country link -->
            <a href="<?php echo esc_attr(IWS_GFF_ADMIN_PAGE.'&tab=iws-add-location&subtab=iws-add-country');?>" class="nav-tab <?php echo ($subtab=='iws-add-country' || !isset($_GET['tab']))? esc_attr('nav-tab-active') : esc_attr('') ;?>">Add <?php esc_html_e($country_label); ?></a>
            
            <!-- Add State link -->
            <a href="<?php echo esc_attr(IWS_GFF_ADMIN_PAGE.'&tab=iws-add-location&subtab=iws-add-state');?>" class="nav-tab <?php echo ($subtab=='iws-add-state')? esc_attr('nav-tab-active') : esc_attr('') ;?>">Add <?php esc_html_e($state_label); ?></a>
            
            <!-- Add City link -->
            <a href="<?php echo esc_attr(IWS_GFF_ADMIN_PAGE.'&tab=iws-add-location&subtab=iws-add-city');?>" class="nav-tab <?php echo ($subtab=='iws-add-city')? esc_attr('nav-tab-active') : esc_attr('') ;?>">Add <?php esc_html_e($city_label); ?></a>
        </div>
        <?php
            require "subtabs/".sanitize_file_name($subtab).".php";
        ?>
    </div>
</div>

<div class="iws-learn-more">
    <h3><?php esc_html_e("Help", IWS_GFF_TXT_DOMAIN); ?></h3>
    <img class="iws-help-img" src="https://img.youtube.com/vi/xdZn88CwPIs/maxresdefault.jpg" data-id="xdZn88CwPIs" data-title="<?php esc_attr_e("How to Add new Locations in IWS - Geo Form Field", IWS_GFF_TXT_DOMAIN); ?>" alt="<?php esc_attr_e("How to Add new Locations in IWS - Geo Form Field", IWS_GFF_TXT_DOMAIN); ?>" width="325" height="180">
    
    <h3><?php esc_html_e("How to Add new Locations in IWS - Geo Form Field", IWS_GFF_TXT_DOMAIN); ?></h3>
    <p><?php esc_html_e("Complete Guide", IWS_GFF_TXT_DOMAIN); ?></p>
</div>