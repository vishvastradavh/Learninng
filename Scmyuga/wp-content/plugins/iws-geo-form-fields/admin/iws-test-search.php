<?php
/**
 * Provide admin to check if certain location are available in the list
 */

// Terminate if accessed directly
if(!defined('ABSPATH')){
    die();
}
// $country_label, $state_label, $city_label
?>
<div class="iws-row-wrapper">
    <div class="iws-row">
        <h2><?php esc_html_e("Test Search", IWS_GFF_TXT_DOMAIN); ?></h2>
        <form>
            <select name="iws_country" class="iws-geo-fields" id="country">
                <option value="0"><?php echo esc_html(__("Select", IWS_GFF_TXT_DOMAIN)).' '.esc_html($country_label); ?></option>
            </select>
            <select name="iws_state" class="iws-geo-fields" id="state">
                <option disabled selected value="0"><?php echo esc_html(__("Select", IWS_GFF_TXT_DOMAIN)).' '.esc_html($country_label).' '.esc_html(__("First", IWS_GFF_TXT_DOMAIN)); ?></option>
            </select>
            <select name="iws_city" class="iws-geo-fields" id="city">
                <option disabled selected value="0"><?php echo esc_html("Select", IWS_GFF_TXT_DOMAIN).' '.esc_html($state_label).' '.esc_html(__("First", IWS_GFF_TXT_DOMAIN)); ?></option>
            </select>
        </form>
    </div>
</div>

<div class="iws-learn-more">
    <h3><?php esc_html_e("Help", IWS_GFF_TXT_DOMAIN); ?></h3>
    <img class="iws-help-img" src="https://img.youtube.com/vi/xdZn88CwPIs/maxresdefault.jpg" data-id="xdZn88CwPIs" data-title="<?php _e("How to use IWS - Geo Form Field", IWS_GFF_TXT_DOMAIN); ?>" alt="<?php esc_attr_e("How to use IWS - Geo Form Field", IWS_GFF_TXT_DOMAIN); ?>" width="325" height="180">
    
    <h3><?php esc_html_e("How to use IWS - Geo Form Field", IWS_GFF_TXT_DOMAIN); ?></h3>
    <p><?php esc_html_e("Complete Guide", IWS_GFF_TXT_DOMAIN); ?></p>
</div>