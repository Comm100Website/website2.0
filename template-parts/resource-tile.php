<?php
use Roots\Sage\Extras;
use Roots\Sage\Assets;
?>
<div class="resource-item">
    <a href="<?= get_permalink(); ?>">
        <?php
        if (has_post_thumbnail()):
            echo Assets\get_lazy_load_post_thumbnail($post->ID, get_the_title(), 'full');
        endif;

        $title = get_the_title();

        if (get_field('short_title')):
            $title = get_field('short_title');
        endif;
        ?>

        <div class="resource-item--tag"><?= Extras\get_post_taxonomy('commresourcecat', $post->ID)->name; ?></div>
        <div class="resource-item--category"><?= Extras\get_post_taxonomy_more('commresourcetag', $post->ID)->name; ?></div>
        <h5 class="resource-item--title"><?= $title; ?></h5>

        <?php
        if (get_field('sub_title')):
            echo '<div class="resource-item--subTitle">' . get_field('sub_title') . '</div>';
        endif;
        ?>
    </a>
</div>
