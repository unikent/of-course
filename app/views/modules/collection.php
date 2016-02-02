<h1>Module Catalogue</h1>

<h2><?php echo $modules->title;?> </h2>

<table class="dataTable_main table table-striped" data-count="<?php echo $modules->total; ?>" data-ready="true">
	<thead>
		<tr>
			<th>Module Code</th>
			<th>Module title</th>
			<th>Alternate module code</th>
		</tr>
	</thead>
	<?php foreach($modules->modules as $module){ ?>
		<tr>
			<td><a href="<?php echo Flight::url("modules/module/".$module->code); ?>"><?php echo $module->code ?></a></td>
			<td><a href="<?php echo Flight::url("modules/module/".$module->code); ?>"><?php echo $module->title ?></a></td>
			<td><?php echo $module->sds_code ?></td>
		</tr>
	<?php } ?>	
</table>
		

<kentScripts>
	<script type="text/javascript" charset="utf8" src="<?php echo Flight::asset('js/build/moduletable.min.js'); ?>"></script>
	<script>
	// Init first table
	module_datatable($(".dataTable_main"), {"deferLoading":true, "api_endpoint": "<?php echo KENT_API_URL;?>v1/modules/collection/<?php echo  $collection; ?>", base_url: "<?php echo Flight::url('modules/module/'); ?>" });
 </script>
</kentScripts>