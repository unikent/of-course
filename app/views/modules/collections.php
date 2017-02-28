<div class="container">
	<?php \unikent\kent_theme\kentThemeHelper::breadcrumb(array("Courses"=>"/courses/", "Modules"=>"/courses/modules", "Collections"=>"")); ?>
	<h1>Module Catalogue</h1>

	<h2>Collections</h2>

	<ul>
		<?php foreach($collections as $code => $collection){ ?>
			<li><a href="<?php echo Flight::url("modules/collection/".$collection->code); ?>"><?php echo $collection->title ?></a></li>
		<?php } ?>
	</ul>
</div>
