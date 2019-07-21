<div class="container-fluid">
    <div class="row d-flex">
        <div class="col-12 col-sm-6 d-flex justify-content-end">
            <div class="col-inner">
            <?php
                echo '<h1 class="title-tagline">'.$block['form_tagline'].'</h1>';
                echo '<h2 class="section-title">'.$block['section_title'].'</h2>';
                echo $block['form_code'];
                ?>
            </div>
        </div>
        <?php
        $socialStyle = '';
        $socialCSSClass = '';

        if (array_key_exists('social_bg', $block) && $block['social_bg']) {
            $colStyle = 'style="background: transparent url('.$block['social_bg'].') no-repeat top center; background-size: cover;"';
            $socialCSSClass = 'text-light';
        }
        ?>
        <div class="col-12 col-sm-6 hidden-xs d-flex align-items-end <?= $socialCSSClass; ?>" <?= $colStyle ?>>
            <div class="col-inner">
            <?php
                if (array_key_exists('testimonials', $block) && $block['testimonials']) {
                    echo '<div class="quote-carousel" data-slider="owl" data-items="1" data-desktop-items="1" data-desktop-small-items="1" data-tablet-items="1" data-mobile-small-items="1" data-auto-play="5000">';
                    echo '<div class="owl-carousel owl-theme">';

                    foreach ($block['testimonials'] as $testimonial) {
                        echo '<div class="item">';
                        echo '<div class="quote">&rdquo;'.$testimonial['quote'].'&ldquo;</div>';
                        echo '<div class="author"><strong>- '.$testimonial['author'].'</strong></div>';
                        echo '</div>';
                    }

                    echo '</div></div>';
                }
                ?>

                <?php
                if (array_key_exists('client_title', $block) && $block['client_title']) {
                    echo '<p><strong>'.$block['client_title'].'</strong></p>';
                }

                if (array_key_exists('client_logos', $block) && $block['client_logos']) {
                    echo '<div class="logo-pond d-flex flex-wrap">';

                    foreach ($block['client_logos'] as $logo) {
                        echo '<div class="logo"><img src="'.$logo['url'].'" alt="'.$logo['alt'].'" /></div>';
                    }

                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>