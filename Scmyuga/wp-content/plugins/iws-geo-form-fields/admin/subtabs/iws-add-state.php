<?php
/**
 * This is a template file for Add New State form
 */

/** Labels from iws-admin-page.php */
// $country_label, $state_label, $city_label
?>
<form id="iws-add-geo-location" action="<?php echo esc_attr(IWS_GFF_ADMIN_PAGE.'&tab=iws-add-location&subtab=iws-add-state');?>" method="post">

    <div class="form-field">
        <label for="iws-country">Select the <?php echo esc_html($country_label);?> to connect with</label>
        <select name="iws_country" id="iws-country">
            <option value="0">Select <?php echo esc_html($country_label);?></option>
        </select>
        <input type="hidden" name="iws_cont_id" id="iws-cont-id" />
    </div>
    
    <div class="form-field">
        <label for="iws-state-name">Enter <?php echo esc_html($state_label);?></label>
        <input type="text" name="iws_state_name" id="iws-state-name" autocomplete="off" placeholder="Select <?php echo esc_html($country_label);?> first" required />
        <input type="hidden" name="iws_stat_id" id="iws-stat-id" />
    </div>

    <div class="form-field">
        <input class="button button-primary" name="iws_add_state_location" id="iws-add-state-location" type="submit" value="Add Geo Location" />
        <p id="iws-error"></p>
    </div>
</form>