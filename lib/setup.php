<?php
namespace Roots\Sage\Setup;

use Roots\Sage\Assets;
use WP_Query;

/**
 * Theme setup
 */
function setup() {
    remove_action( 'wp_head', 'wp_generator' );
    // REMOVE WP EMOJI
    // remove_action( 'wp_head', 'print_emoji_detection_script', 7);
    // remove_action( 'wp_print_styles', 'print_emoji_styles');
    // remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    // remove_action( 'admin_print_styles', 'print_emoji_styles' );

    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );//remove <link rel='https://api.w.org/' href='https://www.comm100.com/wp-json/' />
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

    // Remove p tags from category description
    // remove_filter('term_description','wpautop');
    // Remove p and br tags from page content
    // remove_filter('the_content', 'wpautop');

    // Make theme available for translation
    // Community translations can be found at https://github.com/roots/sage-translations
    load_theme_textdomain('sage', get_template_directory() . '/lang');

    // Enable plugins to manage the document title
    // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
    add_theme_support('title-tag');

    // Register wp_nav_menu() menus
    // http://codex.wordpress.org/Function_Reference/register_nav_menus

    register_nav_menus(array(
        'primary' => 'utility',
        'livechat' => 'top-menu',
        'promotion_20200322' => 'promotion-menu',
        'platformLiveChat' => 'live-chat-menu',
        'platformMultichannel' => 'multichannel-menu',
        'platformAI' => 'ai-menu',
        'solutionUseCase' => 'use-case-menu',
        'solutionIndustry' => 'industry-menu',
        'company' => 'about-us-menu',
        'footerPlatform' => 'footer-platform',
        'footerSolutions' => 'footer-solutions',
        'footerResources' => 'footer-resources',
        'footerCompany' => 'footer-company',
        // 'ticket' => 'Ticket Navigation',
        // 'knowledgebase' => 'Knowledgebase Navigation',
        // 'helpdesk' => 'Helpdesk Navigation',
        // 'forum' => 'Forum Navigation',
        'livechatresource' => 'Live Chat Resource Navigation',
        'livechatblog' => 'Live Chat Blog Navigation',
        'livechatnomenu' => 'Live Chat No Menu Navigation',
        )
    );

    // Enable post thumbnails
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size(387, 200); // 680 pixels wide by 200 pixels tall, resize mode

    // Enable HTML5 markup support
    // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    // Use main stylesheet for visual editor
    // To add custom styles edit /assets/styles/layouts/_tinymce.scss
    add_editor_style(Assets\asset_path('styles/main.css'));

    if( function_exists('acf_add_options_page') ) {
        $option_page = acf_add_options_page('Theme Settings');
    }
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

function remove_p_on_pages() {
    if ( is_page() ) {
        remove_filter( 'the_content', 'wpautop' );
        remove_filter( 'the_excerpt', 'wpautop' );
    }
}
add_action( 'wp_head', __NAMESPACE__ . '\\remove_p_on_pages' );

function remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'  ) );
}
add_action( 'widgets_init', __NAMESPACE__.'\\remove_recent_comments_style' );

function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', __NAMESPACE__.'\\remove_admin_login_header');

/**
 * Register sidebars
 */
