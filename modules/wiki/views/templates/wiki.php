{include:header}

<div class="module">
	
	<div id="tpl-wiki">
	
		<div class="col1">
	
			<h3>Categories</h3>
	
			<ul class="menu">
				<li><a href="/wiki/">Home</a></li>		
				{wiki:categories}
				<li><a href="/wiki/pages/">Uncategorized</a></li>
			</ul>
					
		</div>
	
		<div class="col2">
	
			<h1 class="headingleft">{page:heading}</h1>
			
			<div class="search">
					
				<form method="post" action="/wiki/search/">
			
					<label for="searchbox">Search:</label>
					<input type="text" name="query" id="searchbox" class="searchbox" maxlength="255" value="" />
					<input type="image" src="<?php echo $this->config->item('staticPath'); ?>/images/btn_search.gif" id="searchbutton" />
			
				</form>
			
			</div>
			<br class="clear" />

			{page:description}
	
			{if wikipages}
			
				<ul>
				{wikipages}
					<li><a href="{wikipage:link}">{wikipage:title}</a></li>
				{/wikipages}
				</ul>
				
			{else}
			
				<p>No wiki pages added yet.</p>
				
			{/if}
	
		</div>
	
	</div>

</div>

{include:footer}