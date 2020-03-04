<?php
require('wp-blog-header.php');
header("Content-type: text/xml");
header('HTTP/1.1 200 OK');
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'
?>
	<url>
		<loc>https://www.comm100.com/resources/?topic=All</loc>
		<lastmod><?php $ltime = get_lastpostmodified(GMT);$ltime = gmdate('Y-m-d\TH:i:s+00:00', strtotime($ltime)); echo $ltime; ?></lastmod>
		<changefreq>always</changefreq>
		<priority>1.0</priority>
	</url>


<?php
	$resource_terms = get_terms([
        'taxonomy' => 'commresourcecat',
    ]);
    $resource_terms_arr = array();


  

    $count_cats = count($resource_terms);
	if($count_cats > 0){
		foreach ($resource_terms as $term) { 
			$resource_terms_arr[]= trim(get_term_link($term, $term->slug));
		}
	} /* 分类循环结束 */
	
	// print_r($resource_terms_arr);

	$resource_tags=get_terms('commresourcetag');

	$resource_tags_arr = array();

	$count_tags = count($resource_tags);


	if($count_tags > 0){
		foreach ($resource_tags as $resource_tag) {
			$resource_tags_arr[] = trim($resource_tag->slug);
		}
	}
	// print_r($resource_tags_arr);
	
	foreach ($resource_terms_arr as $resource_term_url) { 
		/* 不显示分类的url		 
		<url>
      		<loc><?php echo $resource_term_url; ?></loc>
      		<changefreq>weekly</changefreq>
      		<priority>0.8</priority>
  		</url>
		*/
		?>
		

  		<url>
      		<loc><?php echo $resource_term_url.'?topic=All'; ?></loc>
      		<changefreq>weekly</changefreq>
      		<priority>0.8</priority>
  		</url>
  		<?php
  			foreach ($resource_tags_arr as $resource_tag_url) {
  				?>
  					<url>
      					<loc><?php echo $resource_term_url.'?topic='.$resource_tag_url; ?></loc>
      					<changefreq>monthly</changefreq>
      					<priority>0.6</priority>
  					</url>

  				<?php
  			}
  		?>
		<?php
		
	}
	
?>
</urlset>