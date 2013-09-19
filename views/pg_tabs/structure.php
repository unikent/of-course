<h2>Programme structure</h2>

<?php if(!empty($course->programme_overview)):?>
	<p><?php echo $course->programme_overview; ?></p>
<?php endif;?>

<?php $emptystages = true;?>

<?php
foreach($course->modules as $module){
	if(!empty($module->stages)){
		$emptystages = false;
	}
}	
?>

<?php if((empty($course->modules[0])) || $emptystages): ?>
	
<?php else: ?>
	<h3>Modules</h3>

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
	<?php foreach($first_modules as $module): ?>
		<div class="daedalus-show-hide show-hide minimal">
            <p class="show-hide-title"><?php echo $module->module_code ?> - <?php echo $module->module_title ?></p>
            <div class="show-hide-content">
            	<p><?php echo $module->synopsis ?></p>
            	<p><strong>Credits:</strong> <?php echo $module->credit_amount ?> credits (<?php echo $module->ects_credit ?> ECTS credits).</p>
            	<p class="module-read-more"><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->module_code ?>">Read more <i class="icon-arrow-right"></i></a></p>
            </div>
		</div>
	<?php endforeach; ?>

	<?php if(sizeof($other_modules) != 0): ?>
      	<a data-toggle="collapse" href="#more-modules">Show more...</a>
      	<br />
      	<div id="more-modules" class="collapse">
        	<?php foreach($other_modules as $module): ?>
      		<div class="daedalus-show-hide show-hide minimal">
	            <p class="show-hide-title"><?php echo $module->module_code ?> - <?php echo $module->module_title ?></p>
	            <div class="show-hide-content">
	            	<p><?php echo $module->synopsis ?></p>
	            	<p><strong>Credits:</strong> <?php echo $module->credit_amount ?> credits (<?php echo $module->ects_credit ?> ECTS credits).</p>
	            	<p class="module-read-more"><a href="http://www.kent.ac.uk/courses/modulecatalogue/modules/<?php echo $module->module_code ?>">Read more <i class="icon-arrow-right"></i></a></p>
	            </div>
			</div>
			<?php endforeach; ?>
      	</div>
	<?php endif; ?>
<br />
<?php endif; ?>	






<section class="info-section">
	
	<?php if(!empty($course->assessment)): ?>
		<h3>Assessment</h3>
		<section class="info-subsection">
			<?php echo $course->assessment ?>
		</section>
	<?php endif; ?>
	
	<h3>Learning outcomes</h3>
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



