<?php
namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
    global $post;
    $classes[0] = 'page-'.$classes[0];

    for ($i = 0; $i < count($classes); $i++) {
        if ($classes[$i] == 'search') {
            $classes[$i] = 'page-'.$classes[$i];
        }
    }

    // Add page slug if it doesn't exist
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = ' page-'.basename(get_permalink());
        }
    }

    // if ($post && get_field('activate_demandbase', $post->ID) && get_field('demandbase_page_type', $post->ID) && get_field('demandbase_audience', $post->ID)) {
    //     $classes[] = 'db-audience-'.sanitize_title(get_field('demandbase_audience', $post->ID)->post_title);
    // } else {
    //     if (isset($_COOKIE['audience'])) {
    //         $classes[] = 'db-audience-'.sanitize_title($_COOKIE['audience']);
    //     }

    //     if (isset($_COOKIE['country'])) {
    //         $classes[] = 'db-audience-'.sanitize_title($_COOKIE['country']);
    //     }
    // }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

function exclude_kb_index_xml_sitemap($archive_url, $post_type) {
    // var_dump($post_type);
    if ($post_type == 'kbe_knowledgebase') {
        $archive_url = get_site_url().'/livechat/knowledgebase/';
    }

    return $archive_url;
}
add_filter('wpseo_sitemap_post_type_archive_link', __NAMESPACE__.'\\exclude_knowledge_base_index_xml_sitemap', 99999, 2);
add_filter('wpseo_enable_xml_sitemap_transient_caching', '__return_false');

// function exclude_kb_index_xml_sitemap($url, $type, $object) {
//     if ($url['loc'] == get_site_url()."/knowledgebase/" || $url == get_site_url()."/knowledgebase/") {
//         return false;
//     }

//     return $url;
// }
// add_filter('wpseo_sitemap_entry', __NAMESPACE__.'\\exclude_kb_index_xml_sitemap', 99999, 3);

//Remove [...] string using Filters
function ellipsis_excerpt_more( $more ) {
    return ' <a href="'.get_permalink().'" class="read-more">+ Read More</a>';
}
add_filter('excerpt_more', __NAMESPACE__.'\\ellipsis_excerpt_more');

function custom_excerpt_length( $length ) {
	return 23;
}
add_filter('excerpt_length', __NAMESPACE__.'\\custom_excerpt_length', 999);

function get_post_taxonomy($taxonomy, $postID) {

    if (!$postID) {
        global $post;
        $postID = $post->ID;
    }

    $post_terms = wp_get_post_terms($postID, $taxonomy);
    $term = '';

	if (count($post_terms) > 0):
        $term = get_term($post_terms[0]);
	endif;

	return $term;
}

//Get multiple tags 获取多个tag
function get_post_taxonomy_more($taxonomy, $postID) {
	$demandbaseInfoJson = (array)json_decode(str_replace('\"','"',$_COOKIE["db_userinfo"]),true);
	//Get audience info 获取访问者的audience信息
	if($demandbaseInfoJson["sub_industry"] == "Insurance"){
		$demandbaseInfo_txt=$demandbaseInfoJson["sub_industry"];
	}
	else {
		$demandbaseInfo_txt=$demandbaseInfoJson["industry"];
	}

    if (!$postID) {
        global $post;
        $postID = $post->ID;
    }

    $post_terms = wp_get_post_terms($postID, $taxonomy);
    $terms = array();

	if (count($post_terms) > 0){
        foreach( $post_terms as $post_term){
        	if(get_field('activate_demandbase',$post_term)){
	    		$demandbase_audiences = get_field('demandbase_audience',$post_term);
	    		$demandbase_titles=array();
	    		foreach ( $demandbase_audiences  as $demandbase_audience){
					$demandbase_titles[]=trim($demandbase_audience->post_title);
				}
				if( in_array(trim($demandbaseInfo_txt),$demandbase_titles)){
					$terms[] = $post_term->name;
				}else{
					//When there is an ADB setting but it does not match, the foreground does not display this tag 
					//有ADB设置，却不相符的时候，前台不显示这个TAG	
				}
			}else{
				$terms[] = $post_term->name;
			}
        	
        }
	}
    
    $term = implode(", ", $terms);
	return $term;
}