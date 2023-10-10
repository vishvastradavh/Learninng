// jQuery('a.ekit-video-popup.ekit-video-popup-btn').on('click', function() {
//   setTimeout(function() {
//     alert("test");
//     jQuery('#mejs_903952797957041 .video.video_class')[0].play();
//   }, 1000);
// });
setTimeout(function() {
jQuery(document).ready(function(){
  
  jQuery(".video-content").click(function(){
   
    setTimeout(function() {
      
      //jQuery('video.video_class').attr("autoplay","true");
      jQuery('.mejs-button.mejs-playpause-button.mejs-play button').click();
    }, 1000);
  });
	jQuery('.service_we_provide').mouseover(function() {
    var id = jQuery(this).attr('id');
  
    // Toggle 'active' class for '.service_we_provide' elements
    jQuery('.service_we_provide').removeClass('active');
    jQuery(this).addClass('active');
  
    // Smoothly collapse other '.div_item' elements after a timeout
    jQuery('.div_item').not('.' + id).slideUp();
  
    // Delay adding 'active' class to corresponding '.div_item' element
    setTimeout(function() {
      jQuery('.div_item').removeClass('active');
      jQuery('.' + id).addClass('active');
      jQuery('.' + id).slideDown();
    }, 300); // Adjust the timeout (in milliseconds) as needed for desired animation speed
  });

  // form validation 
  setInterval(function() {
  jQuery('#form-field-field_820f3ec').keypress(function (e) {
    var regex = new RegExp("^[a-z A-Z]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
  });
  }, 300);
  setInterval(function() {
  jQuery('#form-field-field_1950b12').keypress(function (e) {
    var regex = new RegExp("^[a-z A-Z]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
  });
  jQuery('#form-field-name').keypress(function (e) {
    var regex = new RegExp("^[a-z A-Z]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
  });
  jQuery('#form-field-field_e18c5c5').keypress(function (e) {
    var regex = new RegExp("^[a-z A-Z]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
  });
  jQuery('#form-field-field_62006f6').keypress(function (e) {
    var regex = new RegExp("[0-9]");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
  });
  }, 300);
  // jQuery('#form-field-field_76e82c6').keypress(function (e) {
  //   var regex = new RegExp("^[a-z A-Z]+$");
  //   var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
  //   if (regex.test(str)) {
  //       return true;
  //   }

  //   e.preventDefault();
  //   return false;
  // });

});
var $typewriter = jQuery('.typewriter');
    var text = $typewriter.text();
    var delay = 50; // Delay between typing each character

    // Clear the text and set initial styles
    $typewriter.empty().css('animation', 'none');

    // Start the typewriter effect
    function typeText(index) {
        if (index < text.length) {
            $typewriter.append(text[index]);
            setTimeout(function() {
                typeText(index + 1);
            }, delay);
        } else {
            $typewriter.css('animation', 'typing 4s steps(40) forwards, blink-caret 0.75s step-end infinite');
        }
    }

    // Start typing from the beginning
    typeText(0);
}, 1000);