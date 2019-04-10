<?php
namespace Roots\Sage\Analytics;

function store_tracking_vars() {

    if (!isset($_COOKIE['landingUrl1'])) {
        setcookie("landingUrl1",'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],time()+3600*24*365,"/",".comm100.com");
    }

    if (!isset($_COOKIE['R_url']) && isset($_SERVER['HTTP_REFERER'])) {
        setcookie("R_url",$_SERVER['HTTP_REFERER'],time()+3600*24*365,'/','.comm100.com');
    }

    $parts = parse_url(strtolower('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
    $partsQuery = '';
    $query = [];

    console.log($parts);

    if (isset($parts['query'])) {
        parse_str($parts['query'], $query);
    }

    if (isset($query['c_cid'])) {
        if (!isset($_COOKIE['C_cId'])) {
            setcookie("C_cId",$query['c_cid'],time()+3600*24*365,'/');
        } else {
            if (strpos($_COOKIE['C_cId'],$query['c_cid'])===false) {
                setcookie("C_cId",$_COOKIE['C_cId'] . ',' . $query['c_cid'],time()+3600*24*365,'/');
            }
        }
    }

    if (isset($query['utm_source']) && !isset($_COOKIE['utm_source'])) {
      setcookie("utm_source", $query['utm_source'], time()+3600*24*365, '/', '.comm100.com');
    }

    if (isset($query['utm_campaign']) && !isset($_COOKIE['utm_campaign'])) {
      setcookie("utm_campaign", $query['utm_campaign'], time()+3600*24*365, '/', '.comm100.com');
    }

    if (isset($query['utm_medium']) && !isset($_COOKIE['utm_medium'])) {
        setcookie("utm_medium", $query['utm_medium'], time()+3600*24*365, "/", ".comm100.com");
    }

    if (isset($query['utm_term']) && !isset($_COOKIE['utm_term'])) {
        setcookie("utm_term", $query['utm_term'], time()+3600*24*365, "/", ".comm100.com");
    }

    if (isset($query['utm_content']) && !isset($_COOKIE['utm_content'])) {
        setcookie("utm_content", $query['utm_content'], time()+3600*24*365, "/", ".comm100.com");
    }
}
add_action('init', __NAMESPACE__ . '\\store_tracking_vars');

//Count Post Views
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);

    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);

    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }
    else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
