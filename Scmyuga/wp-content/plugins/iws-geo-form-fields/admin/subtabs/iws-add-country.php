<?php
/**
 * This is a template file for Add New Country form
 */

/** Labels from iws-admin-page.php */
// $country_label, $state_label, $city_label
?>
<form id="iws-add-geo-location" action="<?php echo esc_attr(IWS_GFF_ADMIN_PAGE.'&tab=iws-add-location&subtab=iws-add-country');?>" method="post">

    <div class="form-field">
        <label for="iws-country-name"><?php echo esc_html($country_label);?> Name <span style="color: red;">*</span></label>
        <input type="text" name="iws_country_name" id="iws-country-name" required autocomplete="off" placeholder="India" />
        <input type="hidden" name="iws_count_id" id="iws-count-id" />
    </div>

    <div class="form-field">
        <label for="iws-add-iso2">ISO 2 / Alpha-2 code <span style="color: red;">*</span></label>
        <input type="text" name="iws_add_iso2" id="iws-add-iso2" autocomplete="off" placeholder="IN" required />
    </div>

    <div class="form-field">
        <label for="iws-add-iso3">ISO 3 / Alpha-3 code</label>
        <input type="text" name="iws_add_iso3" id="iws-add-iso3" autocomplete="off" placeholder="IND" />
    </div>

    <div class="form-field">
        <label for="iws-add-phncode">Phone Code</label>
        <input type="text" name="iws_add_phncode" id="iws-add-phncode" autocomplete="off" placeholder="+91" />
    </div>

    <div class="form-field">
        <label for="iws-add-numcode">Numeric Code</label>
        <input type="text" name="iws_add_numcode" id="iws-add-numcode" autocomplete="off" placeholder="356" />
    </div>

    <div class="form-field">
        <input class="button button-primary" id="iws-add-country-location" type="submit" value="Add Geo Location" name="iws_add_country_location" />
        <p id="iws-error"></p>
    </div>
</form>