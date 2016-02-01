<h1><?php echo $error; ?></h1>

<h2>Other Collections</h2>

<ul>
	<?php foreach($collections as $code => $collection){ ?>
			<li><a href="<?php echo $collection->code ?>"><?php echo $collection->title ?></a></li>	
	<?php } ?>	
</ul>