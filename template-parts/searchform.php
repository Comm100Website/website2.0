<!--<div class="searchform">
	<form method="get" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<p>
			<input type="text" name="s" id="searchbox" />	
			<input type="submit" src="<?php bloginfo('template_directory'); ?>/images/searchbutton.jpg" id="searchbutton" value=""/>		
		</p>
	</form>
</div>-->
<div class="searchform clearfix">
    <form method="get" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <input type="text" name="s" id="search" placeholder="Search Blog..." class="form-control c-square c-theme input-lg"/>
        <input type="hidden" id="search-submit" value="Search" />
        <input type="submit" class="search" value=""/>
        
    </form>
</div>