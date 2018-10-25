<?php
/*
Template Name:Resources
*/
?>
<?php get_header(); ?>
</header>
  
<div class="c-layout-page c-layout-page-fixed primary-page">
    

    <?php

        // check if the flexible content field has rows of data
        if( have_rows('modules') ):

            // loop through the rows of data
            while ( have_rows('modules') ) : the_row();

                // check current row layout
                if( get_row_layout() == 'hero_head' ):
                    
                    $header_headline = get_sub_field('h1_title');
                    $header_slogan = get_sub_field('subtitle');
                    $header_description = get_sub_field('description');

                    echo '<div class="c-content-box">';
                    echo '<div class="container header">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12 c-center">';

                    
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
                        echo '<div class="desc">' .
                                $header_description .
                            '</div>';
                    endif;
                    
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                endif;
                
                // check current row layout
                // if( get_row_layout() == 'thank_you_hero_head' ):
                    
                //     $header_headline = get_sub_field('h1_title');
                //     $header_slogan = get_sub_field('subtitle');
                //     $header_description = get_sub_field('description');
                //     $call_to_action = get_sub_field('call_to_action');

                //     echo '<div class="c-content-box c-size-md">';
                //     echo '<div class="container">';
                //     echo '<div class="row">';
                //     echo '<div class="col-sm-12 thankyou">';

                    
                //     if ($header_headline):
                //         echo '<h1>' .
                //                 $header_headline .
                //             '</h1>';
                //     endif;
                //     if ($header_slogan):
                //         echo '<h2 class="c-margin-t-20">' .
                //                 $header_slogan .
                //             '</h2>';
                //     endif;
                //     if ($header_description):
                //         echo '<div class="thankyou__desc">' .
                //                 $header_description .
                //             '</div>';
                //     endif;
                    
                //     if ($call_to_action):
                //         echo '<div class="thankyou__calltoaction">' .
                //                 '<a class="btn btn-xlg btn-link--green" href="' . $call_to_action['url'] . '" target="' . $call_to_action['target'] . '">' .
                //                     $call_to_action['title'] .
                //                 '</a>';
                //             '</div>';
                //     endif;

                //     echo '</div>';
                //     echo '</div>';
                //     echo '</div>';
                //     echo '</div>';
                // endif;

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

                    echo '<div class="c-content-box c-size-lg c-margin-b-30 banner banner--' . $banner_size . ' banner--' . $banner_align . '"'  . $style_bg . '>';
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
                if( get_row_layout() == 'resources_list' ):
                
                    echo '<div class="c-content-box c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12">';

                    $header_headline = get_sub_field('h1_title');
                    $header_slogan = get_sub_field('subtitle');
                    if ($header_headline):
                        echo '<h1 class="c-center">' .
                                $header_headline .
                            '</h1>';
                    endif;
                    if ($header_slogan):
                        echo '<h2 class="c-margin-t-20 c-margin-b-60">' .
                                $header_slogan .
                            '</h2>';
                    endif;
                    // check if the nested repeater field has rows of data
                    if( have_rows('resources_nav_item') ):
                    
                        echo '<ul class="post-nav">';
                    
                        // loop through the rows of data
                        while ( have_rows('resources_nav_item') ) : the_row();

                            $resources_nav_item_link = get_sub_field('resources_nav_item_link');
                            $if_active = get_sub_field('if_active');

                            echo    '<li class="' . ($if_active ? 'active' : '') . '">' .
                                        '<a href="' . $resources_nav_item_link['url'] . '" target="' . $resources_nav_item_link['target'] . '">' . $resources_nav_item_link['title'] . '</a>' . 
                                    '</li>';
                        endwhile;

                        
                        echo '</ul>';

                    endif;

                    if( have_rows('resources_promotion_item') ):
                    
                        echo '<div class="resource-promotion clearfix">';
                        // loop through the rows of data
                        while ( have_rows('resources_promotion_item') ) : the_row();

                            $link = get_sub_field('link');
                            $image = get_sub_field('image');
                            $tag = get_sub_field('tag');
                            $category = get_sub_field('category');
                            $title = get_sub_field('title');
                            $subtitle = get_sub_field('subtitle');
                            

                            echo    '<div class="resource-item col-sm-6">' .
                                        '<a href="' . $link['url'] . '" target="' . $link['target'] . '">' . 
                                            '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" />' .
                                            '<div class="resource-item--tag">' . $tag . '</div>' .
                                            '<div class="resource-item--category">' . $category . '</div>' .
                                            '<h5 class="resource-item--title">' . $title . '</h5>' .
                                            '<div class="resource-item--subTitle">' . $subtitle . '</div>' . 
                                        '</a>' . 
                                    '</div>';
                        endwhile;
                        echo '</div>';

                    endif;

                    if( have_rows('resources_list_item') ):
                    
                        echo '<div class="resource-list clearfix">';
                        // loop through the rows of data
                        while ( have_rows('resources_list_item') ) : the_row();

                            $type = get_sub_field('type');
                            $link = get_sub_field('link');
                            $link_type = get_sub_field('link_type');
                            $image = get_sub_field('image');
                            $tag = get_sub_field('tag');
                            $category = get_sub_field('category');
                            $title = get_sub_field('title');
                            $subtitle = get_sub_field('subtitle');
                            
                            if ($type == 'calltoaction'):
                                $linkcontent='';
								if ($link):
									switch ($link_type) {
										case 'green' :
												$linkcontent = '<a class="btn btn-xlg btn-link--green" href="' . $link['url'] . '" target="' . $link['target'] . '">' .
														$link['title'] .
													'</a>';
												break;
										case 'blue' :
												$linkcontent = '<a class="btn btn-xlg c-theme-btn" href="' . $link['url'] . '" target="' . $link['target'] . '">' .
														$link['title'] .
													'</a>';
												break;
										case 'white' :
												$linkcontent = '<a class="btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $link['url'] . '" target="' . $link['target'] . '">' .
														$link['title'] .
													'</a>';
												break;
										case 'link' :
												$linkcontent = '<a class="c-redirectLink" href="' . $link['url'] . '" target="' . $link['target'] . '">' .
														$link['title'] .
													'</a>';
												break;
										default: break;
									}
                                endif;
                                
                                echo '<div class="resource-item col-sm-4">' .
                                        '<div class="CTA">' . 
                                            '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="120" height="120" />' .
                                            '<div class="resource-item--title">' . $title . '</div>';
                                if ($subtitle):
                                    echo $subtitle;
                                endif;
                                echo '<div class="resource-item-CTA-link">' . $linkcontent . '</div>';
                                echo '</div>';
                                echo '</div>';
                            else:
                                echo '<div class="resource-item col-sm-4">' .
                                        '<a href="' . $link['url'] . '" target="' . $link['target'] . '">' . 
                                            '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" />' .
                                            '<div class="resource-item--tag">' . $tag . '</div>' .
                                            '<div class="resource-item--category">' . $category . '</div>' .
                                            '<h5 class="resource-item--title">' . $title . '</h5>' .
                                            '<div class="resource-item--subTitle">' . $subtitle . '</div>' . 
                                        '</a>' . 
                                    '</div>';
                            endif;
                            
                        endwhile;
                        echo '</div>';

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

                    $headline = get_sub_field('headline');

                    // check if the nested repeater field has rows of data
                    if( have_rows('cards') ):
                        echo '<div class="c-content-box c-size-md c-padding-t-0">';
                        echo '<div class="container">';
                        echo '<div class="row">';
                        echo '<div class="col-sm-12 card card-col-' . $row_count . '">';

                        
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
                                        '<div class="card__icon-wrap"><img src="' . $card_img['url'] . '" alt="' . $card_img['alt'] . '" class="card__icon--small" width="70" height="70" /></div>' .
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
                        
                        echo '<div class="container">';
                        echo '<div class="row">';
                        echo '<div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl" data-items="6" data-desktop-items="6" data-desktop-small-items="3" data-tablet-items="3" data-mobile-small-items="1" data-auto-play="5000">';
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
                                        '<div class="img-text-card__img">' .
                                            '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" />' .
                                        '</div>' .
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
                    
                    // check if the nested repeater field has rows of data
                    if( have_rows('image_text_column_repeater') ):
                        
                        echo '<div class="c-content-box c-size-md">';
                        echo '<div class="container">';
                        echo '<div class="row">';
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

                            echo    '<div class="img-text-column img-text-column--' . $image_position . ' clearfix">' .
                                        '<div class="col-sm-6 ' . $push6 . ' img-text-column__img">' .
                                            '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" />' .
                                        '</div>' .
                                        '<div class="col-sm-6 ' . $pull6 . ' img-text-column__text">' .
                                            '<h3 class="highlight highlight--lightBlue">' . $headline . '</h3>' .
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
                    $btn_group = get_sub_field('btn_group');
                    

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
                    
                    if ($btn_group):
                        while ( have_rows('btn_group') ) : the_row();
                            $type = get_sub_field('type');
                            // check if the nested repeater field has rows of data
                            if( have_rows('btn_repeater') ):
                                
                                echo '<div class="btn-link-group c-margin-t-60 btn-link-group--' . $type . '">';
            
                                    // loop through the rows of data
                                while ( have_rows('btn_repeater') ) : the_row();
            
                                    $btn_link = get_sub_field('button');
            
                                    echo  '<a href="' . $btn_link['url'] . '" target="' . $btn_link['target'] . '" class="btn-link">' . $btn_link['title'] . '</a>';
            
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

                            $headerIcon = '';
                            if ($icon):
                                $headerIcon = '<div class="header_icon">' .
                                                '<img src="' . $icon['url'] . '" alt="' . $icon['alt'] . '" width="64" height="64" />' .
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

                            echo    '<div class="col-sm-5 ' . $push . '">' .
                                        $headerIcon .
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
                if( get_row_layout() == 'testimonial' ):
                    
                    $quote = get_sub_field('quote');
                    $signature = get_sub_field('signature');
                    $story_link = get_sub_field('story_link');
                    $background_color = get_sub_field('background_color');
                    

                    echo '<div class="c-content-box c-size-xlg c-content-box--' . $background_color . ' ">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-10 col-sm-push-1 c-quote">';

                    if ($quote):
                        echo '<div class="c-quote__content">' .
                                $quote . 
                            '</div>';
                    endif;
                    if ($signature):
                        echo '<div class="c-quote__signature">' .
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
                    $color = get_sub_field('color');                                
                    // check if the nested repeater field has rows of data
                    if( have_rows('column') ):
                        
                        echo '<div class="c-content-box c-size-md">';
                        echo '<div class="container">';
                        echo '<div class="row">';
                        echo '<div class="col-sm-12 feature-column">';
                            // loop through the rows of data
                        
                        while ( have_rows('column') ) : the_row();
                            
                            $headline = get_sub_field('headline');
                            $body = get_sub_field('body');
                            $icon = get_sub_field('icon');
                            

                            if ($linkcontent !== ''):
                                $linkcontent = '<div class="c-margin-t-30">' . $linkcontent . '</div>';
                            endif;

                            echo    '<div class="feature-column__item">' .
                                        '<div><img src="' . $icon['url'] . '" alt="' . $icon['alt'] . '" width="60" height="60" /></div>' .
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

                            echo    '<div class="threeTab__Index">' .
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
                                        '<div class="threeTab__Detail--title">' . $title . '</div>' .
                                        '<div class="threeTab__Detail--price">' . $priceContent . '</div>' .
                                        '<p class="threeTab__Detail--subTitle">' . $feature_list_title . '</p>' .
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

                            echo    '<div class="threeTab__Detail clearfix">' .
                                        
                                        '<div class="threeTab__Detail--title">' .
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

                            echo    '<div class="threeTab__Detail clearfix">' .
                                    
                                        '<div class="threeTab__Detail--title">' .
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
                if( get_row_layout() == 'resource_hero_banner' ):
                    
                    $h1_title = get_sub_field('h1_title');
                    $h2_title = get_sub_field('h2_title');
                    $description = get_sub_field('description');
                    $image = get_sub_field('image');
                    $banner_cta = get_sub_field('cta');
                    // check if the nested repeater field has rows of data
                    
                        
                        echo '<div class="c-content-box c-content-box--grey">';
                        echo '<div class="container">';
                        echo '<div class="row landingPage-title-wrap">';
                    
                        echo '<div class="col-sm-5 col-sm-push-7 landingPage-title--col"><img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" /></div>';
                        echo '<div class="col-sm-7 col-sm-pull-5 landingPage-title--col">';
                            echo '<div class="landingPage-title--text">';
                            echo '<h2>' . $h2_title . '</h2>';
                            echo '<h1>' . $h1_title . '</h1>';
                            if ($description):
                                echo $description;
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
                        echo '<h3>' . $title . '</h3>';
                        echo $share_this_code;
                        echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                
                endif;  

                // check current row layout
                if( get_row_layout() == 'promotion_list' ):
                
                    echo '<div class="c-content-box c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12">';
                    echo '<div class="resource-list-title">' . get_sub_field('title') . '</div>';
                    // check if the nested repeater field has rows of data
                    
                    if( have_rows('resources_list_item') ):
                    
                        echo '<div class="resource-list clearfix">';
                        // loop through the rows of data
                        while ( have_rows('resources_list_item') ) : the_row();

                            $type = get_sub_field('type');
                            $link = get_sub_field('link');
                            $link_type = get_sub_field('link_type');
                            $image = get_sub_field('image');
                            $tag = get_sub_field('tag');
                            $category = get_sub_field('category');
                            $title = get_sub_field('title');
                            $subtitle = get_sub_field('subtitle');
                            
                            if ($type == 'calltoaction'):
                                $linkcontent='';
								if ($link):
									switch ($link_type) {
										case 'green' :
												$linkcontent = '<a class="btn btn-xlg btn-link--green" href="' . $link['url'] . '" target="' . $link['target'] . '">' .
														$link['title'] .
													'</a>';
												break;
										case 'blue' :
												$linkcontent = '<a class="btn btn-xlg c-theme-btn" href="' . $link['url'] . '" target="' . $link['target'] . '">' .
														$link['title'] .
													'</a>';
												break;
										case 'white' :
												$linkcontent = '<a class="btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $link['url'] . '" target="' . $link['target'] . '">' .
														$link['title'] .
													'</a>';
												break;
										case 'link' :
												$linkcontent = '<a class="c-redirectLink" href="' . $link['url'] . '" target="' . $link['target'] . '">' .
														$link['title'] .
													'</a>';
												break;
										default: break;
									}
                                endif;
                                
                                echo '<div class="resource-item col-sm-4">' .
                                        '<div class="CTA">' . 
                                            '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="120" height="120" />' .
                                            '<div class="resource-item--title">' . $title . '</div>';
                                if ($subtitle):
                                    echo $subtitle;
                                endif;
                                echo '<div class="resource-item-CTA-link">' . $linkcontent . '</div>';
                                echo '</div>';
                                echo '</div>';
                            else:
                                echo '<div class="resource-item col-sm-4">' .
                                        '<a href="' . $link['url'] . '" target="' . $link['target'] . '">' . 
                                            '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" />' .
                                            '<div class="resource-item--tag">' . $tag . '</div>' .
                                            '<div class="resource-item--category">' . $category . '</div>' .
                                            '<h5 class="resource-item--title">' . $title . '</h5>' .
                                            '<div class="resource-item--subTitle">' . $subtitle . '</div>' . 
                                        '</a>' . 
                                    '</div>';
                            endif;
                            
                        endwhile;
                        echo '</div>';

                    endif;

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;

                // check current row layout
                if( get_row_layout() == 'landing_page_not_gated_context' ):
                    
                    if( have_rows('context') ):
                        echo '<div class="c-content-box c-size-lg">';
                        echo '<div class="container">';
                        echo '<div class="row landingPage">';
                        // loop through the rows of data
                        while ( have_rows('context') ) : the_row();
                            if( get_row_layout() == 'context_summary' ):
                                echo '<div class="col-sm-12 landingPage-summary">' . get_sub_field('summary') . '</div>';
                            endif;
                            if( get_row_layout() == 'context_image' ):
                                $image = get_sub_field('image');
                                echo    '<div class="col-sm-6">' . 
                                            '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" />' .
                                        '</div>';
                            endif;
                            
                            
                           
                        endwhile;
                        echo '<div class="col-sm-6 landingPage-content">';
                        while ( have_rows('context') ) : the_row();
                            if( get_row_layout() == 'context_paragraph' ):
                                echo get_sub_field('paragraph');
                            endif;
                            if( get_row_layout() == 'context_button' ):
                                $button = get_sub_field('button');
                                echo '<a href="' . $button['url'] . '" target="' . $button['target'] . '" class="btn btn-xlg c-btn-green c-margin-t-20">' . $button['title'] . '</a>';
                            endif;
                            if( get_row_layout() == 'context_share_this' ):
                                while ( have_rows('share_this') ) : the_row();
                                    $title = get_sub_field('title');
                                    $sharecode = get_sub_field('share_this_code');
                                    echo    '<div class="social-share c-margin-t-60">' .
                                                '<h3>' . $title . '</h3>' .
                                                $sharecode .
                                            '</div>';
                                endwhile;
                            endif;
                        endwhile;
                        echo '</div>';
                    endif;
                    
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;

                // check current row layout
                if( get_row_layout() == 'landing_page_gated_context' ):
                    
                    
                        echo '<div class="c-content-box c-size-lg">';
                        echo '<div class="container">';
                        echo '<div class="row landingPage">';
                        echo '<div class="col-sm-8 landingPage-content">';
                        // loop through the rows of data
                        echo '<div class="landingPage-summary">' . get_sub_field('summary') . '</div>';
                        
                        while ( have_rows('context') ) : the_row();
                            if( get_row_layout() == 'context_paragraph' ):
                                echo get_sub_field('paragraph');
                            endif;
                            if( get_row_layout() == 'context_image' ):
                                $image = get_sub_field('context_image_content');
                                echo   '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" />';
                                        
                            endif;
                            if( get_row_layout() == 'context_share_this' ):
                                while ( have_rows('share_this') ) : the_row();
                                    $title = get_sub_field('title');
                                    $sharecode = get_sub_field('share_this_code');
                                    echo    '<div class="social-share c-margin-t-60">' .
                                                '<h3>' . $title . '</h3>' .
                                                $sharecode .
                                            '</div>';
                                endwhile;
                            endif;
                        endwhile;
                        echo '</div>';
                        echo '<div class="col-sm-4 landingPage-download">';
                            echo '<h3 class="highlight highlight--blue">' . get_sub_field('download_title') . '</h3>';
                            echo get_sub_field('download_form');
                            echo '<script src="/wp-content/themes/comm100/dist/scripts/marketo-form.js?v=20181023"></script>';
                            echo '<div class="form-note">' . get_sub_field('download_form_note') . '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    
                    

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

                // check current row layout
                if( get_row_layout() == 'webinar_gated_context' ):
                    
                    
                    echo '<div class="c-content-box c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row landingPage">';

                    echo '<div class="col-sm-8 landingPage-content">';
                        // loop through the rows of data
                        echo '<h3>' . get_sub_field('title') . '</h3>';
                        echo get_sub_field('paragraph');
                   

                    if( have_rows('speaker') ):
                        while ( have_rows('speaker') ) : the_row();
                        echo '<div class="speakers-container">';
                            echo '<h3>' . get_sub_field('title') . '</h3>';
                            if( have_rows('speaker_details') ):
                                while ( have_rows('speaker_details') ) : the_row();
                                    $avatar = get_sub_field('avatar');
                                    echo '<div class="speaker">' .
                                        '<img class="speaker-avatar" src="' . $avatar['url'] . '" alt="' . $avatar['alt'] . '" width="95" height="95" />' . 
                                        '<div class="speaker-title">' . get_sub_field('title') . '</div>' .
                                        '<div class="speaker-profile">' . get_sub_field('profile') . '</div>' .
                                    '</div>';
                                endwhile;
                            endif;
                        echo '</div>';
                        endwhile;
                    endif;

                    if( have_rows('host') ):
                        while ( have_rows('host') ) : the_row();
                        echo '<div class="speakers-container">';
                            echo '<h3>' . get_sub_field('title') . '</h3>';
                            if( have_rows('host_details') ):
                                while ( have_rows('host_details') ) : the_row();
                                    $avatar = get_sub_field('host_avatar');
                                    echo '<div class="speaker">' .
                                        '<img class="speaker-avatar" src="' . $avatar['url'] . '" alt="' . $avatar['alt'] . '" width="95" height="95" />' . 
                                        '<div class="speaker-title">' . get_sub_field('title') . '</div>' .
                                        '<div class="speaker-profile">' . get_sub_field('profile') . '</div>' .
                                    '</div>';
                                endwhile;
                            endif;
                        echo '</div>';
                        endwhile;
                    endif;

                    while ( have_rows('share_this') ) : the_row();
                        $title = get_sub_field('title');
                        $sharecode = get_sub_field('share_this_code');
                        echo    '<div class="social-share">' .
                                    '<h3>' . $title . '</h3>' .
                                    $sharecode .
                                '</div>';
                    endwhile;
                    echo '</div>';

                    if ( have_rows('webinar_form') ):
                        while ( have_rows('webinar_form') ) : the_row();
                        echo '<div class="col-sm-4 landingPage-download">';
                            echo '<h3 class="highlight highlight--blue">' . get_sub_field('title') . '</h3>';
                            echo get_sub_field('form_code');
                            echo '<script src="/wp-content/themes/comm100/dist/scripts/marketo-form.js"></script>';
                            echo '<div class="form-note">' . get_sub_field('form_note') . '</div>';
                        echo '</div>';
                        endwhile;
                    endif;

                   
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                
                

                endif;

                // check current row layout
                if( get_row_layout() == 'webinar_not_gated_context' ):
                    
                    
                    echo '<div class="c-content-box c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row landingPage">';

                    echo '<div class="col-sm-12 landingPage-content">';
                        // loop through the rows of data
                        echo '<h3>' . get_sub_field('title') . '</h3>';
                        echo get_sub_field('paragraph');

                        $video = get_sub_field('video');
                        if ( $video ):
                            echo '<div class="landingPage__video">' . get_sub_field('video') . '</div>';
                        endif;

                        $watch_full_video = get_sub_field('watch_full_video');
                        if ( $watch_full_video ):
                            echo '<div class="landingPage__watchFullWebinar">' . 
                                    '<a href="' . $watch_full_video['url'] . '" target="' . $watch_full_video['target'] . '" class="btn btn-xlg c-theme-btn">' . $watch_full_video['title'] . '</a>' . 
                                '</div>';
                        endif;

                        $download_webinar = get_sub_field('download_webinar');
                        if ( $download_webinar ):
                            echo '<div class="landingPage__downloadWebinar">' . 
                                    '<a href="' . $download_webinar['url'] . '" target="' . $download_webinar['target'] . '" class="btn btn-xlg c-theme-btn">' . $download_webinar['title'] . '</a>' . 
                                '</div>';
                        endif;
                        echo '<div class="clear"></div>';

                        if( have_rows('speaker') ):
                            while ( have_rows('speaker') ) : the_row();
                            echo '<div class="speakers-container">';
                                echo '<h3>' . get_sub_field('title') . '</h3>';
                                if( have_rows('speaker_details') ):
                                    while ( have_rows('speaker_details') ) : the_row();
                                        $avatar = get_sub_field('avatar');
                                        echo '<div class="speaker">' .
                                            '<img class="speaker-avatar" src="' . $avatar['url'] . '" alt="' . $avatar['alt'] . '" width="95" height="95" />' . 
                                            '<div class="speaker-title">' . get_sub_field('title') . '</div>' .
                                            '<div class="speaker-profile">' . get_sub_field('profile') . '</div>' .
                                        '</div>';
                                    endwhile;
                                endif;
                            echo '</div>';
                            endwhile;
                        endif;

                        if( have_rows('host') ):
                            while ( have_rows('host') ) : the_row();
                            echo '<div class="speakers-container">';
                                echo '<h3>' . get_sub_field('title') . '</h3>';
                                if( have_rows('host_details') ):
                                    while ( have_rows('host_details') ) : the_row();
                                        $avatar = get_sub_field('host_avatar');
                                        echo '<div class="speaker">' .
                                            '<img class="speaker-avatar" src="' . $avatar['url'] . '" alt="' . $avatar['alt'] . '" width="95" height="95" />' . 
                                            '<div class="speaker-title">' . get_sub_field('title') . '</div>' .
                                            '<div class="speaker-profile">' . get_sub_field('profile') . '</div>' .
                                        '</div>';
                                    endwhile;
                                endif;
                            echo '</div>';
                            endwhile;
                        endif;

                        while ( have_rows('share_this') ) : the_row();
                            $title = get_sub_field('title');
                            $sharecode = get_sub_field('share_this_code');
                            echo    '<div class="social-share">' .
                                        '<h3>' . $title . '</h3>' .
                                        $sharecode .
                                    '</div>';
                        endwhile;
                    echo '</div>';

                    if ( have_rows('webinar_form') ):
                        while ( have_rows('webinar_form') ) : the_row();
                        echo '<div class="col-sm-4 landingPage-download">';
                            echo '<h3 class="highlight highlight--blue">' . get_sub_field('title') . '</h3>';
                            echo '<link rel="stylesheet" href="https://www.comm100.com/wp-content/themes/comm100/assets/base/js/marketo-form.css" type="text/css" media="screen, projection" />';
                            echo get_sub_field('form_code');
                            echo '<script src="https://www.comm100.com/wp-content/themes/comm100/assets/base/js/marketo-form.js"></script>';
                            echo '<div class="form-note">' . get_sub_field('form_note') . '</div>';
                        echo '</div>';
                        endwhile;
                    endif;

                   
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                
                

                endif;

                // check current row layout
                if( get_row_layout() == 'video' ):
                    
                    $header_headline = get_sub_field('h1_title');
                    $header_slogan = get_sub_field('h2_subtitle');
                    $header_description = get_sub_field('description');
                    $video = get_sub_field('video');

                    echo '<div class="c-content-box c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12 resource-header">';
                        if ($header_slogan):
                            echo '<h2>' .
                                    $header_slogan .
                                '</h2>';
                        endif;
                        if ($header_headline):
                            echo '<h1>' .
                                    $header_headline .
                                '</h1>';
                        endif;
                    
                        if ($header_description):
                            echo '<div class="resource-header__desc">' .
                                    $header_description .
                                '</div>';
                        endif;
                    echo '</div>';

                    if ( $video ):
                        echo '<div class="col-sm-push-1 col-sm-10 video-content">' .
                                $video .
                            '</div>';
                    endif;

                    while ( have_rows('share_this') ) : the_row();
                        $title = get_sub_field('title');
                        $sharecode = get_sub_field('share_this_code');
                        echo    '<div class="col-sm-12 social-share">' .
                                    '<h3>' . $title . '</h3>' .
                                    $sharecode .
                                '</div>';
                    endwhile;
                    
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                endif;

                // check current row layout
                if( get_row_layout() == 'infograghic' ):
                    
                    $header_headline = get_sub_field('h1_title');
                    $header_slogan = get_sub_field('h2_subtitle');
                    $header_description = get_sub_field('description');
                    $video = get_sub_field('video');

                    echo '<div class="c-content-box c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12 resource-header">';
                        if ($header_slogan):
                            echo '<h2>' .
                                    $header_slogan .
                                '</h2>';
                        endif;
                        if ($header_headline):
                            echo '<h1>' .
                                    $header_headline .
                                '</h1>';
                        endif;
                    echo '</div>';

                    echo '<div class="col-sm-12 infograghic">';
                        while ( have_rows('content') ) : the_row();
                            if( get_row_layout() == 'paragraph' ):
                                echo get_sub_field('paragraph');
                            endif;
                            if( get_row_layout() == 'title' ):
                                echo '<h3>' . get_sub_field('title') . '</h3>';
                            endif;
                            if( get_row_layout() == 'image' ):
                                $if_can_enlarge = get_sub_field('if_can_enlarge');
                                $image = get_sub_field('image_content');
                                $enlarge_content = '';
                                $image_wrap = '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" />';
                                if ($if_can_enlarge):
                                    $enlarge_content = '<div class="c-overlay-content fancybox__enlarge">' .
                                                            '<a href="' . $image['url'] . '" data-lightbox="fancybox" data-fancybox-group="gallery-1"><i class="icon-magnifier-add"></i>' . get_sub_field('enlarge_text') . '</a>' .
                                                    '</div>';
                                    $image_wrap = '<a href="' . $image['url'] . '" data-lightbox="fancybox" data-fancybox-group="gallery-1">' .
                                                    '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" />' .
                                                '</a>';
                                endif;
                                echo '<div class="c-content-overlay c-center">' .   
                                        $enlarge_content .
                                        $image_wrap .
                                    '</div>';
                                        
                            endif;
                        endwhile;

                        while ( have_rows('share_this') ) : the_row();
                            $title = get_sub_field('title');
                            $sharecode = get_sub_field('share_this_code');
                            echo    '<div class="social-share">' .
                                        '<h3>' . $title . '</h3>' .
                                        $sharecode .
                                    '</div>';
                        endwhile;
                        while ( have_rows('embed') ) : the_row();
                            $title = get_sub_field('title');
                            $embed_code = get_sub_field('embed_code');
                            echo    '<div class="embed">' .
                                        '<h3>' . $title . '</h3>' .
                                        '<textarea>' . $embed_code . '</textarea>' .
                                    '</div>';
                        endwhile;
                    echo '</div>';

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                endif;

                // check current row layout
                if( get_row_layout() == 'white_paper_online' ):
                    
                    
                    
                        while ( have_rows('context') ) : the_row();
                            if( get_row_layout() == 'maincontent' ):
                                
                                echo '<div class="c-content-box c-size-md whitepaper__maincontent">';
                                echo '<div class="container">';
                                echo '<div class="row">';
                                echo '<div class="col-sm-12">';
                                while ( have_rows('maincontent') ) : the_row();
                                    if( get_row_layout() == 'title' ):
                                        $title = get_sub_field('title');
                                        if ($title):
                                            echo '<h3>' . $title . '</h3>';
                                        endif;
                                    endif;

                                    if( get_row_layout() == 'paragraph' ):
                                        $paragraph = get_sub_field('paragraph');
                                        if ($paragraph):
                                            echo $paragraph;
                                        endif;
                                    endif;

                                    if( get_row_layout() == 'image' ):
                                        $image = get_sub_field('image');
                                        if($image):
                                        $image_wrap = '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" />';
                                        echo '<div class="c-center c-margin-b-30">' .   
                                                $image_wrap .
                                            '</div>';
                                        endif;
                                    endif;

                                    if( get_row_layout() == 'call_out' ):
                                        $call_out = get_sub_field('call_out');
                                        if($call_out):
                                        
                                        echo '<div class="whitepaper__callout">' .   
                                                $call_out .
                                            '</div>';
                                        endif;
                                    endif;

                                    // check if the nested repeater field has rows of data
                                    // if( get_row_layout() == 'list' ):
                                    //     if( have_rows('list_grade_first') ):
                                    //         echo '<ul class="resources-nav">';
                                    //         // loop through the rows of data
                                    //         while ( have_rows('list_grade_first') ) : the_row();
                                    //             $list_grade_first_content = get_sub_field('list_grade_first_content');
                                    //             $list_grade_second = get_sub_field('list_grade_second');

                                    //             echo    '<li>' .
                                    //                     $list_grade_first_content;

                                    //                     if (have_rows('list_grade_second')):
                                    //                         echo '<ul>';
                                    //                         while ( have_rows('list_grade_second') ) : the_row();
                                                                
                                    //                             $list_grade_second_content = get_sub_field('list_grade_second_content');
                                    //                             $list_grade_third = get_sub_field('list_grade_third');

                                    //                             echo    '<li>' .
                                    //                                     $list_grade_second_content;
                                    //                                     if (have_rows('list_grade_third')):
                                    //                                         echo '<ul>'; 
                                    //                                         while ( have_rows('list_grade_third') ) : the_row();
                                    //                                             $list_grade_third_content = get_sub_field('list_grade_third_content');
                                    //                                             echo '<li>' .
                                    //                                                     $list_grade_third_content .
                                    //                                                 '</li>';
                                    //                                         endwhile;
                                    //                                         echo '</ul>';
                                    //                                     endif;
                                    //                             echo    '</li>';
                                                                
                                    //                         endwhile;
                                    //                         echo '</ul>';
                                    //                     endif;

                                    //             echo    '</li>';
                                    //         endwhile;
                                    //         echo '</ul>';

                                    //     endif;
                                    // endif;
                                endwhile;

                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                
                            endif;

                            
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
                            
                            if( get_row_layout() == 'share_this' ):
                                $title = get_sub_field('title');
                                $sharecode = get_sub_field('share_this_code');
                                echo '<div class="c-content-box">';
                                echo '<div class="container">';
                                echo '<div class="row">';
                                echo '<div class="col-sm-12">';

                                echo    '<div class="social-share">' .
                                            '<h3>' . $title . '</h3>' .
                                            $sharecode .
                                        '</div>';
                                        
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            endif;
                            if( get_row_layout() == 'line' ):
                    
                                $height = get_sub_field('height');
                                $color = get_sub_field('color');
            
                                echo '<div class="c-content-box">';
                                echo '<div class="container">';
                                echo '<div class="row">';
                                echo '<div class="col-sm-12 c-margin-t-60">';
                                
                                if ($height):
                                    echo '<hr style="border-top-color: ' . $color . '; border-top-width: ' . $height . 'px " />';
                                endif;
                               
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            
                            endif;
                        endwhile;
                    
                endif;
            endwhile;

        else :

        // no layouts found

        endif;

        
    ?>
                
</div>

<?php get_footer(); ?>