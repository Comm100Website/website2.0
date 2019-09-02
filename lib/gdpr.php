<?php
//Added by webtoffee to show cookie widget to Canada visitors
function wt_add_more_countries($country_list) {

    array_push($country_list, 'CA');
    return $country_list;

}
add_filter('wt_gdpr_eu_countrylist', 'wt_add_more_countries');

//Added by webtoffee to block scripts before the consent is given by visitors
function scripts_list() {
    $scripts = array(
        array(
            'id' => 'demandbase',
            'label' => 'DemandBase',
            'key' => array('scripts.demandbase.com/3a8f4374.min.js', 'demandbase_js_lib'),
            'category' => 'analytics',
            'status' => 'yes'
        ),
        array(
            'id' => 'capterra',
            'label' => 'Capterra Pixel',
            'key' => array('/capterra_tracker.js'),
            'category' => 'advertising',
            'status' => 'yes'
        )
    );
    return $scripts;
}
add_filter('cli_extend_script_blocker', 'scripts_list', 10, 1);