<?php
namespace Roots\Sage\Shortcodes;

use Roots\Sage\Extras;

// function register_highlight_shortcode($atts, $content) {
//     //Extract the properties from the shortcodes attributes
//     extract(
//         shortcode_atts(
//             [
//                 'layout' => 'tiles'
//             ],
//             $atts
//         )
//     );

//     return '<div class="hightContent"><dfn>'.$content.'</dfn></div>';
// }
// add_shortcode('highlight', __NAMESPACE__.'\\register_highlight_shortcode');

function register_highlight_shortcode($atts, $content) {
    return '<div class="hightContent"><dfn>'.$content.'</dfn></div>';
}
add_shortcode('highlight', __NAMESPACE__.'\\register_highlight_shortcode');

function register_notice_shortcode($atts, $content) {
    return '<div class="notice">'.$content.'</div>';
}
add_shortcode('notice', __NAMESPACE__.'\\register_notice_shortcode');

function register_button_shortcode($atts, $content) {
    //Extract the properties from the shortcodes attributes
    extract(
        shortcode_atts(
            [
                'href' => ''
            ],
            $atts
        )
    );

    return '<a class="btn btn-md c-theme-btn c-btn-square" href="'.$href.'">'.$content.'</a>';
}
add_shortcode('button', __NAMESPACE__.'\\register_button_shortcode');

function register_chat_bubble_shortcode($atts, $content) {
    return '<div class="chat">'.$content.'</div><div class="clear"></div>';
}
add_shortcode('chat_bubble', __NAMESPACE__.'\\register_chat_bubble_shortcode');

function register_tweet_box_shortcode($atts, $content) {
    //Extract the properties from the shortcodes attributes
    extract(
        shortcode_atts(
            [
                'title' => get_the_title(),
                'url' => get_permalink()
            ],
            $atts
        )
    );

    return '
        <div class="tweet-box">
            <a href="" onclick="window.open(\'https://twitter.com/intent/tweet?lang=en&#038;text='.urlencode($title).';url='.urlencode($url).'&#038;count=none&#038;via=Comm100\',\'_blank\',\'width=500,height=500\'); return false;" class="tweet-box-link">
                <p>'.$content.'</p>
                <p><span class="clickToTweet"><i class="fa fa-twitter"></i> Click to tweet</span></p>
            </a>
        </div>
    ';
}
add_shortcode('tweet_box', __NAMESPACE__.'\\register_tweet_box_shortcode');

function register_cta_shortcode($atts, $content) {
    //Extract the properties from the shortcodes attributes
    extract(
        shortcode_atts(
            [
                'title' => get_the_title(),
                'url' => get_permalink(),
                'label' => 'Download Now'
            ],
            $atts
        )
    );

    return '
        <div class="c-content-bar-1 c-opt-1 c-theme-border">
            <h3>'.$title.'</h3>
            <p>'.$content.'</p>
            <a class="btn c-btn-square c-theme-btn c-btn-bold" href="'.$url.'">'.$label.'</a>
        </div>
    ';
}
add_shortcode('cta', __NAMESPACE__.'\\register_cta_shortcode');

