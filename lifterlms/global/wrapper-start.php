<?php
/**
 * Content Wrapper: Start
 *
 * @package LifterLMS/Templates
 *
 * @since Unknown
 * @version Unknown
 */

defined( 'ABSPATH' ) || exit;

$template = get_option( 'template' );

switch ( $template ) {

	case 'twentyeleven':
		echo '<div id="primary"><div id="content" role="main" class="twentyeleven">';
		break;

	case 'twentytwelve':
		echo '<div id="primary" class="site-content"><div id="content" role="main" class="twentytwelve">';
		break;

	case 'twentythirteen':
		echo '<div id="primary" class="site-content"><div id="content" role="main" class="entry-content twentythirteen">';
		break;

	case 'twentyfourteen':
		echo '<div id="primary" class="content-area"><div id="content" role="main" class="site-content twentyfourteen"><div class="tfwc">';
		break;

	case 'twentyfifteen':
		echo '<div id="primary" role="main" class="content-area twentyfifteen"><div id="main" class="site-main t15wc">';
		break;

	case 'twentysixteen':
		echo '<div id="primary" class="content-area twentysixteen"><main id="main" class="site-main" role="main">';
		break;

	case 'twentyseventeen':
		echo '<div class="wrap">';
		break;

	default:
		echo '<div class="c-layout-page c-layout-page-fixed"><div class="c-content-box c-size-md"><div class="container"><div class="row">';
		break;

}
