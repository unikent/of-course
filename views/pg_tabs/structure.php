<h2>Programme structure</h2>

<?php echo $course->modules_intro; ?>

<?php
	// get modules from all deliveries as unique lists
	$module_list = array(); 

	foreach($course->modules as $delivery_modules){
		foreach($delivery_modules->stages as $stage){
			foreach($stage->clusters as $cluster){
				foreach($cluster[0]->modules as $modules){
					foreach($modules as $module){
						//skip blanks
						if($module->module_code=='')continue;
						// index on module code, so duplicates will just overwrite each other
						$module_list[$module->module_code] = $module;
					}
				}
			}
		}
	}


?>

	 
	<?php 
		$show_count = 10;
		$first_modules = array_slice($module_list, 0, $show_count);
		$other_modules = array_slice($module_list, $show_count);
	?>
	<ul class="unstyled"> 
	<?php foreach($first_modules as $module): ?>
		<li>
            <span class="btn btn-link module-collapse" data-toggle="collapse" data-target="#module-more-info-<?php echo $module->module_code ?>-<?php echo $stage_id ?>"><i class="icon-plus-sign"></i> <?php echo $module->module_code ?> - <?php echo $module->module_title ?></span>  
            <div id="module-more-info-<?php echo $module->module_code ?>-<?php echo $stage_id ?>" class="collapse module-synopsis"><p><?php echo $module->synopsis ?></p>
            <p><strong>Credits:</strong> <?php echo $module->credit_amount ?> credits (<?php echo $module->ects_credit ?> ECTS credits).</p>
            <p class="module-read-more"><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->module_code ?>">Read more <i class="icon-arrow-right"></i></a></p>
            </div>
        </li>
	<?php endforeach; ?>
	</ul>

	<?php if(sizeof($other_modules) != 0): ?>
		<div class="daedalus-show-hide show-hide minimal">
	      	<p class="show-hide-title">Show more...</p>
	      	<div class="show-hide-content">
	      		<ul class="unstyled"> 
	        	<?php foreach($other_modules as $module): ?>
					<li>
			            <span class="btn btn-link module-collapse" data-toggle="collapse" data-target="#module-more-info-<?php echo $module->module_code ?>-<?php echo $stage_id ?>"><i class="icon-plus-sign"></i> <?php echo $module->module_code ?> - <?php echo $module->module_title ?></span>  
			            <div id="module-more-info-<?php echo $module->module_code ?>-<?php echo $stage_id ?>" class="collapse module-synopsis"><p><?php echo $module->synopsis ?></p>
			            <p><strong>Credits:</strong> <?php echo $module->credit_amount ?> credits (<?php echo $module->ects_credit ?> ECTS credits).</p>
			            <p class="module-read-more"><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->module_code ?>">Read more <i class="icon-arrow-right"></i></a></p>
			            </div>
			        </li>
				<?php endforeach; ?>
				</ul>
	      	</div>
	    </div>
	<?php endif; ?>
	
	






<section class="info-section">
	<h3>Learning outcomes</h3>
	<?php if(!empty($course->assessment)): ?>
	<section class="info-subsection">
		<h4>Assessment</h4>
		<?php echo $course->assessment ?>
	</section>
	<?php endif; ?>

	<?php if(!empty($course->programme_aims)): ?>
	<section class="info-subsection">
		<h4>Programme aims</h4>
		<?php echo $course->programme_aims ?>
	</section>
	<?php endif; ?>

	<?php if(!empty($course->knowledge_and_understanding_learning_outcomes)): ?>
	<section class="info-subsection">
		<h4>Knowledge and understanding</h4>
		<?php echo $course->knowledge_and_understanding_learning_outcomes ?>
	</section>
	<?php endif; ?>
	
	<?php if(!empty($course->intellectual_skills_learning_outcomes)): ?>
	<section class="info-subsection">
		<h4>Intellectual skills</h4>
		<?php echo $course->intellectual_skills_learning_outcomes ?>
	</section>
	<?php endif; ?>

	<?php if(!empty($course->subjectspecific_skills_learning_outcomes)): ?>
	<section class="info-subsection">
		<h4>Subject-specific skills</h4>
		<?php echo $course->subjectspecific_skills_learning_outcomes ?>
	</section>
	<?php endif; ?>

	<?php if(!empty($course->transferable_skills_learning_outcomes)): ?>
	<section class="info-subsection">
		<h4>Transferable skills</h4>
		<?php echo $course->transferable_skills_learning_outcomes ?>
	</section>
	<?php endif; ?>
</section>



