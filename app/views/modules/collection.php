<h1>Module Catalogue</h1>

<a href='<?php echo Flight::url("modules/collection");?>' class="pull-right">Browse all collections &raquo;</a>
<h2><?php echo $modules->title;?> </h2>

<div class="advanced-search-boxes">
	<div class="advanced-search-filters">
		<div class="search-filter">
			<span>Filter by: </span><input class="advanced-text-search" type="text" placeholder="keyword">
		</div>
		<div class="search-select subject-search-div">
			<select class="subject-search input-large " data-col="4">
				<option value="">All subjects</option>
				<?php foreach ($subjects as $k => $v){
					?>
					<option value="<?php echo $k; ?>"><?php echo $v; ?> - (<?php echo $k; ?>)</option>
					<?php
				}?>
			</select>
		</div>
	</div>

</div>

<table class="dataTable_main table table-striped" data-count="<?php echo $modules->total; ?>" data-ready="true">
	<thead>
		<tr>
			<th>Module Code</th>
			<th>Module title</th>
			<th class="hide">Sort-key</th>
			<th class="hide">Sort</th>
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

		var module_list_data = {};
		// Init first table
	module_datatable($(".dataTable_main"), {"data": collection, "api_endpoint": "<?php echo KENT_API_URL;?>v1/modules/collection/<?php echo  $collection; ?>", base_url: "<?php echo Flight::url('modules/module/'); ?>",keyword_filter:$('.advanced-text-search:first'),subject_filter:$('.subject-search:first'),id:'collection' });
 </script>
</kentScripts>