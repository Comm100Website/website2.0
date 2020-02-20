<?php
use Roots\Sage\Assets;
// /resources/前端页面

//从cookie获取访问者的audience信息
$db_userinfo_str = str_replace('\"','"',$_COOKIE["db_userinfo"]);
$db_userinfo_arr = json_decode($db_userinfo_str,true);


    
//获取访问者的audience信息
$demandbaseInfoJson = (array)json_decode(str_replace('\"','"',$_COOKIE["db_userinfo"]),true);
    //获取访问者的audience信息
    if($demandbaseInfoJson["sub_industry"] == "Insurance"){
        $demandbaseInfo_txt=$demandbaseInfoJson["sub_industry"];
    }
    else {
        $demandbaseInfo_txt=$demandbaseInfoJson["industry"];
    }
echo $demandbaseInfo_txt;
echo $db_userinfo_arr["sub_industry"];
?>
<?php
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
//正确
//print_r(get_demandbase_resources_tags());
?>




<style>
@media screen and (max-width:970px){
 .resource-select .col-sm-6{
  text-align:center;
 }
 
}

.ul_select ul,li{
            list-style: none;
}
.ul_select{
    display: inline-block;
   
    position: relative;
    font-size: 15px;
    color:#899599;
    text-align: left;
    font-family: "Ubuntu Light",sans-serif;
}
.ul_select span{
    display: inline-block;
    vertical-align: middle;
    width: 220px;
    height:46px;
    line-height: 46px;
    border:1px solid #d0d8de;
    padding-left: 14px;
    padding-right: 40px;
    box-sizing: border-box;
    position: relative;
    margin-left: 10px;
}
.ul_select button{
    height: 100%;
    width:40px;
    border:0;
    border-left: 1px solid #d0d8de;
    box-sizing: border-box;
    background: transparent;
    position: absolute;
    top:0;
    right: 0;
    cursor: pointer;
}
.ul_select:hover span,
.ul_select:hover button{
    border-color:#30a0d8;
}
.ul_select button:focus{
    outline: none;
}
.ul_select button:before{
    display: block;
    content:"";
    width:12px;
    height:12px;
    border-left:2px solid #d0d8de;
    border-top: 2px solid #d0d8de;
    box-sizing: border-box;
    background-color: transparent;
    transform: rotateZ(-135deg);
    position: absolute;
    top: 14px;
    left: 13.5px;
    cursor: pointer;
}
.ul_select ul{
    position: absolute;
    top: 46px;
    right: 0;
    padding-top: 6px;
    width: 220px;
    border:1px solid #d0d8de;
    border-top: 0;
    box-sizing: border-box;
    background-color: #fff;
    padding-left: 0px;
    z-index: 999;
    display: none;
}
.ul_select ul li{
    line-height: 35px;
    padding-left: 14px;
    box-sizing: border-box;
    cursor: pointer;
}
.ul_select ul li:hover{
    background-color: #edf2f3;
}
.resource-select {
    margin-top: 16px;
    margin-bottom: 42px;
}
</style>
<script type="text/javascript">
    //修改url参数函数
    function updateQueryStringParameter(uri, key, value) {
        if(!value) {
            return uri;
        }
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        }
        else {
            return uri + separator + key + "=" + value;
        }
    }
    //获取url的参数值函数
    function RequestParameter(){
        var url = window.location.search; //获取url中"?"符后的字串
        var theRequest = new Object();
        if (url.indexOf("?") != -1) {
            var str = url.substr(1);
            var strs = str.split("&");
            for(var i = 0; i < strs.length; i ++) {
                theRequest[strs[i].split("=")[0]]=(strs[i].split("=")[1]);
            }
        }
        return theRequest
    }
</script>
<script>
    //获取当前url
    var url = window.location.href;
