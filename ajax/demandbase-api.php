<?php
//Getting a users IP is a simple request that shouldn't require Wordpress to fire up for an ajax call. This script will return the users
//IP in the fraction of the time of a Wordpress ajax call.
if (strpos($_SERVER['HTTP_REFERER'], 'comm100.com') !== false) {
    $ipaddress = '';

    if ($_SERVER['HTTP_CLIENT_IP']) {
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

    $data = array("key" => '93a94bee701e61a781c480ae1bedcbc9', "query" => $ipaddress, "page" => $_SERVER['HTTP_REFERER'], "page_title" => 'Page Title');

    // Open connection
    $ch = curl_init();
echo 'https://api.demandbase.com/api/v2/ip.json?' . http_build_query($data);
    curl_setopt($ch, CURLOPT_URL, 'https://api.demandbase.com/api/v2/ip.json?' . http_build_query($data));
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);

    echo $result;
}