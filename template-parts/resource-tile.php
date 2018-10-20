<?php
use Roots\Sage\Extras;
?>
<div class="resource-item">
    <a href="<?= get_permalink(); ?>">
        <?php
        if (has_post_thumbnail()):
            echo '<img src="' . get_the_post_thumbnail_url($post->ID, 'full') . '" alt="' . get_the_title() . '" width="" height="" />';
        endif;
        ?>

        <div class="resource-item--tag"><?= Extras\get_post_taxonomy('commresourcecat')->name; ?></div>
        <div class="resource-item--category"><?= Extras\get_post_taxonomy('commresourcetag')->name; ?></div>
        <h5 class="resource-item--title"><?= get_the_title(); ?></h5>

        <?php
        if (get_field('sub_title')):
            echo '<div class="resource-item--subTitle">' . get_field('sub_title') . '</div>';
        endif;
        ?>
    </a>
</div>
