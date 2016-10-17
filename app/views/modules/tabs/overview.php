<?php if (isset($module->synopsis) && !empty($module->synopsis)): ?>
	<h2>Overview</h2>
	<?php echo $module->synopsis; ?>
<?php endif; ?>
<?php if (!$data_found): ?>
	<p>Sorry, no data found for this module</p>
<?php endif; ?>