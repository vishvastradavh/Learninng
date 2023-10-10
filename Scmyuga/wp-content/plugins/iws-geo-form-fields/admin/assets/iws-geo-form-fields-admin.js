/**
 * IWS - Geo Form Fields 
 * Version: 1.0
 */

jQuery(document).ready(function(){
    var iwsCountry = jQuery('#iws-country-name'),
        countrySubmitBtn = jQuery('#iws-add-country-location'),
        errorMsg = jQuery('#iws-error'),
        onlyInt = /^\d+$/,
        onlyAtoZ = /^[A-Za-z]+$/;  // Only Inetgers

    iwsCountry.keyup(function(){
        var iwsCountryName = jQuery(this).val();
        if(jQuery('#iws_country_list').length && selectedCountryId != ''){
            jQuery('#iws-add-country-location').attr('disabled', 'disabled');
            jQuery('#iws-error').html("Looks like <strong>"+iwsCountryName+"</strong> is already in the list.");
            // return false;
        }else{
            jQuery('#iws-add-country-location').attr('disabled', false);
            jQuery('#iws-error').text("");
        }
    });

    /* Validate Add Country */
    jQuery(countrySubmitBtn).click(function(event){
        var iwsISO3 = jQuery('#iws-add-iso3'),
        iwsISO2 = jQuery('#iws-add-iso2'),
        // iwsPhnCode = jQuery('#iws-add-phncode'),
        iwsNumCode = jQuery('#iws-add-numcode');

        if(iwsCountry.val() != '' && !(iwsCountry.val().length > 2) || !(onlyAtoZ.test(iwsCountry.val()))){
            if(iwsCountry.val() == ''){
                errorMsg.html(iwsGeoLabels.country+" name can not be empty!"); // Add Error text
            }else if(!(onlyAtoZ.test(iwsCountry.val()))){
                errorMsg.html(iwsGeoLabels.country+" name must alphabets only!"); // Add Error text
            }else{
                errorMsg.html(iwsGeoLabels.country+" name must be longer then 2 letters!"); // Add Error text
            }
            return false; // Prevent Form from submitting
        }
        if(iwsISO2.val() != '' && iwsISO2.val().length != 2 || !(onlyAtoZ.test(iwsISO2.val()))){
            if(iwsISO2.val() == ''){
                errorMsg.html("ISO2 can not be empty!"); // Add Error text
            }else if(!(onlyAtoZ.test(iwsISO2.val()))){
                errorMsg.html("ISO2 must be alphabets only,</br>You have entered "+iwsISO2.val()); // Add Error text
            }else{
                errorMsg.html("ISO2 must be 2 letters long,</br>You have entered "+iwsISO2.val().length+" letters"); // Add Error text
            }
            return false; // Prevent Form from submitting
        }
        if(iwsISO3.val() != '' && iwsISO3.val().length != 3 || !(onlyAtoZ.test(iwsISO3.val()))){
            if(!(onlyAtoZ.test(iwsISO3.val()))){
                errorMsg.html("ISO3 must be 3 alphabets,</br>You have entered "+iwsISO3.val()); // Add Error text
            }else{
                errorMsg.html("ISO3 must be 3 letters long,</br>You have entered "+iwsISO3.val().length+" letters"); // Add Error text
            }
            return false; // Prevent Form from submitting
        }
        if(iwsNumCode.val() != '' && !(onlyInt.test(iwsNumCode.val()))){
            errorMsg.html("Numeric Code must be numbers only!"); // Add Error text
            return false; // Prevent Form from submitting
        }
    });
    
    /* Validate Add State */
    // Check if Admin has selected a country
    jQuery('#iws-country').change(function(){
        jQuery('#iws-cont-id').val(jQuery(this).find(':selected').data('id'));
    });
    jQuery('#iws-state-name').on("keyup keydown", function(){
        selectedStateId = '';
        errorMsg.text("");
    });
    jQuery('#iws-add-state-location').click(function(){
        var iwsStateName = jQuery('#iws-state-name').val();
        if(selectedStateId != '' && selectedStateId > 0 && selectedCountryId > 0){
            errorMsg.html("Looks like <strong>"+iwsStateName+"</strong> is already in the list.");
            return false;
        }else{
            if(!(onlyAtoZ.test(iwsStateName))){
                errorMsg.html(iwsGeoLabels.state+" must be alphabets,</br>You have entered "+iwsStateName); // Add Error text
                return false;
            }
            jQuery('#iws-add-state-location').attr('disabled', false);
            errorMsg.text("");
        }
    });

    /* Validate Add City */
    // Check if Admin has selected a country
    jQuery('#iws-state').change(function(){
        jQuery('#iws-stat-id').val(jQuery(this).find(':selected').data('id'));
    });
    jQuery('#iws-city-name').on('keyup keydown change', function(){
        selectedCityId = '';
        errorMsg.text("");
    });
    jQuery('#iws-add-city-location').click(function(){
        var iwsCityName = jQuery('#iws-city-name').val();
        if(iwsCityName == ''){
            errorMsg.html("Please enter "+iwsGeoLabels.city);
            return false;
        }
        if(!(onlyAtoZ.test(iwsCityName))){
            errorMsg.html(iwsGeoLabels.city+" must be alphabets,</br>You have entered "+iwsCityName); // Add Error text
            return false;
        }
        if(iwsCityName.length < 3){
            errorMsg.html(iwsGeoLabels.city+" must be more then 3 letters");
            return false;
        }
        jQuery('#iws-add-state-location').attr('disabled', false);
        if(selectedCityId != '' && selectedCityId > 0 && selectedStateId > 0 && selectedCountryId > 0){
            errorMsg.html("Looks like <strong>"+iwsCityName+"</strong> is already in the list.");
            return false;
        }else{
            errorMsg.text("");
        }
    });


    /* Help Video replace Thumbnail with iframe */
    jQuery('.iws-help-img').click(function(){
        var video_id = jQuery(this).data('id'),
        video_title = jQuery(this).data('title'),
        iframe = `<iframe width="325" height="180" src="https://www.youtube.com/embed/`+video_id+`?autoplay=1" title="`+video_title+`" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
        
        jQuery(iframe).insertAfter(jQuery(this));
        jQuery(this).remove();
    });
});