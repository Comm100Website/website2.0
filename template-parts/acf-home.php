<?php
/*
Template Name: Resources - 2
Template Post Type: commresource, page
*/
use Roots\Sage\Assets;
?>

<?php get_template_part('template-parts/header'); ?>
</header>
<div class="c-layout-page c-layout-page-fixed">
    <?php
        function ctacontent($cta_link_type, $cta_link) {
            $linkcontent = '';
            if ($cta_link):
                switch ($cta_link_type) {
                    case 'green' :
                            $linkcontent = '<a class="btn btn-sm btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                    $cta_link['title'] .
                                '</a>';
                            break;
                    case 'blue' :
                            $linkcontent = '<a class="btn btn-sm c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                    $cta_link['title'] .
                                '</a>';
                            break;
                    case 'white' :
                            $linkcontent = '<a class="btn btn-sm c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
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
            return '<td>' . $linkcontent . '</td>';
        }

        if( have_rows('tabs') ):

            // loop through the rows of data
            while ( have_rows('tabs') ) : the_row();
                $header_headline = get_sub_field('h1_title');
                $header_slogan = get_sub_field('subtitle');

                // check if the nested repeater field has rows of data
                if( have_rows('tab_content') ):

                    echo '<div class="c-content-box c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row">';

                    echo '<div class="col-sm-12 c-center">' .
                            '<h1>' . $header_headline . '</h1>' .
                            '<h2>' .
                                $header_slogan .
                            '</h2>' .
                        '</div>';

                    echo '<div class="col-sm-12 pricing">';
                    echo '<div class="threeTab__Index--Wrap clearfix" data-wheel="true">';
                        // loop through the rows of data
                    $tabMobileLC = '';
                    $tabMobileMC = '';
                    $tabMobileAI = '';
                    while ( have_rows('tab_content') ) : the_row();

                        $color = get_sub_field('color');
                        $tag = get_sub_field('tag');
                        $headline = get_sub_field('headline');
                        $body = get_sub_field('body');
                        $link = get_sub_field('link');

                        if ( $tag == 'LC' ):
                            $tabMobileLC = '<div class="threeTab__Index--mobile">' .
                                        '<div class="product-item__tag product-item__tag--large product-item__tag' . $color . '">' . $tag . '</div>' .
                                        '<h3>' . $headline . '</h3>' .
                                        '<div class="threeTab__Index--desc">' .
                                            '<p class="product-item__desc"> ' . $body . ' </p>' .
                                        '</div>' .
                                    '</div>';
                        endif;
                        if ( $tag == 'OC' ):
                            $tabMobileMC = '<div class="threeTab__Index--mobile">' .
                                        '<div class="product-item__tag product-item__tag--large product-item__tag' . $color . '">' . $tag . '</div>' .
                                        '<h3>' . $headline . '</h3>' .
                                        '<div class="threeTab__Index--desc">' .
                                            '<p class="product-item__desc"> ' . $body . ' </p>' .
                                        '</div>' .
                                    '</div>';
                        endif;
                        if ( $tag == 'AI' ):
                            $tabMobileAI = '<div class="threeTab__Index--mobile">' .
                                        '<div class="product-item__tag product-item__tag--large product-item__tag' . $color . '">' . $tag . '</div>' .
                                        '<h3>' . $headline . '</h3>' .
                                        '<div class="threeTab__Index--desc">' .
                                            '<p class="product-item__desc"> ' . $body . ' </p>' .
                                        '</div>' .
                                    '</div>';
                        endif;

                        echo    '<div class="threeTab__Index threeTab__Index__' . $color . '">' .
                                    '<div class="product-item__tag product-item__tag--large product-item__tag' . $color . '">' . $tag . '</div>' .
                                    '<h3>' . $headline . '</h3>' .
                                    '<div class="threeTab__Index--desc">' .
                                        '<p class="product-item__desc"> ' . $body . ' </p>' .
                                        '<div class="threeTab__Index--link">' .
                                            '<a class="c-redirectLink" href="' . $link['url'] . '" target="' . $link['target'] . '">' .
                                                $link['title'] .
                                            '</a>' .
                                        '</div>' .
                                    '</div>' .
                                '</div>';

                                $color = get_sub_field('color');
                    endwhile;

                    echo '</div>';
                    echo '<div class="threeTab__Detail-wrap">';

                    // pricing live chat details
                    echo '<div class="threeTab__Detail clearfix">';
                    echo $tabMobileLC;
                    echo '<div class="threeTab__Detail--col-wrap clearfix d-flex">';
                    while ( have_rows('pricing_details_live_chat') ) : the_row();
                        $color = get_sub_field('color');
                        $title = get_sub_field('title');
                        $if_show_price = get_sub_field('if_show_price');
                        $price = get_sub_field('price');
                        $request_quote = get_sub_field('request_quote');
                        $feature_list_title = get_sub_field('feature_list_title');

                        $priceContent = '<span class="threeTab__Detail--priceQuote"><strong>' . $request_quote . '</strong></span>';
                        if ($if_show_price):
                            while ( have_rows('price') ) : the_row();
                                $price_number = get_sub_field('price_number');
                                $price_unit = get_sub_field('price_unit');
                                $priceContent = '<span class="threeTab__Detail--priceNum"><strong>$' . $price_number . '</strong></span>' .
                                '<span class="threeTab__Detail--priceUnit">' . $price_unit . '</span>';
                            endwhile;

                        endif;

                        $feature_list_title_str = '';
                        if ($feature_list_title):
                            $feature_list_title_str = '<p class="threeTab__Detail--subTitle">' . $feature_list_title . '</p>';
                        endif;

                        $li_feature_list = '';
                        while ( have_rows('feature_list') ) : the_row();
                            $if_link = get_sub_field('if_link');
                            $feature_point = get_sub_field('feature_point');
                            $feature_point_link = get_sub_field('feature_point_link');

                            if ($if_link):
                                $feature_point = '<a class="" href="' . $feature_point_link['url'] . '" target="' . $feature_point_link['target'] . '">' .
                                                    $feature_point_link['title'] .
                                                '</a>';
                            endif;

                            $li_feature_list .= '<li>' . $feature_point . '</li>';
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
                                $linkcontent = '<div class="threeTab__Detail--action"> ' . $linkcontent . ' </div>';
                            endif;
                        endif;

                        echo    '<div class="col-sm-4 threeTab__Detail--col">' .
                                    '<div class="threeTab__Detail--title threeTab__Detail--title--'.$color.'">' . $title . '</div>';

                            if ($priceContent) {
                                        echo '<div class="threeTab__Detail--price">' . $priceContent . '</div>';
                            }

                            echo $feature_list_title_str .
                                    '<ul class="threeTab__Detail--contentList">' .
                                        $li_feature_list .
                                    '</ul>' .
                                    $linkcontent .
                                '</div>';
                            endwhile;
                            echo '</div>';
                            echo '</div>';
                            // end pricing live chat details

                            // pricing multichannel details
                    $color = get_sub_field('color');
                    echo '<div class="threeTab__Detail  threeTab__Detail__' . $color . ' clearfix">';
                    echo $tabMobileMC;
                    echo '<div class="threeTab__Detail--col-wrap clearfix d-flex">';
                    $pricing_details_multichannel_note = get_sub_field('pricing_details_multichannel_note');
                    while ( have_rows('pricing_details_multichannel') ) : the_row();
                        $color = get_sub_field('color');
                        $title = get_sub_field('title');
                        $if_show_price = get_sub_field('if_show_price');
                        $price = get_sub_field('price');
                        $request_quote = get_sub_field('request_quote');
                        $feature_list_title = get_sub_field('feature_list_title');

                        // if (trim($feature_list_title, ' ') == ''):
                        //     $feature_list_title = '&nbsp;';
                        // endif;
                        $priceContent = '';

                        if ($request_quote) {
                            $priceContent = '<span class="threeTab__Detail--priceQuote"><strong>' . $request_quote . '</strong></span>';
                        }

                        if ($if_show_price):
                            while ( have_rows('price') ) : the_row();
                                $price_number = get_sub_field('price_number');
                                $price_unit = get_sub_field('price_unit');
                                $priceContent = '<span class="threeTab__Detail--priceNum"><strong>$' . $price_number . '</strong></span>' .
                                '<span class="threeTab__Detail--priceUnit">' . $price_unit . '</span>';
                            endwhile;

                        endif;

                        $feature_list_title_str = '';
                        if ($feature_list_title):
                            $feature_list_title_str = '<p class="threeTab__Detail--subTitle">' . $feature_list_title . '</p>';
                        endif;

                        $li_feature_list = '';
                        while ( have_rows('feature_list') ) : the_row();
                            $if_link = get_sub_field('if_link');
                            $feature_point = get_sub_field('feature_point');
                            $feature_point_link = get_sub_field('feature_point_link');

                            if ($if_link):
                                $feature_point = '<a class="" href="' . $feature_point_link['url'] . '" target="' . $feature_point_link['target'] . '">' .
                                                    $feature_point_link['title'] .
                                                '</a>';
                            endif;

                            $li_feature_list .= '<li>' . $feature_point . '</li>';
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
                                $linkcontent = '<div class="threeTab__Detail--action"> ' . $linkcontent . ' </div>';
                            endif;
                        endif;

                        echo    '<div class="col-sm-6 threeTab__Detail--col">' .
                                    '<div class="threeTab__Detail--title threeTab__Detail--title--'.$color.'">' . $title . '</div>';

                                    if ($priceContent) {
                                        echo '<div class="threeTab__Detail--price">' . $priceContent . '</div>';
                            }

                                    echo $feature_list_title_str .
                                    '<ul class="threeTab__Detail--contentList">' .
                                        $li_feature_list .
                                    '</ul>' .
                                    $linkcontent .
                                '</div>';

                    endwhile;


                    echo '</div>';

                    if ($pricing_details_multichannel_note) {
                        echo '<div class="threeTab__Detail--note">' . $pricing_details_multichannel_note . '</div>';
                    }

                    echo '</div>';
                    // end pricing multichannel details




                    // pricing AI multi-column details
                    if (get_sub_field('pricing_details_ai_repeater')) {
                        $color = get_sub_field('color');
                        echo '<div class="threeTab__Detail  threeTab__Detail__' . $color . ' clearfix">';
                        echo $tabMobileMC;
                        echo '<div class="threeTab__Detail--col-wrap clearfix d-flex">';
                        while ( have_rows('pricing_details_ai_repeater') ) : the_row();
                            $color = get_sub_field('color');
                            $title = get_sub_field('title');
                            $if_show_price = get_sub_field('if_show_price');
                            $price = get_sub_field('price');
                            $request_quote = get_sub_field('request_quote');
                            $feature_list_title = get_sub_field('feature_list_title');

                            // if (trim($feature_list_title, ' ') == ''):
                            //     $feature_list_title = '&nbsp;';
                            // endif;
                            $priceContent = '';

                            if ($request_quote) {
                                $priceContent = '<span class="threeTab__Detail--priceQuote"><strong>' . $request_quote . '</strong></span>';
                            }

                            if ($if_show_price):
                                while ( have_rows('price') ) : the_row();
                                    $price_number = get_sub_field('price_number');
                                    $price_unit = get_sub_field('price_unit');
                                    $priceContent = '<span class="threeTab__Detail--priceNum"><strong>$' . $price_number . '</strong></span>' .
                                    '<span class="threeTab__Detail--priceUnit">' . $price_unit . '</span>';
                                endwhile;

                            endif;

                            $feature_list_title_str = '';
                            if ($feature_list_title):
                                $feature_list_title_str = '<p class="threeTab__Detail--subTitle">' . $feature_list_title . '</p>';
                            endif;

                            $li_feature_list = '';
                            while ( have_rows('feature_list') ) : the_row();
                                $if_link = get_sub_field('if_link');
                                $feature_point = get_sub_field('feature_point');
                                $feature_point_link = get_sub_field('feature_point_link');

                                if ($if_link):
                                    $feature_point = '<a class="" href="' . $feature_point_link['url'] . '" target="' . $feature_point_link['target'] . '">' .
                                                        $feature_point_link['title'] .
                                                    '</a>';
                                endif;

                                $li_feature_list .= '<li>' . $feature_point . '</li>';
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
                                    $linkcontent = '<div class="threeTab__Detail--action"> ' . $linkcontent . ' </div>';
                                endif;
                            endif;

                            echo    '<div class="col-sm-6 threeTab__Detail--col">' .
                                        '<div class="threeTab__Detail--title threeTab__Detail--title--'.$color.'">' . $title . '</div>';

                                        if ($priceContent) {
                                            echo '<div class="threeTab__Detail--price">' . $priceContent . '</div>';
                                }

                                        echo $feature_list_title_str .
                                        '<ul class="threeTab__Detail--contentList">' .
                                            $li_feature_list .
                                        '</ul>' .
                                        $linkcontent .
                                    '</div>';

                        endwhile;


                        echo '</div>';
                        echo '</div>';
                        // end pricing AI multi-column details
                    } else {
                        // pricing AI details
                        while ( have_rows('pricing_details_ai') ) : the_row();
                            $color = get_sub_field('color');
                            $pricing_details_ai_title = get_sub_field('title');
                            $ai_logo = get_sub_field('ai_logo');
                            $feature_list_title = get_sub_field('feature_list_title');

                            $feature_list_title_str = '';
                            if ($feature_list_title):
                                $feature_list_title_str = '<p class="threeTab__Detail--subTitle">' . $feature_list_title . '</p>';
                            endif;

                            $ai_logo_content = '';
                            if ($ai_logo):
                                $ai_logo_content = '<div class="ai-logo-wrap">'.Assets\get_acf_image($ai_logo, '', 209, 276).'</div>';
                            endif;

                            $columnFirst = '';
                            while ( have_rows('column_first') ) : the_row();
                                $title = get_sub_field('title');
                                $li_feature_list = '';
                                while ( have_rows('feature_list') ) : the_row();
                                    $if_link = get_sub_field('if_link');
                                    $feature_point = get_sub_field('feature_point');
                                    $feature_point_link = get_sub_field('feature_point_link');

                                    if ($if_link):
                                        $feature_point = '<a class="" href="' . $feature_point_link['url'] . '" target="' . $feature_point_link['target'] . '">' .
                                                            $feature_point_link['title'] .
                                                        '</a>';
                                    endif;

                                    $li_feature_list .= '<li>' . $feature_point . '</li>';
                                endwhile;
                                $columnFirst = '<div class="col-sm-8 threeTab__Detail--col">' .
                                                $feature_list_title_str .
                                                '<ul class="threeTab__Detail--contentList">' .
                                                    $li_feature_list .
                                                '</ul>' .
                                            '</div>';
                            endwhile;



                            $columnSecond = '';
                            while ( have_rows('column_second') ) : the_row();
                                $price = get_sub_field('price');

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

                                $columnSecond = '<div class="col-sm-4 threeTab__Detail--col">' .
                                                    '<div class="threeTab__Detail--price">' .
                                                        '<span class="threeTab__Detail--priceQuote"><strong>' . $price . '</strong></span>' .
                                                    '</div>' .
                                                    '<div class="threeTab__Detail--action">' .
                                                        $linkcontent .
                                                    '</div>' .
                                                '</div>';


                                $if_show_price = get_sub_field('if_show_price');
                                $price = get_sub_field('price');
                                $request_quote = get_sub_field('request_quote');
                                $color = get_sub_field('color');
                                $priceContent = '';

                                if ($request_quote || $if_show_price) {
                                    $priceContent = '<div class="threeTab__Detail--price">';

                                    $priceContent .= '<span class="threeTab__Detail--priceQuote"><strong>' . $request_quote . '</strong></span>';

                                    if ($if_show_price):
                                        while ( have_rows('price') ) : the_row();
                                            $price_number = get_sub_field('price_number');
                                            $price_unit = get_sub_field('price_unit');
                                            $priceContent .= '<span class="threeTab__Detail--priceNum"><strong>$' . $price_number . '</strong></span>' .
                                            '<span class="threeTab__Detail--priceUnit">' . $price_unit . '</span>';
                                        endwhile;
                                    endif;

                                    $priceContent .= '</div>';
                                }
                                $color = get_sub_field('color');
                            endwhile;

                            echo    '<div class="threeTab__Detail  threeTab__Detail__' . $color . ' clearfix">' .
                                        $tabMobileAI .
                                        '<div class="threeTab__Detail--col-wrap clearfix">' .

                                            '<div class="threeTab__Detail--title threeTab__Detail--title--'.$color.'">' .
                                                $pricing_details_ai_title .
                                            '</div>' .
                                            $priceContent .
                                            $columnFirst .
                                            $columnSecond .
                                        '</div>' .
                                        $ai_logo_content .
                                    '</div>';

                        endwhile;
                        // end pricing AI details
                    }

                    echo '</div>';

                    $pricing_details_bottom_link = get_sub_field('pricing_details_bottom_link');
                    if ($pricing_details_bottom_link):
                        echo '<div class="threeTab__Detail--bottomLink">' .
                                '<a href="' . $pricing_details_bottom_link['url'] . '" target="' . $pricing_details_bottom_link['target'] . '">' .
                                    $pricing_details_bottom_link['title'] .
                                '</a>' .
                            '</div>';
                    endif;

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;
            endwhile;
        endif;
        // check if the flexible content field has rows of data
        if( have_rows('modules') ):

            // loop through the rows of data
            while ( have_rows('modules') ) : the_row();
                if( get_row_layout() == 'hero_banner' ):
                    $banner_type = get_sub_field('type');
                    $banner_size = get_sub_field('size');
                    $banner_align = get_sub_field('align');
                    $banner_icon = get_sub_field('icon');
                    // $page_tag = get_sub_field('page_tag');
                    $banner_headline = get_sub_field('h1_title');
                    $banner_slogan = get_sub_field('subtitle');
                    $banner_description = get_sub_field('description');
                    $banner_background_image = get_sub_field('background_image');
                    $banner_feature_image = get_sub_field('feature_image');

                    $style_bg = '';
                    if ($banner_type == 'responsive_feature'):
                        $style_bg = 'style="background: '.get_sub_field('background_colour').'"';
                    elseif ($banner_background_image):
                        $style_bg = 'style="background-image: url(' . $banner_background_image['url'] . ')"';
                    endif;
                    $banner_cta = get_sub_field('cta');

                    $banner_content_class = ($banner_type == 'responsive_feature' ? 'col-md-5' : 'col-sm-7');
                    $row_class = ($banner_type == 'responsive_feature' ? 'd-flex flex-wrap' : '');

                    echo '<div class="c-content-box c-size-lg c-margin-b-20 banner banner--'.$banner_type.' banner--' . $banner_size . ' banner--' . $banner_align . '" '  . $style_bg . '>';
                    echo '<div class="container">';
                    echo '<div class="row '. $row_class. '">';
                    echo '<div class="col content-col '.$banner_content_class.'">';

                    if ($banner_icon):
                        echo '<div class="banner_icon">'.Assets\get_acf_image($banner_icon, '', 64, 64).'</div>';
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

                    if ($banner_type == 'responsive_feature'):
                        echo '<div class="col image-col col-md-7">';
                        $featureImage = get_sub_field('feature_image');
                        echo '<img src="'.$featureImage['url'].'" alt="'.$featureImage['alt'].'" />';
                        echo '</div>';
                    endif;

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
                        echo '<div class="header_icon">'.Assets\get_acf_image($header_icon, '', 64, 64).'</div>';
                    endif;
                    if ($header_headline):
                        echo '<h1>' .
                                do_shortcode($header_headline) .
                            '</h1>';
                    endif;
                    if ($header_slogan):
                        echo '<p class="subtitle">' .
                                do_shortcode($header_slogan) .
                            '</p>';
                    endif;
                    if ($header_description):
                        echo '<div class="desc">' .
                            do_shortcode($header_description) .
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

                if( get_row_layout() == 'hero_banner_form' ):

                    $header_headline = get_sub_field('h1_title');
                    $header_slogan = get_sub_field('subtitle');
                    $header_background_image = get_sub_field('background_image');
                    $header_form_code = get_sub_field('form_code');
                    $form_note = get_sub_field('form_note');

                    $style_bg = '';
                    if ($header_background_image):
                        $style_bg = 'style="background-image: url(' . $header_background_image['url'] . ')"';
                    endif;


                    echo '<div class="c-content-box c-size-lg banner banner--requestdemo"' . $style_bg . '>';
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
                    if (!empty(trim($header_form_code))):
                        echo '<div class="row">' .
                                '<div class="col-sm-5">' .
                                    $header_form_code;

                        if (strpos($header_form_code, 'marketo-form.js') === false) {
                            echo '<script src="'.Assets\asset_path('scripts/marketo-form.js').'"></script>';
                        }

                        echo        '<div class="form-note">' . $form_note . '</div>'.
                                '</div>'.
                            '</div>';

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
                                    '<span aria-hidden="true">'.Assets\get_acf_image($featureImage, '', 50, 50).'</span>' .
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

                    $headline = get_sub_field('headline');

                    // check if the nested repeater field has rows of data
                    if( have_rows('cards') ):
                        echo '<div class="c-content-box c-size-md c-padding-t-0">';
                        echo '<div class="container">';
                        echo '<div class="row">';
                        echo '<div class="col-sm-12 card card--block card-col-' . $row_count . '">';


                        echo '<h3>' . $headline . '</h3>';
                            // loop through the rows of data
                        while ( have_rows('cards') ) : the_row();

                            $card_themecolor = get_sub_field('color');
                            $card_img = get_sub_field('icon');
                            $card_title = get_sub_field('title');
                            $card_subtitle = get_sub_field('subtitle');
                            $card_description = get_sub_field('description');

                            $card_subtitle_wrap = '';
                            if ($card_subtitle):
                                $card_subtitle_wrap = '<div class="card-item__subtitle">' . $card_subtitle . '</div>';
                            endif;


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

                            echo    '<div class="card-item card-item--platform card-item--' . $card_themecolor . '" data-link="' . $cta_link['url'] . '">' .
                                        '<div class="card__icon-wrap">'.Assets\get_acf_image($card_img, 'card__icon--small', 70, 70).'</div>' .
                                        '<h3>' . $card_title . '</h3>' .
                                        $card_subtitle_wrap .
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

                        $pondClass = 'single-line';

                        if (count($logo_repeater) >= 6) {
                            $pondClass = 'multi-line';
                        }

                        echo '<div class="container">';
                        echo '<div class="row">';
                        echo '<div class="c-content-client-logos-slider-1  c-bordered">';
                        echo '<div class="logo-pond d-flex flex-wrap align-items-center justify-content-center '. $pondClass .'">';
                            // loop through the rows of data
                        while ( have_rows('logo_repeater') ) : the_row();

                            $logo_image = get_sub_field('logo_image');

                            echo    '<div class="item">'.Assets\get_acf_image($logo_image, 'c-img-pos grayscale', 140, 180).'</div>';
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
                    $content_align = get_sub_field('content_alignment');
                    $feature_image = get_sub_field('feature_image');
                    $contentClass = 'col-sm-6';

                    if ($content_align == 'center') {
                        $contentClass = 'col-xs-12 col-sm-8 col-sm-offset-2 text-center';
                    }

                    $style_bg = '';
                    if ($bg_image):
                        $style_bg = 'style="background-image: url(' . $bg_image['url'] . ')"';
                    endif;

                    echo '<div class="c-content-box c-content-box--bg c-size-xlg promotion"' . $style_bg . '>';
                    echo '<div class="container">';
                    echo '<div class="row d-flex flex-wrap align-items-center">';
                    echo '<div class="col content-col '.$contentClass.'">';

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

                    $featureImage = get_sub_field('feature_image');

                    if ($featureImage):
                        echo '<div class="col image-col col-sm-6">';
                        echo '<img src="'.$featureImage['url'].'" alt="'.$featureImage['alt'].'" />';
                        echo '</div>';
                    endif;

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
                            $color = get_sub_field('color');
                            $cta = get_sub_field('cta');
                            $linkcontent = '';

                            $cta_link = '';

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

                            echo    '<div class="img-text-card img-text-card--' . $color . ' img-text-card--' . $image_position . ' clearfix" data-link="' . $cta_link['url'] . '">' .
                                        '<div class="img-text-card__img">'.Assets\get_acf_image($image).'</div>' .
                                        '<div class="img-text-card__text">' .
                                            '<h3 class="highlight highlight--' . $color . '">' . $headline . '</h3>' .
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
                        echo '<div class="c-content-box c-size-md c-content-box--' . $background_color . '">';
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
                                        '<div class="col-sm-6 ' . $push6 . ' img-text-column__img">'.Assets\get_acf_image($image).
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
                if( get_row_layout() == 'image-text_one_column' ):
                    $background_color = get_sub_field('background_color');
                    // check if the nested repeater field has rows of data
                    if( have_rows('image_text_column_repeater') ):

                        echo '<div class="c-content-box c-size-md c-content-box--' . $background_color . '">';
                        echo '<div class="container">';
                        echo '<div class="row">';
                            // loop through the rows of data
                        while ( have_rows('image_text_column_repeater') ) : the_row();
                            $anchor_id = get_sub_field('anchor_id');
                            $headline = get_sub_field('title');
                            $title_color = get_sub_field('title_color');
                            $body = get_sub_field('description');
                            $image = get_sub_field('image');
                            $cta = get_sub_field('cta');
                            $table_with_cta = get_sub_field('table_with_cta_-_3_column');

                            $anchor_id_content = '';
                            if ($anchor_id):
                                $anchor_id_content = 'id="' . $anchor_id . '"';
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

                            $tablecontent = '';

                            if ($table_with_cta):
                                while ( have_rows('table_with_cta_-_3_column') ) : the_row();
                                $tablecontent .= '<table class="table-select c-margin0auto" cellpadding="0" cellspacing="0">' .
                                '<tbody>';
                                if (have_rows('header')):
                                    $tablecontent .= '<tr>';
                                    while ( have_rows('header') ) : the_row();
                                    $header_content_1 = get_sub_field('header_content_1');
                                    $header_content_2 = get_sub_field('header_content_2');
                                    $header_content_3 = get_sub_field('header_content_3');
                                    $tablecontent .= '<th>' . $header_content_1 . '</th>' .
                                        '<th>' . $header_content_2 . '</th>' .
                                        '<th>' . $header_content_3 . '</th>';
                                    endwhile;
                                    $tablecontent .= '</tr>';
                                endif;

                                if (have_rows('content')):

                                    while ( have_rows('content') ) : the_row();
                                    $tablecontent .= '<tr>';
                                    $content_1 = get_sub_field('content_1');
                                    $content_2 = get_sub_field('content_2');
                                    $content_3 = get_sub_field('content_3');
                                    $tablecontent .= '<td>' . $content_1 . '</td>' .
                                        '<td>' . $content_2 . '</td>' .
                                        '<td>' . $content_3 . '</td>';
                                    $tablecontent .= '</tr>';
                                    endwhile;

                                endif;

                                if (have_rows('cta')):

                                    $tablecontent .= '<tr>';
                                    while ( have_rows('cta') ) : the_row();
                                        while ( have_rows('cta_1') ) : the_row();
                                            $cta_link_type = get_sub_field('cta_link_type');
                                            $cta_link = get_sub_field('cta_link');
                                            $tablecontent .= ctacontent($cta_link_type, $cta_link);
                                        endwhile;
                                        while ( have_rows('cta_2') ) : the_row();
                                            $cta_link_type = get_sub_field('cta_link_type');
                                            $cta_link = get_sub_field('cta_link');
                                            $tablecontent .= ctacontent($cta_link_type, $cta_link);
                                        endwhile;
                                        while ( have_rows('cta_3') ) : the_row();
                                            $cta_link_type = get_sub_field('cta_link_type');
                                            $cta_link = get_sub_field('cta_link');
                                            $tablecontent .= ctacontent($cta_link_type, $cta_link);
                                        endwhile;


                                    endwhile;
                                    $tablecontent .= '</tr>';
                                endif;

                                $tablecontent .= '</tbody></table>';
                                endwhile;
                            endif;

                            echo
                                    '<div ' . $anchor_id_content . ' class="col-sm-12 img-text">' .
                                        '<h3 class="highlight highlight--' . $title_color . '">' . $headline . '</h3>' .
                                        $body .
                                        '<div class="c-center">' . '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" />' . '</div>' .
                                        $linkcontent .
                                        $tablecontent .
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
                    $btn_group = get_sub_field('btn_group');


                    echo '<div class="c-content-box c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-10 col-sm-push-1 c-center">';

                    if ($headimage):
                        echo Assets\get_acf_image($headimage);
                    endif;

                    if ($headicon):
                        echo '<div class="header_icon">' .
                                Assets\get_acf_image($headicon, '', 64, 64) .
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

                    if ($btn_group):
                        while ( have_rows('btn_group') ) : the_row();
                            $type = get_sub_field('type');
                            $buttonColor = get_sub_field('button_color');
                            $groupClass = '';
                            $btnClass = 'btn-link';

                            if ($type == 'image') {
                                $groupClass .= 'd-flex justify-content-space-between';
                                $btnClass .= 'banner_cta_link btn btn-xlg btn-link--green w-100';
                            }

                            // check if the nested repeater field has rows of data
                            if( have_rows('btn_repeater') ):

                                echo '<div class="'.$groupClass.' btn-link-group c-margin-t-60 btn-color-'.$buttonColor.' btn-link-group--' . $type . '">';

                                    // loop through the rows of data
                                while ( have_rows('btn_repeater') ) : the_row();

                                    $btn_link = get_sub_field('button');

                                    if ($type == 'image') {
                                        echo '<div class="item text-center">';
                                    }

                                    if (get_sub_field('button_image')) {
                                        echo '<img src="'.get_sub_field('button_image')['url'].'" alt="'.get_sub_field('button_image')['alt'].'" style="max-width: 240px;" /><br/><br/><br/>';
                                    }

                                    echo  '<a href="' . $btn_link['url'] . '" target="' . $btn_link['target'] . '" class="'.$btnClass.'">' . $btn_link['title'] . '</a>';

                                    if ($type == 'image') {
                                        echo '</div>';
                                    }
                                endwhile;

                                echo '</div>';

                            endif;
                        endwhile;
                    endif;


                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                endif;

                // check current row layout
                if( get_row_layout() == 'stats_accordion' ):
                    $count = 0;

                    echo '<div class="c-content-box c-size-md">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="stats-panel-group panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            ';


                        while ( have_rows('stats_accordion') ) : the_row();
                            $accordionTitle = get_sub_field('title');

                            echo '<div class="panel">
                                <div class="panel-heading" role="tab" id="heading'.$count.'">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$count.'" aria-expanded="'.($count == 0 ? 'true' : 'false').'" aria-controls="collapse'.$count.'" class="d-block '.($count == 0 ? '' : 'collapsed').'">
                                            <img src="'.$accordionTitle['icon'].'" width="72" alt="'.$accordionTitle['title'].'" /> '.$accordionTitle['title'].'
                                            <svg class="toggle-icon version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="32" height="21" viewBox="0 0 32 21" style="enable-background:new 0 0 32 21;" xml:space="preserve"><polygon fill="#56C0EE" points="4.1,20.5 0,16.5 16,0.5 32,16.5 27.9,20.5 16,8.6 "/></svg>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse'.$count.'" class="panel-collapse collapse '.($count == 0 ? 'in' : '').'" role="tabpanel" aria-labelledby="heading'.$count.'">
                                    <div class="panel-body">';

                            $sectionCount = 0;

                            while ( have_rows('stat_sections') ) : the_row();
                                $titleClass = '';

                                if ($sectionCount > 0):
                                    $titleClass = 'c-margin-t-60';
                                endif;

                                echo '<h4 class="'.$titleClass.'">'.get_sub_field('title').'</h4>';

                                echo '<div class="row step-content d-flex flex-wrap statistics">';

                                while ( have_rows('stats') ) : the_row();
                                    $stat = get_sub_field('statistic');
                                    $statClass = '';

                                    $statistic = $stat['value'];

                                    if (array_key_exists('label', $stat)):
                                        $statistic .= ' <div class="label">'.$stat['label'].'</div>';
                                    endif;

                                    $source = '';

                                    if (get_sub_field('source')):
                                        $source = '<div class="footer"><small><a href="'.get_sub_field('source')['url'].'" class="text-light link-underline" target="_blank">'.get_sub_field('source')['title'].'</a></small></div>';

                                        $statClass .= ' with-footer ';
                                    endif;

                                    echo '<div class="col-xs-12 col-sm-6 col-md-4 stat-wrap '.$statClass.'">
                                        <div id="avg-rating" class="statistic">
                                            <div class="value-wrap">
                                                <span class="value">'.$statistic.'</span>
                                            </div>
                                            <div class="title">'.get_sub_field('description').'</div>
                                            '.$source.'
                                        </div>
                                    </div>';
                                endwhile;

                                echo '</div>';
                                $sectionCount++;
                            endwhile;

                            echo '</div>
                                </div>
                            </div>';

                            $count++;
                        endwhile;

                    echo '          </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                endif;

                /*
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Collapsible Group Item #1
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Collapsible Group Item #2
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Collapsible Group Item #3
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>
*/
                // check current row layout
                if( get_row_layout() == '2-column' ):
                    $rows = get_sub_field('columns');
                    $spacing = get_sub_field('column_spacing');
                    $sectionTitle = get_sub_field('section_title');
                    $row_count = count($rows);
                    $row_index = 0;
                    // check if the nested repeater field has rows of data
                    if( have_rows('columns') ):

                        echo '<div class="c-content-box c-size-md">';
                        echo '<div class="container">';
                        echo '<div class="row">';

                        if ($sectionTitle):
                            echo '<div class="col-sm-12 c-margin-b-60 text-center"><h4>'.$sectionTitle.'</h4></div>';
                        endif;

                        // loop through the rows of data
                        $colClass = '';

                        while ( have_rows('columns') ) : the_row();
                            $row_index++;

                            $colClass = 'col-sm-5';

                            if ($spacing == 'narrow'):
                                $colClass = 'col-sm-6';
                            endif;

                            if ($spacing != 'narrow' && $row_index == $row_count):
                                $colClass .= ' col-sm-push-2';
                            endif;

                            $headline = get_sub_field('headline');
                            $body = get_sub_field('body');
                            $icon = get_sub_field('icon');
                            $cta = get_sub_field('cta');

                            $headerIcon = '';
                            if ($icon):
                                $headerIcon = '<div class="header_icon">' .
                                                Assets\get_acf_image($icon, '', 64, 64) .
                                            '</div>';
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
                            endif;

                            echo    '<div class="' . $colClass . '">' .
                                        $headerIcon;

                            if ($headline):
                                echo '<h3>' . $headline . '</h3>';
                            endif;

                            echo    $body;

                            if ($linkcontent):
                                echo '<div class="c-margin-t-30">' . $linkcontent . '</div>';
                            endif;

                            echo '</div>';
                        endwhile;

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

                    endif;


                endif;

                // check current row layout
                if( get_row_layout() == 'testimonial' ):

                    $alignment = get_sub_field('alignment');
                    $background_image = get_sub_field('background_image');
                    $quote = get_sub_field('quote');
                    $signature = get_sub_field('signature');
                    $signature_image = get_sub_field('signature_image');
                    $story_link = get_sub_field('story_link');
                    $background_color = get_sub_field('background_color');

                    $colsType = '';
                    if ($alignment == 'left'):
                        $colsType = 'col-sm-7';
                    elseif ($alignment == 'center'):
                        $colsType = 'col-sm-10 col-sm-push-1';
                    endif;

                    $style_bg = '';
                    if ($background_image):
                        $style_bg = 'style="background-image: url(' . $background_image['url'] . ')"';
                    endif;

                    echo '<div class="c-content-box c-content-box__quote c-size-xlg c-content-box--' . $background_color . ' " ' . $style_bg . '>';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="' . $colsType . ' c-quote">';

                    if ($quote):
                        echo '<div class="c-quote__content">' .
                                $quote .
                            '</div>';
                    endif;

                    $signatureImage = '';
                    if ($signature_image):
                        $signatureImage = '<img src="' . $signature_image['url'] . '" alt="' . $signature_image['alt'] . '" width="80" height="80" />';
                    endif;

                    if ($signature):
                        echo '<div class="c-quote__signature">' .
                                $signatureImage .
                                $signature .
                            '</div>';
                    endif;
                    if ($story_link):
                        echo '<div class="c-quote__link">' .
                                '<a class="c-redirectLink" href="' . $story_link['url'] . '" target="' . $story_link['target'] . '">' .
                                    $story_link['title'] .
                                '</a>' .
                            '</div>';
                    endif;


                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;

                // check current row layout
                if( get_row_layout() == '3-column' ):

                    // check if the nested repeater field has rows of data
                    $title = get_sub_field('title');
                    if( have_rows('columns') ):

                        echo '<div class="c-content-box c-size-md">';
                        echo '<div class="container">';
                        echo '<div class="row">';


                        if ($title):
                            echo '<h3 class="three-column-title">' . $title . '</h3>';
                        endif;

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
                                        Assets\get_acf_image($icon, '', '', 80) .
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
                    $color = get_sub_field('color');
                    $title = get_sub_field('title');
                    // check if the nested repeater field has rows of data
                    if( have_rows('column') ):

                        echo '<div class="c-content-box c-size-md">';
                        echo '<div class="container">';
                        echo '<div class="row">';
                        echo '<div class="col-sm-12 feature-column">';
                            // loop through the rows of data
                        if ($title):
                            echo '<h3>' . $title . '</h3>';
                        endif;
                        while ( have_rows('column') ) : the_row();

                            $headline = get_sub_field('headline');
                            $body = get_sub_field('body');
                            $icon = get_sub_field('icon');


                            if ($linkcontent !== ''):
                                $linkcontent = '<div class="c-margin-t-30">' . $linkcontent . '</div>';
                            endif;

                            echo    '<div class="feature-column__item">' .
                                        '<div>'.Assets\get_acf_image($ai_logo, '', 60, 60).'</div>' .
                                        '<h5 class="feature-column__title highlight highlight--' . $color . '">' . $headline . '</h5>' .
                                        $body .
                                        $linkcontent .
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
                if( get_row_layout() == 'pricing' ):

                    $header_headline = get_sub_field('h1_title');
                    $header_slogan = get_sub_field('subtitle');

                    // check if the nested repeater field has rows of data
                    if( have_rows('pricing_tab') ):

                        echo '<div class="c-content-box c-size-md">';
                        echo '<div class="container">';
                        echo '<div class="row">';

                        echo '<div class="col-sm-12 c-center">' .
                                '<h1>' . $header_headline . '</h1>' .
                                '<h2>' .
                                    $header_slogan .
                                '</h2>' .
                            '</div>';

                        echo '<div class="col-sm-12">';
                        echo '<div class="threeTab__Index--Wrap clearfix" data-wheel="true">';
                            // loop through the rows of data

                        while ( have_rows('pricing_tab') ) : the_row();

                            $color = get_sub_field('color');
                            $tag = get_sub_field('tag');
                            $headline = get_sub_field('headline');
                            $body = get_sub_field('body');
                            $link = get_sub_field('link');

                            echo    '<div class="threeTab__Index threeTab__Index__' . $color . '">' .
                                        '<div class="product-item__tag product-item__tag--large product-item__tag' . $color . '">' . $tag . '</div>' .
                                        '<h3>' . $headline . '</h3>' .
                                        '<div class="threeTab__Index--desc">' .
                                            '<p class="product-item__desc"> ' . $body . ' </p>' .
                                            '<div class="threeTab__Index--link">' .
                                                '<a class="c-redirectLink" href="' . $link['url'] . '" target="' . $link['target'] . '">' .
                                                    $link['title'] .
                                                '</a>' .
                                            '</div>' .
                                        '</div>' .
                                    '</div>';

                        endwhile;

                        echo '</div>';
                        echo '<div class="threeTab__Detail-wrap">';

                        // pricing live chat details
                        echo '<div class="threeTab__Detail clearfix">';
                        while ( have_rows('pricing_details_live_chat') ) : the_row();
                            $color = get_sub_field('color');
                            $title = get_sub_field('title');
                            $if_show_price = get_sub_field('if_show_price');
                            $price = get_sub_field('price');
                            $request_quote = get_sub_field('request_quote');
                            $feature_list_title = get_sub_field('feature_list_title');

                            $priceContent = '';

                        if ($request_quote) {
                            $priceContent = '<span class="threeTab__Detail--priceQuote"><strong>' . $request_quote . '</strong></span>';
                        }

                        // $priceContent = '<span class="threeTab__Detail--priceQuote"><strong>' . $request_quote . '</strong></span>';
                            if ($if_show_price):
                                while ( have_rows('price') ) : the_row();
                                    $price_number = get_sub_field('price_number');
                                    $price_unit = get_sub_field('price_unit');
                                    $priceContent = '<span class="threeTab__Detail--priceNum"><strong>$' . $price_number . '</strong></span>' .
                                    '<span class="threeTab__Detail--priceUnit">' . $price_unit . '</span>';
                                endwhile;

                            endif;

                            $li_feature_list = '';
                            while ( have_rows('feature_list') ) : the_row();
                                $feature_point = get_sub_field('feature_point');

                                $li_feature_list .= '<li>' . $feature_point . '</li>';
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
                                    $linkcontent = '<div class="threeTab__Detail--action"> ' . $linkcontent . ' </div>';
                                endif;
                            endif;

                            echo    '<div class="col-sm-4 threeTab__Detail--col">' .
                                        '<div class="threeTab__Detail--title threeTab__Detail--title--'.$color.'">' . $title . '</div>';
                            if ($priceContent) {
                                        echo '<div class="threeTab__Detail--price">' . $priceContent . '</div>';
                            }
                            echo '<p class="threeTab__Detail--subTitle">' . $feature_list_title . '</p>' .
                                        '<ul class="threeTab__Detail--contentList">' .
                                            $li_feature_list .
                                        '</ul>' .
                                        $linkcontent .
                                    '</div>';

                        endwhile;

                        echo '</div>';
                        // end pricing live chat details

                        // pricing multichannel details
                        while ( have_rows('pricing_details_multichannel') ) : the_row();
                            $color = get_sub_field('color');
                            $pricing_details_multichannel_title = get_sub_field('title');

                            $columnFirst = '';
                            while ( have_rows('column_first') ) : the_row();
                                $title = get_sub_field('title');
                                $feature_list = '';
                                while ( have_rows('feature_list') ) : the_row();
                                    $feature_list .= '<li>' . get_sub_field('feature_point') . '</li>';
                                endwhile;
                                $columnFirst = '<div class="col-sm-4 threeTab__Detail--col">' .
                                                '<p class="threeTab__Detail--subTitle">' . $title . '</p>' .
                                                '<ul class="threeTab__Detail--contentList">' .
                                                    $feature_list .
                                                '</ul>' .
                                            '</div>';
                            endwhile;

                            $columnSecond = '';
                            while ( have_rows('column_second') ) : the_row();
                                $title = get_sub_field('title');
                                $feature_list = '';
                                while ( have_rows('feature_list') ) : the_row();
                                    $feature_list .= '<li>' . get_sub_field('feature_point') . '</li>';
                                endwhile;
                                $columnSecond = '<div class="col-sm-4 threeTab__Detail--col">' .
                                                '<p class="threeTab__Detail--subTitle">' . $title . '</p>' .
                                                '<ul class="threeTab__Detail--contentList">' .
                                                    $feature_list .
                                                '</ul>' .
                                            '</div>';
                            endwhile;

                            $columnThird = '';
                            while ( have_rows('column_third') ) : the_row();
                                $price_number = get_sub_field('price_number');
                                $price_unit = get_sub_field('price_unit');

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

                                $columnThird = '<div class="col-sm-4 threeTab__Detail--col">' .
                                                    '<div class="threeTab__Detail--price">' .
                                                        '<span class="threeTab__Detail--priceNum"><strong>$' . $price_number . '</strong></span>' .
                                                        '<span class="threeTab__Detail--priceUnit">' . $price_unit . '</span>' .
                                                    '</div>' .
                                                    '<div class="threeTab__Detail--action">' .
                                                        $linkcontent .
                                                    '</div>' .
                                                '</div>';
                            endwhile;

                            echo    '<div class="threeTab__Detail three clearfix">' .

                                        '<div class="threeTab__Detail--title threeTab__Detail--title--'.$color.'">' .
                                            $pricing_details_multichannel_title .
                                        '</div>' .

                                        $columnFirst .
                                        $columnSecond .
                                        $columnThird .
                                    '</div>';

                        endwhile;
                        // end pricing multichannel details


                        // pricing AI details
                        while ( have_rows('pricing_details_ai') ) : the_row();
                            $color = get_sub_field('color');
                            $pricing_details_ai_title = get_sub_field('title');

                            $columnFirst = '';
                            while ( have_rows('column_first') ) : the_row();
                                $title = get_sub_field('title');
                                $feature_list = '';
                                while ( have_rows('feature_list') ) : the_row();
                                    $feature_list .= '<li>' . get_sub_field('feature_point') . '</li>';
                                endwhile;
                                $columnFirst = '<div class="col-sm-4 threeTab__Detail--col">' .
                                                '<p class="threeTab__Detail--subTitle">' . $title . '</p>' .
                                                '<ul class="threeTab__Detail--contentList">' .
                                                    $feature_list .
                                                '</ul>' .
                                            '</div>';
                            endwhile;

                            $columnSecond = '';
                            while ( have_rows('column_second') ) : the_row();
                                $title_01 = get_sub_field('title_01');
                                $feature_list_01 = '';
                                while ( have_rows('feature_list_01') ) : the_row();
                                    $feature_list_01 .= '<li>' . get_sub_field('feature_point') . '</li>';
                                endwhile;

                                $title_02 = get_sub_field('title_02');
                                $feature_list_02 = '';
                                while ( have_rows('feature_list_02') ) : the_row();
                                    $feature_list_02 .= '<li>' . get_sub_field('feature_point') . '</li>';
                                endwhile;

                                $columnSecond = '<div class="col-sm-4 threeTab__Detail--col">' .
                                                '<p class="threeTab__Detail--subTitle">' . $title_01 . '</p>' .
                                                '<ul class="threeTab__Detail--contentList">' .
                                                    $feature_list_01 .
                                                '</ul>' .
                                                '<p class="threeTab__Detail--subTitle">' . $title_02 . '</p>' .
                                                '<ul class="threeTab__Detail--contentList">' .
                                                    $feature_list_02 .
                                                '</ul>' .
                                            '</div>';
                            endwhile;

                            $columnThird = '';
                            while ( have_rows('column_third') ) : the_row();
                                $price = get_sub_field('price');

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

                                $columnThird = '<div class="col-sm-4 threeTab__Detail--col">' .
                                                    '<div class="threeTab__Detail--price">' .
                                                        '<span class="threeTab__Detail--priceQuote"><strong>' . $price . '</strong></span>' .
                                                    '</div>' .
                                                    '<div class="threeTab__Detail--action">' .
                                                        $linkcontent .
                                                    '</div>' .
                                                '</div>';
                            endwhile;

                            echo    '<div class="threeTab__Detail three clearfix">' .

                                        '<div class="threeTab__Detail--title threeTab__Detail--title--'.$color.'">' .
                                            $pricing_details_ai_title .
                                        '</div>' .

                                        $columnFirst .
                                        $columnSecond .
                                        $columnThird .
                                    '</div>';

                        endwhile;
                        // end pricing AI details


                        echo '</div>';

                        $pricing_details_bottom_link = get_sub_field('pricing_details_bottom_link');
                        if ($pricing_details_bottom_link):
                            echo '<div class="threeTab__Detail--bottomLink">' .
                                    '<a href="' . $pricing_details_bottom_link['url'] . '" target="' . $pricing_details_bottom_link['target'] . '">' .
                                        $pricing_details_bottom_link['title'] .
                                    '</a>' .
                                '</div>';
                        endif;

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

                    endif;


                endif;


                // check current row layout
                if( get_row_layout() == 'feature_list' ):
                    if( have_rows('feature_list_repeater') ):

                        echo '<div class="c-content-box">';
                        echo '<div class="container">';
                        echo '<div class="row">';
                        echo '<div class="col-sm-12">';
                        while ( have_rows('feature_list_repeater') ) : the_row();
                            $feature_list_header = get_sub_field('feature_list_header');
                            if ($feature_list_header):
                                echo '<div class="featurelist-header-container">';
                                echo '<div class="featurelist-header clearfix">';
                                while ( have_rows('feature_list_header') ) : the_row();
                                    $feature_list_header_feature_name = get_sub_field('feature_list_header_feature_name');
                                    if ($feature_list_header_feature_name):
                                        echo '<span class="featurelist-content">' . $feature_list_header_feature_name . '</span>';
                                    endif;

                                    $feature_list_header_plan = get_sub_field('feature_list_header_plan');
                                    if ( have_rows('feature_list_header_plan') ):
                                        while ( have_rows('feature_list_header_plan') ) : the_row();
                                            $plan_name = get_sub_field('plan_name');
                                            echo '<span class="featurelist-plan">' . $plan_name . '</span>';
                                        endwhile;
                                    endif;
                                endwhile;
                                echo '</div>';
                                echo '</div>';
                            endif;

                            $feature_list_content = get_sub_field('feature_list_content');
                            if( have_rows('feature_list_content') ):
                                echo '<div class="featurelist clearfix">';
                                while ( have_rows('feature_list_content') ) : the_row();
                                    echo '<ul class="clearfix">';
                                    $feature_list_content_feature = get_sub_field('feature_list_content_feature');
                                    if ($feature_list_content_feature):
                                        while ( have_rows('feature_list_content_feature') ) : the_row();
                                            $if_link = get_sub_field('if_link');
                                            $name_link = get_sub_field('name_link');
                                            $name_text = get_sub_field('name_text');
                                            $featurename = '';
                                            if ($if_link):
                                                $featurename = '<a href="' . $name_link['url'] . '" target="' . $name_link['target'] . '">' . $name_link['title'] . '</a>';
                                            else:
                                                $featurename = $name_text;
                                            endif;

                                            $tooltip = get_sub_field('tooltip');
                                            echo '<li class="option-title tooltips" data-placement="right" title="" data-original-title="' . $tooltip . '">' .
                                                    $featurename .
                                                '</li>';
                                        endwhile;
                                    endif;

                                    $featurecontentTeam = '&nbsp;';
                                    $featurecontentBusiness = '&nbsp;';
                                    $featurecontentEnt = '&nbsp;';
                                    $if_show_tick = get_sub_field('if_show_tick');
                                    if ($if_show_tick):
                                        $feature_list_content_if_team_have = get_sub_field('feature_list_content_if_team_have');
                                        $feature_list_content_if_business_have = get_sub_field('feature_list_content_if_business_have');
                                        $feature_list_content_if_ent_have = get_sub_field('feature_list_content_if_ent_have');

                                        if ($feature_list_content_if_team_have):
                                            $featurecontentTeam = '<i class="fa fa-check c-font-20"></i>';
                                        endif;
                                        if ($feature_list_content_if_business_have):
                                            $featurecontentBusiness = '<i class="fa fa-check c-font-20"></i>';
                                        endif;
                                        if ($feature_list_content_if_ent_have):
                                            $featurecontentEnt = '<i class="fa fa-check c-font-20"></i>';
                                        endif;
                                    else:
                                        $featurecontentTeam = get_sub_field('feature_list_content_for_team') == '' ? '&nbsp;' : get_sub_field('feature_list_content_for_team');
                                        $featurecontentBusiness = get_sub_field('feature_list_content_for_business') == '' ? '&nbsp;' : get_sub_field('feature_list_content_for_business');
                                        $featurecontentEnt = get_sub_field('feature_list_content_for_ent') == '' ? '&nbsp;' : get_sub_field('feature_list_content_for_ent');
                                    endif;


                                    echo '<li>' . $featurecontentTeam . '</li>';
                                    echo '<li>' . $featurecontentBusiness . '</li>';
                                    echo '<li>' . $featurecontentEnt . '</li>';

                                    echo '</ul>';
                                endwhile;
                                echo '</div>';
                            endif;

                        endwhile;
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    endif;
                endif;

                // check current row layout
                if( get_row_layout() == 'feature_list_for_all' ):
                    echo '<div class="c-content-box">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12">';
                    if ( have_rows('feature_list_tab') ):
                        echo '<div class="threeTab__Index--Wrap threeTab__Index--featurelistWrap clearfix">';
                        while ( have_rows('feature_list_tab') ) : the_row();
                            $if_selected = get_sub_field('if_selected');
                            $tag = get_sub_field('tag');
                            $tab_name = get_sub_field('tab_name');
                            $color = get_sub_field('color');
                            $selectedClass = $if_selected ? 'selected' : '';


                            echo '<div class="threeTab__Index threeTab__Index__' . $color . ' ' . $selectedClass . '">' .
                                    '<div class="product-item__tag product-item__tag--large product-item__tag' . $color . '">' . $tag . '</div>' .
                                    '<h3>' . $tab_name . '</h3>' .
                                '</div>';
                        endwhile;
                        echo '</div>';
                    endif;
                    if( have_rows('feature_list_repeater') ):
                        while ( have_rows('feature_list_repeater') ) : the_row();
                            echo '<div class="featurelist-wrap">';

                            $feature_list_header = get_sub_field('feature_list_header');
                            if ($feature_list_header):
                                while ( have_rows('feature_list_header') ) : the_row();
                                    if ( have_rows('feature_list_header_plan') ):
                                        echo '<div class="featurelist-header-container">';
                                            echo '<div class="featurelist-header clearfix">';
                                                echo '<span class="featurelist-content">&nbsp;</span>';
                                                while ( have_rows('feature_list_header_plan') ) : the_row();
                                                    echo '<span class="featurelist-plan">' . get_sub_field('plan_name') . '</span>';
                                                endwhile;
                                            echo '</div>';
                                        echo '</div>';
                                    endif;

                                    $feature_list_header_note = get_sub_field('feature_list_header_note');
                                    if ($feature_list_header_note):
                                        echo '<div class="featurelist-note">'. $feature_list_header_note .'</div>';
                                    endif;
                                endwhile;
                            endif;

                            $feature_list_content = get_sub_field('feature_list_content');
                            if( have_rows('feature_list_content') ):
                                echo '<div class="featurelist clearfix">';

                                while ( have_rows('feature_list_content') ) : the_row();
                                    echo '<div class="featurelist-type">';
                                    $feature_name = get_sub_field('feature_name');
                                    if ($feature_name):
                                        echo '<div class="featurelist-title">' . $feature_name . '</div>';
                                    endif;

                                    echo '<div class="featurelist-content">';

                                        while ( have_rows('feature_content') ) : the_row();
                                        echo '<ul class="clearfix">';
                                        $feature_list_content_feature = get_sub_field('feature_list_content_feature');
                                        if ($feature_list_content_feature):
                                            while ( have_rows('feature_list_content_feature') ) : the_row();
                                                $if_link = get_sub_field('if_link');
                                                $name_link = get_sub_field('name_link');
                                                $name_text = get_sub_field('name_text');
                                                $featurename = '';
                                                if ($if_link):
                                                    $featurename = '<a href="' . $name_link['url'] . '" target="' . $name_link['target'] . '">' . $name_link['title'] . '</a>';
                                                else:
                                                    $featurename = $name_text;
                                                endif;

                                                $tooltip = get_sub_field('tooltip');
                                                echo '<li class="option-title tooltips" data-placement="right" title="" data-original-title="' . $tooltip . '">' .
                                                        $featurename .
                                                    '</li>';
                                            endwhile;
                                        endif;

                                        $featurecontentTeam = '&nbsp;';
                                        $featurecontentBusiness = '&nbsp;';
                                        $featurecontentEnt = '&nbsp;';
                                        $if_show_tick = get_sub_field('if_show_tick');
                                        if ($if_show_tick):
                                            $feature_list_content_if_team_have = get_sub_field('feature_list_content_if_team_have');
                                            $feature_list_content_if_business_have = get_sub_field('feature_list_content_if_business_have');
                                            $feature_list_content_if_ent_have = get_sub_field('feature_list_content_if_ent_have');

                                            if ($feature_list_content_if_team_have):
                                                $featurecontentTeam = '<i class="fa fa-check c-font-20"></i>';
                                            endif;
                                            if ($feature_list_content_if_business_have):
                                                $featurecontentBusiness = '<i class="fa fa-check c-font-20"></i>';
                                            endif;
                                            if ($feature_list_content_if_ent_have):
                                                $featurecontentEnt = '<i class="fa fa-check c-font-20"></i>';
                                            endif;
                                        else:
                                            $featurecontentTeam = get_sub_field('feature_list_content_for_team') == '' ? '&nbsp;' : get_sub_field('feature_list_content_for_team');
                                            $featurecontentBusiness = get_sub_field('feature_list_content_for_business') == '' ? '&nbsp;' : get_sub_field('feature_list_content_for_business');
                                            $featurecontentEnt = get_sub_field('feature_list_content_for_ent') == '' ? '&nbsp;' : get_sub_field('feature_list_content_for_ent');
                                        endif;


                                        echo '<li>' . $featurecontentTeam . '</li>';
                                        echo '<li>' . $featurecontentBusiness . '</li>';
                                        echo '<li>' . $featurecontentEnt . '</li>';
                                        echo '</ul>';
                                        endwhile;

                                    echo '</div>';
                                    echo '</div>';
                                endwhile;
                                echo '</div>';

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
                if( get_row_layout() == 'frequent_questions' ):

                    $title = get_sub_field('title');
                    // check if the nested repeater field has rows of data
                    if( have_rows('questions') ):

                        echo '<div class="c-content-box c-size-md">';
                        echo '<div class="container">';
                        echo '<div class="row">';
                        echo '<div class="col-sm-12">';
                            // loop through the rows of data

                        echo '<h3 class="c-center">' . $title . '</h3>';
                        echo '<div class="questions">';

                        while ( have_rows('questions') ) : the_row();

                            $question_title = get_sub_field('question_title');
                            $question_content = get_sub_field('question_content');



                            echo    '<div class="question-item">' .
                                        '<div class="question-item__title">' . $question_title . '</div>' .
                                        '<div class="question-item__content">' . $question_content . '</div>' .
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
                        echo Assets\get_acf_image($logo);
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
                if( get_row_layout() == 'leads_form' && !empty(trim(get_sub_field('form')))):
                    $title = get_sub_field('title');
                    $form = get_sub_field('form');
                    $form_note = get_sub_field('form_note');

                    echo '<div class="c-content-box c-size-md">' .
                            '<div class="container">' .
                                '<div class="row">' .
                                    '<div class="col-sm-6 col-sm-push-3">' .
                                        '<div class="leads-form">' .
                                            '<h3 class="highlight highlight--blue">' . $title . '</h3>' .
                                            $form;

                    if (strpos($form, 'marketo-form.js') === false) {
                        echo '<script src="'.Assets\asset_path('scripts/marketo-form.js').'"></script>';
                    }

                    echo                    '<div class="form-note">' . $form_note . '</div>'.
                                        '</div>' .
                                    '</div>' .
                                '</div>' .
                            '</div>' .
                        '</div>';

                endif;

                // check current row layout
                if( get_row_layout() == 'partner_form' ):
                    $image = get_sub_field('image');
                    $title = get_sub_field('title');
                    $contact_form = get_sub_field('contact_form');
                    $form_note = get_sub_field('form_note');

                    echo '<div class="c-content-box c-size-md">' .
                            '<div class="container">' .
                                '<div class="row">' .

                                    '<div class="col-sm-5">'.Assets\get_acf_image($image, '', 380, 380).'</div>' .
                                    '<div class="col-sm-7">' .
                                        '<div class="contact-form">' .
                                            '<h3 class="highlight highlight--blue">' . $title . '</h3>';

                    if (!empty(trim($contact_form))) {
                        echo $contact_form;

                        if (strpos($contact_form, 'marketo-form.js') === false) {
                            echo '<script src="'.Assets\asset_path('scripts/marketo-form.js').'"></script>';
                        }
                    }

                    echo                    '<div class="form-note">' . $form_note . '</div>'.
                                        '</div>' .
                                    '</div>' .

                                '</div>' .
                            '</div>' .
                        '</div>';

                endif;

                // check current row layout
                if( get_row_layout() == '2-columns_form' ):
                    $title = get_sub_field('title');
                    $description = get_sub_field('description');
                    $form = get_sub_field('form');
                    $form_note = get_sub_field('form_note');

                    $title_container = '';
                    if ($title):
                        $title_container = '<h3 class="highlight highlight--blue">' . $title . '</h3>';
                    endif;

                    $desc_container = '';
                    if ($description):
                        $desc_container = '<div class="two-columns-form__desc">' . $description . '</div>';
                    endif;


                    echo '<div class="c-content-box c-size-md">' .
                            '<div class="container">' .
                                '<div class="row">' .
                                    '<div class="col-sm-10 col-sm-push-1">' .
                                        '<div class="two-columns-form">' .
                                            $desc_container .
                                            $title_container;

                    if (!empty(trim($form))) {
                        echo $form;

                        if (strpos($form, 'marketo-form.js') === false) {
                            echo '<script src="'.Assets\asset_path('scripts/marketo-form.js').'"></script>';
                        }
                    }

                    echo                    '<div class="form-note">' . $form_note . '</div>'.
                                        '</div>' .
                                    '</div>' .
                                '</div>' .
                            '</div>' .
                        '</div>';

                endif;

                // check current row layout
                if( get_row_layout() == 'compare_list' ):
                    $title = get_sub_field('title');
                    echo '<div class="c-content-box c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12 comparelist">';
                    echo '<h3>' . $title . '</h3>';
                    echo '<div class="threeTab__Detail-wrap">';
                    echo '<div class="threeTab__Detail three clearfix">';
                    echo '<div class="threeTab__Detail--col-wrap clearfix">';

                    while ( have_rows('feature_list') ) : the_row();
                        $color = get_sub_field('color');
                        $compare_name = get_sub_field('compare_name');
                        $feature_list_title = get_sub_field('feature_list_title');

                        $if_show_price = get_sub_field('if_show_price');
                        $request_quote = get_sub_field('request_quote');

                        $priceContent = '';
                        if ($request_quote):
                            $priceContent = '<div class="threeTab__Detail--price"><span class="threeTab__Detail--priceQuote"><strong>' . $request_quote . '</strong></span></div>';
                        endif;

                        if ($if_show_price):
                            while ( have_rows('price') ) : the_row();
                                $price_number = get_sub_field('price_number');
                                $price_unit = get_sub_field('price_unit');
                                $regular_price = get_sub_field('regular_price');
                                $regular_price_str = '';
                                if ( $regular_price ):
                                    $regular_price_str = '<span class="threeTab__Detail--regularPrice">' . $regular_price . '</span>';
                                endif;
                                if ($price_number):
                                    $priceContent = '<div class="threeTab__Detail--price">' .
                                            $regular_price_str .
                                            '<span class="threeTab__Detail--priceNum"><strong>$' . $price_number . '</strong></span>' .
                                            '<span class="threeTab__Detail--priceUnit">' . $price_unit . '</span>' .
                                        '</div>';
                                endif;
                            endwhile;

                        endif;

                        echo '<div class="col-sm-6 threeTab__Detail--col">' .
                            '<div class="threeTab__Detail--title threeTab__Detail--title--' . $color . '">' . $compare_name . '</div>' .
                            $priceContent .
                            '<p class="threeTab__Detail--subTitle"> ' . $feature_list_title . ' </p>' .
                            '<ul class="threeTab__Detail--contentList">';
                        while ( have_rows('feature_pointer_list') ) : the_row();

                            echo '<li>' . get_sub_field('feature_pointer') . '</li>';
                        endwhile;
                        echo '</ul>' .
                            '</div>';
                    endwhile;

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;

                // check current row layout
                if( get_row_layout() == 'line' ):

                    $height = get_sub_field('height');
                    $color = get_sub_field('color');
                    $background_color = get_sub_field('background_color');

                    echo '<div class="c-content-box c-content-box--' . $background_color . '">';
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

                // check current row layout
                if( get_row_layout() == 'book_a_demo' ):



                    echo '<div class="c-content-box c-size-md c-content-box--grey">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12">';

                    $calendly_content = get_sub_field('calendly_content');
                    if ($calendly_content):
                        while ( have_rows('calendly_content') ) : the_row();
                            $h1_title = get_sub_field('h1_title');
                            $h2_title = get_sub_field('h2_title');
                            $description = get_sub_field('description');
                            $schedule_code = get_sub_field('schedule_code');
                            echo '<div id="inServiceCountry" class="book-demo" style="display: none">';
                                if ($h1_title):
                                    echo '<h1>' .
                                            $h1_title .
                                        '</h1>';
                                endif;
                                if ($h2_title):
                                    echo '<h2>' .
                                            $h2_title .
                                        '</h2>';
                                endif;
                                if ($description):
                                    echo '<div class="book-demo__desc">' .
                                            $description .
                                        '</div>';
                                endif;
                                if ($schedule_code):
                                    echo '<div class="row">' .
                                            '<div class="col-sm-push-1 col-sm-10">' .
                                                '<div class="book-demo__calendly">' .
                                                    $schedule_code .
                                                '</div>' .
                                            '</div>' .
                                        '</div>';
                                endif;
                            echo '</div>';
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
                if( get_row_layout() == 'feature_bullet' ):

                    $title = get_sub_field('title');
                    $bullet_list = get_sub_field('bullet_list');


                    echo '<div class="c-content-box">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12">';

                    if ($title):
                        echo '<div class="feature__bullet__title">' . $title . '</div>';
                    endif;

                    if (have_rows('bullet_list')):
                        echo '<ul class="feature__bullet__link c-content-list-1 c-theme c-separator-dot clearfix">';
                        while ( have_rows('bullet_list') ) : the_row();
                            $anchor = get_sub_field('anchor');
                            $anchor_text = get_sub_field('anchor_text');
                            echo '<li>' .
                                    '<a href="#' . $anchor . '">' .
                                        $anchor_text .
                                    '</a>' .
                                '</li>';
                        endwhile;
                        echo '</ul>';
                    endif;



                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;

                // check current row layout
                if( get_row_layout() == 'resource_download' ):

                    $background_color = get_sub_field('background_color');

                    echo '<div class="c-content-box c-size-md c-content-box--' . $background_color . '">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12 resource-download">';

                    $image = get_sub_field('image');
                    $title = get_sub_field('title');
                    $description = get_sub_field('description');
                    $download_link = get_sub_field('download_link');

                    $download_detail = '<h3>' . $title . '</h3>' .
                                        $description .
                                        '<div class="c-margin-t-40">' .
                                            '<a class="btn btn-xlg btn-link--green" href="' . $download_link['url'] . '" target="' . $download_link['target'] . '">' .
                                                $download_link['title'] .
                                            '</a>' .
                                        '</div>';

                    if ($image):

                        echo '<div class="resource-download__img">' .
                                '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '"/>' .
                            '</div>' .
                            '<div class="resource-download__content">' .
                                $download_detail .
                            '</div>';
                    else:
                        echo $download_detail;
                    endif;



                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                endif;

                // check current row layout
                if( get_row_layout() == 'share_this' ):

                    $title = get_sub_field('title');
                    $share_this_code = get_sub_field('share_this_code');

                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12">';
                        echo '<div class="social-share">';
                        echo '<h3 style="line-height: 1.285714em;">' . $title . '</h3>';
                        echo $share_this_code;
                        echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4e2faac9507104da"></script>
                    ';
                endif;

                // check current row layout
                if( get_row_layout() == 'video' ):
                    echo '<div class="c-content-box c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-push-1 col-sm-10 video-content">';
                    echo get_sub_field('video');
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                endif;

                // check current row layout
                if( get_row_layout() == 'note' ):
                    echo '<div class="c-content-box c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12 note c-background--gray">';
                    echo get_sub_field('note');
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                endif;

                // check current row layout
                if( get_row_layout() == 'related_articles' ):
                    echo '<div class="c-content-box c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12">';
                    $title = get_sub_field('title');

                    echo '<h3>' . $title . '</h3>';
                    if (have_rows('article_list')):
                        echo '<ul class="c-content-list-1 c-theme c-separator-dot">';
                        while ( have_rows('article_list') ) : the_row();
                            $article_list_link = get_sub_field('article_list_link');
                            echo '<li>' .
                                    '<a href="' . $article_list_link['url'] . '" target="' . $article_list_link['target'] . '">' .
                                        $article_list_link['title'] .
                                    '</a>' .
                                '</li>';
                        endwhile;
                        echo '</ul>';
                    endif;

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                endif;

                // check current row layout
                if( get_row_layout() == 'table_with_cta_-_3_column' ):
                    echo '<div class="c-content-box">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12">';

                    echo '<table class="table-select c-margin0auto" cellpadding="0" cellspacing="0">' .
                                '<tbody>';
                    if (have_rows('header')):
                        echo '<tr>';
                        while ( have_rows('header') ) : the_row();
                        $header_content_1 = get_sub_field('header_content_1');
                        $header_content_2 = get_sub_field('header_content_2');
                        $header_content_3 = get_sub_field('header_content_3');
                        echo '<th>' . $header_content_1 . '</th>' .
                            '<th>' . $header_content_2 . '</th>' .
                            '<th>' . $header_content_3 . '</th>';
                        endwhile;
                        echo '</tr>';
                    endif;

                    if (have_rows('content')):

                        while ( have_rows('content') ) : the_row();
                        echo '<tr>';
                        $content_1 = get_sub_field('content_1');
                        $content_2 = get_sub_field('content_2');
                        $content_3 = get_sub_field('content_3');
                        echo '<td>' . $content_1 . '</td>' .
                            '<td>' . $content_2 . '</td>' .
                            '<td>' . $content_3 . '</td>';
                        echo '</tr>';
                        endwhile;

                    endif;

                    if (have_rows('cta')):

                        echo '<tr>';
                        while ( have_rows('cta') ) : the_row();
                            while ( have_rows('cta_1') ) : the_row();
                                $cta_link_type = get_sub_field('cta_link_type');
                                $cta_link = get_sub_field('cta_link');
                                echo ctacontent($cta_link_type, $cta_link);
                            endwhile;
                            while ( have_rows('cta_2') ) : the_row();
                                $cta_link_type = get_sub_field('cta_link_type');
                                $cta_link = get_sub_field('cta_link');
                                echo ctacontent($cta_link_type, $cta_link);
                            endwhile;
                            while ( have_rows('cta_3') ) : the_row();
                                $cta_link_type = get_sub_field('cta_link_type');
                                $cta_link = get_sub_field('cta_link');
                                echo ctacontent($cta_link_type, $cta_link);
                            endwhile;


                        endwhile;
                        echo '</tr>';
                    endif;

                    echo '</tbody></table>';

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                endif;

                // check current row layout
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

                                    echo    '<div class="threeTab__Index threeTab__Index__' . $color . '">' .
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

                                    echo    '<div class="threeTab__Detail three clearfix">' .
                                                $tabMobileAI .
                                                '<div class="threeTab__Detail--col-wrap clearfix">' .

                                                    '<div class="threeTab__Detail--title threeTab__Detail--title--'.$color.'">' . $title . '</div>' .
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
                                            '<h3 class="highlight highlight--blue">' . $title . '</h3>';

                    if (!empty(trim($contact_form))) {
                        echo $contact_form;

                        if (strpos($contact_form, 'marketo-form.js') === false) {
                            echo '<script src="'.Assets\asset_path('scripts/marketo-form.js').'"></script>';
                        }
                    }

                    echo                    '<div class="form-note">' . $form_note . '</div>'.
                                        '</div>' .
                                    '</div>' .

                                '</div>' .
                            '</div>' .
                        '</div>';

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
                            do_shortcode($header_headline) .
                            '</h1>';
                    endif;
                    if ($header_slogan):
                        echo '<h2 class="c-margin-t-20">' .
                            do_shortcode($header_slogan) .
                            '</h2>';
                    endif;
                    if ($header_description):
                        echo '<div class="thankyou__desc">' .
                            do_shortcode($header_description) .
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

                // check current row layout
                if( get_row_layout() == 'landing_context' ):
                    if( have_rows('paragraph_repeater') ):
                        echo '<div class="c-content-box c-size-md">' .
                                    '<div class="container">' .
                                        '<div class="row">' .
                                            '<div class="col-sm-12">' .
                                                '<div class="landingContent">';
                                                    while ( have_rows('paragraph_repeater') ) : the_row();
                                                        echo get_sub_field('paragraph');
                                                    endwhile;
                        echo                    '</div>' .
                                            '</div>' .
                                        '</div>' .
                                    '</div>' .
                                '</div>';
                    endif;
                endif;

                // check current row layout
                if( get_row_layout() == 'icon_content_list' ):
                    if( have_rows('icon_content_list_repeater') ):
                        echo '<div class="c-content-box">' .
                                    '<div class="container">' .
                                        '<div class="row">' .
                                            '<div class="col-sm-12">' .
                                                '<div class="icon-content-list">';
                        while ( have_rows('icon_content_list_repeater') ) : the_row();
                            $icon = get_sub_field('icon');
                            $title = get_sub_field('title');
                            $content = get_sub_field('content');

                            echo '<div class="icon-content-list__element clearfix">' .
                                    '<div class="icon-content-list__icon">' .
                                        '<img src="' . $icon['url'] . '" alt="' . $icon['alt'] . '" width="50" height="50" />' .
                                    '</div>' .
                                    '<div class="icon-content-list__content">' .
                                        '<div class="icon-content-list__title">' .
                                            '<strong>' . $title . '</strong>' .
                                        '</div>' .
                                        '<div class="icon-content-list__desc">' .
                                            $content .
                                        '</div>' .
                                    '</div>' .
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
                if( get_row_layout() == 'sticky_content' ):
                    $distance_of_top = get_sub_field('distance_of_top');
                    echo '<div class="c-content-box">' .
                            '<div class="container">' .
                                '<div class="row">' .
                                    '<div class="col-sm-12" style="margin-top: ' . $distance_of_top . 'px">';

                                    if( have_rows('sticky_nav') ):
                                        echo '<nav class="nav--sticky hidden-xs">' .
                                                '<ul>';
                                        while ( have_rows('sticky_nav') ) : the_row();
                                            $if_divider = get_sub_field('if_divider');
                                            $sticky_nav_element_text = get_sub_field('sticky_nav_element_text');
                                            $anchor = get_sub_field('anchor');

                                            if ($if_divider):
                                                while ( have_rows('sticky_nav_element_divider') ) : the_row();
                                                    echo '<li><hr style="border-top-color: ' . get_sub_field('sticky_nav_element_divider_color') . '; border-top-width: 1px;"></li>';
                                                endwhile;

                                            else:
                                                echo '<li><a href="#' . $anchor . '">' . $sticky_nav_element_text . '</a></li>';
                                            endif;

                                        endwhile;
                                        echo '</ul>';
                                        echo '</nav>';
                                    endif;

                                    if ( have_rows('sticky_details_list') ):
                                        echo '<section class="content--sticky">';
                                        while ( have_rows('sticky_details_list') ) : the_row();
                                            while ( have_rows('sticky_details') ) : the_row();
                                            $id = get_sub_field('id');
                                            $logo = get_sub_field('logo');
                                            $url = get_sub_field('url');
                                            $headquarters = get_sub_field('headquarters');
                                            $founded = get_sub_field('founded');
                                            $integration = get_sub_field('integration');
                                            $best_for = get_sub_field('best_for');

                                            echo '<article id="' . $id . '">';
                                            echo '<div class="companyInfo">' .
                                                    '<img src="' . $logo['url'] . '" alt="' . $logo['alt'] . '" />' .
                                                    '<div class="companyInfo__url">' .
                                                        $url .
                                                    '</div>' .
                                                    '<div class="companyInfo__details">' .
                                                        '<div class="companyInfo__detailsInfo companyInfo__location">' .
                                                            'Headquartered<br>' .
                                                            '<strong>' . $headquarters . '</strong>' .
                                                        '</div>' .
                                                        '<div class="companyInfo__detailsInfo companyInfo__founded">' .
                                                            'Founded<br>' .
                                                            '<strong>' . $founded . '</strong>' .
                                                        '</div>' .
                                                        '<div class="clear"></div>' .
                                                        '<div class="companyInfo__detailsInfo companyInfo__integration">' .
                                                            '<strong>' . $integration . '</strong>' .
                                                        '</div>' .
                                                        '<div class="companyInfo__detailsInfo companyInfo__wards">' .
                                                            'Best for<br>' .
                                                            '<strong>' . $best_for . '</strong>' .
                                                        '</div>' .
                                                    '</div>' .
                                                '</div>';
                                                echo '<hr style="border-top-color: #7F868e; border-top-width: 1px; margin-bottom: 30px; ">';
                                                if (have_rows('collapse_content')):
                                                    echo '<div class="collapse-container">';
                                                        while (have_rows('collapse_content')) : the_row();
                                                            $icon = get_sub_field('icon');
                                                            $title = get_sub_field('title');
                                                            $content = get_sub_field('content');
                                                            echo '<div class="collapse">' .
                                                                    '<img src="' . $icon['url'] . '" alt="' . $icon['alt'] . '" width="50" height="50" />' .
                                                                    '<div class="collapse__title">' .
                                                                        $title .
                                                                    '</div>';


                                                                    echo '<div class="collapse__content">' .
                                                                            $content .
                                                                        '</div>';


                                                            echo  '</div>';
                                                        endwhile;
                                                    echo '</div>';
                                                endif;

                                                if (have_rows('icon_content_list')):
                                                    echo '<div class="row icon-content-list-1">';
                                                        while (have_rows('icon_content_list')) : the_row();
                                                            $icon = get_sub_field('icon');
                                                            $title = get_sub_field('title');
                                                            echo '<div class="col-sm-6">' .
                                                                    '<img src="' . $icon['url'] . '" alt="' . $icon['alt'] . '" width="50" height="50" />' .
                                                                    '<div class="icon-content-list-1__title">' .
                                                                        $title .
                                                                    '</div>';

                                                                    if (have_rows('content_list')):
                                                                        echo '<div class="icon-content-list-1__desc">' .
                                                                                '<ul>';
                                                                        while (have_rows('content_list')) : the_row();
                                                                            echo '<li>' . get_sub_field('content_list_element') . '</li>';
                                                                        endwhile;
                                                                        echo  '</ul>' .
                                                                            '</div>';
                                                                    endif;


                                                                echo '</div>';
                                                        endwhile;
                                                    echo '</div>';
                                                endif;
                                            echo '</article>';

                                            endwhile;
                                        endwhile;
                                        echo '</section>';
                                    endif;

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                endif;

                // check current row layout
                if( get_row_layout() == 'table' ):
                    echo '<div class="c-content-box c-size-md">' .
                            '<div class="container">' .
                                '<div class="row">' .
                                    '<div class="col-sm-10 col-sm-push-1">';
                            $anchor = get_sub_field('anchor');
                            $title = get_sub_field('title');
                            $subtitle = get_sub_field('subtitle');
                            echo '<div class="docs-main" id="' . $anchor . '">';
                            echo '<h3 class="three-column-title">' . $title . '</h3>';

                            $subtitle_container = '';
                            if ($subtitle):
                                $subtitle_container = '<h5 class="tablesaw-subtitle">' . $subtitle . '</h5>';
                            endif;

                            echo $subtitle_container;

                            $table = get_sub_field( 'table_content' );
                            if ( $table ):
                                echo '<table class="tablesaw" data-tablesaw-mode="swipe" data-tablesaw-minimap>';
                                    if ( $table['header'] ) {
                                        echo '<thead>';
                                            echo '<tr>';
                                                $i = 0;
                                                foreach ( $table['header'] as $th ) {
                                                    $i++;
                                                    echo '<th scope="col"' . ($i == 1 ? 'data-tablesaw-priority="persist"' : '') . '>';
                                                        echo $th['c'];
                                                    echo '</th>';
                                                }
                                            echo '</tr>';
                                        echo '</thead>';
                                    }
                                    echo '<tbody>';
                                        $i = 0;
                                        foreach ( $table['body'] as $tr ) {
                                            echo '<tr>';
                                                foreach ( $tr as $td ) {
                                                    $i++;
                                                    echo '<td class="' . ($i == 1 ? 'title' : '') . '">';
                                                        echo $td['c'];
                                                    echo '</td>';
                                                }
                                            echo '</tr>';
                                        }
                                    echo '</tbody>';
                                echo '</table>';

                                echo '<script src="/wp-content/themes/comm100/dist/scripts/tablesaw.js" type="text/javascript"></script>';
                            endif;
                            echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                endif;
            endwhile;

            get_template_part('template-parts/content', 'blocks');
        else :

        // no layouts found

        endif;


    ?>

</div>

<?php get_template_part('template-parts/footer'); ?>