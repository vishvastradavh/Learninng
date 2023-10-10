<?php
/**
 * This is a template file for Add New City form
 */

/** Labels from iws-admin-page.php */
// $country_label, $state_label, $city_label
?>
<form id="iws-add-geo-location" action="<?php echo esc_attr(IWS_GFF_ADMIN_PAGE.'&tab=iws-add-location&subtab=iws-add-city');?>" method="post">

    <div class="form-field">
        <label for="iws-country">Select the <?php echo esc_html($country_label);?> to connect with</label>
        <select name="iws_country" id="iws-country">
            <option value="0">Select <?php echo esc_html($country_label);?></option>
        </select>
        <input type="hidden" name="iws_cont_id" id="iws-cont-id" />
    </div>

    <div class="form-field">
        <label for="iws-state">Select the <?php echo esc_html($state_label);?> to connect with</label>
        <select name="iws_state" id="iws-state">
            <option value="0">Select <?php echo esc_html($state_label);?></option>
        </select>
        <input type="hidden" name="iws_stat_id" id="iws-stat-id" />
    </div>
    
    <div class="form-field">
        <label for="iws-city-name">Enter <?php echo esc_html($city_label);?></label>
        <input type="text" name="iws_city_name" id="iws-city-name" autocomplete="off" disabled placeholder="Select <?php echo esc_html($state_label);?> first" required />
        <input type="hidden" name="iws_cty_id" id="iws-cty-id" />
    </div>

    <div class="form-field">
        <input class="button button-primary" name="iws_add_city_location" id="iws-add-city-location" type="submit" value="Add Geo Location" />
        <p id="iws-error"></p>
    </div>
</form>