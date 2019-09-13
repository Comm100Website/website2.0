<?php
use Roots\Sage\Assets;
?>
    <div class="c-layout-page c-layout-page-fixed primary-page">
        <div class="c-content-box c-size-md">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="resource-list post-tiles clearfix">
                        <?php
                        $postIndex = 0;

                        foreach ($block['videos'] as $video):
                        ?>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="resource-item">
                                    <a href="https://www.youtube.com/embed/<?= $video['youtube_video_id']; ?>?autoplay=1" class="fancybox fancybox.iframe" data-fancybox-type="iframe" data-lightbox='fancybox'>
                                        <img src="<?= $video['thumbnail']['url']; ?>" alt="<?= $video['thumbnail']['alt']; ?>" />
                                        <div class="resource-item--tag"><?= $video['category']; ?></div>
                                        <h5 class="resource-item--title"><?= $video['title']; ?></h5>
                                        <div class="resource-item--category"><?= $video['description']; ?></div>
                                        <br/>
                                    </a>
                                </div>
                            </div>

                            <?php
                            if ($postIndex == 4):
                            ?>
                                <div class="resource-item col-xs-12 col-sm-6 col-md-4">
                                    <div class="CTA">
                                        <?= Assets\get_acf_image($block['resource_promo']['icon'], '', 120, 120); ?>
                                        <div class="resource-item--title"><?= $block['resource_promo']['title']; ?></div>
                                        <?php
                                        echo $block['resource_promo']['description'];

                                        $linkClass = 'c-redirectLink';
                                        ?>
                                        <div class="resource-item-CTA-link">
                                            <a class="<?= $linkClass; ?>" href="<?= $block['resource_promo']['cta']['url']; ?>" target="<?= $block['resource_promo']['cta']['target']; ?>"><?= $block['resource_promo']['cta']['title']; ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endif;

                            $postIndex++;
                        endforeach;
                        ?>
                        </div>
                        <?php
                        the_posts_pagination([
                            'mid_size'  => 2,
                            'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'textdomain' ),
                            'next_text' => __( '<i class="fa fa-angle-right"></i>', 'textdomain' ),
                            'screen_reader_text' => ''
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>