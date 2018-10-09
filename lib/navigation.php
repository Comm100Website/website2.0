<?php
namespace Roots\Sage\Navigation;

//Add Page Navigations
function pagenavi( $before = '', $after = '', $p = 2 ) {

    if ( is_singular() ) return;

    global $wp_query, $paged;
    //$max_page = $wp_query->max_num_pages;
    $max_page = ceil(($wp_query->found_posts-1)/get_option('posts_per_page'));

    if ( $max_page == 1 ) return;

    if ( empty( $paged ) )
        $paged = 1;

    echo $before.'<ul class="c-content-pagination c-theme">'."\n";
    //echo '<span class="pages">Page: ' . $paged . ' of ' . $max_page . ' </span>';

    if ( $paged > 1 ) p_link( $paged - 1, 'Previous Page', '<i class="fa fa-angle-left"></i>' );
    if ( $paged > $p + 1 ) p_link( 1, 'First Page' );
    if ( $paged > $p + 2 ) echo "<li><a href='javascript:void(0);' class='page-numbers'>...</a></li>";

    for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
        if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<li class='c-active'><a href='javascript:void(0);'>{$i}</a></li>" : p_link( $i );
    }

    if ( $paged < $max_page - $p - 1 ) echo "<li><a href='javascript:void(0);' class='page-numbers'>...</a></li>";
    if ( $paged < $max_page - $p ) p_link( $max_page, 'Last Page' );
    if ( $paged < $max_page ) p_link( $paged + 1,'Next Page', '<i class="fa fa-angle-right"></i>' );
    echo '</ul>'.$after."\n";
}

function p_link( $i, $title = '', $linktype = '' ) {

    if ( $title == '' ) $title = "Page {$i}";
    if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
    echo "<li><a href='", esc_html( get_pagenum_link( $i ) ), "'>{$linktext}</a></li>";
}
