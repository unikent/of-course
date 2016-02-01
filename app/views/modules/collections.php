<h1>Module Catalogue</h1>

<h2>Collections</h2>

<ul>
	<?php foreach($collections as $code => $collection){ ?>
			<li><a href="<?php echo $collection->code ?>"><?php echo $collection->title ?></a></li>	
	<?php } ?>	
</ul>