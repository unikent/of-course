<h1>Module Catalogue</h1>

<a href='<?php echo Flight::url("modules/collection");?>' class="pull-right">Browse all collections &raquo;</a>
<h2><?php echo $modules->title;?> </h2>

<table class="dataTable_main table table-striped" data-count="<?php echo $modules->total; ?>" data-ready="true">
	<thead>
		<tr>
			<th>Module Code</th>
			<th>Module title</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
		

<kentScripts>
	<script type="text/javascript" charset="utf8" src="<?php echo Flight::asset('js/build/moduletable.min.js'); ?>"></script>
	<script type="text/javascript" charset="utf-8">
		var collection = <?php echo json_encode(array_values((array)$modules->modules)); ?>;
	</script>
	<script>
	// Init first table
	module_datatable($(".dataTable_main"), {"data": collection, "api_endpoint": "<?php echo KENT_API_URL;?>v1/modules/collection/<?php echo  $collection; ?>", base_url: "<?php echo Flight::url('modules/module/'); ?>" });
 </script>
</kentScripts>