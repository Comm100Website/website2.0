<?php
/**
 * Generic loop template
 *
 * Utilized by both courses and memberships.
 *
 * @package     LifterLMS/Templates
 *
 * @since       1.0.0
 * @version     3.14.0
 */

defined( 'ABSPATH' ) || exit;
?>

<?php get_header( 'llms_loop' ); ?>
<div class="c-layout-page c-layout-page-fixed primary-page">
<div class="c-content-box">
<div class="container header">

<?php do_action( 'lifterlms_before_main_content' ); ?>

<?php if ( apply_filters( 'lifterlms_show_page_title', true ) ) : ?>

	<h1 class="page-title"><?php lifterlms_page_title(); ?></h1>

<?php endif; ?>

<?php do_action( 'lifterlms_archive_description' ); ?>

<?php
	/**
	 * Hook: lifterlms_loop
	 *
	 * @hooked lifterlms_loop - 10
	 */
	do_action( 'lifterlms_loop' );
?>

<?php do_action( 'lifterlms_after_main_content' ); ?>

<?php //do_action( 'lifterlms_sidebar' ); ?>
</div>
</div>
</div>
<?php get_footer(); ?>