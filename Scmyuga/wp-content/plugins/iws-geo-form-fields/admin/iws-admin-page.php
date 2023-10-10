<?php
// Terminate if accessed directly
if(!defined('ABSPATH')){
    die();
}

$tab = isset($_GET['tab']) ? sanitize_file_name($_GET['tab']) : sanitize_file_name('iws-test-search');
$country_label = sanitize_text_field(get_option('iws-gff-labels', true)['country']);
$state_label = sanitize_text_field(get_option('iws-gff-labels', true)['state']);
$city_label = sanitize_text_field(get_option('iws-gff-labels', true)['city']);

?>
<div class="wrap">
    <h1 class="wp-heading-inline"><?php echo get_admin_page_title(); ?></h1>
    <div class="notice notice-info iws-info">
        <p>
            <Strong><?php esc_html_e("Usefull information!", IWS_GFF_TXT_DOMAIN); ?></strong></p>
            <p><?php esc_html_e("Use this text as a part of the 'ID' for respective field;", IWS_GFF_TXT_DOMAIN); ?> 
            <?php echo esc_html($country_label); ?>  => <code>country</code>, 
            <?php echo esc_html($state_label); ?>  => <code>state</code>, 
            <?php echo esc_html($city_label); ?>  => <code>city</code></p>
        </p>
    </div>

    <div class="iws_wrapper">

        <div class="iws-tabs-wrapper nav-tab-wrapper">

            <!-- Test search link -->
            <a href="<?php echo esc_attr(IWS_GFF_ADMIN_PAGE.'&tab=iws-test-search');?>" class="nav-tab <?php echo ($tab=='iws-test-search' || empty($tab)) ? esc_attr('nav-tab-active') : '';?>"><?php esc_html_e('Test Search', IWS_GFF_TXT_DOMAIN)?></a>
            
            <!-- Add location link -->
            <a href="<?php echo esc_attr(IWS_GFF_ADMIN_PAGE.'&tab=iws-add-location&subtab=iws-add-country');?>" class="nav-tab <?php echo ($tab=='iws-add-location') ? esc_attr('nav-tab-active') : '';?>"><?php esc_html_e('Add New Location', IWS_GFF_TXT_DOMAIN)?></a>
            
            <!-- Settings link -->
            <a href="<?php echo esc_attr(IWS_GFF_ADMIN_PAGE.'&tab=iws-geo-setting');?>" class="nav-tab <?php echo ($tab=='iws-geo-setting') ? esc_attr('nav-tab-active') : '';?>"><?php esc_html_e('Settings', IWS_GFF_TXT_DOMAIN)?></a>
        </div>

        <div class="iws-admin-wrapper">
            <?php
                require "$tab.php"; // Tab body
            ?>
        </div>

    </div>

</div>