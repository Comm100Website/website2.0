<?php
use Roots\Sage\Assets;
// check current row layout
if( get_row_layout() == 'logo_v2' ):

$logo_repeater = get_sub_field('logo_repeater');

// check if the nested repeater field has rows of data
if( have_rows('logo_repeater') ):

    $pondClass = 'single-line';

    if (count($logo_repeater) >= 6) {
        $pondClass = 'multi-line';
    }

        echo "<style>
            .logo-pond .item:first-child {
            	padding-left: 0px;
            }
            
            .logo-pond .item:last-child {
            	padding-right: 0px;
            }
            </style>";


    echo '<div class="container">';
        echo '<div class="row">';
            echo '<div class="c-content-client-logos-slider-1  c-bordered">';

                echo '<div class="logo-pond d-flex flex-nowrap align-items-center justify-content-space-between '. $pondClass .' hidden-xs">';
               
                    // loop through the rows of data
                    while ( have_rows('logo_repeater') ) : the_row();

                        $logo_image = get_sub_field('logo_image');

                        echo    '<div class="item">'.Assets\get_acf_image($logo_image, 'c-img-pos grayscale', 140, 180).'</div>';
                    endwhile;

                echo '</div>';
                echo '<div class="logo-pond visible-xs">';
               
                    // loop through the rows of data
                    while ( have_rows('logo_repeater') ) : the_row();

                        $logo_image = get_sub_field('logo_image');

                        echo    '<div class="col-xs-12 text-center">'.Assets\get_acf_image($logo_image, 'c-img-pos grayscale', 140, 180).'</div>';
                    endwhile;

                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';

endif;

endif;