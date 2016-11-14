<?php if ( ! empty($stage->clusters->compulsory) || ! empty($stage->clusters->optional) ): ?>
<?php $module_codes = array(); ?>
<table class="table table-hover">
<thead>
<tr>
	<th width="70%">Possible modules may include</th>
	<th class="text-xs-center">Credits</th>
	<th class="text-xs-center">ECTS Credits</th>
</tr>
</thead>
<tbody>
    <?php if(isset($stage->clusters->compulsory)): ?>
        <?php foreach ($stage->clusters->compulsory as $cluster): ?>
            <?php foreach ($cluster->modules->module as $module): ?>
                <?php if ( ! empty($module->sds_code) && ! empty($module->module_title) && ! in_array($module->sds_code, $module_codes) ): ?>
                    <?php $module_codes[$module->sds_code] = $module->sds_code ?>
                    <tr class="module-row" data-toggle="collapse" data-target="#<?php echo $module->sds_code; ?>-more">
                        <td><span class="text-primary"><?php echo $module->sds_code ?> - <?php echo $module->module_title ?></span>
							<div id="<?php echo $module->sds_code; ?>-more" class="more collapse">
								<p><?php echo preg_replace("/\n/",'</p><p>',preg_replace('/[\r\n]+/', "\n", preg_replace('/<br\s*\/?>/',"\n",$module->synopsis))); ?></p>
								<a class="chevron-link" href="http://www.kent.ac.uk/courses/modules/module/<?php echo $module->sds_code ?>">Read more</a>
							</div>
						</td>
						<td class="text-xs-center"><?php echo $module->credit_amount; ?></td>
                        <td class="text-xs-center"><?php echo $module->ects_credit ?></td>
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
					<tr class="module-row" data-toggle="collapse" data-target="#<?php echo $module->sds_code; ?>-more">
						<td><span class="text-primary"><?php echo $module->sds_code ?> - <?php echo $module->module_title ?></span>
							<div id="<?php echo $module->sds_code; ?>-more" class="more collapse">
								<p><?php echo preg_replace("/\n/",'</p><p>',preg_replace('/[\r\n]+/', "\n", preg_replace('/<br\s*\/?>/',"\n",$module->synopsis))); ?></p>
								<a class="chevron-link" href="http://www.kent.ac.uk/courses/modules/module/<?php echo $module->sds_code ?>">Read more</a>
							</div>
						</td>
						<td class="text-xs-center"><?php echo $module->credit_amount; ?></td>
						<td class="text-xs-center"><?php echo $module->ects_credit ?></td>
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