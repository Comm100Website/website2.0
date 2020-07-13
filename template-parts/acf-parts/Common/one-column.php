<?php
 // check current row layout
 use Roots\Sage\Assets;
 
 if( get_row_layout() == '1-column' ){

    $background_color = get_sub_field('background_color');
    if( $background_color == "grey" ){ 
        $background_color_class = "promotion";
    }

    $headimage = get_sub_field('image');
    $headicon = get_sub_field('icon');
    $headline = get_sub_field('title');
    $body = get_sub_field('description');
    $cta = get_sub_field('cta');
    $btn_group = get_sub_field('btn_group');


    echo '<div class="c-content-box c-size-md column-1 '.$background_color_class.'">';
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
                $groupClass = 'row';
                $btnClass .= 'btn btn-xlg c-btn-border-2x c-theme-btn';
               
            }
            $btnClass = 'btn btn-xlg c-btn-border-2x c-theme-btn';
            // check if the nested repeater field has rows of data
            if( have_rows('btn_repeater') ):

                echo '<div class="'.$groupClass.' btn-link-group c-margin-t-60 btn-color-'.$buttonColor.' btn-link-group--' . $type . '">';

                    // loop through the rows of data
                while ( have_rows('btn_repeater') ) : the_row();

                    $btn_link = get_sub_field('button');

                    if ($type == 'image') {
                        echo '<div class="col-sm-6 btn-repeater-image-type">';
                    }

                    if (get_sub_field('button_image')) {
                        echo '<img src="'.get_sub_field('button_image')['url'].'" alt="'.get_sub_field('button_image')['alt'].'"  />';
                    }

                    echo  '<a href="' . $btn_link['url'] . '" target="' . $btn_link['target'] . '" class="'.$btnClass.'" style="">' . $btn_link['title'] . '</a>';

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
 }