<?php
/*
Template Name:acf Company
*/

use Roots\Sage\Assets;
?>
<?php get_template_part('template-parts/header'); ?>
    <div class="c-navbar--secondary visible-md">
        <div class="container">
            <?php
            $defaults = array(
                'theme_location'  => 'company',
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

<div class="c-layout-page c-layout-page-fixed primary-page">


    <?php
        // check if the flexible content field has rows of data
        if( have_rows('modules') ):

            // loop through the rows of data
        while ( have_rows('modules') ) : the_row();
            if( get_row_layout() == 'hero_head' ):

                $header_align = get_sub_field('align');
                $if_page_has_banner = get_sub_field('if_page_has_banner');
                $header_headline = get_sub_field('h1_title');
                $header_slogan = get_sub_field('subtitle');
                $header_image = get_sub_field('image');
                $header_description = get_sub_field('description');

                $header__withBannerClass = '';
                if($if_page_has_banner):
                    $header__withBannerClass = 'header__withBanner';
                endif;


                echo '<div class="c-content-box c-size-md">';
                echo '<div class="container header header--' . $header_align . '">';
                echo '<div class="row">';
                echo '<div class="col-sm-12 ' . $header__withBannerClass . '">';


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
                if ($header_image):
                    echo '<img class="comm100-logo" src="' . $header_image['url'] . '" alt="' . $header_image['alt'] . '" width="430" height="267">';
                endif;
                if ($header_description):
                    echo $header_description;

                endif;

                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            endif;

            // check current row layout
            if( get_row_layout() == 'thank_you_hero_head' ):

                $header_headline = get_sub_field('h1_title');
                $header_slogan = get_sub_field('subtitle');
                $header_description = get_sub_field('description');
                $call_to_action = get_sub_field('call_to_action');

                echo '<div class="c-content-box c-size-md">';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-sm-12 thankyou">';


                if ($header_headline):
                    echo '<h1>' .
                            $header_headline .
                        '</h1>';
                endif;
                if ($header_slogan):
                    echo '<h2 class="c-margin-t-20">' .
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
                echo '</div>';
                echo '</div>';
                echo '</div>';
            endif;

            if( get_row_layout() == 'hero_header_form' ):

                $header_headline = get_sub_field('h1_title');
                $header_slogan = get_sub_field('subtitle');
                $header_image = get_sub_field('image');
                $header_background_color = get_sub_field('background_color');
                $header_form_code = get_sub_field('form_code');
                $form_note = get_sub_field('form_note');



                echo '<div class="c-content-box c-size-md c-content-box--' . $header_background_color . ' ">';
                echo '<div class="container header">';
                echo '<div class="row">';
                echo '<div class="col-sm-12">';


                if ($header_headline):
                    echo '<h1 class="c-center">' .
                            $header_headline .
                        '</h1>';
                endif;
                if ($header_slogan):
                    echo '<h2>' .
                            $header_slogan .
                        '</h2>';
                endif;
                if ($header_form_code):
                    echo '<div class="col-sm-6 col-sm-push-3">' .
                            $header_form_code .
                            '<script src="'.Assets\asset_path('scripts/marketo-form.js').'"></script>' .
                            '<div class="form-note">' . $form_note . '</div>'.
                        '</div>';

                endif;
                if ($header_image):
                    echo '<img class="img-right-bottom hidden-xs" src="' . $header_image['url'] . '" alt="' . $header_image['alt'] . '" width="" height="">';
                endif;


                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            endif;

            if( get_row_layout() == 'hero_banner_form' ):

                $header_headline = get_sub_field('h1_title');
                $header_slogan = get_sub_field('subtitle');
                $header_background_image = get_sub_field('background_image');
                $header_form_code = get_sub_field('form_code');

                $style_bg = '';
                if ($header_background_image):
                    $style_bg = 'style="background-image: url(' . $header_background_image['url'] . ')"';
                endif;


                echo '<div class="c-content-box c-size-xlg banner"' . $style_bg . '>';
                echo '<div class="container header">';
                echo '<div class="row">';
                echo '<div class="col-sm-12 request-demo">';


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
                if ($header_form_code):
                    echo '<div class="row"><div class="col-sm-5">' . $header_form_code . '</div></div>';

                endif;

                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            endif;

            // check current row layout
            if( get_row_layout() == 'image_text_quote' ):

                // check if the nested repeater field has rows of data
                if( have_rows('image_text_column_repeater') ):

                    echo '<div class="c-content-box">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12">';
                        // loop through the rows of data
                    while ( have_rows('image_text_column_repeater') ) : the_row();

                        $headline = get_sub_field('title');
                        $body = get_sub_field('description');
                        $image = get_sub_field('image');
                        $image_position = get_sub_field('image_position');
                        $cta = get_sub_field('cta');
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

                        $quote = get_sub_field('quote');
                        $quoteContent = '';
                        if ($quote):
                            while ( have_rows('quote') ) : the_row();
                                $name = get_sub_field('name');
                                $content = get_sub_field('content');
                                $quoteContent = '<div class="simple-quote">' .
                                                    '<div class="simple-quote__name">' . $name . '</div>' .
                                                    '<div class="simple-quote__content">' . $content . '</div>' .
                                                '</div>';
                            endwhile;
                        endif;

                        echo    '<div class="img-text-quote">' .
                                    '<div class="img-text-column img-text-column--' . $image_position . ' clearfix">' .
                                        '<div class="col-sm-6 ' . $push6 . ' img-text-column__img simple-img">' .
                                            '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="300" height="300" />' .
                                        '</div>' .
                                        '<div class="col-sm-6 ' . $pull6 . ' img-text-column__text">' .
                                            '<h3 class="img-title">' . $headline . '</h3>' .
                                            $body .
                                        '</div>' .
                                    '</div>' .
                                    $quoteContent .
                                '</div>';
                    endwhile;

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;


            endif;

            // check current row layout
            if( get_row_layout() == 'resource_card_group' ):
                $title = get_sub_field('title');
                // check if the nested repeater field has rows of data
                if( have_rows('resource_repeater') ):

                    echo '<div class="c-content-box c-size-md c-content-box--grey">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12">';
                        // loop through the rows of data
                    if ($title):
                        echo '<h3 class="top-resources">' . $title . '</h3>';
                    endif;
                    echo '<div class="resourceCard-group">';
                    while ( have_rows('resource_repeater') ) : the_row();

                        $title = get_sub_field('title');
                        $type = get_sub_field('type');
                        $image = get_sub_field('image');
                        $link = get_sub_field('link');
                        $linkcontent = '';

                        if ($link):
                            $linkcontent = '<div class="resourceCard-item-link">' .
                                    '<a class="c-redirectLink" href="' . $link['url'] . '" target="' . $link['target'] . '">' .
                                        $link['title'] .
                                    '</a>' .
                                '</div>';
                        endif;

                        echo    '<div class="resourceCard-item">' .
                                    '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" />' .
                                    '<div class="resourceCard-item-tag">' . $type . '</div>' .
                                    '<h5 class="resourceCard-item-title">' . $title . '</h3>' .
                                    $linkcontent .
                                '</div>';
                    endwhile;

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;


            endif;

            // check current row layout
            if( get_row_layout() == 'logo' ):

                $logo_repeater = get_sub_field('logo_repeater');
                // check if the nested repeater field has rows of data
                $desktop_items = get_sub_field('desktop_items');
                $tablet_items = get_sub_field('tablet_items');
                $mobile_items = get_sub_field('mobile_items');
                if( have_rows('logo_repeater') ):

                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl" data-items="' . $desktop_items. '" data-desktop-items="' . $desktop_items . '" data-desktop-small-items="' . $tablet_items . '" data-tablet-items="' . $tablet_items . '" data-mobile-small-items="' . $mobile_items . '" data-auto-play="5000">';
                    echo '<div class="owl-carousel owl-theme c-theme owl-bordered1">';
                        // loop through the rows of data
                    while ( have_rows('logo_repeater') ) : the_row();

                        $logo_image = get_sub_field('logo_image');

                        echo    '<div class="item">' .
                                    '<img class="c-img-pos grayscale" src="' . $logo_image['url'] . '" alt="' . $logo_image['alt'] . '" width="180" height="140" />' .
                                '</div>';
                    endwhile;

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;


            endif;

            // check current row layout
            if( get_row_layout() == 'about_bio' ):

                $avatar = get_sub_field('avatar');
                $bio = get_sub_field('bio');
                $signature = get_sub_field('signature');

                echo '<div class="c-content-box c-size-md">';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-sm-12">';
                echo '<div class="bio">';


                if ($avatar):
                    echo '<img class="avatar" src="' . $avatar['url'] . '" alt="' . $avatar['alt'] . '" width="380" height="380">';
                endif;
                if ($bio):
                    echo $bio;
                endif;
                if ($signature):
                    echo '<div class="bio-signature">' .
                            $signature .
                        '</div>';
                endif;

                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            endif;

            // check current row layout
            if( get_row_layout() == 'img-text_vertical' ):

                $title = get_sub_field('title');
                $description = get_sub_field('description');
                $signature = get_sub_field('signature');

                echo '<div class="c-content-box c-size-md">';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-sm-12 aboutus-benefits">';


                if ($title):
                    echo '<h5>' . $title . '</h5>';
                endif;
                if ($description):
                    echo $description;
                endif;

                if( have_rows('img-text_vertical_repeater') ):

                    echo '<div class="row">';
                        // loop through the rows of data
                    while ( have_rows('img-text_vertical_repeater') ) : the_row();

                        $headline = get_sub_field('headline');
                        $body = get_sub_field('body');
                        $image = get_sub_field('image');

                        echo    '<div class="col-sm-6 img-text-vertical">' .
                                    '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" />' .
                                    '<h3>' . $headline . '</h3>' .
                                    $body .
                                '</div>';
                    endwhile;

                    echo '</div>';

                endif;

                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            endif;

            // check current row layout
            if( get_row_layout() == 'user_review' ):

                $logo = get_sub_field('logo');
                $headline = get_sub_field('headline');
                $quote = get_sub_field('quote');
                $signature = get_sub_field('signature');
                $user_review_link = get_sub_field('user_review_link');
                $background_color = get_sub_field('background_color');


                echo '<div class="c-content-box c-size-md c-content-box--' . $background_color . ' ">';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-sm-12 user-review">';

                if ($logo):
                    echo '<img src="' . $logo['url'] . '" alt="' . $logo['alt'] . '" width="" height="">';
                endif;

                if ($headline):
                    echo '<h4>' .
                            $headline .
                        '</h4>';
                endif;

                echo '<div class="simple-quote">';
                if ($quote):
                    echo '<div class="simple-quote__content">' .
                            $quote .
                        '</div>';
                endif;
                if ($signature):
                    echo '<div class="simple-quote__name">' .
                            $signature .
                        '</div>';
                endif;
                echo '</div>';

                if ($user_review_link):
                    echo '<div class="user-review-link">' .
                            '<a class="c-redirectLink" href="' . $user_review_link['url'] . '" target="' . $user_review_link['target'] . '">' .
                                $user_review_link['title'] .
                            '</a>' .
                        '</div>';
                endif;


                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

            endif;

            // check current row layout
            if( get_row_layout() == 'cta_join_us' ):

                $headimage = get_sub_field('image');
                $headline = get_sub_field('title');
                $cta = get_sub_field('cta');


                echo '<div class="c-content-box c-size-md">';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-sm-12 c-center">';

                if ($headimage):
                    echo '<img src="' . $headimage['url'] . '" alt="' . $headimage['alt'] . '"/>';
                endif;


                if ($headline):
                    echo '<h2 class="c-margin-t-80">' .
                            $headline .
                        '</h2>';
                endif;

                if ($cta):
                    while ( have_rows('cta') ) : the_row();
                        $cta_link_type = get_sub_field('cta_link_type');
                        $cta_link = get_sub_field('cta_link');

                        if ($cta_link):
                            switch ($cta_link_type) {
                                case 'green' :
                                        echo '<a class="c-margin-t-50 btn btn-xlg btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'blue' :
                                        echo '<a class="c-margin-t-50 btn btn-xlg c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'white' :
                                        echo '<a class="c-margin-t-50 btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'link' :
                                        echo '<div class="c-margin-t-50"><a class="c-redirectLink" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
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
            if( get_row_layout() == 'hero_banner' ):
                $banner_background_image = get_sub_field('background_image');
                $style_bg = '';
                if ($banner_background_image):
                    $style_bg = 'style="background-image: url(' . $banner_background_image['url'] . ')"';
                endif;


                echo '<div class="banner"'  . $style_bg . '></div>';

            endif;


            // check current row layout
            if( get_row_layout() == 'list_with_icon' ):


                echo '<div class="c-content-box c-size-md">';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-sm-12 icon-text-list">';



                if( have_rows('list_with_icon_repeater') ):
                        // loop through the rows of data
                    while ( have_rows('list_with_icon_repeater') ) : the_row();

                        $title = get_sub_field('title');
                        $icon = get_sub_field('icon');

                        echo    '<div class="icon-text-item">' .
                                    '<div class="icon-text-item__img">' .
                                        '<img src="' . $icon['url'] . '" alt="' . $icon['alt'] . '" width="60" height="60" />' .
                                    '</div>' .
                                    '<div class="icon-text-item__title">' . $title . '</div>' .
                                    $body .
                                '</div>';
                    endwhile;
                endif;

                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            endif;

            // check current row layout
            if( get_row_layout() == 'team_photo' ):


                echo '<div class="c-content-box c-size-md">';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-sm-12">';
                echo '<div class="team-photo">';



                if( have_rows('team_photo_repeater') ):
                        // loop through the rows of data
                    while ( have_rows('team_photo_repeater') ) : the_row();

                        $photo = get_sub_field('photo');

                        echo '<img src="' . $photo['url'] . '" alt="' . $photo['alt'] . '" width="" height="" />';

                    endwhile;
                endif;

                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            endif;

            // check current row layout
            if( get_row_layout() == 'open_opportunities' ):


                echo '<div class="c-content-box c-size-md">';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-sm-12">';

                $headline = get_sub_field('headline');

                echo '<h2>' . $headline . '</h2>';

                if( have_rows('open_opportunities_repeater') ):
                        // loop through the rows of data
                    while ( have_rows('open_opportunities_repeater') ) : the_row();

                        $job_title = get_sub_field('job_title');
                        $department = get_sub_field('department');

                        echo    '<div class="open-opportunity">' .
                                    '<h4 class="job-title">' .
                                        '<a href="' . $job_title['url'] . '" target="' . $job_title['target'] . '">' .
                                            $job_title['title'] .
                                        '</a>' .
                                    '</h4>' .
                                    '<div class="department">' . $department . '</div>' .
                                '</div>';
                    endwhile;
                endif;

                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            endif;

            // check current row layout
            if( get_row_layout() == 'contact_channel' ):


                echo '<div class="c-content-box c-size-md">';
                echo '<div class="container">';
                echo '<div class="row contact--reachus">';

                $headline = get_sub_field('headline');
                $image = get_sub_field('image');

                echo '<h3 class="c-font-36 c-font-center">' . $headline . '</h3>';

                if ($image):
                    echo '<div class="col-sm-5">' . '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="445" height="390" />' . '</div>';
                endif;

                if( have_rows('contact_channel_repeater') ):
                    echo '<div class="col-sm-7">';
                    echo '<div class="contact-wrap clearfix">';
                        // loop through the rows of data
                    while ( have_rows('contact_channel_repeater') ) : the_row();

                        $title = get_sub_field('title');
                        $body = get_sub_field('body');

                        echo '<div class="contact-item">' .
                                '<h5 class="contact-title">' . $title . '</h5>' .
                                '<div class="contact-detail">' . $body . '</div>' .
                            '</div>';
                    endwhile;
                    echo '</div>';
                    echo '</div>';
                endif;

                echo '</div>';
                echo '</div>';
                echo '</div>';
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

            if( get_row_layout() == 'tabs' ):
                if( have_rows('tab_wrap') ):

                    // loop through the rows of data
                    while ( have_rows('tab_wrap') ) : the_row();
                        $header_headline = get_sub_field('h1_title');
                        $header_slogan = get_sub_field('subtitle');
                        $header_description = get_sub_field('description');

                        // check if the nested repeater field has rows of data
                        if( have_rows('tab_content') ):

                            echo '<div class="c-content-box c-size-md">';
                            echo '<div class="container">';
                            echo '<div class="row">';

                            echo '<div class="col-sm-12 threeTab__head c-center">' .
                                    '<h1>' . $header_headline . '</h1>' .
                                    '<h2>' .
                                        $header_slogan .
                                    '</h2>' .
                                    $header_description .
                                '</div>';

                            echo '<div class="col-sm-12">';
                            echo '<div class="threeTab__Index--Wrap clearfix">';
                                // loop through the rows of data

                            while ( have_rows('tab_content') ) : the_row();

                                $color = get_sub_field('color');
                                $tag = get_sub_field('tag');
                                $headline = get_sub_field('headline');
                                $body = get_sub_field('body');
                                $link = get_sub_field('link');

                                echo    '<div class="threeTab__Index">' .
                                            '<div class="product-item__tag product-item__tag--large product-item__tag' . $color . '">' . $tag . '</div>' .
                                            '<h3>' . $headline . '</h3>' .
                                        '</div>';

                            endwhile;

                            echo '</div>';
                            echo '<div class="threeTab__Detail-wrap">';

                            // pricing live chat details

                            while ( have_rows('tab_details') ) : the_row();

                                $title = get_sub_field('title');
                                $description = get_sub_field('description');

                                $featurelist_wrap = '';
                                if (have_rows('content')):

                                    while ( have_rows('content') ) : the_row();
                                        $sub_title = get_sub_field('sub_title');
                                        $icon = get_sub_field('icon');
                                        $featurelist_wrap .= '<div class="col-sm-6 threeTab__Detail--col">';
                                        $featurelist_wrap .= '<img src="' . $icon['url'] . '" alt="' . $icon['alt'] . '" width="50" height="50" />';
                                        $featurelist_wrap .= '<p class="threeTab__Detail--subTitle">' . $sub_title . '</p>';
                                        $featurelist_wrap .= '<ul class="threeTab__Detail--contentList">';
                                        // $li_feature_list = '';
                                        while ( have_rows('content_list') ) : the_row();
                                            $content_list_point = get_sub_field('content_list_point');
                                            $featurelist_wrap .= '<li>' . $content_list_point . '</li>';
                                        endwhile;
                                        $featurelist_wrap .= '</ul></div>';
                                    endwhile;
                                endif;


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
                                        $linkcontent = '<div class="threeTab__Detail--action"> ' . $linkcontent . ' </div>';
                                    endif;
                                endif;

                                echo    '<div class="threeTab__Detail clearfix">' .
                                            $tabMobileAI .
                                            '<div class="threeTab__Detail--col-wrap clearfix">' .

                                                '<div class="threeTab__Detail--title">' . $title . '</div>' .
                                                '<div class="threeTab__Detail--summary">' . $description . '</div>' .
                                                $featurelist_wrap .
                                            '</div>' .
                                        '</div>';

                            endwhile;


                            // end pricing live chat details




                            echo '</div>';



                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';

                        endif;
                    endwhile;
                endif;
            endif;

            // check current row layout
            if( get_row_layout() == 'partner_contact' ):
                $image = get_sub_field('image');
                $title = get_sub_field('title');
                $contact_form = get_sub_field('contact_form');
                $form_note = get_sub_field('form_note');

                echo '<div class="c-content-box c-size-md">' .
                        '<div class="container">' .
                            '<div class="row">' .

                                '<div class="col-sm-5"><img class="avatar" src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="380" height="380" /></div>' .
                                '<div class="col-sm-7">' .
                                    '<div class="contact-form">' .
                                        '<h3 class="highlight highlight--blue">' . $title . '</h3>' .
                                        $contact_form .
                                        '<script src="'.Assets\asset_path('scripts/marketo-form.js').'"></script>' .
                                        '<div class="form-note">' . $form_note . '</div>'.
                                    '</div>' .
                                '</div>' .

                            '</div>' .
                        '</div>' .
                    '</div>';

            endif;

            // check current row layout
            if( get_row_layout() == '2-column_for_feature' ):
                $color = get_sub_field('color');
                // check if the nested repeater field has rows of data
                if( have_rows('column') ):

                    echo '<div class="c-content-box c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12 feature-column">';
                        // loop through the rows of data

                    $index = 0;
                    while ( have_rows('column') ) : the_row();
                        $index ++;
                        $headline = get_sub_field('headline');
                        $body = get_sub_field('body');
                        $icon = get_sub_field('icon');


                        if ($linkcontent !== ''):
                            $linkcontent = '<div class="c-margin-t-30">' . $linkcontent . '</div>';
                        endif;

                        echo    '<div class="feature-column__item">' .
                                    '<div><img src="' . $icon['url'] . '" alt="' . $icon['alt'] . '" width="60" height="60" /></div>' .
                                    '<h5 class="feature-column__title highlight highlight--' . $color . '">' . $headline . '</h3>' .
                                    $body .
                                    $linkcontent .
                                '</div>';

                        if ($index % 2 == 0 ):
                            echo '<div class="clear"></div>';
                        endif;
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
                    echo $linkcontent;
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

        endwhile;

        else :

        // no layouts found

        endif;
    ?>

</div>

<?php get_template_part('template-parts/footer'); ?>
