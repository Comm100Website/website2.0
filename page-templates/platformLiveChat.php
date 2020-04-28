<?php
/*
Template Name:Platform Live Chat
*/
?>
<?php get_template_part('template-parts/header'); ?>
<div class="c-navbar--secondary visible-md">
        <div class="container">
            <?php
            $defaults = array(
                'theme_location'  => 'platformLiveChat',
                'menu'            => '',
                'container'       => 'nav',
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => 'clearfix',
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'           => 0,
                'walker'          => ''
                );
                wp_nav_menu( $defaults );
            ?>
        </div>
    </div>
</header>

<div class="c-layout-page c-layout-page-fixed secondary-page">


    <?php
        // check if the flexible content field has rows of data
        if( have_rows('modules') ):

            // loop through the rows of data
        while ( have_rows('modules') ) : the_row();
            if( get_row_layout() == 'hero_banner' ):
                $banner_size = get_sub_field('size');
                $banner_align = get_sub_field('align');
                $banner_icon = get_sub_field('icon');
                // $page_tag = get_sub_field('page_tag');
                $banner_headline = get_sub_field('h1_title');
                $banner_slogan = get_sub_field('subtitle');
                $banner_description = get_sub_field('description');
                $banner_background_image = get_sub_field('background_image');
                $style_bg = '';
                if ($banner_background_image):
                    $style_bg = 'style="background-image: url(' . $banner_background_image['url'] . ')"';
                endif;
                $banner_cta = get_sub_field('cta');

                echo '<div class="c-content-box c-size-lg banner banner--' . $banner_size . ' banner--' . $banner_align . '"'  . $style_bg . '>';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-sm-7">';

                if ($banner_icon):
                    echo '<div class="banner_icon">' .
                            '<img src="' . $banner_icon['url'] . '" alt="' . $banner_icon['alt'] . '" width="64" height="64" />' .
                        '</div>';
                endif;
                if ($banner_headline):
                    echo '<h1>' .
                            $banner_headline .
                        '</h1>';
                endif;
                if ($banner_slogan):
                    echo '<p class="subtitle">' .
                            $banner_slogan .
                        '</p>';
                endif;
                if ($banner_description):
                    echo '<div class="desc">' .
                            $banner_description .
                        '</div>';
                endif;

                if ($banner_cta):

                    while ( have_rows('cta') ) : the_row();
                        $cta_link_type = get_sub_field('cta_link_type');
                        $cta_link = get_sub_field('cta_link');
                        if ($cta_link):
                            switch ($cta_link_type) {
                                case 'green' :
                                        echo '<a class="banner_cta_link btn btn-xlg btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'blue' :
                                        echo '<a class="banner_cta_link btn btn-xlg c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'white' :
                                        echo '<a class="banner_cta_link btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'link' :
                                        echo '<a class="banner_cta_link" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                default: break;
                            }
                        endif;
                    endwhile;


                endif;
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            endif;
                // check current row layout
            if( get_row_layout() == 'hero_head' ):

                $header_align = get_sub_field('align');
                $header_icon = get_sub_field('icon');
                // $page_tag = get_sub_field('page_tag');
                $header_headline = get_sub_field('h1_title');
                $header_slogan = get_sub_field('subtitle');
                $header_description = get_sub_field('description');
                $header_cta = get_sub_field('cta');

                echo '<div class="c-content-box c-size-md">';
                echo '<div class="container header header--' . $header_align . '">';
                echo '<div class="row">';
                echo '<div class="col-sm-12">';

                if ($header_icon):
                    echo '<div class="header_icon">' .
                            '<img src="' . $header_icon['url'] . '" alt="' . $header_icon['alt'] . '" width="64" height="64" />' .
                        '</div>';
                endif;
                if ($header_headline):
                    echo '<h1>' .
                            $header_headline .
                        '</h1>';
                endif;
                if ($header_slogan):
                    echo '<p class="subtitle">' .
                            $header_slogan .
                        '</p>';
                endif;
                if ($header_description):
                    echo '<div class="desc">' .
                            $header_description .
                        '</div>';
                endif;

                if ($header_cta):

                    while ( have_rows('cta') ) : the_row();
                        $cta_link_type = get_sub_field('cta_link_type');
                        $cta_link = get_sub_field('cta_link');
                        if ($cta_link):
                            switch ($cta_link_type) {
                                case 'green' :
                                        echo '<a class="header_cta_link btn btn-xlg btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'blue' :
                                        echo '<a class="header_cta_link btn btn-xlg c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'white' :
                                        echo '<a class="header_cta_link btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'link' :
                                        echo '<a class="header_cta_link" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                default: break;
                            }
                        endif;
                    endwhile;


                endif;
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            endif;

            // check current row layout
            if( get_row_layout() == 'feature_header' ):



                echo '<div class="c-content-box c-size-md">';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-sm-12 feature__header">';

                $feature_header = get_sub_field('feature_header');
                if ($feature_header):
                    while ( have_rows('feature_header') ) : the_row();
                        $h1_tag = get_sub_field('h1_tag');
                        $h1 = get_sub_field('h1');
                        $description = get_sub_field('description');
                        $download = get_sub_field('download');
                        $image = get_sub_field('image');
                        $video = get_sub_field('video');
                            if ($h1_tag):
                                echo '<div class="h1-tag">' .
                                        $h1_tag .
                                    '</div>';
                            endif;
                            if ($h1):
                                echo '<h1>' .
                                        $h1 .
                                    '</h1>';
                            endif;

                            if ($description):
                                echo $description;
                            endif;
                            if ($download):
                                while ( have_rows('download') ) : the_row();
                                    $installuninstall = get_sub_field('installuninstall');
                                    if (have_rows('download_content')):
                                        echo '<div class="download">';
                                        while ( have_rows('download_content') ) : the_row();
                                            $download_link = get_sub_field('download_link');
                                            $download_img = get_sub_field('download_img');

                                            if (!$download_img) {
                                                echo '<a class="btn btn-xlg c-btn-border-2x c-theme-btn c-margin-l-60" href="' . $download_link['url'] . '" target="' . $download_link['target'] . '">' . $download_link['title'] . '</a>';
                                            } else {
                                                echo '<a href="' . $download_link['url'] . '" target="' . $download_link['target'] . '">' .
                                                        '<img src="' . $download_img['url'] . '" alt="' . $download_img['alt'] . '" width="160" height="56">' .
                                                    '</a>';
                                            }
                                        endwhile;
                                        echo '<div class="c-margin-t-10 c-font-14">' .
                                                    '<a href="/eula/" target="_blank">EULA</a> | ' .
                                                    '<a href="' . $installuninstall['url'] . '" target="' . $installuninstall['target'] . '">' .
                                                            $installuninstall['title'] .
                                                        '</a>' .
                                                '</div>';
                                        echo '</div>';
                                    endif;
                                endwhile;
                            endif;
                            if ($image):
                                echo '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" />';
                            endif;
                            if ($video):
                                echo '<div class="row video-content">' .
                                        '<div class="col-sm-10 col-sm-push-1">' .
                                            $video .
                                        '</div>' .
                                    '</div>';
                            endif;
                    endwhile;
                endif;

                $normal_content = get_sub_field('normal_content');
                if ($normal_content):
                    while ( have_rows('normal_content') ) : the_row();
                        $header_headline = get_sub_field('h1_title');
                        $header_slogan = get_sub_field('subtitle');
                        $header_description = get_sub_field('description');
                        $call_to_action = get_sub_field('call_to_action');
                        echo '<div id="notInServiceCountry" class="thankyou" style="display: none">';
                            if ($header_headline):
                                echo '<h1>' .
                                        $header_headline .
                                    '</h1>';
                            endif;
                            if ($header_slogan):
                                echo '<h2>' .
                                        $header_slogan .
                                    '</h2>';
                            endif;
                            if ($header_description):
                                echo '<div class="thankyou__desc">' .
                                        $header_description .
                                    '</div>';
                            endif;

                            if ($call_to_action):
                                echo '<div class="thankyou__calltoaction">' .
                                        '<a class="btn btn-xlg btn-link--green" href="' . $call_to_action['url'] . '" target="' . $call_to_action['target'] . '">' .
                                            $call_to_action['title'] .
                                        '</a>';
                                    '</div>';
                            endif;
                        echo '</div>';
                    endwhile;
                endif;



                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            endif;

            // check current row layout
            if( get_row_layout() == '2-column_for_feature_left_image' ):
                $rows = get_sub_field('repeater_feature');
                $row_count = count($rows);
                echo '<div class="c-content-box">';
                echo '<div class="container">';
                echo '<div class="row">';
                foreach ($rows as $row) {
                    $featureImage = $row['feature_image'];
                    $featureDescription = $row['feature_description'];
                    echo '<div class="col-sm-' . strval(12/$row_count) . '">' .
                        '<div class="c-content-feature-2 c-option-2 c-theme-bg-parent-hover">' .
                            '<div class="c-icon-wrapper">' .
                                '<span aria-hidden="true">' .
                                    '<img src="' . $featureImage['url'] . '" alt="' . $featureImage['alt'] . '" width="50" height="50">' .
                                '</span>' .
                            '</div>' .
                            '<p>' . $featureDescription . '</p>' .
                        '</div>' .
                    '</div>';
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';
            endif;

            // check current row layout
            if( get_row_layout() == 'card' ):
                $rows = get_sub_field('cards');
                $row_count = count($rows);

                // check if the nested repeater field has rows of data
                if( have_rows('cards') ):
                    echo '<div class="c-content-box">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12 card card-col-' . $row_count . '">';

                        // loop through the rows of data
                    while ( have_rows('cards') ) : the_row();

                        $card_themecolor = get_sub_field('color');
                        $card_img = get_sub_field('icon');
                        $card_title = get_sub_field('title');
                        $card_subtitle = get_sub_field('subtitle');
                        $card_description = get_sub_field('description');
                        $cta = get_sub_field('cta');
                        $linkcontent='';
                        if ($cta):

                            while ( have_rows('cta') ) : the_row();
                                $cta_link_type = get_sub_field('cta_link_type');
                                $cta_link = get_sub_field('cta_link');
                                if ($cta_link):
                                    switch ($cta_link_type) {
                                        case 'green' :
                                                $linkcontent = '<a class="btn btn-xlg btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        case 'blue' :
                                                $linkcontent = '<a class="btn btn-xlg c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        case 'white' :
                                                $linkcontent = '<a class="btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        case 'link' :
                                                $linkcontent = '<a class="c-redirectLink" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        default: break;
                                    }
                                endif;
                            endwhile;


                        endif;

                        echo    '<div class="card-item card-item--' . $card_themecolor . '" data-link="' . $cta_link['url'] . '">' .
                                    '<div><img src="' . $card_img['url'] . '" alt="' . $card_img['alt'] . '" width="105" height="105" /></div>' .
                                    '<h3 class="highlight highlight--' . $card_themecolor . '">' . $card_title . '</h3>' .
                                    '<div class="card-item__subtitle">' . $card_subtitle . '</div>' .
                                    $card_description .
                                    '<div class="card-item__link">' . $linkcontent . '</div>' .
                                '</div>';
                    endwhile;

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;

            endif;

            // check current row layout
            // if( get_row_layout() == 'paragraph' ):
            //     $paragraph_item = get_sub_field('paragraph_item');
            //     $paragraph_itemClass = get_sub_field('paragraph_item')['paragraph_class'];
            //     $paragraph_itemText = get_sub_field('paragraph_item')['paragraph_text'];

            //     echo '<div class="col-sm-12"><p class="' . $paragraph_itemClass . '">' . $paragraph_itemText . '</p></div>';

            // endif;

            // check current row layout
            if( get_row_layout() == 'navigation_button' ):
                $type = get_sub_field('type');
                // check if the nested repeater field has rows of data
                if( have_rows('btn_repeater') ):
                    echo '<div class="c-content-box c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12 btn-link-group btn-link-group--' . $type . '">';

                        // loop through the rows of data
                    while ( have_rows('btn_repeater') ) : the_row();


                        $btn_link = get_sub_field('button');

                        echo  '<a href="' . $btn_link['url'] . '" target="' . $btn_link['target'] . '" class="btn-link">' . $btn_link['title'] . '</a>';

                    endwhile;

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;

            endif;

            // check current row layout
            if( get_row_layout() == 'cta' ):

                $calltoaction_type = get_sub_field('type');
                $calltoaction_title = get_sub_field('title');
                $calltoaction_subtitle = get_sub_field('subtitle');
                $calltoaction_description = get_sub_field('description');
                $calltoaction_bg = get_sub_field('background_image');
                $calltoaction_cta = get_sub_field('cta');

                $style_bg = '';
                if ($calltoaction_bg):
                    $style_bg = 'style="background-image: url(' . $calltoaction_bg['url'] . ')"';
                endif;

                echo '<div class="c-content-box c-size-md c-content-box--bg" ' . $style_bg . '>';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-sm-12 callToAction callToAction--' . $calltoaction_type . '">';

                if ($calltoaction_title):
                    echo '<h3>' .
                            $calltoaction_title .
                        '</h3>';
                endif;
                if ($calltoaction_subtitle):
                    echo '<p class="subtitle">' .
                            $calltoaction_subtitle .
                        '</p>';
                endif;
                if ($calltoaction_cta):

                    while ( have_rows('cta') ) : the_row();
                        $cta_link_type = get_sub_field('cta_link_type');
                        $cta_link = get_sub_field('cta_link');
                        if ($cta_link):
                            switch ($cta_link_type) {
                                case 'green' :
                                        echo '<a class="btn btn-xlg btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'blue' :
                                        echo '<a class="btn btn-xlg c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'white' :
                                        echo '<a class="btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'link' :
                                        echo '<a class="c-redirectLink" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                default: break;
                            }
                        endif;
                    endwhile;


                endif;

                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            endif;

            // check current row layout
            if( get_row_layout() == 'logo' ):

                $logo_repeater = get_sub_field('logo_repeater');
                // check if the nested repeater field has rows of data
                if( have_rows('logo_repeater') ):

                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl" data-items="6" data-desktop-items="6" data-desktop-small-items="3" data-tablet-items="3" data-mobile-small-items="1" data-auto-play="5000">';
                    echo '<div class="owl-carousel owl-theme c-theme owl-bordered1">';
                        // loop through the rows of data
                    while ( have_rows('logo_repeater') ) : the_row();

                        $logo_image = get_sub_field('logo_image');

                        echo    '<div class="item">' .
                                    '<img src="' . $logo_image['url'] . '" alt="' . $logo_image['alt'] . '" width="180" height="140" />' .
                                '</div>';
                    endwhile;

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;


            endif;

            // check current row layout
            if( get_row_layout() == 'resource' ):

                $headline = get_sub_field('title');
                $slogan = get_sub_field('subtitle');
                $description = get_sub_field('description');
                $promotion_cta = get_sub_field('cta');
                $bg_image = get_sub_field('background_image');

                $style_bg = '';
                if ($bg_image):
                    $style_bg = 'style="background-image: url(' . $bg_image['url'] . ')"';
                endif;

                echo '<div class="c-content-box c-content-box--bg c-size-xlg promotion"' . $style_bg . '>';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-sm-6">';

                if ($headline):
                    echo '<div class="promotion_headline">' .
                            $headline .
                        '</div>';
                endif;
                if ($slogan):
                    echo '<h3>' .
                            $slogan .
                        '</h3>';
                endif;
                if ($description):
                    echo $description;
                endif;
                if ($promotion_cta):

                    while ( have_rows('cta') ) : the_row();
                        $cta_link_type = get_sub_field('cta_link_type');
                        $cta_link = get_sub_field('cta_link');
                        echo '<div class="action">';
                        if ($cta_link):
                            switch ($cta_link_type) {
                                case 'green' :
                                        echo '<a class="btn btn-xlg btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'blue' :
                                        echo '<a class="btn btn-xlg c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'white' :
                                        echo '<a class="btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'link' :
                                        echo '<a class="c-redirectLink" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                default: break;
                            }
                        endif;
                        echo '</div>';
                    endwhile;


                endif;

                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            endif;

            // check current row layout
            if( get_row_layout() == 'image-text_card' ):

                // check if the nested repeater field has rows of data
                if( have_rows('image_text_card_repeater') ):

                    echo '<div class="c-content-box c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12">';
                        // loop through the rows of data
                    while ( have_rows('image_text_card_repeater') ) : the_row();

                        $headline = get_sub_field('title');
                        $body = get_sub_field('description');
                        $image = get_sub_field('image');
                        $image_position = get_sub_field('image_position');
                        $cta = get_sub_field('cta');
                        $linkcontent = '';

                        if ($cta):
                            while ( have_rows('cta') ) : the_row();
                                $cta_link_type = get_sub_field('cta_link_type');
                                $cta_link = get_sub_field('cta_link');
                                if ($cta_link):
                                    switch ($cta_link_type) {
                                        case 'green' :
                                                $linkcontent = '<a class="btn btn-xlg btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        case 'blue' :
                                                $linkcontent = '<a class="btn btn-xlg c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        case 'white' :
                                                $linkcontent = '<a class="btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        case 'link' :
                                                $linkcontent = '<a class="c-redirectLink" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        default: break;
                                    }
                                endif;
                            endwhile;
                        endif;

                        echo    '<div class="img-text-card img-text-card--' . $image_position . ' clearfix">' .
                                    '<div class="img-text-card__img">' .
                                        '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" />' .
                                    '</div>' .
                                    '<div class="img-text-card__text">' .
                                        '<h3 class="highlight highlight--lightBlue">' . $headline . '</h3>' .
                                        '<p>' . $body . '</p>' .
                                        '<div class="img-text-card__link">' . $linkcontent . '</div>' .
                                    '</div>' .
                                '</div>';
                    endwhile;

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;


            endif;

            // check current row layout
            if( get_row_layout() == 'image-text' ):
                $background_color = get_sub_field('background_color');
                $image_text_title = get_sub_field('image_text_title');
                $image_text_title_color = get_sub_field('image_text_title_color');
                $image_text_description = get_sub_field('image_text_description');
                // check if the nested repeater field has rows of data
                if( have_rows('image_text_column_repeater') ):

                    echo '<div class="c-content-box c-content-box--' . $background_color . ' c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row">';

                    if ($image_text_title):
                        echo '<div class="col-sm-10 col-sm-push-1 c-center">';
                            echo '<div class="img-text-title img-text-title--' . $image_text_title_color . '">' . $image_text_title . '</div>';
                            if ($image_text_description):
                                echo '<div class="img-text-desc">' . $image_text_description . '</div>';
                            endif;
                        echo '</div>';
                    endif;


                    echo '<div class="clear"></div>';
                        // loop through the rows of data
                    while ( have_rows('image_text_column_repeater') ) : the_row();

                        $anchor_id = get_sub_field('anchor_id');
                        $headline = get_sub_field('title');
                        $title_color = get_sub_field('title_color');
                        $body = get_sub_field('description');
                        $image = get_sub_field('image');
                        $image_position = get_sub_field('image_position');
                        $cta = get_sub_field('cta');

                        $anchor_id_content = '';
                        if ($anchor_id):
                            $anchor_id_content = 'id="' . $anchor_id . '"';
                        endif;

                        $title_color_class = '';
                        if ($title_color !== 'none'):
                            $title_color_class = 'highlight highlight--' . $title_color;
                        endif;


                        $pull6 = '';
                        $push6 = '';
                        if ($image_position == 'right') :
                            $pull6 = 'col-sm-pull-6';
                            $push6 = 'col-sm-push-6';
                        endif;
                        $linkcontent = '';

                        if ($cta):
                            while ( have_rows('cta') ) : the_row();
                                $cta_link_type = get_sub_field('cta_link_type');
                                $cta_link = get_sub_field('cta_link');
                                if ($cta_link):
                                    switch ($cta_link_type) {
                                        case 'green' :
                                                $linkcontent = '<a class="btn btn-xlg btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        case 'blue' :
                                                $linkcontent = '<a class="btn btn-xlg c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        case 'white' :
                                                $linkcontent = '<a class="btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        case 'link' :
                                                $linkcontent = '<a class="c-redirectLink" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        default: break;
                                    }
                                endif;
                            endwhile;

                            if ($linkcontent !== ''):
                                $linkcontent = '<div class="img-text-column__link"> ' . $linkcontent . ' </div>';
                            endif;
                        endif;

                        echo    '<div ' . $anchor_id_content . ' class="img-text-column img-text-column--' . $image_position . ' clearfix">' .
                                    '<div class="col-sm-6 ' . $push6 . ' img-text-column__img">' .
                                        '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" />' .
                                    '</div>' .
                                    '<div class="col-sm-6 ' . $pull6 . ' img-text-column__text">' .
                                        '<h3 class="' . $title_color_class . '">' . $headline . '</h3>' .
                                        $body .
                                        $linkcontent .
                                    '</div>' .
                                '</div>';
                    endwhile;

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;


            endif;

            // check current row layout
            if( get_row_layout() == '1-column' ):

                $headimage = get_sub_field('image');
                $headicon = get_sub_field('icon');
                $headline = get_sub_field('title');
                $body = get_sub_field('description');
                $cta = get_sub_field('cta');


                echo '<div class="c-content-box c-size-md">';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-sm-10 col-sm-push-1 c-center">';

                if ($headimage):
                    echo '<img src="' . $headimage['url'] . '" alt="' . $headimage['alt'] . '"/>';
                endif;

                if ($headicon):
                    echo '<div class="header_icon">' .
                            '<img src="' . $headicon['url'] . '" alt="' . $headicon['alt'] . '" width="64" height="64" />' .
                        '</div>';
                endif;
                if ($headline):
                    echo '<h3>' .
                            $headline .
                        '</h3>';
                endif;
                if ($body):
                    echo $body;
                endif;
                if ($cta):
                    while ( have_rows('cta') ) : the_row();
                        $cta_link_type = get_sub_field('cta_link_type');
                        $cta_link = get_sub_field('cta_link');

                        if ($cta_link):
                            switch ($cta_link_type) {
                                case 'green' :
                                        echo '<a class="c-margin-t-30 btn btn-xlg btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'blue' :
                                        echo '<a class="c-margin-t-30 btn btn-xlg c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'white' :
                                        echo '<a class="c-margin-t-30 btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'link' :
                                        echo '<div class="c-margin-t-30"><a class="c-redirectLink" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a></div>';
                                        break;
                                default: break;
                            }
                        endif;
                    endwhile;


                endif;

                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            endif;

            // check current row layout
            if( get_row_layout() == '2-column' ):
                $rows = get_sub_field('columns');
                $row_count = count($rows);
                $row_index = 0;
                // check if the nested repeater field has rows of data
                if( have_rows('columns') ):

                    echo '<div class="c-content-box c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                        // loop through the rows of data
                    $push = '';
                    while ( have_rows('columns') ) : the_row();
                        $row_index++;
                        if ($row_index == $row_count):
                            $push = 'col-sm-push-2';
                        endif;
                        $headline = get_sub_field('headline');
                        $body = get_sub_field('body');
                        $icon = get_sub_field('icon');
                        $cta = get_sub_field('cta');

                        $linkcontent = '';

                        if ($cta):
                            while ( have_rows('cta') ) : the_row();
                                $cta_link_type = get_sub_field('cta_link_type');
                                $cta_link = get_sub_field('cta_link');
                                if ($cta_link):
                                    switch ($cta_link_type) {
                                        case 'green' :
                                                $linkcontent = '<a class="btn btn-xlg btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        case 'blue' :
                                                $linkcontent = '<a class="btn btn-xlg c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        case 'white' :
                                                $linkcontent = '<a class="btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        case 'link' :
                                                $linkcontent = '<a class="c-redirectLink" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        default: break;
                                    }
                                endif;
                            endwhile;
                        endif;

                        echo    '<div class="col-sm-5 ' . $push . '">' .
                                    '<div class="header_icon">' .
                                        '<img src="' . $icon['url'] . '" alt="' . $icon['alt'] . '" width="64" height="64" />' .
                                    '</div>' .
                                    '<h3>' . $headline . '</h3>' .
                                    $body .
                                    '<div class="c-margin-t-30">' . $linkcontent . '</div>' .
                                '</div>';
                    endwhile;

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;


            endif;

                


            // check current row layout
            if( get_row_layout() == '3-column' ):

                // check if the nested repeater field has rows of data
                if( have_rows('columns') ):

                    echo '<div class="c-content-box c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12 three-column">';
                        // loop through the rows of data

                    while ( have_rows('columns') ) : the_row();

                        $headline = get_sub_field('headline');
                        $body = get_sub_field('body');
                        $icon = get_sub_field('icon');
                        $cta = get_sub_field('cta');
                        $linkcontent = '';

                        if ($cta):
                            while ( have_rows('cta') ) : the_row();
                                $cta_link_type = get_sub_field('cta_link_type');
                                $cta_link = get_sub_field('cta_link');
                                if ($cta_link):
                                    switch ($cta_link_type) {
                                        case 'green' :
                                                $linkcontent = '<a class="btn btn-xlg btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        case 'blue' :
                                                $linkcontent = '<a class="btn btn-xlg c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        case 'white' :
                                                $linkcontent = '<a class="btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        case 'link' :
                                                $linkcontent = '<a class="c-redirectLink" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                        $cta_link['title'] .
                                                    '</a>';
                                                break;
                                        default: break;
                                    }
                                endif;
                            endwhile;
                        endif;

                        if ($linkcontent !== ''):
                            $linkcontent = '<div class="c-margin-t-30">' . $linkcontent . '</div>';
                        endif;

                        echo    '<div class="three-column__item">' .
                                    '<img src="' . $icon['url'] . '" alt="' . $icon['alt'] . '" width="80" height="80" />' .
                                    '<h5 class="three-column__title">' . $headline . '</h3>' .
                                    $body .
                                    $linkcontent .
                                '</div>';
                    endwhile;

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;


            endif;

            // check current row layout
            if( get_row_layout() == '2-column_for_feature' ):
                $background_color = get_sub_field('background_color');
                $color = get_sub_field('color');
                // check if the nested repeater field has rows of data
                if( have_rows('column') ):

                    echo '<div class="c-content-box c-content-box--' . $background_color . ' c-size-sm">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12 feature-column">';
                        // loop through the rows of data

                    while ( have_rows('column') ) : the_row();

                        $headline = get_sub_field('headline');
                        $body = get_sub_field('body');
                        $icon = get_sub_field('icon');


                        // if ($linkcontent !== ''):
                        //     $linkcontent = '<div class="c-margin-t-30">' . $linkcontent . '</div>';
                        // endif;

                        echo    '<div class="feature-column__item">' .
                                    '<div><img src="' . $icon['url'] . '" alt="' . $icon['alt'] . '" width="60" height="60" /></div>' .
                                    '<h5 class="feature-column__title highlight highlight--' . $color . '">' . $headline . '</h3>' .
                                    $body .
                                    // $linkcontent .
                                '</div>';

                    endwhile;

                    $cta = get_sub_field('cta');
                        $linkcontent = '';

                    if ($cta):
                        while ( have_rows('cta') ) : the_row();
                            $cta_link_type = get_sub_field('cta_link_type');
                            $cta_link = get_sub_field('cta_link');
                            if ($cta_link):
                                switch ($cta_link_type) {
                                    case 'green' :
                                            $linkcontent = '<a class="btn btn-xlg btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                    $cta_link['title'] .
                                                '</a>';
                                            break;
                                    case 'blue' :
                                            $linkcontent = '<a class="btn btn-xlg c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                    $cta_link['title'] .
                                                '</a>';
                                            break;
                                    case 'white' :
                                            $linkcontent = '<a class="btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                    $cta_link['title'] .
                                                '</a>';
                                            break;
                                    case 'link' :
                                            $linkcontent = '<a class="c-redirectLink" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                    $cta_link['title'] .
                                                '</a>';
                                            break;
                                    default: break;
                                }
                            endif;
                        endwhile;
                        if ($linkcontent !== ''):
                            $linkcontent = '<div class="feature-column__link"> ' . $linkcontent . ' </div>';
                        endif;
                    endif;
                    echo '<div class="clear"></div>' . $linkcontent;
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;


            endif;

            // check current row layout
            if( get_row_layout() == 'line' ):

                $height = get_sub_field('height');
                $color = get_sub_field('color');


                echo '<div class="c-content-box">';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-sm-12">';

                if ($height):
                    echo '<hr style="border-top-color: ' . $color . '; border-top-width: ' . $height . 'px " />';
                endif;



                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

            endif;
            get_template_part('template-parts/acf-parts/Common/testimonial_old');
        endwhile;

        else :

        // no layouts found

        endif;
    ?>

</div>

<?php get_template_part('template-parts/footer'); ?>