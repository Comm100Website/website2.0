<?php
//定义Resources文章类型
namespace Roots\Sage\CustomPostTypes\Resources;

function register_resource_post_type() {
    $labelSingular = 'Resource';
    $labelPlural = 'Resources';

    $labels = array(
        'name'               => _x($labelPlural, '', 'RPS'),
        'singular_name'      => _x($labelPlural.'', '', 'RPS'),
        'menu_name'          => _x($labelPlural, '', 'RPS'),
        'name_admin_bar'     => _x($labelPlural, '', 'RPS'),
        'add_new'            => _x('Add New '.$labelSingular, '', 'RPS'),
        'add_new_item'       => __('Add New '.$labelSingular, 'RPS'),
        'new_item'           => __('New '.$labelSingular, 'RPS'),
        'edit_item'          => __('Edit '.$labelSingular, 'RPS'),
        'view_item'          => __('View '.$labelSingular, 'RPS'),
        'all_items'          => __('All '.$labelPlural, 'RPS'),
        'search_items'       => __('Search '.$labelPlural, 'RPS'),
        'parent_item_colon'  => __('Parent '.$labelSingular.':', 'RPS'),
        'not_found'          => __('No '.$labelSingular.' found.', 'RPS'),
        'not_found_in_trash' => __('No '.$labelSingular.' found in Trash.', 'RPS')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'resources/%commresourcecat%', 'with_front' => false, 'hierarchical' => true),
        'has_archive'        => 'resources',
        'menu_icon'          => 'dashicons-analytics',
        'capability_type'    => 'post',
        'hierarchical'       => true,
        'menu_position'      => null,
        'taxonomies'         => array('post_tag'),
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' , 'tags', 'revisions')
    );

    register_post_type('commresource', $args);
}
add_action('init', __NAMESPACE__ . '\\register_resource_post_type');

function register_resource_category_taxonomy() {
    $labelSingular = 'Resource Category';
    $labelPlural = 'Resource Categories';

    $labels = array(
        'name'              => _x($labelPlural, 'taxonomy general name' ),
        'singular_name'     => _x($labelSingular, 'taxonomy singular name' ),
        'search_items'      => __( 'Search '.$labelPlural ),
        'all_items'         => __( 'All '.$labelPlural ),
        'parent_item'       => __( 'Parent '.$labelPlural ),
        'parent_item_colon' => __( 'Parent '.$labelPlural.':' ),
        'edit_item'         => __( 'Edit '.$labelPlural ),
        'update_item'       => __( 'Update '.$labelPlural ),
        'add_new_item'      => __( 'Add New '.$labelPlural ),
        'new_item_name'     => __( 'New '.$labelPlural.' Name' ),
        'menu_name'         => __( $labelPlural ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'resources', 'with_front' => false)
    );

    register_taxonomy('commresourcecat', 'commresource', $args);
}
add_action('init', __NAMESPACE__ . '\\register_resource_category_taxonomy');

