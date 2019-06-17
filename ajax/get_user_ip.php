<?php
//Getting a users IP is a simple request that shouldn't require Wordpress to fire up for an ajax call. This script will return the users
//IP in the fraction of the time of a Wordpress ajax call.
if (strpos($_SERVER['HTTP_REFERER'], 'comm100.com') !== false || strpos($_SERVER['HTTP_REFERER'], 'wpengine.com') !== false) {
    $ipaddress = '';

    if($_SERVER['HTTP_CLIENT_IP']) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } elseif($_SERVER['HTTP_X_FORWARDED_FOR']) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif($_SERVER['HTTP_X_FORWARDED']) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } elseif($_SERVER['HTTP_FORWARDED_FOR']) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } elseif($_SERVER['HTTP_FORWARDED']) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } elseif($_SERVER['REMOTE_ADDR']) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } elseif($_SERVER['REMOTE_HOST']) {
        $ipaddress = $_SERVER['REMOTE_HOST'];
    } else {
        $ipaddress = 'UNKNOWN';
    }

    echo $ipaddress;
}