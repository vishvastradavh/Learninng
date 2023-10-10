<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'hello-elementor','hello-elementor','hello-elementor-theme-style' ) );
        wp_enqueue_script( 'video-playback', get_stylesheet_directory_uri() . '/assets/js/JS_Snippet_for_video_playback.js', array( 'jquery' ) );

    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 99 );

// END ENQUEUE PARENT ACTION

//create a job post type 

/*
* Creating a function to create our CPT
*/
  
function custom_post_type() {
  
    // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Job', 'Post Type General Name', 'twentytwentyone' ),
            'singular_name'       => _x( 'Job', 'Post Type Singular Name', 'twentytwentyone' ),
            'menu_name'           => __( 'Jobs', 'twentytwentyone' ),
            'parent_item_colon'   => __( 'Parent Job', 'twentytwentyone' ),
            'all_items'           => __( 'All Jobs', 'twentytwentyone' ),
            'view_item'           => __( 'View Job', 'twentytwentyone' ),
            'add_new_item'        => __( 'Add New Job', 'twentytwentyone' ),
            'add_new'             => __( 'Add New', 'twentytwentyone' ),
            'edit_item'           => __( 'Edit Job', 'twentytwentyone' ),
            'update_item'         => __( 'Update Job', 'twentytwentyone' ),
            'search_items'        => __( 'Search Job', 'twentytwentyone' ),
            'not_found'           => __( 'Not Found', 'twentytwentyone' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
        );
          
    // Set other options for Custom Post Type
          
        $args = array(
            'label'               => __( 'jobs', 'twentytwentyone' ),
            'description'         => __( 'Jobs', 'twentytwentyone' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions' ),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => true,
      
        );
          
        // Registering your Custom Post Type
        register_post_type( 'job', $args );
      
    }
      
    /* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */
      
    add_action( 'init', 'custom_post_type', 0 );


/* Create a shortcode for the Job 
    */

function scmyuga_get_a_job(){

    $args = array(  
		'post_type' => 'job',
		'post_status' => 'publish',
		'posts_per_page' => -1, 
		'orderby' => 'date',
		'order' => 'DESC', 
	);

    $loop = new WP_Query( $args );
    if ($loop->have_posts()) :
    while ( $loop->have_posts() ) : $loop->the_post();
    ?>
    <input type='hidden' class="scm-job-data" value="<?php the_title(); ?>">
    <input type='hidden' class="scm-job-id" value="<?php echo get_the_ID(); ?>">
    <input type='hidden' class="scm-job-desc" value="<?php echo get_the_content(); ?>">
    
    
    <button type="button" class="scm-btn-job-data" jobdesc="<?php echo get_the_content(); ?>" linkdin-url="<?php echo get_post_meta( get_the_ID(), 'linkedin_url', true ); ?>"button-id="<?php echo get_the_ID(); ?>" button-title="<?php echo get_the_title(); ?>"><?php the_title(); ?></button>

    
    <?php

    wp_reset_postdata();  endwhile; else: ?>
   
   <h2 style="color:#fff;font-size:24px;text-align: center;padding:60px;line-height: 36px;">Found no Vacancies?Keep checking our LinkedIn page to stay posted on new opportunities</h2>
    <?php endif; 
}

add_shortcode( 'scmyuga_get_a_job', 'scmyuga_get_a_job' );

function scm_footer_code(){
    ?>
    <script>
        jQuery(document).ready(function() {
            jQuery("#form-field-field_8e100a0").attr("disabled","disabled");
            jQuery("#form-field-field_fc157ce").attr("disabled","disabled");
            jQuery(".scm-btn-job-data").click(function() {
                
             
                
            jQuery('#job-popup').trigger('click');
            var jobId = jQuery(this).prev(".scm-job-id").val();
            jQuery('#form-field-field_8e100a0').attr("value", jQuery(this).attr("button-title"));
            jQuery('#form-field-field_92291b6').attr("value",jQuery(this).attr("button-id"));
            jQuery('#form-field-field_fc157ce').attr("value",jQuery(this).attr("jobdesc"));
            jQuery('#form-field-field_fc157ce').text(jQuery(this).attr("jobdesc"));
            jQuery('#apply-linkdin').attr("href", jQuery(this).attr("linkdin-url"));
            jQuery('#form-field-field_60710b9').attr("value", jQuery(this).attr("button-title"));
            jQuery('#form-field-field_7451853').attr("value",jQuery(this).attr("jobdesc"));
            

            
});
});

jQuery(document).ready(function(){
    jQuery('.germeny ').hide();
    jQuery(".india-address").hover(function(){

        jQuery('.india').show();
        jQuery('.germeny ').hide();
    });
    jQuery(".germany-address").hover(function(){

        jQuery('.india').hide();
        jQuery('.germeny ').show();
    });

});
document.getElementById('upload').addEventListener('change', function() {
  var fileName = this.files[0].name;
  var span = this.parentNode.querySelector('span');
  span.textContent = fileName;
});
    </script>
    <script>
        const textarea = document.getElementById('myTextarea');
        const charCount = document.getElementById('charCount');

        textarea.addEventListener('input', () => {
            const text = textarea.value;
            const remainingChars = 1000 - text.length;
            charCount.textContent = remainingChars;

            // Optional: Calculate approximate word count
            const words = text.trim().split(/\s+/);
            const wordCount = words.length;
            const remainingWords = 150 - wordCount;
            console.log('Remaining words:', remainingWords);
        });
    </script>
<script>
jQuery(document).ready(function() {
  const text = "Digitally transform your bussiness to unleash the true value chain with SCMYUGA";
  let index = 0;
  const speed = 100; // Adjust this value for typing speed

  function typeText() {
    jQuery("#typing-effect").text(text.substring(0, index));
    index++;
    if (index <= text.length) {
      setTimeout(typeText, speed);
    }
  }

  typeText();
});
</script>
<script>
jQuery(document).ready(function() {
  const text = 'Redefining <br> The Era Of <br> <span style="color:#FEF49C">Supply Chain <br> Management</span>';
  let index = 0;
  const speed = 100; // Adjust this value for typing speed

  function typeText() {
    jQuery("#typing-effect_1").html(text.substring(0, index));
    index++;
    if (index <= text.length) {
      setTimeout(typeText, speed);
    }
  }

  typeText();
});
</script>

    <?php
}
add_action('wp_footer','scm_footer_code');


// Form validation elementor

function elementor_form_validation( $record, $ajax_handler ) {
	$name = $record->get_field( [
		'id' => 'name',
	] );
    $lastname = $record->get_field( [
		'id' => 'field_e18c5c5',
	] );
    $country = $record->get_field( [
		'id' => 'field_76e82c6',
	] );
    

    

	if ( empty( $name ) ) {
		return;
	}
    if ( empty( $lastname ) ) {
		return;
	}
    if ( empty( $country ) ) {
		return;
	}
    

	$namevalidation = current( $name );
    $lastnamevalidation = current( $lastname );
    $countryvalidation = current( $country );
    

	if ( 1 !== preg_match( '/[a-z A-Z]/', $namevalidation['value'] ) ) {
		$ajax_handler->add_error( $namevalidation['id'], esc_html__( 'Please Enter correct firstname', 'textdomain' ) );
	}
    if ( 1 !== preg_match( '/[a-z A-Z]/', $lastnamevalidation['value'] ) ) {
		$ajax_handler->add_error( $lastnamevalidation['id'], esc_html__( 'Please Enter correct lastname', 'textdomain' ) );
	}
    if ( 1 !== preg_match('/[a-z A-Z]/', $countryvalidation['value'] ) ) {
		$ajax_handler->add_error( $countryvalidation['id'], esc_html__( 'Please Enter correct country', 'textdomain' ) );
	}
    
}
add_action( 'elementor_pro/forms/validation', 'elementor_form_validation', 10, 2 );


// in email file attached mail using elementor.

class Elementor_Form_Email_Attachments {
    // Set to true if you want the files to be removed from
    // the server after they are sent by email
    const DELETE_ATTACHMENT_FROM_SERVER = false;
    public $attachments_array = [];
    
    public function __construct() {
    add_action( 'elementor_pro/forms/process', [ $this, 'init_form_email_attachments' ], 11, 2 );
    }
    
    /**
    * @param \ElementorPro\Modules\Forms\Classes\Form_Record $record
    * @param \ElementorPro\Modules\Forms\Classes\Ajax_Handler $ajax_handler
    */
    public function init_form_email_attachments( $record, $ajax_handler ) {
    // check if we have attachments
    $files = $record->get( 'files' );
    if ( empty( $files ) ) {
    return;
    }
    // Store attachment in local var
    foreach ( $files as $id => $files_array ) {
    $this->attachments_array[] = $files_array['path'][0];
    }
    
    // if local var has attachments setup filter hook
    if ( 0 < count( $this->attachments_array ) ) {
    add_filter( 'wp_mail', [ $this, 'wp_mail' ] );
    add_action( 'elementor_pro/forms/new_record', [ $this, 'remove_wp_mail_filter' ], 5 );
    }
    }
    
    public function remove_wp_mail_filter() {
    if ( self::DELETE_ATTACHMENT_FROM_SERVER ) {
    foreach ( $this->attachments_array as $uploaded_file ) {
    unlink( $uploaded_file );
    }
    }
    
    $this->attachments_array = [];
    remove_filter( 'wp_mail', [ $this, 'wp_mail' ] );
    }
    
    public function wp_mail( $args ) {
    $args['attachments'] = $this->attachments_array;
    return $args;
    }
    }
    new Elementor_Form_Email_Attachments();