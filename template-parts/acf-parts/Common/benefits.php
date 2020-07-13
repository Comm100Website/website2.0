<?php


if( get_row_layout() == 'benefits' ) {
    $background_color = get_sub_field('background_color');
    if( $background_color == "grey" ){ $background_color_class = "promotion";}
    echo '<div class="c-content-box c-size-md benefits '.$background_color_class.'">';
    echo '<div class="container">';
    echo '<div class="row">';

        $title = get_sub_field('title');
        if($title) {
            echo "<h3 class='text-center'>".$title."</h3>";
        }
        $subtitle = get_sub_field('subtitle');
        if($title) {
            echo '<p class="text-center">'.$subtitle.'</p>';
        }
        
        
        if( have_rows('benefit') ) {
            echo '<div class="row c-margin-t-20">';
            //
            while( have_rows('benefit') ) {
                the_row();
                echo '<div class="col-md-4 text-center" style="padding:40px 40px 0px 40px;">';
                    $icon = get_sub_field('icon');
                    if($icon){
                        echo '<img src="'.$icon['url'].'" alt="'.$icon['alt'].'" width="80" style="margin-bottom: 30px;">';
                    }
                    $title = get_sub_field('title');
                    if($title) {
                        echo '<h5 class="three-column__title">'.$title.'</h5>';
                    }
                    $description = get_sub_field('description');
                    if($description) {
                        echo '<p style="margin: 30px auto 0;line-height: 30px;font-size: 18px;">'.$description.'</p>';
                    }
                
                echo '</div>';
            }
            //
            echo '</div>';
        }

    echo '</div>';
    echo '</div>';
    echo '</div>';
}