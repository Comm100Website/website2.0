<?php
/**
 * LifterLMS Course Author Info
 *
 * @since   3.0.0
 * @version 3.25.0
 */

defined( 'ABSPATH' ) || exit;

$course = llms_get_post( get_the_ID() );
if ( ! $course ) {
	return '';
}
$instructors = $course->get_instructors( true );
if ( ! $instructors ) {
	return '';
}
$count = count( $instructors );
?>
<br/>
<hr/>
<!-- begin author -->
<?php
$coauthors = get_coauthors();
foreach( $coauthors as $coauthor ):
	$archive_link = get_author_posts_url( $coauthor->ID, $coauthor->user_nicename );
	// $userdata = get_userdata( $coauthor->ID );
?>
	<div class="authorsure-author-box clearfix">
		<div class="author-thumb"><?php echo get_avatar( $coauthor, 100 ); ?></div>
		<div class="author-details">
			<h4>
				Instructor <?php echo $coauthor->display_name; ?>
			</h4>
			<p style="padding-left: 0;"><?php echo $coauthor->description; ?></p>
		</div>
	</div>
<?php
endforeach;
?>
<!-- end author -->
