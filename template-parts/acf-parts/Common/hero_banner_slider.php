<?php
if( get_row_layout() == 'hero_banner_slider' ){                
                    
                    wp_enqueue_style('swiper');
                   
                    wp_enqueue_script('swiper');

                    echo '<div class="swiper-container hero_banner_slider"><div class="swiper-wrapper">';
                    // check if the repeater field has rows of data
                    if( have_rows('slider') ):
                        // loop through the rows of data
                        while ( have_rows('slider') ) : the_row();
                            echo '<div class="swiper-slide">';
     
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
                            echo '</div>';
                        endwhile;

                    else :
                    // no rows found
                    endif;
                    echo '</div>';
                    echo '<div class="swiper-pagination"></div>';
                echo '</div>';
            
                echo "<style>

                    .swiper-container-horizontal>.swiper-pagination-bullets {
                        bottom: 30px !important;   
                    }

                    .swiper-pagination-bullets .swiper-pagination-bullet{  
                      background: #ffffff; 
                    } 
                    .swiper-pagination-bullets .swiper-pagination-bullet-active{
                      background: #ffffff; 
                    }
                    .swiper-slide,.banner.banner--responsive_feature.c-size-lg,.swiper-slide-active{height:520px !important;} 
                    @media screen and (max-width: 768px){
                    .swiper-slide,.banner.banner--responsive_feature.c-size-lg,.swiper-slide-active{height:700px !important;} 

                    }
                </style>
                <script>
                jQuery.noConflict();
                jQuery(document).ready(function($){
                    
                    var mySwiper = new Swiper ('.hero_banner_slider', {
                        direction: 'horizontal', 
                        autoHeight: false,
                        loop: true, 
                        speed:1000,
                        height: 550,
                        freeMode: true,
                        pagination: {
                            el: '.swiper-pagination',
                            clickable :true,
                        }, 
                    }) 
                    function slider(){
                        mySwiper.slideNext(1000,false);
                        var t2 = window.setTimeout(slider,8000); 
                    }  
                    var t1 = window.setTimeout(slider,7000); 
                });    
                </script>";  
                }