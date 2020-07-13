<?php
if( have_rows('tabs') ):

    // loop through the rows of data
    while ( have_rows('tabs') ) : the_row();
        $header_headline = get_sub_field('h1_title');
        $header_slogan = get_sub_field('subtitle');

        // check if the nested repeater field has rows of data
        if( have_rows('tab_content') ):

            echo '<div class="c-content-box c-size-md pricing-tab">';
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
                                // '<div class="product-item__tag product-item__tag--large product-item__tag' . $color . '">' . $tag . '</div>' .
                                '<h3>' . $headline . '</h3>' .
                                // '<div class="threeTab__Index--desc">' .
                                //     '<p class="product-item__desc"> ' . $body . ' </p>' .
                                // '</div>' .
                            '</div>';
                endif;
                if ( $tag == 'OC' ):
                    $tabMobileMC = '<div class="threeTab__Index--mobile">' .
                                // '<div class="product-item__tag product-item__tag--large product-item__tag' . $color . '">' . $tag . '</div>' .
                                '<h3>' . $headline . '</h3>' .
                                // '<div class="threeTab__Index--desc">' .
                                //     '<p class="product-item__desc"> ' . $body . ' </p>' .
                                // '</div>' .
                            '</div>';
                endif;
                if ( $tag == 'BA' ):
                    $tabMobileAI = '<div class="threeTab__Index--mobile">' .
                                // '<div class="product-item__tag product-item__tag--large product-item__tag' . $color . '">' . $tag . '</div>' .
                                '<h3>' . $headline . '</h3>' .
                                // '<div class="threeTab__Index--desc">' .
                                //     '<p class="product-item__desc"> ' . $body . ' </p>' .
                                // '</div>' .
                            '</div>';
                endif;

                echo    '<div class="threeTab__Index threeTab__Index__' . $color . '">' .
                           
                            '<h3>' . $headline . '</h3>' .
                           
                        '</div>';

                        $color = get_sub_field('color');
            endwhile;

            echo '</div>';



            echo '<div class="threeTab__Detail-wrap">';

            // pricing live chat details
            echo '<div class="threeTab__Detail clearfix">';
            echo $tabMobileLC;
            echo '<div class="threeTab__Detail--col-wrap clearfix">';
            $pricing_details_livechat_note = get_sub_field('pricing_details_livechat_note');

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
                        $cta_link_description = get_sub_field('cta_link_description');
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
                    
                    if($cta_link_description) {
$linkcontent = $linkcontent . '<div class="cta_link_description">'.$cta_link_description.'</div>';
}

                        $linkcontent = '<div class="threeTab__Detail--action"> ' . $linkcontent . ' </div>';
                    endif;
                endif;

                echo    '<div class="col-sm-4 col-xs-12 threeTab__Detail--col LC">' .
                            '<div class="threeTab__Detail--title threeTab__Detail--title--'.$color.'">' . $title . '</div>' ;

                    if ($priceContent) {
                                echo '<div class="threeTab__Detail--price">' . $priceContent . '</div>';
                    }
                    echo $linkcontent;
                    $promotion_badge = get_sub_field('promotion_badge');
if($promotion_badge) {
echo '<figure class="promotion_badge"><img src="'.$promotion_badge.'" class="promotion_badge-img img-fluid">
</figure>';
}

                    echo $feature_list_title_str .
                            '<ul class="threeTab__Detail--contentList">' .
                                $li_feature_list .
                            '</ul>' .
                            
                        '</div>';
                    endwhile;
                    echo '</div>';

                    if ($pricing_details_livechat_note ) {
                        echo '<div class="threeTab__Detail--note">' . $pricing_details_livechat_note  . '</div>';
                    }

                    echo '</div>';
                    // end pricing live chat details

                    // pricing multichannel details
            $color = get_sub_field('color');
            echo '<div class="threeTab__Detail  threeTab__Detail__' . $color . ' clearfix">';
            echo $tabMobileMC;
            echo '<div class="threeTab__Detail--col-wrap clearfix">';
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

                echo    '<div class="col-sm-4 col-xs-12 threeTab__Detail--col OC">' .
                            '<div class="threeTab__Detail--title threeTab__Detail--title--'.$color.'">' . $title . '</div>';

                            if ($priceContent) {
                                echo '<div class="threeTab__Detail--price">' . $priceContent . '</div>';
                    }
echo $linkcontent;

$promotion_badge = get_sub_field('promotion_badge');
if($promotion_badge) {
echo '<figure class="promotion_badge"><img src="'.$promotion_badge.'" class="promotion_badge-img img-fluid">
</figure>';
}

                            echo $feature_list_title_str .
                            '<ul class="threeTab__Detail--contentList">' .
                                $li_feature_list .
                            '</ul>' .
                           
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
                echo $tabMobileAI;
                echo '<div class="threeTab__Detail--col-wrap clearfix">';
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

                    echo    '<div class="col-sm-6 threeTab__Detail--col AI">' .
                                '<div class="threeTab__Detail--title threeTab__Detail--title--'.$color.'">' . $title . '</div>';

                                if ($priceContent) {
                                    echo '<div class="threeTab__Detail--price">' . $priceContent . '</div>';
                        }
echo $linkcontent;
                                echo $feature_list_title_str .
                                '<ul class="threeTab__Detail--contentList">' .
                                    $li_feature_list .
                                '</ul>' .
                               
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