function widgets_init() {
    // Define Sidebars
    register_sidebar(array(
        'id' => 'home-sidebar',
        'name' => 'Sidebar',
        'before_widget' => '<div class="c-content-title-1 c-theme c-title-md c-margin-t-40">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="c-font-bold">',
        'after_title' => '</h3><div class="c-line-left c-theme-bg"></div>',
    ));

    register_sidebar(array(
        'id' => 'single-sidebar',
        'name' => 'Post Sidebar',
        'before_widget' => '<div class="c-content-title-1 c-theme c-title-md c-margin-t-40">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="c-font-bold">',
        'after_title' => '</h3><div class="c-line-left c-theme-bg"></div>',
    ));
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Theme assets
 */
function db_assets() {
    $dbData = array(
        'theme_url' => get_template_directory_uri(),
        'db_active' => (!empty(get_field('activate_demandbase')) ? get_field('activate_demandbase') : false)
    );

    //If the page the user is currently on is set up for DemandBase we'll look up all of the matching industry pages so we can output those to the
    //screen and let the JS pick where the user should be redirected to.
    //If we're on a DemandBase activated page we'll also get the DB settings.
    if (get_field('activate_demandbase')) {

        $demandBaseParentPage = (get_field('demandbase_page_type') == 'audience' ? get_field('default_audience_page')->ID : get_the_ID());

        $args = [
            'post_type' => 'any',
            'posts_per_page' => -1,
            'meta_query' => [
                [
                    'key' => 'default_audience_page',
                    'value' => $demandBaseParentPage
                ]
            ],
            'order' => 'asc',
            'orderby' => 'menu_order',
        ];

        $dbAudiencePages = new WP_Query($args);

        $dbData['db_default'] = get_permalink($demandBaseParentPage);

        if ($dbAudiencePages->have_posts()) {
            $dbData['db_audiences'] = array();

            while ($dbAudiencePages->have_posts()) {
                $dbAudiencePages->the_post();

                if (get_field('demandbase_page_type') == 'audience') {
                    $dbAudiencePost = get_field('demandbase_audience');
                    $excludeAudiences = [];

                    if (get_field('exclude_audiences', $dbAudiencePost->ID)) {
                        foreach (get_field('exclude_audiences', $dbAudiencePost->ID) as $audience) {
                            $excludeAudiences[] = [
                                'field' => $audience['audience_field'],
                                'value' => $audience['value']
                            ];
                        }
                    }

                    foreach (get_field('audience_values', $dbAudiencePost->ID) as $audience) {
                        if ($audience['audience_field'] == 'country') {
                            $dbData['db_audiences'][] = [
                                'order' => $dbAudiencePost->menu_order,
                                'field' => 'country_name',
                                'value' => $audience['value'],
                                'url' => get_permalink(),
                                'exclude' => $excludeAudiences,
                            ];

                            $dbData['db_audiences'][] = [
                                'order' => $dbAudiencePost->menu_order,
                                'field' => 'registry_country',
                                'value' => $audience['value'],
                                'url' => get_permalink(),
                                'exclude' => $excludeAudiences,
                            ];
                        } else {
                            $dbData['db_audiences'][] = [
                                'order' => $dbAudiencePost->menu_order,
                                'field' => $audience['audience_field'],
                                'value' => $audience['value'],
                                'url' => get_permalink(),
                                'exclude' => $excludeAudiences,
                            ];
                        }
                    }
                }
            }

            wp_reset_postdata();

            array_multisort(array_column($dbData['db_audiences'], 'order'), SORT_ASC, $dbData['db_audiences']);
        }
    }

    echo "<script type='text/javascript'>/* <![CDATA[ */ var dbGlobal = ".json_encode($dbData)."; /* ]]> */</script>";
    echo '<script type="text/javascript" async="false" src="'.Assets\asset_path('scripts/plugins/db-redirect.js?v=20190911.5').'"></script>';
}
add_action('wp_head', __NAMESPACE__ . '\\db_assets', 1);


/**
 * Theme assets
 */
function assets() {
    wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), array(), time());

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    //   if (!is_admin()) {
    //     // comment out the next two lines to load the local copy of jQuery
    //     wp_deregister_script('jquery');
    //     wp_deregister_script('jquery-migrate');

    //     wp_register_script('jquery', Assets\asset_path('scripts/plugins/jquery.js'), false, '1.11.3', false);
    //     wp_register_script('jquery-migrate', Assets\asset_path('scripts/plugins/jquery-migrate.min.js'), ['jquery'], '1.2.1', false);

    //     wp_enqueue_script('jquery');
    //     wp_enqueue_script('jquery-migrate');
    //   }

    // wp_enqueue_script('comm100api', 'https://www.comm100.com/integrationsapi/apihandler.ashx', '', null, true);
    wp_enqueue_script('sage/bootstrap', Assets\asset_path('scripts/plugins/bootstrap.js'), ['jquery'], null, true);
    wp_enqueue_script('sage/jqueryeasing', Assets\asset_path('scripts/plugins/jquery.easing.min.js'), ['jquery'], null, true);
    wp_enqueue_script('sage/plugins', Assets\asset_path('scripts/plugins/plugins.min.js'), ['jquery'], null, true);

    if ( !is_page_template( 'page-templates/page-noheaderandfooter.php' ) ) {
        wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], time(), true);
    }

    $localizeData = array(
        'theme_url' => get_template_directory_uri(),
        'ajax_url' => admin_url('admin-ajax.php'),
        'site_url' => get_site_url()
    );

    wp_localize_script('sage/js', 'commGlobal', $localizeData);
//   wp_enqueue_script('sage/optimizely', 'https://cdn.optimizely.com/js/9295172620.js', null, null, false);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 9999);

function clean_up_plugin_assets() {
    wp_dequeue_script('webui-popover');
    wp_deregister_script('webui-popover');
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\clean_up_plugin_assets', 9999);

//Disable the custom permalinks plugin on Knowledge Base category pages otherwise it won't load the custom template.
add_filter('custom_permalinks_request_ignore', __NAMESPACE__ . '\\ignore_custom_permalinks_on_kb_category', 0, 1 );
function ignore_custom_permalinks_on_kb_category($request) {
    $ignore = false;

    if (strpos($request, 'livechat/knowledgebase/category') !== false) {
        $ignore = '__true'; //__true is what they compare in the custom permalinks plugin.
    }

    return $ignore;
}

function dequeue_css_from_plugins() {
    wp_dequeue_style( 'kbe_theme_style' );
    wp_deregister_style( 'kbe_theme_style' );

    wp_dequeue_style( 'authorsure' );
    wp_deregister_style( 'authorsure' );
}
add_action( 'wp_print_scripts', __NAMESPACE__.'\\dequeue_css_from_plugins' );

/**
 * Block User Enumeration
 */
function block_user_enumeration_attempts() {
    if ( is_admin() ) return;

    $author_by_id = ( isset( $_REQUEST['author'] ) && is_numeric( $_REQUEST['author'] ) );

    if ( $author_by_id )
        wp_die( 'Author archives have been disabled.' );
}
add_action( 'template_redirect', __NAMESPACE__.'\\block_user_enumeration_attempts' );

function exclude_custom_permalink_post_types( $post_type ) {
    if ( in_array($post_type, ['news', 'releases', 'dbaudience', 'announcement']) ) {
      return '__true';
    }
    return '__false';
  }
  add_filter( 'custom_permalinks_exclude_post_type', __NAMESPACE__.'\\exclude_custom_permalink_post_types');

function custom_mime_types($mime_types){
    $mime_types['eps'] = array('application/postscript', 'image/x-eps', 'application/octet-stream'); //Adding photoshop files
    return $mime_types;
}
add_filter('upload_mimes', __NAMESPACE__.'\\custom_mime_types', 1, 1);

function my_llms_sidebar_function( $id ) {

	$my_sidebar_id = 'single-sidebar';

	return $my_sidebar_id;

}
add_filter( 'llms_get_theme_default_sidebar', __NAMESPACE__.'\\my_llms_sidebar_function' );

function my_llms_theme_support(){
	add_theme_support( 'lifterlms-sidebars' );
}
add_action( 'after_setup_theme', __NAMESPACE__.'\\my_llms_theme_support' );