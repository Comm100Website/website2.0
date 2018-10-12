<?php
namespace Roots\Sage\Ajax;

// Display User IP in WordPress
function get_the_user_ip() {
    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    //$longip = ip2long(apply_filters( 'wpb_get_ip', $ip ));
    //$unsignedlongip = sprintf("%u\n", ip2long(apply_filters( 'wpb_get_ip', $ip )));
      $unsignedlongip = sprintf("%u", ip2long($ip));
    return $unsignedlongip;
}
function object2array($object) {
    $object =  json_decode( json_encode( $object),true);
    return  $object;
}
function getcountry(){
    $longip = get_the_user_ip();
    $iptolocation = 'https://hosted.comm100.com/ipcacheservice/IP2Geo.ashx?key=KSj4Pi8dhldf343j&ipnum=' . $longip;
    $creatorlocation = file_get_contents($iptolocation);
    $arrayinfo = object2array(json_decode($creatorlocation));
    return $arrayinfo["_country"];
}

//get visitor IP
function get_visitor_ip() {
    $ip = '0.0.0.0';

    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

add_action('wp_ajax_getVisitorIP_action', __NAMESPACE__.'\\getVisitorIP');
add_action('wp_ajax_nopriv_getVisitorIP_action', __NAMESPACE__.'\\getVisitorIP');

function getVisitorIP(){
    $ip = get_visitor_ip();
    echo $ip;
    die();
}

//get visitor country
add_action('wp_ajax_getPosition_action', __NAMESPACE__.'\\getPosition');
add_action('wp_ajax_nopriv_getPosition_action', __NAMESPACE__.'\\getPosition');

function getPosition(){
    echo getcountry();
    die();
}

//white paper
add_action('wp_ajax_mail_action', __NAMESPACE__.'\\sending_mail');
add_action('wp_ajax_nopriv_mail_action', __NAMESPACE__.'\\sending_mail');

function sending_mail(){
    //record to txt
    $whitepaperid = $_POST['whitepaperid'];
    $whitepaper_username = $_POST['whitepaper_username'];
    $whitepaper_email = $_POST['whitepaper_email'];
    $whitepaper_tel = $_POST['whitepaper_tel'];
    // $whitepaper_website = $_POST['whitepaper_website'];
    $whitepaper_company = $_POST['whitepaper_company'];
    $myfile = "";
    $refererURL = $_COOKIE['R_url'];
    $c_cid = $_COOKIE['C_cId'];
    $landingpage = $_COOKIE['landingUrl1'];
    $requestpage = "";
    $country = getcountry();
    $today = date("Y-m-d");
    $mailtosalessubject = "";
    switch ($whitepaperid) {
        case '1':{
            // $myfile = fopen(get_template_directory() . "/txt/livechat_whitepaper_buyersguide.txt", "a") or die("Unable to open file!");
            $requestpage = "https://www.comm100.com/livechat/resources/live-chat-buyers-guide.aspx";
            $mailtosalessubject = "How to Choose the Best Live Chat Software";
            break;
        }
        case '2':{
            // $myfile = fopen(get_template_directory() . "/txt/livechat_whitepaper_dynamiclivechatstrategy.txt", "a") or die("Unable to open file!");
            $requestpage = "https://www.comm100.com/livechat/resources/live-chat-strategy.aspx";
            $mailtosalessubject = "How to Create a Dynamic Live Chat Strategy";
            break;
        }
        case '3':{
            // $myfile = fopen(get_template_directory() . "/txt/livechat_whitepaper_forbetterconversion.txt", "a") or die("Unable to open file!");
            $requestpage = "https://www.comm100.com/livechat/resources/structure-website-conversion.aspx";
            $mailtosalessubject = "How to Structure Your Website for Better Conversion";
            break;
        }
        case '4':{
            // $myfile = fopen(get_template_directory() . "/txt/livechat_whitepaper_maxon.txt", "a") or die("Unable to open file!");
            $requestpage = "https://www.comm100.com/livechat/resources/introducing-maximumon.aspx";
            $mailtosalessubject = "Introducing the Comm100 Live Chat Patent Pending MaximumOn&#8482; Technology";
            break;
        }
        case '5':{
            // $myfile = fopen(get_template_directory() . "/txt/livechat_whitepaper_increase_sales.txt", "a") or die("Unable to open file!");
            $requestpage = "https://www.comm100.com/livechat/resources/live-chat-increase-sales.aspx";
            $mailtosalessubject = "The Top Ten Ways That Live Chat Can Increase Sales";
            break;
        }
        case '6':{
            // $myfile = fopen(get_template_directory() . "/txt/livechat_whitepaper_customerservicescripts.txt", "a") or die("Unable to open file!");
            $requestpage = "https://www.comm100.com/livechat/resources/live-chat-scripts.aspx";
            $mailtosalessubject = "120+ Ready-to-Use Live Chat Scripts for Both Sales and Customer Service";
            break;
        }
        case '7':{
            // $myfile = fopen(get_template_directory() . "/txt/livechat_whitepaper_difficultcustomer.txt", "a") or die("Unable to open file!");
            $requestpage = "https://www.comm100.com/livechat/resources/dealing-with-difficult-customers/";
            $mailtosalessubject = "How to Deal with Difficult Customers over Live Chat";
            break;
        }
        case '8':{
            // $myfile = fopen(get_template_directory() . "/txt/livechat_whitepaper_topperformer.txt", "a") or die("Unable to open file!");
            $requestpage = "https://www.comm100.com/livechat/resources/top-performing-chat-operator-guide/";
            $mailtosalessubject = "The Guide to Becoming a Top Performing Live Chat Agent";
            break;
        }
        case '9':{
            // $myfile = fopen(get_template_directory() . "/txt/livechat_whitepaper_chatvisitreport.txt", "a") or die("Unable to open file!");
            $requestpage = "https://www.comm100.com/livechat/resources/chat-to-visit-ratio-report/";
            $mailtosalessubject = "Chat to Visit Ratio Report";
            break;
        }
        case '10':{
            // $myfile = fopen(get_template_directory() . "/txt/livechat_whitepaper_benchmark.txt", "a") or die("Unable to open file!");
            $requestpage = "https://www.comm100.com/livechat/resources/2016-live-chat-benchmark-report/";
            $mailtosalessubject = "2016 Live Chat Benchmark Report";
            break;
        }
        case '11':{
            // $myfile = fopen(get_template_directory() . "/txt/livechat_whitepaper_salesforceintegration.txt", "a") or die("Unable to open file!");
            $requestpage = "https://www.comm100.com/livechat/resources/salesforce-integration-landing/";
            $mailtosalessubject = "A User Guide to Comm100 Live Chat Salesforce Integration";
            break;
        }
        default:
            break;
    }

    // $txt = $whitepaper_username . "," . $whitepaper_email . "," . $whitepaper_tel . "," . $whitepaper_website . "," . $refererURL . "," . $c_cid . "," .   $landingpage . "," . $requestpage . "," . $country . "," . $today . ";\r\n";
    // fwrite($myfile, $txt);
    // fclose($myfile);

    //send to sales
    $multiple_recipients = array(
        'adel@comm100.com'
    );
    $subject = $whitepaper_username . ' Downloaded ' . $mailtosalessubject;
    $body = '<table style="width: 630px; border: 1px solid #ccc; line-height:30px;" cellpadding="0" cellspacing="0">' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px;font-weight: bold; border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;width:250px; ">Email address:</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' . $whitepaper_email . '</td>' .
                '</tr>' .
                '<tr>' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">Name:</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                       $whitepaper_username .
                    '</td>' .
               '</tr>' .
               '<tr style="border-bottom: 1px solid #ccc;">' .
                   '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">' .
                       "Phone number:" .
                   '</td>' .
                   '<td style="border-bottom: 1px solid #ccc;">' .
                       $whitepaper_tel .
                   '</td>' .
               '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Company:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                        $whitepaper_company .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Referral URL:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                       $refererURL .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Campaign Id:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                        $c_cid .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                        '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc;  border-right: 1px solid #ccc;">' .
                            "Landing Page:" .
                        '</td>' .
                        '<td style="border-bottom: 1px solid #ccc;">' .
                            $landingpage .
                        '</td>' .
                    '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Request Page:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                        $requestpage .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold;  border-right: 1px solid #ccc;">' .
                        "Country:" .
                    '</td>' .
                    '<td >' .
                        $country .
                    '</td>' .
                '</tr>' .
            '</table>';
    $headers[] = 'Cc: anna@comm100.com';
    $headers[] = 'Cc: eve@comm100.com';
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type:text/html;charset=UTF-8";
    wp_mail( $multiple_recipients, $subject, $body, $headers );
    die();
}

function whitepaperTemplate($username, $whitepaper_name, $whitepaper_link, $btn, $whitepaperimg){
    $body_header = '<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">' .
                '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' .
                '<style type="text/css">' .
    '@media screen and (max-width:640px),screen and (max-device-width:640px){' .
        '.responsive-body{' .
            'width: 500px!important;' .
        '}' .
        '.hide-mobile{' .
            'display: none!important' .
        '}' .
        '.show-mobile{' .
            'display: block!important;' .
        '}' .
        '.pl50{' .
            'padding-left: 50px;' .
        '}' .
        '.pr50{' .
            'padding-right: 50px;' .
        '}' .
        '.fz-mobile{' .
            'font-size:18px!important;' .
        '}' .
    '}' .
    '@media screen and (max-width:480px),screen and (max-device-width:480px){' .
        '.responsive-body{' .
            'width: 360px!important;' .
        '}' .
        '.pl20{' .
            'padding-left: 20px!important' .
        '}' .
        '.pr20{' .
            'padding-right: 20px!important' .
        '}' .
        '.pl0{' .
            'padding-left: 0px!important' .
        '}' .
        '.pr0{' .
            'padding-right: 0px!important' .
        '}' .
        '.pl50{' .
            'padding-left: 30px!important;' .
        '}' .
        '.pr50{' .
            'padding-right: 30px!important;' .
        '}' .
    '}' .
    '@media screen and (max-width:360px),screen and (max-device-width:360px){' .
        '.responsive-body{' .
            'width: 320px!important;' .
        '}' .
        '.pl50{' .
            'padding-left: 20px!important;' .
        '}' .
        '.pr50{' .
            'padding-right: 20px!important;' .
        '}' .
    '}' .
'</style>';
    $body = $body_header . '<table align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#F2F2F2" width="100%" style="font-family: &quot;Lucida Grande&quot;,&quot;Lucida Sans Unicode&quot;, Arial,sans-serif;">' .
                '<tbody>' .
                    '<tr>' .
                        '<td style="padding-top: 50px;padding-bottom: 50px">' .
                            '<table align="center" cellspacing="0" cellpadding="0" class="responsive-body" style="width: 600px; margin: 0 auto; color: #000000;font-family:&quot;Lucida Grande&quot;,&quot;Lucida Sans Unicode&quot;, Arial,sans-serif;" bgcolor="#ffffff">' .
                                '<tr>' .
                                    '<td colspan="2" style="padding-top: 40px; padding-left: 50px;padding-right:50px;" class="pl50 pr50">' .
                                        '<table cellpadding="0" cellspacing="0" style="font-family:&quot;Lucida Grande&quot;,&quot;Lucida Sans Unicode&quot;, Arial,sans-serif;">' .
                                        '<tbody>' .
                                            '<tr>' .
                                                '<td align="left" style="background: #FFFFFF; color: #848E95; font-size: 13px;padding-bottom: 30px; ">' .
                                                    '<a href="https://www.comm100.com/" target="_blank" style="text-decoration: none;display:block">' .
                                                        '<img style="outline: none; border: none;" src="https://www.comm100.com/wp-content/themes/comm100/assets/base/img/content/email/comm100-email-logo.png" alt="Comm100" /></a>' .
                                                '</td>' .
                                            '</tr>' .
                                        '</tbody>' .
                                        '</table>' .
                                    '</td>' .
                                '</tr>' .
                                '<tr>' .
                                    '<td style="background: #e4f2f5; padding-left: 50px;" class="pl50 pr50">' .
                                        '<table cellspacing="0" cellpadding="0">' .
                                            '<tr>' .
                                                '<td>' .
                                                    '<table cellspacing="0" cellpadding="0" style="font-family:&quot;Lucida Grande&quot;,&quot;Lucida Sans Unicode&quot;, Arial,sans-serif;">' .
                                                        '<tr>' .
                                                            '<td style="padding-top: 15px; padding-bottom: 15px; font-size: 14px;" class="fz-mobile">' .
                                                                'Dear ' . $username . ',' .
                                                            '</td>' .
                                                        '</tr>' .
                                                        '<tr>' .
                                                            '<td style="padding-bottom: 25px; font-size: 13px; color: #000000;" class="fz-mobile">' .
                                                                'Thanks for your interest in: ' . $whitepaper_name . '!' .
                                                            '</td>' .
                                                        '</tr>' .
                                                        '<tr>' .
                                                             '<td style="padding-bottom: 30px">' .
                                                                '<table cellspacing="0" cellpadding="0" style="font-family:&quot;Lucida Grande&quot;,&quot;Lucida Sans Unicode&quot;, Arial,sans-serif;">' .
                                                                    '<tr>' .
                                                                        '<td style="padding-top:10px; padding-bottom:10px; background:#329FD9;padding-left:32px;padding-right:32px;border-radius:4px;box-shadow: inset 0 1px 0 rgba(0, 0, 0, 0.08), 0 1px 2px rgba(0, 0, 0, 0.2);" class="pl20 pr20">' .
                                                                            '<a href="' . $whitepaper_link . '" style="text-decoration:none; font-size:12px; background:#329FD9; padding-top:10px; padding-bottom:10px;"><font color="#ffffff" class="fz-mobile">' . $btn . '</font></a>' .
                                                                        '</td>' .
                                                                    '</tr>' .
                                                                '</table>' .
                                                            '</td>' .
                                                        '</tr>' .
                                                    '</table>' .
                                                '</td>' .
                                                '<td style="padding-top: 22px; padding-left: 40px;padding-right:20px" class="hide-mobile">' .
                                                    '<img src="' . $whitepaperimg . '" alt="live chat white paper" class="hide-mobile"/>' .
                                                '</td>' .
                                            '</tr>' .
                                        '</table>' .
                                    '</td>' .
                                '</tr>' .
                                '<tr>' .
                                    '<td style="color: #000000; font-size: 13px; padding-top: 40px; padding-left: 50px;padding-right: 50px;" class="pl50 pr50 fz-mobile">' .
                                        'Having effective tools in place is vital to the success of any sales or customer service team.' .
                                    '</td>' .
                                '</tr>' .
                                '<tr>' .
                                    '<td style="color: #000000; font-size: 13px; line-height: 20px; padding-top: 15px;padding-left: 50px; padding-right: 50px;" class="pl50 pr50 fz-mobile">' .
                                        'Comm100\'s <strong>enterprise-grade live chat solution</strong> is used by thousands of organizations from various industries, including HP, Sony, Porsche, Whirlpool Appliances, Sears, Stanford University, Advance Auto Parts, Leviton and many more.' .
                                    '</td>' .
                                '</tr>' .
                                '<tr>' .
                                    '<td style="color: #000000; font-size: 13px; line-height: 20px; padding-top: 15px;padding-left: 50px; padding-right: 50px;" class="pl50 pr50 fz-mobile">' .
                                        'After implementing Comm100, many of our customers noted at least <strong>25% growth in revenue</strong>, and up to <strong>50% reduction in operating and support costs</strong>.' .
                                    '</td>' .
                                '</tr>' .
                                '<tr>' .
                                    '<td style="color: #000000; font-size: 13px; line-height: 20px; padding-top: 15px;padding-left: 50px; padding-right: 50px;" class="pl50 pr50 fz-mobile">' .
                                        'If you\'d like to learn more about how our live chat solution can help your business, please reply to let us know. A product specialist with follow up with you to discuss your unique live chat strategy.' .
                                    '</td>' .
                                '</tr>' .
                                '<tr>' .
                                    '<td style="color: #000000; font-size: 13px; line-height: 20px; padding-top: 15px;padding-left: 50px; padding-right: 50px;padding-bottom:40px" class="pl50 pr50 fz-mobile">' .
                                        'Talk to you soon.' .
                                    '</td>' .
                                '</tr>'.
                                '<tr>' .
                                    '<td align="center" style="text-align: center; color: #9aa1ab; background: #525f66;font-size: 11px; padding-top: 20px;padding-bottom: 20px"  class="pl50 pr50">' .
                                        '<a href="http://www.comm100.com" style="color: #00A6FF; text-decoration: none;" target="_blank">Comm100</a> | 100% Communication, 100% Success <br/>' .
                                        'Email: <a href="mailto:info@comm100.com" style="text-decoration: none;"><font color="9aa1ab">info@comm100.com</font></a> | Web: <a href="http://www.comm100.com" target="_blank" style="text-decoration: none;"><font color="9aa1ab">www.comm100.com</font></a> <br/>' .
                                        'Tel: 1-778-785-0464 (Global) | 1-877-305-0464 (Toll)' .
                                    '</td>' .
                                '</tr>' .
                            '</table>' .
                        '</td>' .
                    '</tr>' .
                '</tbody>' .
            '</table>';
    return $body;
}

add_action('wp_ajax_sendemailtocustomer', __NAMESPACE__.'\\sendemailtocustomer');
add_action('wp_ajax_nopriv_sendemailtocustomer', __NAMESPACE__.'\\sendemailtocustomer');
function sendemailtocustomer(){
    //send to customers
    $customeremail = $_POST['whitepaper_email'];
    $whitepaper_username = $_POST['whitepaper_username'];
    $whitepaperid = $_POST['whitepaperid'];
    $subject = "";
    $body = "";
    // $body_header = ;
    // $body_content = ;
    switch ($whitepaperid) {
        case '1':{
            $subject = "Thank you for downloading: How to Choose the Best Live Chat Software";
            $body = whitepaperTemplate($whitepaper_username, 'How to Choose the Best Live Chat Software: A Buyers Guide', 'http://www.comm100.com/doc/how-to-choose-the-best-live-chat-software-a-buyers-guide.pdf', 'Download the Scripts' , 'https://www.comm100.com/wp-content/themes/comm100/assets/base/img/content/email/buyerguide.png');
            break;
        }

        case '2':{
            $subject = "Thank you for downloading: How to Create a Dynamic Live Chat Strategy";
            $body = whitepaperTemplate($whitepaper_username, 'How to Create a Dynamic Live Chat Strategy', 'http://www.comm100.com/doc/comm100-how-to-create-a-dynamic-live-chat-strategy.pdf', 'Download White Paper' , 'https://www.comm100.com/wp-content/themes/comm100/assets/base/img/content/email/email-how-to-create-a-dynamic-live-chat-strategy.png');
            break;
        }
        case '3':{
            $subject = "Thank you for downloading: How to Structure Your Website for Better Conversion";
            $body = whitepaperTemplate($whitepaper_username, 'How to Structure Your Website for Better Conversion', 'https://www.comm100.com/doc/comm100-how-to-structure-your-website-for-better-conversion.pdf', 'Download White Paper' , 'https://www.comm100.com/wp-content/themes/comm100/assets/base/img/content/email/email-how-to-structure-your-website-for-better-conversion.png');
            break;
        }
        case '4':{
            $subject = "Thank you for downloading: Introducing the Comm100 Live Chat Patent Pending MaximumOn&#8482; Technology";
            $body = whitepaperTemplate($whitepaper_username, 'Bringing High Availability to a New Level', 'http://www.comm100.com/doc/Comm100-MaximumOn-Whitepaper.pdf', 'Download White Paper' , 'https://www.comm100.com/wp-content/themes/comm100/assets/base/img/content/email/email-maximumon-whitepaper.png');
            break;
        }
        case '5':{
            $subject = "Thank you for downloading: Chat Your Way to Higher Revenue";
            $body = whitepaperTemplate($whitepaper_username, 'Chat Your Way to Higher Revenue', 'https://www.comm100.com/doc/comm100-chat-your-way-to-higher-revenue.pdf', 'Download White Paper' , 'https://www.comm100.com/wp-content/themes/comm100/assets/base/img/content/email/email_increase_sales.png');
            break;
        }
        case '6':{
            $subject = "Thank you for downloading: 120+ Ready-to-Use Live Chat Scripts for Both Sales and Customer Service";
            $body = whitepaperTemplate($whitepaper_username, '120+ Ready-to-Use Live Chat Scripts for Both Sales and Customer Service', 'https://www.comm100.com/doc/comm100-live-chat-scripts-to-make-stellar-agents.pdf', 'Download the Scripts' , 'https://www.comm100.com/wp-content/themes/comm100/assets/base/img/content/email/email_live_chat_scripts.png');
            break;
        }
        case '7':{
            $subject = "Thank you for downloading: How to Deal with Difficult Customers over Live Chat!";
            $body = whitepaperTemplate($whitepaper_username, 'How to Deal with Difficult Customers over Live Chat', 'https://www.comm100.com/doc/how-to-deal-with-difficult-customers-over-live-chat.pdf', 'Download It Now' , 'https://www.comm100.com/wp-content/uploads/images/whitepaper-difficult-customer-email.png');
            break;
        }
        case '8':{
            $subject = "Thank you for downloading: The Guide to Becoming a Top Performing Live Chat Agent";
            $body = whitepaperTemplate($whitepaper_username, 'The Guide to Becoming a Top Performing Live Chat Agent', 'https://www.comm100.com/doc/comm100-the-guide-to-becoming-a-top-performing-live-chat-operator.pdf', 'Download It Now' , 'https://www.comm100.com/wp-content/uploads/images/whitepaper-top-performer-email.png');
            break;
        }
        case '9':{
            $subject = "Thank you for downloading: Chat to Visit Ratio Report";
            $body = whitepaperTemplate($whitepaper_username, 'Chat to Visit Ratio Report: Help Forecast Your Potential Chat Volume', 'http://www.comm100.com/doc/how-to-choose-the-best-live-chat-software-a-buyers-guide.pdf', 'Download It Now' , 'https://www.comm100.com/wp-content/uploads/images/whitepaper-report-email.png');
            break;
        }
        case '10':{
            $subject = "Thank you for downloading: 2016 Live Chat Benchmark Report";
            $body = whitepaperTemplate($whitepaper_username, '2016 Live Chat Benchmark Report: Help Measure Your Live Chat Success', 'https://www.comm100.com/doc/comm100-2016-live-chat-benchmark-report.pdf', 'Download It Now' , 'https://www.comm100.com/wp-content/uploads/images/whitepaper-benchmark-email.png');
            break;
        }
        case '11':{
            $subject = "Thank you for downloading: A User Guide to Comm100 Live Chat Salesforce Integration";
            $body = whitepaperTemplate($whitepaper_username, 'A User Guide to Comm100 Live Chat Salesforce Integration', 'https://www.comm100.com/doc/comm100-live-chat-salesforce-integration.pdf', 'Download It Now' , 'https://www.comm100.com/wp-content/uploads/images/whitepaper-salesforce-integration-email.png');
            break;
        }
        default:
        break;
    }
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Reply-To: Comm100 <sales@comm100.com>";
    $headers[] = "Content-type:text/html;charset=UTF-8";
    wp_mail( $customeremail, $subject, $body, $headers );
    die();
}

add_action('wp_ajax_requestcallback_action', __NAMESPACE__.'\\requestcallback');
add_action('wp_ajax_nopriv_requestcallback_action', __NAMESPACE__.'\\requestcallback');
function requestcallback(){
    $requesttype = $_POST['requesttype'];
    $requestpage = $_POST['requestpage'];
    $requestcallback_name = $_POST['requestcallback_name'];
    $requestcallback_email = $_POST['requestcallback_email'];
    $requestcallback_tel = $_POST['requestcallback_tel'];
    $requestcallback_company = $_POST['requestcallback_company'];
    $requestcallback_title = $_POST['requestcallback_title'];
    $requestcallback_operators = $_POST['requestcallback_operators'];
    $requestcallback_comments = $_POST['requestcallback_comments'];
    $refererURL = $_COOKIE['R_url'];
    $c_cid = $_COOKIE['C_cId'];
    $landingpage = $_COOKIE['landingUrl1'];
    $country = getcountry();
    $today = date("Y-m-d");


    //send to sales
    $multiple_recipients = array();
    $subject = "";
    switch (strtolower($requesttype)) {
        case 'selfhosted':
            {
                $subject = "Self-hosted: Demo Request from " . $requestcallback_name . ", " . $requestcallback_company;
                $multiple_recipients = array(
                    'rob@comm100.com',
                    'mellisa@comm100.com',
                    'jeff@comm100.com',
                    'tony@comm100.com'
                );
                break;
            }
        default:
            {
                $subject = "Live Chat: Demo Request from " . $requestcallback_name . ", " . $requestcallback_company;
                $multiple_recipients = array(
                    'sales@comm100.com',
                    'rob@comm100.com',
                    'mellisa@comm100.com',
                    'jeff@comm100.com',
                    'tony@comm100.com'
                );
                break;
            }
    }

    $body = '<table style="width: 630px; border: 1px solid #ccc; line-height:30px;" cellpadding="0" cellspacing="0">' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px;font-weight: bold; border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;width:250px; ">Email address:</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' . $requestcallback_email . '</td>' .
                '</tr>' .
                '<tr>' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">Name:</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                       $requestcallback_name .
                    '</td>' .
               '</tr>' .
               '<tr style="border-bottom: 1px solid #ccc;">' .
                   '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">' .
                       "Phone number:" .
                   '</td>' .
                   '<td style="border-bottom: 1px solid #ccc;">' .
                       $requestcallback_tel .
                   '</td>' .
               '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Company:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                        $requestcallback_company .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Job Title:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                        $requestcallback_title .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Number of Operators:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                        $requestcallback_operators .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Comments/Special Requests:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                        $requestcallback_comments .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Referral URL:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                       $refererURL .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Campaign Id:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                        $c_cid .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                        '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc;  border-right: 1px solid #ccc;">' .
                            "Landing Page:" .
                        '</td>' .
                        '<td style="border-bottom: 1px solid #ccc;">' .
                            $landingpage .
                        '</td>' .
                    '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Request Page:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                        $requestpage .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold;  border-right: 1px solid #ccc;">' .
                        "Country:" .
                    '</td>' .
                    '<td >' .
                        $country .
                    '</td>' .
                '</tr>' .
            '</table>';
    $headers[] = 'Cc: kevin.gao@comm100.com';
    $headers[] = 'Cc: anna@comm100.com';
    $headers[] = 'Cc: eve@comm100.com';
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type:text/html;charset=UTF-8";
    wp_mail( $multiple_recipients, $subject, $body, $headers );
    die();
}

//dedicated request callback
add_action('wp_ajax_dedicatedrequestcallback_action', __NAMESPACE__.'\\dedicatedrequestcallback');
add_action('wp_ajax_nopriv_dedicatedrequestcallback_action', __NAMESPACE__.'\\dedicatedrequestcallback');
function dedicatedrequestcallback(){
    $requestpage = $_POST['requestpage'];
    $requestcallback_name = $_POST['requestcallback_name'];
    $requestcallback_email = $_POST['requestcallback_email'];
    $requestcallback_tel = $_POST['requestcallback_tel'];
    $requestcallback_company = $_POST['requestcallback_company'];
    $requestcallback_title = $_POST['requestcallback_title'];
    $requestcallback_operators = $_POST['requestcallback_operators'];
    $requestcallback_comments = $_POST['requestcallback_comments'];
    $refererURL = $_COOKIE['R_url'];
    $c_cid = $_COOKIE['C_cId'];
    $landingpage = $_COOKIE['landingUrl1'];
    $country = getcountry();
    $today = date("Y-m-d");

    $myfile = fopen(get_template_directory() . "/txt/dedicated-form.txt", "a") or die("Unable to open file!");
    $txt = $requestcallback_name . "," . $requestcallback_email . "," . $requestcallback_tel . "," . $requestcallback_company . "," . $requestcallback_title . "," . $requestcallback_operators . "," . $requestcallback_comments . "," . $refererURL . "," . $c_cid . "," .   $landingpage . "," . $requestpage . "," . $country . "," . $today . ";\r\n";
    fwrite($myfile, $txt);
    fclose($myfile);

    //send to sales
    $multiple_recipients = array(
        'rob@comm100.com',
        'mellisa@comm100.com'
    );
    $subject = "Dedicated: Callback Request from " . $requestcallback_name . ", " . $requestcallback_company;


    $body = '<table style="width: 630px; border: 1px solid #ccc; line-height:30px;" cellpadding="0" cellspacing="0">' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px;font-weight: bold; border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;width:250px; ">Email address:</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' . $requestcallback_email . '</td>' .
                '</tr>' .
                '<tr>' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">Name:</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                       $requestcallback_name .
                    '</td>' .
               '</tr>' .
               '<tr style="border-bottom: 1px solid #ccc;">' .
                   '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">' .
                       "Phone number:" .
                   '</td>' .
                   '<td style="border-bottom: 1px solid #ccc;">' .
                       $requestcallback_tel .
                   '</td>' .
               '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Company:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                        $requestcallback_company .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Job Title:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                        $requestcallback_title .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Number of Operators:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                        $requestcallback_operators .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Comments/Special Requests:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                        $requestcallback_comments .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Referral URL:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                       $refererURL .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Campaign Id:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                        $c_cid .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                        '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc;  border-right: 1px solid #ccc;">' .
                            "Landing Page:" .
                        '</td>' .
                        '<td style="border-bottom: 1px solid #ccc;">' .
                            $landingpage .
                        '</td>' .
                    '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">' .
                        "Request Page:" .
                    '</td>' .
                    '<td style="border-bottom: 1px solid #ccc;">' .
                        $requestpage .
                    '</td>' .
                '</tr>' .
                '<tr style="border-bottom: 1px solid #ccc;">' .
                    '<td align="right" style="padding-right:10px; font-weight: bold;  border-right: 1px solid #ccc;">' .
                        "Country:" .
                    '</td>' .
                    '<td >' .
                        $country .
                    '</td>' .
                '</tr>' .
            '</table>';
    $headers[] = 'Cc: kevin.gao@comm100.com';
    $headers[] = 'Cc: anna@comm100.com';
    $headers[] = 'Cc: eve@comm100.com';
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type:text/html;charset=UTF-8";
    wp_mail( $multiple_recipients, $subject, $body, $headers );
    die();
}
