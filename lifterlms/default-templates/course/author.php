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
                                                About <a href="<?php echo $archive_link; ?>">
                                                    <?php echo $coauthor->display_name; ?>
                                                </a>
                                            </h4>
                                            <p><?php echo $coauthor->description; ?></p>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                                <!-- end author -->


<section class="llms-instructor-info">
	<h3 class="llms-meta-title"><?php echo _n( 'Course Instructor', 'Course Instructors', count( $instructors ), 'lifterlms' ); ?></h3>
	<div class="llms-instructors llms-cols">
		<?php foreach ( $instructors as $instructor ) : ?>
			<div class="llms-col-<?php echo $count <= 4 ? $count : 4; ?>">
				<?php
				echo llms_get_author(
					array(
						'avatar_size' => 100,
						'bio'         => true,
						'label'       => $instructor['label'],
						'user_id'     => $instructor['id'],
					)
				);
				?>
			</div>
		<?php endforeach; ?>
	</div>
</section>
