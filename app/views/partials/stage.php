<?php if ( ! empty($stage->clusters->compulsory) || ! empty($stage->clusters->optional) ): ?>
<?php $module_codes = array(); ?>
<table class="table">
<thead>
<tr>
	<th width="70%">Modules may include</th>
	<th class="text-xs-center">Credits</th>
</tr>
</thead>
<tbody>
    <?php if(isset($stage->clusters->compulsory)): ?>
        <?php foreach ($stage->clusters->compulsory as $cluster): ?>
            <?php foreach ($cluster->modules->module as $module): ?>
                <?php if ( ! empty($module->sds_code) && ! empty($module->module_title) && ! in_array($module->sds_code, $module_codes) ): ?>
                    <?php $module_codes[$module->sds_code] = $module->sds_code ?>
                    <tr class="module-row">
                        <td class="module-text">
							<span data-toggle="collapse" data-target="#<?php echo $stage_id . '-' . $module->sds_code; ?>-more" id="<?php echo $module->sds_code ?>" class="module-row collapsed module-title"><?php echo $module->sds_code ?> - <?php echo $module->module_title ?></span>
							<div class="collapse" id="<?php echo $stage_id . '-' . $module->sds_code; ?>-more">
								<div class="more">
									<p><?php echo preg_replace("/\n/",'</p><p>',preg_replace('/[\r\n]+/', "\n", preg_replace('/<br\s*\/?>/',"\n",$module->synopsis))); ?></p>
									<a aria-labelledby="#<?php echo $module->sds_code ?>" class="chevron-link" href="/courses/modules/module/<?php echo $module->sds_code ?>">View full module details</a>
								</div>
							</div>
						</td>
						<td class="text-xs-center"><?php echo $module->credit_amount; ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if(isset($stage->clusters->optional)): ?>
        <?php foreach ($stage->clusters->optional as $cluster): ?>
            <?php foreach ($cluster->modules->module as $module): ?>
                <?php if ( ! empty($module->sds_code) && ! in_array($module->sds_code, $module_codes) ): ?>
                    <?php $module_codes[$module->sds_code] = $module->sds_code ?>
					<tr class="module-row">
						<td class="module-text">
							<span data-toggle="collapse" data-target="#<?php echo $stage_id . '-' . $module->sds_code; ?>-more" id="<?php echo $module->sds_code ?>" class="module-row collapsed module-title"><?php echo $module->sds_code ?> - <?php echo $module->module_title ?></span>
							<div id="<?php echo $stage_id . '-' . $module->sds_code; ?>-more" class="collapse">
								<div class="more">
									<p><?php echo preg_replace("/\n/",'</p><p>',preg_replace('/[\r\n]+/', "\n", preg_replace('/<br\s*\/?>/',"\n",$module->synopsis))); ?></p>
									<a aria-labelledby="#<?php echo $module->sds_code ?>" class="chevron-link" href="/courses/modules/module/<?php echo $module->sds_code ?>">View full module details</a>
								</div>
							</div>
						</td>
						<td class="text-xs-center"><?php echo $module->credit_amount; ?></td>
					</tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>
</tbody>
</table>
<?php if ( ! empty($stage->clusters->wildcard) ): ?>
    <em>You have the opportunity to select wild modules in this stage</em>
<?php endif; ?>
