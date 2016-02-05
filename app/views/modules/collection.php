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
	<?php $n=0; foreach($modules->modules as $module){ ?>
		<tr class="<?php $n++;echo $n % 2 == 0 ? 'even' : 'odd';?> <?php echo $module->running?'running':'inactive'; ?>">
			<td><?php if($module->running){ ?><a href="<?php echo Flight::url("modules/module/".$module->sds_code); ?>"><?php echo $module->sds_code ?></a><?php }else{ echo $module->sds_code; }?></td>
			<td><?php if($module->running){ ?><a href="<?php echo Flight::url("modules/module/".$module->sds_code); ?>"><?php echo $module->title ?></a><?php }else{ echo $module->title . ' - <em>Module not currently running</em>'; }?></td>
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