</script>
    <div class="c-layout-page c-layout-page-fixed primary-page">
        <div class="c-content-box c-size-md">
            <div class="container">
                <div class="row">
                	<?php
					//测试主查询
					// print_r($wp_query);
					?>
                    <div class="col-xs-12">
                        <h1 class="c-center">Resource Base</h1>

                        <h2 class="c-margin-t-20 c-margin-b-60 text-center">Everything you need to know to start the conversation</h2>
                        <?php
	                        $resourceCategories = get_terms([
	                            'taxonomy' => 'commresourcecat',
	                            'hide_empty' => true,
	                            'orderby' => 'term_order',
	                        ]);
	
	                        $navItems = [
	                            'All' => get_site_url().'/resources/'
	                        ];
	
	                        foreach($resourceCategories as $cat):
	                            $navItems[$cat->name] = get_term_link($cat, 'commresourcecat');
	                        endforeach;
	
	                        $navItems['Blog'] = get_site_url().'/blog/';
                        ?>
                        <?php     
                            // WP_Term_Query arguments
                            $args = array(
                                'taxonomy' => array( 'commresourcetag' ),
                                'orderby' => 'term_order',
                            );

                            // The Term Query
                            $term_query = new WP_Term_Query( $args );
                            
                            
                            //print_r($term_query);
                            wp_reset_postdata();
                            $resource_tags=array();
                            $resource_tags["All"] = "All";
							
                            if ( ! empty( $term_query->terms ) ) {
                                foreach ( $term_query ->terms as $term ) {
                                    //$resource_tags[$term->name]=$term->term_id;
                                    
                                    if(get_field('activate_demandbase',$term)){
                                    	//如果此TAG有demandbase设置
                                    	$demandbase_audiences = get_field('demandbase_audience',$term);
                                    	$demandbase_titles=array();
                                    	foreach ( $demandbase_audiences  as $demandbase_audience){
                                    		//print_r($demandbase_audience);
                                    		//echo $demandbase_audience->post_title;
                                    		$demandbase_titles[]=trim($demandbase_audience->post_title);
                                    		
                                    	}                               	
                                    	//将post_title字段转为字符串
                                    	//$demandbase_titles = implode(",", $demandbase_titles);  //数组转字符串，由逗号分隔
                                    	//echo $demandbase_titles;
                                    	if( in_array(trim($demandbaseInfo_txt),$demandbase_titles)){
                                    		//如果访客属性属于字段设置则显示
                                    		$resource_tags[$term->name]=$term->slug;
                                    		//echo "1";
                                    	}
                                    	else {
                                    		//不包含则跳过
                                    		//echo "0";
                                    	}
                                	}else{
                                		//没有设置则直接显示
                                		$resource_tags[$term->name]=$term->slug;
                                	}
                                }
                            }
                        ?>
                        <div class="resource-select clearfix">
                            <div class="col-xs-12 col-sm-6 text-right">
                                <div class="ul_select" id="Topic_select">
                                    Topic<span id="Topic_select_txt">
                                        <?php
                                            if($_GET["topic"] && $_GET["topic"]!="All"){
                                                $term = get_term_by('slug',$_GET["topic"],'commresourcetag');
                                                echo $term->name;
                                            }else {
                                                echo "All";
                                            }
                                        ?>
                                    </span>
                                    <button id="Topic_select_btn"></button>
                                    <ul id="Topic_select_list">           
                                        <?php 
                                        foreach ($resource_tags as $label => $url):
                                            $is_active = ((is_post_type_archive('commresource') && $label == 'All') || $url == get_site_url().$_SERVER['REQUEST_URI']);
                                            echo '<li class="noPick" data-url="'.$url.'">'.$label.'</li>';
                                        endforeach;
                                        ?>                
                                    </ul>
                                </div>
                                <?php 
                                	$current_term=get_term_by('id',get_queried_object_id(),'commresourcecat'); 
                                	if($current_term->slug){
                                		$Topic_jump = "/resources/".$current_term->slug."/";
                                	}else{
                                		$Topic_jump = "/resources/";
                                	}
                                ?>

                                <script type="text/javascript">
                                    //Topic 的js功能
                                    var Topic_select = document.getElementById("Topic_select");
                                    var Topic_span = document.getElementById("Topic_select_txt");
                                    var Topic_select_btn = document.getElementById("Topic_select_btn");
                                    var Topic_select_list = document.getElementById("Topic_select_list");
                                    var li= document.getElementsByClassName("noPick");
                                    var Topic_flag=true;
                                    Topic_select.onmouseover =function(){
                                        
                                        Topic_select_list.style.display="block";
                                        Topic_flag=false;
                                        
                                    };
                                    Topic_select.onmouseout =function(){
                                        
                                        Topic_select_list.style.display="none";
                                        Topic_flag = true;
                                        
                                    };
                                    Topic_select_list.addEventListener("click",function(e){
                                        //alert(e.target.innerHtml);
                                        //Topic_span.innerHtml = e.target.innerHtml;

                                        Topic_select_list.style.display="none";
                                        Topic_flag = true;
                                        window.location.href=updateQueryStringParameter("<?php echo $Topic_jump;?>","topic",e.target.getAttribute("data-url"));
                                    });
                                </script>                                   
                                <?php
                                    //获取当前的自定义标签
                                    $current_tag = $_GET["topic"];                        
                                ?>
                                <script type="text/javascript">                          
                                    
                                </script>
                            </div>
                            <script type="text/javascript">
                                function type_select_jump(jump) {
                                    if(jump == "<?php echo get_site_url().'/blog/'; ?>"){
                                        window.open(jump,'_blank');
                                        return;
                                    }                                   
                                    if(RequestParameter()["topic"] && jump != "<?php echo get_site_url().'/blog/'; ?>" ){
                                        jump=jump+"?topic="+RequestParameter()["topic"];
                                        
                                        window.location.href=jump;
                                    } else {
                                        window.location.href=jump;
                                    }
                                    

                                }
                            </script>
                            <div class="col-xs-12 col-sm-6">
                                <div class="ul_select" id="Type_select">
                                Type<span id="Type_select_txt">
                                        All
                                    </span>
                                    <button id="Type_select_btn"></button>
                                    <ul id="Type_select_list">   
                                    <?php 
                                        foreach ($navItems as $label => $url):
                                            $is_active = ((is_post_type_archive('commresource') && $label == 'All') || $url == get_site_url().$_SERVER['REQUEST_URI']);
                                            echo '<li class="noPick" data-url="'.$url.'">'.$label.'</li>';
                                        endforeach;
                                    ?>
                                    </ul>
                                </div>
                                <script type="text/javascript">
                                    var Type_select = document.getElementById("Type_select");
                                    var Type_span = document.getElementById("Type_select_txt");
                                    var Type_select_btn = document.getElementById("Type_select_btn");
                                    var Type_select_list = document.getElementById("Type_select_list");
                                    var li= document.getElementsByClassName("noPick");
                                    var Type_flag=true;
                                    Type_select.onmouseover =function(){
                                        
                                            Type_select_list.style.display="block";
                                            Type_flag=false;
                                        
                                    };
                                    Type_select.onmouseout =function(){
                                        
                                            Type_select_list.style.display="none";
                                            Type_flag = true;
                                        
                                    };
                                    Type_select_list.addEventListener("click",function(e){
                                        if(e.target.innerText != 'Blog'){
                                            Type_span.innerText = e.target.innerText;
                                        }
                                        Type_select_list.style.display="none";
                                        Type_flag = true;
                                        type_select_jump(e.target.getAttribute("data-url"));
                                    });

                                </script>


                              
                                <?php
                                    //获取当前的自定义分类
                                    $current_term=get_term_by('id',get_queried_object_id(),'commresourcecat');                        
                                ?>
                                <script type="text/javascript">
                                    var span = document.getElementById("Type_select_txt");
                                    if("<?php echo $current_term->name;?>"){
                                        span.innerText = "<?php echo $current_term->name;?>";
                                    }
                                </script>
                            </div>
                        </div> <!-- resource-select 选择模块 -->
                        <?php
                        //正文开始
                        
                        //筛选出特色文章
                        if (!is_paged()):
                        	
                        	//2个特色图片
                            $args = [
                                'post_type' => 'commresource',
                                'posts_per_page' => 2,
                                'meta_query' => [
                                    [
                                        'key' => 'featured_resource',
                                        'value' => '1'
                                    ]
                                ]
                            ];
							//如果现在有分类的话，必须是当前分类
                            if (is_tax('commresourcecat')):
                                $args['tax_query'][] = 
                                    [
                                        'taxonomy' => 'commresourcecat',
                                        'field'    => 'term_id',
                                        'terms'    => get_queried_object_id(),
                                    ]
                                ;
                            endif;
							//如果有Tag参数，则筛选出当前Tag的文章
                            if ($_GET["topic"] && $_GET["topic"] != 'All'){
                            	
                            	
                            	
                                $args['tax_query'][] = 
                                    
                                    [
                                        'taxonomy' => 'commresourcetag',
                                        'field'    => 'slug',
                                        'terms'    => $_GET["topic"],
                                    ]
                                ;

                                $args['tax_query'][] = 
                                    
                                    [
                                        'relation' => 'AND',
                                    ]
                                ;


                                
                                $args['tax_query'][] = 

                                [
                                    'taxonomy' => 'commresourcetag',
                                    'field'    => 'slug',
                                    'terms'    => get_demandbase_resources_tags(),
                                    'operator' => 'IN',  
                                   
                                ];





                            } else {
                            	//没有TAG参数
                            	$args['tax_query'][] = 
                                    
                                    [
                                        'taxonomy' => 'commresourcetag',
                                        'field'    => 'slug',
                                        'terms'    => get_demandbase_resources_tags(),
                                        'operator' => 'IN',  
                                      
                                    ]
                                ;

                                $args['tax_query'][] = 
                                    
                                    [
                                        'relation' => 'AND',
                                    ]
                                ;

                            	
                            }//特色文章结束                       
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            //  调试参数
                            //print_r($args);
                            $featuredResources = new WP_Query($args);
							$featured = 0;
                            if ($featuredResources->have_posts()):
                            	$featured = 1;
                                echo '<div class="resource-promotion clearfix">';
                                // loop through the rows of data
                                while ($featuredResources->have_posts()):
                                    $featuredResources->the_post();
                                    ?>
                                    <div class="col-xs-12 col-sm-6">
                                        <?= get_template_part('template-parts/resource', 'tile'); ?>
                                    </div>
                                <?php
                                endwhile;
                                echo '</div>';

                                wp_reset_postdata();
                            endif;
                        endif;
                        
                        if (have_posts()  ){
                        ?>
                        <div class="resource-list post-tiles clearfix">
                        <?php
                        $ctas = get_field('resources_ctas', 'options');
                        $postIndex = 0;
                        $ctaIndex = 0;
                        
                        
                        while (have_posts()) : the_post();
                        ?>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <?= get_template_part('template-parts/resource', 'tile'); ?>
                            </div>

                            <?php
                            if ($ctas && !is_paged() && in_array($postIndex, [4, 7]) && $ctaIndex < count($ctas)):
                            ?>
                                <div class="resource-item col-xs-12 col-sm-6 col-md-4">
                                    <div class="CTA">
                                        <?= Assets\get_acf_image($ctas[$ctaIndex]['image'], '', 120, 120); ?>
                                        <div class="resource-item--title"><?= $ctas[$ctaIndex]['title']; ?></div>
                                        <?php
                                        if (isset($ctas[$ctaIndex]['subtitle'])):
                                            echo $ctas[$ctaIndex]['subtitle'];
                                        endif;

                                        if (isset($ctas[$ctaIndex]['link'])):
                                            $linkClass = 'c-redirectLink';

                                            switch ($ctas[$ctaIndex]['link_type']):
                                                case 'green' :
                                                    $linkClass = 'btn btn-xlg btn-link--green';
                                                    break;
                                                case 'blue' :
                                                    $linkClass = 'btn btn-xlg c-theme-btn';
                                                    break;
                                                case 'white' :
                                                    $linkClass = 'btn btn-xlg c-btn-border-2x c-theme-btn';
                                                    break;
                                                default: break;
                                            endswitch;
                                        ?>
                                            <div class="resource-item-CTA-link">
                                                <a class="<?= $linkClass; ?>" href="<?= $ctas[$ctaIndex]['link']['url']; ?>" target="<?= $ctas[$ctaIndex]['link']['target']; ?>"><?= $ctas[$ctaIndex]['link']['title']; ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php
                                $ctaIndex++;
                            endif;

                            $postIndex++;
                        endwhile;
                        ?>
                        </div> <!-- resource-list 正文列表结束 -->
                        <?php
                        	 //获取当前的自定义分类
							$current_term=get_term_by('id',get_queried_object_id(),'commresourcecat');
							//print_r($current_term);
							//echo $current_term->slug;
							//TAG或者子分类下不显示分页
                        	if((!$_GET["topic"] || $_GET["topic"]=="All") && !$current_term->slug){
		                        //分页
		                        the_posts_pagination([
		                            'mid_size'  => 2,
		                            'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'textdomain' ),
		                            'next_text' => __( '<i class="fa fa-angle-right"></i>', 'textdomain' ),
		                            'screen_reader_text' => ''
		                        ]);                      
                        	}
                        } else { 
                        if($featured != 1){
						//没有正文，没有特色文章的时候显示
                        ?>
                        <div class="container">
                            <div class="post text-center" style="margin:60px 0px;">
                            
                                <p>Whoops! No content to see here -- but we're working on it! Please try another filter.</p>
                               
                            </div>
                        </div>
                        <?php } } //正文结束?>
                    </div>
                </div>
            </div>
        </div>
    </div>