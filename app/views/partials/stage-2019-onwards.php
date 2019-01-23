<?php
	$optional_clusters = array();
	$required_clusters = array();

	// make the stage data into an array make it easier to parse
	$stageData = json_decode(json_encode($stage), true);
?>

<?php if ( ! empty($stageData['clusters']['compulsory']) || ! empty($stageData['clusters']['optional']) ): ?>

<?php

	$module_clusters = array();
	if (!empty($stageData['clusters']['compulsory'])) {
		$module_clusters = array_merge($module_clusters, $stageData['clusters']['compulsory']);
	}
	if (!empty($stageData['clusters']['optional'])) {
		$module_clusters = array_merge($module_clusters, $stageData['clusters']['optional']);
	}

	foreach ($module_clusters as $cluster) {
		if (cluster_modules_are_optional($cluster)) {
			if (cluster_contains_modules($cluster)) {
				$optional_clusters[]= $cluster;
			}
		} else {
			if (cluster_contains_modules($cluster)) {
				$required_clusters[]= $cluster;
			}		
		}
	}
?>

<?php //var_dump($stageData) ?>

<?php $module_codes = array(); ?>

	<?php if (!empty($required_clusters)): ?>

		<table class="table">
		<thead>
		<tr>
			<th width="70%">Compulsory modules currently include</th>
			<th class="text-xs-center">Credits</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($required_clusters as $cluster): ?>
			<?php foreach ($cluster['modules']['module'] as $module): ?>
				<?php if ( ! empty($module['sds_code']) && ! empty($module['module_title']) && ! in_array($module['sds_code'], $module_codes) ): ?>
					<?php $module_codes[$module['sds_code']] = $module['sds_code'] ?>
					<tr class="module-row">
						<td class="module-text">
							<span data-toggle="collapse" data-target="#<?php echo $stage_id . '-' . $module['sds_code']; ?>-more" id="<?php echo $module['sds_code'] ?>" class="module-row collapsed module-title"><?php echo $module['sds_code'] ?> - <?php echo $module['module_title'] ?></span>
							<div class="collapse" id="<?php echo $stage_id . '-' . $module['sds_code']; ?>-more">
								<div class="more">
									<p><?php echo preg_replace("/\n/",'</p><p>',preg_replace('/[\r\n]+/', "\n", preg_replace('/<br\s*\/?>/',"\n",$module['synopsis']))); ?></p>
									<a aria-labelledby="#<?php echo $module['sds_code'] ?>" class="chevron-link" href="/courses/modules/module/<?php echo $module['sds_code'] ?>">View full module detals</a>
								</div>
							</div>
						</td>
						<td class="text-xs-center"><?php echo $module['credit_amount']; ?></td>
					</tr>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endforeach; ?>
	<?php endif; ?>


	<?php if (!empty($optional_clusters[0]['modules']['module'])): ?>

		<table class="table">
		<thead>
		<tr>
			<th width="70%">Optional modules may include</th>
			<th class="text-xs-center">Credits</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($optional_clusters as $cluster): ?>
			<?php foreach ($cluster['modules']['module'] as $module): ?>
				<?php if ( ! empty($module['sds_code']) && ! empty($module['module_title']) && ! in_array($module['sds_code'], $module_codes) ): ?>
					<?php $module_codes[$module['sds_code']] = $module['sds_code'] ?>
					<tr class="module-row">
						<td class="module-text">
							<span data-toggle="collapse" data-target="#<?php echo $stage_id . '-' . $module['sds_code']; ?>-more" id="<?php echo $module['sds_code'] ?>" class="module-row collapsed module-title"><?php echo $module['sds_code'] ?> - <?php echo $module['module_title'] ?></span>
							<div class="collapse" id="<?php echo $stage_id . '-' . $module['sds_code']; ?>-more">
								<div class="more">
									<p><?php echo preg_replace("/\n/",'</p><p>',preg_replace('/[\r\n]+/', "\n", preg_replace('/<br\s*\/?>/',"\n",$module['synopsis']))); ?></p>
									<a aria-labelledby="#<?php echo $module['sds_code'] ?>" class="chevron-link" href="/courses/modules/module/<?php echo $module['sds_code'] ?>">View full module detals</a>
								</div>
							</div>
						</td>
						<td class="text-xs-center"><?php echo $module['credit_amount']; ?></td>
					</tr>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endforeach; ?>
	<?php endif; ?>


<?php endif; ?>
</tbody>
</table>
<?php if ( ! empty($stageData['clusters']['wildcard']) ): ?>
	<em>You have the opportunity to select elective modules in this stage</em>
<?php endif; ?>
