
<h2>Course structure</h2>         
<?php foreach ($course->modules->stages as $index => $stage): ?>
	<?php $compulsory_modules_present = false; ?>
	<section class="info-section">
		<h3><?php echo $stage->name ?></h3>
		<?php if (! empty($stage->clusters->compulsory) ): ?>
		<section class="info-subsection">
			<h4>Compulsory modules</h4>
			<?php foreach ($stage->clusters->compulsory as $cluster): ?>
			<ul class="unstyled">
	              <?php foreach ($cluster->modules->module as $module): ?>
		              <?php if ($module->credit_amount > 0): ?>
		              <?php $compulsory_modules_present = true; ?>
		              <li>
		              		<span class="btn btn-link module-collapse" data-toggle="collapse" data-target="#module-more-info-<?php echo $module->module_code ?>"><i class="icon-plus-sign"></i> <?php echo $module->module_code ?> - <?php echo $module->module_title ?></span>
		              		
		              		<div id="module-more-info-<?php echo $module->module_code ?>" class="collapse module-synopsis"><p><?php echo $module->synopsis ?></p>
		              			<p><strong>Credits:</strong> <?php echo $module->credit_amount ?> credits (<?php echo $module->ects_credit ?> ECTS credits).</p>
		              			<p class="module-read-more"><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->module_code ?>">Read more <i class="icon-arrow-right"></i></a></p>
		              		</div>
		              </li>
		              <?php endif; ?>
	              <?php endforeach; ?>
	              <?php if (! $compulsory_modules_present): ?>
	              <li>No compulsory modules.</li>
	              <?php endif; ?>
	          </ul>
			<?php endforeach; ?>
		</section>
		<?php endif; ?>
		
		<?php if ($stage->clusters->optional != null): ?>
		<section class="info-subsection">
			<h4>Optional modules</h4>
			<?php foreach ($stage->clusters->optional as $cluster): ?>
			<?php if ( $cluster->maximum_modules_required > $cluster->modules_required ): ?>
			<p>You must take between <?php echo $cluster->modules_required ?> and <?php echo $cluster->maximum_modules_required ?> credits from the following optional modules.</p>
			<?php else: ?>
			<p>You must take a total of <?php echo $cluster->modules_required ?> credits from the following optional modules.</p>
			<?php endif; ?>
			<ul class="unstyled">
	              <?php foreach ($cluster->modules->module as $module): ?>
	              <?php if ($module->credit_amount > 0): ?>
	              <?php $optional_modules_present = true; ?>
	              <li>
					<span class="btn btn-link" data-toggle="collapse" data-target="#module-more-info-<?php echo $module->module_code ?>"><i class="icon-plus-sign"></i> <?php echo $module->module_code ?> - <?php echo $module->module_title ?></span>
					
					<div id="module-more-info-<?php echo $module->module_code ?>" class="collapse module-synopsis"><p><?php echo $module->synopsis ?></p>
						<p><strong>Credits:</strong> <?php echo $module->credit_amount ?> credits (<?php echo $module->ects_credit ?> ECTS credits).</p>
						<p class="module-read-more"><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->module_code ?>">Read more <i class="icon-arrow-right"></i></a></p>
					</div>
	              </li>
	              <?php endif; ?>
	              <?php endforeach; ?>
	              <?php if (! $optional_modules_present): ?>
	              <li>No optional modules.</li>
	              <?php endif; ?>
	          </ul>
			<?php endforeach; ?>
		</section>
		<?php endif; ?>
		
		<?php if ($stage->clusters->wildcard != null): ?>
		<section class="info-subsection">
			<h4>Wildcard modules</h4>
			<?php foreach ($stage->clusters->wildcard as $cluster): ?>
			<?php if ( $cluster->maximum_modules_required > $cluster->modules_required ): ?>
			<p>You must take between <?php echo $cluster->modules_required ?> and <?php echo $cluster->maximum_modules_required ?> credits from wildcard modules.</p>
			<?php else: ?>
			<p>You must take a total of <?php echo $cluster->modules_required ?> credits from wildcard modules.</p>
			<?php endif; ?>
			<?php endforeach; ?>
		</section>
		<?php endif; ?>
	</section>
<?php endforeach; ?>
