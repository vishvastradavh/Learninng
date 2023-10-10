<?php
// Terminate if accessed directly
if(!defined('ABSPATH')){
    die();
}

if(isset($_POST['iws_save_settings'])){
    $country_label = sanitize_text_field(get_option('iws-gff-labels', true)['country']);
    $state_label = sanitize_text_field(get_option('iws-gff-labels', true)['state']);
    $city_label = sanitize_text_field(get_option('iws-gff-labels', true)['city']);

    $new_country_label = isset($_POST['iws_lable_country']) ? sanitize_text_field($_POST['iws_lable_country']) : $country_label;
    $new_state_label = isset($_POST['iws_lable_state']) ? sanitize_text_field($_POST['iws_lable_state']) : $state_label;
    $new_city_label = isset($_POST['iws_lable_city']) ? sanitize_text_field($_POST['iws_lable_city']) : $city_label;
    $result = iws_gff_update_geo_labels($new_country_label, $new_state_label, $new_city_label);
    if($result){
        echo "<div class='notice notice-success'><p>Update Successful</p></div>";
    }else{
        echo "<div class='notice notice-error'><p>Update Failed!</p></div>";
    }
}

if(isset($_POST['iws_reset_labels'])){
    $result = iws_gff_reset_geo_labels();
    if($result){
        echo "<div class='notice notice-success'><p>Reset Successful</p></div>";
    }else{
        echo "<div class='notice notice-error'><p>Reset Failed!</p></div>";
    }
}

$country_label = sanitize_text_field(get_option('iws-gff-labels', true)['country']);
$state_label = sanitize_text_field(get_option('iws-gff-labels', true)['state']);
$city_label = sanitize_text_field(get_option('iws-gff-labels', true)['city']);

?>
<div class="iws-row-wrapper">
    <div class="iws-row">
        <h2><?php esc_html_e("Change Labels", IWS_GFF_TXT_DOMAIN); ?></h2>
        <form action="<?php echo esc_attr(IWS_GFF_ADMIN_PAGE.'&tab=iws-geo-setting');?>" method="post">
            <div class="form-field">
                <label for="iws-lable-country">Label for Country</label>
                <input type="text" name="iws_lable_country" id="iws-lable-count" value="<?php echo esc_attr($country_label);?>" required />
            </div>

            <div class="form-field">
                <label for="iws-lable-state">Label for State</label>
                <input type="text" name="iws_lable_state" id="iws-lable-stat" value="<?php echo esc_attr($state_label);?>" required />
            </div>

            <div class="form-field">
                <label for="iws-lable-city">Label for City</label>
                <input type="text" name="iws_lable_city" id="iws-lable-cty" value="<?php echo esc_attr($city_label);?>" required />
            </div>

            <div class="form-field">
                <input class="button button-primary" type="submit" name="iws_save_settings" id="iws-save-settings" value="<?php esc_attr_e("Save", IWS_GFF_TXT_DOMAIN); ?>" />
            </div>
        </form>
    </div>
    <div class="iws-row">
        <form action="<?php echo esc_attr(IWS_GFF_ADMIN_PAGE.'&tab=iws-geo-setting');?>" method="post">
            <h4><?php esc_html_e("Reset all Labels", IWS_GFF_TXT_DOMAIN); ?></h4>
            <input class="button button-warning" type="submit" value="<?php esc_attr_e("Reset", IWS_GFF_TXT_DOMAIN); ?>" name="iws_reset_labels" />
        </form>
    </div>
</div>

<div class="iws-learn-more">
    <h3><?php esc_html_e("Help", IWS_GFF_TXT_DOMAIN); ?></h3>
    <img class="iws-help-img" src="https://img.youtube.com/vi/xdZn88CwPIs/maxresdefault.jpg" data-id="xdZn88CwPIs" data-title="<?php esc_attr_e("How to use IWS - Geo Form Field", IWS_GFF_TXT_DOMAIN); ?>" alt="<?php esc_attr_e("How to use IWS - Geo Form Field", IWS_GFF_TXT_DOMAIN); ?>" width="325" height="180">
    
    <h3><?php esc_html_e("How to use IWS - Geo Form Field", IWS_GFF_TXT_DOMAIN); ?></h3>
    <p><?php esc_html_e("Complete Guide", IWS_GFF_TXT_DOMAIN); ?></p>
</div>