function register_resource_tag_taxonomy() {
    $labelSingular = 'Resource Tag';
    $labelPlural = 'Resource Tags';

    $labels = array(
        'name'              => _x($labelPlural, 'taxonomy general name' ),
        'singular_name'     => _x($labelSingular, 'taxonomy singular name' ),
        'search_items'      => __( 'Search '.$labelPlural ),
        'all_items'         => __( 'All '.$labelPlural ),
        'parent_item'       => __( 'Parent '.$labelPlural ),
        'parent_item_colon' => __( 'Parent '.$labelPlural.':' ),
        'edit_item'         => __( 'Edit '.$labelPlural ),
        'update_item'       => __( 'Update '.$labelPlural ),
        'add_new_item'      => __( 'Add New '.$labelPlural ),
        'new_item_name'     => __( 'New '.$labelPlural.' Name' ),
        'menu_name'         => __( $labelPlural ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
       
        'publicly_queryable' => false,
        'show_admin_column' => true,
        'query_var'         => true,
    );

    register_taxonomy('commresourcetag', 'commresource', $args);
}
add_action('init', __NAMESPACE__ . '\\register_resource_tag_taxonomy');

//Update the resource link structure so we can have URL's like comm100.com/resources/CATEGORY/RESOURCE
function commresource_post_link($post_link, $id = 0){
    $post = get_post($id);

    if (is_object($post)){
        $terms = wp_get_object_terms($post->ID, 'commresourcecat');

        if( $terms ){
            return str_replace('%commresourcecat%' , $terms[0]->slug , $post_link);
        }
    }

    return $post_link;
}

add_filter('post_type_link', __NAMESPACE__.'\\commresource_post_link', 1, 3);

function register_resource_rewrite_rules($wp_rewrite) {
    // $resource_rules  = [
    //                 'resources/(.+)/(.+)/(.+)/?$' => 'index.php?commresource=$matches[3]',
    //                 'resources/(.+)/(.+)/?$' => 'index.php?commresourcecat=$matches[2]'
    // ];

    // return array_merge($newRules, $wp_rewrite);
    $resource_rules = array(
        'resources/([^/]+)/?$' => 'index.php?commresourcecat=' . $wp_rewrite->preg_index( 1 ), // 'resources/any-character/'
        'resources/([^/]+)/([^/]+)/?$' => 'index.php?post_type=commresource&commresourcecat=' . $wp_rewrite->preg_index( 1 ) . '&commresource=' . $wp_rewrite->preg_index( 2 ), // 'resources/any-character/post-slug/'
        'resources/([^/]+)/([^/]+)/page/(\d{1,})/?$' => 'index.php?post_type=commresource&commresourcecat=' . $wp_rewrite->preg_index( 1 ) . '&paged=' . $wp_rewrite->preg_index( 3 ), // match paginated results for a sub-category archive
        'resources/([^/]+)/([^/]+)/([^/]+)/?$' => 'index.php?post_type=commresource&commresourcecat=' . $wp_rewrite->preg_index( 2 ) . '&commresource=' . $wp_rewrite->preg_index( 3 ), // 'resources/any-character/sub-category/post-slug/'
        'resources/([^/]+)/([^/]+)/([^/]+)/([^/]+)/?$' => 'index.php?post_type=commresource&commresourcecat=' . $wp_rewrite->preg_index( 3 ) . '&commresource=' . $wp_rewrite->preg_index( 4 ), // 'resources/any-character/sub-category/sub-sub-category/post-slug/'
    );

    // var_dump($wp_rewrite);
    return array_merge($resource_rules, $wp_rewrite->rules);
    // $wp_rewrite->rules = $resource_rules + $wp_rewrite->rules;
    // return $wp_rewrite;
}
add_action('generate_rewrite_rules', __NAMESPACE__.'\\register_resource_rewrite_rules');



//找到当前页面不能显示的TAGs，返回数组
function get_demandbase_resources_tags() {
	$demandbaseInfoJson = (array)json_decode(str_replace('\"','"',$_COOKIE["db_userinfo"]),true);
	//获取访问者的audience信息
	if($demandbaseInfoJson["sub_industry"] == "Insurance"){
		$demandbaseInfo_txt=$demandbaseInfoJson["sub_industry"];
	}
	else {
		$demandbaseInfo_txt=$demandbaseInfoJson["industry"];
	}
	
	// WP_Term_Query arguments
	$args = array(
	    'taxonomy' => array( 'commresourcetag' ),
	);
	
	// The Term Query
	//$term_query = new WP_Term_Query( $args );
	$term_query=get_terms('commresourcetag');
	//print_r($term_query);
	//wp_reset_postdata();
	$demandbase_tags_slug=array();
	if ( ! empty( $term_query ) ) {
		
	    foreach ( $term_query  as $term ) {
	    	
		    if(get_field('activate_demandbase',$term)){
		    	//如果此TAG有demandbase设置
		    	
		    	//取出所有的设置，数组
		    	$demandbase_audiences = get_field('demandbase_audience',$term);
		    	//取出标题，数组
		    	$demandbase_titles=array();
		    	foreach ( $demandbase_audiences  as $demandbase_audience){
		    		$demandbase_titles[]=trim($demandbase_audience->post_title);	    		
		    	}
		    	
		    	if( in_array(trim($demandbaseInfo_txt),$demandbase_titles)){
		    		//访客属性属于字段设置，则记录此TAG
		    		$demandbase_tags_slug[] = $term->slug;
		    	} else {
		    		//TAG有设置，并且当前访客不属于设置范围类，不记录此TAG
		    		
		    	}
			}else{
				//tag没有设置,则记录此TAG
                $demandbase_tags_slug[] = $term->slug;
				 	
	    	}
	    }
	}
	
	return $demandbase_tags_slug;
	
}





function exclude_resources($query) {
    if(!is_admin() && $query->is_main_query() && (is_post_type_archive('commresource') || is_tax('commresourcecat'))) {
        //We previously tried to set these up as meta_query parameters, but the DB is too big to handle those sorts of joines,
        //so we'll do two smaller queries to grab the excluded posts and then just add them to the post__not_in parameter
        
        //所有的exclude文章不显示
        $args = array(
            'post_type' => 'commresource',
            'meta_key' => 'exclude_from_archive',
            'meta_value' => '1',
            'posts_per_page' => -1
        );
        $excludedPosts = get_posts( $args );
		//!!! 这里的设置需要和列表中对应
		//2篇特色文章
        $args = array(
            'post_type' => 'commresource',
            'meta_key' => 'featured_resource',
            'meta_value' => '1',
            'posts_per_page' => 2
        );
		//当前分类下
        if (is_tax('commresourcecat')):
            $args['tax_query'] = [
                [
                    'taxonomy' => 'commresourcecat',
                    'field'    => 'term_id',
                    'terms'    => get_queried_object_id(),
                ]
            ];
        endif;
        

        
        //如果URL带标签参数，则需要在当前TAG中排除
        if ($_GET["topic"] && $_GET["topic"] != 'All'){
            $args['tax_query'][] = [
                'relation' => 'AND',
                [
                    'taxonomy' => 'commresourcetag',
                    'field'    => 'slug',
                    'terms'    => array($_GET["topic"]),         
                ],
                [
                    'taxonomy' => 'commresourcetag',
                    'field'    => 'slug',
                    'terms'    => get_demandbase_resources_tags(),
                    'operator' => 'IN',  
                   
                ],
            ];
        }else {        	
        	$args['tax_query'][] = [
                'relation' => 'AND',              
                [
                    'taxonomy' => 'commresourcetag',
                    'field'    => 'slug',
                    'terms'    => get_demandbase_resources_tags(),
                    'operator' => 'IN',  
                   
                ],
            ];
        	
        }
        $featuredResourcePosts = get_posts( $args );
        

		
		

        if ($featuredResourcePosts) {
            $excludedPosts = array_merge($excludedPosts, $featuredResourcePosts);
        }

        
        




        if ($excludedPosts) {
            $excludedPostIDs = wp_list_pluck($excludedPosts, 'ID');
            $query->set('post__not_in', $excludedPostIDs);
        }
        
         
        
        
        //如果URL带标签参数，则需要在主查询query变量中添加标签参数
     	if ($_GET["topic"] && $_GET["topic"] != 'All'){
            $query->set('tax_query', [
        			'relation' => 'AND',
        			[
			            'taxonomy' => 'commresourcetag',
			            'field'    => 'slug',
			            'terms'    => $_GET["topic"],
			            'operator' => 'IN',
        			],
        			[
        				'taxonomy' => 'commresourcetag',               
				        'field' => 'slug',                    
				        'terms' => get_demandbase_resources_tags(),    
				        'operator' => 'IN',  
        			
        			]
            ]);
        }else{
      	$query->set('tax_query', [
        			'relation' => 'AND',
        			
        			[
        				'taxonomy' => 'commresourcetag',               
				        'field' => 'slug',                    
				        'terms' => get_demandbase_resources_tags(),    
				        'operator' => 'IN',  
        			
        			],
            ]);
      	
        }
      	//当前分类下
        if (is_tax('commresourcecat') || ($_GET["topic"] && $_GET["topic"] != 'All')){
            $query->set('posts_per_page','-1' );
        }
    }
}
add_action('pre_get_posts', __NAMESPACE__.'\\exclude_resources');

function offset_resource_and_post( $query ) {
    if(!is_admin() && $query->is_main_query() && (is_post_type_archive('commresource') || is_tax('commresourcecat') || is_home() || is_post_type_archive('post') || is_tax('category') || is_tax('tag'))) {
        $ppp = get_option('posts_per_page');

        $offset = 1;

        if (is_post_type_archive('commresource') || is_tax('commresourcecat')):
            $offset = 3 - count(get_field('resources_ctas', 'options'));
        endif;

        if (is_home() || is_post_type_archive('post') || is_tax('category') || is_tax('tag')):
            $blogCTAs = get_field('blog_ctas', 'options');
            $ctaCount = 0;

            if ($blogCTAs):
                foreach($blogCTAs as $key => $cta):
                    if(isset($cta['feature_in_archive']) && $cta['feature_in_archive']):
                        $ctaCount++;
                    endif;
                endforeach;
            endif;

            if ($ctaCount >= 3) {
                $ctaCount = 3;
            }

            $offset = 3 - $ctaCount + 1;
        endif;

        if ($offset > 0) {
            if (!$query->is_paged()) {
                $query->set('posts_per_page',$offset + $ppp);
            } else {
                $offset = $offset + ( ($query->query_vars['paged']-1) * $ppp );
                $query->set('posts_per_page',$ppp);
                $query->set('offset',$offset);
            }
        }
        //当前分类下
        if (is_tax('commresourcecat') || ($_GET["topic"] && $_GET["topic"] != 'All')){
            $query->set('posts_per_page','-1' );
        }
    }
}
add_action('pre_get_posts', __NAMESPACE__.'\\offset_resource_and_post');

function offset_resource_and_post_pagination($found_posts, $query) {
    $offset = 1;

    if (is_post_type_archive('commresource') || is_tax('commresourcecat')):
        $offset = 3 - count(get_field('resources_ctas', 'options'));
    endif;

    if (is_home() || is_post_type_archive('post') || is_tax('category') || is_tax('tag')):
        $offset = 3 - count(get_field('blog_ctas', 'options')) + 1;
    endif;

    if($offset > 0 && !is_admin() && $query->is_main_query() && (is_post_type_archive('commresource') || is_tax('commresourcecat') || is_home() || is_post_type_archive('post') || is_tax('category') || is_tax('tag'))) {
        $found_posts = $found_posts - $offset;
    }
    return $found_posts;
}
add_filter( 'found_posts', __NAMESPACE__.'\\offset_resource_and_post_pagination', 10, 2 );