function register_featured_resource_shortcode($atts, $content) {
    //Extract the properties from the shortcodes attributes
    extract(
        shortcode_atts(
            [
                'resource_id' => '',
                'title' => '',
                'thumbnail_url' => '',
                'url' => '',
                'tag' => '',
                'label' => 'Download Now'
            ],
            $atts
        )
    );

    if ($resource_id) {
        //If a resource ID was passed we will set the other featured content based on the resource if it hasn't already been defined.
        if (!$tag) {
            $tag = Extras\get_post_taxonomy('commresourcetag', $resource_id)->name;
        }

        if (!$title) {
            $title = get_the_title($resource_id);
        }

        if (!$thumbnail_url) {
            $thumbnail_url = get_the_post_thumbnail_url($resource_id, 'full');
        }

        if (!$url) {
            $url = get_permalink($resource_id);
        }

        if (!$content) {
            $content = get_the_excerpt($resource_id);
        }
    }

    $output = '
    <div class="c-content-bar-1 c-opt-1 c-theme-border c-left">
        <div class="row">
            <div class="col-sm-4">
                <img class="c-margin-b-20 visible-xs" src="'.$thumbnail_url.'" alt="'.$title.'" />
            </div>
            <div class="col-sm-8">
                <h3>'.$title.'</h3>
                <p>'.$content.'</p>
                <a class="btn c-btn-square c-theme-btn c-btn-bold" href="'.$url.'">'.$label.'</a>
            </div>
        </div>';

    $output .= '<div class="c-tag">'.$tag.'</div>';

    $output .= '<div class="bg-thumb hidden-xs" style="background: transparent url('.$thumbnail_url.') no-repeat center center; background-size: cover;"></div>
        </div>
        ';

    return $output;
}
add_shortcode('featured_resource', __NAMESPACE__.'\\register_featured_resource_shortcode');

function register_zoom_image_shortcode($atts, $content) {
    //Extract the properties from the shortcodes attributes
    extract(
        shortcode_atts(
            [
                'src' => '',
                'alt' => ''
            ],
            $atts
        )
    );

    return '
        <div class="content-img c-margin-b-40 c-content-overlay">
            <div class="c-overlay-wrapper">
                <div class="c-overlay-content">
                    <a href="'.$src.'" data-lightbox="fancybox" data-fancybox-group="gallery-1">
                        <i class="icon-magnifier"></i>
                    </a>
                </div>
            </div>
            <img class="img-responsive c-overlay-object" src="'.$src.'" alt="'.$alt.'" width="1400" />
        </div>
    ';
}
add_shortcode('zoom_image', __NAMESPACE__.'\\register_zoom_image_shortcode');


function register_code_shortcode($atts, $content) {
    return '<code class="code">'.$content.'</code>';
}
add_shortcode('code', __NAMESPACE__.'\\register_code_shortcode');

function register_quote_shortcode($atts, $content) {
    //Extract the properties from the shortcodes attributes
    extract(
        shortcode_atts(
            [
                'author' => '',
                'title' => ''
            ],
            $atts
        )
    );

    $quoteMark = '<svg version="1.1" baseProfile="tiny" id="Isolation_Mode" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 82 48" xml:space="preserve"><g><path fill="#0094D4" d="M58.86,47.86v-4.09c0.18,0,0.36,0.01,0.54,0.01c12.04,0,21.81-9.76,21.81-21.81 c0-12.04-9.76-21.81-21.81-21.81c-0.18,0-0.36,0.01-0.54,0.01V0.17c-13.17,0-23.85,10.68-23.85,23.85 C35.02,37.18,45.69,47.86,58.86,47.86z"/><path fill="#0094D4" d="M31.53,24.01c0-7.12,2.9-13.56,7.59-18.21c-3.87-3.49-8.97-5.64-14.59-5.64c-0.18,0-0.36,0.01-0.54,0.01 V0.17c-13.17,0-23.85,10.68-23.85,23.85s10.68,23.85,23.85,23.85v-4.09c0.18,0,0.36,0.01,0.54,0.01c4.65,0,8.94-1.46,12.48-3.94 C33.58,35.48,31.53,29.99,31.53,24.01z"/></g></svg>';

    $output = '
        <div class="quote">
            '.$quoteMark.'
            <div class="quote-content c-margin-b-30 text-center">'.$content.'</div>
            <div class="quote-signature text-right"><strong>'.$author.'</strong>';

    if ($title) {
        $output .= ', '.$title;
    }

    $output .= '</div>
            '.$quoteMark.'
        </div>
    ';

    return $output;
}
add_shortcode('quote', __NAMESPACE__.'\\register_quote_shortcode');