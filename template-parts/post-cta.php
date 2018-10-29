<?php
use Roots\Sage\Extras;
use Roots\Sage\Assets;

// This template part expects a Blog Post CTA Advanced Custom Fields Repeater object to be passed as a query var.
$tileStyle = '';
$tileClass = 'image-inline';

if ($cta['image_style'] == 'background'):
    $tileClass = 'with-background';
    $tileStyles = ' background: transparent url('.$cta['image']['url'].') no-repeat center center; background-size: cover; ';
endif;
?>
        <div class="c-content-blog-post-card-1 c-post-cta c-option-2 <?= $tileClass; ?>" style="<?= $tileStyles; ?>">
            <div class="c-body">
                <?php if ($cta['image_style'] == 'inline'): ?>
                    <a href="<?= $cta['link']['url']; ?>" target="<?= $cta['link']['target']; ?>"><?= Assets\get_acf_image($cta['image']); ?></a>
                <?php endif; ?>
                <div class="c-tag">
                    <?= $cta['tag']; ?>
                </div>
                <div class="c-author">
                    <span>
                        <?php
                        if (isset($cta['subtitle'])):
                            echo $cta['subtitle'];
                        endif;
                        ?>
                    </span>
                </div>
                <div class="c-title c-font-bold">
                    <?= $cta['title']; ?>
                </div>
                <?php
                $linkClass = 'c-redirectLink';

                switch ($cta['link_type']):
                    case 'green' :
                        $linkClass = 'btn btn-xlg btn-link--green';
                        break;
                    case 'blue' :
                        $linkClass = 'btn btn-xlg c-theme-btn';
                        break;
                    case 'white' :
                        $linkClass = 'btn btn-xlg c-btn-border-2x c-theme-btn';
                        break;
                    default: break;
                endswitch;
                ?>
                <div class="resource-item-CTA-link">
                    <a class="<?= $linkClass; ?>" href="<?= $cta['link']['url']; ?>" target="<?= $cta['link']['target']; ?>"><?= $cta['link']['title']; ?></a>
                </div>
            </div>
        </div>