<?php
if ($post):
    $postID = $post->ID;

    $contentBlocks = get_field('modules', $postID);
    $blockCount = 1;

    if ($contentBlocks):
        foreach ($contentBlocks as $block):
            if (file_exists(dirname(__FILE__).'/content-blocks/'.$block['acf_fc_layout'].'.php')):
                $sectionStyles = '';
                $sectionClass = 'section-'.$block['acf_fc_layout'].' block-'.$blockCount;

                // if (array_key_exists('background_image', $block) && $block['background_image']):
                // endif;

                $sectionID = 'block-'.$blockCount;

                if (array_key_exists('section_title', $block) && $block['section_title']):
                    $sectionID = 'block-'.sanitize_title($block['section_title']);
                endif;
                ?>
                <section id="<?= $sectionID; ?>" class="content-section <?= $sectionClass; ?>" <?= $sectionStyles; ?>>
                    <?php
                        include('content-blocks/'.$block['acf_fc_layout'].'.php');
                    ?>
                </section>
                <?php
                $blockCount++;
            endif;
        endforeach;
    endif;
endif;
?>
